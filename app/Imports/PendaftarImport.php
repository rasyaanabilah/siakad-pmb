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
        // Skip jika data wajib kosong
        if (
            empty($row['nama']) ||
            empty($row['email']) ||
            empty($row['sekolah_asal']) ||
            empty($row['prodi_id']) ||
            empty($row['dosen_id']) ||
            empty($row['angkatan'])
        ) {
            return null;
        }

        return new Pendaftar([
            'nama'         => $row['nama'],
            'email'        => $row['email'],
            'sekolah_asal' => $row['sekolah_asal'],
            'prodi_id'     => $row['prodi_id'],
            'dosen_id'     => $row['dosen_id'],
            'angkatan'     => $row['angkatan'],
            'status'       => 'pending',
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('pendaftars', 'email'),
            ],
            'sekolah_asal' => 'required',
            'prodi_id'     => 'required|exists:prodis,id',
            'dosen_id'     => 'required|exists:dosens,id',
            'angkatan'     => 'required|integer|min:2000|max:2030',
        ];
    }
}
