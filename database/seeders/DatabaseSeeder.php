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
            TrainingMemberSeeder::class,
            AttendanceSessionSeeder::class,
            FeedbackSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
