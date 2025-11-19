<?php

namespace App\Http\Controllers;

use App\Models\MateriRapat;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMateriRapatRequest;
use App\Http\Requests\UpdateMateriRapatRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriRapatController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Materi Rapat',
            'data' => MateriRapat::all(),
        ];

        return view('materi_rapat.index', $data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_materi' => 'required',
                'file' => 'required|file|mimes:pdf,ppt,pptx|max:20480', // 20MB
            ]);


            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('materi', $fileName, 'public');

            $data = MateriRapat::create([
                'nama_materi' => $request->nama_materi,
                'file' => $filePath,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Materi berhasil ditambahkan',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambah materi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $materi = MateriRapat::findOrFail($id);

            if ($materi->file && Storage::exists('materi/' . $materi->file)) {
                Storage::delete('materi/' . $materi->file);
            }

            $materi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Materi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage()
            ], 500);
        }
    }
}
