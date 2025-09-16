@extends('layouts.app') {{-- atau layouts.admin kalau kamu pakai dashboard admin --}}

@section('content')
<div class="container">
    <h2>Buat Assignment Baru</h2>

    <form action="{{ route('assignments.store', $training->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" id="description" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Tipe</label>
            <select name="type" class="form-control" id="type">
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-control" id="location">
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Tanggal Deadline</label>
            <input type="date" name="due_date" class="form-control" id="due_date" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
