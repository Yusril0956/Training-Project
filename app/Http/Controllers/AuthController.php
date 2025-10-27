<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Normal login attempt
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            // Assign role if not already assigned
            if (!$user->hasAnyRole(['Admin', 'Super Admin', 'User'])) {
                $roleName = 'User';
                if (in_array($user->email, ['admin@gmail.com', 'reqi@gmail.com'])) {
                    $roleName = 'Admin';
                } elseif (in_array($user->email, ['super_admin@gmail.com', 'ryl@gmail.com'])) {
                    $roleName = 'Super Admin';
                }

                // Assign role to user
                $role = Role::where('name', $roleName)->first();
                if ($role) {
                    $user->roles()->attach($role->id);
                }
            }

            return redirect('/home');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:users,nik',
            'phone' => 'required|numeric|digits_between:10,15',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Tentukan role sebagai User
        $roleName = 'User';

        // Cari role berdasarkan nama
        $role = Role::where('name', $roleName)->first();

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'password' => bcrypt($request->password),
        ]);

        // Assign role jika ditemukan
        if ($role) {
            $user->roles()->attach($role->id);
        }

        // Login otomatis
        Auth::login($user);

        return redirect('/home');
    }


    public function completeForm()
    {
        return view('auth.complete');
    }

    public function saveCompleteForm(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits_between:10,15',
            'nik' => 'required|numeric|digits:16',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        $user = User::find(Auth::id());
        $user->update([
            'phone' => $request->phone,
            'nik'   => $request->nik,
            'address' => $request->address,
            'city' => $request->city,
        ]);

        return redirect('/home');
    }

    public function logout(Request $request)
    {
        // logout handle
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
