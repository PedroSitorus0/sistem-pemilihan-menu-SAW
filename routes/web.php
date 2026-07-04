<?php

use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SawController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/errors', function() {
//     abort(500);
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('user', UserController::class);
    Route::get('log', [LogController::class, 'index'])->name('log.index');
    Route::resource('/penilaian', PenilaianController::class);
    Route::get('/rekomendasi-menu',[SawController::class, 'hasil'])->name('saw.hasil');

    Route::middleware(['role:admin,dev'])->group(function() {
        Route::resource('menus', MenuController::class);
        Route::resource('kriteria', KriteriaController::class);
        Route::resource('users', UserController::class);
        Route::get('/perhitungan-saw', [SawController::class, 'index'])->name('saw.index');
    });
});


// Admin & Dev
Route::middleware(['auth', 'role:admin,dev'])->group(function () {
    Route::get('/saw', [SawController::class, 'index'])->name('saw.index');
});

// Penilai hanya lihat hasil
Route::middleware(['auth', 'role:dosen,mahasiswa'])->group(function () {
    Route::get('/hasil', [SawController::class, 'hasil'])->name('saw.hasil');
});


require __DIR__.'/auth.php';
