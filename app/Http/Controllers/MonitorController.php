<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index(){
        $data = [
            'pageTitle' => 'Pembayaran',
            'data' => Peserta::all(),
        ];

        return view('monitor.registrasi', $data);
    }
}
