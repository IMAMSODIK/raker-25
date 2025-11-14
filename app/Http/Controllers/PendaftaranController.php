<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('pendaftaran.index');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama'          => 'required|string|max:255',
                'nip'           => 'required|digits_between:1,20|unique:pesertas,nip',
                'pangkat'       => 'required|string',
                'jabatan'       => 'required|string|max:255',
                'satker'        => 'required|string|max:255',
                'tanggal'       => 'required|date',
                'jam'           => 'required',
                'maskapai'      => 'required|string',
                'kamar'         => 'required|string',
                'ukuranBaju'    => 'required|string',
                'foto'          => 'required|image|mimes:jpg,jpeg,png|max:10000'
            ], [
                'nama.required'         => 'Nama wajib diisi.',

                'nip.required'          => 'NIP wajib diisi.',
                'nip.digits_between'    => 'NIP harus berisi antara 1 sampai 20 digit angka.',
                'nip.unique'            => 'NIP sudah terdaftar, gunakan NIP lain.',

                'pangkat.required'      => 'Pangkat wajib dipilih.',
                'jabatan.required'      => 'Jabatan wajib diisi.',
                'satker.required'       => 'Satker wajib diisi.',
                'tanggal.required'      => 'Tanggal kedatangan wajib diisi.',
                'jam.required'          => 'Jam kedatangan wajib diisi.',
                'maskapai.required'     => 'Maskapai wajib dipilih.',
                'kamar.required'        => 'Status kamar wajib dipilih.',
                'ukuranBaju.required'   => 'Ukuran baju wajib dipilih.',

                'foto.required'         => 'Foto wajib diupload.',
                'foto.image'            => 'File harus berupa gambar.',
                'foto.mimes'            => 'Format foto harus JPG, JPEG, atau PNG.',
                'foto.max'              => 'Ukuran foto maksimal 10MB.'
            ]);

            $fotoPath = null;

            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('uploads/foto_peserta', 'public');
            }

            Peserta::create([
                'nama'              => $validated['nama'],
                'nip'               => $validated['nip'],
                'pangkat'           => $validated['pangkat'],
                'jabatan'           => $validated['jabatan'],
                'satker'            => $validated['satker'],
                'tanggal_kedatangan' => $validated['tanggal'],
                'jam_kedatangan'    => $validated['jam'],
                'maskapai'          => $validated['maskapai'],
                'status_kamar'      => $validated['kamar'],
                'ukuran_baju'       => $validated['ukuranBaju'],
                'foto'              => $fotoPath
            ]);

            return redirect()->back()->with('success', 'Formulir berhasil dikirim!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan pada input Anda.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
