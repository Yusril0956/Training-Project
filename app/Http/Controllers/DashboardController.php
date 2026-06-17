<?php

namespace App\Http\Controllers;

use App\Notifications\Notifications;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Certificate;
use App\Models\Feedback;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\AttendanceExport;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\ExternalCertificate;

class DashboardController extends Controller
{

    public function index()
    {
        return view('dashboard.index');
    }

    public function feedback(Request $request)
    {
        $request->validate([
            'nama_pengirim' => 'required|string|max:100',
            'pesan' => 'required|string',
        ]);

        try {
            Feedback::create([
                'nama_pengirim' => $request->nama_pengirim,
                'pesan' => $request->pesan,
            ]);

            return redirect()->back()->with('success', 'Feedback berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim feedback!');
        }
    }

    public function terms()
    {
        return view('dashboard.terms');
    }

    public function admin(Request $request)
    {
        // Since user management is handled by Livewire, remove user query and modal data

        $certificates = ExternalCertificate::paginate(10);


        return view('admin.index', compact(
            'certificates'
        ));
    }

    /**
     * Accept an external certificate and notify the user.
     */
    public function acceptCertificate($externalCertificate)
    {
        try {
            $certificate = ExternalCertificate::findOrFail($externalCertificate);
            $certificate->update(['status' => 'approved']);

            $user = User::find($certificate->user_id);
            $user->notify(new \App\Notifications\acceptCertificateNotification($certificate));

            return redirect()->back()->with('success', 'Sertifikat berhasil diterima');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima sertifikat: ' . $e->getMessage());
        }
    }

    /**
     * Reject an external certificate and notify the user.
     */
    public function rejectCertificate($externalCertificate)
    {
        try {
            $certificate = ExternalCertificate::findOrFail($externalCertificate);
            $certificate->delete();

            $user = User::find($certificate->user_id);
            $user->notify(new \App\Notifications\rejectCertificateNotification($certificate));

            return redirect()->back()->with('success', 'Sertifikat berhasil ditolak');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak sertifikat: ' . $e->getMessage());
        }
    }











    /**
     * Export users as CSV.
     */
    public function exportUsers(Request $request)
    {
        $filename = 'users_export_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new UsersExport($request), $filename);
    }

    /**
     * Export attendance for a training (optionally filtered by session_id).
     */
    public function exportAttendance(Request $request, $trainingId)
    {
        $filename = 'attendance_export_' . $trainingId . '_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new AttendanceExport($trainingId, $request), $filename);
    }
}
