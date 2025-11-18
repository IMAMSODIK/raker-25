<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;

class AbsensiPesertaController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Absensi Peserta',
            'data' => Peserta::where('jenis_peserta', 'peserta')->get(),
        ];

        return view('peserta.absensi', $data);
    }

    public function getAbsensi(Request $request)
    {
        $peserta = Peserta::findOrFail($request->id);

        return response()->json($peserta);
    }


    public function updateAbsensi(Request $request, $id)
    {
        try {

            $peserta = Peserta::findOrFail($id);

            $peserta->time_absensi1 = $request->abs1 ? now() : null;
            $peserta->time_absensi2 = $request->abs2 ? now() : null;
            $peserta->time_absensi3 = $request->abs3 ? now() : null;
            $peserta->time_absensi4 = $request->abs4 ? now() : null;

            $peserta->save();

            return response()->json([
                'message' => 'Absensi berhasil diperbarui'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
