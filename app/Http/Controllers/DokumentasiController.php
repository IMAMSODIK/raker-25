<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDokumentasiRequest;
use App\Http\Requests\UpdateDokumentasiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Dokumentasi Raker',
            'data' => Dokumentasi::all(),
        ];

        return view('dokumentasi.index', $data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'file.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096'
            ]);

            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('dokumentasi', $fileName, 'public');

                Dokumentasi::create([
                    'judul' => $request->judul,
                    'file' => $fileName
                ]);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Dokumentasi berhasil ditambahkan!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $data = Dokumentasi::findOrFail($id);

            if ($data->file && Storage::disk('public')->exists('dokumentasi/' . $data->file)) {
                Storage::disk('public')->delete('dokumentasi/' . $data->file);
            }

            $data->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Data dokumentasi berhasil dihapus!'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage()
            ], 500);
        }
    }
}
