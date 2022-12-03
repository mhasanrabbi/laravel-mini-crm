<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // create permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'add client']);
        Permission::create(['name' => 'add project']);
        Permission::create(['name' => 'add task']);
        Permission::create(['name' => 'edit client']);
        Permission::create(['name' => 'edit project']);
        Permission::create(['name' => 'edit task']);
        Permission::create(['name' => 'delete client']);
        Permission::create(['name' => 'delete project']);
        Permission::create(['name' => 'delete task']);


        // create roles and assign permissions
        Role::create(['name' => 'admin'])->givePermissionTo(['manage users', 'add client', 'add project', 'add task', 'edit client', 'edit project', 'edit task', 'delete client', 'delete project', 'delete task']);
        Role::create(['name' => 'user'])->givePermissionTo(['edit client', 'edit project', 'edit task']);
    }
}