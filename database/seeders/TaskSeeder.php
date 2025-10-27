<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tasks;
use App\Models\Training;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $trainings = Training::all();

        if ($trainings->isEmpty()) {
            return; // Skip if no trainings exist
        }

        foreach ($trainings as $training) {
            $taskCount = rand(2, 5); // Random number of tasks per training

            for ($i = 0; $i < $taskCount; $i++) {
                Tasks::create([
                    'title' => $faker->sentence(4),
                    'description' => $faker->paragraph(),
                    'deadline' => $faker->dateTimeBetween('now', '+2 weeks'),
                    'training_id' => $training->id,
                ]);
            }
        }
    }
}
