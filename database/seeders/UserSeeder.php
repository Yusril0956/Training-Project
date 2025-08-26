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
                'phone' => '08123456789',
                'address' => 'Jalan Super Admin No. 1',
                'nik' => '1234567890123456',
                'city' => 'Jakarta',
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
                'phone' => '08123456789',
                'address' => 'Jalan Admin No. 1',
                'nik' => '1234567890123456',
                'city' => 'Jakarta',
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
                'phone' => '08123456789',
                'address' => 'Jalan Staff No. 1',
                'nik' => '1234567890123456',
                'city' => 'Palembang',
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
                'phone' => '08123456789',
                'address' => 'Jalan User No. 1',
                'nik' => '1234567890123456',
                'city' => 'Bandung',
                'role' => 'user',
                'password' => bcrypt('123456'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'reqi@gmail.com'],
            [
                'name' => 'reqi',
                'email_verified_at' => now(),
                'phone' => '08123456789',
                'address' => 'Jalan jalan No. 1',
                'nik' => '1234567890123456',
                'city' => 'Jakarta',
                'role' => 'super_admin',
                'password' => bcrypt('12345678'),
            ]
        );

        // Create additional users only if they don't exist
        if (User::count() < 15) {
            User::factory()->count(10)->create();
        }
    }
}
