@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        /* Search Bar CSS FIXED */
        .searchbar-wrapper {
            min-width: 50px;
            height: 30px;
            margin-left: 20px;
        }

        .searchfield {
            font-weight: 600;
            position: absolute;
            right: 0;
            width: 40px;
            height: 35px;
            outline: none;
            border: none;
            background: #fff;
            color: #111;
            text-shadow: 0 0 10px #ccc;
            padding: 0 80px 0 20px;
            border-radius: 30px;
            box-shadow: 0 2px 8px 0 #1111, 0 1px 8px 0 rgba(0, 0, 0, 0.08);
            transition: all 0.5s;
            opacity: 0.8;
            z-index: 5;
            font-weight: bolder;
            letter-spacing: 0.1em;
        }

        .searchfield:focus {
            width: 175px;
            opacity: 1;
            cursor: text;
        }

        .searchfield:hover {
            cursor: pointer;
        }

        .search {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 28px;
            height: 28px;
            background: transparent;
            border-radius: 50%;
            z-index: 6;
            pointer-events: none;
        }

        .search::before {
            content: "";
            position: absolute;
            left: 7px;
            top: 7px;
            width: 12px;
            height: 12px;
            border: 2px solid #111;
            border-radius: 50%;
            background: transparent;
            transition: 0.3s;
        }

        .search::after {
            content: "";
            position: absolute;
            left: 18px;
            top: 18px;
            width: 8px;
            height: 2px;
            background: #111;
            border-radius: 2px;
            transform: rotate(45deg);
            transition: 0.3s;
        }

        .searchfield:focus~.search::before {
            border: none;
            width: 18px;
            height: 2px;
            left: 5px;
            top: 13px;
            background: #111;
            border-radius: 2px;
            transform: rotate(45deg);
        }

        .searchfield:focus~.search::after {
            width: 18px;
            height: 2px;
            left: 5px;
            top: 13px;
            background: #111;
            border-radius: 2px;
            transform: rotate(-45deg);
        }
    </style>
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
<!-- Banner -->
<div class="youtube-banner">
  <img src="{{ asset('images/Banner.png') }}" alt="Banner Training">
</div>

<style>
.youtube-banner {
  width: 100%;
  height: auto; /* sesuaikan tinggi dengan desain */
  overflow: hidden;
  background-color: #000; /* fallback jika gambar gagal load */
}
.youtube-banner img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* crop otomatis seperti YouTube */
  display: block;
}
</style>


            <!-- Hero Section -->
            <div class="card mb-4">
                <div class="card-body text-center py-5">
                    <h1 class="card-title">Selamat Datang di PT Dirgantara Indonesia</h1>
                    <p class="card-subtitle text-muted">PT Dirgantara Indonesia (Indonesian-aircraft Industries) memproduksi
