<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftar;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_prodi'];

    /**
     * Relasi ke Pendaftar
     * Satu Prodi bisa memiliki banyak Pendaftar
     */
    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class, 'prodi_id');
    }
}
