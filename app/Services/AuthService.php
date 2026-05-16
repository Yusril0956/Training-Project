<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
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

        $throttleKey = 'login|'.strtolower($email).'|'.request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            return ['success' => false, 'message' => 'Too many login attempts. Please try again later.'];
        }

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            RateLimiter::clear($throttleKey);
            return ['success' => true, 'message' => 'Login successful'];
        }

        RateLimiter::hit($throttleKey, 60);
        return ['success' => false, 'message' => 'The provided credentials do not match our records.'];
    }

    /**
     * Handle user registration
     */
    public function register(array $data): User
    {
        $roleName = 'User';

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
        // If password not provided, generate a secure random password.
        $plainPassword = $data['password'] ?? Str::random(12);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nik' => $data['nik'],
            'password' => Hash::make($plainPassword),
        ]);

        // Assign role if provided, otherwise default to 'User'
        $roleName = $data['role'] ?? 'User';
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }

        // Send password reset link so the user can set their own password securely
        try {
            Password::sendResetLink(['email' => $user->email]);
        } catch (\Exception $e) {
            // Do not block user creation on email failures; log if logger available
            if (function_exists('logger')) {
                logger()->error('Failed to send password reset link: ' . $e->getMessage());
            }
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
