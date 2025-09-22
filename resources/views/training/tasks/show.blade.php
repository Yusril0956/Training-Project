@extends('layouts.training')
@section('title', 'Detail Tugas')

@section('content')
<div class="page-body">
  <div class="container-xl">

    {{-- Breadcrumb --}}
    @include('partials._breadcrumb', [
      'items' => [
        ['title' => 'Training',  'url' => route('training.index')],
        ['title' => Str::limit($training->name, 20), 
         'url'   => route('training.home', $training->id)],
        ['title' => 'Tugas',     
         'url'   => route('training.tasks', $training->id)],
        ['title' => Str::limit($task->title, 20), 'url' => '#'],
      ]
    ])

    {{-- Task Detail Card --}}
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <div class="d-flex mb-3 align-items-center">
          <i class="ti ti-clipboard-task fs-2 text-primary me-3"></i>
          <div class="flex-fill">
            <h2 class="card-title mb-1">{{ $task->title }}</h2>
            <small class="text-muted">
              Pelatihan: <strong>{{ $training->name }}</strong> |
              Deadline: 
              <span class="badge {{ $task->deadline < now() ? 'bg-danger' : 'bg-success' }}">
                {{ $task->deadline->format('d M Y H:i') }}
              </span>
            </small>
          </div>
        </div>

        <hr>

        {{-- Description --}}
        <h5>Deskripsi</h5>
        <p class="text-muted mb-4">{{ $task->description }}</p>

        {{-- Attachment --}}
        @if($task->attachment_path)
          <h5>Lampiran</h5>
          <a href="{{ asset('storage/' . $task->attachment_path) }}"
             target="_blank"
             class="btn btn-sm btn-outline-secondary mb-4">
            <i class="ti ti-paperclip me-1"></i>
            {{ basename($task->attachment_path) }}
          </a>
        @endif
      </div>
    </div>

    @canany(['Admin', 'Super Admin'])
      {{-- Submissions List (Admin) --}}
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h3 class="card-title mb-3">Daftar Pengumpulan</h3>
          @if($task->submissions->isEmpty())
            <p class="text-muted">Belum ada peserta yang mengumpulkan.</p>
          @else
            <table class="table table-vcenter">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Peserta</th>
                  <th>File</th>
                  <th>Waktu Kirim</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($task->submissions as $submission)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $submission->user->name }}</td>
                    <td>
                      <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank">
                        {{ basename($submission->file_path) }}
                      </a>
                    </td>
                    <td>{{ $submission->created_at->format('d M Y H:i') }}</td>
                    <td>
                      <a href="{{ route('admin.submissions.download', $submission->id) }}"
                         class="btn btn-sm btn-outline-primary">
                        <i class="ti ti-download"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            {{-- pagination jika perlu --}}
            <div class="mt-3">
              {{ $task->submissions->links() }}
            </div>
          @endif
        </div>
      </div>
    @else
      {{-- Submission Form (Peserta) --}}
      <div class="card shadow-sm mb-4">
        <form action="{{ route('training.tasks.submit', [$training->id, $task->id]) }}"
              method="POST"
              enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <h3 class="card-title mb-3">Kumpulkan Tugas</h3>

            @if(optional($task->submissions->where('user_id', auth()->id())->first())->file_path)
              <p class="text-success">Kamu sudah mengumpulkan tugas ini.</p>
              <a href="{{ asset('storage/' . $task->submissions->firstWhere('user_id', auth()->id())->file_path) }}"
                 class="btn btn-sm btn-outline-secondary mb-3" target="_blank">
                <i class="ti ti-paperclip me-1"></i>
                Lihat Kiriman
              </a>
            @else
              <div class="mb-3">
                <label class="form-label">Pilih File</label>
                <input type="file"
                       name="submission_file"
                       class="form-control @error('submission_file') is-invalid @enderror"
                       required>
                @error('submission_file')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-upload me-1"></i> Kirim Tugas
              </button>
            @endif
          </div>
        </form>
      </div>
    @endcanany

    {{-- Back Button --}}
    <a href="{{ route('training.tasks', $training->id) }}" class="btn btn-secondary">
      <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar Tugas
    </a>

  </div>
</div>
@endsection