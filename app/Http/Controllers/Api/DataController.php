<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Prodi;
use App\Models\Dosen;

class DataController extends Controller
{
    public function pendaftar()
    {
        return Pendaftar::all();
    }

    public function prodi()
    {
        return Prodi::all();
    }

    public function dosen()
    {
        return Dosen::all();
    }
}
