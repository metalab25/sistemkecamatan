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
        Schema::create('count_data_desa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_desa_id');
            $table->integer('total_penduduk');
            $table->integer('total_wilayah');
            $table->integer('total_keluarga');
            $table->integer('total_penduduk_lk');
            $table->integer('total_penduduk_pr');
            $table->integer('total_keluarga_lk');
            $table->integer('total_keluarga_pr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('count_data_desa');
    }
};
