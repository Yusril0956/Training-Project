{{-- resources/views/pages/training/user-list.blade.php --}}
@extends('layouts.app')
@section('title', 'Daftar Training')

@section('content')
<div class="page-body">
  <div class="container-xl">

    {{-- Hero / Header --}}
    <div class="card mb-4">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h2 class="card-title mb-1">📚 Pilih Pelatihan</h2>
          <p class="text-muted">Lihat dan daftar pelatihan yang tersedia untuk Anda.</p>
        </div>
      </div>
    </div>

    {{-- Grid Card --}}
    <div class="row row-cards">
      @forelse($trainings as $training)
        <div class="col-md-6 col-lg-4">
          <div class="card shadow-sm">

            {{-- Gambar Banner --}}
            <img
              src="{{ $training->image_url ?? asset('images/default-training.jpg') }}"
              class="card-img-top object-fit-cover"
              style="height: 160px;"
              alt="Banner {{ $training->name }}"
            />

            <div class="card-body">
              {{-- Judul --}}
              <h4 class="card-title">{{ $training->name }}</h4>
              {{-- Deskripsi Singkat --}}
              <p class="text-muted">{{ Str::limit($training->description, 80) }}</p>

              {{-- Badges --}}
              <div class="mb-3">
                <span class="badge bg-info">
                  <i class="ti ti-tag me-1"></i> {{ $training->jenisTraining->name }}
                </span>
                <span class="badge bg-secondary">
                  <i class="ti ti-category me-1"></i> {{ ucfirst($training->category) }}
                </span>
              </div>

              {{-- Aksi --}}
              <div class="d-flex justify-content-between">
                {{-- Detail --}}
                <a
                  href="#"
                  class="btn btn-sm btn-outline-info"
                > {{-- href="{{ route('training.show', $training->id) }}" --}}
                  <i class="ti ti-eye"></i> Detail
                </a>
                {{-- Daftar / Login --}}
                @auth
                  <a
                    href="{{ route('training.register', $training->id) }}"
                    class="btn btn-sm btn-primary"
                  >
                    <i class="ti ti-book-plus"></i> Daftar
                  </a>
                @else
                  <a
                    href="{{ route('login') }}"
                    class="btn btn-sm btn-primary"
                  >
                    <i class="ti ti-login"></i> Login
                  </a>
                @endauth
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="alert alert-warning text-center">
            Belum ada pelatihan tersedia.
          </div>
        </div>
      @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
      {{ $trainings->withQueryString()->links() }}
    </div>

  </div>
</div>
@endsection