@extends('layouts.app')

@section('title', 'Laporan Data')

@push('styles')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .modal-content {
            border-radius: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <!-- Header -->
            <div class="card mb-4">
                <div class="card-body text-center py-5">
                    <h1 class="card-title">Laporan Data PT Dirgantara Indonesia</h1>
                    <p class="card-subtitle text-muted">Informasi publik tentang laporan keuangan, kontrak, dan proyek perusahaan.</p>
                </div>
            </div>

            <!-- Data Cards -->
            <div class="row row-cards mb-4">
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/LOGOFULL.png') }}" alt="Logo" class="mb-3" style="height: 50px;">
                            <h3 class="card-title">Laporan Tahunan</h3>
                            <p class="text-muted">Ringkasan penjualan, laba/rugi, inisiasi proyek, dan strategi bisnis.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTahunan">Lihat Detail</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <div class="card-body text-center">
                            <img src="{{ asset('LogoBaru.png') }}" alt="Logo" class="mb-3" style="height: 50px;">
                            <h3 class="card-title">Siaran Pers & Berita</h3>
                            <p class="text-muted">Target pendapatan 2024, rencana bisnis 2025, dan sinergi anak perusahaan.</p>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBerita">Lihat Detail</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/N219.png') }}" alt="Logo" class="mb-3" style="height: 50px;">
                            <h3 class="card-title">Kontrak Pesawat & Proyek</h3>
                            <p class="text-muted">Penjualan N219, CN235, dan proyek spesifik seperti Elang Hitam.</p>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalKontrak">Lihat Detail</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/LOGOFULL.png') }}" alt="Logo" class="mb-3" style="height: 50px;">
                            <h3 class="card-title">Laba Bersih 2019</h3>
                            <p class="text-muted">Laba bersih USD 10,6 juta melalui efisiensi biaya dan peningkatan kontrak.</p>
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalLaba">Lihat Detail</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <div class="card-body text-center">
                            <img src="{{ asset('LogoBaru.png') }}" alt="Logo" class="mb-3" style="height: 50px;">
                            <h3 class="card-title">Proyek Elang Hitam</h3>
                            <p class="text-muted">Pengembangan drone MALE dengan uji terbang perdana 28 Juli 2025.</p>
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalElang">Lihat Detail</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/LOGOFULL.png') }}" alt="Logo" class="mb-3" style="height: 50px;">
                            <h3 class="card-title">Profil Perusahaan</h3>
                            <p class="text-muted">Jumlah karyawan 3.689 (2021), fasilitas, dan daftar produk pesawat.</p>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalProfil">Lihat Detail</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphs Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Grafik Data</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Penjualan & Kontrak (Estimasi)</h4>
                            <div id="chart-sales" style="height: 300px;"></div>
                        </div>
                        <div class="col-md-6">
                            <h4>Laba Bersih (Estimasi)</h4>
                            <div id="chart-profit" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals -->
            <!-- Modal Laporan Tahunan -->
            <div class="modal fade" id="modalTahunan" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Laporan Tahunan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>PT DI menyediakan laporan tahunan (Annual Report), tetapi belum ada versi bulanan yang dipublikasikan. Laporan tersebut biasanya mencakup:</p>
                            <ul>
                                <li>Penjualan dan kontrak besar</li>
                                <li>Perolehan laba/rugi tahunan</li>
                                <li>Inisiasi proyek</li>
                                <li>Strategi bisnis dan rencana anggaran</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Siaran Pers -->
            <div class="modal fade" id="modalBerita" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Siaran Pers & Berita Resmi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Beberapa informasi relevan tersedia melalui siaran pers dan berita:</p>
                            <ul>
                                <li>Target pendapatan 2024: Rp 3,7 triliun dengan potensi laba bersih Rp 24 miliar</li>
                                <li>Rencana bisnis untuk 2025: Fokus pada peningkatan komersial, MRO, ekspor, serta sinergi dengan anak perusahaan seperti PT NTP dan IPTN North America</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Kontrak -->
            <div class="modal fade" id="modalKontrak" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Kontrak Pesawat & Proyek Spesifik</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Berikut beberapa informasi penting yang berhasil ditemukan:</p>
                            <ul>
                                <li>Penjualan N219 ke Kongo: 5 unit N219 dengan nilai USD 66,2 juta, serta tambahan pesanan CN235-220 untuk Republik Demokratik Kongo dan kontrak MRO dari Senegal</li>
                                <li>Penjualan N219 ke PT KLI: 11 unit N219 senilai USD 80,5 juta, dengan pengiriman mulai 28 bulan setelah kontrak ditandatangani</li>
                                <li>Permintaan CN-235 secara global: Diperkirakan ada permintaan hingga 100 pesawat dari Afrika dan Amerika Latin</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Laba -->
            <div class="modal fade" id="modalLaba" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Laba Bersih Tahun 2019</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>PT DI mencatat laba bersih sebesar USD 10,6 juta pada tahun buku 2019, jauh membaik dibandingkan rugi tahun sebelumnya, lewat efisiensi biaya dan peningkatan kontrak (nilai kontrak USD 130,8 juta; penjualan USD 260,9 juta)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Elang Hitam -->
            <div class="modal fade" id="modalElang" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Proyek Elang Hitam</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Pengembangan drone MALE Elang Hitam berhasil melakukan uji terbang perdana tanggal 28 Juli 2025</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Profil -->
            <div class="modal fade" id="modalProfil" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Profil Perusahaan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Data dasar perusahaan, seperti jumlah karyawan (3.689 pada 2021), luas fasilitas, dan daftar produk pesawat, tersedia di profil IAe / Wikipedia</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Chart for Sales & Contracts
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-sales'), {
                chart: {
                    type: "bar",
                    fontFamily: 'inherit',
                    height: 300,
                    toolbar: { show: false },
                },
                plotOptions: {
                    bar: { horizontal: false, columnWidth: '50%' }
                },
                dataLabels: { enabled: false },
                series: [{
                    name: "Kontrak (USD Juta)",
                    data: [66.2, 80.5, 130.8, 260.9] // Sample data
                }],
                xaxis: {
                    categories: ['N219 Kongo', 'N219 KLI', 'Kontrak 2019', 'Penjualan 2019']
                },
                colors: [tabler.getColor("primary")],
            })).render();

            // Chart for Profit
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-profit'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 300,
                    toolbar: { show: false },
                },
                series: [{
                    name: "Laba Bersih (USD Juta)",
                    data: [-10, 10.6, 24] // Sample data: previous loss, 2019, target 2024
                }],
                xaxis: {
                    categories: ['Sebelum 2019', '2019', 'Target 2024']
                },
                colors: [tabler.getColor("green")],
            })).render();
        });
    </script>
@endpush
