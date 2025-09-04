<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\Training;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $trainings = Training::all();

        if ($trainings->isEmpty()) {
            return; // Skip if no trainings exist
        }

        foreach ($trainings as $training) {
            $scheduleCount = rand(3, 7); // Random number of schedule items per training

            for ($i = 0; $i < $scheduleCount; $i++) {
                $startTime = $faker->time('H:i');
                $endTime = date('H:i', strtotime($startTime) + rand(1, 3) * 3600); // 1-3 hours later

                Schedule::create([
                    'title' => $faker->sentence(3),
                    'date' => $faker->dateTimeBetween('now', '+2 weeks')->format('Y-m-d'),
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'location' => $faker->randomElement(['Ruang Zoom A', 'Ruang Zoom B', 'Ruang Meeting C', 'Online', 'Offline']),
                    'instructor' => $faker->name(),
                    'training_id' => $training->id,
                ]);
            }
        }
    }
}
