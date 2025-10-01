{{-- filepath: resources/views/components/alert-popup.blade.php --}}
@if (session('success') || session('error'))
    <div class="position-fixed end-0 p-3" style="z-index: 1055; right: 1rem; top: 5rem;">
        <div class="alert alert-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show shadow"
            role="alert" id="alertPopup">
            <strong>
                @if (session('success'))
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l5 5l10 -10" />
                    </svg> Sukses!
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v4" />
                        <path
                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                        <path d="M12 16h.01" />
                    </svg> Gagal!
                @endif
            </strong>
            <div class="mt-1">
                {{ session('success') ?? session('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <script>
        setTimeout(function() {
            var alertPopup = document.getElementById('alertPopup');
            if (alertPopup) {
                var alert = new bootstrap.Alert(alertPopup);
                alert.close();
            }
        }, 4000); // 4 detik
    </script>
@endif
