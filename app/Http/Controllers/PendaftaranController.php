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
                'no_hp'         => 'required|digits_between:8,15|unique:pesertas,no_hp',
                'jabatan'       => 'required|string|max:255',
                'satker'        => 'required|string|max:255',
                'tanggal'       => 'nullable|date',
                'jam'           => 'nullable',
                'maskapai'      => 'nullable|string',
                'kamar'         => 'required|string',
                'ukuranBaju'    => 'required|string',
                'foto'          => 'required|image|mimes:jpg,jpeg,png|max:10000'
            ], [
                'nama.required'         => 'Nama wajib diisi.',

                'nip.required'          => 'NIP wajib diisi.',
                'nip.digits_between'    => 'NIP harus berisi antara 1 sampai 20 digit angka.',
                'nip.unique'            => 'NIP sudah terdaftar, gunakan NIP lain.',

                'no_hp.required'          => 'Nomor Handphone wajib diisi.',
                'no_hp.digits_between'    => 'Nomor Handphone harus berisi antara 8 sampai 15 digit angka.',
                'no_hp.unique'            => 'Nomor Handphone sudah terdaftar, gunakan Nomor Handphone lain.',

                'pangkat.required'      => 'Pangkat wajib dipilih.',
                'jabatan.required'      => 'Jabatan wajib diisi.',
                'satker.required'       => 'Satker wajib diisi.',
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
                'no_hp'               => $validated['no_hp'],
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
