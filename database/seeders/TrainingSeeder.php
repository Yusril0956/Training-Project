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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Training::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Training::create([
            'name' => 'Pelatihan Sistem Avionik',
            'category' => 'technical',
            'client' => 'PT Dirgantara Mitra',
            'description' => 'Pelatihan mengenai sistem avionik terbaru untuk teknisi.',
            'jenis_training_id' => 1,
            'status' => 'approved',
        ]);

        Training::create([
            'name' => 'Pelatihan Keselamatan Kerja',
            'category' => 'safety',
            'client' => 'PT Safety First',
            'description' => 'Pelatihan keselamatan kerja untuk karyawan lapangan.',
            'jenis_training_id' => 2,
            'status' => 'pending',
        ]);

        Training::create([
            'name' => 'Pelatihan Kepatuhan Regulasi',
            'category' => 'compliance',
            'client' => 'PT Compliance Corp',
            'description' => 'Pelatihan mengenai kepatuhan terhadap regulasi pemerintah terbaru.',
            'jenis_training_id' => 3,
            'status' => 'completed',
        ]);
    }
}
