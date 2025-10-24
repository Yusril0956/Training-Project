<?php

namespace App\Http\Controllers;

use App\Notifications\Notifications;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Certificate;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\ExternalCertificate;

class DashboardController extends Controller
{

    public function index()
    {
        return view('dashboard.index');
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
     * Display user notifications.
     */
    public function notification()
    {
        $user = Auth::user();
        $notifications = Notification::where('notifiable_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('dashboard.notifications', compact('notifications'));
    }



    /**
     * Display all feedback messages.
     */
    public function inbox()
    {
        $feedback = Feedback::paginate(10);

        return view('dashboard.inbox', compact('feedback'));
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

    /**
     * Display user's certificates and external certificates.
     */
    public function mysertifikat()
    {
        try {
            $user = Auth::user();

            // Ambil semua sertifikat milik user
            $certificates = Certificate::where('user_id', $user->id)
                ->with('training')
                ->paginate(12);

            $externalCertificates = ExternalCertificate::where('user_id', Auth::id())->latest()->paginate(6);

            return view('dashboard.mysertifikat', compact('certificates', 'externalCertificates'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading certificates: ' . $e->getMessage());
        }
    }

    public function settings()
    {
        $user = Auth::user();
        return view('dashboard.settings', compact('user'));
    }

    /**
     * Update user settings.
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email_notifications' => 'nullable|in:enabled,disabled',
        ]);

        try {
            User::where('id', $user->id)->update([
                'email_notifications' => $request->email_notifications,
            ]);

            return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan pengaturan!');
        }
    }

    /**
     * Export users as CSV.
     */
    public function exportUsers(Request $request)
    {
        $query = User::query()->with('roles');

        // Apply same filters as admin method
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $users = $query->get();

        // Create CSV content
        $filename = 'users_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ];

        $callback = function () use ($users) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'NIK',
                'Role',
                'Status',
                'Created At',
                'Updated At'
            ]);

            // CSV data
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->nik ?? '',
                    $user->roles->pluck('name')->first() ?? 'User',
                    $user->status,
                    $user->created_at->format('Y-m-d H:i:s'),
                    $user->updated_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
