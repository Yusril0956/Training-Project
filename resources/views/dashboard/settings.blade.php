@extends('layouts.dashboard')
@section('title', 'Settings')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <form action="{{ route('settings.update') }}" method="POST" class="card shadow-sm">
                @csrf
                @method('PUT')

                <div class="card-header">
                    <h3 class="card-title">Settings</h3>
                </div>

                <div class="card-body">

                    {{-- Tema --}}
                    <div class="mb-3">
                        <label class="form-label">Tema Tampilan</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="theme" value="light" id="theme-light"
                                {{ request('theme') === 'light' ? 'checked' : '' }}>
                            <label class="form-check-label" for="theme-light">
                                <a href="?theme=light" class="text-decoration-none" onclick="changeTheme('light')">Terang</a>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="theme" value="dark" id="theme-dark"
                                {{ request('theme') === 'dark' ? 'checked' : '' }}>
                            <label class="form-check-label" for="theme-dark">
                                <a href="?theme=dark" class="text-decoration-none" onclick="changeTheme('dark')">Gelap</a>
                            </label>
                        </div>
                    </div>

                    <script>
                    function changeTheme(theme) {
                        // Update the radio button selection
                        document.getElementById('theme-' + theme).checked = true;

                        // Allow the href to work normally (Tabler will handle the theme change)
                        return true;
                    }

                    // Auto-check radio button based on current URL on page load
                    document.addEventListener('DOMContentLoaded', function() {
                        const urlParams = new URLSearchParams(window.location.search);
                        const currentTheme = urlParams.get('theme');

                        if (currentTheme) {
                            const radioButton = document.getElementById('theme-' + currentTheme);
                            if (radioButton) {
                                radioButton.checked = true;
                            }
                        }

                        // Add event listeners to radio buttons
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
                    });
                    </script>

                    {{-- Notifikasi Email --}}
                    <div class="mb-3">
                        <label class="form-label">Notifikasi Email</label>
                        <select name="email_notifications" class="form-select">
                            <option value="enabled" {{ ($user->email_notifications ?? 'enabled') === 'enabled' ? 'selected' : '' }}>Aktif
                            </option>
                            <option value="disabled" {{ ($user->email_notifications ?? 'enabled') === 'disabled' ? 'selected' : '' }}>
                                Nonaktif</option>
                        </select>
                    </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy"></i> Simpan Pengaturan
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
