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

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function admin()
    {
        $users = User::all();
        $assignments = Assignment::all(); // ✅ ambil semua tugas

        // data untuk modal
        $modalId = 'deleteUser';
        $modalTitle = 'Delete User';
        $modalDescription = 'Are you sure you want to delete this user?';
        $modalButton = 'Delete';
        $formMethod = 'DELETE';

        return view('pages.admin', compact(
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
        $notifications = Notification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('pages.notifikasi', compact('notifications'));
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

        return view('pages.inbox', compact('feedback'));
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
        return view('pages.admin-settings', compact('users'));
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


        return view('pages.history', compact('trainings', 'certificates', 'status', 'tGraduated'));
    }
}
