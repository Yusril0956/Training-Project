@extends('layouts.training')
@section('title', 'Schedule')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <!-- Header -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">🗓️ Jadwal Pelatihan</h2>
                    <p class="text-muted">Berikut adalah jadwal sesi untuk pelatihan <strong>{{ $training->judul }}</strong>.
                    </p>
                </div>
            </div>

            <!-- Daftar Jadwal -->
            <div class="row row-cards">
                @forelse ($training->schedules as $schedule)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title">{{ $schedule->judul }}</h4>
                                <ul class="list-unstyled small mb-2">
                                    <li><strong>Tanggal:</strong>
                                        {{ \Carbon\Carbon::parse($schedule->tanggal)->format('d M Y') }}</li>
                                    <li><strong>Waktu:</strong> {{ $schedule->jam_mulai }} - {{ $schedule->jam_selesai }}
                                    </li>
                                    <li><strong>Lokasi:</strong> {{ $schedule->lokasi }}</li>
                                    <li><strong>Pengajar:</strong> {{ $schedule->pengajar }}</li>
                                </ul>
                                @can('manage-training')
                                    <form action="{{ route('training.schedule.delete', [$training->id, $schedule->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">Belum ada jadwal yang tersedia.</div>
                    </div>
                @endforelse
            </div>

            <!-- Tambah Jadwal -->
            @can('manage-training')
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">➕ Tambah Jadwal Baru</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('training.schedule.store', $training->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Judul Sesi</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jam Mulai</label>
                                    <input type="time" name="jam_mulai" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jam Selesai</label>
                                    <input type="time" name="jam_selesai" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pengajar</label>
                                <input type="text" name="pengajar" class="form-control">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endcan

        </div>
    </div>
@endsection
