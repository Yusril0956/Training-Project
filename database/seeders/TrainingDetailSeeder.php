<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training;
use App\Models\TrainingDetail;
use Faker\Factory as Faker;

class TrainingDetailSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (Training::all() as $training) {
            TrainingDetail::create([
                'training_id' => $training->id,
                'start_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'end_date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            ]);
        }
    }
}
