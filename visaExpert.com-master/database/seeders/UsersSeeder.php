<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin
        $adminRole = Role::where('slug', UserType::ADMIN->toString())->first();
        User::updateOrCreate([
            'role_id' => $adminRole->id,
            'is_admin' => true,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '017111111111',
            'password' => Hash::make('password'),
            'status' => true,
            'is_deletable' => false,
        ]);

        // Create staff
        $staffRole = Role::where('slug', UserType::STAFF->toString())->first();
        User::updateOrCreate([
            'role_id' => $staffRole->id,
            'name' => 'Mr. Staff',
            'email' => 'staff@staff.com',
            'phone' => '0170000000',
            'password' => Hash::make('password'),
            'status' => true,
            'is_deletable' => false,
        ]);

        // Create agent
        $agentRole = Role::where('slug', UserType::AGENT->toString())->first();
        User::updateOrCreate([
            'role_id' => $agentRole->id,
            'name' => 'Mr. Agent',
            'email' => 'agent@agent.com',
            'phone' => '0171111111',
            'password' => Hash::make('password'),
            'status' => true,
            'is_deletable' => false,
        ]);
    }
}
