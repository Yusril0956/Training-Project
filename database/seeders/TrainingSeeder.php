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
            'description' => 'Pelatihan mengenai sistem avionik terbaru untuk teknisi.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan Keselamatan Kerja',
            'description' => 'Pelatihan keselamatan kerja untuk karyawan lapangan.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan Manajemen Proyek',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 3,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan Kepatuhan Regulasi',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 3,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan pengelolaan Risiko',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 3,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan Kepatuhan Regulasi',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 4,
            'status' => 'close',
        ]);

        Training::updateOrCreate([
            'name' => 'Risk Management Leadership',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Human Factors',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Software Engineering',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Program S2 (MBA/TI)',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Basic Aircraft',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Teknik Presentasi & Dokumentasi',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Human Resources BP',
            'description' => '',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Character Building',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Analisa & Design System',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Design Database',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'English - Conversation',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'English - TOEFL Preparation',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Safety Management System',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Training for Trainer',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Database (PL/SQL, ORACLE/POSTGRES, DLL)',
            'description' => '',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Lisensi Pilot Komersial',
            'description' => 'Pelatihan untuk mendapatkan lisensi pilot komersial.',
            'jenis_training_id' => 4,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Lisensi Maintenance Pesawat',
            'description' => 'Pelatihan untuk lisensi maintenance pesawat terbang.',
            'jenis_training_id' => 4,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Lisensi Air Traffic Controller',
            'description' => 'Pelatihan untuk lisensi pengendali lalu lintas udara.',
            'jenis_training_id' => 4,
            'status' => 'close',
        ]);

        Training::updateOrCreate([
            'name' => 'Lisensi Dispatcher Udara',
            'description' => 'Pelatihan untuk lisensi dispatcher operasi penerbangan.',
            'jenis_training_id' => 4,
            'status' => 'close',
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
