<div>
    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => $training->name, 'url' => route('training.home', $training->id)],
                    ['title' => 'Absensi', 'url' => route('admin.training.attendance.manage', $training->id)],
                ],
            ])

            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="card-title">Manajemen Absensi Training</h2>
                            <p class="text-muted mb-0">Kelola absensi untuk pelatihan
                                <strong>{{ $training->name }}</strong>.
                            </p>
                        </div>
                        <div class="col-auto ms-auto">
                            <a href="{{ route('admin.training.attendance.create', $training) }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Buat Sesi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs flex-nowrap overflow-auto" data-bs-toggle="tabs"
                        style="white-space: nowrap;">
                        @forelse ($this->sessions as $session)
                            <li class="nav-item">
                                <a href="#session-{{ $session->id }}"
                                    class="nav-link @if ($sessionId == $session->id) active @endif"
                                    wire:click="selectSession({{ $session->id }})">
                                    {{ $session->title }} ({{ $session->date->format('d M Y') }})
                                </a>
                            </li>
                        @empty
                            <li class="nav-item">
                                <span class="nav-link disabled">Belum ada sesi absensi.</span>
                            </li>
                        @endforelse
                    </ul>
                </div>

                <form wire:submit="saveAttendance">
                    <div wire:loading.class="opacity-50" wire:target="selectSession">
                        <div class="card-body">
                            <div class="tab-content">
                                @if ($activeSession)
                                    <div class="tab-pane active show" id="session-{{ $activeSession->id }}">
                                        <h3 class="mb-0">Absensi untuk: {{ $activeSession->title }}</h4>
                                            <p class="text-muted">
                                                Tanggal: {{ $activeSession->date->format('l, d F Y') }}
                                                @if ($activeSession->start_time)
                                                    | Waktu:
                                                    {{ \Carbon\Carbon::parse($activeSession->start_time)->format('H:i') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($activeSession->end_time)->format('H:i') }}
                                                @endif
                                            </p>

                                            <div class="table-responsive mt-4">
                                                <table class="table table-vcenter table-striped card-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Peserta</th>
                                                            <th class="w-50">Status Kehadiran</th>
                                                            <th>Catatan (Opsional)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($this->members as $member)
                                                            <tr wire:key="member-{{ $member->id }}">
                                                                <td>
                                                                    <div>
                                                                        <div class="font-weight-medium">
                                                                            {{ $member->user->name ?? 'N/A' }}
                                                                        </div>
                                                                        <div class="text-muted small">
                                                                            {{ $member->user->email ?? 'No Email' }}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div
                                                                        class="form-selectgroup form-selectgroup-pills">
                                                                        <label class="form-selectgroup-item">
                                                                            <input type="radio"
                                                                                name="status-{{ $member->id }}"
                                                                                value="hadir"
                                                                                class="form-selectgroup-input"
                                                                                wire:model.live="attendanceData.{{ $member->id }}.status">
                                                                            <span
                                                                                class="form-selectgroup-label">Hadir</span>
                                                                        </label>
                                                                        <label class="form-selectgroup-item">
                                                                            <input type="radio"
                                                                                name="status-{{ $member->id }}"
                                                                                value="izin"
                                                                                class="form-selectgroup-input"
                                                                                wire:model.live="attendanceData.{{ $member->id }}.status">
                                                                            <span
                                                                                class="form-selectgroup-label">Izin</span>
                                                                        </label>
                                                                        <label class="form-selectgroup-item">
                                                                            <input type="radio"
                                                                                name="status-{{ $member->id }}"
                                                                                value="sakit"
                                                                                class="form-selectgroup-input"
                                                                                wire:model.live="attendanceData.{{ $member->id }}.status">
                                                                            <span
                                                                                class="form-selectgroup-label">Sakit</span>
                                                                        </label>
                                                                        <label class="form-selectgroup-item">
                                                                            <input type="radio"
                                                                                name="status-{{ $member->id }}"
                                                                                value="absen"
                                                                                class="form-selectgroup-input"
                                                                                wire:model.live="attendanceData.{{ $member->id }}.status">
                                                                            <span
                                                                                class="form-selectgroup-label">Absen</span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        placeholder="Contoh: Izin terlambat..."
                                                                        wire:model="attendanceData.{{ $member->id }}.notes">
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="3" class="text-center text-muted">
                                                                    Belum ada peserta di training ini.
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                @else
                                    <div class="text-center text-muted p-5">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-calendar-off" width="44"
                                            height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M19.823 19.824a2 2 0 0 1 -1.823 1.176h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 1.176 -1.823m3.824 -1.177h9a2 2 0 0 1 2 2v9" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v1" />
                                            <path d="M4 11h7m4 0h5" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                            <path d="M3 3l18 18" />
                                        </svg>
                                        <h3 class="mt-3">Belum Ada Sesi Absensi</h3>
                                        <p>Silakan buat sesi absensi baru untuk memulai pencatatan kehadiran.
                                        </p>
                                        <a href="{{ route('admin.training.attendance.create', ['trainingId' => $training->id]) }}"
                                            class="btn btn-primary">
                                            Buat Sesi Pertama
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($this->members->isNotEmpty() && $activeSession)
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                                wire:target="saveAttendance">
                                <span wire:loading.remove wire:target="saveAttendance">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                    </svg>
                                    Simpan Absensi
                                </span>
                                <span wire:loading wire:target="saveAttendance">
                                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                    Menyimpan...
                                </span>
                            </button>
                        </div>
                    @endif
                </form>

            </div>
        </div>
    </div>
</div>
