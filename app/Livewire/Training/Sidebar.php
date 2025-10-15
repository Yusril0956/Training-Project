<?php

namespace App\Livewire\Training;

use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public $training;
    public $unreadNotifications;
    public $collapsed = false;

    public function mount()
    {
        $id = request()->route('id') ?? request()->route('trainingId');
        $this->training = Training::findOrFail($id);
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $this->unreadNotifications = Auth::check()
            ? Auth::user()->notifications()->whereNull('read_at')->latest()->take(5)->get()
            : collect();
    }

    public function toggleSidebar()
    {
        $this->collapsed = !$this->collapsed;
    }

    public function render()
    {
        return view('livewire.training.sidebar');
    }
}
