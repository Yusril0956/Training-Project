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
                                        <i class="ti ti-sun"></i> Terang
                                    </span>
                                </label>
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="theme" value="dark" class="form-selectgroup-input"
                                        id="theme-dark" {{ request('theme') === 'dark' ? 'checked' : '' }}>
                                    <span class="form-selectgroup-label">
                                        <i class="ti ti-moon"></i> Gelap
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
                            <i class="ti ti-device-floppy"></i> Simpan Pengaturan
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
