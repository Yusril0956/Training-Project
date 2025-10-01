@extends('layouts.training')
@section('title', 'Tambah Tugas')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <form action="{{ route('admin.tasks.store', ['trainingId' => $training->id]) }}" method="POST"
                enctype="multipart/form-data" class="card shadow-sm">
                @csrf
                <div class="card-header">
                    <h3 class="card-title">📝 Tambah Tugas Baru</h3>
                </div>

                <div class="card-body">
                    {{-- Nama Tugas --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Tugas</label>
                        <input type="text" name="title" class="form-control"
                            placeholder="Contoh: Resume Materi Hari ke-2" required>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" rows="4" class="form-control"
                            placeholder="Berikan instruksi atau penjelasan tugas..." required></textarea>
                    </div>

                    {{-- Training ID (hidden) --}}
                    <input type="hidden" name="training_id" value="{{ $training->id }}">

                    {{-- Deadline --}}
                    <div class="mb-3">
                        <label class="form-label">Deadline</label>
                        <input type="datetime-local" name="deadline" class="form-control" required>
                    </div>

                    {{-- Lampiran --}}
                    <div class="mb-3">
                        <label class="form-label">Lampiran (Opsional)</label>
                        <input type="file" name="attachment" class="form-control">
                        <small class="form-hint">PDF, DOCX, PPTX, atau gambar. Maks 5MB.</small>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg> Simpan Tugas
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
