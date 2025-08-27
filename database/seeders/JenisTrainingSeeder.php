<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisTraining;

class JenisTrainingSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kode' => 'GK', 'nama' => 'General Knowledge', 'deskripsi' => 'Pelatihan umum untuk karyawan'],
            ['kode' => 'MD', 'nama' => 'Mandatory', 'deskripsi' => 'Pelatihan wajib perusahaan'],
            ['kode' => 'CR', 'nama' => 'Customer Requested', 'deskripsi' => 'Pelatihan atas permintaan customer'],
            ['kode' => 'LS', 'nama' => 'Lisensi', 'deskripsi' => 'Pelatihan resmi dengan masa berlaku'],
        ];
        JenisTraining::insert($data);
    }
}
