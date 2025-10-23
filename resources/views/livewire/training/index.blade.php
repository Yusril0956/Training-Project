<div class="page-body">
    <div class="container-xl">
        @include('partials._breadcrumb', [
            'items' => [
                ['title' => 'Training', 'url' => route('training.index')],
                ['title' => $training->name, 'url' => route('training.home', $training->id)],
            ],
        ])

        <div class="card mb-4">
            <div class="card-body text-center py-4">
                <h2 class="card-title">{{ $training->name }}</h2>
                <p class="text-muted">{{ $training->description ?? 'Deskripsi belum tersedia.' }}</p>
                <span class="badge bg-green-lt">{{ ucfirst($training->status) }}</span>
            </div>
        </div>

        {{-- 
          BAGIAN JADWAL (DIRANCANG ULANG - SUPER SIMPLE)
          Menghilangkan semua ikon dan card, fokus pada list sederhana.
        --}}
        <div class="card mb-4">
            <div class="card-header">
                {{-- Menghapus ikon dari header --}}
                <h3 class="card-title">Jadwal Pelatihan Terdekat</h3>
            </div>
            <div class="card-body">
                @if ($training->attendanceSessions->count() > 0)
                    {{-- Ini adalah wrapper untuk list kustom kita --}}
                    <div>
                        @foreach ($training->attendanceSessions->sortBy('date') as $session)
                            
                            {{-- Setiap item jadwal --}}
                            <div class="py-3 @if(!$loop->last) border-bottom @endif">
                                
                                {{-- Baris 1: Judul di kiri, Tanggal di kanan --}}
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h5 class="mb-0">{{ $session->title }}</h5>
                                    <span class="text-muted small">{{ $session->date->format('d M Y') }}</span>
                                </div>
                                
                                {{-- Baris 2: Waktu (tanpa ikon) --}}
                                <div class="text-muted small mb-1">
                                    Waktu: {{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('H:i') }}
                                </div>
                                
                                {{-- Baris 3: Deskripsi (tanpa ikon) --}}
                                <div class="text-muted small">
                                    {{ $session->description ?? 'Tidak ada deskripsi' }}
                                </div>
                            </div>

                        @endforeach
                    </div>
                @else
                    {{-- Tampilan 'else' tetap sama seperti kode Anda --}}
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                stroke-linejoin="round" class="icon text-muted">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <h5 class="text-muted mb-2">Belum Ada Jadwal</h5>
                        <p class="text-muted">Jadwal pelatihan akan segera diumumkan.</p>
                    </div>
                @endif
            </div>
        </div>
        {{-- AKHIR BAGIAN JADWAL --}}


        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon me-2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1 -2 2H5a2 2 0 0 1 -2 -2z"></path>
                        <polyline points="9,22 9,12 15,12 15,22"></polyline>
                    </svg>
                    Navigasi Training
                </h3>
            </div>
            <div class="card-body">
                <div class="row row-cards">
                    <div class="col-md-4">
                        <a href="{{ route('training.members.index', $training->id) }}" class="card card-link">
                            <div class="card-body text-center">
                                <span class="avatar bg-green-lt text-green mb-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg></span>
                                <div>Members</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('training.tasks', $training->id) }}" class="card card-link">
                            <div class="card-body text-center">
                                <span class="avatar bg-purple-lt text-purple mb-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-list">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                        <path
                                            d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        <path d="M9 12l.01 0" />
                                        <path d="M13 12l2 0" />
                                        <path d="M9 16l.01 0" />
                                        <path d="M13 16l2 0" />
                                    </svg></span>
                                <div>Tugas</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('training.materi.index', $training->id) }}" class="card card-link">
                            <div class="card-body text-center">
                                <span class="avatar bg-purple-lt text-purple mb-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-book">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                        <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                        <path d="M3 6l0 13" />
                                        <path d="M12 6l0 13" />
                                        <path d="M21 6l0 13" />
                                    </svg></span>
                                <div>Materi</div>
                            </div>
                        </a>
                    </div>
                    @if (Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                        <div class="col-md-4">
                            <a href="{{ route('admin.training.attendance.manage', ['trainingId' => $training->id]) }}" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-orange-lt text-orange mb-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M15 18l2 2l4 -4" />
                                        </svg></span>
                                    <div>Absensi</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('training.settings', $training->id) }}" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-red-lt text-red mb-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                        </svg></span>
                                    <div>Pengaturan Training</div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon me-2">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                    Ringkasan Aktivitas
                </h3>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Total Peserta: {{ $training->members_count ?? '0' }}</li>
                    <li class="list-group-item">Tugas Aktif: {{ $training->task_count ?? '0' }}</li>
                    <li class="list-group-item">Feedback Masuk: {{ $training->feedback_count ?? '0' }}</li>
                </ul>
            </div>
        </div>

    </div>
</div>