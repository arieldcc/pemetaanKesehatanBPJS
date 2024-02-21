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
        Schema::create('layanan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('fasilitas_kesehatan_id')->comment('ID Fasilitas kesehatan yang menyediakan layanan');
            $table->string('nama_layanan')->comment('Nama Layanan');
            $table->string('keterangan')->comment('Deskripsi Layanan');

            $table->foreign('fasilitas_kesehatan_id')->references('id')->on('fasilitas_kesehatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
