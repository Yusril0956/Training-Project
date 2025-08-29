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

        // Pastikan folder avatars ada
        $avatarsPath = storage_path('app/public/avatars');
        if (!file_exists($avatarsPath)) {
            mkdir($avatarsPath, 0777, true);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'avatar_' . $user->id . '.' . $file->getClientOriginalExtension();

            // Coba upload dan cek hasilnya
            $result = $file->storeAs('avatars', $filename);
            if (!$result) {
                return redirect()->back()->with('error', 'Gagal upload file!');
            }

            $user->profile = 'storage/avatars/' . $filename;
            $user->save();

            return redirect()->back()->with('success', 'Avatar berhasil diubah!');
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan!');
        }
    }
    public function deleteAvatar(Request $request)
    {
        $user = auth::user();

        // hapus file lama jika ada
        if ($user->profile && file_exists(public_path($user->profile))) {
            unlink(public_path($user->profile));
        }

        // reset ke null / default
        $user->profile = null;

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
