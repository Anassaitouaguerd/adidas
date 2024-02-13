<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # Creating roles
        Role::create([
            'role' => 'super admin',
        ]);

        Role::create([
            'role' => 'client',
        ]);

        Role::create([
            'role' => 'admin',
        ]);

        # Creating a super admin user
        User::create([
            'name' => 'super admin',
            'email' => 'superAdmin@gmail.com',
            'password' => Hash::make('superadminpassword'),
            'role_id' => 1,
        ]);
    }
}
