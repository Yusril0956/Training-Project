<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrainingDetail;
use App\Models\TrainingMember;
use App\Models\User;
use Faker\Factory as Faker;

class TrainingMemberSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (TrainingDetail::all() as $detail) {
            $users = User::inRandomOrder()->take(rand(2, 5))->get();

            foreach ($users as $user) {
                TrainingMember::create([
                    'training_detail_id' => $detail->id,
                    'user_id' => $user->id,
                    'seri' => strtoupper($faker->bothify('TRN-####-??')),
                ]);
            }
        }
    }
}
