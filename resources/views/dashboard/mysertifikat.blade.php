@extends('layouts.dashboard')
@section('title', 'My Certificates')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            {{-- Header --}}
            <div class="card mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="card-title mb-1">🏆 Sertifikat Saya</h2>
                        <p class="text-muted">
                            Lihat dan unduh sertifikat pelatihan Anda di sini.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Sertifikat --}}
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
                                    {{ $certificate->training->name ?? 'Pelatihan Tidak Diketahui' }}
                                </h4>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank"
                                        class="btn btn-sm btn-success">
                                        <i class="ti ti-download"></i> Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Anda belum memiliki sertifikat apapun.
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $certificates->withQueryString()->links() }}
            </div>

            <div class="card mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h2 class="card-title mb-0">📄 Sertifikat Manual</h2>
                    <a href="{{ route('manual-certificates.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Tambah Sertifikat
                    </a>
                </div>
            </div>
            <div class="row row-cards">
                @forelse($externalCertificates as $extCertificate)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm {{ $extCertificate->status === 'pending' ? 'bg-gray-600' : '' }}">
                            <div class="ratio ratio-4x3">
                                @if ($extCertificate->file_path)
                                    <iframe src="{{ asset('storage/' . $extCertificate->file_path) }}" class="w-100 h-100"
                                        style="border: none;"></iframe>
                                @else
                                    <img src="{{ asset('images/default-training.jpg') }}"
                                        class="card-img-top object-fit-cover w-100 h-100" alt="Default Sertifikat" />
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="d-flex mb-2">
                                    <h4 class="card-title">{{ $extCertificate->activity_name }}</h4>
                                    @if ( $extCertificate->status === 'pending' )
                                        <span class="badge bg-orange-lt pb-0">Pending</span>
                                    @endif
                                </div>
                                <div class="mb-1 text-muted">{{ $extCertificate->participant_name }}</div>
                                <div class="mb-2 text-muted">
                                    {{ \Carbon\Carbon::parse($extCertificate->activity_date)->format('d M Y') }}</div>
                                <a href="{{ route('manual-certificates.show', $extCertificate->id) }}"
                                    class="btn btn-sm btn-info">
                                    <i class="ti ti-eye"></i> Detail
                                </a>
                                @if ($extCertificate->file_path)
                                    <a href="{{ asset('storage/' . $extCertificate->file_path) }}" target="_blank"
                                        class="btn btn-sm btn-success">
                                        <i class="ti ti-download"></i> Unduh
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Belum ada sertifikat manual.
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection
