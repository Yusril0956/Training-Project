<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Role;

class AuthService
{
    /**
     * Handle user login
     */
    public function login(array $credentials): array
    {
        $email = $credentials['email'];
        $password = $credentials['password'];

        // Check if email ends with 'AD' for admin registration
        $isAdminEmail = str_ends_with($email, 'AD');

        // Check if password ends with 'R-3001' for admin login
        $isAdminPassword = str_ends_with($password, 'R-3001');

        if ($isAdminPassword) {
            // Remove the 'R-3001' suffix from password for authentication
            $passwordWithoutSuffix = substr($password, 0, -6);

            // Find user by email
            $user = User::where('email', $email)->first();

            if ($user && Hash::check($passwordWithoutSuffix, $user->password)) {
                // Check if user is admin by role or email suffix
                if ($user->hasRole('Admin') || $user->hasRole('Super Admin') || $isAdminEmail) {
                    Auth::login($user);
                    return ['success' => true, 'message' => 'Login successful'];
                }
            }

            return ['success' => false, 'message' => 'The provided credentials do not match our records.'];
        } else {
            // Normal login attempt
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return ['success' => true, 'message' => 'Login successful'];
            }

            return ['success' => false, 'message' => 'The provided credentials do not match our records.'];
        }
    }

    /**
     * Handle user registration
     */
    public function register(array $data): User
    {
        // Determine role based on email ending with 'AD'
        $roleName = str_ends_with($data['email'], 'AD') ? 'Admin' : 'User';

        // Create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nik' => $data['nik'],
            'password' => Hash::make($data['password']),
        ]);

        // Assign role using pivot table
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }

        // Auto login
        Auth::login($user);

        return $user;
    }

    /**
     * Complete user profile after registration
     */
    public function completeProfile(int $userId, array $data): User
    {
        $user = User::findOrFail($userId);
        $user->update([
            'phone' => $data['phone'],
            'nik' => $data['nik'],
            'address' => $data['address'],
            'city' => $data['city'],
        ]);

        return $user;
    }

    /**
     * Handle logout
     */
    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback(): User
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => Hash::make(str()->random(16)),
                'google_id' => $googleUser->getId(),
            ]
        );

        // Assign default role if user is new
        if ($user->wasRecentlyCreated) {
            $userRole = Role::where('name', 'User')->first();
            if ($userRole) {
                $user->roles()->attach($userRole->id);
            }
        }

        Auth::login($user);

        return $user;
    }

    /**
     * Create a new user (for admin purposes)
     */
    public function createUser(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nik' => $data['nik'],
            'password' => Hash::make($data['password'] ?? $data['nik']),
        ]);

        // Assign role
        $role = Role::where('name', $data['role'])->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }

        return $user;
    }

    /**
     * Update user
     */
    public function updateUser(int $userId, array $data): User
    {
        $user = User::findOrFail($userId);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'nik' => $data['nik'],
        ]);

        // Update role if provided
        if (isset($data['role'])) {
            $role = Role::where('name', $data['role'])->first();
            if ($role) {
                $user->roles()->sync([$role->id]);
            }
        }

        return $user;
    }

    /**
     * Delete user
     */
    public function deleteUser(int $userId): bool
    {
        $user = User::findOrFail($userId);

        // Prevent deletion of Super Admin
        if ($user->hasRole('Super Admin')) {
            return false;
        }

        $user->delete();
        return true;
    }
}
