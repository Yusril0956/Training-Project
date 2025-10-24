<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training;
use App\Models\TrainingMember;
use App\Models\User;
use Faker\Factory as Faker;

class TrainingMemberSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (Training::all() as $training) {
            $users = User::inRandomOrder()->take(rand(2, 5))->get();

            foreach ($users as $user) {
                TrainingMember::create([
                    'training_id' => $training->id,
                    'user_id' => $user->id,
                    'status' => $faker->randomElement(['accept', 'pending']),
                    'series' => strtoupper($faker->bothify('TRN-####-??')),
                ]);
            }
        }
    }
}
