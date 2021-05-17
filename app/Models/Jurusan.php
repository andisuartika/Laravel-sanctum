<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;

    public function Mahasiswa(){

        return $this->hasMany(Mahasiswa::class, 'jurusan_id');
    } 
}
