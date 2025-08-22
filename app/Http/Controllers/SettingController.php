<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// for syntax save
use App\Models\User;

class SettingController extends Controller
{
    public function index()
    {
        // ambil data user yang sedang login
        $user = User::find(Auth::id());

        // kirim ke view
        return view('pages.setting', compact('user'));
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
}
