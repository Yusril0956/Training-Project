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
                    <p><strong>Tanggal Kegiatan:</strong>
                        {{ \Carbon\Carbon::parse($certificate->activity_date)->format('d M Y') }}</p>
                    @if ($certificate->user)
                        <p><strong>User Terkait:</strong> {{ $certificate->user->name }} ({{ $certificate->user->email }})
                        </p>
                    @endif
                    @if ($certificate->file_path)
                        <p><strong>File Sertifikat:</strong></p>
                        <iframe src="{{ asset('storage/' . $certificate->file_path) }}" class="w-100"
                            style="height:400px;border:none;"></iframe>
                        <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank"
                            class="btn btn-success mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 11l5 5l5 -5" />
                                <path d="M12 4l0 12" />
                            </svg> Unduh Sertifikat
                        </a>
                    @endif
                </div>
            </div>
            <a href="{{ route('admin.manual-certificates.index') }}" class="btn btn-secondary mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M5 12l6 6" />
                    <path d="M5 12l6 -6" />
                </svg> Kembali ke Daftar
            </a>
        </div>
    </div>
@endsection
