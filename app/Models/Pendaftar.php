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

    protected $fillable = [
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    }
