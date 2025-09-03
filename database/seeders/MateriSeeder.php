<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;

class MateriSeeder extends Seeder
{
    public function run()
    {
        $trainingId = 1; // Ganti sesuai ID pelatihan yang sudah ada

        $data = [
            [
                'judul' => 'Panduan Perawatan CN235',
                'deskripsi' => 'Dokumen PDF berisi prosedur teknis perawatan pesawat CN235.',
                'tipe' => 'pdf',
                'url' => 'storage/materi/cn235-panduan.pdf',
                'training_id' => $trainingId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Video Simulasi Evakuasi',
                'deskripsi' => 'Video pelatihan evakuasi darurat untuk teknisi lapangan.',
                'tipe' => 'video',
                'url' => 'https://www.youtube.com/watch?v=example123',
                'training_id' => $trainingId,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'judul' => 'Checklist Audit ISO 9001',
                'deskripsi' => 'Checklist kepatuhan untuk audit internal ISO.',
                'tipe' => 'link',
                'url' => 'https://docs.example.com/audit-checklist',
                'training_id' => $trainingId,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
        ];

        Materi::insert($data);
    }
}