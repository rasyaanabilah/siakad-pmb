<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Tampilkan semua Prodi dan Pendaftar
     */
    public function index()
    {
        $prodis = Prodi::all();
        $pendaftars = Pendaftar::with(['prodi', 'dosen'])->get();

        return view('admin.prodi.index', compact('prodis', 'pendaftars'));
    }

    /**
     * Simpan Prodi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:100',
        ]);

        Prodi::create([
            'nama_prodi' => $request->nama_prodi,
        ]);

        return redirect()->route('admin.prodi.index')
            ->with('success', 'Prodi berhasil ditambahkan');
    }
}
