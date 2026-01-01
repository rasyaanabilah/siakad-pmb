<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\JsonResponse;

class ProdiController extends Controller
{
    /**
     * Menampilkan daftar prodi
     */
    public function index(): JsonResponse
    {
        $prodi = Prodi::select('id', 'nama_prodi')->get();

        return response()->json([
            'status'  => true,
            'message' => 'Data prodi berhasil diambil',
            'data'    => $prodi
        ], 200);
    }
}
