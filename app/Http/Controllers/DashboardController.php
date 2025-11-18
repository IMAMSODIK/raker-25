<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Dashboard',
            'countPeserta' => \App\Models\Peserta::count(),
            'countAbsensi1' => \App\Models\Peserta::whereNotNull('time_absensi1')->count(),
            'countAbsensi2' => \App\Models\Peserta::whereNotNull('time_absensi2')->count(),
            'countAbsensi3' => \App\Models\Peserta::whereNotNull('time_absensi3')->count(),
            'countAbsensi4' => \App\Models\Peserta::whereNotNull('time_absensi4')->count(),
            'countRegistrasi' => \App\Models\Peserta::whereNotNull('time_registrasi')->count(),
        ];

        return view('dashboard.index', $data);
    }
}
