<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        return view('pages.Training.index');
    }

    public function customerRequested()
    {
        return view('pages.Training.customer_requested');
    }
}
