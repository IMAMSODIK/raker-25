<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $peserta->time_absensi3 = $request->abs2 ? now() : null;
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

    public function absensiCheck()
    {
        $data = [
            'pageTitle' => 'Cek Absensi Peserta',
            'peserta' => Peserta::all(),
        ];
        return view('absensi.index', $data);
    }

    public function absensiCheckProccess(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'foto_absensi' => 'required',
        ]);

        $image = $request->foto_absensi;
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'absensi_' . time() . '.png';

        $peserta = Peserta::where('nip', $request->nip)->first();

        if ($peserta) {
            if($peserta->time_registrasi){
                Storage::disk('public')->put('absensi/' . $imageName, base64_decode($image));

                $peserta->time_absensi3 = now();
                $peserta->foto_absensi3 = $imageName;
                $peserta->save();

                return response()->json(['message' => 'Absensi berhasil']);
            }else{
                return response()->json(['message' => 'Silahkan registasi dahulu']);
            }
        }
    }
}
