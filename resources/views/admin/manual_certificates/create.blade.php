{{-- filepath: resources/views/admin/manual_certificates/create.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'Tambah Sertifikat Manual')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Sertifikat Manual</h3>
            </div>
            <form action="{{ route('admin.manual-certificates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Peserta</label>
                        <input type="text" name="participant_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Kegiatan</label>
                        <input type="text" name="activity_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Kegiatan</label>
                        <input type="date" name="activity_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih User (Opsional)</label>
                        <select name="user_id" class="form-select">
                            <option value="">-- Tidak terhubung user --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Sertifikat (PDF)</label>
                        <input type="file" name="file" class="form-control" accept="application/pdf">
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection