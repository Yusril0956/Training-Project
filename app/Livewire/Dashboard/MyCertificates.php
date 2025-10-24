<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Certificate;
use App\Models\ExternalCertificate;

class MyCertificates extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        try {
            $user = Auth::user();

            // Ambil semua sertifikat milik user
            $certificates = Certificate::where('user_id', $user->id)
                ->with('training')
                ->paginate(12);

            $externalCertificates = ExternalCertificate::where('user_id', Auth::id())->latest()->paginate(6);

            return view('livewire.dashboard.my-certificates', compact('certificates', 'externalCertificates'))
                ->layout('layouts.dashboard', ['title' => 'My Certificates']);
        } catch (\Exception $e) {
            return view('livewire.dashboard.my-certificates', [
                'certificates' => collect(),
                'externalCertificates' => collect()
            ])->layout('layouts.dashboard', ['title' => 'My Certificates']);
        }
    }
}
