<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKitRequest;
use App\Http\Requests\UpdateKitRequest;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

            if($peserta->time_registrasi){
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
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Peserta belum registrasi.'
                ]);
            }
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

    public function exportPdf()
    {
        $pesertas = Peserta::with('kit')->get();

        $pdf = PDF::loadView('export.kit_pdf', [
            'pesertas' => $pesertas,
        ])->setPaper('a4', 'landscape'); // ⬅ landscape

        return $pdf->stream('daftar-penerimaan-kit.pdf');
    }

    public function exportPdfRegistrasi()
    {
        $pesertas = Peserta::all();

        $pdf = PDF::loadView('export.registrasi', [
            'pesertas' => $pesertas,
        ])->setPaper('a4', 'landscape'); // ⬅ landscape

        return $pdf->stream('daftar-registrasi-peserta.pdf');
    }

    public function exportPdfAbsensi()
    {
        $pesertas = Peserta::all();

        $pdf = PDF::loadView('export.absensi', [
            'pesertas' => $pesertas,
        ])->setPaper('a4', 'landscape'); // ⬅ landscape

        return $pdf->stream('daftar-absensi-peserta.pdf');
    }
}
