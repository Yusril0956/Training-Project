<!-- filepath: resources/views/partials/_modal.blade.php -->
@php
// Determine modal type and content from session
$modalType = session('modal_type', 'danger');
$modalTitle = session('modal_title', 'Konfirmasi');
$modalMessage = session('modal_message', 'Apakah Anda yakin ingin melanjutkan?');
$modalButtonText = session('modal_button_text', 'Konfirmasi');
$modalButtonClass = session('modal_button_class', 'btn-danger');

// Set modal status color based on type
$statusColors = [
    'danger' => 'bg-danger',
    'success' => 'bg-success', 
    'warning' => 'bg-warning',
    'info' => 'bg-info'
];
$modalStatus = $statusColors[$modalType] ?? 'bg-danger';

// Set icon based on modal type
$modalIcons = [
    'danger' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>',
    'success' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-success icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>',
    'warning' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-warning icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M12 17h.01" /></svg>',
    'info' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-info icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M12 17h.01" /></svg>'
];
$modalIcon = $modalIcons[$modalType] ?? $modalIcons['danger'];
@endphp

<div class="modal modal-blur fade" id="modal-configurable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status {{ $modalStatus }}"></div>
            <div class="modal-body text-center py-4">
                {!! $modalIcon !!}
                <h3>{{ $modalTitle }}</h3>
                <div class="text-secondary">{{ $modalMessage }}</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Batal
                            </a>
                        </div>
                        <div class="col">
                            <button id="btn-confirm-action" class="btn {{ $modalButtonClass }} w-100" data-bs-dismiss="modal">
                                {{ $modalButtonText }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Keep the original danger modal for backward compatibility -->
<div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
                <h3>Konfirmasi Hapus</h3>
                <div class="text-secondary">Apakah Anda yakin ingin menghapus?</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Batal
                            </a>
                        </div>
                        <div class="col">
                            <button id="btn-confirm-delete" class="btn btn-danger w-100" data-bs-dismiss="modal">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
