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
                                {{ $certificate->training->name ?? 'Pelatihan Tidak Diketahui' }}
                            </h4>

                            <div class="d-flex justify-content-between">
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

    </div>
</div>
@endsection
