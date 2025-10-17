<div>
    <div class="modal-header">
        <h5 class="modal-title">Tambah Peserta ke Pelatihan: {{ $training->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <form wire:submit.prevent="addMembers">
        <div class="modal-body">
            <p class="text-muted small">Pilih satu atau lebih peserta yang akan ditambahkan.</p>

            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th class="w-1">
                                <input wire:model.live="selectAll" class="form-check-input" type="checkbox" />
                            </th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <input wire:model.live="selectedUsers" class="form-check-input" type="checkbox"
                                        value="{{ $user->id }}" id="user-{{ $user->id }}">
                                </td>
                                <td>
                                    <label for="user-{{ $user->id }}" class="form-check-label d-block">
                                        {{ $user->name }}
                                    </label>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->nik ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Semua pengguna sudah terdaftar di pelatihan ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" @if(!$this->canAddMembers) disabled @endif>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 5l0 14"/><path d="M5 12l14 0"/>
                </svg>
                Tambah Peserta
                <span wire:loading wire:target="addMembers" class="spinner-border spinner-border-sm" role="status"></span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // [FIX] Listener untuk menutup modal dari event Livewire
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('close-modal', (modalId) => {
            const modalElement = document.getElementById(modalId);
            if (modalElement) {
                const modal = bootstrap.Modal.getInstance(modalElement);
                if (modal) {
                    modal.hide();
                }
            }
        });
    });
</script>
@endpush