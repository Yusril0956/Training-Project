@extends('layouts.app')
@section('title', 'Detail Training')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => 'Detail Training', 'url' => route('training.detail', $training->id)],
                ],
            ])

            <!-- Detail Training -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Detail Pelatihan: {{ $training->name }}</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Judul Pelatihan</dt>
                        <dd class="col-sm-9">{{ $training->name }}</dd>

                        <dt class="col-sm-3">Kategori</dt>
                        <dd class="col-sm-9">{{ $training->category }}</dd>

                        <dt class="col-sm-3">Deskripsi</dt>
                        <dd class="col-sm-9">{{ $training->description }}</dd>

                        <dt class="col-sm-3">Tanggal Permintaan</dt>
                        <dd class="col-sm-9">{{ $training->created_at->format('Y-m-d') }}</dd>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">
                            @if ($training->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($training->status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <span class="badge bg-warning">Pending Approval</span>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>

            <!-- Approval Flow -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Approval Flow</h3>
                </div>
                <div class="card-body">
                    <ul class="timeline">
                        <li class="timeline-item">
                            <div class="timeline-point bg-secondary"></div>
                            <div class="timeline-event">
                                <div class="timeline-title">Permintaan Diajukan</div>
                                <div class="text-muted">{{ $training->created_at->format('Y-m-d') }}</div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-point bg-warning"></div>
                            <div class="timeline-event">
                                <div class="timeline-title">Menunggu Persetujuan Supervisor</div>
                                <div class="text-muted">Belum diproses</div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-point bg-muted"></div>
                            <div class="timeline-event">
                                <div class="timeline-title">Disetujui oleh Manajer</div>
                                <div class="text-muted">Belum dijadwalkan</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Aksi Admin -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Tindakan</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Catatan Persetujuan</label>
                        <textarea class="form-control" rows="3" placeholder="Tulis catatan atau alasan persetujuan..."></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <form action="{{ route('training.approve', $training->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">
                                <i class="ti ti-check"></i> Setujui
                            </button>
                        </form>
                        <form action="{{ route('training.reject', $training->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            {{-- button reject --}}
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#danger-{{ $modalId }}">
                                <i class="ti ti-x"></i> Tolak
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('components.modal', [
        'modalId' => $modalId,
        'modalTitle' => $modalTitle,
        'modalDescription' => $modalDescription,
        'modalButton' => $modalButton,
    ])
@endsection
