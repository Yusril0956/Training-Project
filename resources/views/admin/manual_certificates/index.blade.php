{{-- filepath: resources/views/admin/manual_certificates/index.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'Sertifikat Manual')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h2 class="card-title mb-0">📄 Sertifikat Manual</h2>
                <a href="{{ route('admin.manual-certificates.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Tambah Sertifikat
                </a>
            </div>
        </div>
        <div class="row row-cards">
            @forelse($certificates as $certificate)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm">
                        <div class="ratio ratio-4x3">
                            @if ($certificate->file_path)
                                <iframe src="{{ asset('storage/' . $certificate->file_path) }}" class="w-100 h-100" style="border: none;"></iframe>
                            @else
                                <img src="{{ asset('images/default-training.jpg') }}" class="card-img-top object-fit-cover w-100 h-100" alt="Default Sertifikat" />
                            @endif
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-2">{{ $certificate->activity_name }}</h4>
                            <div class="mb-1 text-muted">{{ $certificate->participant_name }}</div>
                            <div class="mb-2 text-muted">{{ \Carbon\Carbon::parse($certificate->activity_date)->format('d M Y') }}</div>
                            <a href="{{ route('admin.manual-certificates.show', $certificate->id) }}" class="btn btn-sm btn-info">
                                <i class="ti ti-eye"></i> Detail
                            </a>
                            @if($certificate->file_path)
                                <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank" class="btn btn-sm btn-success">
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
        <div class="mt-4 d-flex justify-content-center">
            {{ $certificates->links() }}
        </div>
    </div>
</div>
@endsection