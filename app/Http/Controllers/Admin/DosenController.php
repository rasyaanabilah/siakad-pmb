<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::orderBy('nama_dosen')->get();
        return view('admin.dosen.index', compact('dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:100',
        ]);

        Dosen::create([
            'nama_dosen' => $request->nama_dosen,
        ]);

        return back()->with('success', 'Dosen berhasil ditambahkan');
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:100',
        ]);

        $dosen->update([
            'nama_dosen' => $request->nama_dosen,
        ]);

        return back()->with('success', 'Data dosen berhasil diperbarui');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return back()->with('success', 'Data dosen berhasil dihapus');
    }
}
