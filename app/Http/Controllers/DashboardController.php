<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\TrainingDetail;
use App\Models\Training;
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
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $users = $query->paginate(10);
        $assignments = Assignment::all(); // ✅ ambil semua tugas

        // data untuk modal
        $modalId = 'deleteUser';
        $modalTitle = 'Delete User';
        $modalDescription = 'Are you sure you want to delete this user?';
        $modalButton = 'Delete';
        $formMethod = 'DELETE';

        return view('admin.index', compact(
            'users',
            'assignments',   // ✅ kirim ke view
            'modalId',
            'modalTitle',
            'modalDescription',
            'modalButton',
            'formMethod'
        ));
    }

    public function tManage()
    {
        return view('pages.training-manage');
    }

    public function notification()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->get();

        return view('dashboard.notifications', compact('notifications'));
    }

    public function userUpdate(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->role === 'super_admin') {
                return redirect()->back()->with('error', 'Akun super admin tidak dapat diupdate!');
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->status = $request->status;
            $user->save();

            return redirect()->back()->with('success', 'User berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate user!');
        }
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:6',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user,staff',
            'status' => 'required',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nik' => $request->nik,
                'password' => $request->nik,
                'role' => $request->role,
                'status' => $request->status,
            ]);
            return redirect()->back()->with('success', 'User berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan user!');
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->role === 'super_admin') {
                return redirect()->back()->with('error', 'Akun super admin tidak dapat dihapus!');
            }
            $user->delete();
            return redirect()->back()->with('success', 'User berhasil dihapus!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'User tidak ditemukan!');
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->back()->with('error', 'Gagal menghapus user! ' . $error);
        }
    }

    public function inbox()
    {
        $feedback = Feedback::all();

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

    public function adminSettings()
    {
        $users = User::all();
        return view('admin.settings', compact('users'));
    }

    public function openAllAccess(Request $request)
    {
        // Logic to open all access - this could be a system setting or toggle
        // For now, we'll just return a success message
        return redirect()->back()->with('success', 'All access has been opened!');
    }

    public function deleteDatabase(Request $request)
    {
        // WARNING: This is a dangerous operation!
        // In a real application, you would want to add additional security measures
        // For now, we'll just return a warning message
        return redirect()->back()->with('warning', 'Database deletion is not implemented for safety reasons!');
    }

    public function resetUserPassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|string|min:6',
        ]);

        try {
            $user = User::findOrFail($id);
            if ($user->role === 'super_admin') {
                return redirect()->back()->with('error', 'Cannot reset super admin password!');
            }

            $newPassword = $request->new_password;
            $user->password = bcrypt($newPassword);
            $user->save();

            return redirect()->back()->with('success', 'Password for ' . $user->name . ' has been reset successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to reset password!');
        }
    }

    public function history()
    {
        $user = Auth::user();



        $trainings = Training::whereHas('members', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['members' => function ($q) use ($user) {
            $q->where('user_id', $user->id);
        }, 'detail'])->paginate(9);

        // training yang sudah lulus oleh user
        $tGraduated = Training::whereHas('members', function ($q) use ($user) {
            $q->where('user_id', $user->id)
                ->where('status', 'graduate');
        })->with(['members' => function ($q) use ($user) {
            $q->where('user_id', $user->id)
                ->where('status', 'graduate');
        }, 'detail'])->paginate(9);


        $certificates = $user->certificates;

        $member = $trainings->first()?->members->first();
        $status = $member ? $member->status : 'none';


        return view('dashboard.history', compact('trainings', 'certificates', 'status', 'tGraduated'));
    }

    public function mysertifikat()
    {
        $user = Auth::user();

        // Ambil semua sertifikat milik user
        $certificates = $user->certificates()->with('training')->paginate(9);

        $externalCertificates = ExternalCertificate::where('user_id', Auth::id())->latest()->paginate(12);

        return view('dashboard.mysertifikat', compact('certificates', 'externalCertificates'));
    }

    public function settings()
    {
        $user = Auth::user();
        return view('dashboard.settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email_notifications' => 'nullable|in:enabled,disabled',
        ]);

        try {
            $user->update([
                'email_notifications' => $request->email_notifications,
            ]);

            return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan pengaturan!');
        }
    }

    public function exportUsers(Request $request)
    {
        $query = User::query();

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

        $callback = function() use ($users) {
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
                    $user->role,
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
