<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileService
{
    /**
     * Update user profile
     */
    public function updateProfile(int $userId, array $data): User
    {
        $user = User::findOrFail($userId);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'nik' => $data['nik'],
        ]);

        return $user;
    }

    /**
     * Update user password
     */
    public function updatePassword(int $userId, string $password): User
    {
        $user = User::findOrFail($userId);

        $user->update([
            'password' => Hash::make($password),
        ]);

        return $user;
    }

    /**
     * Update user avatar
     */
    public function updateAvatar(int $userId, $avatarFile): User
    {
        $user = User::findOrFail($userId);

        $filename = 'avatar_' . $user->id . '.' . $avatarFile->getClientOriginalExtension();
        $path = $avatarFile->storeAs('avatars', $filename, 'public');

        if (!$path) {
            throw new \Exception('Failed to upload file');
        }

        $user->update([
            'avatar_url' => 'storage/avatars/' . $filename,
        ]);

        return $user;
    }

    /**
     * Delete user avatar
     */
    public function deleteAvatar(int $userId): User
    {
        $user = User::findOrFail($userId);

        // Delete old file if exists
        if ($user->avatar_url) {
            $filePath = str_replace('storage/', 'app/public/', $user->avatar_url);
            $fullPath = storage_path($filePath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        $user->update([
            'avatar_url' => null,
        ]);

        return $user;
    }
}
