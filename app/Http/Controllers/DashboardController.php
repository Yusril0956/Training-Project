<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    { 
        return view('index');
    }

    public function training()
    {
        return view('pages.users');
    }

    public function admin()
    {
        $users = User::all();
        return view('pages.admin', compact('users'));
    }

    public function music()
    {
        return view('pages.music');
    }

    public function setting()
    {
        $user = Auth::user();
        return view('pages.setting', compact('user'));
    }

    public function test()
    {
        return view('test');
    }

    public function userEdit()
    {
        return view('user.edit');
    }
}
