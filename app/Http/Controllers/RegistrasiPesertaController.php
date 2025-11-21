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

    public function registrasiCheck()
    {
        $data = [
            'pageTitle' => 'Registrasi Peserta',
            'peserta' => Peserta::all(),
        ];

        return view('registrasi.index', $data);
    }

    public function registrasiCheckProccess(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'satker' => 'required',
            'tanda_tangan' => 'required',
        ], [
            'tanda_tangan.required' => 'Tanda tangan tidak boleh kosong.',
        ]);

        try {
            $peserta = Peserta::where('nip', $request->nip)->first();

            if (!$peserta) {
                return back()->with('error', 'Data peserta tidak ditemukan.');
            }

            // Folder simpan tanda tangan
            $folder = public_path('storage/ttd/');
            if (!file_exists($folder)) mkdir($folder, 0777, true);

            $ttdName = 'ttd_' . $peserta->nip . '.png';
            $ttdPath = $folder . $ttdName;

            // Simpan file dari base64
            $image = str_replace('data:image/png;base64,', '', $request->tanda_tangan);
            $image = str_replace(' ', '+', $image);

            file_put_contents($ttdPath, base64_decode($image));

            // Update peserta, simpan path ttd dan waktu registrasi
            $peserta->update([
                'time_registrasi' => now(),
                'ttd' => 'storage/ttd/' . $ttdName, // path relatif ke public
            ]);

            return back()->with('success', 'Registrasi berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
