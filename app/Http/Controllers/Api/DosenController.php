<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();

        return response()->json([
            'status'  => true,
            'message' => 'Data dosen berhasil diambil',
            'data'    => $dosen
        ], 200);
    }
}
