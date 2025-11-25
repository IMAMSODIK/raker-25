<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index(){
        $data = [
            'pageTitle' => 'Registrasi',
            'data' => Peserta::orderBy('time_registrasi', 'DESC')->get(),
        ];

        return view('monitor.registrasi', $data);
    }

    public function absensi(Request $r){
        $data = [
            'pageTitle' => 'Absensi',
            'data' => Peserta::orderBy('time_absensi2', 'DESC')->get(),
        ];

        return view('monitor.absensi', $data);
    }
}
