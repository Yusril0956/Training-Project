<div>
    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => $training->name, 'url' => route('training.home', $training->id)],
                    ['title' => 'Absensi', 'url' => route('training.attendance', $training->id)],
                ],
            ])

            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="card-title">📅 Absensi Training</h2>
                            <p class="text-muted mb-0">Kelola absensi untuk pelatihan <strong>{{ $training->name }}</strong>.</p>
                        </div>
                        @if ($isAdmin)
                            <div class="col-auto ms-auto">
                                <button wire:click="$set('showCreateSession', true)" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Buat Sesi
                                </button>
                            </div>
                        @else
                            <div class="col-auto ms-auto">
                                <button wire:click="checkIn" class="btn btn-success me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-login">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                        <path d="M20 12h-13l3 -3m0 6l-3 -3" />
                                    </svg>
                                    Check In
                                </button>
                                <button wire:click="checkOut" class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                        <path d="M9 12h12l-3 -3m0 6l3 -3" />
                                    </svg>
                                    Check Out
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Session Selection -->
            @if ($attendanceSessions->count() > 0)
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Pilih Sesi Absensi</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($attendanceSessions as $session)
                                <div class="col-md-4 mb-3">
                                    <div class="card {{ $selectedSessionId == $session->id ? 'border-primary' : '' }} cursor-pointer" wire:click="selectSession({{ $session->id }})">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{ $session->name }}</h5>
                                            <p class="card-text">{{ $session->date->format('d/m/Y') }}</p>
                                            <p class="card-text">{{ $session->start_time }} - {{ $session->end_time }}</p>
                                            @if ($session->is_active)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak Aktif</span>
                                            @endif
                                            @if ($isAdmin)
                                                <br>
                                                <button wire:click.stop="activateSession({{ $session->id }})" class="btn btn-sm btn-outline-primary mt-2">
                                                    Aktifkan
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Create Session Modal -->
            @if ($showCreateSession)
                <div class="modal show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Buat Sesi Absensi Baru</h5>
                                <button type="button" class="btn-close" wire:click="$set('showCreateSession', false)"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit="createSession">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Sesi</label>
                                        <input type="text" class="form-control" wire:model="newSessionName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" wire:model="newSessionDate" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Waktu Mulai</label>
                                            <input type="time" class="form-control" wire:model="newSessionStartTime" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Waktu Selesai</label>
                                            <input type="time" class="form-control" wire:model="newSessionEndTime" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea class="form-control" wire:model="newSessionDescription" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="$set('showCreateSession', false)">Batal</button>
                                <button type="button" class="btn btn-primary" wire:click="createSession">Buat Sesi</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    @if ($isAdmin)
                                        <th>Nama Peserta</th>
                                    @endif
                                    <th>Sesi</th>
                                    <th>Tanggal</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendances as $index => $attendance)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        @if ($isAdmin)
                                            <td>{{ $attendance->trainingMember->user->name }}</td>
                                        @endif
                                        <td>{{ $attendance->attendanceSession->name ?? 'N/A' }}</td>
                                        <td>{{ $attendance->date->format('d/m/Y') }}</td>
                                        <td>{{ $attendance->check_in ?? '-' }}</td>
                                        <td>{{ $attendance->check_out ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $attendance->status == 'present' ? 'success' : 'danger' }}">
                                                {{ ucfirst($attendance->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $attendance->notes ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $isAdmin ? 8 : 7 }}" class="text-center text-muted">
                                            @if ($selectedSessionId)
                                                Belum ada data absensi untuk sesi ini.
                                            @else
                                                Pilih sesi absensi terlebih dahulu.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
