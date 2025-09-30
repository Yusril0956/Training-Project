@extends('layouts.dashboard')
@section('title', 'Tambah External Certificate')

@section('content')
<div class="page-body">
    <div class="container-xl">

        {{-- Breadcrumb --}}
        @include('partials._breadcrumb', [
            'items' => [
                ['title' => 'Dashboard', 'url' => route('index')],
                ['title' => 'External Certificates', 'url' => route('manual-certificates.index')],
                ['title' => 'Tambah Sertifikat', 'url' => '#'],
            ],
        ])

        {{-- Form --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">📜 Tambah Sertifikat Eksternal</h3>
            </div>
            <form action="{{ route('manual-certificates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Super Admin'))
                        <div class="mb-3">
                            <label class="form-label required">Pilih User Penerima Sertifikat</label>
                            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                <option value="">-- Pilih User --</option>
                                @foreach(\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label required">Nama Peserta</label>
                        <input type="text" name="participant_name"
                               class="form-control @error('participant_name') is-invalid @enderror"
                               value="{{ old('participant_name') }}"
                               placeholder="Masukkan nama peserta" required>
                        @error('participant_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Nama Kegiatan</label>
                        <input type="text" name="activity_name"
                               class="form-control @error('activity_name') is-invalid @enderror"
                               value="{{ old('activity_name') }}"
                               placeholder="Masukkan nama kegiatan/pelatihan" required>
                        @error('activity_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Tanggal Kegiatan</label>
                        <input type="date" name="activity_date"
                               class="form-control @error('activity_date') is-invalid @enderror"
                               value="{{ old('activity_date') }}" required>
                        @error('activity_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">File Sertifikat</label>
                        <input type="file" name="certificate_file"
                               class="form-control @error('certificate_file') is-invalid @enderror"
                               accept=".pdf,.jpg,.jpeg,.png" required>
                        @error('certificate_file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Format yang didukung: PDF, JPG, JPEG, PNG. Maksimal 5MB.
                        </small>
                    </div>

                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('manual-certificates.index') }}" class="btn btn-secondary me-2">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-upload"></i> Upload Sertifikat
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
