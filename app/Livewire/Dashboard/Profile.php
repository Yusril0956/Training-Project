<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Services\ProfileService;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $name;
    public $email;
    public $nik;
    public $password;
    public $password_confirmation;
    public $avatar;

    protected $profileService;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nik' => 'required|numeric|digits:6',
        'password' => 'nullable|string|min:6|confirmed',
        'password_confirmation' => 'nullable|string|min:6',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];

    protected $messages = [
        'password.string' => 'Password harus berupa teks.',
        'password.min' => 'Password minimal harus 6 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'password_confirmation.string' => 'Konfirmasi password harus berupa teks.',
        'password_confirmation.min' => 'Konfirmasi password minimal harus 6 karakter.',
    ];

    public function boot(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->nik = $this->user->nik;
    }

    public function updateProfile()
    {
        $this->validateOnly(['name', 'email', 'nik']);

        $this->profileService->updateProfile($this->user->id, [
            'name' => $this->name,
            'email' => $this->email,
            'nik' => $this->nik,
        ]);

        session()->flash('success', 'Profile berhasil diperbarui!');
        // Tidak ada dispatch modal di sini
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'nullable|string|min:6|confirmed',
            'password_confirmation' => 'nullable|string|min:6',
        ]);

        if ($this->password) {
            $this->profileService->updatePassword($this->user->id, $this->password);

            session()->flash('success', 'Password berhasil diubah!');
            $this->reset('password', 'password_confirmation');
            // Tidak ada dispatch modal di sini
        }
    }

    public function updateAvatar()
    {
        $this->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($this->avatar) {
            try {
                $this->profileService->updateAvatar($this->user->id, $this->avatar);

                session()->flash('success', 'Avatar berhasil diubah!');
                $this->reset('avatar');
                
                // --- PERBAIKAN: Tambahkan kembali dispatch event ---
                $this->dispatch('modal:close', id: 'modal-avatar');
                
            } catch (\Exception $e) {
                session()->flash('error', 'Gagal upload file! ' . $e->getMessage());
            }
        }
    }

    public function deleteAvatar()
    {
        $this->profileService->deleteAvatar($this->user->id);
        session()->flash('success', 'Avatar berhasil dihapus.');
    }

    public function render()
    {
        $this->user = Auth::user()->fresh(); 
        
        return view('livewire.dashboard.profile')->layout('layouts.dashboard', ['title' => 'User Profile']);
    }
}