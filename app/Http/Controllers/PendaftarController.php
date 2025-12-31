<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\PendaftarBaru;
use App\Models\Pendaftar;
use App\Models\Prodi;
use App\Models\Dosen;

class PendaftarController extends Controller
{
    public function create()
    {
        $prodis = Prodi::all();
        $dosens = Dosen::all();

        return view('pendaftar.create', compact('prodis', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:pendaftars,email',
            'sekolah_asal' => 'required|string|max:100',
            'gender' => 'required|in:laki-laki,perempuan',
            'angkatan' => 'required|integer|min:2000|max:2030',
            'prodi_id' => 'required|exists:prodis,id',
            'dosen_id' => 'required|exists:dosens,id',
            'foto' => 'nullable|image|max:5120',     // max 5MB
            'dokumen' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('uploads/foto','public') : null;
        $dokumenPath = $request->file('dokumen') ? $request->file('dokumen')->store('uploads/dokumen','public') : null;

        $pendaftar = Pendaftar::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'email' => $request->email,
            'sekolah_asal' => $request->sekolah_asal,
            'gender' => $request->gender,
            'angkatan' => $request->angkatan,
            'prodi_id' => $request->prodi_id,
            'dosen_id' => $request->dosen_id,
            'foto' => $fotoPath,
            'dokumen' => $dokumenPath,
        ]);

        broadcast(new PendaftarBaru($pendaftar))->toOthers();

        return redirect()->route('pendaftar.dashboard')
            ->with('success', 'Pendaftaran berhasil disimpan.');
    }

    public function dashboard()
    {
        $pendaftar = Auth::user()->pendaftar;

        return view('pendaftar.dashboard', compact('pendaftar'));
    }
}
