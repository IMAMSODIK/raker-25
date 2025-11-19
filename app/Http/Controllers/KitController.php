<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKitRequest;
use App\Http\Requests\UpdateKitRequest;
use App\Models\Peserta;
use Illuminate\Http\Request;

class KitController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Kit Acara',
            'data' => Peserta::all(),
        ];

        return view('kit.index', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $peserta = Peserta::findOrFail($id);

            $peserta->update([
                'nama' => $request->nama,
                'nip'  => $request->nip,
            ]);

            // KIT
            $kit = Kit::firstOrCreate(['peserta_id' => $peserta->id]);

            $kit->update([
                'id_card' => $request->id_card,
                'topi'    => $request->topi,
                'baju'    => $request->baju,
                'tas'     => $request->tas,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Update gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        try {
            $peserta = Peserta::with('kit')->findOrFail($request->id);

            return response()->json($peserta);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }
    }

    public function resetKit($id)
    {
        try {

            $peserta = Peserta::findOrFail($id);

            // Cari data KIT peserta
            $kit = Kit::where('peserta_id', $peserta->id)->first();

            if ($kit) {
                $kit->update([
                    'id_card' => false,
                    'topi'    => false,
                    'baju'    => false,
                    'tas'     => false,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Kit berhasil direset.'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Reset gagal: ' . $e->getMessage()
            ], 500);
        }
    }
}
