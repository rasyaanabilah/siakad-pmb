<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;

class KrsValidasiController extends Controller
{
    public function show($token)
    {
        $pendaftar = Pendaftar::with(['prodi', 'dosen'])->where('krs_token', $token)->first();

        if (!$pendaftar) {
            return view('pendaftar.krs.validasi', [
                'status' => 'invalid'
            ]);
        }

        return view('pendaftar.krs.validasi', [
            'status' => 'valid',
            'pendaftar' => $pendaftar
        ]);
    }
}
