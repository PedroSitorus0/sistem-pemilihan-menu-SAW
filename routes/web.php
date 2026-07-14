<?php


use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LogController;
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


Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/users/{user}/verify-nim', [App\Http\Controllers\UserController::class, 'verifyNim'])
        ->name('users.verifyNim');
    Route::post('/users/{user}/reject-nim', [App\Http\Controllers\UserController::class, 'rejectNim'])
        ->name('users.rejectNim');

});

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('user', UserController::class);
    Route::resource('/penilaian', PenilaianController::class);
    Route::get('/rekomendasi-menu',[SawController::class, 'hasil'])->name('saw.hasil');
    Route::get('/prototype', [SawController::class, 'hasil'])->name('');
    Route::get('/about', function () {return view('about');})->name('about');

    Route::middleware(['role:admin,dev'])->group(function() {
        Route::resource('menus', MenuController::class);
        Route::resource('kriteria', KriteriaController::class);
        Route::resource('users', UserController::class);
        Route::get('/perhitungan-saw', [SawController::class, 'index'])->name('saw.index');
    });

    Route::middleware(['role:dev'])->group(function() {
        Route::prefix('logs')->name('logs.')->group(function () {
        
        // 1. Route spesifik/statis HARUS diletakkan paling atas
        Route::get('/export', [LogController::class, 'export'])->name('export');
        Route::post('/clear', [LogController::class, 'clearOldLogs'])->name('clear');
        
        // 2. Route utama & dinamis diletakkan di bawah
        Route::get('/', [LogController::class, 'index'])->name('index');
        Route::get('/{id}', [LogController::class, 'show'])->name('show');
        Route::delete('/{id}', [LogController::class, 'destroy'])->name('destroy');
        
    });
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
