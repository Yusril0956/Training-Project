<div>
    <div class="page-body">
        <div class="container-xl">

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
                    <h2 class="mb-4">Akun Saya</h2>
                    <div class="nav nav-tabs" id="profile-tabs" role="tablist">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
                        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password"
                            type="button" role="tab" aria-controls="password"
                            aria-selected="false">Password</button>
                    </div>

                    <div class="tab-content mt-4" id="profile-tabs-content">

                        <div class="tab-pane fade show active" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">

                            <h3 class="card-title">Detail Profil</h3>
                            <div class="row align-items-center mb-3">
                                <div class="col-auto">
                                    <span class="avatar avatar-xl"
                                        style="background-image: url({{ $user->avatar_url ? asset($user->avatar_url) . '?t=' . time() : asset('images/default_avatar.png') }})"></span>
                                </div>
                                <div class="col-auto">
                                    <button class="btn" data-bs-toggle="modal"
                                        data-bs-target="#modal-avatar">Ganti
                                        Profile</button>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-ghost-danger" wire:click="deleteAvatar"
                                        type="button"
                                        wire:confirm="Yakin ingin menghapus avatar?">Hapus Profile</button>
                                </div>
                            </div>

                            <hr class="my-4">

                            <form wire:submit.prevent="updateProfile">
                                <h3 class="card-title mt-4">Edit Profile</h3>
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" wire:model="name" required>
                                    @error('name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" wire:model="email" required>
                                    @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">NIK</label>
                                    <input type="text" class="form-control" wire:model="nik" maxlength="6"
                                        required>
                                    @error('nik')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="card-footer bg-transparent text-end border-0 p-0 pt-3">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                                        wire:target="updateProfile">
                                        <span wire:loading.remove wire:target="updateProfile">Simpan Perubahan</span>
                                        <span wire:loading wire:target="updateProfile">Menyimpan...</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <form wire:submit.prevent="updatePassword">
                                <h3 class="card-title">Ganti Password</h3>
                                <p class="card-subtitle">Atur kata sandi permanen baru Anda.</p>
                                <div class="mb-3">
                                    <label class="form-label">Password baru</label>
                                    <input type="password" class="form-control" wire:model="password" required>
                                    @error('password')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Konfirmasi Password baru</label>
                                    <input type="password" class="form-control" wire:model="password_confirmation"
                                        required>
                                </div>
                                <div class="card-footer bg-transparent text-end border-0 p-0 pt-3">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                                        wire:target="updatePassword">
                                        <span wire:loading.remove wire:target="updatePassword">Simpan Password
                                            Baru</span>
                                        <span wire:loading wire:target="updatePassword">Menyimpan...</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="modal-avatar" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" wire:submit.prevent="updateAvatar">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="dropzone border-dashed border-2 p-4 text-center" wire:loading.class="opacity-50"
                        style="cursor: pointer;">
                        @if ($avatar)
                            <img src="{{ $avatar->temporaryUrl() }}" class="img-fluid mb-3"
                                style="max-height: 200px;" loading="lazy">
                        @else
                            <div class="py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-upload mb-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.9 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                                    <path d="M9 15l3 -3l3 3" />
                                    <path d="M12 12v9" />
                                </svg>
                                <h4>Drag & drop gambar di sini</h4>
                                <p class="text-muted">atau klik untuk memilih file</p>
                            </div>
                        @endif
                        <input type="file" wire:model="avatar" class="form-control" accept="image/*"
                            style="display: none;">
                    </div>
                    @error('avatar')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                        wire:target="updateAvatar">
                        <span wire:loading.remove wire:target="updateAvatar">Simpan</span>
                        <span wire:loading wire:target="updateAvatar">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@push('script')
    <script>
        document.addEventListener('livewire:initialized', () => {

            // --- Logika Dropzone (Khusus untuk di dalam modal) ---
            const modalAvatar = document.getElementById('modal-avatar');
            if (modalAvatar) {
                const dropzone = modalAvatar.querySelector('.dropzone');
                if (dropzone) {
                    const fileInput = dropzone.querySelector('input[wire\\:model=avatar]');
                    if (fileInput) {
                        // Event saat klik dropzone
                        dropzone.addEventListener('click', (e) => {
                            fileInput.click();
                        });
                        
                        // Event drag/drop
                        dropzone.addEventListener('dragover', (e) => {
                            e.preventDefault();
                            dropzone.classList.add('bg-light');
                        });

                        dropzone.addEventListener('dragleave', () => {
                            dropzone.classList.remove('bg-light');
                        });

                        dropzone.addEventListener('drop', (e) => {
                            e.preventDefault();
                            dropzone.classList.remove('bg-light');
                            const files = e.dataTransfer.files;
                            if (files.length) {
                                // @this merujuk ke komponen Livewire
                                @this.upload('avatar', files[0]);
                            }
                        });
                    }
                }
            }

            // --- Listener modal:close (DIKEMBALIKAN) ---
            // Dibutuhkan lagi untuk menutup modal avatar
            Livewire.on('modal:close', ({ id }) => {
                const modalElement = document.getElementById(id);
                if (!modalElement) return;

                const modal = bootstrap.Modal.getInstance(modalElement);

                if (modal) {
                    modal.hide();
                }
            });
        });
    </script>
@endpush