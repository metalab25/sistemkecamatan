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
        Schema::create('data_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->string('kode_desa')->unique();
            $table->string('kode_pos');
            $table->string('nama_kepala');
            $table->string('nip_kepala')->unique();
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('kode_kecamatan');
            $table->string('kabupaten');
            $table->string('kode_kabupaten');
            $table->string('kode_provinsi');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('path')->nullable();
            $table->string('telepon')->unique()->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_desa');
    }
};
