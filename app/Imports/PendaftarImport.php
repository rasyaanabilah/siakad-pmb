<?php

namespace App\Imports;

use App\Models\Pendaftar;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PendaftarImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Pendaftar([
            'nama'          => $row['nama'],
            'email'         => $row['email'],
            'sekolah_asal'  => $row['sekolah_asal'],
            'prodi_id'      => $row['prodi_id'],
            'dosen_id'      => $row['dosen_id'],
            'status'        => 'pending'
        ]);
    }

    public function rules(): array
    {
        return [
            'nama'  => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('pendaftars', 'email') // ❗ VALIDASI DUPLIKAT
            ],
            'sekolah_asal' => 'required',
            'prodi_id'     => 'required|exists:prodis,id',
            'dosen_id'     => 'required|exists:dosens,id',
            'status'       => 'in:pending,diterima,ditolak'
            
        ];
    }
}
