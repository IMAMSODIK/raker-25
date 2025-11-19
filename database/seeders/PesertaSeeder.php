<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Ahmad Pratama',
                'nip' => '198701012022011001',
                'no_hp' => '081234567101',
                'pangkat' => 'Penata Muda',
                'jabatan' => 'Analis Kepegawaian',
                'satker' => 'Kanwil Kemenkumham Jakarta',
                'tanggal_kedatangan' => '2025-11-23',
                'jam_kedatangan' => '08:30:00',
                'maskapai' => 'Garuda Indonesia',
                'status_kamar' => 'Single',
                'ukuran_baju' => 'L',
                'foto' => 'foto1.jpg',
                'jenis_peserta' => 'peserta',
                'kamar_id' => null,
                'time_registrasi' => Carbon::now()->subHours(5),
                'time_absensi1' => Carbon::now()->subDays(3),
                'time_absensi2' => Carbon::now()->subDays(2),
                'time_absensi3' => null,
                'time_absensi4' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'Budi Santoso',
                'nip' => '198512032022011002',
                'no_hp' => '081234567102',
                'pangkat' => 'Penata',
                'jabatan' => 'Kasubbag Umum',
                'satker' => 'Lapas Tangerang',
                'tanggal_kedatangan' => '2025-11-23',
                'jam_kedatangan' => '10:15:00',
                'maskapai' => 'Lion Air',
                'status_kamar' => 'Double',
                'ukuran_baju' => 'XL',
                'foto' => 'foto2.jpg',
                'jenis_peserta' => 'peserta',
                'kamar_id' => null,
                'time_registrasi' => Carbon::now()->subHours(3),
                'time_absensi1' => Carbon::now()->subDays(3),
                'time_absensi2' => null,
                'time_absensi3' => null,
                'time_absensi4' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'Citra Dewi',
                'nip' => '199001142022011003',
                'no_hp' => '081234567103',
                'pangkat' => 'Penata Muda Tk I',
                'jabatan' => 'Pranata Humas',
                'satker' => 'Bapas Bandung',
                'tanggal_kedatangan' => '2025-11-22',
                'jam_kedatangan' => '14:00:00',
                'maskapai' => 'Citilink',
                'status_kamar' => 'Single',
                'ukuran_baju' => 'M',
                'foto' => 'foto3.jpg',
                'jenis_peserta' => 'peserta',
                'kamar_id' => null,
                'time_registrasi' => Carbon::now()->subHours(2),
                'time_absensi1' => null,
                'time_absensi2' => null,
                'time_absensi3' => null,
                'time_absensi4' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'Dedi Firmansyah',
                'nip' => '198402292022011004',
                'no_hp' => '081234567104',
                'pangkat' => 'Pembina',
                'jabatan' => 'Kepala Seksi Registrasi',
                'satker' => 'Rutan Depok',
                'tanggal_kedatangan' => '2025-11-22',
                'jam_kedatangan' => '09:45:00',
                'maskapai' => 'AirAsia',
                'status_kamar' => 'Double',
                'ukuran_baju' => 'L',
                'foto' => 'foto4.jpg',
                'jenis_peserta' => 'peserta',
                'kamar_id' => null,
                'time_registrasi' => null,
                'time_absensi1' => null,
                'time_absensi2' => null,
                'time_absensi3' => null,
                'time_absensi4' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'Eka Putri',
                'nip' => '199303052022011005',
                'no_hp' => '081234567105',
                'pangkat' => 'Penata Muda',
                'jabatan' => 'Staf TU',
                'satker' => 'Kanim Surabaya',
                'tanggal_kedatangan' => '2025-11-21',
                'jam_kedatangan' => '16:20:00',
                'maskapai' => 'Garuda Indonesia',
                'status_kamar' => 'Single',
                'ukuran_baju' => 'S',
                'foto' => 'foto5.jpg',
                'jenis_peserta' => 'peserta',
                'kamar_id' => null,
                'time_registrasi' => Carbon::now()->subHours(6),
                'time_absensi1' => Carbon::now()->subDays(3),
                'time_absensi2' => Carbon::now()->subDays(2),
                'time_absensi3' => Carbon::now()->subDay(),
                'time_absensi4' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('pesertas')->insert($data);
    }
}
