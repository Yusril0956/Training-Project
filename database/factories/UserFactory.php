<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'nik' => $this->faker->numerify('################'),
            'city' => $this->faker->city(),
            'role' => 'user', // atau random dari ['user','admin','staff','super_admin']
            'status' => 1, // jika ada kolom status
        ];
    }
}
