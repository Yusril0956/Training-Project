<div class="page-body">
    <div class="container-xl">

        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="card-title mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="currentColor"
                            class="icon icon-tabler icons-tabler-filled icon-tabler-clipboard-text">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M17.997 4.17a3 3 0 0 1 2.003 2.83v12a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 2.003 -2.83a4 4 0 0 0 3.997 3.83h4a4 4 0 0 0 3.98 -3.597zm-2.997 10.83h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m0 -4h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m-1 -9a2 2 0 1 1 0 4h-4a2 2 0 1 1 0 -4z" />
                        </svg>notifikasi</h2>
                    <p class="text-muted">
                        Notifikasi terbaru untuk anda
                    </p>
                </div>
                <button wire:click="markAllAsRead" class="btn btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks me-1">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 12l5 5l10 -10" />
                        <path d="M2 12l5 5m5 -5l5 -5" />
                    </svg>
                    Tandai Semua Dibaca
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="accordion" id="taskAccordion">
            @forelse ($notifications as $notification)
                <div class="card shadow-sm mb-3">
                    <div class="card-header p-3">
                        <button class="btn btn-transparent d-flex align-items-center w-100 text-start" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $notification->id }}"
                            aria-expanded="false" aria-controls="collapse-{{ $notification->id }}"
                            wire:click="markAsRead({{ $notification->id }})">
                            <span
                                class="status-dot status-dot-animated bg-green me-3 {{ $notification->read_at ? 'opacity-50' : '' }}"></span>
                            <div class="flex-fill d-flex justify-content-between align-items-center">
                                <span
                                    class="fw-bold {{ $notification->read_at ? 'text-muted' : '' }}">{{ $notification->data['title'] ?? 'Notifikasi' }}</span>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down accordion-chevron">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 9l6 6l6 -6" />
                            </svg>
                        </button>
                    </div>
                    <div id="collapse-{{ $notification->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#taskAccordion">
                        <div class="card-body">
                            <p class="text-muted">
                                {!! $notification->data['message'] ?? ($notification->data['content'] ?? 'Pesan notifikasi') !!}
                            </p>

                            @if (isset($notification->data['action_url']))
                                <div class="text-end">
                                    <a href="{{ $notification->data['action_url'] }}"
                                        class="btn btn-sm btn-outline-primary">
                                        {{ $notification->data['action_text'] ?? 'Lihat' }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center">
                    Belum ada notifikasi.
                </div>
            @endforelse
        </div>

        @if ($notifications->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $notifications->withQueryString()->links() }}
            </div>
        @endif

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
