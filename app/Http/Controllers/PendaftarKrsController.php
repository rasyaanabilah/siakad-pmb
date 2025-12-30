<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class PendaftarKrsController extends Controller
{
    public function print()
    {
        $pendaftar = Pendaftar::with(['prodi', 'dosen'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // 🔑 BUAT TOKEN SEKALI SAJA
        if (!$pendaftar->krs_token) {
            $pendaftar->krs_token = Str::uuid();
            $pendaftar->save();
        }

        // 🔗 LINK VALIDASI (INI YANG DI-SCAN)
        $qrUrl = route('krs.validasi', $pendaftar->krs_token);

        // ✅ QR SVG → BASE64 (tidak butuh Imagick)
        $qrCode = base64_encode(
            QrCode::format('svg')
                ->size(150)
                ->margin(1)
                ->generate($qrUrl)
        );

        return Pdf::loadView('pendaftar.krs.pdf', compact('pendaftar', 'qrCode'))
            ->setPaper('A4')
            ->stream('KRS-Mahasiswa.pdf');
    }

    // ✅ HALAMAN VALIDASI
    public function validasi($token)
    {
        $pendaftar = Pendaftar::where('krs_token', $token)->firstOrFail();

        return view('krs.validasi', compact('pendaftar'));
    }
}
