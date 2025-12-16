<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\DosenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/prodi', [ProdiController::class, 'index']);
Route::post('/prodi', [ProdiController::class, 'store']);
Route::delete('/prodi/{id}', [ProdiController::class, 'destroy']);

Route::get('/pendaftar', [PendaftarController::class, 'index']);
Route::post('/pendaftar', [PendaftarController::class, 'store']);

Route::get('/dosen', [DosenController::class, 'index']);
Route::post('/dosen', [DosenController::class, 'store']);
