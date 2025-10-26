<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function profile()
    {
        // ambil data user yang sedang login
        $user = User::find(Auth::id());

        // kirim ke view
        return view('dashboard.profile', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6|same:password',
        ]);

        $this->profileService->updatePassword(Auth::id(), $request->password);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            try {
                $this->profileService->updateAvatar(Auth::id(), $request->file('avatar'));
                return redirect()->back()->with('success', 'Avatar berhasil diubah!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal upload file!');
            }
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan!');
        }
    }

    public function deleteAvatar(Request $request)
    {
        $this->profileService->deleteAvatar(Auth::id());

        return back()->with('success', 'Avatar berhasil dihapus.');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nik' => 'required|numeric|digits:6',
        ]);

        $this->profileService->updateProfile(Auth::id(), $request->only(['name', 'email', 'nik']));

        return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
    }
}
