<!-- resources/views/help.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center</title>
    <!-- Menambahkan Bootstrap untuk styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .navbar-brand-image {
            height: 40px; /* Ukuran logo */
            margin-right: 10px;
        }
        .navbar-custom {
            display: flex;
            align-items: center;
        }
        .navbar-custom h1 {
            margin: 0;
            font-size: 1.5rem;
            color: #007bff;
            font-weight: bold;
        }
        .help-section {
            margin-top: 30px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .card-body {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }
        .help-option {
            display: block;
            padding: 10px;
            border-radius: 5px;
            color: #007bff;
            text-decoration: none;
        }
        .help-option:hover {
            background-color: #f0f0f0;
            color: #0056b3;
        }
        .section-title {
            font-size: 1.5rem;
            color: #333;
        }
        .section-description {
            font-size: 1.1rem;
            color: #555;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 20px;
            border-radius: 10px;
            color: white;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        /* CSS untuk tombol kotak yang lebih besar dan lebih mencolok */
        .custom-btn {
            width: 100%;
            padding: 20px 0;
            text-align: center;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            border-radius: 10px;
            transition: background-color 0.3s;
            border: none;
        }

        .custom-btn:hover {
            background-color: #0056b3;
        }

        /* Untuk kotak scroll ke bawah */
        #scrollToBottomBtn {
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 25px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        #scrollToBottomBtn:hover {
            background-color: #0056b3;
        }

        /* Styling untuk tombol kembali */
        .back-btn {
            background-color: #6c757d;
            color: white;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #5a6268;
        }

        /* Styling untuk tombol kembali ke atas */
        .scroll-to-top-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            font-size: 1.2rem;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            display: none;
        }

        .scroll-to-top-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Navbar with logo and text -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand navbar-custom" href="#">
                <!-- Logo -->
                <img src="{{ asset('images/dirgantara.png') }}" alt="dirgantara" class="navbar-brand-image">
                <!-- Nama -->
                <h1>Dirgantara Indonesia Aerospace</h1>
            </a>
        </div>
    </nav>

                
                <!-- Tombol Scroll ke Bawah -->
                <div class="text-center my-4">
                    <button class="btn btn-primary" id="scrollToBottomBtn">Scroll to Bottom</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="text-center mb-4 text-primary">IT Help Center</h1>

                <!-- Introductory Text -->
                <div class="mb-4">
                    <p class="section-description">Selamat datang di pusat bantuan kami. Di sini, Anda dapat menemukan berbagai panduan dan opsi dukungan untuk memandu Anda menggunakan platform kami. Pilih bagian di bawah ini untuk memulai:</p>
                </div>

                <!-- Help Sections (Using Bootstrap Cards) -->
                <div class="row help-section">
                    <!-- Section 1: Basic FAQs -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Basic FAQs</h5>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li><a href="#" class="help-option"> Bagaimana cara masuk?</a></li>
                                    <li><a href="#" class="help-option">Bagaimana cara mengatur ulang kata sandi?</a></li>
                                    <li><a href="#" class="help-option">Bagaimana cara memperbarui profil?</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion untuk FAQ -->
                    <div class="col-md-6 mb-3">
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
                
                <!-- Section 2: Advanced Guides -->
                <div class="row help-section">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Panduan Tingkat Lanjut</h5>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li><a href="#" class="help-option">Bagaimana cara menggunakan fitur admin?</a></li>
                                    <li><a href="#" class="help-option">Bagaimana cara mengonfigurasi pengaturan lanjutan?</a></li>
                                    <li><a href="#" class="help-option">Bagaimana cara mengintegrasikan dengan API eksternal?</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Contact Support -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Contact Support</h5>
                    </div>
                    <div class="card-body">
                        <p class="section-description">Jika Anda tidak dapat menemukan jawaban yang Anda cari, jangan ragu untuk menghubungi tim dukungan kami.</p>
                        <a href="mailto:support@example.com" class="">Email Support</a>
                    </div>
                </div>

                <!-- Section 4: Additional Resources -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Additional Resources</h5>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><a href="#">Forum Komunitas</a></li>
                            <li><a href="#">Dokumentasi IT</a></li>
                            <li><a href="#">Panduan Pengguna</a></li>
                        </ul>
                    </div>
                </div>

    <!-- Tombol Kembali ke halaman sebelumnya -->
    <button class="back-btn" onclick="window.history.back()">Kembali</button>

    <!-- Tombol Kembali ke atas -->
    <button class="scroll-to-top-btn" id="scrollToTopBtn" onclick="scrollToTop()">↑</button>

    <!-- Optional: Adding Bootstrap JS for dropdowns and interactive elements -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript untuk Scroll -->
    <script>
        // Fungsi untuk scroll ke bawah
        document.getElementById('scrollToBottomBtn').addEventListener('click', function() {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        });

        // Fungsi untuk scroll ke atas
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Tombol scroll ke atas muncul setelah pengguna menggulir ke bawah
        window.onscroll = function() {
            var btn = document.getElementById("scrollToTopBtn");
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                btn.style.display = "block";
            } else {
                btn.style.display = "none";
            }
        };
    </script>
</body>
</html>
