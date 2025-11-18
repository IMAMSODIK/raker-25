<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;

class RegistrasiPesertaController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Registrasi Peserta',
            'data' => Peserta::where('jenis_peserta', 'peserta')->get(),
        ];

        return view('peserta.registrasi', $data);
    }

    public function getRegistrasi(Request $request)
    {
        $peserta = Peserta::findOrFail($request->id);

        return response()->json([
            'id' => $peserta->id,
            'time_registrasi' => $peserta->time_registrasi
        ]);
    }

    public function updateRegistrasi(Request $request, $id)
    {
        try {
            $peserta = Peserta::findOrFail($id);

            if ($request->status == 1) {
                $datetime = $request->tanggal . " " . $request->jam;

                $peserta->time_registrasi = $datetime;
            } else {
                $peserta->time_registrasi = null;
            }

            $peserta->save();

            return response()->json([
                'message' => 'Status registrasi berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
