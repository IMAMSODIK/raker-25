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
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip', 20)->unique();
            $table->string('no_hp', 20)->unique();
            $table->string('pangkat');
            $table->string('jabatan');
            $table->string('satker');
            $table->date('tanggal_kedatangan')->nullable();
            $table->time('jam_kedatangan')->nullable();
            $table->string('maskapai')->nullable();
            $table->string('status_kamar')->nullable();
            $table->string('ukuran_baju')->nullable();
            $table->string('foto')->nullable();
            $table->string('ttd')->nullable();
            $table->string('jenis_peserta')->default('peserta');
            $table->foreignId('kamar_id')->nullable();
            $table->dateTime('time_registrasi')->nullable();
            $table->dateTime('time_absensi1')->nullable();
            $table->string('foto_absensi1')->nullable();
            $table->dateTime('time_absensi2')->nullable();
            $table->string('foto_absensi2')->nullable();
            $table->dateTime('time_absensi3')->nullable();
            $table->string('foto_absensi3')->nullable();
            $table->dateTime('time_absensi4')->nullable();
            $table->string('foto_absensi4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
