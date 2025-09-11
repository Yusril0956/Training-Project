<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama biar tidak double
        Schedule::truncate();

        // Tambah jadwal training real
        Schedule::create([
            'training_id' => 1,
            'title' => 'Testing jadwal training',
            'date' => '2025-09-11',
            'start_time' => '09:00:00',
            'end_time' => '12:00:00',
            'location' => '404',
            'instructor' => 'Reqi',
        ]);

        Schedule::create([
            'training_id' => 2,
            'title' => 'Testing kedua',
            'date' => '2025-09-25',
            'start_time' => '13:00:00',
            'end_time' => '17:00:00',
            'location' => 'diklat',
            'instructor' => 'reqi',
        ]);
    }
}
