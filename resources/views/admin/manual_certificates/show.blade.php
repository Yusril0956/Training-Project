{{-- filepath: resources/views/admin/manual_certificates/show.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'Detail Sertifikat Manual')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Detail Sertifikat Manual</h3>
            </div>
            <div class="card-body">
                <p><strong>Nama Peserta:</strong> {{ $certificate->participant_name }}</p>
                <p><strong>Nama Kegiatan:</strong> {{ $certificate->activity_name }}</p>
                <p><strong>Tanggal Kegiatan:</strong> {{ \Carbon\Carbon::parse($certificate->activity_date)->format('d M Y') }}</p>
                @if($certificate->user)
                    <p><strong>User Terkait:</strong> {{ $certificate->user->name }} ({{ $certificate->user->email }})</p>
                @endif
                @if($certificate->file_path)
                    <p><strong>File Sertifikat:</strong></p>
                    <iframe src="{{ asset('storage/' . $certificate->file_path) }}" class="w-100" style="height:400px;border:none;"></iframe>
                    <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank" class="btn btn-success mt-2">
                        <i class="ti ti-download"></i> Unduh Sertifikat
                    </a>
                @endif
            </div>
        </div>
        <a href="{{ route('admin.manual-certificates.index') }}" class="btn btn-secondary mt-3">
            <i class="ti ti-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection