@extends('layouts.app')

@section('title', 'Fortal HR - Sistem HR PT Dirgantara Indonesia')

@push('styles')
<style>
    /* Card umum */
    .card-custom {
        border-radius: 14px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        border: 1px solid #e5e7eb;
        transition: all 0.2s ease;
    }
    .card-custom:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    /* Warna per-card */
    .card-hris {
        background: #e0f2fe;   /* biru muda */
        color: #0284c7;
    }
    .card-hcis {
        background: #dcfce7;   /* hijau muda */
        color: #16a34a;
    }
    .card-km {
        background: #f3e8ff;   /* ungu muda */
        color: #9333ea;
    }
    .card-sap {
        background: #fef3c7;   /* kuning muda */
        color: #d97706;
    }

    /* Judul & teks */
    .card-custom h3 {
        font-weight: 600;
        margin-bottom: 6px;
    }
    .card-custom p {
        color: #374151;
        font-size: 0.9rem;
    }

    /* Tombol detail */
    .btn-detail {
        border: none;
        border-radius: 8px;
        padding: 8px 18px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        color: #fff;
        display: inline-block;
        margin-top: 10px;
    }
    .btn-hris { background: #0284c7; }
    .btn-hcis { background: #16a34a; }
    .btn-km   { background: #9333ea; }
    .btn-sap  { background: #d97706; }

    .btn-hris:hover { background: #0369a1; }
    .btn-hcis:hover { background: #15803d; }
    .btn-km:hover   { background: #7e22ce; }
    .btn-sap:hover  { background: #b45309; }
</style>
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <!-- Header Section -->
            <div class="card mb-4">
                <div class="card-body text-center py-5">
                    <h1 class="card-title">Fortal HR</h1>
                    <p class="card-subtitle text-muted">Sistem Human Resource Information di PT Dirgantara Indonesia</p>
                    <p class="text-muted">Berikut adalah sistem-sistem HR yang digunakan untuk mendukung pengelolaan sumber daya manusia di PT Dirgantara Indonesia.</p>
                </div>
            </div>

            <!-- HR Systems Cards -->
            <div class="row row-cards mb-4">
                <div class="col-md-6">
                    <div class="card card-custom card-hris">
                        <div class="card-header">
                            <h3 class="card-title">HRIS (Human Resource Information System)</h3>
                        </div>
                        <div class="card-body">
                            <p>Fokus pada administrasi SDM yang seluruhnya dilakukan secara online.</p>
                            <ul>
                                <li>Pengelolaan data karyawan</li>
                                <li>Proses administrasi harian</li>
                                <li>Reporting dan analisis data</li>
                                <li>Integrasi dengan sistem lain</li>
                            </ul>
                            <a href="#" class="btn-detail btn-hris">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-custom card-hcis">
                        <div class="card-header">
                            <h3 class="card-title">HCIS (Human Capital Information System)</h3>
                        </div>
                        <div class="card-body">
                            <p>Fokus pada pengembangan SDM (development).</p>
                            <ul>
                                <li>Perencanaan karir karyawan</li>
                                <li>Pengembangan kompetensi</li>
                                <li>Performance management</li>
                                <li>Talent acquisition dan retention</li>
                            </ul>
                            <a href="#" class="btn-detail btn-hcis">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cards mb-4">
                <div class="col-md-6">
                    <div class="card card-custom card-km">
                        <div class="card-header">
                            <h3 class="card-title">Knowledge Management (KM) Apps</h3>
                        </div>
                        <div class="card-body">
                            <p>Bagian dari pengembangan human capital, khususnya dalam konteks organisasi yang mendukung peran sebagai klaster pertahanan.</p>
                            <ul>
                                <li>Penyimpanan dan berbagi pengetahuan</li>
                                <li>Learning management system</li>
                                <li>Knowledge base untuk best practices</li>
                                <li>Collaboration tools</li>
                            </ul>
                            <a href="#" class="btn-detail btn-km">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-custom card-sap">
                        <div class="card-header">
                            <h3 class="card-title">SAP A&D (SAP Aerospace & Defense)</h3>
                        </div>
                        <div class="card-body">
                            <p>Digunakan untuk mendukung aspek produksi yang terkait dengan SDM.</p>
                            <ul>
                                <li>Integrasi dengan sistem produksi</li>
                                <li>Manajemen supply chain HR</li>
                                <li>Analytics untuk efisiensi operasional</li>
                                <li>Compliance dengan standar aerospace</li>
                            </ul>
                            <a href="#" class="btn-detail btn-sap">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Informasi Tambahan</h3>
                </div>
                <div class="card-body">
                    <p>Sistem-sistem HR ini dikembangkan untuk mendukung visi PT Dirgantara Indonesia sebagai market leader di industri dirgantara Asia Pasifik. Dengan integrasi yang baik antara HRIS, HCIS, KM Apps, dan SAP A&D, perusahaan dapat mengoptimalkan pengelolaan sumber daya manusia untuk mencapai tujuan strategis.</p>
                    <p><strong>VP Human Capital PT DI, Eko Daryono</strong>, menekankan pentingnya sistem ini dalam mendukung pengembangan human capital yang berkelanjutan.</p>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center">
                <a href="{{ route('index') }}" class="btn btn-primary">Kembali ke Home</a>
            </div>

        </div>
    </div>
@endsection
