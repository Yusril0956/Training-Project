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

        #logo-animasi.animating {
            opacity: 1 !important;
            transform: scale(2) rotate(360deg);
            transition: opacity 0.3s, transform 0.6s cubic-bezier(.68,-0.55,.27,1.55);
        }
        #btn-mulai-training[disabled] {
            pointer-events: none;
            opacity: 0.7;
        }
        /* Entrance animation for training page */
        #training-entrance-logo {
            position: fixed;
            top: 50%;
            left: 50%;
            z-index: 9999;
            width: 120px;
            height: 120px;
            transform: translate(-50%, -50%) scale(0.7);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s, transform 0.7s cubic-bezier(.68,-0.55,.27,1.55);
        }
        #training-entrance-logo.show {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.2) rotate(360deg);
        }
        #training-entrance-logo.hide {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.7) rotate(0deg);
            transition: opacity 0.3s, transform 0.5s;
        }
    </style>
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
<!-- 🌸 Banner Section -->
<div class="youtube-banner">
    <div class="banner-wrapper">
        <img src="{{ asset('images/pN219.png') }}" alt="Banner Training">
        <a href="{{ url('/training') }}" class="btn-mulai">
            Mulai Training Sekarang
        </a>
    </div>
</div>

<style>
/* === Banner Styling === */
.youtube-banner {
    position: relative;
    width: 100%;
    overflow: hidden;
    border-radius: 20px; /* sudut lembut */
    background-color: #f5f6fa; /* warna pastel lembut */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
}

/* Bungkus agar tinggi proporsional dan responsif */
.youtube-banner .banner-wrapper {
    position: relative;
    width: 100%;
    padding-top: 45%; /* rasio tinggi */
    overflow: hidden;
}

/* Gambar utama */
.youtube-banner img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border-radius: 20px;
    transition: transform 0.7s ease, filter 0.5s ease;
}

/* Tombol "Mulai Sekarang" */
.youtube-banner .btn-mulai {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -40%);
    opacity: 0;
    background-color: #2b4d8f;
    color: #fff;
    font-weight: 600;
    font-size: 1.1rem;
    padding: 12px 28px;
    border-radius: 30px;
    text-decoration: none;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 10px rgba(43, 77, 143, 0.2);
    transition: opacity 0.4s ease, transform 0.4s ease, background-color 0.3s ease;
}

/* Hover efek pada banner */
.youtube-banner:hover img {
    transform: scale(1.05);
    filter: blur(4px) brightness(0.9);
}

/* Saat di-hover, tombol muncul halus */
.youtube-banner:hover .btn-mulai {
    opacity: 1;
    transform: translate(-50%, -50%);
}

/* Hover efek tombol */
.youtube-banner .btn-mulai:hover {
    background-color: #3b5fc4;
    box-shadow: 0 6px 15px rgba(43, 77, 143, 0.3);
}
</style>




            <!-- 🌸 Hero Section -->
<section class="hero-section my-5">
    <div class="card hero-card shadow-sm border-0">
        <div class="card-body text-center py-5 px-4">
            <h1 class="card-title fw-bold text-primary mb-3">
                Selamat Datang di PT Dirgantara Indonesia
            </h1>
            <p class="card-text text-secondary mx-auto" style="max-width: 800px; line-height: 1.8;">
                PT Dirgantara Indonesia (Indonesian Aerospace) memproduksi berbagai jenis pesawat 
                untuk memenuhi kebutuhan maskapai sipil, operator militer, dan misi-misi tertentu. 
                Selama bertahun-tahun berkecimpung dalam desain pesawat, PTDI telah menjadi ahli 
                dalam merancang pesawat baru serta mengubah konfigurasi sistem dan struktur pesawat 
                untuk misi-misi khusus seperti patroli maritim, pengawasan, dan penjaga pantai.
            </p>
        </div>
    </div>
</section>

