<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;

class RegistrasiNarasumberController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Registrasi Narasumber',
            'data' => Peserta::where('jenis_peserta', 'narasumber')->get(),
        ];

        return view('narasumber.registrasi', $data);
    }
}
