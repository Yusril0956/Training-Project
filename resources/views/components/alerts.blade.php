{{-- filepath: resources/views/components/alert-popup.blade.php --}}
@if(session('success') || session('error'))
    <div class="position-fixed end-0 p-3" style="z-index: 1055; right: 1rem; top: 5rem;">
        <div class="alert alert-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show shadow" role="alert" id="alertPopup">
            <strong>
                @if(session('success'))
                    <i class="ti ti-check"></i> Sukses!
                @else
                    <i class="ti ti-alert-triangle"></i> Gagal!
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
            if(alertPopup){
                var alert = new bootstrap.Alert(alertPopup);
                alert.close();
            }
        }, 4000); // 4 detik
    </script>
@endif