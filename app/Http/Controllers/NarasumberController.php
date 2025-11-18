<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NarasumberController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Data Peserta',
            'data' => Peserta::where('jenis_peserta', 'narasumber')->get(),
        ];

        return view('narasumber.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:pesertas,nip',
            'no_hp' => 'required|string|max:20|unique:pesertas,no_hp',
            'pangkat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'satker' => 'required|string|max:255',
            'tanggal_kedatangan' => 'nullable|date',
            'jam_kedatangan' => 'nullable',
            'maskapai' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048'
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto_peserta', 'public');
        }

        Peserta::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'no_hp' => $request->no_hp,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'satker' => $request->satker,
            'tanggal_kedatangan' => $request->tanggal_kedatangan,
            'jam_kedatangan' => $request->jam_kedatangan,
            'maskapai' => $request->maskapai,
            'foto' => $foto,
            'jenis_peserta' => 'narasumber',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data peserta berhasil ditambahkan.'
        ]);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        try {
            $peserta = Peserta::findOrFail($id);

            return response()->json($peserta);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'nama' => 'required',
                'nip' => 'required',
                'no_hp' => 'required',
                'pangkat' => 'required',
                'jabatan' => 'required',
                'satker' => 'required',
                'foto' => 'nullable|image|max:2048'
            ]);

            $peserta = Peserta::findOrFail($id);

            // ====== Update Text Fields ======
            $peserta->nama = $request->nama;
            $peserta->nip = $request->nip;
            $peserta->no_hp = $request->no_hp;
            $peserta->pangkat = $request->pangkat;
            $peserta->jabatan = $request->jabatan;
            $peserta->satker = $request->satker;
            $peserta->tanggal_kedatangan = $request->tanggal_kedatangan;
            $peserta->jam_kedatangan = $request->jam_kedatangan;
            $peserta->maskapai = $request->maskapai;

            // ====== Jika Upload Foto Baru ======
            if ($request->hasFile('foto')) {

                // hapus foto lama jika ada
                if ($peserta->foto && Storage::disk('public')->exists($peserta->foto)) {
                    Storage::disk('public')->delete($peserta->foto);
                }

                // simpan foto baru mengikuti format store()
                $foto = $request->file('foto')->store('foto_peserta', 'public');

                $peserta->foto = $foto;
            }

            // save update
            $peserta->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diperbarui'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $peserta = Peserta::findOrFail($id);

            // Hapus foto jika ada
            if ($peserta->foto && Storage::disk('public')->exists($peserta->foto)) {
                Storage::disk('public')->delete($peserta->foto);
            }

            // Hapus record dari database
            $peserta->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data peserta berhasil dihapus.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Data peserta tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
