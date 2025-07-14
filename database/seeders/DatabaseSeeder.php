<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserRolePermissionSeeder::class,
            MenuSeeder::class,
            ProvinceSeeder::class,
            ApplicationSeeder::class,
        ]);
    }
}
