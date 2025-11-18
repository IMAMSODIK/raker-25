<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Peserta;
use Illuminate\Http\Request;

class PengaturanKamar extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Pengaturan Kamar',
            'data' => Kamar::with('peserta')->get(),
        ];

        return view('pengaturan_kamar.index', $data);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        try {

            $kamar = Kamar::findOrFail($id);
            $peserta = Peserta::whereNull('kamar_id')
                        ->orWhere('kamar_id', $id)
                        ->orderBy('nama')
                        ->get();


            $penghuni = Peserta::where('kamar_id', $id)->get();
            $penghuni_ids = $penghuni->pluck('id');

            return response()->json([
                'kamar' => $kamar,
                'peserta' => $peserta,
                'penghuni_ids' => $penghuni_ids
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        try {

            $request->validate([
                'penghuni' => 'required|array|min:1|max:2'
            ]);

            // kosongkan kamar_id dari peserta yang sebelumnya menghuni kamar ini
            Peserta::where('kamar_id', $id)->update(['kamar_id' => null]);

            // update peserta baru
            Peserta::whereIn('id', $request->penghuni)
                ->update(['kamar_id' => $id]);

            return response()->json([
                'status' => true,
                'message' => 'Penghuni kamar berhasil diperbarui'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Gagal update: ' . $e->getMessage()
            ], 500);
        }
    }
}
