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
            'description' => 'Pelatihan kepemimpinan dalam manajemen risiko untuk meningkatkan kemampuan identifikasi dan mitigasi risiko operasional.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Human Factors',
            'description' => 'Pelatihan mengenai faktor manusia dalam operasi penerbangan untuk meningkatkan keselamatan dan efisiensi.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Software Engineering',
            'description' => 'Pelatihan rekayasa perangkat lunak untuk pengembangan sistem informasi dan aplikasi penerbangan.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Program S2 (MBA/TI)',
            'description' => 'Program magister bisnis dan teknologi informasi untuk pengembangan karir manajerial dan teknis.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Basic Aircraft',
            'description' => 'Pelatihan dasar mengenai struktur dan sistem pesawat terbang untuk teknisi pemeliharaan.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Teknik Presentasi & Dokumentasi',
            'description' => 'Pelatihan teknik presentasi efektif dan pembuatan dokumentasi teknis yang profesional.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Human Resources BP',
            'description' => 'Pelatihan manajemen sumber daya manusia untuk best practices dalam organisasi penerbangan.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Character Building',
            'description' => 'Pelatihan pembentukan karakter untuk meningkatkan etika kerja dan integritas profesional.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Analisa & Design System',
            'description' => 'Pelatihan analisis dan perancangan sistem untuk pengembangan solusi teknologi informasi.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Design Database',
            'description' => 'Pelatihan perancangan database untuk sistem informasi yang efisien dan terstruktur.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'English - Conversation',
            'description' => 'Pelatihan percakapan bahasa Inggris untuk komunikasi profesional dalam industri penerbangan.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'English - TOEFL Preparation',
            'description' => 'Persiapan ujian TOEFL untuk meningkatkan kemampuan bahasa Inggris akademik dan profesional.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Safety Management System',
            'description' => 'Pelatihan sistem manajemen keselamatan untuk implementasi praktik keselamatan di lingkungan kerja.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Training for Trainer',
            'description' => 'Pelatihan untuk menjadi instruktur yang efektif dalam penyampaian materi pelatihan.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Database (PL/SQL, ORACLE/POSTGRES, DLL)',
            'description' => 'Pelatihan database menggunakan PL/SQL, Oracle, PostgreSQL dan teknologi terkait lainnya.',
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
