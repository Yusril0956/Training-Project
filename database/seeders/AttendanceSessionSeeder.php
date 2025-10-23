<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AttendanceSession;
use App\Models\Training;
use Carbon\Carbon;

class AttendanceSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $connection = config('database.default');
        if ($connection === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
            AttendanceSession::truncate();
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            AttendanceSession::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        $trainings = Training::all();

        foreach ($trainings as $training) {
            // Create 2-4 sessions per training
            $numSessions = rand(2, 4);

            for ($i = 0; $i < $numSessions; $i++) {
                $date = Carbon::now()->addDays(rand(0, 30)); // Random date within next 30 days

                AttendanceSession::create([
                    'training_id' => $training->id,
                    'title' => 'Sesi ' . ($i + 1) . ' - ' . $training->name,
                    'date' => $date,
                    'start_time' => '09:00',
                    'end_time' => '17:00',
                    'description' => 'Deskripsi untuk sesi pelatihan ' . ($i + 1) . ' dari ' . $training->name,
                ]);
            }
        }
    }
}
