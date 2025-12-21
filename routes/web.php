<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftarDashboardController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\Admin\AdminPendaftarController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\ProdiController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Redirect dashboard by role
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('pendaftar.dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Pendaftar (Admin)
        Route::get('/pendaftar', [AdminPendaftarController::class, 'index'])
            ->name('pendaftar.index');

        Route::get('/pendaftar/create', [AdminPendaftarController::class, 'create'])
            ->name('pendaftar.create');   // <-- ini harus ada

        Route::post('/pendaftar/store', [AdminPendaftarController::class, 'store'])
            ->name('pendaftar.store');   // <-- ini juga harus ada

        // Dosen
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
        Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');

        // Prodi
        Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
        Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
    });


/*
|--------------------------------------------------------------------------
| PENDAFTAR ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pendaftar'])->group(function () {

    Route::get('/pendaftar/dashboard', [PendaftarDashboardController::class, 'index'])
        ->name('pendaftar.dashboard');

    Route::get('/pendaftar/create', [PendaftarController::class, 'create'])
        ->name('pendaftar.create');

    Route::post('/pendaftar/store', [PendaftarController::class, 'store'])
        ->name('pendaftar.store');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
