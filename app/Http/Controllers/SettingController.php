<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        // ambil data user yang sedang login
        $user = Auth::user();

        // kirim ke view
        return view('pages.setting', compact('user'));
    }
}
