<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FormController;
use App\Http\Controllers\API\MahasiswaController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('mahasiswa')->group(function(){
    Route::post('/create', [MahasiswaController::class, 'create']);
    Route::get('', [MahasiswaController::class, 'index']);
    Route::get('{mahasiswa:id}', [MahasiswaController::class, 'show'])->name('mahasiswa-show');
    Route::patch('{mahasiswa:id}/edit', [MahasiswaController::class, 'update']);
    Route::delete('{mahasiswa:id}/delete', [MahasiswaController::class, 'destroy']);
});


Route::get('/prodi', [ProdiController::class, 'index']);
Route::get('/jurusan', [JurusanController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('/mahasiswa/edit/{id}', [FormController::class, 'edit']);
    Route::post('/mahasiswa/edit/{id}', [FormController::class, 'update']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
