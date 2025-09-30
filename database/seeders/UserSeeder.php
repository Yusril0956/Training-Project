<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

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
                'nik' => '93827463810483',
                'city' => 'Jakarta',
                'avatar_url' => null,
                'password' => bcrypt('123456'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'ryl@gmail.com'],
            [
                'name' => 'Ryl',
                'email_verified_at' => now(),
                'phone' => '08123456789', // Fixed invalid phone number
                'address' => 'Jl. Moonrow',
                'nik' => '130928479294032',
                'city' => 'Gangnam',
                'avatar_url' => 'storage/avatars/avatar_2.jpg',
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
                'avatar_url' => null,
                'password' => bcrypt('123456'),
            ]
        );

        // Create staff user
        User::updateOrCreate(
            ['email' => 'miftahulyusril3@gmail.com'],
            [
                'name' => 'Zen User',
                'email_verified_at' => now(),
                'phone' => '08123456789',
                'address' => 'Jalan Staff No. 1',
                'nik' => '95726490294810',
                'city' => 'Palembang',
                'avatar_url' => null,
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
                'nik' => '95638298645129',
                'city' => 'Bandung',
                'avatar_url' => null,
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
                'nik' => '9473674829057364',
                'city' => 'Bandoeng',
                'avatar_url' => null,
                'password' => bcrypt('12345678'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'tumbal@gmail.com'],
            [
                'name' => 'Tumbal Proyek',
                'email_verified_at' => now(),
                'phone' => '08888888881',
                'address' => 'Jalan sekian dan terimakasih',
                'nik' => '363654',
                'city' => 'cikijing',
                'avatar_url' => null,
                'password' => bcrypt('123456'),
            ]
        );

        // Create additional users only if they don't exist
        if (User::count() < 15) {
            User::factory()->count(10)->create();
        }
    }
}
