@extends('layouts.dashboard')
@section('title', 'Notifikasi')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Notifikasi</h3>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @forelse ($notifications as $notification)
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <span class="status-dot status-dot-animated bg-green me-3"></span>
                            <div class="flex-fill">
                                <div class="fw-bold">{{ $notification->title }}</div>
                                <div class="text-secondary small">{{ $notification->message }}</div>
                            </div>
                            <span class="text-secondary small ms-3">{{ $notification->created_at->diffForHumans() }}</span>
                        </a>
                        @empty
                        <div class="list-group-item text-center text-muted">
                            Tidak ada notifikasi.
                        </div>
                        @endforelse
                        {{-- Contoh notifikasi, ganti dengan loop notifikasi user --}}
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <span class="status-dot status-dot-animated bg-green me-3"></span>
                            <div class="flex-fill">
                                <div class="fw-bold">Pendaftaran Training Berhasil</div>
                                <div class="text-secondary small">Anda telah mendaftar pada training "Basic Safety". Status:
                                    <span class="badge bg-warning">Pending</span></div>
                            </div>
                            <span class="text-secondary small ms-3">1 menit lalu</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <span class="status-dot status-dot-animated bg-blue me-3"></span>
                            <div class="flex-fill">
                                <div class="fw-bold">Training Diterima</div>
                                <div class="text-secondary small">Selamat! Anda diterima sebagai peserta "Basic Safety".
                                </div>
                            </div>
                            <span class="text-secondary small ms-3">10 menit lalu</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <span class="status-dot status-dot-animated bg-red me-3"></span>
                            <div class="flex-fill">
                                <div class="fw-bold">Pendaftaran Ditolak</div>
                                <div class="text-secondary small">Maaf, pendaftaran Anda pada "Advanced Welding" ditolak.
                                </div>
                            </div>
                            <span class="text-secondary small ms-3">1 jam lalu</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
