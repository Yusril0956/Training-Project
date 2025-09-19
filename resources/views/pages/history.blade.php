@extends('layouts.dashboard')
@section('title', 'Riwayat & Sertifikat Pelatihan')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            {{-- Header --}}
            <div class="card mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="card-title mb-1">🏆 Sertifikat & Riwayat Pelatihan</h2>
                        <p class="text-muted">Lihat pelatihan yang telah Anda ikuti dan unduh sertifikat jika tersedia.</p>
                    </div>
                </div>
            </div>

            {{-- Riwayat Training --}}
            <div class="row row-cards">
                @forelse($tGraduated as $tG)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/default-training.jpg') }}" class="card-img-top object-fit-cover"
                                style="height: 160px;" alt="Banner {{ $tG->name }}" />

                            <div class="card-body">
                                {{-- Info --}}
                                <div class="mb-2">
                                    <p style="">Training: {{ $tG->name }}</p>
                                </div>

                                {{-- Aksi --}}
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-sm btn-outline-info">
                                        <i class="ti ti-eye"></i> Detail
                                    </a>
                                    @php
                                        $certificate = $certificates->where('training_id', $tG->id)->first();
                                    @endphp
                                    @if($certificate && $certificate->file_path)
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
                {{ $trainings->withQueryString()->links() }}
            </div>

        </div>
    </div>
@endsection
