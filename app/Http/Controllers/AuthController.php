<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $result = $this->authService->login([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($result['success']) {
            return redirect('/home');
        } else {
            return back()->withErrors([
                'email' => $result['message'],
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

        try {
            $this->authService->register([
                'name' => $request->name,
                'nik' => $request->nik,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return redirect('/home');
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Registration failed: ' . $e->getMessage(),
            ]);
        }
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

        try {
            $this->authService->completeProfile(Auth::id(), [
                'phone' => $request->phone,
                'nik' => $request->nik,
                'address' => $request->address,
                'city' => $request->city,
            ]);

            return redirect('/home');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Profile completion failed: ' . $e->getMessage(),
            ]);
        }
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function googleCallback()
    {
        try {
            $user = $this->authService->handleGoogleCallback();

            if (!$user->phone || !$user->nik || !$user->address || !$user->city) {
                return redirect()->route('profile.complete');
            }

            return redirect()->route('index');
        } catch (\Exception $e) {
            return redirect('/')->withErrors([
                'error' => 'Google login failed: ' . $e->getMessage(),
            ]);
        }
    }
}
