<div class="page-body">
    <div class="container-xl">

        {{-- Breadcrumb --}}
        @include('partials._breadcrumb', [
            'items' => [
                ['title' => 'Training', 'url' => route('training.index')],
                ['title' => Str::limit($training->name, 20), 'url' => route('training.home', $training->id)],
                ['title' => 'Tugas', 'url' => route('training.tasks', $training->id)],
                ['title' => Str::limit($task->title, 20), 'url' => '#'],
            ],
        ])

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @php session()->forget('success'); @endphp {{-- Hapus setelah ditampilkan --}}
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @php session()->forget('error'); @endphp {{-- Hapus setelah ditampilkan --}}
        @endif

        {{-- Detail Tugas --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-1">{{ $task->title }}</h2>
                <small class="text-muted">
                    Pelatihan: <strong>{{ $training->name }}</strong> |
                    Deadline:
                    <span class="badge {{ $task->deadline->isPast() ? 'bg-red-lt' : 'bg-green-lt' }}">
                        {{ $task->deadline->format('d M Y H:i') }}
                        @if ($task->deadline->isPast())
                            (Terlewat)
                        @endif
                    </span>
                </small>
                <hr>
                <h5>Deskripsi</h5>
                <p class="text-muted">{{ $task->description }}</p>

                {{-- Lampiran Tugas dari Admin --}}
                @if ($task->attachment_path)
                    <h5>Lampiran Tugas</h5>
                    <a href="{{ asset('storage/' . $task->attachment_path) }}" target="_blank"
                        class="btn btn-sm btn-outline-secondary mb-3">
                        📎 {{ basename($task->attachment_path) }}
                    </a>

                    @if (in_array(pathinfo($task->attachment_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $task->attachment_path) }}" alt="Lampiran"
                                class="img-fluid rounded border" loading="lazy">
                        </div>
                    @endif
                @endif
            </div>
        </div>

        {{-- Konten Tab --}}
        <div class="card shadow-sm">
            <div class="card-header">
                {{-- Nav Tabs (Menggunakan Bootstrap/Tabler JavaScript) --}}
                <ul class="nav nav-tabs card-header-tabs nav-tabs-alt" id="task-tabs" role="tablist">

                    @if (Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                        {{-- Tab Admin: Daftar Kiriman --}}
                        <li class="nav-item">
                            <button class="nav-link @if ($defaultTabId === 'tab-admin') active @endif" id="admin-tab"
                                data-bs-toggle="tab" data-bs-target="#tab-admin" type="button" role="tab"
                                aria-controls="tab-admin"
                                aria-selected="@if ($defaultTabId === 'tab-admin') true @else false @endif">
                                📋 Daftar Kiriman
                            </button>
                        </li>
                    @else
                        {{-- Tab Peserta: Kumpulkan Tugas --}}
                        @if (!$userSubmission)
                            <li class="nav-item">
                                <button class="nav-link @if ($defaultTabId === 'tab-submit') active @endif" id="submit-tab"
                                    data-bs-toggle="tab" data-bs-target="#tab-submit" type="button" role="tab"
                                    aria-controls="tab-submit"
                                    aria-selected="@if ($defaultTabId === 'tab-submit') true @else false @endif">
                                    Kumpulkan Tugas
                                </button>
                            </li>
                        @endif

                        {{-- Tab Peserta: Lihat Kiriman --}}
                        @if ($userSubmission)
                            <li class="nav-item">
                                <button class="nav-link @if ($defaultTabId === 'tab-view') active @endif" id="view-tab"
                                    data-bs-toggle="tab" data-bs-target="#tab-view" type="button" role="tab"
                                    aria-controls="tab-view"
                                    aria-selected="@if ($defaultTabId === 'tab-view') true @else false @endif">
                                    Lihat Kiriman
                                </button>
                            </li>
                        @endif

                        {{-- Tab Peserta: Edit Kiriman --}}
                        @if ($userSubmission && $task->deadline->isFuture() && !$userSubmission->review)
                            <li class="nav-item">
                                <button class="nav-link @if ($defaultTabId === 'tab-edit') active @endif" id="edit-tab"
                                    data-bs-toggle="tab" data-bs-target="#tab-edit" type="button" role="tab"
                                    aria-controls="tab-edit"
                                    aria-selected="@if ($defaultTabId === 'tab-edit') true @else false @endif">
                                    Edit Kiriman
                                </button>
                            </li>
                        @endif

                        {{-- Tab Peserta: Lihat Penilaian --}}
                        @if ($userSubmission && $userSubmission->review)
                            <li class="nav-item">
                                <button class="nav-link @if ($defaultTabId === 'tab-review') active @endif"
                                    id="review-tab" data-bs-toggle="tab" data-bs-target="#tab-review" type="button"
                                    role="tab" aria-controls="tab-review"
                                    aria-selected="@if ($defaultTabId === 'tab-review') true @else false @endif">
                                    Lihat Penilaian
                                </button>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="task-tabs-content">

                    {{-- KONTEN TAB: ADMIN/DAFTAR KIRIMAN --}}
                    @if (Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                        <div class="tab-pane fade @if ($defaultTabId === 'tab-admin') show active @endif" id="tab-admin"
                            role="tabpanel" aria-labelledby="admin-tab">
                            <h3 class="card-title mb-3">Daftar Pengumpulan Peserta</h3>
                            @if ($submissions->isEmpty())
                                <p class="text-muted">Belum ada peserta yang mengumpulkan.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Peserta</th>
                                                <th>File</th>
                                                <th>Waktu Kirim</th>
                                                <th>Nilai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($submissions as $submission)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $submission->user->name }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage/' . $submission->file_path) }}"
                                                            target="_blank">
                                                            {{ Str::limit(basename($submission->file_path), 25) }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $submission->submitted_at->format('d M Y H:i') }}</td>
                                                    <td>{{ $submission->review->score ?? 'Belum dinilai' }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-icon btn-sm btn-primary"
                                                            title="Download">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0 0z"
                                                                    fill="none" />
                                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                                <path d="M7 11l5 5l5 -5" />
                                                                <path d="M12 4v12" />
                                                            </svg>
                                                        </a>
                                                        <a href="{{ route('admin.task.review', [$training->id, $task->id, $submission->id]) }}"
                                                            class="btn btn-icon btn-sm btn-success" title="Nilai">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0 0z"
                                                                    fill="none" />
                                                                <path
                                                                    d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                                <path
                                                                    d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                                <line x1="16" y1="5" x2="19"
                                                                    y2="8" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    @else
                        {{-- KONTEN TAB: KUMPULKAN TUGAS --}}
                        @if (!$userSubmission)
                            <div class="tab-pane fade @if ($defaultTabId === 'tab-submit') show active @endif"
                                id="tab-submit" role="tabpanel" aria-labelledby="submit-tab">
                                @if ($task->deadline->isPast())
                                    <div class="alert alert-danger">❌ Deadline tugas telah terlewat. Anda tidak bisa
                                        mengirim tugas.</div>
                                @else
                                    <form wire:submit.prevent="submitTask" enctype="multipart/form-data"
                                        x-data="{ fileInput: null }" x-init="fileInput = $refs.submissionFile">
                                        <div class="mb-3">
                                            <label class="form-label">File Tugas <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" wire:model.live="submission_file"
                                                x-ref="submissionFile"
                                                class="form-control @error('submission_file') is-invalid @enderror"
                                                required>
                                            @error('submission_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-hint">PDF, DOCX, PPTX, atau gambar (maks 5MB).</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Pesan (Opsional)</label>
                                            <input type="text" wire:model="message"
                                                class="form-control @error('message') is-invalid @enderror"
                                                placeholder="Tambahkan pesan jika diperlukan">
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                            Kirim
                                        </button>
                                        <div x-init="$wire.on('fileSubmitted', () => { fileInput.value = ''; })"></div>
                                    </form>
                                @endif
                            </div>
                        @endif


                        {{-- KONTEN TAB: LIHAT KIRIMAN --}}
                        @if ($userSubmission)
                            <div class="tab-pane fade @if ($defaultTabId === 'tab-view') show active @endif"
                                id="tab-view" role="tabpanel" aria-labelledby="view-tab"
                                wire:key="tab-view-{{ $userSubmission->id }}">
                                <h3 class="card-title mb-3">Kiriman Anda</h3>

                                <p class="text-muted"><strong>Dikirim pada:</strong>
                                    {{ $userSubmission->submitted_at->format('d M Y H:i') }}</p>
                                <p class="text-muted"><strong>Pesan:</strong> {{ $userSubmission->answer ?? '-' }}</p>

                                <a href="{{ asset('storage/' . $userSubmission->file_path) }}" target="_blank"
                                    class="btn btn-sm btn-outline-secondary mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0 0z" fill="none" />
                                        <path d="M10 12l-4 4l-4 -4" />
                                        <path d="M6 16v-8a4 4 0 0 1 4 -4h4" />
                                        <path d="M14 10h6v6a2 2 0 0 1 -2 2h-6l4 -4l-4 -4" />
                                    </svg>
                                    Lihat File: {{ basename($userSubmission->file_path) }}
                                </a>

                                {{-- PRATINJAU GAMBAR --}}
                                @if ($fileIsImage)
                                    <h5 class="mt-4">Pratinjau Gambar</h5>
                                    <div class="mt-2 mb-4">
                                        <img src="{{ asset('storage/' . $userSubmission->file_path) }}"
                                            alt="Pratinjau Kiriman" class="img-fluid rounded border"
                                            style="max-height: 400px; object-fit: contain;" loading="lazy">
                                    </div>
                                @endif

                                {{-- NOTIFIKASI STATUS --}}
                                @if ($task->deadline->isPast() && !$userSubmission->review)
                                    <div class="alert alert-warning">⚠️ Tugas sudah melewati deadline. Menunggu
                                        penilaian dari pengajar.</div>
                                @elseif ($userSubmission->review)
                                    <div class="alert alert-info"> Tugas sudah dinilai. Silakan cek tab **Lihat
                                        Penilaian**.</div>
                                @endif
                            </div>
                        @endif

                        {{-- KONTEN TAB: EDIT KIRIMAN --}}
                        @if ($userSubmission && $task->deadline->isFuture() && !$userSubmission->review)
                            <div class="tab-pane fade @if ($defaultTabId === 'tab-edit') show active @endif"
                                id="tab-edit" role="tabpanel" aria-labelledby="edit-tab"
                                wire:key="tab-edit-{{ $userSubmission->id }}">
                                <h3 class="card-title mb-3">✏️ Edit Kiriman</h3>
                                <form wire:submit.prevent="editTask" enctype="multipart/form-data"
                                    x-data="{ fileInput: null }" x-init="fileInput = $refs.submissionFile;
                                    $wire.on('show-tab', ({ tabId }) => {
                                        if (tabId === 'tab-view') {
                                            var tabEl = document.querySelector('#view-tab');
                                            if (tabEl) {
                                                var tab = new bootstrap.Tab(tabEl);
                                                tab.show();
                                            }
                                        }
                                    });">
                                    <div class="alert alert-info">Anda dapat mengganti file dan/atau pesan. File saat
                                        ini: **{{ basename($userSubmission->file_path) }}**</div>
                                    <div class="mb-2">
                                        <label class="form-label">File Baru (opsional)</label>
                                        <input type="file" wire:model.live="submission_file"
                                            x-ref="submissionFile"
                                            class="form-control @error('submission_file') is-invalid @enderror">
                                        @error('submission_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Pesan</label>
                                        <input type="text" wire:model.live="message"
                                            class="form-control @error('message') is-invalid @enderror"
                                            placeholder="Pesan (opsional)">
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-info" wire:loading.attr="disabled">
                                            Update Kiriman
                                        </button>
                                        {{-- Gunakan data-bs-target untuk kembali ke view --}}
                                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tab"
                                            data-bs-target="#tab-view">
                                            Batal
                                        </button>
                                    </div>
                                    <div x-init="$wire.on('fileSubmitted', () => { fileInput.value = ''; })"></div>
                                </form>
                            </div>
                        @endif

                        {{-- KONTEN TAB: LIHAT PENILAIAN --}}
                        @if ($userSubmission && $userSubmission->review)
                            <div class="tab-pane fade @if ($defaultTabId === 'tab-review') show active @endif"
                                id="tab-review" role="tabpanel" aria-labelledby="review-tab"
                                wire:key="tab-review-{{ $userSubmission->id }}">
                                <h3 class="card-title mb-3">📊 Penilaian Tugas</h3>
                                <div class="card card-body bg-light-lt">
                                    <p class="h4">Nilai: <span
                                            class="badge bg-green-lt text-green-lt-fg">{{ $userSubmission->review->score }}</span>
                                    </p>
                                    <p><strong>Komentar:</strong> {{ $userSubmission->review->comment ?? '-' }}</p>
                                    <p class="text-muted small">
                                        Dinilai oleh: {{ $userSubmission->review->reviewer->name }} pada
                                        {{ $userSubmission->review->created_at->format('d M Y') }}
                                    </p>
                                </div>
                                {{-- Gunakan data-bs-target untuk kembali ke view --}}
                                <button type="button" class="btn btn-outline-secondary mt-3" data-bs-toggle="tab"
                                    data-bs-target="#tab-view">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0 0z" fill="none" />
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path
                                            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                        <path d="M9 17h6" />
                                        <path d="M9 13h6" />
                                    </svg>
                                    Lihat Kiriman
                                </button>
                            </div>
                        @endif
                    @endif {{-- End of Peserta/Admin Logic --}}

                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('livewire:navigated', () => {
            // Fungsi untuk menangani Livewire re-render
            const showDefaultTab = () => {
                const defaultTabId = '{{ $defaultTabId }}';
                const tabElement = document.querySelector(
                    `#task-tabs button[data-bs-target="#${defaultTabId}"]`);
                const tabContentElement = document.getElementById(defaultTabId);

                if (tabElement && tabContentElement) {
                    // Pastikan semua tab dan konten tab direset
                    document.querySelectorAll('#task-tabs .nav-link').forEach(btn => btn.classList.remove(
                        'active'));
                    document.querySelectorAll('#task-tabs-content .tab-pane').forEach(pane => pane.classList
                        .remove('show', 'active'));

                    // Set tab dan konten default menjadi aktif
                    tabElement.classList.add('active');
                    tabContentElement.classList.add('show', 'active');
                }
            };

            // Panggil saat DOM Livewire di-mount/di-render pertama kali
            showDefaultTab();

            // Listener untuk event show-tab dari Livewire (setelah submit/edit)
            Livewire.on('show-tab', ({
                tabId
            }) => {
                const tabElement = document.querySelector(`#task-tabs button[data-bs-target="#${tabId}"]`);
                if (tabElement) {
                    const tab = new bootstrap.Tab(tabElement);
                    tab.show();
                }
            });

            // Memastikan tab aktif kembali setelah Livewire re-render (jika tidak berhasil dengan showDefaultTab)
            document.querySelectorAll('#task-tabs .nav-link').forEach(tabEl => {
                tabEl.addEventListener('click', function(event) {
                    event.preventDefault();
                    const targetId = this.getAttribute('data-bs-target');
                    const targetContent = document.querySelector(targetId);

                    if (targetContent) {
                        // Logika Bootstrap Tab
                        const tab = new bootstrap.Tab(this);
                        tab.show();
                    }
                });
            });
        });

        // Menangani kasus ketika Bootstrap Tab tidak sinkron dengan Livewire
        document.addEventListener('DOMContentLoaded', function() {
            const initialDefaultTabId = '{{ $defaultTabId }}';
            const tabElement = document.querySelector(
                `#task-tabs button[data-bs-target="#${initialDefaultTabId}"]`);

            if (tabElement) {
                const tab = new bootstrap.Tab(tabElement);
                tab.show();
            }
        });
    </script>
@endpush
