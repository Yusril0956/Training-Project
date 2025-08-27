<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::insert([
            ['kode' => 'ADM', 'nama' => 'Admin'],
            ['kode' => 'USR', 'nama' => 'User'],
        ]);
    }
}

