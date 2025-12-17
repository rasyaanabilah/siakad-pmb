<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    public function index()
    {
        $prodis = Prodi::all();
        $dosens = Dosen::all();

        $pendaftars = Pendaftar::with(['prodi','dosen'])->get();

        return view('pendaftar.index', compact(
            'prodis',
            'dosens',
            'pendaftars'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pendaftars',
            'sekolah_asal' => 'required',
            'prodi_id' => 'required',
            'dosen_id' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'dokumen' => 'nullable|mimes:pdf,jpg,png|max:4096',
        ]);

        $data = $request->all();

        // upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        // upload dokumen
        if ($request->hasFile('dokumen')) {
            $data['dokumen'] = $request->file('dokumen')->store('dokumen', 'public');
        }

        Pendaftar::create($data);

        return redirect('/pendaftar')->with('success', 'Pendaftaran berhasil');
    }
}
