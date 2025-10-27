<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisTraining;

class JenisTrainingSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['code' => 'GK', 'name' => 'General Knowledge', 'description' => 'Pelatihan umum untuk karyawan'],
            ['code' => 'MD', 'name' => 'Mandatory', 'description' => 'Pelatihan wajib perusahaan'],
            ['code' => 'CR', 'name' => 'Customer Requested', 'description' => 'Pelatihan atas permintaan customer'],
            ['code' => 'LS', 'name' => 'Lisensi', 'description' => 'Pelatihan resmi dengan masa berlaku'],
        ];
        JenisTraining::insert($data);
    }

    
}