<style>
/* === Hero Section Styling === */
.hero-section {
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero-card {
    background: linear-gradient(135deg, #fdfbfb, #ebedee); /* warna pastel lembut */
    border-radius: 20px;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

/* Efek lembut saat hover */
.hero-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

/* Judul dan teks */
.hero-card .card-title {
    font-size: 2rem;
    color: #2b4d8f;
}

.hero-card .card-text {
    font-size: 1rem;
    color: #555;
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

                <!-- 🌸 Kartu Kontak Divisi -->
<div class="col-md-3 col-sm-6 mb-4">
    <a href="{{ route('kontak.divisi') }}" class="card card-link kontak-card text-decoration-none">
        <div class="card-body text-center py-4">
            <div class="icon-wrapper mb-3">
                <span class="avatar bg-info-subtle text-info d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icon-tabler-phone">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    </svg>
                </span>
            </div>
            <h6 class="fw-semibold text-dark mb-0">Kontak Divisi</h6>
        </div>
    </a>
</div>

<style>
/* === Kartu Kontak Divisi === */
.kontak-card {
    border: none;
    border-radius: 16px;
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.kontak-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
}

.kontak-card .icon-wrapper .avatar {
    width: 70px;
    height: 70px;
    font-size: 1.4rem;
    transition: transform 0.4s ease, background-color 0.3s ease;
}

.kontak-card:hover .icon-wrapper .avatar {
    transform: rotate(10deg) scale(1.1);
    background-color: #e8f6ff;
}

.kontak-card h6 {
    font-size: 1.05rem;
    color: #2b4d8f;
    transition: color 0.3s ease;
}

.kontak-card:hover h6 {
    color: #3b5fc4;
}
</style>

            <!-- Informasi Tambahan -->
<div class="card shadow-lg border-0 mb-5">
  <div class="card-header bg-primary text-white text-center py-3">
    <h3 class="card-title mb-0">
      📌 Informasi Tambahan
    </h3>
  </div>

  <div class="card-body">
    <div class="accordion accordion-flush" id="accordionInfo">

      <!-- Sejarah Perusahaan -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button
            class="accordion-button"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseOne"
            aria-expanded="true"
          >
            🏛️ Sejarah Perusahaan
          </button>
        </h2>

        <div
          id="collapseOne"
          class="accordion-collapse collapse show"
          data-bs-parent="#accordionInfo"
        >
          <div class="accordion-body sejarah-text">
            <p>
              Awal mula PT. Dirgantara Indonesia (Indonesian Aerospace Inc.) sebenarnya telah muncul sejak masa awal kemerdekaan Indonesia. Saat itu, upaya perintisan dilakukan dengan peralatan dan material yang cukup sederhana. Tercatat dalam sejarah, pesawat pertama yang diterbangkan tahun 1948 di lapangan udara Maospati dengan nama RIX WEL-1 hasil karya Wiwik Soepomo. Pada tahun 1954, Nurtanio Pringgoadisuryo pun berhasil merancang pesawat dengan nama NU-200. Tidak hanya itu, badan yang diprakarsai Nurtanio bernama Depot Penyelidikan, Percobaan, dan Pembuatan Pesawat Terbang (DPPP) yang didirikan Agustus 1956 telah mampu membuat pesawat terbang eksperimental seperti Belalang (pesawat latih), Si Kunang (pesawat olahraga), Kolintang, dan Gelatik.
            </p>

            <p>
              Pada tahun 1962, nama DPPP diubah menjadi Lembaga Persiapan Industri Penerbangan (LAPIP) sesuai dengan misi dan sasaran yang ingin dicapai. Selanjutnya, pada tahun 1966 diubah menjadi Lembaga Industri Penerbangan Nurtanio (LIPNUR) sebagai penghormatan atas jasa-jasa Nurtanio yang meninggal saat uji terbang.
            </p>

            <p>
              Perkembangan industri penerbangan nasional kemudian memasuki tonggak pertama ketika aset LIPNUR (TNI AU) dengan ATTP (Pertamina) dilebur menjadi Industri Pesawat Terbang Nurtanio (IPTN) pada 23 Agustus 1976. Industri ini menjadi salah satu kekuatan dirgantara nasional karena dari situlah sejarah industri pesawat terbang modern Indonesia mulai dibangun dan dipacu percepatannya untuk menghadapi tantangan zaman.
            </p>

            <p>
              Pada periode ini, segala aspek seperti infrastruktur, fasilitas, sumber daya manusia, hukum, dan peraturan yang berkaitan dengan industri pesawat terbang diatur secara menyeluruh. Tanggal 11 Oktober 1985, PT Industri Pesawat Terbang Nurtanio diubah menjadi PT Industri Pesawat Terbang Nusantara (IPTN) setelah pembangunan fasilitas serta sarana dan prasarana yang diperlukan. Industri ini kemudian mengembangkan teknologi canggih dan menerapkan konsep transformasi teknologi sebagai upaya untuk menguasai teknologi penerbangan dalam waktu yang relatif singkat, yaitu 20 tahun.
            </p>

            <p>
              Berpegangan pada filosofi transformasi teknologi “Begin at the end and end at the beginning”, IPTN berhasil mentransfer teknologi penerbangan yang rumit dan terbaru. IPTN secara khusus telah menguasai desain pesawat terbang, rekayasa pengembangan, serta manufaktur pesawat komuter kecil dan sedang. IPTN bekerja sama dengan berbagai pihak pabrikan dalam pembuatan pesawat seperti NC 212 Aviocar, CN 235, NBO 105, NBK 117, BN 109, SA 330 Puma, NAS 332 Super Puma, dan Nbell 412. Keberhasilan ini kemudian berlanjut pada pembuatan pesawat N250 dan N2130.
            </p>

            <p>
              Di tengah memburuknya kondisi IPTN, Presiden RI KH. Abdurrahman Wahid pada tanggal 24 Agustus 2000 meresmikan perubahan nama IPTN menjadi PT Dirgantara Indonesia (Persero). Perubahan nama tersebut dimaksudkan untuk memberi napas dan paradigma baru bagi perusahaan. Meskipun tantangan semakin kompleks, seperti volume bisnis yang menurun, budaya organisasi yang tidak sehat, lemahnya fungsi direksi, dan beban keuangan yang berat, PT DI tetap dipertahankan karena merupakan aset nasional dan industri strategis yang mendukung kepentingan kedirgantaraan Indonesia.
            </p>

            <p>
              Di bawah pimpinan B.J. Habibie, yang menerapkan Progressive Manufacturing Plan (PMP), para karyawan IPTN telah berhasil melalui fase alih teknologi. Pada fase ini, beberapa helikopter (Rotary Wing) dan pesawat bersayap tetap (Fixed Wing) berhasil diproduksi dan dipasarkan. Program pertama PT IPTN adalah memproduksi helikopter NBO-105 di bawah lisensi dari Messerschmitt-Bölkow-Blohm (MBB) Jerman Barat. Untuk jenis pesawat bersayap tetap, IPTN memproduksi NC-212 Aviocar di bawah lisensi dari Construcciones Aeronáuticas SA (CASA) Spanyol.
            </p>

            <p>
              Selanjutnya, pada tahun 1979 ditandatangani kerja sama antara PT IPTN dan Aérospatiale Prancis untuk memproduksi helikopter NAS-330 Puma dan NAS-332 Super Puma. Pada tahun yang sama pula, PT IPTN bekerja sama dengan CASA membentuk usaha patungan bernama Aircraft Technology Industries (Airtech) yang berkedudukan di Madrid, Spanyol, dengan modal 50%-50%. Program pertama Airtech adalah merancang dan memproduksi pesawat angkut serbaguna CN-235, yang menggunakan dua mesin turboprop CT-7 buatan General Electric, Amerika Serikat, dengan kapasitas 35–44 penumpang. Pesawat ini diumumkan ke dunia oleh Prof. Dr. Ing. B.J. Habibie pada Paris Air Show ke-34 tanggal 10 Juni 1981.
            </p>
          </div>
        </div>
      </div>

      <style>
        .sejarah-text p {
          text-indent: 2em;
          text-align: justify;
          margin-bottom: 1rem;
          line-height: 1.7;
        }
      </style>

      <!-- Produk & Layanan -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingProducts">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseProducts"
            aria-expanded="false"
          >
            🛠️ Produk & Layanan
          </button>
        </h2>
        <div
          id="collapseProducts"
          class="accordion-collapse collapse"
          data-bs-parent="#accordionInfo"
        >
          <div class="accordion-body">
            <h6 class="text-primary fw-bold mb-2">✈️ Pesawat Terbang</h6>
            <ul>
              <li><strong>NC212i</strong> – Pesawat angkut ringan 28 kursi.</li>
              <li><strong>CN235</strong> – Pesawat turboprop multiguna.</li>
              <li><strong>C295</strong> – Pesawat angkut sedang hasil kolaborasi dengan Airbus.</li>
              <li><strong>N219 "Nurtanio"</strong> – Pesawat komuter 19 penumpang untuk bandara kecil & daerah terpencil.</li>
            </ul>

            <h6 class="text-primary fw-bold mt-3 mb-2">🚁 Helikopter</h6>
            <ul>
              <li><strong>NBO-105</strong></li>
              <li><strong>NAS-332 Super Puma</strong></li>
              <li><strong>NBell-412</strong></li>
              <li>Produksi, perakitan, dan modifikasi helikopter sipil & militer.</li>
            </ul>

            <h6 class="text-primary fw-bold mt-3 mb-2">⚙️ Engineering & MRO</h6>
            <ul>
              <li>Maintenance, Repair & Overhaul (MRO).</li>
              <li>Rekayasa teknik: desain, prototyping, integrasi avionik.</li>
              <li>Penyediaan suku cadang & upgrade sistem pesawat.</li>
            </ul>

            <h6 class="text-primary fw-bold mt-3 mb-2">🤝 Inovasi & Kolaborasi</h6>
            <ul>
              <li>Kerja sama dengan <strong>Airbus Defense & Space</strong> (CN235/C295).</li>
              <li>Proyek <strong>KF-21 Boramae</strong> bersama Korea Selatan.</li>
              <li>Pengembangan UAV seperti <strong>Elang Hitam</strong> untuk pertahanan udara.</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Visi & Misi -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseThree"
          >
            🎯 Visi & Misi
          </button>
        </h2>
        <div
          id="collapseThree"
          class="accordion-collapse collapse"
          data-bs-parent="#accordionInfo"
        >
          <div class="accordion-body">
            <p><strong>Visi:</strong><br>
              Menjadi market leader pesawat terbang turboprop kelas menengah dan ringan, serta menjadi acuan perusahaan di wilayah Asia Pasifik dengan mengoptimalkan kompetensi industri dan komersial terbaik.
            </p>
            <p><strong>Misi:</strong></p>
            <ol>
              <li>Menjadi pusat kompetensi dalam industri kedirgantaraan dan misi militer, serta aplikasi non-aerospace yang relevan.</li>
              <li>Menjadi pemain kunci di industri global dengan aliansi strategis bersama industri kedirgantaraan dunia.</li>
              <li>Menyediakan produk dan jasa yang kompetitif dalam hal kualitas dan biaya.</li>
            </ol>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<style>
  .accordion-button {
    font-weight: 600;
    transition: background 0.3s ease, color 0.3s ease;
  }
  .accordion-button:not(.collapsed) {
    background: #e9f2ff;
    color: #0d6efd;
  }
  .accordion-body p, 
  .accordion-body ul, 
  .accordion-body ol {
    margin-bottom: 0.8rem;
  }
  .accordion-body ul li {
    margin-bottom: 0.4rem;
  }
  .accordion-item {
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 8px;
  }
</style>



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
    @parent
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btn = document.getElementById('btn-mulai-training');
            const logo = document.getElementById('logo-animasi');
            const text = document.getElementById('text-mulai-training');
            if(btn && logo && text) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    btn.disabled = true;
                    text.style.opacity = '0.5';
                    logo.style.opacity = '1';
                    logo.classList.add('animating');
                    setTimeout(function() {
                        window.location.href = '/training';
                    }, 900); // waktu animasi
                });
            }
        });
    </script>

    <!-- Tambahkan di paling atas pada halaman training (resources/views/training/index.blade.php atau sejenisnya) -->
    @if(session('show_training_entrance'))
        <div id="training-entrance-logo">
            <img src="{{ asset('LogoBaru.png') }}" alt="Logo PTDI" style="width:100%;height:100%;">
        </div>
    @endif

    <script>
        // Entrance animation for training page
        document.addEventListener("DOMContentLoaded", function() {
            var entranceLogo = document.getElementById('training-entrance-logo');
            if (entranceLogo) {
                setTimeout(function() {
                    entranceLogo.classList.add('show');
                }, 100); // delay for effect
                setTimeout(function() {
                    entranceLogo.classList.remove('show');
                    entranceLogo.classList.add('hide');
                }, 1300); // show duration
                setTimeout(function() {
                    entranceLogo.style.display = 'none';
                }, 1800); // hide after animation
            }
        });
    </script>
@endpush
