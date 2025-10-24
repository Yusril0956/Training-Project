<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <form wire:submit.prevent="saveSettings" class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan</h3>
                </div>

                <div class="card-body">
                    {{-- Tema --}}
                    <div class="mb-3">
                        <label class="form-label">Tema Tampilan</label>
                        <div class="form-selectgroup">
                            <label class="form-selectgroup-item">
                                <input type="radio" wire:model.live="theme" value="light"
                                    class="form-selectgroup-input">
                                <span class="form-selectgroup-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-sun">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path
                                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                                    </svg> Terang
                                </span>
                            </label>
                            <label class="form-selectgroup-item">
                                <input type="radio" wire:model.live="theme" value="dark"
                                    class="form-selectgroup-input">
                                <span class="form-selectgroup-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-moon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                                    </svg> Gelap
                                </span>
                            </label>
                        </div>
                    </div>

                    {{-- Notifikasi Email --}}
                    <div class="mb-3">
                        <label class="form-label">Notifikasi Email</label>
                        <select wire:model="email_notifications" class="form-select">
                            <option value="enabled">Aktif</option>
                            <option value="disabled">Nonaktif</option>
                        </select>
                        @error('email_notifications')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg> Simpan Pengaturan
                        </span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Menyimpan...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
