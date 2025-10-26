<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

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

        $result = $this->authService->login($request->only(['email', 'password']));

        if ($result['success']) {
            return redirect('/home');
        }

        return back()->withErrors([
            'email' => $result['message'],
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:6',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $this->authService->register($request->only(['name', 'nik', 'email', 'password']));

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

        $this->authService->completeProfile(Auth::id(), $request->only(['phone', 'nik', 'address', 'city']));

        return redirect('/home');
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
        $user = $this->authService->handleGoogleCallback();

        if (!$user->phone || !$user->nik || !$user->address || !$user->city) {
            return redirect()->route('profile.complete');
        }

        return redirect()->route('index');
    }
}
