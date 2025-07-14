<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        Province::create([
            'kode' => '11',
            'nama' => 'Aceh',
        ]);
        Province::create([
            'kode' => '12',
            'nama' => 'Sumatera Utara',
        ]);
        Province::create([
            'kode' => '13',
            'nama' => 'Sumatera Barat',
        ]);
        Province::create([
            'kode' => '14',
            'nama' => 'Riau',
        ]);
        Province::create([
            'kode' => '15',
            'nama' => 'Jambi',
        ]);
        Province::create([
            'kode' => '16',
            'nama' => 'Sumatera Selatan',
        ]);
        Province::create([
            'kode' => '17',
            'nama' => 'Bengkulu',
        ]);
        Province::create([
            'kode' => '18',
            'nama' => 'Lampung',
        ]);
        Province::create([
            'kode' => '19',
            'nama' => 'Kepulauan Bangka Belitung',
        ]);
        Province::create([
            'kode' => '21',
            'nama' => 'Kepulauan Riau',
        ]);
        Province::create([
            'kode' => '31',
            'nama' => 'DKI Jakarta',
        ]);
        Province::create([
            'kode' => '32',
            'nama' => 'Jawa Barat',
        ]);
        Province::create([
            'kode' => '33',
            'nama' => 'Jawa Tengah',
        ]);
        Province::create([
            'kode' => '34',
            'nama' => 'DI Yogyakarta',
        ]);
        Province::create([
            'kode' => '35',
            'nama' => 'Jawa Timur',
        ]);
        Province::create([
            'kode' => '36',
            'nama' => 'Banten',
        ]);
        Province::create([
            'kode' => '51',
            'nama' => 'Bali',
        ]);
        Province::create([
            'kode' => '52',
            'nama' => 'Nusa Tenggara Barat',
        ]);
        Province::create([
            'kode' => '53',
            'nama' => 'Nusa Tenggara Timur',
        ]);
        Province::create([
            'kode' => '61',
            'nama' => 'Kalimantan Barat',
        ]);
        Province::create([
            'kode' => '62',
            'nama' => 'Kalimantan Tengah',
        ]);
        Province::create([
            'kode' => '63',
            'nama' => 'Kalimantan Selatan',
        ]);
        Province::create([
            'kode' => '64',
            'nama' => 'Kalimantan Timur',
        ]);
        Province::create([
            'kode' => '65',
            'nama' => 'Kalimantan Utara',
        ]);
        Province::create([
            'kode' => '71',
            'nama' => 'Sulawesi Utara',
        ]);
        Province::create([
            'kode' => '72',
            'nama' => 'Sulawesi Tengah',
        ]);
        Province::create([
            'kode' => '73',
            'nama' => 'Sulawesi Selatan',
        ]);
        Province::create([
            'kode' => '74',
            'nama' => 'Sulawesi Tenggara',
        ]);
        Province::create([
            'kode' => '75',
            'nama' => 'Gorontalo',
        ]);
        Province::create([
            'kode' => '76',
            'nama' => 'Sulawesi Barat',
        ]);
        Province::create([
            'kode' => '81',
            'nama' => 'Maluku',
        ]);
        Province::create([
            'kode' => '82',
            'nama' => 'Maluku Utara',
        ]);
        Province::create([
            'kode' => '91',
            'nama' => 'Papua',
        ]);
        Province::create([
            'kode' => '92',
            'nama' => 'Papua Barat',
        ]);
    }
}
