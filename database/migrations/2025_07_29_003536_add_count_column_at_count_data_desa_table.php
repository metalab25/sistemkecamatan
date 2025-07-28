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
        Schema::table('count_data_desa', function (Blueprint $table) {
            $table->integer('total_surat_minggu_ini');
            $table->integer('total_surat_minggu_lalu');
            $table->integer('total_surat_bulan_ini');
            $table->integer('total_surat_bulan_lalu');
            $table->integer('total_surat_tahun_ini');
            $table->integer('total_surat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
