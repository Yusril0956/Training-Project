@extends('layouts.dashboard')

@section('title', 'IT Help Center')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    IT Help Center
                </h2>
                <div class="text-muted mt-1">
                    Selamat datang di pusat bantuan Training Project PT. Dirgantara. Di sini Anda dapat menemukan panduan penggunaan aplikasi, solusi kendala umum, serta informasi kontak tim IT. Silakan pilih topik bantuan di bawah ini sesuai kebutuhan Anda.
                </div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" onclick="window.history.back()">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <!-- Basic FAQs -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">FAQ Dasar</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-decoration-none">Bagaimana cara mendaftar akun baru?</a></li>
                            <li><a href="#" class="text-decoration-none">Bagaimana cara login ke sistem?</a></li>
                            <li><a href="#" class="text-decoration-none">Bagaimana cara reset password?</a></li>
                            <li><a href="#" class="text-decoration-none">Bagaimana cara memperbarui data profil?</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Accordion untuk FAQ -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pertanyaan Umum</h3>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeadingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                                        Bagaimana cara mendaftar akun baru?
                                    </button>
                                </h2>
                                <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqHeadingOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Klik tombol "Sign Up" pada halaman login, isi data diri Anda seperti username, email, NIK, dan password, lalu klik "Buat akun baru". Setelah berhasil, Anda dapat langsung login ke sistem.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeadingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                                        Bagaimana cara login ke sistem?
                                    </button>
                                </h2>
                                <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Masukkan email dan password Anda pada halaman login, lalu klik tombol "Masuk". Jika data benar, Anda akan diarahkan ke dashboard utama.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeadingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                                        Bagaimana jika lupa password?
                                    </button>
                                </h2>
                                <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Klik tautan "Saya lupa password" di halaman login, masukkan email Anda, lalu ikuti instruksi yang dikirimkan ke email untuk reset password.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeadingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                                        Bagaimana cara memperbarui data profil?
                                    </button>
                                </h2>
                                <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Setelah login, buka menu profil di dashboard, lalu edit data yang ingin diperbarui dan simpan perubahan.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <!-- Advanced Guides -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Panduan Fitur</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-decoration-none">Mengelola data pelatihan</a></li>
                            <li><a href="#" class="text-decoration-none">Mengakses materi dan jadwal training</a></li>
                            <li><a href="#" class="text-decoration-none">Menggunakan fitur admin (khusus admin)</a></li>
                            <li><a href="#" class="text-decoration-none">Mengunduh sertifikat pelatihan</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kontak Bantuan</h3>
                    </div>
                    <div class="card-body">
                        <p class="section-description">Jika Anda mengalami kendala teknis atau membutuhkan bantuan lebih lanjut terkait penggunaan aplikasi Training Project, silakan hubungi tim IT kami:</p>
                        <ul class="list-unstyled mb-2">
                            <li>Email: <a href="mailto:support@dirgantara.co.id" class="text-decoration-none">support@dirgantara.co.id</a></li>
                            <li>WhatsApp: <a href="https://wa.me/6281234567890" class="text-decoration-none">+62 821-1909-6623</a></li>
                        </ul>
                        <p>Kami siap membantu Anda pada hari kerja pukul 08.00 - 17.00 WIB.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Resources -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sumber Daya Lainnya</h3>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none">Forum Diskusi Pengguna</a></li>
                    <li><a href="#" class="text-decoration-none">Dokumentasi Penggunaan Sistem</a></li>
                    <li><a href="#" class="text-decoration-none">Panduan Video Training</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
