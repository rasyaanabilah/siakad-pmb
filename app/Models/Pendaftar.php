<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'sekolah_asal',
        'prodi_id',
        'dokumen',
        'status'
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
