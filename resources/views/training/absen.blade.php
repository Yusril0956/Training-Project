@extends('layouts.training')

@section('content')
<div class="container mt-4">
    <!-- Menampilkan Nama Pengguna yang Login di Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Absen Peserta Training: {{ $training->name }}</h2>
        
        @if (Auth::check()) <!-- Cek jika pengguna sudah login -->
            <div class="user-info">
            </div>
        @else
            <div class="user-info">
                <span class="font-weight-bold">Hello, Guest</span>
            </div>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Summary Statistics (tidak ada perubahan) -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Total Peserta</h5>
                    <h3 class="text-primary">{{ $members->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Sudah Absen</h5>
                    <h3 class="text-primary">{{ $members->filter(function($member) { return $member->attendance->count() > 0; })->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Belum Absen</h5>
                    <h3 class="text-primary">{{ $members->filter(function($member) { return $member->attendance->count() == 0; })->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Persentase</h5>
                    <h3 class="text-primary">{{ $members->count() > 0 ? round(($members->filter(function($member) { return $member->attendance->count() > 0; })->count() / $members->count()) * 100, 1) : 0 }}%</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Data Absen Peserta</h3>
            <div class="card-actions">
                <small class="text-white-50">Data absen otomatis dari QR Code</small>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-primary">No</th>
                            <th class="text-primary">Nama Peserta</th>
                            <th class="text-primary">Email</th>
                            <th class="text-primary">Status Keanggotaan</th>
                            <th class="text-primary">Status Absen</th>
                            <th class="text-primary">Waktu Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $index => $member)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <strong>{{ $member->user->name }}</strong>
                                        @if($member->status == 'accept')
                                        @else
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $member->user->email }}</td>
                            <td>
                                <span class="badge bg-{{ $member->status == 'accept' ? 'primary' : 'light text-primary border border-primary' }}">
                                    {{ $member->status == 'accept' ? 'Diterima' : 'Pending' }}
                                </span>
                            </td>
                            <td>
                                @if($member->attendance->count() > 0)
                                    <span class="badge bg-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 12l5 5l10 -10"/>
                                        </svg>
                                        Sudah Absen
                                    </span>
                                @else
                                    <span class="badge bg-light text-primary border border-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M18 6l-12 12"/>
                                            <path d="M6 6l12 12"/>
                                        </svg>
                                        Belum Absen
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($member->attendance->count() > 0)
                                    <div>
                                        <small class="text-primary d-block">
                                            {{ $member->attendance->last()->attended_at->format('d-m-Y') }}
                                        </small>
                                        <small class="text-primary">
                                            {{ $member->attendance->last()->attended_at->format('H:i:s') }}
                                        </small>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-primary">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 2l3.09 6.26l6.91 1l-5 4.87l1.18 6.88l-6.18 -3.25l-6.18 3.25l1.18 -6.88l-5 -4.87l6.91 -1l3.09 -6.26z"/>
                                    </svg>
                                    <h4 class="text-primary">Belum ada data absen</h4>
                                    <p>Data absen akan muncul otomatis ketika peserta mengupload QR Code mereka.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
