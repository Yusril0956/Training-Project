<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create super admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@gmail.com',
            'email_verified_at' => now(),
            'role' => 'super_admin',
            'password' => bcrypt('123456'),
        ]);

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => bcrypt('123456'),
        ]);

        // Create staff user
        User::create([
            'name' => 'Staff Member',
            'email' => 'staff@gmail.com',
            'email_verified_at' => now(),
            'role' => 'staff',
            'password' => bcrypt('123456'),
        ]);

        // Create regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'role' => 'user',
            'password' => bcrypt('123456'),
        ]);
    }
}
