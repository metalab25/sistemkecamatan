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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kecamatan');
            $table->string('kode_kecamatan', 2);
            $table->string('alamat_kantor_camat');
            $table->string('kodepos');
            $table->string('telepon');
            $table->string('email')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->text('wilayah')->nullable();
            $table->string('nama_camat');
            $table->string('nip_camat');
            $table->string('telepon_camat')->nullable();
            $table->string('nama_kabupaten');
            $table->string('kode_kabupaten', 2);
            $table->string('nama_bupati');
            $table->string('nip_bupati');
            $table->foreignId('provinsi_id');
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
