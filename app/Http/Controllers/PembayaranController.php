<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Pembayaran',
            'data' => Peserta::where('jenis_peserta', 'peserta')->get(),
        ];

        return view('peserta.pembayaran', $data);
    }

    public function getPembayaran(Request $request)
    {
        $peserta = Peserta::findOrFail($request->id);

        return response()->json($peserta);
    }


    public function updatePembayaran(Request $request, $id)
    {
        try {
            $peserta = Peserta::findOrFail($id);

            if($peserta->time_registrasi){
                $foto = null;
                if ($request->hasFile('bukti_bayar')) {
                    $foto = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
                }

                $peserta->jumlah_malam = $request->jumlah_malam;
                $peserta->status_bayar = 1;
                $peserta->metode_bayar = $request->metode_bayar;
                $peserta->bukti_bayar = $foto;

                $peserta->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Absensi berhasil diperbarui'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Peserta belum melakukan registrasi'
                ]);
            }
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
