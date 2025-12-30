<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendaftarExport;
use App\Imports\PendaftarImport;



class AdminPendaftarController extends Controller
{
    public function index(Request $request)
    {
        $pendaftars = Pendaftar::with(['prodi', 'dosen'])
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->get();

        return view('admin.pendaftar.index', compact('pendaftars'));
    }
        
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak'
        ]);

        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = $request->status;
        $pendaftar->save();

        // 🔥 HARUS JSON (BUKAN redirect)
        return response()->json([
            'success' => true,
            'status' => $pendaftar->status
        ]);
    }

    public function destroy(Pendaftar $pendaftar)
    {
        if ($pendaftar->foto) {
            Storage::disk('public')->delete($pendaftar->foto);
        }

        if ($pendaftar->dokumen) {
            Storage::disk('public')->delete($pendaftar->dokumen);
        }

        $pendaftar->delete();

        return redirect()
            ->route('admin.pendaftar.index')
            ->with('success', 'Data pendaftar berhasil dihapus');
    }

    public function create()
    {
        return view('admin.pendaftar.create', [
            'prodis' => Prodi::all(),
            'dosens' => Dosen::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'sekolah_asal' => 'required|string',
            'prodi_id' => 'required|exists:prodis,id',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        Pendaftar::create($request->all());

        return redirect()
            ->route('admin.pendaftar.index')
            ->with('success', 'Pendaftar berhasil ditambahkan');
    }

public function export()
{
    return Excel::download(new PendaftarExport, 'pendaftar.xlsx');
}

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv'
    ]);

    Excel::import(new PendaftarImport, $request->file('file'));

    return redirect()
        ->route('admin.pendaftar.index')
        ->with('success', 'Data pendaftar berhasil diimport');
}

}