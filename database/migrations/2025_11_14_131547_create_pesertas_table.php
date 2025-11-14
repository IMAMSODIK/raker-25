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
            $table->string('pangkat');
            $table->string('jabatan');
            $table->string('satker');
            $table->date('tanggal_kedatangan');
            $table->time('jam_kedatangan');
            $table->string('maskapai');
            $table->string('status_kamar');
            $table->string('ukuran_baju');
            $table->string('foto')->nullable();
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
