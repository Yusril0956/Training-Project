<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in...
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication passed...
            return redirect('/home');
        }

        // Authentication failed...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
            'phone' => 'required|numeric|digits_between:10,15',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6', 
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'password' => bcrypt($request->password),
        ]);

        // Log the user in
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
