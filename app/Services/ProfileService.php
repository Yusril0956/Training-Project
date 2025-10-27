<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Standar untuk file
use Illuminate\Support\Str; // Dibutuhkan untuk helper string
use App\Models\User;
use Illuminate\Http\UploadedFile; // Type-hint yang lebih baik

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
    // --- OPTIMALISASI: Gunakan type-hint UploadedFile ---
    public function updateAvatar(int $userId, UploadedFile $avatarFile): User
    {
        $user = User::findOrFail($userId);

        // --- OPTIMALISASI: Hapus avatar lama sebelum upload yang baru ---
        if ($user->avatar_url) {
            $oldPath = Str::after($user->avatar_url, 'storage/'); // Mendapat 'avatars/filename.jpg'
            Storage::disk('public')->delete($oldPath);
        }

        $filename = 'avatar_' . $user->id . '.' . $avatarFile->getClientOriginalExtension();
        $path = $avatarFile->storeAs('avatars', $filename, 'public');

        if (!$path) {
            throw new \Exception('Failed to upload file');
        }

        $user->update([
            // Tetap gunakan format ini agar konsisten dengan kode Anda
            'avatar_url' => 'storage/' . $path, 
        ]);

        return $user;
    }

    /**
     * Delete user avatar
     */
    public function deleteAvatar(int $userId): User
    {
        $user = User::findOrFail($userId);

        if ($user->avatar_url) {
            // --- PERBAIKAN: Gunakan Storage facade (cara standar) ---
            // 1. Dapatkan path relatif dari 'storage/avatars/...' -> 'avatars/...'
            $filePath = Str::after($user->avatar_url, 'storage/');

            // 2. Hapus file menggunakan disk 'public'
            Storage::disk('public')->delete($filePath);
        }

        $user->update([
            'avatar_url' => null,
        ]);

        return $user;
    }
}