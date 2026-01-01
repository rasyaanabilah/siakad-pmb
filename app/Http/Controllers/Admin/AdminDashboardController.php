<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Prodi;

class AdminDashboardController extends Controller
{
    /**
     * Endpoint khusus AJAX
     * Dipanggil oleh Chart.js
     */
    public function data()
    {
        // ============================
        // DATA PENDAFTAR PER PRODI
        // ============================
        // Ambil id prodi + total
        $prodiRaw = Pendaftar::selectRaw('prodi_id, COUNT(*) as total')
            ->groupBy('prodi_id')
            ->pluck('total', 'prodi_id');

        // Ubah prodi_id -> nama_prodi
        $prodi = [];
        foreach ($prodiRaw as $prodiId => $total) {
            $nama = Prodi::find($prodiId)?->nama_prodi ?? 'Tidak diketahui';
            $prodi[$nama] = $total;
        }

        // ============================
        // DATA GENDER
        // ============================
        $gender = Pendaftar::selectRaw('gender, COUNT(*) as total')
            ->groupBy('gender')
            ->pluck('total', 'gender');

        // ============================
        // DATA ANGKATAN
        // ============================
        $angkatan = Pendaftar::selectRaw('angkatan, COUNT(*) as total')
            ->groupBy('angkatan')
            ->orderBy('angkatan')
            ->pluck('total', 'angkatan');

        // ============================
        // RESPONSE JSON
        // ============================
        return response()->json([
            'prodi'    => $prodi,
            'gender'   => $gender,
            'angkatan' => $angkatan,
        ]);
    }
}
