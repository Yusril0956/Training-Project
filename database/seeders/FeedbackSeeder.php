<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_pengirim' => 'Rina',
                'pesan' => 'Sistem training sangat membantu, semoga terus dikembangkan.',
                'tanggal_kirim' => now()->subDays(1),
            ],
            [
                'nama_pengirim' => 'Andi',
                'pesan' => 'Mohon ditambahkan fitur reminder untuk jadwal pelatihan.',
                'tanggal_kirim' => now()->subDays(2),
            ],
            [
                'nama_pengirim' => 'Siti',
                'pesan' => 'Website sudah bagus, tapi loading agak lambat di mobile.',
                'tanggal_kirim' => now()->subDays(3),
            ],
            [
                'nama_pengirim' => 'Budi',
                'pesan' => 'Tampilan UI sangat menarik dan mudah digunakan.',
                'tanggal_kirim' => now()->subDays(4),
            ],
            [
                'nama_pengirim' => 'Dewi',
                'pesan' => 'Perlu ada fitur export data ke Excel.',
                'tanggal_kirim' => now()->subDays(5),
            ],
        ];

        Feedback::insert($data);
    }
}