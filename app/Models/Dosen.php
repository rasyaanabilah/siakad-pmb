<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = ['nama_dosen'];

    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class);
    }
}


