<?php

namespace App\Models;

use App\Models\Prodi;
use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
