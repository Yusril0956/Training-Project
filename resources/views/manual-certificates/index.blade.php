@extends('layouts.dashboard')
@section('title', 'External Certificates')

@section('content')
<div class="page-body">
    <div class="container-xl">

        {{-- Header --}}
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="card-title mb-1">🏆 External Certificates</h2>
                    <p class="text-muted">
                        Kelola sertifikat luar training Anda di sini.
                    </p>
                </div>
                <a href="{{ route('manual-certificates.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Tambah Sertifikat
                </a>
            </div>
        </div>

        {{-- Daftar Sertifikat --}}
        <div class="row row-cards">
            @forelse($certificates as $certificate)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm">

                        {{-- Preview Sertifikat --}}
                        <div class="ratio ratio-4x3">
                            @if ($certificate->file_path)
                                <iframe src="{{ asset('storage/' . $certificate->file_path) }}"
                                        frameborder="0"
                                        class="w-100 h-100" style="border: none;"></iframe>
                            @else
                                <img src="{{ asset('images/default-training.jpg') }}"
                                    class="card-img-top object-fit-cover w-100 h-100"
                                    alt="Default Sertifikat" />
                            @endif
                        </div>

                        <div class="card-body">
                            <h4 class="card-title mb-2">
                                {{ $certificate->activity_name }}
                            </h4>
                            <p class="text-muted mb-1">
                                <strong>Peserta:</strong> {{ $certificate->participant_name }}
                            </p>
                            <p class="text-muted mb-2">
                                <strong>Tanggal:</strong> {{ $certificate->activity_date->format('d M Y') }}
                            </p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('manual-certificates.show', $certificate) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="ti ti-eye"></i> Lihat
                                </a>
                                <a href="{{ asset('storage/' . $certificate->file_path) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-success">
                                    <i class="ti ti-download"></i> Unduh
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4>Belum ada sertifikat eksternal</h4>
                        <p>Klik tombol "Tambah Sertifikat" untuk menambahkan sertifikat luar training Anda.</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($certificates->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $certificates->withQueryString()->links() }}
        </div>
        @endif

    </div>
</div>
@endsection
