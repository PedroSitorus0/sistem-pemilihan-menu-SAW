<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        $currentUser = auth()->user();

        // 1. Dev tidak bisa mengedit sesama Dev
        if ($currentUser->role === 'dev' && $targetUser->role === 'dev') {
            abort(403, 'Akses Ditolak: Anda tidak dapat mengubah data sesama Developer.');
        }

        // 2. Admin hanya bisa mengedit User (tidak bisa Dev atau sesama Admin)
        if ($currentUser->role === 'admin' && in_array($targetUser->role, ['dev', 'admin'])) {
            abort(403, 'Akses Ditolak: Admin hanya memiliki wewenang untuk mengubah data User.');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:dev,admin,user',
        ]);

        $user->name = $request->name;
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
}