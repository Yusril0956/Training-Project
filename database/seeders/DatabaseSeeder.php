<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            UserRoleSeeder::class,
            JenisTrainingSeeder::class,
            TrainingSeeder::class,
            TrainingDetailSeeder::class,
            TrainingMemberSeeder::class,
            FeedbackSeeder::class,
            TaskSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}
