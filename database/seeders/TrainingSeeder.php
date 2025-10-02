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
            'name' => 'Software Requirements Analyst & Design (SA)',
            'description' => 'entah deskripsi nya apa',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Mastering Linux & Shell Programming',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'CompTIA Network+',
            'description' => 'entah deskripsi nya apa',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Certified Ethical Hacker (CEH)',
            'description' => 'entah deskripsi nya apa',
            'jenis_training_id' => 3,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Computer Hacking Forensics Investigator (CHFI)',
            'description' => 'entah deskripsi nya apa',
            'jenis_training_id' => 3,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Secure Programming - Open Worldwide Security Project (OWASP)',
            'description' => 'entah deskripsi nya apa',
            'jenis_training_id' => 3,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Privacy and Data Protection Foundation',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 4,
            'status' => 'close',
        ]);

        Training::updateOrCreate([
            'name' => 'Risk Management Leadership',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Image & Video Forensic',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'MacOS Forensic',
            'description' => 'entah deskripsi nya apa',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Digital Leadership',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Leadership for the Digital Age',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Certified Cloud Security Professional (CCSP)',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 1,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Software Requirements Analysis',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Analisa & Design System',
            'description' => 'entah deskripsi nya apa',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'SAP S/4HANA Overview, Business Process Mapping, SAP Enterprise Structure',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'SAP Module-Specific Training ',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Requirement Management, Business Process Documentation, Change & Release Management',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'pelatihan sertifikasi ABAP',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Front-End Fundamental, Front-End Framework & Library',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Database (PL/SQL, ORACLE/POSTGRES, DLL)',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 2,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Back-End Fundamental (Node.js, Python, Java, PHP)',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 4,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => 'Pengembangan Full-Stack (MERN Stack, MEAN Stack)',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 4,
            'status' => 'open',
        ]);

        Training::updateOrCreate([
            'name' => ' DevOps & Cloud',
            'description' => 'entah deskripsi nya apa.',
            'jenis_training_id' => 4,
            'status' => 'close',
        ]);

        Training::updateOrCreate([
            'name' => 'Fundamental QA dan Pengujian Manual',
            'description' => 'entah deskripsi nya apa.',
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
