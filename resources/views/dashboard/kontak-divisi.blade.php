@extends('layouts.app')

@section('title', 'Kontak Divisi')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="page-title">Kontak Divisi PT Dirgantara Indonesia</h1>
                <p class="text-muted">Informasi kontak untuk berbagai divisi perusahaan. Klik pada kartu untuk melihat detail lengkap.</p>
            </div>
        </div>

        <div class="row row-cards">
            <!-- PPID Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                        <span class="avatar avatar-xl bg-primary-lt text-primary mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
                                <path d="M12 9h.01"/>
                                <path d="M11 12h1v4h1"/>
                            </svg>
                        </span>
                        <h3 class="card-title">PPID</h3>
                        <p class="text-muted">Pejabat Pengelola Informasi Publik</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ppidModal">Lihat Detail</button>
                    </div>
                </div>
            </div>

            <!-- Marketing Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                        <span class="avatar avatar-xl bg-success-lt text-success mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trending-up">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 17l6 -6l4 4l8 -8"/>
                                <path d="M14 7l7 0l0 7"/>
                            </svg>
                        </span>
                        <h3 class="card-title">Pemasaran</h3>
                        <p class="text-muted">Marketing Division</p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#marketingModal">Lihat Detail</button>
                    </div>
                </div>
            </div>

            <!-- Public Relations Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                        <span class="avatar avatar-xl bg-warning-lt text-warning mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-speakerphone">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M18 8a3 3 0 0 1 0 6"/>
                                <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5"/>
                                <path d="M12 8h0l4.524 -3.77a.9 .9 0 0 1 1.476 .692v12.156a.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8"/>
                            </svg>
                        </span>
                        <h3 class="card-title">Humas</h3>
                        <p class="text-muted">Public Relations</p>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#humasModal">Lihat Detail</button>
                    </div>
                </div>
            </div>

            <!-- Secretariat Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                        <span class="avatar avatar-xl bg-info-lt text-info mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/>
                                <path d="M9 9h1"/>
                                <path d="M9 13h6"/>
                                <path d="M9 17h6"/>
                            </svg>
                        </span>
                        <h3 class="card-title">Sekretariat</h3>
                        <p class="text-muted">Secretariat Division</p>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#sekretariatModal">Lihat Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PPID Modal -->
<div class="modal fade" id="ppidModal" tabindex="-1" aria-labelledby="ppidModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ppidModalLabel">PPID - Pejabat Pengelola Informasi Publik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Untuk permintaan informasi publik secara resmi—seperti laporan bulanan, data operasional, jumlah karyawan, atau performa penjualan—kamu bisa langsung mengajukan permohonan ke PPID PT DI.</p>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Alamat Kantor:</h6>
                        <p>Jl. Pajajaran No. 154, Bandung 40174, Jawa Barat, Indonesia</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Email:</h6>
                        <p><a href="mailto:pid@indonesian-aerospace.com">pid@indonesian-aerospace.com</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Jam Operasional:</h6>
                        <ul>
                            <li>Senin–Kamis: 09.00–11.30 WIB & 13.00–16.00 WIB</li>
                            <li>Jumat: 09.00–11.00 WIB & 14.00–17.00 WIB</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Website:</h6>
                        <p><a href="https://ppid.indonesian-aerospace.com" target="_blank">ppid.indonesian-aerospace.com</a></p>
                    </div>
                </div>
                <div class="alert alert-info">
                    <strong>Rekomendasi:</strong> Ajukan permohonan resmi jika kamu ingin mengakses dokumen seperti laporan bulanan, penjualan pesawat, data karyawan baru, atau dokumen internal lainnya. Sertakan substansi permintaanmu agar lebih cepat diproses (misalnya spesifik jenis laporan, rentang waktu, dll.).
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Marketing Modal -->
<div class="modal fade" id="marketingModal" tabindex="-1" aria-labelledby="marketingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="marketingModalLabel">Pemasaran - Marketing Division</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Divisi Pemasaran PT Dirgantara Indonesia menangani semua aspek pemasaran, penjualan, dan promosi produk perusahaan.</p>
                <h6>Email:</h6>
                <p><a href="mailto:marketing-ptdi@indonesian-aerospace.com">marketing-ptdi@indonesian-aerospace.com</a></p>
                <div class="alert alert-success">
                    <strong>Rekomendasi:</strong> Jika kamu ingin konteks yang lebih umum (press release, informasi pemasaran, peluang kerja sama), kamu bisa hubungi divisi Marketing.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Humas Modal -->
<div class="modal fade" id="humasModal" tabindex="-1" aria-labelledby="humasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="humasModalLabel">Humas - Public Relations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Divisi Hubungan Masyarakat PT Dirgantara Indonesia bertanggung jawab atas komunikasi eksternal, media relations, dan citra perusahaan.</p>
                <h6>Email:</h6>
                <p><a href="mailto:pub-rel@indonesian-aerospace.com">pub-rel@indonesian-aerospace.com</a></p>
                <div class="alert alert-warning">
                    <strong>Rekomendasi:</strong> Jika kamu ingin konteks yang lebih umum (press release, informasi pemasaran, peluang kerja sama), kamu bisa hubungi divisi Humas.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Secretariat Modal -->
<div class="modal fade" id="sekretariatModal" tabindex="-1" aria-labelledby="sekretariatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sekretariatModalLabel">Sekretariat - Secretariat Division</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Divisi Sekretariat PT Dirgantara Indonesia menangani administrasi umum, korespondensi, dan dukungan operasional perusahaan.</p>
                <h6>Email:</h6>
                <p><a href="mailto:sekretariatptdi@indonesian-aerospace.com">sekretariatptdi@indonesian-aerospace.com</a></p>
                <div class="alert alert-info">
                    <strong>Rekomendasi:</strong> Untuk pertanyaan umum atau dukungan administrasi, hubungi divisi Sekretariat.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
