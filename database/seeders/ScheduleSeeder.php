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

        // Hapus data lama biar tidak double
        Schedule::truncate();

        $trainings = Training::all();

        foreach ($trainings as $training) {
            $scheduleCount = rand(1, 3); // Random number of schedules per training

            for ($i = 0; $i < $scheduleCount; $i++) {
                Schedule::create([
                    'training_id' => $training->id,
                    'title' => $faker->sentence(4),
                    'date' => $faker->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
                    'start_time' => $faker->time('H:i:s'),
                    'end_time' => $faker->time('H:i:s'),
                    'location' => $faker->randomElement(['Ruang 404', 'Diklat', 'Online', 'Auditorium']),
                    'instructor' => $faker->name(),
                ]);
            }
        }
    }
}
