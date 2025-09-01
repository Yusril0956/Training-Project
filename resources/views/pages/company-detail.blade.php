@extends('layouts.app')

@section('title', 'Detail Perusahaan - PT Dirgantara Indonesia')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Perusahaan</h3>
                            <div class="card-actions">
                                <a href="{{ route('index') }}" class="btn btn-secondary btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l14 0" />
                                        <path d="M5 12l6 6" />
                                        <path d="M5 12l6 -6" />
                                    </svg>
                                    Kembali ke Home
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="mb-4 text-primary">Profil Singkat & Produk Unggulan PT Dirgantara Indonesia (PT DI / IAe)</h4>
                            <p class="mb-4">
                                PT Dirgantara Indonesia (Persero), atau Indonesian Aerospace (IAe), adalah BUMN yang bergerak di industri kedirgantaraan, khususnya dalam desain, pengembangan, produksi pesawat, komponen aerostruktur, serta layanan pemeliharaan dan rekayasa. Didirikan pada 23 Agustus 1976, pusat operasinya berada di Bandung, Jawa Barat.
                            </p>

                            <h5 class="mb-3 text-secondary">Produk Pesawat</h5>
                            <p><strong>Pesawat sayap tetap:</strong></p>
                            <ul class="mb-3">
                                <li><strong>CN-235:</strong> multiguna untuk militer dan sipil (pengangkutan, patroli, kargo)</li>
                                <li><strong>NC212 / NC212i:</strong> versi terbaru dari pesawat ringan, banyak digunakan untuk keperluan sipil dan militer</li>
                                <li><strong>N-219:</strong> turboprop ringan untuk penerbangan jarak pendek dan wilayah terpencil; sertifikasi diterima Desember 2020</li>
                                <li><strong>CN-295:</strong> lisensi dari Airbus Defence & Space, dirakit di Bandung</li>
                                <li><strong>Proyek pengembangan (rencana):</strong> N-245 (50-kursi turboprop) dan IPTN N-250 (prototype)</li>
                            </ul>

                            <h5 class="mb-3 text-secondary">Helikopter & Aerostruktur</h5>
                            <p>Lisensi dan produksi helikopter seperti NAS 330 Puma, NAS 332 Super Puma, H215, H225M/H225, AS365/565, H125M/H125, serta Bell 412EPI.</p>
                            <p>Produksi komponen aerostruktur untuk Boeing (737, 767) dan Airbus (A320–A380, A350), termasuk tail booms dan fuselage untuk helikopter Airbus dan Bell.</p>

                            <h5 class="mb-3 text-secondary">Layanan & Teknologi</h5>
                            <p><strong>MRO (Maintenance, Repair & Overhaul):</strong> pesawat dan mesin, menyediakan perbaikan, penggantian, dan dukungan logistik untuk berbagai pesawat (CN235, NC212, Bell412, Super Puma, Boeing 737 klasik, A320, Fokker, dll.).</p>
                            <p><strong>Aerostructure:</strong> fasilitas lengkap termasuk pemrograman CNC, sheet metal, machining, treatment permukaan, bonding komposit, dan perakitan komponen aerostruktur.</p>
                            <p><strong>Pengembangan teknologi baru:</strong> UAV (UAV Wulung, UAV MALE), simulator penerbangan, dan sistem senjata seperti roket dan torpedo.</p>
                            <p><strong>Produk pertahanan:</strong> roket R-Han 122 dengan jangkauan hingga 32 km; diproduksi kerja sama dengan LAPAN dan instansi terkait.</p>

                            <h5 class="mb-3 text-secondary">Capaian & Kerja Sama Internasional</h5>
                            <ul class="mb-3">
                                <li>Telah memproduksi dan mengirim lebih dari 400–470 pesawat ke berbagai negara dan operator global.</li>
                                <li>Ekspor dan kerjasama ke negara seperti Malaysia, Thailand, UEA, Senegal, Brunei, Pakistan, Korea Selatan, Vietnam, Filipina, Nepal, Pantai Gading, dan Australia.</li>
                                <li>Motor penggerak industri dirgantara nasional dan andalan pada pameran pertahanan seperti Indo Defence.</li>
                                <li>Kerjasama MRO dengan AMMROC (UAE) untuk memperluas kemampuan layanan global.</li>
                            </ul>

                            <h5 class="mb-3 text-secondary">Ringkasan Cepat</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Aspek</th>
                                            <th>Detail Singkat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Tahun berdiri</strong></td>
                                            <td>1976 (sebagai IPTN)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Lokasi utama</strong></td>
                                            <td>Bandung, Jawa Barat</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Produk unggulan</strong></td>
                                            <td>Pesawat (CN235, NC212i, N219, CN295), helikopter, UAV, roket</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Layanan</strong></td>
                                            <td>MRO, aerostruktur, pengembangan teknologi, simulator</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Capaian global</strong></td>
                                            <td>>400 unit pesawat dikirim ke berbagai negara, banyak kerja sama internasional</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Inovasi terbaru</strong></td>
                                            <td>UAV, roket R-Han 122, N-245, N-219 dan CN-295 versi terbaru</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
