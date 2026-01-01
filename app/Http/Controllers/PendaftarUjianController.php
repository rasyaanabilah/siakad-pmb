<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PendaftarUjianController extends Controller
{
    public function print()
    {
        $pendaftar = Pendaftar::with(['prodi', 'dosen'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $pdf = Pdf::loadView('pendaftar.kartu-ujian', [
            'pendaftar' => $pendaftar,
        ])->setPaper('A4');

        return $pdf->stream('Kartu-Ujian.pdf');
    }
}
