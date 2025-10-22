<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\JenisTraining;
use App\Models\User;
use App\Models\Tasks;
use App\Models\TrainingMember;
use App\Models\Notification;
use App\Models\Certificate;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TrainingAcceptedNotification;
use App\Notifications\TrainingRejectedNotification;
use App\Notifications\TrainingInvitationNotification;
use App\Notifications\TrainingGraduatedNotification;
use App\Notifications\TrainingKickedNotification;

class TrainingController extends Controller
{

    /**
     * Reject training request
     */
    public function reject($id)
    {
        $training = Training::findOrFail($id);
        $training->status = 'close';
        $training->save();
        return redirect()->back()->with('success', 'Training berhasil ditolak');
    }

    /**
     * Approve training request
     */
    public function approve($id)
    {
        $training = Training::findOrFail($id);
        $training->status = 'open';
        $training->save();
        return redirect()->back()->with('success', 'Training berhasil disetujui');
    }
}
