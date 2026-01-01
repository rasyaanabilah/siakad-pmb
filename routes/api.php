<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PendaftarController;
use App\Http\Controllers\Api\DataController;

/*
|--------------------------------------------------------------------------
| PUBLIC API (tanpa login)
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login']);

// data master (boleh publik)
Route::get('/prodi', [DataController::class, 'prodi']);
Route::get('/dosen', [DataController::class, 'dosen']);

/*
|--------------------------------------------------------------------------
| PROTECTED API (harus login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);

    // pendaftar
    Route::get('/pendaftar', [PendaftarController::class, 'index']);
    Route::get('/pendaftar/{id}', [PendaftarController::class, 'show']);

    // auth
    Route::post('/logout', [AuthController::class, 'logout']);
});
