<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $setting = Menu::create([
            'name' => 'Settings',
            'url' => 'settings',
            'icon' => 'bi bi-sliders2',
            'parent' => null,
            'type' => 1,
            'status' => 1,
        ]);
        $setting->subMenus()->create([
            'name' => 'Application',
            'url' => 'settings/applications',
            'icon' => 'bi-gear',
            'type' => 2,
            'status' => 1,
        ]);
        $setting->subMenus()->create([
            'name' => 'Menu',
            'url' => 'settings/menus',
            'icon' => 'bi-menu-app',
            'type' => 2,
            'status' => 1,
        ]);
        $setting->subMenus()->create([
            'name' => 'Roles',
            'url' => 'settings/roles',
            'icon' => 'bi-collection',
            'type' => 2,
            'status' => 1,
        ]);
        $setting->subMenus()->create([
            'name' => 'Permission',
            'url' => 'settings/permission',
            'icon' => 'bi-check2-square',
            'type' => 2,
            'status' => 1,
        ]);
        $setting->subMenus()->create([
            'name' => 'Users',
            'url' => 'settings/users',
            'icon' => 'bi-people',
            'type' => 2,
            'status' => 1,
        ]);
    }
}
