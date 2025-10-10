<?php

namespace App\Livewire\Training;

use App\Models\Training;
use Livewire\Component;

class ScheduleList extends Component
{
    public $id;
    public $training;
    public $title;
    public $date;
    public $start_time;
    public $end_time;
    public $location;
    public $instructor;

    public function mount($id)
    {
        $this->id = $id;
        $this->training = Training::with('schedules')->findOrFail($id);
    }

    public function storeSchedule()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'location' => 'nullable|string|max:255',
            'instructor' => 'nullable|string|max:255',
        ]);

        try {
            $this->training->schedules()->create([
                'title' => $this->title,
                'date' => $this->date,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'location' => $this->location,
                'instructor' => $this->instructor,
            ]);

            session()->flash('success', 'Jadwal berhasil ditambahkan!');
            $this->reset(['title', 'date', 'start_time', 'end_time', 'location', 'instructor']);
            $this->training->refresh();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menambahkan jadwal: ' . $e->getMessage());
        }
    }

    public function deleteSchedule($scheduleId)
    {
        try {
            $schedule = $this->training->schedules()->findOrFail($scheduleId);
            $schedule->delete();

            session()->flash('success', 'Jadwal berhasil dihapus!');
            $this->training->refresh();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus jadwal: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.training.schedule-list');
    }
}
