<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    public function run(): void
    {
        Config::create([
            'nama_kecamatan' => 'Gerung',
            'kode_kecamatan' => '01',
            'alamat_kantor_camat' => 'Jalan Gatot Subroto, Gerung Utara',
            'kodepos' => '83363',
            'telepon' => '03706184186',
            'nama_camat' => 'Sapoan, S.H',
            'nip_camat' => '111 111 1111 111',
            'telepon_camat' => '081272362532',
            'nama_kabupaten' => 'Lombok Barat',
            'kode_kabupaten' => '01',
            'nama_bupati' => 'Hasanudin, S.H',
            'nip_bupati' => '000 000 0000 000',
            'provinsi_id' => '52',
        ]);
    }
}
