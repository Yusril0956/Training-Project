@extends('layouts.training')
@section('title', 'Review Tugas')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">🧾 Penilaian Tugas</h3>
                </div>
                <form action="{{ route('admin.submission.review.store', ['submissionId' => $submission->id]) }}"
                    method="POST">
                    @csrf
                    <div class="card-body">
                        <p><strong>Peserta:</strong> {{ $submission->user->name }}</p>
                        <p><strong>Judul Tugas:</strong> {{ $submission->task->title }}</p>
                        <p><strong>File:</strong>
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank">
                                {{ basename($submission->file_path) }}
                            </a>
                        </p>
                        <p><strong>Pesan:</strong> {{ $submission->message ?? 'Tidak ada pesan.' }}</p>

                        <div class="mb-3">
                            <label class="form-label">Nilai (0–100)</label>
                            <input type="number" name="score" class="form-control" min="0" max="100"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Komentar Instruktur</label>
                            <textarea name="comment" rows="4" class="form-control" placeholder="Berikan masukan atau evaluasi..."></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-check"></i> Simpan Penilaian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
