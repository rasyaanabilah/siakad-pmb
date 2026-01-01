<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    /**
     * List semua pendaftar
     */
    public function index()
    {
        $pendaftar = Pendaftar::with(['user', 'prodi', 'dosen'])->get();

        return response()->json([
            'status'  => true,
            'message' => 'Data pendaftar berhasil diambil',
            'data'    => $pendaftar
        ], 200);
    }

    /**
     * Detail pendaftar (opsional, tapi RESTful)
     */
    public function show($id)
    {
        $pendaftar = Pendaftar::with(['user', 'prodi', 'dosen'])->find($id);

        if (!$pendaftar) {
            return response()->json([
                'status'  => false,
                'message' => 'Pendaftar tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Detail pendaftar',
            'data'    => $pendaftar
        ], 200);
    }
}
