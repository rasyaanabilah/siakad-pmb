<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;

class PendaftarDashboardController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();

        return view('pendaftar.dashboard', compact('pendaftar'));
    }
    
}
