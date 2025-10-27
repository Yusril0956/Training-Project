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
                <div class="text-muted mt-1">Selamat datang di pusat bantuan kami. Di sini, Anda dapat menemukan berbagai panduan dan opsi dukungan untuk memandu Anda menggunakan platform kami. Pilih bagian di bawah ini untuk memulai:</div>
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
                        <h3 class="card-title">Basic FAQs</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-decoration-none">Bagaimana cara masuk?</a></li>
                            <li><a href="#" class="text-decoration-none">Bagaimana cara mengatur ulang kata sandi?</a></li>
                            <li><a href="#" class="text-decoration-none">Bagaimana cara memperbarui profil?</a></li>
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
                                        Bagaimana cara masuk?
                                    </button>
                                </h2>
                                <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqHeadingOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Untuk masuk, klik tombol "Masuk" di sudut kanan atas halaman dan masukkan kredensial Anda.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeadingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                                        Bagaimana cara mengatur ulang kata sandi saya?
                                    </button>
                                </h2>
                                <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Untuk mengatur ulang kata sandi Anda, klik tautan "Lupa Kata Sandi" di halaman masuk dan ikuti petunjuknya.
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
                        <h3 class="card-title">Panduan Tingkat Lanjut</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-decoration-none">Bagaimana cara menggunakan fitur admin?</a></li>
                            <li><a href="#" class="text-decoration-none">Bagaimana cara mengonfigurasi pengaturan lanjutan?</a></li>
                            <li><a href="#" class="text-decoration-none">Bagaimana cara mengintegrasikan dengan API eksternal?</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Contact Support</h3>
                    </div>
                    <div class="card-body">
                        <p class="section-description">Jika Anda tidak dapat menemukan jawaban yang Anda cari, jangan ragu untuk menghubungi tim dukungan kami.</p>
                        <a href="mailto:support@example.com" class="text-decoration-none">Email Support</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Resources -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Additional Resources</h3>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none">Forum Komunitas</a></li>
                    <li><a href="#" class="text-decoration-none">Dokumentasi IT</a></li>
                    <li><a href="#" class="text-decoration-none">Panduan Pengguna</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
