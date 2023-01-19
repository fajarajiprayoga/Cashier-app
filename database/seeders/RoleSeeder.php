<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = Role::create(['name' => 'super_admin']);
        $super_admin->givePermissionTo([
            'create admin',
            'update admin',
            'delete admin',
            'read admin',
            'create user',
            'update user',
            'delete user',
            'read user',
            'create menu',
            'update menu',
            'delete menu',
            'read menu',
            'setting website',
            'handle cashier',
            'handle transaction',
            'handle reporting',
        ]);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'create user',
            'update user',
            'delete user',
            'read user',
            'create menu',
            'update menu',
            'delete menu',
            'read menu',
            'setting website',
            'handle cashier',
            'handle transaction',
            'handle reporting',
        ]);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo([
            'can order'
        ]);
    }
}
