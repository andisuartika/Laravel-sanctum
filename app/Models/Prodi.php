<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodi extends Model
{
    use HasFactory;

    public function mahasiswa()
        {
            return $this->hasMany(Mahasiswa::class, 'prodi_id');
        }
}
