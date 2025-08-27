<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training;
use App\Models\JenisTraining;
use Faker\Factory as Faker;

class TrainingSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $i) {
            Training::create([
                'nama' => $faker->sentence(3),
                'jenis_training_id' => JenisTraining::inRandomOrder()->first()->id,
            ]);
        }
    }
}
