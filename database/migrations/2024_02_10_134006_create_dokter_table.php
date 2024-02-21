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
        Schema::create('dokter', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('fasilitas_kesehatan_id')->comment('Fasilitas kesehatan tempat dokter bekerja');
            $table->string('nama_dokter',200)->comment('Nama Dokter');
            $table->string('spesialis',150)->comment('Spesialisasi Dokter');
            $table->string('no_telp',20)->comment('Nomer Telp Dokter');
            $table->string('email',150)->comment('Email Dokter');
            $table->string('foto',200)->nullable()->comment('Foto Dokter');

            $table->foreign('fasilitas_kesehatan_id')->references('id')->on('fasilitas_kesehatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
