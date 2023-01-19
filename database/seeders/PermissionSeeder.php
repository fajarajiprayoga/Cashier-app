<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create admin']);
        Permission::create(['name' => 'update admin']);
        Permission::create(['name' => 'delete admin']);
        Permission::create(['name' => 'read admin']);

        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'read user']);

        Permission::create(['name' => 'create menu']);
        Permission::create(['name' => 'update menu']);
        Permission::create(['name' => 'delete menu']);
        Permission::create(['name' => 'read menu']);

        Permission::create(['name' => 'setting website']);
        Permission::create(['name' => 'handle cashier']);
        Permission::create(['name' => 'handle transaction']);
        Permission::create(['name' => 'handle reporting']);

        Permission::create(['name' => 'can order']);
    }
}
