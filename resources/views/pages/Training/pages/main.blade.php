@extends('layouts.training')
@section('title', 'Dashboard Training')

@section('content')
<div class="page-body">
  <div class="container-xl">
    <!-- Header Training -->
    <div class="card mb-4">
      <div class="card-body text-center py-4">
        <h2 class="card-title">{{ $training->judul }}</h2>
        <p class="text-muted">{{ $training->deskripsi ?? 'Deskripsi belum tersedia.' }}</p>
        <span class="badge bg-primary">{{ ucfirst($training->kategori) }}</span>
        <span class="badge bg-success">{{ ucfirst($training->status) }}</span>
      </div>
    </div>

    <!-- Info Kelas -->
    <div class="row row-cards mb-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">📅 Jadwal Pelatihan</h4>
            <p><strong>Tanggal:</strong> {{ $training->jadwal ?? 'Belum dijadwalkan' }}</p>
            <p><strong>Durasi:</strong> {{ $training->durasi ?? '-' }}</p>
            <p><strong>Lokasi:</strong> {{ $training->lokasi ?? '-' }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">👥 Informasi Klien</h4>
            <p><strong>Klien:</strong> {{ $training->klien }}</p>
            <p><strong>PIC Klien:</strong> {{ $training->pic_client ?? '-' }}</p>
            <p><strong>PIC Internal:</strong> {{ $training->pic_internal ?? '-' }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigasi Fitur -->
    <div class="card mb-4">
      <div class="card-header">
        <h3 class="card-title">🔗 Navigasi Training</h3>
      </div>
      <div class="card-body">
        <div class="row row-cards">
          <div class="col-md-4">
            <a href="{{ route('training.members', $training->id) }}" class="card card-link">
              <div class="card-body text-center">
                <span class="avatar bg-blue-lt text-blue mb-2">👥</span>
                <div>Daftar Peserta</div>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ route('training.materials', $training->id) }}" class="card card-link">
              <div class="card-body text-center">
                <span class="avatar bg-green-lt text-green mb-2">📚</span>
                <div>Materi & Modul</div>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ route('training.schedule', $training->id) }}" class="card card-link">
              <div class="card-body text-center">
                <span class="avatar bg-yellow-lt text-yellow mb-2">🗓️</span>
                <div>Jadwal Pelatihan</div>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ route('training.tasks', $training->id) }}" class="card card-link">
              <div class="card-body text-center">
                <span class="avatar bg-purple-lt text-purple mb-2">📝</span>
                <div>Tugas & Evaluasi</div>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ route('training.feedback', $training->id) }}" class="card card-link">
              <div class="card-body text-center">
                <span class="avatar bg-cyan-lt text-cyan mb-2">💬</span>
                <div>Feedback Peserta</div>
              </div>
            </a>
          </div>
          @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin'))
          <div class="col-md-4">
            <a href="{{ route('training.settings', $training->id) }}" class="card card-link">
              <div class="card-body text-center">
                <span class="avatar bg-red-lt text-red mb-2">⚙️</span>
                <div>Pengaturan Training</div>
              </div>
            </a>
          </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Ringkasan Statistik (Opsional) -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">📊 Ringkasan Aktivitas</h3>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Total Peserta: {{ $training->members_count ?? '0' }}</li>
          <li class="list-group-item">Materi Tersedia: {{ $training->materials_count ?? '0' }}</li>
          <li class="list-group-item">Tugas Aktif: {{ $training->tasks_count ?? '0' }}</li>
          <li class="list-group-item">Feedback Masuk: {{ $training->feedback_count ?? '0' }}</li>
        </ul>
      </div>
    </div>

  </div>
</div>
@endsection