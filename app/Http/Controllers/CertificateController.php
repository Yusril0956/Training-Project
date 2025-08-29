<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Auth::user()->certificates;
        return response()->json($certificates);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:issue_date',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Maks 2MB
        ]);

        $path = $request->file('file')->store('certificates', 'public');

        $certificate = Certificate::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'organization' => $request->organization,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'file_path' => $path,
        ]);

        return response()->json([
            'message' => 'Sertifikat berhasil diunggah!',
            'certificate' => $certificate,
        ], 201);
    }
}