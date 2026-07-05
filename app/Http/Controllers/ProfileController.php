<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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

        auth()->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}