<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Get roles by code
        $superAdminRole = Role::where('code', 'SADM')->first(); // Super Admin
        $adminRole = Role::where('code', 'ADM')->first(); // Admin
        $userRole = Role::where('code', 'USR')->first(); // User

        if (!$superAdminRole || !$adminRole || !$userRole) {
            return; // Skip if roles don't exist
        }

        // Assign roles to specific users
        $users = [
            'super_admin@gmail.com' => $superAdminRole->id,
            'ryl@gmail.com' => $superAdminRole->id,
            'admin@gmail.com' => $adminRole->id,
            'reqi@gmail.com' => $adminRole->id,
            'user@gmail.com' => $userRole->id,
        ];

        foreach ($users as $email => $roleId) {
            $user = User::where('email', $email)->first();
            if ($user) {
                DB::table('user_roles')->updateOrInsert(
                    ['user_id' => $user->id, 'role_id' => $roleId],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }

        // Assign random roles to factory users
        $factoryUsers = User::whereNotIn('email', array_keys($users))->get();
        foreach ($factoryUsers as $user) {
            $randomRole = collect([$adminRole->id, $userRole->id])->random();
            DB::table('user_roles')->updateOrInsert(
                ['user_id' => $user->id, 'role_id' => $randomRole],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
