<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftarDashboardController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\Admin\AdminPendaftarController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\ProdiController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendaftarExport;
use App\Imports\PendaftarImport;
use App\Http\Controllers\PendaftarKrsController;
use App\Http\Controllers\KrsValidasiController;

Route::get('/validasi/krs/{token}', [KrsValidasiController::class, 'show'])
    ->name('krs.validasi');

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/dashboard', function () {
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('pendaftar.dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', fn () => view('admin.dashboard'))
            ->name('dashboard');

        // ======================
        // PENDAFTAR
        // ======================
        Route::get('/pendaftar', [AdminPendaftarController::class, 'index'])
            ->name('pendaftar.index');

        Route::patch('/pendaftar/{pendaftar}/status',
            [AdminPendaftarController::class, 'updateStatus']
        )->name('pendaftar.updateStatus');

        Route::delete('/pendaftar/{pendaftar}',
            [AdminPendaftarController::class, 'destroy']
        )->name('pendaftar.destroy');

        // 🔽 LEVEL 6 — EXPORT & IMPORT
        Route::get('/pendaftar/export',
            [AdminPendaftarController::class, 'export']
        )->name('pendaftar.export');

        Route::post('/pendaftar/import',
            [AdminPendaftarController::class, 'import']
        )->name('pendaftar.import');

        // ======================
        // DOSEN
        // ======================
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
        Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
        Route::patch('/dosen/{dosen}', [DosenController::class, 'update'])->name('dosen.update');
        Route::delete('/dosen/{dosen}', [DosenController::class, 'destroy'])->name('dosen.destroy');

        // ======================
        // PRODI
        // ======================
        Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
        Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
    });



/*
|--------------------------------------------------------------------------
| PENDAFTAR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pendaftar'])->group(function () {

    Route::get('/pendaftar/dashboard',
        [PendaftarDashboardController::class, 'index']
    )->name('pendaftar.dashboard');

    Route::get('/pendaftar/create',
        [PendaftarController::class, 'create']
    )->name('pendaftar.create');

    Route::post('/pendaftar',
        [PendaftarController::class, 'store']
    )->name('pendaftar.store');

    Route::get('/pendaftar/krs/pdf', [PendaftarKrsController::class, 'print'])
        ->name('pendaftar.krs.pdf');
        
});


require __DIR__.'/auth.php';
