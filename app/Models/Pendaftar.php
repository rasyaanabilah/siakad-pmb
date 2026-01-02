<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\User;

class Pendaftar extends Model
{
    use HasFactory;
    
    // Aman jika nama tabel tidak standar
    protected $table = 'pendaftars';

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'sekolah_asal',
        'gender',
        'angkatan',
        'prodi_id',
        'dosen_id',
        'foto',
        'dokumen',
        'status',
    ];

    /**
     * Relasi ke Prodi
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    /**
     * Relasi ke Dosen
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
