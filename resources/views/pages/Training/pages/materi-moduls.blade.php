@extends('layouts.training')
@section('title', 'Materi dan Moduls')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <!-- Header -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">📚 Materi & Modul</h2>
                    <p class="text-muted">Berikut adalah daftar materi untuk pelatihan
                        <strong>{{ $training->nama }}</strong>.
                    </p>
                </div>
            </div>

            <!-- Daftar Materi -->
            <div class="row row-cards">
                @forelse ($training->materials as $material)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title">{{ $material->judul }}</h4>
                                <p class="text-muted">{{ Str::limit($material->deskripsi, 80) }}</p>
                                <ul class="list-unstyled small mb-2">
                                    <li><strong>Tipe:</strong> {{ ucfirst($material->tipe) }}</li>
                                    <li><strong>Upload:</strong> {{ $material->created_at->format('d M Y') }}</li>
                                </ul>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ $material->url }}" target="_blank" class="btn btn-sm btn-primary">Lihat
                                        Materi</a>
                                    @can('manage-training')
                                        <form action="{{ route('training.material.delete', [$training->id, $material->id]) }}"
                                            method="POST">
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
                        <div class="alert alert-warning text-center">Belum ada materi yang tersedia.</div>
                    </div>
                @endforelse
            </div>

            <!-- Upload Materi -->
            @can('manage-training')
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">➕ Upload Materi Baru</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('training.material.upload', $training->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Judul Materi</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tipe Materi</label>
                                <select name="tipe" class="form-select" required>
                                    <option value="pdf">PDF</option>
                                    <option value="video">Video</option>
                                    <option value="link">Link</option>
                                    <option value="ppt">PowerPoint</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload File / Link</label>
                                <input type="file" name="file" class="form-control">
                                <small class="form-hint">Atau masukkan link jika tipe = link</small>
                                <input type="text" name="url" class="form-control mt-2" placeholder="https://...">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Upload Materi</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endcan

        </div>
    </div>
@endsection
