<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::with('prodi','jurusan')->latest()->get();
        return MahasiswaResource::collection($mahasiswa);
    }

    public function create(Request $request){

        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas',
            'prodi_id' => 'required',
            'jurusan_id' => 'required',
            'fakultas' => 'required',
            'alamat' => 'required',
        ]);
            
        // dd($request->all());

        $mahasiswa = New Mahasiswa;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->prodi_id = $request->prodi_id;
        $mahasiswa->jurusan_id = $request->jurusan_id;
        $mahasiswa->fakultas = $request->fakultas;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->save();

        return response()->json([
            'massage' => 'Mahasiswa Berhasil ditambahkan!',
            'data_mahasiswa' => $mahasiswa
        ], 200);
    }

    public function show(Mahasiswa $mahasiswa){
        return new MahasiswaResource($mahasiswa);
    }

    public function update(Request $request, Mahasiswa $mahasiswa){

        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'prodi_id' => 'required',
            'jurusan_id' => 'required',
            'fakultas' => 'required',
            'alamat' => 'required',
        ]);
        $mahasiswa->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'prodi_id' => $request->prodi_id,
            'jurusan_id' => $request->jurusan_id,
            'fakultas' => $request->fakultas,
            'alamat' => $request->alamat,
        ]);

        return response()->json([
            'massage' => 'Success!',
            'data_mahasiswa' => $mahasiswa
        ], 200);
    }

    public function destroy(Mahasiswa $mahasiswa){
        $mahasiswa->delete();
        return response()->json([
            'massage' => 'Data Berhasil dihapus!',
        ], 200);
    }
}
