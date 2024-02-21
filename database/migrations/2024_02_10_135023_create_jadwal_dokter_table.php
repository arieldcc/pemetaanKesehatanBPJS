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
        Schema::create('jadwal_dokter', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('dokter_id')->comment('ID Dokter');
            $table->string('hari',200)->comment('Hari dalam seminggu. misal: Senin s/d Jumat');
            $table->string('jam_mulai',20)->comment('Jam Mulai');
            $table->string('jam_selesai',20)->comment('Jam Selesai');

            $table->foreign('dokter_id')->references('id')->on('dokter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokter');
    }
};
