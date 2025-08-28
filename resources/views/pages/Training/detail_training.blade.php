@extends('layouts.app')
@section('title', 'Detail Training')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <!-- Detail Training -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Detail Pelatihan: Pelatihan Perawatan CN235</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Judul Pelatihan</dt>
                        <dd class="col-sm-9">Pelatihan Perawatan CN235</dd>

                        <dt class="col-sm-3">Kategori</dt>
                        <dd class="col-sm-9">Teknis</dd>

                        <dt class="col-sm-3">Klien</dt>
                        <dd class="col-sm-9">PT Aviasi Nusantara</dd>

                        <dt class="col-sm-3">Deskripsi</dt>
                        <dd class="col-sm-9">Pelatihan ini mencakup prosedur perawatan dasar dan lanjutan untuk pesawat
                            CN235, termasuk sistem avionik dan mesin.</dd>

                        <dt class="col-sm-3">Tanggal Permintaan</dt>
                        <dd class="col-sm-9">2025-08-20</dd>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">
                            <span class="badge bg-warning">Pending Approval</span>
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
                                <div class="text-muted">2025-08-20 oleh PT Aviasi Nusantara</div>
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
