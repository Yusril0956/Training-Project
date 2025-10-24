<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Settings extends Component
{
    public $theme = 'light';
    public $email_notifications = 'enabled';

    protected $rules = [
        'email_notifications' => 'required|in:enabled,disabled',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->email_notifications = $user->email_notifications ?? 'enabled';

        // Get theme from URL parameter or default to light
        $this->theme = request('theme', 'light');
    }

    public function updatedTheme($value)
    {
        // Redirect with theme parameter to maintain state
        return redirect()->route('settings', ['theme' => $value]);
    }

    public function saveSettings()
    {
        $this->validate();

        try {
            $user = Auth::user();
            $user->update([
                'email_notifications' => $this->email_notifications,
            ]);

            session()->flash('success', 'Pengaturan berhasil disimpan!');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan pengaturan!');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.settings')
            ->layout('layouts.dashboard', ['title' => 'Pengaturan']);
    }
}
