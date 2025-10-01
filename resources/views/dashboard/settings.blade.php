@extends('layouts.dashboard')
@section('title', 'Pengaturan')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <form action="{{ route('settings.update') }}" method="POST" class="card">
                    @csrf
                    @method('PUT')

                    <div class="card-header">
                        <h3 class="card-title">Pengaturan</h3>
                    </div>

                    <div class="card-body">
                        {{-- Tema --}}
                        <div class="mb-3">
                            <label class="form-label">Tema Tampilan</label>
                            <div class="form-selectgroup">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="theme" value="light" class="form-selectgroup-input"
                                        id="theme-light" {{ request('theme') === 'light' ? 'checked' : '' }}>
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
                                    <input type="radio" name="theme" value="dark" class="form-selectgroup-input"
                                        id="theme-dark" {{ request('theme') === 'dark' ? 'checked' : '' }}>
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
                            <select name="email_notifications" class="form-select">
                                <option value="enabled"
                                    {{ ($user->email_notifications ?? 'enabled') === 'enabled' ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="disabled"
                                    {{ ($user->email_notifications ?? 'enabled') === 'disabled' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg> Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Simple theme switching
        document.addEventListener('DOMContentLoaded', function() {
            const lightRadio = document.getElementById('theme-light');
            const darkRadio = document.getElementById('theme-dark');

            if (lightRadio) {
                lightRadio.addEventListener('change', function() {
                    if (this.checked) {
                        window.location.href = '?theme=light';
                    }
                });
            }

            if (darkRadio) {
                darkRadio.addEventListener('change', function() {
                    if (this.checked) {
                        window.location.href = '?theme=dark';
                    }
                });
            }

            // Auto-check based on URL
            const urlParams = new URLSearchParams(window.location.search);
            const currentTheme = urlParams.get('theme');
            if (currentTheme && document.getElementById('theme-' + currentTheme)) {
                document.getElementById('theme-' + currentTheme).checked = true;
            }
        });
    </script>
@endsection
