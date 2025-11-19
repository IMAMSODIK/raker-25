<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {

            // Pastikan kolom bisa null (AMAN)
            $this->makeNullable($table, 'tanggal_kedatangan', 'date');
            $this->makeNullable($table, 'jam_kedatangan', 'time');
            $this->makeNullable($table, 'maskapai', 'string');
            $this->makeNullable($table, 'status_kamar', 'string');
            $this->makeNullable($table, 'ukuran_baju', 'string');
            $this->makeNullable($table, 'foto', 'string');

            // Tambah kolom baru jika belum ada
            if (!Schema::hasColumn('pesertas', 'jenis_peserta')) {
                $table->string('jenis_peserta')->default('peserta');
            }

            if (!Schema::hasColumn('pesertas', 'kamar_id')) {
                $table->foreignId('kamar_id')->nullable();
            }

            if (!Schema::hasColumn('pesertas', 'time_registrasi')) {
                $table->dateTime('time_registrasi')->nullable();
            }

            if (!Schema::hasColumn('pesertas', 'time_absensi1')) {
                $table->dateTime('time_absensi1')->nullable();
            }

            if (!Schema::hasColumn('pesertas', 'time_absensi2')) {
                $table->dateTime('time_absensi2')->nullable();
            }

            if (!Schema::hasColumn('pesertas', 'time_absensi3')) {
                $table->dateTime('time_absensi3')->nullable();
            }

            if (!Schema::hasColumn('pesertas', 'time_absensi4')) {
                $table->dateTime('time_absensi4')->nullable();
            }

            // Jika masih ada kolom lama yang tidak terpakai → hapus aman
            if (Schema::hasColumn('pesertas', 'time_kit')) {
                $table->dropColumn('time_kit');
            }
        });
    }

    private function makeNullable(Blueprint $table, string $col, string $type)
    {
        if (Schema::hasColumn('pesertas', $col)) {
            try {
                $table->{$type}($col)->nullable()->change();
            } catch (\Exception $e) {
                // Abaikan error jika kolom sudah nullable (Hostinger safe)
            }
        }
    }

    public function down()
    {
        Schema::table('pesertas', function (Blueprint $table) {
            // Tidak perlu drop kolom yang sudah digunakan
        });
    }
};
