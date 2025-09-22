@extends('layouts.dashboard')
@section('title', 'Tambah Tugas')

@section('content')
<div class="page-body">
  <div class="container-xl">

    <form action="{{ route('admin.tasks.store', $training->id) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
      @csrf
      <div class="card-header">
        <h3 class="card-title">📝 Tambah Tugas Baru</h3>
      </div>

      <div class="card-body">
        {{-- Nama Tugas --}}
        <div class="mb-3">
          <label class="form-label">Judul Tugas</label>
          <input type="text" name="title" class="form-control" placeholder="Contoh: Resume Materi Hari ke-2" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="description" rows="4" class="form-control" placeholder="Berikan instruksi atau penjelasan tugas..." required></textarea>
        </div>

        {{-- Pelatihan --}}
        {{-- <div class="mb-3">
          <label class="form-label">Pelatihan Terkait</label>
          <select name="training_id" class="form-select" required>
            <option value="" disabled selected>Pilih pelatihan</option>
            @foreach($trainings as $training)
              <option value="{{ $training->id }}">{{ $training->name }}</option>
            @endforeach
          </select>
        </div> --}}

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
          <i class="ti ti-plus"></i> Simpan Tugas
        </button>
      </div>
    </form>

  </div>
</div>
@endsection