<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prodi;
use App\Models\Dosen;

class Pendaftar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'sekolah_asal',
        'prodi_id',
        'dosen_id',
        'foto',
        'dokumen'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

}

