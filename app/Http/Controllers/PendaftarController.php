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
        $pendaftars = Pendaftar::with(['prodi', 'dosen'])->get();

        return view('pendaftar.index', compact('prodis', 'dosens', 'pendaftars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pendaftars',
            'sekolah_asal' => 'required',
            'prodi_id' => 'required',
            'dosen_id' => 'required'
        ]);

        Pendaftar::create($request->all());

        return redirect('/pendaftar');
    }
}
