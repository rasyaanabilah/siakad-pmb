<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftar;

class Prodi extends Model
{
    use HasFactory;

    // Jika nama tabel BUKAN "prodis", aktifkan baris ini
    // protected $table = 'prodi';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_prodi'
    ];

    /**
     * Relasi ke Pendaftar
     * Satu Prodi memiliki banyak Pendaftar
     */
    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class, 'prodi_id');
    }
}
