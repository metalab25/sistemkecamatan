<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $defautl_user_value = [
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'status' => 1,
        ];

        $admin = User::create(array_merge([
            'name'      => 'Admin',
            'username'  => 'admin',
            'email'     => 'admin@begawe.com',
        ], $defautl_user_value));

        $operator = User::create(array_merge([
            'name'      => 'Operator',
            'username'  => 'operator',
            'email'     => 'operator@begawe.com',
        ], $defautl_user_value));

        $role_admin     = Role::create(['name' => 'Administrator']);
        $role_operator  = Role::create(['name' => 'Operator']);

        $permission = Permission::create(['name' => 'settings read', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'applications read', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'applications update', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'applications deleteLogo', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'menus read', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'menus create', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'menus update', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'menus delete', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'menus status', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'roles read', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'roles create', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'roles update', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'roles delete', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'permission read', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'permission create', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'permission update', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'permission delete', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'users read', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'users create', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'users update', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'users delete', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'users status', 'guard_name' => 'web']);

        $role_admin->givePermissionTo('settings read');
        $role_admin->givePermissionTo('applications read');
        $role_admin->givePermissionTo('applications update');
        $role_admin->givePermissionTo('applications deleteLogo');
        $role_admin->givePermissionTo('menus read');
        $role_admin->givePermissionTo('menus create');
        $role_admin->givePermissionTo('menus update');
        $role_admin->givePermissionTo('menus delete');
        $role_admin->givePermissionTo('menus status');
        $role_admin->givePermissionTo('roles read');
        $role_admin->givePermissionTo('roles create');
        $role_admin->givePermissionTo('roles update');
        $role_admin->givePermissionTo('roles delete');
        $role_admin->givePermissionTo('permission read');
        $role_admin->givePermissionTo('permission create');
        $role_admin->givePermissionTo('permission update');
        $role_admin->givePermissionTo('permission delete');
        $role_admin->givePermissionTo('users read');
        $role_admin->givePermissionTo('users create');
        $role_admin->givePermissionTo('users update');
        $role_admin->givePermissionTo('users delete');
        $role_admin->givePermissionTo('users status');

        $admin->givePermissionTo('settings read');
        $admin->givePermissionTo(['applications read', 'applications update', 'applications deleteLogo']);
        $admin->givePermissionTo(['menus read', 'menus create', 'menus update', 'menus delete', 'menus status']);
        $admin->givePermissionTo(['roles read', 'roles create', 'roles update', 'roles delete']);
        $admin->givePermissionTo(['users read', 'users create', 'users update', 'users delete', 'users status']);

        $admin->assignRole('Administrator');
        $operator->assignRole('Operator');
    }
}
