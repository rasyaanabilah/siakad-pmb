<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::all();
        return view('prodi.index', compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required'
        ]);

        Prodi::create($request->all());
        return redirect('/prodi')->with('success', 'Prodi berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Prodi::destroy($id);
        return redirect('/prodi');
    }
}

