@extends('layouts.app')
@section('title', 'Daftar Training')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            {{-- Hero / Header --}}
            <div class="card mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="card-title mb-1">📚 Pilih Pelatihan</h2>
                        <p class="text-muted">Lihat dan daftar pelatihan yang tersedia untuk Anda.</p>
                    </div>
                </div>
            </div>

            <livewire:training.training-index />

            {{-- Offcanvas Details --}}
            @foreach ($trainings as $training)
                <div class="offcanvas offcanvas-end" tabindex="-1" id="detailCanvas-{{ $training->id }}">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">{{ $training->name }} – Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <p><strong>Deskripsi:</strong> {{ $training->description }}</p>
                        @if ($training->detail)
                            <p>
                                <strong>Periode:</strong>
                                {{ \Carbon\Carbon::parse($training->detail->start_date)->format('d M Y') }}
                                hingga
                                {{ \Carbon\Carbon::parse($training->detail->end_date)->format('d M Y') }}
                            </p>
                        @endif
                        <p><strong>Jenis:</strong> {{ $training->jenisTraining->name ?? 'N/A' }}</p>
                        <p><strong>Jumlah Peserta:</strong> {{ $training->members->count() }}</p>

                        <hr>

                        <h6>Matriks Materi</h6>
                        <ul>
                            @foreach ($training->materis as $mat)
                                <li>{{ $mat->title }}</li>
                            @endforeach
                            @if ($training->materis->isEmpty())
                                <li class="text-muted">Belum ada materi</li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach

            <div class="mt-4 d-flex justify-content-center">
                {{ $trainings->withQueryString()->links() }}
            </div>

        </div>
    </div>
@endsection
