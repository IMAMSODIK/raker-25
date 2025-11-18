<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKamarRequest;
use App\Http\Requests\UpdateKamarRequest;
use App\Models\Peserta;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Dashboard',
            'data' => Kamar::with('peserta')->get(),
        ];

        return view('kamar.index', $data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'no_kamar' => 'required|unique:kamars,no_kamar'
            ]);

            Kamar::create([
                'no_kamar' => $request->no_kamar
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Kamar berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        try {
            $kamar = Kamar::findOrFail($id);
            return response()->json($kamar);
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
                'no_kamar' => "required|unique:kamars,no_kamar,$id"
            ]);

            $kamar = Kamar::findOrFail($id);
            $kamar->update([
                'no_kamar' => $request->no_kamar
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal update: ' . $e->getMessage()
            ], 500);
        }
    }

    public function kosongkan(Request $request)
    {
        try {
            $id = $request->id;
            $penghuni = Peserta::where('kamar_id', $id)->get();

            foreach ($penghuni as $p) {
                $p->kamar_id = null;
                $p->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'Kamar berhasil dikosongkan'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
