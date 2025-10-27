<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile()
    {
        // ambil data user yang sedang login
        $user = User::find(Auth::id());

        // kirim ke view
        return view('pages.profile', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6|same:password',
        ]);

        $user = User::find(Auth::id());
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::find(Auth::id());

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'avatar_' . $user->id . '.' . $file->getClientOriginalExtension();

            // Store file using public disk for direct web access
            $path = $file->storeAs('avatars', $filename, 'public');

            if (!$path) {
                return redirect()->back()->with('error', 'Gagal upload file!');
            }

            // Save the public path for direct web access
            $user->avatar_url = 'storage/avatars/' . $filename;
            $user->save();

            return redirect()->back()->with('success', 'Avatar berhasil diubah!');
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan!');
        }
    }
    public function deleteAvatar(Request $request)
    {
        $user = Auth::user();

        // hapus file lama jika ada
        if ($user->avatar_url) {
            $filePath = str_replace('storage/', 'app/public/', $user->avatar_url);
            $fullPath = storage_path($filePath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        // reset ke null / default
        $user->avatar_url = null;
        $user->save();

        return back()->with('success', 'Avatar berhasil dihapus.');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
    }
}
