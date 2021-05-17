<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request){

        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas',
            'prodi' => 'required',
            'jurusan' => 'required',
            'fakultas' => 'required',
            'alamat' => 'required',
        ]);
            
        // dd($request->all());

        $mahasiswa = New Mahasiswa;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->prodi = $request->prodi;
        $mahasiswa->jurusan = $request->jurusan;
        $mahasiswa->fakultas = $request->fakultas;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->save();

        return response()->json([
            'massage' => 'Mahasiswa Berhasil ditambahkan!',
            'data_mahasiswa' => $mahasiswa
        ], 200);
    }

    function edit($id){
        $mahasiswa = Mahasiswa::find($id);
        return response()->json([
            'massage' => 'Success!',
            'data_mahasiswa' => $mahasiswa
        ], 200);
    }

    public function update(Request $request, $id){
        $mahasiswa = Mahasiswa::find($id);
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim,'.$mahasiswa->id,
        ]);
        $mahasiswa->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'jurusan' => $request->jurusan,
            'fakultas' => $request->fakultas,
            'alamat' => $request->alamat,
        ]);

        return response()->json([
            'massage' => 'Success!',
            'data_mahasiswa' => $mahasiswa
        ], 200);
    }

    public function delete($id){
        $mahasiswa = Mahasiswa::find($id)->delete();
        
        return response()->json([
            'massage' => 'Data Berhasil dihapus!',
        ], 200);
    }
}
