@extends('layouts.training')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                            <path d="M2 2h2v2H2V2z"/>
                            <path d="M6 0v6H0V0h6zM5 1H1v4h4V1zM4 12H2v2h2v-2z"/>
                            <path d="M6 10v6H0v-6h6zm-5 1v4h4v-4H1zm8-9h2v2h-2V2z"/>
                            <path d="M6 0v6h6V0H6zm5 1v4H7V1h4zM4 2H2v2h2V2z"/>
                            <path d="M0 10v6h6v-6H0zm5 1v4H1v-4h4z"/>
                        </svg>
                        QR Code Absen
                    </h3>
                    <h5 class="text-center mb-0">{{ $training->name }}</h5>
                </div>
                <div class="card-body text-center">
                    <!-- Participant Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="border-end">
                                <h6 class="text-muted mb-1">Peserta</h6>
                                <strong class="text-primary">{{ $member->user->name }}</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Email</h6>
                            <strong class="text-primary">{{ $member->user->email }}</strong>
                        </div>
                    </div>

                    <!-- QR Code Display -->
                    <div class="my-4">
                        <div class="qr-container p-4 d-inline-block bg-white shadow-sm" style="border: 3px solid #e9ecef; border-radius: 10px;">
                            <div class="qr-code-wrapper">
                                {!! $qrCode !!}
                            </div>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div class="alert alert-info" role="alert">
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 7 7zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                            </svg>
                            <div>
                                <strong>QR Code ini bersifat pribadi</strong> dan hanya dapat digunakan untuk absen training ini.
                                tidak dapat di gunakan untuk training lain.
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4">
                        <a href="{{ route('training.user.absen', $training->id) }}" class="btn btn-outline-secondary me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                            Kembali
                        </a>

                        <button onclick="window.print()" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                            </svg>
                            Cetak QR Code
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .qr-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border: 3px solid #e9ecef !important;
        border-radius: 15px;
        position: relative;
        overflow: hidden;
    }

    .qr-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(13, 110, 253, 0.03) 0%, transparent 70%);
        animation: subtle-rotate 20s linear infinite;
    }

    @keyframes subtle-rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .qr-code-wrapper {
        position: relative;
        z-index: 2;
    }

    .qr-code-wrapper svg {
        max-width: 100%;
        height: auto;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }

    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%) !important;
    }

    .alert-info {
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        border: 1px solid #abd5da;
        border-radius: 10px;
    }

    @media print {
        .btn, .card-header h3, .card-header h5, .alert-info {
            display: none !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        .qr-container {
            border: 3px solid #000 !important;
            background: white !important;
        }
        .qr-container::before {
            display: none;
        }
    }

    /* Add subtle animation to QR code */
    .qr-code-wrapper svg rect {
        transition: all 0.3s ease;
    }

    .qr-code-wrapper:hover svg rect {
        filter: brightness(1.1);
    }
</style>
@endsection
