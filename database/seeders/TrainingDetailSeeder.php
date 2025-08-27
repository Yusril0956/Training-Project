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
                'tanggal_awal' => $faker->dateTimeBetween('-1 year', 'now'),
                'tanggal_akhir' => $faker->dateTimeBetween('now', '+1 year'),
            ]);
        }
    }
}
