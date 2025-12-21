<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Http\Request;

class AdminPendaftarController extends Controller
{
    /**
     * Tampilkan semua pendaftar
     */
    public function index()
    {
        $pendaftars = Pendaftar::with(['prodi', 'dosen'])->get();
        return view('admin.pendaftar.index', compact('pendaftars'));
    }

    /**
     * Tampilkan form tambah pendaftar
     */
    public function create()
    {
        $prodis = Prodi::all();
        $dosens = Dosen::all();
        return view('admin.pendaftar.create', compact('prodis', 'dosens'));
    }

    /**
     * Simpan pendaftar baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'sekolah_asal' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodis,id',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        Pendaftar::create($request->all());

        return redirect()->route('admin.pendaftar.index')
            ->with('success', 'Pendaftar berhasil ditambahkan oleh admin.');
    }
}
