<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftar;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = ['nama_dosen'];

    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class, 'dosen_id');
    }

    }
