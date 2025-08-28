<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    { 
        return view('pages.home');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function admin()
    {
        $users = User::all();
        return view('pages.admin', compact('users'));
    }

    public function userUpdate(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->role === 'super_admin') {
                return redirect()->back()->with('error', 'Akun super admin tidak dapat diupdate!');
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->status = $request->status;
            $user->save();

            return redirect()->back()->with('success', 'User berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate user!');
        }
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
            'phone' => 'required|numeric|digits_between:10,15',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user,staff',
            'status' => 'required',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'status' => $request->status,
            ]);
            return redirect()->back()->with('success', 'User berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan user!');
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->role === 'super_admin') {
                return redirect()->back()->with('error', 'Akun super admin tidak dapat dihapus!');
            }
            $user->delete();
            return redirect()->back()->with('success', 'User berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus user!');
        }
    }

    public function inbox()
    {
        $feedback = Feedback::all();

        return view('pages.inbox', compact('feedback'));
    }

    public function feedback(Request $request)
    {
        $request->validate([
            'nama_pengirim' => 'required|string|max:100',
            'pesan' => 'required|string',
        ]);

        try {
            Feedback::create([
                'nama_pengirim' => $request->nama_pengirim,
                'pesan' => $request->pesan,
            ]);
            return redirect()->back()->with('success', 'Feedback berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim feedback!');
        }
    }
}
