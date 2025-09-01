@extends('layouts.app')

@section('title', 'Fortal HR - Sistem HR PT Dirgantara Indonesia')

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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">HRIS (Human Resource Information System)</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Fokus pada administrasi SDM yang seluruhnya dilakukan secara online.</p>
                            <ul>
                                <li>Pengelolaan data karyawan</li>
                                <li>Proses administrasi harian</li>
                                <li>Reporting dan analisis data</li>
                                <li>Integrasi dengan sistem lain</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">HCIS (Human Capital Information System)</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Fokus pada pengembangan SDM (development).</p>
                            <ul>
                                <li>Perencanaan karir karyawan</li>
                                <li>Pengembangan kompetensi</li>
                                <li>Performance management</li>
                                <li>Talent acquisition dan retention</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cards mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Knowledge Management (KM) Apps</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Bagian dari pengembangan human capital, khususnya dalam konteks organisasi yang mendukung peran sebagai klaster pertahanan.</p>
                            <ul>
                                <li>Penyimpanan dan berbagi pengetahuan</li>
                                <li>Learning management system</li>
                                <li>Knowledge base untuk best practices</li>
                                <li>Collaboration tools</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">SAP A&D (SAP Aerospace & Defense)</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Digunakan untuk mendukung aspek produksi yang terkait dengan SDM.</p>
                            <ul>
                                <li>Integrasi dengan sistem produksi</li>
                                <li>Manajemen supply chain HR</li>
                                <li>Analytics untuk efisiensi operasional</li>
                                <li>Compliance dengan standar aerospace</li>
                            </ul>
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
