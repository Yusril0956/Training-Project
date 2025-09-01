@extends('layouts.app')

@section('title', 'Layanan & Dukungan')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <!-- Hero Section -->
            <div class="card mb-4">
                <div class="card-body text-center py-5">
                    <h1 class="card-title">Layanan & Dukungan PTDI</h1>
                    <p class="card-subtitle text-muted">PT Dirgantara Indonesia menyediakan berbagai layanan maintenance, repair, overhaul, dan dukungan teknis untuk pesawat dan komponen, baik produk PTDI maupun non-PTDI.</p>
                </div>
            </div>

            <!-- Layanan Pesawat & Mesin -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Layanan Pesawat & Mesin (Aircraft & Engine Services)</h3>
                </div>
                <div class="card-body">
                    <p>PTDI menyediakan layanan maintenance, repair, dan overhaul (MRO) untuk berbagai jenis pesawat dan komponen:</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Produk Kolaborasi:</h5>
                            <ul>
                                <li>CN-295</li>
                                <li>NC-212 (berbagai seri)</li>
                                <li>H225M/H225</li>
                                <li>H215</li>
                                <li>Bell 412EP/EPI</li>
                                <li>AS365+/AS565MBe</li>
                                <li>H125</li>
                                <li>NAS332</li>
                                <li>NBO-105</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Pesawat Non-PTDI:</h5>
                            <ul>
                                <li>Boeing 737-200/300/400/500</li>
                            </ul>
                            <h5>Komponen:</h5>
                            <ul>
                                <li>Avionics (navigasi & komunikasi)</li>
                                <li>Komponen dinamis/gearbox</li>
                                <li>Airframe</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Layanan Purna Jual -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Layanan "Purna Jual" (After-Sales)</h3>
                </div>
                <div class="card-body">
                    <p>Dukungan yang disediakan meliputi:</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li><strong>Dukungan teknis:</strong> nasihat, perwakilan teknologi, insinyur layanan lapangan</li>
                                <li><strong>Dokumen teknis/manual & pelatihan:</strong> untuk pilot dan mekanik</li>
                                <li><strong>Pemeliharaan, perbaikan, dan overhaul:</strong> pesawat maupun komponennya</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li><strong>Modifikasi & perubahan konfigurasi:</strong> re-engine, instalasi TCAS/TAWS/FDR</li>
                                <li><strong>Interior pesawat:</strong> termasuk pengecatan ulang sebagai bagian inspeksi rutin</li>
                                <li><strong>Penyediaan suku cadang dan logistik</strong></li>
                                <li><strong>Penyusunan petunjuk kelaikan udara dan buletin layanan:</strong> contoh: Lap Joint B737-series</li>
                                <li><strong>Inspeksi berkala:</strong> C-check, CPCP, inspeksi tahunan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Layanan Engineering & Sistem Senjata -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Layanan Engineering & Sistem Senjata</h3>
                </div>
                <div class="card-body">
                    <p>Meskipun halaman utama situs menyebut "Layanan Engineering & Sistem Senjata" sebagai bagian portofolio utama, detail spesifik belum tersedia. Secara umum, PTDI menawarkan layanan yang mencakup:</p>
                    <ul>
                        <li><strong>Engineering:</strong> desain, pengembangan, dan pengujian</li>
                        <li><strong>Subkontrak manufaktur</strong></li>
                        <li><strong>Aircraft & Engine Maintenance, Repair and Overhaul (MRO)</strong></li>
                    </ul>
                </div>
            </div>

            <!-- Sistem Manajemen Mutu -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Sistem Manajemen Mutu</h3>
                </div>
                <div class="card-body">
                    <p>Semua layanan di atas berada di bawah sistem manajemen mutu yang mengacu pada regulasi Direktorat Jenderal Perhubungan Udara (Indonesia), termasuk:</p>
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <h5>CASR 145</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <h5>CASR 57</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <h5>DOA</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <h5>ISO 9001</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 offset-md-3 mt-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <h5>AS/EN 9110</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h4>Butuh Informasi Lebih Lanjut?</h4>
                    <p>Hubungi tim dukungan kami untuk konsultasi dan layanan khusus.</p>
                    <a href="{{ route('help') }}" class="btn btn-primary">Kontak Kami</a>
                </div>
            </div>

        </div>
    </div>
@endsection