berbagai jenis pesawat untuk memenuhi kebutuhan maskapai sipil, operator militer, dan
misi-misi tertentu. Selama bertahun-tahun berkecimpung dalam desain pesawat, PTDI telah menjadi ahli dalam merancang
pesawat baru dan mengubah konfigurasi sistem serta struktur pesawat untuk misi-misi tertentu
seperti patroli maritim, pengawasan, dan penjaga pantai..</p>
                </div>
            </div>

            <!-- Informasi Utama -->
            <div class="row row-cards mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <span class="avatar avatar-xl bg-blue-lt text-blue mb-3"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-buildings">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 21v-15c0 -1 1 -2 2 -2h5c1 0 2 1 2 2v15" />
                                    <path d="M16 8h2c1 0 2 1 2 2v11" />
                                    <path d="M3 21h18" />
                                    <path d="M10 12v0" />
                                    <path d="M10 16v0" />
                                    <path d="M10 8v0" />
                                    <path d="M7 12v0" />
                                    <path d="M7 16v0" />
                                    <path d="M7 8v0" />
                                    <path d="M17 12v0" />
                                    <path d="M17 16v0" />
                                </svg></span>
                            <h3 class="card-title">Profil Perusahaan</h3>
                            <p class="text-muted">PT Dirgantara Indonesia adalah produsen pesawat terkemuka di Asia
                                Tenggara.</p>
                            <a href="{{ route('company.detail') }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <span class="avatar avatar-xl bg-green-lt text-green mb-3"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M4 20h14" />
                                </svg></span>
                            <h3 class="card-title">Statistik Produksi</h3>
                            <p class="text-muted">Lebih dari 400 pesawat telah diproduksi dan dikirim ke berbagai negara.
                            </p>
                            <a href="{{ route('production.statistics') }}" class="btn btn-success btn-sm">Lihat Data</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <span class="avatar avatar-xl bg-yellow-lt text-yellow mb-3"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-heart-handshake">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                    <path
                                        d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" />
                                    <path d="M12.5 15.5l2 2" />
                                    <path d="M15 13l2 2" />
                                </svg></span>
                            <h3 class="card-title">Layanan & Dukungan</h3>
                            <p class="text-muted">Kami menyediakan layanan MRO, pelatihan, dan dukungan teknis global.</p>
                            <a href="{{ route('services') }}" class="btn btn-warning btn-sm">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>

<!-- Apa Kata Mereka -->
<div class="card shadow-sm border-0 mb-4">
  <div class="card-header bg-primary text-white text-center">
    <h3 class="card-title mb-0">💬 Apa Kata Mereka</h3>
  </div>
  <div class="card-body">
    <div class="chat-container">

      <!-- Chat 1 -->
      <div class="chat-message left">
        <img src="{{ asset('images/idk.png') }}" class="chat-avatar" alt="Rina">
        <div class="chat-bubble">
          <p>“Bekerja di PTDI memberi saya kesempatan berkontribusi untuk negeri.”</p>
          <small class="chat-meta">Rina • Engineer Senior</small>
        </div>
      </div>

      <!-- Chat 2 -->
      <div class="chat-message left">
        <img src="{{ asset('images/idk.png') }}" class="chat-avatar" alt="Mitra Industri">
        <div class="chat-bubble">
          <p>“Kami bangga menjadi mitra PTDI dalam pengembangan teknologi dirgantara.”</p>
          <small class="chat-meta">Mitra Industri • Partner</small>
        </div>
        
      </div>

    </div>
  </div>
</div>

