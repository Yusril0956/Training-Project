@extends('layouts.training')
@section('title', 'Task')

@section('content')
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
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="card-title mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="currentColor"
                                class="icon icon-tabler icons-tabler-filled icon-tabler-clipboard-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M17.997 4.17a3 3 0 0 1 2.003 2.83v12a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 2.003 -2.83a4 4 0 0 0 3.997 3.83h4a4 4 0 0 0 3.98 -3.597zm-2.997 10.83h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m0 -4h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m-1 -9a2 2 0 1 1 0 4h-4a2 2 0 1 1 0 -4z" />
                            </svg> Tugas Pelatihan</h2>
                        <p class="text-muted">
                            Daftar tugas untuk pelatihan <strong>{{ $training->name }}</strong>.
                        </p>
                    </div>
                    @if(Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                        <a href="{{ route('admin.tasks.create', ['trainingId' => $training->id]) }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Add Task
                        </a>
                    @endif
                </div>
            </div>

            <!-- Accordion Cards -->
            <div class="accordion" id="taskAccordion">
                @forelse($tasks as $task)
                    <div class="card shadow-sm mb-3">
                        <div class="card-header p-3">
                            <button class="btn btn-transparent d-flex align-items-center w-100 text-start" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse-{{ $task->id }}"
                                aria-expanded="false" aria-controls="collapse-{{ $task->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path
                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 12h6" />
                                    <path d="M9 16h6" />
                                </svg>
                                <div class="flex-fill d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">{{ $task->title }}</span>
                                    <span class="badge {{ $task->deadline < now() ? 'bg-danger' : 'bg-success' }}">
                                        {{ $task->deadline->format('d M Y H:i') }}
                                    </span>
                                </div>
                                <i class="ti ti-chevron-down ms-3 accordion-chevron"></i>
                            </button>
                        </div>
                        <div id="collapse-{{ $task->id }}" class="accordion-collapse collapse"
                            data-bs-parent="#taskAccordion">
                            <div class="card-body">
                                <p class="text-muted">{{ $task->description }}</p>

                                @if ($task->attachment_path)
                                    <a href="{{ asset('storage/' . $task->attachment_path) }}" target="_blank"
                                        class="btn btn-sm btn-outline-secondary mb-3">
                                        <i class="ti ti-paperclip"></i> Lampiran
                                    </a>
                                @endif

                                <div class="text-end">
                                    <a href="{{ route('training.task.detail', [$training->name, $task->id]) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="ti ti-eye"></i> Detail
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
@endsection

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
