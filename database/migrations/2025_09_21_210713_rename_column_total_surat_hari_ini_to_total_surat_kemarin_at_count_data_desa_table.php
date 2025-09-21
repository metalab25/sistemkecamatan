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
            $table->renameColumn('total_surat_hari_ini', 'total_surat_kemarin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('total_surat_kemarin_at_count_data_desa', function (Blueprint $table) {
            //
        });
    }
};