<style>
.chat-container {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
.chat-message {
  display: flex;
  align-items: flex-end;
  gap: 0.5rem;
}
.chat-message.left {
  justify-content: flex-start;
}
.chat-message.right {
  justify-content: flex-end;
}
.chat-avatar {
  width: 45px;
  height: 45px;
  border-radius: 50%;
}
.chat-bubble {
  max-width: 70%;
  padding: 0.8rem 1rem;
  border-radius: 15px;
  position: relative;
  background: #f1f1f1;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.chat-message.right .chat-bubble {
  background: #d1e7ff;
}
.chat-bubble p {
  margin: 0;
  font-size: 1rem;
  color: #333;
}
.chat-meta {
  display: block;
  margin-top: 0.3rem;
  font-size: 0.8rem;
  color: #666;
}
</style>



            <div class="row row-cards mb-4">
                <div class="col-sm-4">
                    <div class="card card-sm">
                        <div class="card-body text-center">
                            <div class="text-muted">Pesawat Terkirim</div>
                            <div class="h1">412</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-sm">
                        <div class="card-body text-center">
                            <div class="text-muted">Karyawan Aktif</div>
                            <div class="h1">3,200+</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-sm">
                        <div class="card-body text-center">
                            <div class="text-muted">Proyek Berjalan</div>
                            <div class="h1">18</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Video Profil Perusahaan</h3>
                </div>
                <div class="card-body">
                    <div id="videoCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Dot Indicators -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#videoCarousel" data-bs-slide-to="0" class="active"
                                aria-current="true"></button>
                            <button type="button" data-bs-target="#videoCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#videoCarousel" data-bs-slide-to="2"></button>
                        </div>

                        <!-- Carousel Items -->
                        <div class="carousel-inner">
                            <!-- Video 1 -->
                            <div class="carousel-item active">
                                <div class="ratio ratio-16x9">
                                    <video autoplay muted playsinline loop>
                                        <source src="{{ asset('videos/slide4.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>

                            <!-- Video 2 -->
                            <div class="carousel-item">
                                <div class="ratio ratio-16x9">
                                    <video autoplay muted playsinline loop>
                                        <source src="{{ asset('videos/slide5.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>

                            <!-- Video 3 -->
                            <div class="carousel-item">
                                <div class="ratio ratio-16x9">
                                    <video autoplay muted playsinline loop>
                                        <source src="{{ asset('videos/slide6.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Arrows -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#videoCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#videoCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row row-cards mb-4">
                <div class="col-md-3">
                    <a href="{{ route('fortal.hr') }}" class="card card-link">
                        <div class="card-body text-center">
                            <span class="avatar bg-primary-lt text-primary mb-2"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                </svg></span>
                            <div>Fortal HR</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('sistem-training') }}" class="card card-link">
                        <div class="card-body text-center">
                            <span class="avatar bg-success-lt text-success mb-2"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-school">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                                    <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                                </svg></span>
                            <div>Sistem Training</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('laporan.data') }}" class="card card-link">
                        <div class="card-body text-center">
                            <span class="avatar bg-warning-lt text-warning mb-2"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-brand-google-analytics">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10 9m0 1.105a1.105 1.105 0 0 1 1.105 -1.105h1.79a1.105 1.105 0 0 1 1.105 1.105v9.79a1.105 1.105 0 0 1 -1.105 1.105h-1.79a1.105 1.105 0 0 1 -1.105 -1.105z" />
                                    <path
                                        d="M17 3m0 1.105a1.105 1.105 0 0 1 1.105 -1.105h1.79a1.105 1.105 0 0 1 1.105 1.105v15.79a1.105 1.105 0 0 1 -1.105 1.105h-1.79a1.105 1.105 0 0 1 -1.105 -1.105z" />
                                    <path d="M5 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                </svg></span>
                            <div>laporan data</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('kontak.divisi') }}" class="card card-link">
                        <div class="card-body text-center">
                            <span class="avatar bg-info-lt text-info mb-2"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-phone">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                </svg></span>
                            <div>Kontak Divisi</div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Informasi Tambahan</h3>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordion-example">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-one">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-one" aria-expanded="true">
                                    Sejarah Perusahaan
                                </button>
                            </h2>
                            <div id="collapse-one" class="accordion-collapse collapse show"
                                data-bs-parent="#accordion-example">
                                <div class="accordion-body">
                                    PT Dirgantara Indonesia (PTDI), sebelumnya dikenal sebagai IPTN, berdiri pada 26 April
                                    1976 atas gagasan B.J. Habibie dan diresmikan Presiden Soeharto. Akar industrinya sudah
                                    dimulai sejak 1953 melalui lembaga penerbangan milik AURI (kemudian LIPNUR).

                                    Sejak berdiri, PTDI telah mengembangkan dan memproduksi berbagai pesawat, seperti
                                    helikopter NBO-105, NC-212, CN-235, hingga N-219 yang mendapat sertifikasi pada 2020.

                                    Perusahaan ini sempat terdampak krisis 1998 dan berganti nama menjadi PTDI pada tahun
                                    2000. Kini, PTDI menjadi bagian dari DEFEND ID (holding industri pertahanan nasional)
                                    dengan fokus pada pengembangan pesawat terbang, helikopter, dan UAV untuk kebutuhan
                                    sipil maupun militer.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-products">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-products" aria-expanded="true"
                                    aria-controls="collapse-products">
                                    Produk & Layanan
                                </button>
                            </h2>
                            <div id="collapse-products" class="accordion-collapse collapse show"
                                aria-labelledby="heading-products" data-bs-parent="#accordion-products">
                                <div class="accordion-body">

                                    <h6 class="text-primary">Pesawat Terbang</h6>
                                    <ul>
                                        <li><strong>NC212i</strong> – Pesawat angkut ringan 28 kursi, penumpang & misi
                                            khusus.</li>
                                        <li><strong>CN235</strong> – Pesawat turboprop multiguna (penumpang, patroli
                                            maritim, transport militer).</li>
                                        <li><strong>C295</strong> – Pesawat angkut sedang hasil kolaborasi dengan Airbus.
                                        </li>
                                        <li><strong>N219 "Nurtanio"</strong> – Pesawat komuter 19 penumpang, cocok bandara
                                            kecil & daerah terpencil.</li>
                                    </ul>

                                    <h6 class="text-primary">Helikopter</h6>
                                    <ul>
                                        <li><strong>NBO-105</strong></li>
                                        <li><strong>NAS-332 Super Puma</strong></li>
                                        <li><strong>NBell-412</strong></li>
                                        <li>Produksi, perakitan, dan modifikasi helikopter berlisensi sipil & militer.</li>
                                    </ul>

                                    <h6 class="text-primary">Engineering & MRO</h6>
                                    <ul>
                                        <li>Maintenance, Repair & Overhaul (MRO) pesawat dan helikopter.</li>
                                        <li>Rekayasa teknik: desain, prototyping, integrasi sistem avionik.</li>
                                        <li>Penyediaan suku cadang & upgrade sistem pesawat.</li>
                                    </ul>

                                    <h6 class="text-primary">Inovasi & Kolaborasi</h6>
                                    <ul>
                                        <li>Kerja sama dengan <strong>Airbus Defense & Space</strong> (CN235/C295).</li>
                                        <li>Proyek pesawat tempur <strong>KF-21 Boramae</strong> bersama Korea Selatan.</li>
                                        <li>Pengembangan UAV (drone) seperti <strong>Elang Hitam</strong> untuk pertahanan
                                            udara.</li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-three">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-three">
                                    Visi & Misi
                                </button>
                            </h2>
                            <div id="collapse-three" class="accordion-collapse collapse"
                                data-bs-parent="#accordion-example">
                                <div class="accordion-body">
                                    <strong>Visi:</strong><br>
                                    Menjadi market leader pesawat terbang turboprop kelas menengah dan ringan, serta menjadi
                                    acuan dari perusahaan dirgantara di wilayah Asia Pasifik dengan mengoptimalkan
                                    kompetensi industri dan komersial terbaik.
                                    <br><br>
                                    <strong>Misi:</strong><br>
                                    1. Menjadi pusat kompetensi dalam industri kedirgantaraan dan misi militer serta untuk
                                    aplikasi non-aerospace yang relevan.<br>
                                    2. Menjadi pemain kunci di industri global melalui aliansi strategis dengan industri
                                    dirgantara kelas dunia lainnya.<br>
                                    3. Memberikan produk dan jasa yang kompetitif dalam hal kualitas dan biaya.

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kritik & Saran -->
<div class="card shadow-sm border-0 mb-4" id="feedback">
  <div class="card-header bg-primary text-white text-center">
    <h3 class="card-title mb-0">✉️ Kritik & Saran</h3>
  </div>
  <div class="card-body">
    <form action="{{ route('feedback') }}" method="POST">
      @csrf
      @if (session('success'))
        <div class="alert alert-success rounded-3 shadow-sm">
          {{ session('success') }}
        </div>
      @endif

      <!-- Nama -->
      <div class="mb-3">
        <label class="form-label fw-bold">
          <i class="bi bi-person-circle me-1"></i> Nama
        </label>
        <input 
          type="text" 
          class="form-control form-control-lg rounded-3" 
          name="nama_pengirim" 
          placeholder="Masukkan nama Anda" 
          required>
      </div>

      <!-- Pesan -->
      <div class="mb-3">
        <label class="form-label fw-bold">
          <i class="bi bi-chat-dots me-1"></i> Pesan
        </label>
        <textarea 
          class="form-control form-control-lg rounded-3" 
          name="pesan" 
          rows="4" 
          placeholder="Tulis saran atau masukan Anda..." 
          required></textarea>
      </div>

      <!-- Tombol Kirim -->
      <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm">
          <i class="bi bi-send-fill me-1"></i> Kirim
        </button>
      </div>
    </form>
  </div>
