@extends('layouts.dashboard')
@section('title', 'My Certificates')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            {{-- Header --}}
            <div class="card mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="card-title mb-1">🏆 Sertifikat & Riwayat Pelatihan</h2>
                        <p class="text-muted">
                            Lihat pelatihan yang telah Anda ikuti dan unduh sertifikat jika tersedia.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Riwayat Training --}}
            <div class="row row-cards">
                @forelse($tGraduated as $tG)
                    @php
                        $certificate = $certificates->where('training_id', $tG->id)->first();
                    @endphp

                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm">

                            {{-- Preview: gunakan Bootstrap-5 ratio agar full, tanpa scroll --}}
                            <div class="ratio ratio-4x3">
                                @if ($certificate && $certificate->file_path)
                                    <iframe src="{{ asset('storage/' . $certificate->file_path) }}" frameborder="0"
                                        class="w-100 h-100" style="border: none;"></iframe>
                                @else
                                    <img src="{{ asset('images/default-training.jpg') }}"
                                        class="card-img-top object-fit-cover w-100 h-100"
                                        alt="Banner {{ $tG->name }}" />
                                @endif
                            </div>

                            <div class="card-body">
                                <h4 class="card-title mb-2">{{ $tG->name }}</h4>

                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-sm btn-outline-info">
                                        <i class="ti ti-eye"></i> Detail
                                    </a>

                                    @if ($certificate && $certificate->file_path)
                                        <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-success">
                                            <i class="ti ti-download"></i> Sertifikat
                                        </a>
                                    @else
                                        <span class="btn btn-sm btn-secondary disabled">
                                            <i class="ti ti-file-x"></i> Tidak Tersedia
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Anda belum mengikuti pelatihan apapun.
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $tGraduated->withQueryString()->links() }}
            </div>

        </div>
    </div>
@endsection
