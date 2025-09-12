<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Training;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data while respecting foreign key constraints
        // Use different syntax for SQLite vs MySQL
        $connection = config('database.default');
        if ($connection === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
            Training::truncate();
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Training::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        Training::updateOrCreate([
            'name' => 'Pelatihan Sistem Avionik',
            'category' => 'technical',
            'description' => 'Pelatihan mengenai sistem avionik terbaru untuk teknisi.',
            'jenis_training_id' => 1,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan Keselamatan Kerja',
            'category' => 'safety',
            'description' => 'Pelatihan keselamatan kerja untuk karyawan lapangan.',
            'jenis_training_id' => 2,
            'status' => 'pending',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan Manajemen Proyek',
            'category' => 'leadership & management',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 3,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan Kepatuhan Regulasi',
            'category' => 'safety & compliance',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 3,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan pengelolaan Risiko',
            'category' => 'safety & compliance',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 3,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan Kepatuhan Regulasi',
            'category' => 'safety & compliance',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 4,
            'status' => 'completed',
        ]);

        Training::updateOrCreate([
            'name' => 'Risk Management Leadership',
            'category' => 'leadership & management',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Human Factors',
            'category' => 'safety & compliance',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Software Engineering',
            'category' => 'technical',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Program S2 (MBA/TI)',
            'category' => 'IT & Systems',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Basic Aircraft',
            'category' => 'technical',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Teknik Presentasi & Dokumentasi',
            'category' => 'soft skills',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Human Resources BP',
            'category' => 'leadership & management',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Character Building',
            'category' => 'soft skills',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Analisa & Design System',
            'category' => 'IT & Systems',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Design Database',
            'category' => 'IT & Systems',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'English - Conversation',
            'category' => 'soft skills',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'English - TOEFL Preparation',
            'category' => 'soft skills',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Safety Management System',
            'category' => 'safety & compliance',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Training for Trainer',
            'category' => 'leadership & management',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Database (PL/SQL, ORACLE/POSTGRES, DLL)',
            'category' => 'technical',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'approved',
        ]);

        // Call related seeders to populate linked data
        $this->call([
            TrainingDetailSeeder::class,
            TrainingMemberSeeder::class,
            MateriSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}
