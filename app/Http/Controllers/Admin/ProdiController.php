<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * READ - Tampilkan semua Prodi
     */
    public function index()
    {
        $prodis = Prodi::all();
        $pendaftars = Pendaftar::with(['prodi', 'dosen'])->get();

        return view('admin.prodi.index', compact('prodis', 'pendaftars'));
    }

    /**
     * CREATE - Simpan Prodi baru
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

    /**
     * UPDATE - Update Prodi
     */
    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:100',
        ]);

        $prodi->update([
            'nama_prodi' => $request->nama_prodi,
        ]);

        return redirect()->route('admin.prodi.index')
            ->with('success', 'Prodi berhasil diperbarui');
    }

    /**
     * DELETE - Hapus Prodi
     */
    public function destroy(Prodi $prodi)
    {
        $prodi->delete();

        return redirect()->route('admin.prodi.index')
            ->with('success', 'Prodi berhasil dihapus');
    }
}
