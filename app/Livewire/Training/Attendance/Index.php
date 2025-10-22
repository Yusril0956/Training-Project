<?php

namespace App\Livewire\Training\Attendance;

use App\Models\Attendance;
use App\Models\AttendanceSession;
use App\Models\Training;
use App\Models\TrainingMember;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $trainingId;
    public $training;
    public $attendances;
    public $attendanceSessions;
    public $selectedSessionId = null;
    public $isAdmin = false;
    public $currentMember;

    // For creating new session
    public $showCreateSession = false;
    public $newSessionName = '';
    public $newSessionDate = '';
    public $newSessionStartTime = '';
    public $newSessionEndTime = '';
    public $newSessionDescription = '';

    public function mount($id)
    {
        $this->trainingId = $id;
        $this->loadData();
    }

    public function loadData()
    {
        $user = Auth::user();

        if ($user->hasAnyRole(['Admin', 'Super Admin'])) {
            $this->isAdmin = true;
            $this->training = Training::findOrFail($this->trainingId);
            $this->attendanceSessions = AttendanceSession::where('training_id', $this->trainingId)
                ->orderBy('date', 'desc')
                ->get();

            if ($this->selectedSessionId) {
                $this->attendances = Attendance::with('trainingMember.user', 'attendanceSession')
                    ->where('attendance_session_id', $this->selectedSessionId)
                    ->get();
            } else {
                $this->attendances = collect();
            }
        } else {
            $this->isAdmin = false;
            $this->training = Training::findOrFail($this->trainingId);
            $this->currentMember = TrainingMember::where('training_id', $this->trainingId)
                ->where('user_id', $user->id)
                ->first();

            $this->attendanceSessions = AttendanceSession::where('training_id', $this->trainingId)
                ->where('is_active', true)
                ->orderBy('date', 'desc')
                ->get();

            if ($this->currentMember) {
                if ($this->selectedSessionId) {
                    $this->attendances = Attendance::where('training_member_id', $this->currentMember->id)
                        ->where('attendance_session_id', $this->selectedSessionId)
                        ->get();
                } else {
                    $this->attendances = Attendance::where('training_member_id', $this->currentMember->id)
                        ->with('attendanceSession')
                        ->orderBy('date', 'desc')
                        ->get();
                }
            }
        }
    }

    public function selectSession($sessionId)
    {
        $this->selectedSessionId = $sessionId;
        $this->loadData();
    }

    public function createSession()
    {
        $this->validate([
            'newSessionName' => 'required|string|max:255',
            'newSessionDate' => 'required|date',
            'newSessionStartTime' => 'required|date_format:H:i',
            'newSessionEndTime' => 'required|date_format:H:i|after:newSessionStartTime',
        ]);

        AttendanceSession::create([
            'training_id' => $this->trainingId,
            'name' => $this->newSessionName,
            'date' => $this->newSessionDate,
            'start_time' => $this->newSessionStartTime,
            'end_time' => $this->newSessionEndTime,
            'description' => $this->newSessionDescription,
            'is_active' => true,
        ]);

        $this->reset(['showCreateSession', 'newSessionName', 'newSessionDate', 'newSessionStartTime', 'newSessionEndTime', 'newSessionDescription']);
        session()->flash('success', 'Sesi absensi berhasil dibuat.');
        $this->loadData();
    }

    public function activateSession($sessionId)
    {
        AttendanceSession::where('training_id', $this->trainingId)->update(['is_active' => false]);
        AttendanceSession::find($sessionId)->update(['is_active' => true]);
        session()->flash('success', 'Sesi absensi berhasil diaktifkan.');
        $this->loadData();
    }

    public function checkIn()
    {
        if (!$this->currentMember || !$this->selectedSessionId) {
            session()->flash('error', 'Pilih sesi absensi terlebih dahulu.');
            return;
        }

        $session = AttendanceSession::find($this->selectedSessionId);
        if (!$session || !$session->is_active) {
            session()->flash('error', 'Sesi absensi tidak aktif.');
            return;
        }

        $existing = Attendance::where('training_member_id', $this->currentMember->id)
            ->where('attendance_session_id', $this->selectedSessionId)
            ->first();

        if ($existing) {
            session()->flash('error', 'Anda sudah check in untuk sesi ini.');
            return;
        }

        Attendance::create([
            'training_member_id' => $this->currentMember->id,
            'attendance_session_id' => $this->selectedSessionId,
            'date' => $session->date,
            'check_in' => now()->format('H:i'),
            'status' => 'present',
        ]);

        session()->flash('success', 'Check in berhasil.');
        $this->loadData();
    }

    public function checkOut()
    {
        if (!$this->currentMember || !$this->selectedSessionId) {
            session()->flash('error', 'Pilih sesi absensi terlebih dahulu.');
            return;
        }

        $attendance = Attendance::where('training_member_id', $this->currentMember->id)
            ->where('attendance_session_id', $this->selectedSessionId)
            ->first();

        if (!$attendance) {
            session()->flash('error', 'Anda belum check in untuk sesi ini.');
            return;
        }

        if ($attendance->check_out) {
            session()->flash('error', 'Anda sudah check out untuk sesi ini.');
            return;
        }

        $attendance->update([
            'check_out' => now()->format('H:i'),
        ]);

        session()->flash('success', 'Check out berhasil.');
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.training.attendance.index')
            ->layout('layouts.training', ['title' => 'Absensi']);
    }
}
