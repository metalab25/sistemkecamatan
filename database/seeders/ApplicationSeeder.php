<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        Application::create([
            'name' => 'Portal Desa Digital',
            'alias' => 'PDD',
            'address' => 'Jalan Pabean',
            'province_id' => '52',
            'phone' => '085239168707',
            'email' => 'metalabmetadata@gmail.com',
            'fonnte_key' => 'ZDgPqkqzomR48eZG1v1d',
            'order_no' => 8875,
            'ticket_no' => 67397,
            'updated_by' => '1',
        ]);
    }
}
