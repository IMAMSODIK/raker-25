<?php

use App\Http\Controllers\AbsensiNarasumberController;
use App\Http\Controllers\AbsensiPesertaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KitController;
use App\Http\Controllers\MateriRapatController;
use App\Http\Controllers\NarasumberController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengaturanKamar;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\RegistrasiNarasumberController;
use App\Http\Controllers\RegistrasiPesertaController;
use App\Models\MateriRapat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $data = [
        'pageTitle' => 'Welcome',
        'peserta' => \App\Models\Peserta::with('kit')->get(),
        'materi' => MateriRapat::all(),
        'dokumentasi' => \App\Models\Dokumentasi::all(),
    ];

    return view('welcome', $data);
});

Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::post('/pendaftaran', [PendaftaranController::class, 'store']);

Route::get('/registrasi', function () {
    $data = [
        'pageTitle' => 'Registrasi Peserta',
    ];
    return view('errors.coming_soon', $data);
});

Route::get('/absensi', function () {
    $data = [
        'pageTitle' => 'Absensi Peserta',
    ];
    return view('errors.coming_soon', $data);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']); 

    Route::get('/data-kamar', [KamarController::class, 'index']);
    Route::get('/data-kamar/edit', [KamarController::class, 'edit']);
    Route::post('/data-kamar/store', [KamarController::class, 'store']);
    Route::post('/data-kamar/update', [KamarController::class, 'update']);
    Route::post('/data-kamar/delete', [KamarController::class, 'delete']);

    Route::get('/materi-raker', [MateriRapatController::class, 'index']);
    Route::post('/materi-raker/store', [MateriRapatController::class, 'store']);
    Route::post('/materi-raker/delete', [MateriRapatController::class, 'delete']);

    Route::get('/dokumentasi-raker', [DokumentasiController::class, 'index']);
    Route::post('/dokumentasi-raker/store', [DokumentasiController::class, 'store']);
    Route::post('/dokumentasi-raker/delete', [DokumentasiController::class, 'delete']);

    Route::get('/pengaturan-kamar', [PengaturanKamar::class, 'index']);
    Route::get('/pengaturan-kamar/edit', [PengaturanKamar::class, 'edit']);
    Route::post('/pengaturan-kamar/update', [PengaturanKamar::class, 'update']);
    Route::post('/pengaturan-kamar/kosongkan', [KamarController::class, 'kosongkan']);

    Route::get('/daftar-peserta', [PesertaController::class, 'index']);
    Route::get('/daftar-peserta/edit', [PesertaController::class, 'edit']);
    Route::post('/daftar-peserta/store', [PesertaController::class, 'store']);
    Route::post('/daftar-peserta/update/{id}', [PesertaController::class, 'update']);
    Route::post('/daftar-peserta/delete', [PesertaController::class, 'delete']);

    Route::get('/registrasi-peserta', [RegistrasiPesertaController::class, 'index']);
    Route::get('/peserta/get-registrasi', [RegistrasiPesertaController::class, 'getRegistrasi']);
    Route::post('/peserta/update-registrasi/{id}', [RegistrasiPesertaController::class, 'updateRegistrasi']);

    Route::get('/absensi-peserta', [AbsensiPesertaController::class, 'index']);
    Route::get('/absensi/get', [AbsensiPesertaController::class, 'getAbsensi']);
    Route::post('/absensi/update/{id}', [AbsensiPesertaController::class, 'updateAbsensi']);
    
    Route::get('/daftar-narasumber', [NarasumberController::class, 'index']);
    Route::get('/daftar-narasumber/edit', [NarasumberController::class, 'edit']);
    Route::post('/daftar-narasumber/store', [NarasumberController::class, 'store']);
    Route::post('/daftar-narasumber/update/{id}', [NarasumberController::class, 'update']);
    Route::post('/daftar-narasumber/delete', [NarasumberController::class, 'delete']);

    Route::get('/registrasi-narasumber', [RegistrasiNarasumberController::class, 'index']);
    Route::get('/absensi-narasumber', [AbsensiNarasumberController::class, 'index']);

    Route::get('/kit-peserta', [KitController::class, 'index']);
    Route::get('/kit-peserta/get', [KitController::class, 'edit']);
    Route::put('/kit-peserta/update/{id}', [KitController::class, 'update']);
    Route::put('/kit-peserta/reset/{id}', [KitController::class, 'resetKit']);

    Route::get('/registrasi-peserta/check', [RegistrasiPesertaController::class, 'registrasiCheck']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginCheck']);
});
