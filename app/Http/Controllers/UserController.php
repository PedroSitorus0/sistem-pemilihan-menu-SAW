<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Menampilkan data pengguna dengan pagination (10 data per halaman)
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Fungsi Helper untuk mengecek hierarki wewenang
     */
    private function checkPermission(User $targetUser)
    {
        // $currentUser = auth()->user();

        // 1. Dev tidak bisa mengedit sesama Dev
        // if ($currentUser->role === 'dev' && $targetUser->role === 'dev') {
        //     abort(403, 'Akses Ditolak: Anda tidak dapat mengubah data sesama Developer.');
        // } 
        
        // if (Auth::user()->role === 'dev' && $targetUser->id === Auth::user()->id) {
            
        // } 

        // // 2. Admin hanya bisa mengedit User (tidak bisa Dev atau sesama Admin)
        // if ($currentUser->role === 'admin' && in_array($targetUser->role, ['dev', 'admin'])) {
        //     abort(403, 'Akses Ditolak: Admin hanya memiliki wewenang untuk mengubah data User.');
        // }

        $currentUser = Auth::user();

    // 1. ATURAN DEVELOPER: Tidak boleh mengedit Developer LALN
    if ($currentUser->role === 'dev' && $targetUser->role === 'dev' && $currentUser->id !== $targetUser->id) {
        abort(403, 'Akses Ditolak: Anda tidak dapat mengubah data sesama Developer.');
    }

    // 2. ATURAN ADMIN (A): Tidak boleh mengedit Developer (Hierarki di atasnya)
    if ($currentUser->role === 'admin' && $targetUser->role === 'dev') {
        abort(403, 'Akses Ditolak: Admin tidak memiliki hak untuk mengubah data Developer.');
    }

    // 3. ATURAN ADMIN (B): Tidak boleh mengedit Admin LAIN
    if ($currentUser->role === 'admin' && $targetUser->role === 'admin' && $currentUser->id !== $targetUser->id) {
        abort(403, 'Akses Ditolak: Anda tidak dapat mengubah data sesama Admin.');
    }
    }

    public function edit(User $user)
    {
        // Cek izin sebelum membuka form
        $this->checkPermission($user);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Cek izin sebelum menyimpan data
        $this->checkPermission($user);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,mahasiswa,dev',
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Cek izin sebelum menghapus
        $this->checkPermission($user);
        
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
    public function verifyNim(Request $request, User $user)
{
    $currentUserRole = auth()->user()->role;
 
    // Guard di level controller - jangan hanya andalkan tombol yang disembunyikan di UI
    if (! in_array($currentUserRole, ['admin', 'dev'])) {
        abort(403, 'Anda tidak memiliki izin untuk memverifikasi NIM.');
    }
 
    if (! $user->nomor_induk) {
        return redirect()->route('users.index')
            ->with('error', 'User ini belum mengisi NIM, tidak ada yang bisa diverifikasi.');
    }
 
    $user->nomor_induk_verified_at = now();
    $user->save();
 
    return redirect()->route('users.index')
        ->with('success', "NIM milik {$user->nama} berhasil diverifikasi.");
}
 
/**
 * Tolak/reset verifikasi NIM - mengosongkan NIM supaya user mengisi ulang
 * (misal karena NIM yang diinput salah/tidak valid).
 */
public function rejectNim(Request $request, User $user)
{
    $currentUserRole = auth()->user()->role;
 
    if (! in_array($currentUserRole, ['admin', 'dev'])) {
        abort(403, 'Anda tidak memiliki izin untuk menolak NIM.');
    }
 
    $user->nomor_induk = null;
    $user->nomor_induk_verified_at = null;
    $user->save();
 
    return redirect()->route('users.index')
        ->with('success', "NIM milik {$user->nama} ditolak dan diminta mengisi ulang.");
}

}