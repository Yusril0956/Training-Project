<?php

namespace App\Livewire\Training\Attendance;

use App\Models\AttendanceRecord;
use App\Models\AttendanceSession;
use App\Models\Training;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.training', ['title' => 'Manajemen Absensi '])]
class ManageTrainingAttendance extends Component
{
    public Training $training;
    
    public ?AttendanceSession $activeSession = null;
    public $sessionId;

    public $attendanceData = [];

    // --- PERUBAHAN DI SINI ---
    /**
     * Mount komponen
     *
     * @param int|string $trainingId
     */
    public function mount($trainingId)
    {
        $this->training = Training::findOrFail($trainingId)->load('attendanceSessions');

        if ($this->training->attendanceSessions->isNotEmpty()) {
            $this->selectSession($this->training->attendanceSessions->first()->id);
        }
    }

    #[Computed]
    public function members()
    {
        return $this->training->members()->with('user')->get();
    }

    #[Computed]
    public function sessions()
    {
        return $this->training->attendanceSessions;
    }

    public function selectSession($id)
    {
        $this->sessionId = $id;
        $this->activeSession = AttendanceSession::find($id);
        $this->loadAttendanceData();
    }
    public function loadAttendanceData()
    {
        if (!$this->activeSession) {
            $this->attendanceData = [];
            return;
        }

        $records = AttendanceRecord::where('attendance_session_id', $this->activeSession->id)
            ->get()
            ->keyBy('training_member_id');

        $data = [];
        foreach ($this->members() as $member) {
            $record = $records->get($member->id);
            $data[$member->id] = [
                'status' => $record->status ?? 'absen', 
                'notes' => $record->notes ?? '',
            ];
        }
        $this->attendanceData = $data;
    }

    public function saveAttendance()
    {
        if (!$this->activeSession) {
            session()->flash('error', 'Silakan pilih sesi absensi terlebih dahulu.');
            return;
        }

        $this->validate([
            'attendanceData.*.status' => 'required|in:hadir,izin,sakit,absen',
            'attendanceData.*.notes' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () {
            foreach ($this->attendanceData as $memberId => $data) {
                AttendanceRecord::updateOrCreate(
                    [
                        'attendance_session_id' => $this->activeSession->id,
                        'training_member_id' => $memberId,
                    ],
                    [
                        'status' => $data['status'],
                        'notes' => $data['notes'],
                    ]
                );
            }
        });

        $this->dispatch('attendance-saved', ['message' => 'Absensi berhasil disimpan!']);
        session()->flash('success', 'Absensi berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.training.attendance.manage-training-attendance')->layout('layouts.training', [
            'title' => 'Manajemen Absensi',
            'training' => $this->training,
        ]);
    }
}