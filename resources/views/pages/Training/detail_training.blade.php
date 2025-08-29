@extends('layouts.app')
@section('title', 'Detail Training')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => 'Customer Requested', 'url' => route('customer.requested')],
                    ['title' => 'Detail Training', 'url' => route('training.detail', $training->id)],
                ],
            ])

            <!-- Detail Training -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Detail Pelatihan: {{ $training->nama }}</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Judul Pelatihan</dt>
                        <dd class="col-sm-9">{{ $training->nama }}</dd>

                        <dt class="col-sm-3">Kategori</dt>
                        <dd class="col-sm-9">{{ $training->kategori }}</dd>

                        <dt class="col-sm-3">Klien</dt>
                        <dd class="col-sm-9">{{ $training->klien }}</dd>

                        <dt class="col-sm-3">Deskripsi</dt>
                        <dd class="col-sm-9">{{ $training->deskripsi }}</dd>

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
                                <div class="text-muted">{{ $training->created_at->format('Y-m-d') }} oleh
                                    {{ $training->klien }}</div>
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
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Catatan Persetujuan</label>
                            <textarea class="form-control" rows="3" placeholder="Tulis catatan atau alasan persetujuan..."></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="ti ti-check"></i> Setujui
                            </button>
                            <button type="button" class="btn btn-danger">
                                <i class="ti ti-x"></i> Tolak
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <i class="ti ti-edit"></i> Edit Detail
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
