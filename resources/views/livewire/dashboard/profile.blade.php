<div>
    <div class="page-body">
        <div class="container-xl">

            <!-- alert -->
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
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
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="avatar avatar-xl"
                                        style="background-image: url({{ $user->avatar_url ? asset($user->avatar_url) . '?t=' . time() : asset('images/default_avatar.png') }})"></span>
                                </div>
                                <div class="col-auto">
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#modal-avatar">Ganti
                                        Profile</button>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-ghost-danger" wire:click="deleteAvatar"
                                        wire:confirm="Yakin ingin menghapus avatar?">Hapus Profile</button>
                                </div>
                            </div>

                            <h3 class="card-title mt-4">Profile
                                <button class="btn btn-sm btn-primary ms-2" data-bs-toggle="modal"
                                    data-bs-target="#modal-edit-profile">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path
                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg> Edit
                                </button>
                            </h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label">Username</div>
                                    <div class="form-control-plaintext">{{ $user->name }}</div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">Email</div>
                                    <div class="form-control-plaintext">{{ $user->email }}</div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">NIK</div>
                                    <div class="form-control-plaintext">{{ $user->nik }}</div>
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md">
                                    <div class="form-label">Role</div>
                                    <div class="form-control-plaintext">{{ $user->roles->pluck('name')->join(', ') }}
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">Status</div>
                                    <div class="form-control-plaintext">{{ $user->status }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <h3 class="card-title">Password</h3>
                            <p class="card-subtitle">Anda dapat mengatur kata sandi permanen jika tidak ingin
                                menggunakan kode login sementara.</p>
                            <div>
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#modal-password">Set new
                                    password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit profile -->
    <div class="modal modal-blur fade" id="modal-edit-profile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" wire:submit.prevent="updateProfile">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" wire:model="name" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" wire:model="email" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" class="form-control" wire:model="nik" maxlength="6" required>
                        @error('nik')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                        wire:target="updateProfile">
                        <span wire:loading.remove wire:target="updateProfile">Save Changes</span>
                        <span wire:loading wire:target="updateProfile">Saving...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal new password -->
    <div class="modal modal-blur fade" id="modal-password" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" wire:submit.prevent="updatePassword">
                <div class="modal-header">
                    <h5 class="modal-title">Kata Sandi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Password baru</label>
                        <input type="password" class="form-control" wire:model="password" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password baru</label>
                        <input type="password" class="form-control" wire:model="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                        wire:target="updatePassword">
                        <span wire:loading.remove wire:target="updatePassword">Simpan</span>
                        <span wire:loading wire:target="updatePassword">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal avatar -->
    <div wire:ignore.self class="modal modal-blur fade" id="modal-avatar" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" wire:submit.prevent="updateAvatar">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <!-- Dropzone -->
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
                    <!-- Progress Bar -->
                    {{-- <div wire:loading wire:target="avatar" class="mt-3">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                style="width: 100%"></div>
                        </div>
                        <p class="text-center mt-2">Mengupload...</p>
                    </div> --}}
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
        document.addEventListener('DOMContentLoaded', () => {
            // Setup for avatar modal
            const modalAvatar = document.getElementById('modal-avatar');
            if (modalAvatar) {
                modalAvatar.addEventListener('show.bs.modal', () => {
                    const dropzone = modalAvatar.querySelector('.dropzone');
                    if (dropzone) {
                        const fileInput = dropzone.querySelector('input[wire\\:model=avatar]');
                        if (fileInput) {
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
                                    fileInput.files = files;
                                    fileInput.dispatchEvent(new Event('change', {
                                        bubbles: true
                                    }));
                                }
                            });

                            dropzone.addEventListener('click', () => {
                                fileInput.click();
                            });
                        }
                    }
                });
            }

            // Close modal on event
            if (typeof $wire !== 'undefined') {
                $wire.on('closeModal', (modalId) => {
                    const modalElement = document.getElementById(modalId);
                    if (modalElement) {
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        if (modal) {
                            modal.hide();
                        }
                    }
                });
            }
        });

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('modal:close', ({
                id
            }) => {
                const modalElement = document.getElementById(id);
                if (!modalElement) return;

                const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(
                modalElement);
                modal.hide();

                // Ensure backdrop is removed if Livewire re-renders modal DOM
                setTimeout(() => {
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());

                    document.body.classList.remove('modal-open');
                    document.body.style.removeProperty('overflow');
                    document.body.style.removeProperty('padding-right');
                }, 300);
            });
        });
    </script>
@endpush
