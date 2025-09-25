@extends('layouts.app')
@section('title', 'Feedback Training')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => $training->name, 'url' => route('training.detail', $training->id)],
                    ['title' => 'Feedback', 'url' => '#'],
                ],
            ])

            <!-- Training Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Feedback untuk: {{ $training->name }}</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Judul Pelatihan</dt>
                        <dd class="col-sm-9">{{ $training->name }}</dd>

                        <dt class="col-sm-3">Kategori</dt>
                        <dd class="col-sm-9">{{ $training->category }}</dd>

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

            <!-- Feedback Form -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Berikan Feedback Anda</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('training.feedback.submit', $training->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_pengirim" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim"
                                   value="{{ Auth::user()->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan Feedback</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="5"
                                      placeholder="Tulis feedback Anda tentang pelatihan ini..." required></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send"></i> Kirim Feedback
                            </button>
                            <a href="{{ route('training.detail', $training->id) }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
