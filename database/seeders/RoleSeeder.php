<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::updateOrInsert(['code' => 'ADM'], ['name' => 'Admin']);
        Role::updateOrInsert(['code' => 'SADM'], ['name' => 'Super Admin']);
        Role::updateOrInsert(['code' => 'USR'], ['name' => 'User']);
    }
}

