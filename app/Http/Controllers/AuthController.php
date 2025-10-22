<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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

        // Check if email ends with 'AD' for admin registration
        $isAdminEmail = str_ends_with($email, 'AD');

        // Check if password ends with 'R-3001' for admin login
        $isAdminPassword = str_ends_with($password, 'R-3001');

        if ($isAdminPassword) {
            // Remove the 'R-3001' suffix from password for authentication
            $passwordWithoutSuffix = substr($password, 0, -6);

            // Find user by email
            $user = User::where('email', $email)->first();

            if ($user && password_verify($passwordWithoutSuffix, $user->password)) {
                // Check if user is admin by role or email suffix
                if ($user->role === 'admin' || $isAdminEmail) {
                    Auth::login($user);
                    return redirect('/home');
                }
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        } else {
            // Normal login attempt
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect('/home');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:6',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Tentukan role berdasarkan email yang diakhiri dengan 'AD'
        $role = str_ends_with($request->email, 'AD') ? 'admin' : 'user';

        // Buat user baru dan simpan role
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'password' => bcrypt($request->password),
            'role' => $role, // simpan role ke kolom 'role' di tabel users
        ]);

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
            'nik' => 'required|numeric|digits:6',
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

    public function googleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name'      => $googleUser->getName(),
                'password'  => bcrypt(str()->random(16)),
                'google_id' => $googleUser->getId(),
            ]
        );

        Auth::login($user);

        if (!$user->phone || !$user->nik || !$user->address || !$user->city) {
            return redirect()->route('profile.complete');
        }

        return redirect()->route('index');
    }
}
