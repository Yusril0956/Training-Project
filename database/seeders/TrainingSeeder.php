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
            'category' => 'compliance',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 3,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan Kepatuhan Regulasi',
            'category' => 'compliance',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 3,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan pengelolaan Risiko',
            'category' => 'compliance',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 3,
            'status' => 'approved',
        ]);

        Training::updateOrCreate([
            'name' => 'Pelatihan Kepatuhan Regulasi',
            'category' => 'compliance',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 4,
            'status' => 'completed',
        ]);
    }
}
