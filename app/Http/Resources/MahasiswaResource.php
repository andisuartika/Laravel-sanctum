<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'nim' => $this->nim,
            'prodi' => $this->prodi->nama,
            'prodi_id' => $this->prodi_id,
            'jurusan' => $this->jurusan->nama,
            'jurusan_id' => $this->jurusan_id,
            'fakultas' => $this->fakultas,
            'alamat' => $this->alamat,
            'link' => route('mahasiswa-show', $this->id),

        ];
    }
}
