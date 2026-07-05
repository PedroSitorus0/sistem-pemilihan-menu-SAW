<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * PENTING: Field diisi satu-per-satu secara eksplisit dari $request->validated(),
     * BUKAN dari $request->all() / $user->fill($request->all()). Ini mencegah
     * mass-assignment untuk field 'role' yang memang tidak pernah didaftarkan
     * di ProfileUpdateRequest, sehingga tidak mungkin diubah lewat endpoint ini
     * sekalipun user mengirim payload tambahan secara manual.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        $user->nama = $validated['nama'];
        $user->phone = $validated['phone'] ?? null;
        $user->email = $validated['email'];

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // ===== LOGIKA VERIFIKASI NIM =====
        // Jika NIM berubah (baik dari kosong -> isi, atau isi -> isi lain),
        // status verifikasi otomatis di-reset ke NULL (belum diverifikasi),
        // supaya admin/dev wajib mengecek ulang nilai yang baru.
        $nomorIndukBaru = $validated['nomor_induk'] ?? null;
        if ($nomorIndukBaru !== $user->nomor_induk) {
            $user->nomor_induk = $nomorIndukBaru;
            $user->nomor_induk_verified_at = null;
        }

        // ===== UPLOAD FOTO PROFIL (hasil crop, dikirim sebagai base64) =====
        // Cropper di frontend selalu mengeluarkan hasil sebagai data URL base64
        // lewat hidden input 'foto_cropped', bukan file upload biasa — jadi kita
        // tidak lagi memakai $request->hasFile('foto').
        if ($request->filled('foto_cropped')) {
            $this->saveCroppedImage($request->input('foto_cropped'), $user, 'foto', 'profile-photos');
        }

        // ===== UPLOAD FOTO SAMPUL (hasil crop, dikirim sebagai base64) =====
        if ($request->filled('cover_photo_cropped')) {
            $this->saveCroppedImage($request->input('cover_photo_cropped'), $user, 'cover_photo', 'cover-photos');

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // ===== LOGIKA VERIFIKASI NIM =====
        // Jika NIM berubah (baik dari kosong -> isi, atau isi -> isi lain),
        // status verifikasi otomatis di-reset ke NULL (belum diverifikasi),
        // supaya admin/dev wajib mengecek ulang nilai yang baru.
        $nomorIndukBaru = $validated['nomor_induk'] ?? null;
        if ($nomorIndukBaru !== $user->nomor_induk) {
            $user->nomor_induk = $nomorIndukBaru;
            $user->nomor_induk_verified_at = null;
        }

        // ===== UPLOAD FOTO PROFIL =====
        if ($request->hasFile('foto')) {
            // Hapus foto lama supaya tidak menumpuk file yatim di storage
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            $path = $request->file('foto')->store('profile-photos', 'public');
            $user->foto = $path;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Decode data URL base64 hasil cropper, simpan ke storage, hapus file lama
     * supaya tidak menumpuk file yatim, lalu set kolom pada model $user.
     *
     * Tidak menimpa $user->save() — pemanggil tetap bertanggung jawab memanggil
     * save() di akhir, konsisten dengan field lain di method update().
     */
    private function saveCroppedImage(string $dataUrl, User $user, string $column, string $directory): void
    {
        // Data URL diharapkan berbentuk: "data:image/png;base64,AAAA..." atau
        // "data:image/jpeg;base64,AAAA...". Validasi bentuknya dulu sebelum decode,
        // supaya payload yang tidak sesuai format tidak lolos begitu saja.
        if (! preg_match('/^data:image\/(png|jpe?g);base64,/', $dataUrl, $matches)) {
            return;
        }

        $extension = $matches[1] === 'jpg' ? 'jpeg' : $matches[1];
        $base64Data = substr($dataUrl, strpos($dataUrl, ',') + 1);
        $binary = base64_decode($base64Data, true);

        if ($binary === false) {
            return;
        }

        // Hapus file lama dulu supaya tidak menumpuk file yatim di storage.
        if ($user->{$column}) {
            Storage::disk('public')->delete($user->{$column});
        }

        $filename = sprintf('%s/%d_%s.%s', $directory, $user->id, uniqid(), $extension);
        Storage::disk('public')->put($filename, $binary);

        $user->{$column} = $filename;
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        if ($user->cover_photo) {
            Storage::disk('public')->delete($user->cover_photo);
        }

        auth()->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}