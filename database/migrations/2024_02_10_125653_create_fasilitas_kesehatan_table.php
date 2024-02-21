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
        Schema::create('fasilitas_kesehatan', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('UUID sebagai primarykey');
            $table->uuid('kategori_id');
            $table->string('nama_fasilitas',200)->comment('Nama Fasilitas Kesehatan');
            $table->string('alamat',200)->comment('Alamat Fasilitas');
            $table->string('kota',150)->comment('Kota tempat fasilitas berada');
            $table->string('propinsi',150)->comment('Propinsi tempat fasilitas berada');
            $table->string('kode_pos',10)->comment('Kode pos');
            $table->string('no_telp',20)->comment('Nomor Telepon');
            $table->string('email',150)->comment('Email');
            $table->string('latitude')->comment('Latitude untuk pemetaan');
            $table->string('longitude')->comment('Longitude untuk pemetaan');
            $table->string('foto',200)->nullable()->comment('Foto/Gambar fasilitas Kesehatan');

            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_kesehatan');
    }
};
