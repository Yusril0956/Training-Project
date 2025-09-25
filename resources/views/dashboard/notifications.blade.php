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
                        <a href="{{ $notification->data['url'] ?? '#' }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <span class="status-dot status-dot-animated bg-green me-3"></span>
                            <div class="flex-fill">
                                <div class="fw-bold">{{ $notification->data['title'] ?? 'Notifikasi' }}</div>
                                <div class="text-secondary small">{{ $notification->data['message'] ?? $notification->data['content'] ?? 'Pesan notifikasi' }}</div>
                            </div>
                            <span class="text-secondary small ms-3">{{ $notification->created_at->diffForHumans() }}</span>
                            <a href="{{ $notification->data['url'] ?? '#' }}" class="btn btn-sm btn-outline-secondary">Lihat</a>
                        </a>
                        @empty
                        <div class="list-group-item text-center text-muted">
                            Tidak ada notifikasi.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
