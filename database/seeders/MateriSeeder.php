<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\Training;
use Faker\Factory as Faker;

class MateriSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $trainings = Training::all();

        if ($trainings->isEmpty()) {
            return; // Skip if no trainings exist
        }

        $materialTypes = ['pdf', 'video', 'link', 'document'];

        foreach ($trainings as $training) {
            $materialCount = rand(1, 4); // Random number of materials per training

            for ($i = 0; $i < $materialCount; $i++) {
                $type = $faker->randomElement($materialTypes);

                // Generate appropriate URL based on type
                switch ($type) {
                    case 'pdf':
                        $url = 'storage/materi/' . $faker->slug(3) . '.pdf';
                        break;
                    case 'video':
                        $url = 'https://www.youtube.com/watch?v=' . $faker->regexify('[a-zA-Z0-9]{11}');
                        break;
                    case 'link':
                        $url = 'https://docs.' . $faker->domainName() . '/' . $faker->slug(2);
                        break;
                    case 'document':
                        $url = 'storage/materi/' . $faker->slug(3) . '.docx';
                        break;
                }

                Materi::create([
                    'title' => $faker->sentence(3),
                    'description' => $faker->paragraph(),
                    'media_type' => $type,
                    'media_path' => $url,
                    'training_id' => $training->id,
                ]);
            }
        }
    }
}
