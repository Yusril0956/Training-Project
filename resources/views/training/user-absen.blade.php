@extends('layouts.training')

@section('content')
<div class="container mt-4">
    <h2>Status Absen: {{ $training->name }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- User Attendance Status -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Status Absen Anda</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama:</strong> {{ $member->user->name }}</p>
                    <p><strong>Email:</strong> {{ $member->user->email }}</p>
                    <p><strong>Training:</strong> {{ $training->name }}</p>
                    <p><strong>Jenis Training:</strong> {{ $training->jenisTraining->name ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status Keanggotaan:</strong>
                        <span class="badge bg-{{ $member->status == 'accept' ? 'success' : 'warning' }}">
                            {{ $member->status == 'accept' ? 'Diterima' : 'Pending' }}
                        </span>
                    </p>
                    <p><strong>Status Absen:</strong>
                        @if($attendance)
                            <span class="badge bg-success">Sudah Absen</span>
                            <br><small class="text-muted">Waktu: {{ $attendance->attended_at->format('d-m-Y H:i') }}</small>
                        @else
                            <span class="badge bg-danger">Belum Absen</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code Section -->
    @if(!$attendance)
    <div class="card">
        <div class="card-header">
            <h5>Absen dengan QR Code</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>1. Unduh QR Code Anda</h6>
                    <p>Unduh QR Code pribadi Anda untuk melakukan absen.</p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('training.generate.qr', $training->id) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                <path d="M2 2h2v2H2V2Z"/>
                                <path d="M6 0v6H0V0h6ZM5 1H1v4h4V1Z"/>
                                <path d="M12 2h2v2h-2V2Z"/>
                                <path d="M0 10v6h6v-6H0Zm1 5V11h4v4H1Z"/>
                                <path d="M14 10h2v6h-6v-2h4v-4Z"/>
                                <path d="M10 0h6v6h-6V0Zm1 5V1h4v4h-4Z"/>
                                <path d="M8 8v2h2V8H8Z"/>
                                <path d="M4 8v2h2V8H4Z"/>
                                <path d="M12 8v2h2V8h-2Z"/>
                                <path d="M8 4v2h2V4H8Z"/>
                                <path d="M4 4v2h2V4H4Z"/>
                                <path d="M12 4v2h2V4h-2Z"/>
                            </svg>
                            Lihat QR Code
                        </a>
                        <a href="{{ route('training.download.qr', $training->id) }}" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                            Unduh QR Code (PNG)
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6>2. Upload QR Code untuk Absensi</h6>
                    <p>Setelah mendapatkan QR code, upload gambar QR code tersebut di form bawah ini untuk melakukan data absensi.</p>

                    <form action="{{ route('training.process.qr', $training->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="qr_image" class="form-label">Upload QR Code (PNG)</label>
                            <input type="file" class="form-control" id="qr_image" name="qr_image" accept="image/png,image/jpeg,image/jpg" required>
                            <div class="form-text">Upload file PNG QR Code yang telah Anda unduh</div>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                                <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5zM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3zm12 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H14v-2.5a.5.5 0 0 1 .5-.5zM3 3h.93a1 1 0 0 1 .707.293l.5.5A1 1 0 0 1 5.207 4.5l-.5.5A1 1 0 0 1 4 5.707V6H3V3zm6 0h3v3h-1V5.207a1 1 0 0 0-.707-.707l-.5-.5A1 1 0 0 0 10.5 3.5L10 3zm-6 6h3v3H3v-3zm6 0h3v3h-3v-3z"/>
                            </svg>
                            Proses Absensi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-header">
            <h5>Absen selesai</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-success">
                <h6>Absen Berhasil!</h6>
                <p>Anda telah berhasil melakukan absen pada training ini.</p>
                <p><strong>Waktu Absen:</strong> {{ $attendance->attended_at->format('d-m-Y H:i:s') }}</p>
            </div>
        </div>
    </div>
    @endif
@endsection
