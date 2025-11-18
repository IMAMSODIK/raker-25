<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;

class AbsensiNarasumberController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Absensi Narasumber',
            'data' => Peserta::where('jenis_peserta', 'narasumber')->get(),
        ];

        return view('narasumber.absensi', $data);
    }
}
