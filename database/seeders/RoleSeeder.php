<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_permissions = Permission::all();
        Role::updateOrCreate(['name' => 'Admin', 'slug' => 'admin', 'deletable' => false])
            ->permissions()
            ->sync($admin_permissions->pluck('id'));

        $staff_permissions = Permission::all();
        Role::updateOrCreate(['name' => 'Staff', 'slug' => 'staff', 'deletable' => false])
            ->permissions()
            ->sync($staff_permissions->pluck('id'));

        Role::updateOrCreate(['name' => 'Agent', 'slug' => 'agent', 'deletable' => false]);
    }
}
