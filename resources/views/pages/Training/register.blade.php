{{-- resources/views/pages/training/register.blade.php --}}
@extends('layouts.app')
@section('title', 'Daftar Training')

@section('content')
<div class="page-body">
  <div class="container-xl">

    {{-- Breadcrumb --}}
    @include('partials._breadcrumb', [
      'items' => [
        ['title' => 'Training',      'url' => route('training.index')],
        ['title' => 'Daftar: '.$training->name]
      ],
    ])

    {{-- Header --}}
    <div class="card mb-4">
      <div class="card-body">
        <h2 class="card-title">📝 Pendaftaran: {{ $training->name }}</h2>
        <p class="text-muted">{{ Str::limit($training->description, 150) }}</p>
      </div>
    </div>

    {{-- Form Pendaftaran --}}
    <div class="card">
      <div class="card-body">
        <form action="{{ route('training.register', $training->id)}}" method="POST">
          @csrf
          <input type="hidden" name="training_id" value="{{ $training->id }}" />

          <div class="row g-3">
            {{-- Nama --}}
            <div class="col-md-6">
              <label class="form-label">Nama Lengkap</label>
              <input
                type="text"
                name="name"
                class="form-control"
                value="{{ Auth::user()->name }}"
                readonly
              />
            </div>

            {{-- Email --}}
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input
                type="email"
                name="email"
                class="form-control"
                value="{{ Auth::user()->email }}"
                readonly
              />
            </div>

            {{-- Instansi --}}
            <div class="col-md-6">
              <label class="form-label">Instansi / Perusahaan</label>
              <input
                type="text"
                name="instansi"
                class="form-control @error('instansi') is-invalid @enderror"
                value="{{ old('instansi', Auth::user()->instansi) }}"
                placeholder="Contoh: PT. Maju Jaya"
              />
              @error('instansi')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Telepon --}}
            <div class="col-md-6">
              <label class="form-label">Telepon<span class="text-danger">*</span></label>
              <input
                type="text"
                name="phone"
                class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone', Auth::user()->phone) }}"
                placeholder="+628123456789"
                required
              />
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- NIK --}}
            <div class="col-md-6">
              <label class="form-label">NIK<span class="text-danger">*</span></label>
              <input
                type="text"
                name="nik"
                class="form-control @error('nik') is-invalid @enderror"
                value="{{ old('nik', Auth::user()->nik) }}"
                placeholder="Nomor Induk Kependudukan"
                required
              />
              @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Alamat --}}
            <div class="col-md-6">
              <label class="form-label">Alamat</label>
              <textarea
                name="address"
                class="form-control @error('address') is-invalid @enderror"
                rows="2"
                placeholder="Alamat lengkap (opsional)"
              >{{ old('address', Auth::user()->address) }}</textarea>
              @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          {{-- Tindakan --}}
          <div class="mt-4 text-end">
            <a href="{{ route('training.index') }}" class="btn btn-secondary me-2">
              Batal
            </a>
            <button type="submit" class="btn btn-primary">
              Daftar Sekarang
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection