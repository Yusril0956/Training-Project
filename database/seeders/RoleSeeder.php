<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::insert([
            ['code' => 'ADM', 'name' => 'Admin'],
            ['code' => 'USR', 'name' => 'User'],
        ]);
    }
}

