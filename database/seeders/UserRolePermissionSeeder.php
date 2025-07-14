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

        $permission = Permission::create(['name' => 'roles read', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'roles create', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'roles update', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'roles delete', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'permission read', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'permission create', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'permission update', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'permission delete', 'guard_name' => 'web']);



        $role_admin->givePermissionTo('roles read');
        $role_admin->givePermissionTo('roles create');
        $role_admin->givePermissionTo('roles update');
        $role_admin->givePermissionTo('roles delete');
        $role_admin->givePermissionTo('permission read');
        $role_admin->givePermissionTo('permission create');
        $role_admin->givePermissionTo('permission update');
        $role_admin->givePermissionTo('permission delete');

        $admin->assignRole('Administrator');
        $operator->assignRole('Operator');
    }
}
