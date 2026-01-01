<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftar;

class Dosen extends Model
{
    use HasFactory;

    // Opsional tapi aman (hapus jika nama tabel sudah 'dosens')
    protected $table = 'dosens';

    protected $fillable = [
        'nama_dosen'
    ];

    /**
     * Relasi ke Pendaftar
     * Satu Dosen memiliki banyak Pendaftar
     */
    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class, 'dosen_id');
    }
}
