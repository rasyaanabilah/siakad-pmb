<?php

namespace App\Exports;

use App\Models\Pendaftar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendaftarExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pendaftar::select(
            'nama',
            'email',
            'sekolah_asal',
            'prodi_id',
            'dosen_id',
            'status'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Sekolah Asal',
            'Prodi ID',
            'Dosen ID',
            'Status'
        ];
    }
}
