<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function music()
    {
        return view('pages.music');
    }
}
