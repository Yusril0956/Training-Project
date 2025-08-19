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
        User::updateOrCreate(
            ['email' => 'super_admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'role' => 'super_admin',
                'password' => bcrypt('123456'),
            ]
        );

        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'email_verified_at' => now(),
                'role' => 'admin',
                'password' => bcrypt('123456'),
            ]
        );

        // Create staff user
        User::updateOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name' => 'Staff Member',
                'email_verified_at' => now(),
                'role' => 'staff',
                'password' => bcrypt('123456'),
            ]
        );

        // Create regular user
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Regular User',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('123456'),
            ]
        );

        // Create additional users only if they don't exist
        if (User::count() < 15) {
            User::factory()->count(10)->create();
        }
    }
}
