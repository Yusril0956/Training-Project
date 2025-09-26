@extends('layouts.training')
@section('title', 'Setting')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => $training->name, 'url' => route('training.home', $training->id)],
                    ['title' => 'Setting', 'url' => route('training.settings', $training->name)],
                ],
            ])

            @include('components.alert')

            <!-- Header -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">⚙️ Pengaturan Training</h2>
                    <p class="text-muted">Atur informasi dan status pelatihan <strong>{{ $training->judul }}</strong>.</p>
                </div>
            </div>

            <!-- Form Pengaturan Umum -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">📝 Informasi Umum</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('training.settings.update', $training->id) }}" method="POST">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="mb-3">
                            <label class="form-label">Judul Pelatihan</label>
                            <input type="text" name="name" class="form-control" value="{{ $training->name }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="4">{{ $training->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Durasi</label>
                            <input type="text" name="durasi" class="form-control" value="{{ $training->durasi }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control"
                                value="{{ $training->tanggal_mulai }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="open" {{ $training->status === 'open' ? 'selected' : '' }}>Open
                                </option>
                                <option value="close" {{ $training->status === 'close' ? 'selected' : '' }}>Close
                                </option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Aksi Tambahan -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">🔧 Aksi Tambahan</h3>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('training.members', $training->id) }}"
                                class="btn btn-outline-primary w-100">Kelola Peserta</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('training.materials', $training->id) }}"
                                class="btn btn-outline-success w-100">Kelola Materi</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('training.tasks', $training->id) }}"
                                class="btn btn-outline-warning w-100">Kelola Tugas</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('training.schedule', $training->id) }}"
                                class="btn btn-outline-info w-100">Atur Jadwal</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
