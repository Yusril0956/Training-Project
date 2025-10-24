<div class="page-body">
    <div class="container-xl">

        @include('partials._breadcrumb', [
            'items' => [
                ['title' => 'Training', 'url' => route('training.index')],
                ['title' => Str::limit($training->name, 10), 'url' => route('training.home', $training->id)],
                ['title' => 'Tugas', 'url' => route('training.tasks', $training->id)],
            ],
        ])

        <!-- Header -->
        <div class="card mb-4">
            <div class="card-body">
                <div
                    class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                    <div class="mb-3 mb-sm-0">
                        <h2 class="card-title mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor"
                                class="icon icon-tabler icons-tabler-filled icon-tabler-clipboard-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M17.997 4.17a3 3 0 0 1 2.003 2.83v12a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 2.003 -2.83a4 4 0 0 0 3.997 3.83h4a4 4 0 0 0 3.98 -3.597zm-2.997 10.83h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m0 -4h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m-1 -9a2 2 0 1 1 0 4h-4a2 2 0 1 1 0 -4z" />
                            </svg> Tugas Pelatihan
                        </h2>
                        <p class="text-muted mb-0">
                            Daftar tugas untuk pelatihan <strong>{{ $training->name }}</strong>.
                        </p>
                    </div>
                    @if (Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <a href="{{ route('admin.tasks.create', ['trainingId' => $training->id]) }}"
                                class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg> Add Task
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Accordion Cards -->
        <div class="accordion" id="taskAccordion">
            @forelse($tasks as $task)
                <div class="card shadow-sm mb-3">
                    <div class="card-header p-3">
                        <button
                            class="btn btn-transparent d-flex flex-column flex-sm-row align-items-start align-items-sm-center w-100 text-start"
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $task->id }}"
                            aria-expanded="false" aria-controls="collapse-{{ $task->id }}">
                            <div class="d-flex align-items-center w-100 mb-2 mb-sm-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text me-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path
                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 12h6" />
                                    <path d="M9 16h6" />
                                </svg>
                                <div
                                    class="flex-fill d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                                    <span class="fw-bold mb-1 mb-sm-0 text-truncate"
                                        style="max-width: 70%;">{{ $task->title }}</span>
                                    <span
                                        class="badge {{ $task->deadline < now() ? 'bg-red-lt' : 'bg-azure-lt' }} ms-sm-2 flex-shrink-0">
                                        {{ $task->deadline->format('d M Y H:i') }}
                                    </span>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down accordion-chevron ms-auto">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 9l6 6l6 -6" />
                            </svg>
                        </button>
                    </div>
                    <div id="collapse-{{ $task->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#taskAccordion">
                        <div class="card-body">
                            <p class="text-muted mb-3">{{ $task->description }}</p>

                            @if ($task->attachment_path)
                                <div class="mb-3">
                                    <a href="{{ asset('storage/' . $task->attachment_path) }}" target="_blank"
                                        class="btn btn-sm btn-outline-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-paperclip">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" />
                                        </svg> Lampiran
                                    </a>
                                </div>
                            @endif

                            <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">
                                <a href="{{ route('training.task.detail', [$training->id, $task->id]) }}"
                                    class="btn btn-sm btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg> Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center">
                    Belum ada tugas yang dibuat.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $tasks->withQueryString()->links() }}
        </div>

    </div>
</div>

@push('styles')
    <style>
        /* Rotate chevron when open */
        .accordion-collapse.collapse.show+.card-header .accordion-chevron,
        .card-header button[aria-expanded="true"] .accordion-chevron {
            transform: rotate(180deg);
        }

        .accordion-chevron {
            transition: transform 0.2s ease;
        }
    </style>
@endpush
