<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tasks;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $trainingId = 1; // Ganti sesuai ID pelatihan yang sudah ada

        $tasks = [
            [
                'judul' => 'Analisis Risiko Operasional',
                'deskripsi' => 'Identifikasi dan analisis risiko dalam proses operasional pelatihan.',
                'deadline' => now()->addDays(3),
                'training_id' => $trainingId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Checklist Perawatan Harian',
                'deskripsi' => 'Isi checklist perawatan harian sesuai SOP yang berlaku.',
                'deadline' => now()->addDays(5),
                'training_id' => $trainingId,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'judul' => 'Evaluasi Prosedur Evakuasi',
                'deskripsi' => 'Tinjau ulang prosedur evakuasi dan berikan masukan.',
                'deadline' => now()->addDays(7),
                'training_id' => $trainingId,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
        ];

        Tasks::insert($tasks);
    }
}