<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::all();
        return view('dosen.index', compact('dosens'));
    }

    public function store(Request $request)
    {
        Dosen::create([
            'nama_dosen' => $request->nama_dosen
        ]);

        return back();
    }
}

