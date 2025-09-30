<?php

namespace App\Http\Controllers;

use App\Models\ExternalCertificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ExternalCertificateController extends Controller
{
    public function index()
    {
        $certificates = ExternalCertificate::where('user_id', Auth::id())->latest()->paginate(12);
        return view('manual-certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('manual-certificates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'          => 'nullable|exists:users,id',
            'participant_name' => 'required|string|max:255',
            'activity_name'    => 'required|string|max:255',
            'activity_date'    => 'required|date',
            'certificate_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('certificate_file')) {
            $filePath = $request->file('certificate_file')->store('external_certificates', 'public');
        }

        $userId = $request->user_id ?? Auth::id();
        $status = $request->user_id ? 'approved' : 'pending';

        ExternalCertificate::create([
            'user_id'          => $userId,
            'participant_name' => $request->participant_name,
            'activity_name'    => $request->activity_name,
            'activity_date'    => $request->activity_date,
            'file_path'        => $filePath,
            'status'           => $status,
        ]);

        if ($request->user_id) {
            return redirect()->route('admin.index')->with('success', 'Sertifikat berhasil ditambahkan untuk user.');
        } else {
            return redirect()->route('mysertifikat')->with('success', 'Sertifikat berhasil ditambahkan dan menunggu persetujuan admin.');
        }
    }

    public function show(ExternalCertificate $certificate)
    {
        // Ensure user can only view their own certificates
        if ($certificate->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        return view('manual-certificates.show', compact('certificate'));
    }
}
