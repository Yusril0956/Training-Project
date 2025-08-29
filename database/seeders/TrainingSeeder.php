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

        foreach (range(1, 5) as $i) {
            Training::create([
                'nama' => $faker->sentence(3),
                'kategori' => fake()->word(),
                'klien' => $faker->company(),
                'deskripsi' => $faker->paragraph(),
                'jenis_training_id' => JenisTraining::inRandomOrder()->first()->id,
            ]);
        }
    }
}
