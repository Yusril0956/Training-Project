@extends('layouts.dashboard')
@section('title', 'Detail External Certificate')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            {{-- Breadcrumb --}}
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Dashboard', 'url' => route('index')],
                    ['title' => 'External Certificates', 'url' => route('manual-certificates.index')],
                    ['title' => Str::limit($certificate->activity_name, 30), 'url' => '#'],
                ],
            ])

            <div class="row">
                {{-- Detail Information --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">📋 Informasi Sertifikat</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Nama Peserta:</dt>
                                <dd class="col-sm-8">{{ $certificate->participant_name }}</dd>

                                <dt class="col-sm-4">Nama Kegiatan:</dt>
                                <dd class="col-sm-8">{{ $certificate->activity_name }}</dd>

                                <dt class="col-sm-4">Tanggal:</dt>
                                <dd class="col-sm-8">{{ $certificate->activity_date->format('d F Y') }}</dd>

                                <dt class="col-sm-4">Upload:</dt>
                                <dd class="col-sm-8">{{ $certificate->created_at->format('d F Y H:i') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                {{-- Certificate Preview --}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">📜 Preview Sertifikat</h3>
                            <div>
                                <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank"
                                    class="btn btn-success">
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
                                <a href="{{ route('manual-certificates.index') }}" class="btn btn-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l14 0" />
                                        <path d="M5 12l6 6" />
                                        <path d="M5 12l6 -6" />
                                    </svg> Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($certificate->file_path)
                                <div class="ratio ratio-4x3">
                                    <iframe src="{{ asset('storage/' . $certificate->file_path) }}" frameborder="0"
                                        class="w-100 h-100" style="border: none;"></iframe>
                                </div>
                            @else
                                <div class="alert alert-warning text-center">
                                    <h4>File sertifikat tidak ditemukan</h4>
                                    <p>File mungkin telah dihapus atau dipindahkan.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