</div>

<style>
#feedback .form-control {
  border: 2px solid #e9ecef;
  transition: all 0.3s ease;
}
#feedback .form-control:focus {
  border-color: #0d6efd;
  box-shadow: 0 0 8px rgba(13,110,253,0.2);
}
#feedback textarea {
  resize: none;
}
</style>


        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
                chart: {
                    type: "area",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: .16,
                    type: 'solid'
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "Profits",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93,
                        53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67
                    ]
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24',
                    '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29',
                    '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04',
                    '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09',
                    '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14',
                    '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                ],
                colors: [tabler.getColor("primary")],
                legend: {
                    show: false,
                },
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-clients'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                fill: {
                    opacity: 1,
                },
                stroke: {
                    width: [2, 1],
                    dashArray: [0, 3],
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "May",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93,
                        53, 61, 27, 54, 43, 4, 46, 39, 62, 51, 35, 41, 67
                    ]
                }, {
                    name: "April",
                    data: [93, 54, 51, 24, 35, 35, 31, 67, 19, 43, 28, 36, 62, 61, 27, 39, 35,
                        41, 27, 35, 51, 46, 62, 37, 44, 53, 41, 65, 39, 37
                    ]
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24',
                    '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29',
                    '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04',
                    '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09',
                    '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14',
                    '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                ],
                colors: [tabler.getColor("primary"), tabler.getColor("gray-600")],
                legend: {
                    show: false,
                },
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-active-users'), {
                chart: {
                    type: "bar",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%',
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                    name: "Profits",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93,
                        53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67
                    ]
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24',
                    '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29',
                    '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04',
                    '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09',
                    '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14',
                    '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                ],
                colors: [tabler.getColor("primary")],
                legend: {
                    show: false,
                },
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
                chart: {
                    type: "bar",
                    fontFamily: 'inherit',
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false
                    },
                    stacked: true,
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%',
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                    name: "Web",
                    data: [1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 2, 12, 5, 8, 22, 6, 8, 6, 4, 1, 8, 24,
                        29, 51, 40, 47, 23, 26, 50, 26, 41, 22, 46, 47, 81, 46, 6
                    ]
                }, {
                    name: "Social",
                    data: [2, 5, 4, 3, 3, 1, 4, 7, 5, 1, 2, 5, 3, 2, 6, 7, 7, 1, 5, 5, 2, 12, 4,
                        6, 18, 3, 5, 2, 13, 15, 20, 47, 18, 15, 11, 10, 0
                    ]
                }, {
                    name: "Other",
                    data: [2, 9, 1, 7, 8, 3, 6, 5, 5, 4, 6, 4, 1, 9, 3, 6, 7, 5, 2, 8, 4, 9, 1,
                        2, 6, 7, 5, 1, 8, 3, 2, 3, 4, 9, 7, 1, 6
                    ]
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4
                    },
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    },
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24',
                    '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29',
                    '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04',
                    '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09',
                    '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14',
                    '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19',
                    '2020-07-20', '2020-07-21', '2020-07-22', '2020-07-23', '2020-07-24',
                    '2020-07-25', '2020-07-26'
                ],
                colors: [tabler.getColor("primary"), tabler.getColor("primary", 0.8), tabler.getColor(
                    "green", 0.8)],
                legend: {
                    show: false,
                },
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            const map = new jsVectorMap({
                selector: '#map-world',
                map: 'world',
                backgroundColor: 'transparent',
                regionStyle: {
                    initial: {
                        fill: tabler.getColor('body-bg'),
                        stroke: tabler.getColor('border-color'),
                        strokeWidth: 2,
                    }
                },
                zoomOnScroll: false,
                zoomButtons: false,
                // -------- Series --------
                visualizeData: {
                    scale: [tabler.getColor('bg-surface'), tabler.getColor('primary')],
                    values: {
                        "AF": 16,
                        "AL": 11,
                        "DZ": 158,
                        "AO": 85,
                        "AG": 1,
                        "AR": 351,
                        "AM": 8,
                        "AU": 1219,
                        "AT": 366,
                        "AZ": 52,
                        "BS": 7,
                        "BH": 21,
                        "BD": 105,
                        "BB": 3,
                        "BY": 52,
                        "BE": 461,
                        "BZ": 1,
                        "BJ": 6,
                        "BT": 1,
                        "BO": 19,
                        "BA": 16,
                        "BW": 12,
                        "BR": 2023,
                        "BN": 11,
                        "BG": 44,
                        "BF": 8,
                        "BI": 1,
                        "KH": 11,
                        "CM": 21,
                        "CA": 1563,
                        "CV": 1,
                        "CF": 2,
                        "TD": 7,
                        "CL": 199,
                        "CN": 5745,
                        "CO": 283,
                        "KM": 0,
                        "CD": 12,
                        "CG": 11,
                        "CR": 35,
                        "CI": 22,
                        "HR": 59,
                        "CY": 22,
                        "CZ": 195,
                        "DK": 304,
                        "DJ": 1,
                        "DM": 0,
                        "DO": 50,
                        "EC": 61,
                        "EG": 216,
                        "SV": 21,
                        "GQ": 14,
                        "ER": 2,
                        "EE": 19,
                        "ET": 30,
                        "FJ": 3,
                        "FI": 231,
                        "FR": 2555,
                        "GA": 12,
                        "GM": 1,
                        "GE": 11,
                        "DE": 3305,
                        "GH": 18,
                        "GR": 305,
                        "GD": 0,
                        "GT": 40,
                        "GN": 4,
                        "GW": 0,
                        "GY": 2,
                        "HT": 6,
                        "HN": 15,
                        "HK": 226,
                        "HU": 132,
                        "IS": 12,
                        "IN": 1430,
                        "ID": 695,
                        "IR": 337,
                        "IQ": 84,
                        "IE": 204,
                        "IL": 201,
                        "IT": 2036,
                        "JM": 13,
                        "JP": 5390,
                        "JO": 27,
                        "KZ": 129,
                        "KE": 32,
                        "KI": 0,
                        "KR": 986,
                        "KW": 117,
                        "KG": 4,
                        "LA": 6,
                        "LV": 23,
                        "LB": 39,
                        "LS": 1,
                        "LR": 0,
                        "LY": 77,
                        "LT": 35,
                        "LU": 52,
                        "MK": 9,
                        "MG": 8,
                        "MW": 5,
                        "MY": 218,
                        "MV": 1,
                        "ML": 9,
                        "MT": 7,
                        "MR": 3,
                        "MU": 9,
                        "MX": 1004,
                        "MD": 5,
                        "MN": 5,
                        "ME": 3,
                        "MA": 91,
                        "MZ": 10,
                        "MM": 35,
                        "NA": 11,
                        "NP": 15,
                        "NL": 770,
                        "NZ": 138,
                        "NI": 6,
                        "NE": 5,
                        "NG": 206,
                        "NO": 413,
                        "OM": 53,
                        "PK": 174,
                        "PA": 27,
                        "PG": 8,
                        "PY": 17,
                        "PE": 153,
                        "PH": 189,
                        "PL": 438,
                        "PT": 223,
                        "QA": 126,
                        "RO": 158,
                        "RU": 1476,
                        "RW": 5,
                        "WS": 0,
                        "ST": 0,
                        "SA": 434,
                        "SN": 12,
                        "RS": 38,
                        "SC": 0,
                        "SL": 1,
                        "SG": 217,
                        "SK": 86,
                        "SI": 46,
                        "SB": 0,
                        "ZA": 354,
                        "ES": 1374,
                        "LK": 48,
                        "KN": 0,
                        "LC": 1,
                        "VC": 0,
                        "SD": 65,
                        "SR": 3,
                        "SZ": 3,
                        "SE": 444,
                        "CH": 522,
                        "SY": 59,
                        "TW": 426,
                        "TJ": 5,
                        "TZ": 22,
                        "TH": 312,
                        "TL": 0,
                        "TG": 3,
                        "TO": 0,
                        "TT": 21,
                        "TN": 43,
                        "TR": 729,
                        "TM": 0,
                        "UG": 17,
                        "UA": 136,
                        "AE": 239,
                        "GB": 2258,
                        "US": 4624,
                        "UY": 40,
                        "UZ": 37,
                        "VU": 0,
                        "VE": 285,
                        "VN": 101,
                        "YE": 30,
                        "ZM": 15,
                        "ZW": 5
                    },
                },
            });
            window.addEventListener("resize", () => {
                map.updateSize();
            });
        });
        // @formatter:off
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-activity'), {
                chart: {
                    type: "radialBar",
                    fontFamily: 'inherit',
                    height: 40,
                    width: 40,
                    animations: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    },
                },
                tooltip: {
                    enabled: false,
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 0,
                            size: '75%'
                        },
                        track: {
                            margin: 0
                        },
                        dataLabels: {
                            show: false
                        }
                    }
                },
                colors: [tabler.getColor("blue")],
                series: [35],
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-development-activity'), {
                chart: {
                    type: "area",
                    fontFamily: 'inherit',
                    height: 192,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: .16,
                    type: 'solid'
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "Purchases",
                    data: [3, 5, 4, 6, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 8, 4, 14, 30, 17, 19, 15,
                        14, 25, 32, 40, 55, 60, 48, 52, 70
                    ]
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24',
                    '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29',
                    '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04',
                    '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09',
                    '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14',
                    '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                ],
                colors: [tabler.getColor("primary")],
                legend: {
                    show: false,
                },
                point: {
                    show: false
                },
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-1'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 24,
                    animations: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    },
                },
                tooltip: {
                    enabled: false,
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                },
                series: [{
                    color: tabler.getColor("primary"),
                    data: [17, 24, 20, 10, 5, 1, 4, 18, 13]
                }],
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-2'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 24,
                    animations: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    },
                },
                tooltip: {
                    enabled: false,
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                },
                series: [{
                    color: tabler.getColor("primary"),
                    data: [13, 11, 19, 22, 12, 7, 14, 3, 21]
                }],
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-3'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 24,
                    animations: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    },
                },
                tooltip: {
                    enabled: false,
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                },
                series: [{
                    color: tabler.getColor("primary"),
                    data: [10, 13, 10, 4, 17, 3, 23, 22, 19]
                }],
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-4'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 24,
                    animations: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    },
                },
                tooltip: {
                    enabled: false,
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                },
                series: [{
                    color: tabler.getColor("primary"),
                    data: [6, 15, 13, 13, 5, 7, 17, 20, 19]
                }],
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-5'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 24,
                    animations: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    },
                },
                tooltip: {
                    enabled: false,
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                },
                series: [{
                    color: tabler.getColor("primary"),
                    data: [2, 11, 15, 14, 21, 20, 8, 23, 18, 14]
                }],
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-6'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 24,
                    animations: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    },
                },
                tooltip: {
                    enabled: false,
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                },
                series: [{
                    color: tabler.getColor("primary"),
                    data: [22, 12, 7, 14, 3, 21, 8, 23, 18, 14]
                }],
            })).render();
        });
        // @formatter:on
    </script>
@endpush
