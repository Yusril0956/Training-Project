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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg> Tambah Sertifikat
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
                                    <iframe src="{{ asset('storage/' . $certificate->file_path) }}" frameborder="0"
                                        class="w-100 h-100" style="border: none;"></iframe>
                                @else
                                    <img src="{{ asset('images/default-training.jpg') }}"
                                        class="card-img-top object-fit-cover w-100 h-100" alt="Default Sertifikat" />
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg> Lihat
                                    </a>
                                    <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank"
                                        class="btn btn-sm btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                            <path d="M7 11l5 5l5 -5" />
                                            <path d="M12 4l0 12" />
                                        </svg> Unduh
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
            @if ($certificates->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $certificates->withQueryString()->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
