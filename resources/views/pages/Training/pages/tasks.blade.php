@extends('layouts.training')
@section('title', 'Task')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <!-- Header -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">📝 Tugas Pelatihan</h2>
                    <p class="text-muted">Berikut adalah daftar tugas untuk pelatihan
                        <strong>{{ $training->nama }}</strong>.
                    </p>
                </div>
            </div>

            <!-- Daftar Tugas -->
            <div class="row row-cards">
                @forelse ($training->tasks as $task)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title">{{ $task->judul }}</h4>
                                <p class="text-muted">{{ Str::limit($task->deskripsi, 80) }}</p>
                                <ul class="list-unstyled small mb-2">
                                    <li><strong>Deadline:</strong> {{ $task->deadline }}</li>
                                    <li><strong>Status:</strong>
                                        @if ($task->is_completed_by(auth()->user()))
                                            <span class="badge bg-success">Sudah Dikerjakan</span>
                                        @else
                                            <span class="badge bg-warning">Belum Dikerjakan</span>
                                        @endif
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-sm btn-primary">Lihat Tugas</a>
                                    @can('manage-training')
                                        <form action="#" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">Belum ada tugas yang tersedia.</div>
                    </div>
                @endforelse
            </div>

            <!-- Tambah Tugas -->
            @can('manage-training')
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">➕ Buat Tugas Baru</h3>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Judul Tugas</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deadline</label>
                                <input type="date" name="deadline" class="form-control" required>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Buat Tugas</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endcan

        </div>
    </div>
@endsection
