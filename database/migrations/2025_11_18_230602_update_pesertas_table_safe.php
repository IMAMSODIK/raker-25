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
            if (Schema::hasColumn('pesertas', 'tanggal_kedatangan')) {
                $table->date('tanggal_kedatangan')->nullable()->change();
            }

            if (Schema::hasColumn('pesertas', 'jam_kedatangan')) {
                $table->time('jam_kedatangan')->nullable()->change();
            }

            if (Schema::hasColumn('pesertas', 'maskapai')) {
                $table->string('maskapai')->nullable()->change();
            }

            if (Schema::hasColumn('pesertas', 'status_kamar')) {
                $table->string('status_kamar')->nullable()->change();
            }

            if (Schema::hasColumn('pesertas', 'ukuran_baju')) {
                $table->string('ukuran_baju')->nullable()->change();
            }

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

            if (!Schema::hasColumn('pesertas', 'time_kit')) {
                $table->dateTime('time_kit')->nullable();
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_peserta',
                'kamar_id',
                'time_registrasi',
                'time_kit',
                'time_absensi1',
                'time_absensi2',
                'time_absensi3',
                'time_absensi4',
            ]);
        });
    }
};
