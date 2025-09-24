@extends('layouts.app')

@section('title', 'Detail Perusahaan - PT Dirgantara Indonesia')

@section('content')
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Dirgantara Indonesia - Detail Perusahaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
        .section-divider { background: linear-gradient(90deg, transparent, #e5e7eb, transparent); }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Header -->
    <header class="gradient-bg text-white py-16">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <div class="mb-6">
                    <svg class="w-20 h-20 mx-auto mb-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">PT Dirgantara Indonesia</h1>
                <p class="text-xl md:text-2xl font-light opacity-90">Indonesian Aerospace (IAe)</p>
                <p class="text-lg mt-2 opacity-80">Industri Kedirgantaraan Terdepan Indonesia</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12">
        <!-- Profil Singkat -->
        <section class="mb-16">
            <div class="bg-white rounded-2xl shadow-lg p-8 card-hover">
                <h2 class="text-3xl font-bold text-blue-900 mb-6 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    Profil Singkat & Produk Unggulan
                </h2>
                <div class="text-lg leading-relaxed space-y-4">
                    <p><strong>PT Dirgantara Indonesia (Persero)</strong>, atau <strong>Indonesian Aerospace (IAe)</strong>, adalah BUMN yang bergerak di industri kedirgantaraan, khususnya dalam desain, pengembangan, produksi pesawat, komponen aerostruktur, serta layanan pemeliharaan dan rekayasa.</p>
                    <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-500">
                        <p><strong>Didirikan:</strong> 23 Agustus 1976</p>
                        <p><strong>Pusat Operasi:</strong> Bandung, Jawa Barat</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Produk Pesawat -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-blue-900 mb-8 text-center">Produk Pesawat</h2>
            
            <!-- Pesawat Sayap Tetap -->
            <div class="mb-12">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                    </svg>
                    Pesawat Sayap Tetap
                </h3>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                        <h4 class="text-xl font-bold text-blue-800 mb-3">CN-235</h4>
                        <p class="text-gray-600">Multiguna untuk militer dan sipil (pengangkutan, patroli, kargo)</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                        <h4 class="text-xl font-bold text-blue-800 mb-3">NC212 / NC212i</h4>
                        <p class="text-gray-600">Versi terbaru dari pesawat ringan, banyak digunakan untuk keperluan sipil dan militer</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                        <h4 class="text-xl font-bold text-blue-800 mb-3">N-219</h4>
                        <p class="text-gray-600">Turboprop ringan untuk penerbangan jarak pendek dan wilayah terpencil</p>
                        <div class="mt-2 text-sm text-green-600 font-medium">✓ Sertifikasi diterima Desember 2020</div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                        <h4 class="text-xl font-bold text-blue-800 mb-3">CN-295</h4>
                        <p class="text-gray-600">Lisensi dari Airbus Defence & Space, dirakit di Bandung</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-6 card-hover border-2 border-orange-200">
                        <h4 class="text-xl font-bold text-orange-800 mb-3">Proyek Pengembangan</h4>
                        <p class="text-gray-600">N-245 (50-kursi turboprop) dan IPTN N-250 (prototype)</p>
                        <div class="mt-2 text-sm text-orange-600 font-medium">🚧 Dalam Rencana</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Helikopter & Aerostruktur -->
        <section class="mb-16">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    Helikopter & Aerostruktur
                </h3>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-lg font-semibold text-blue-800 mb-3">Helikopter</h4>
                        <div class="space-y-2 text-gray-700">
                            <p>• NAS 330 Puma, NAS 332 Super Puma</p>
                            <p>• H215, H225M/H225</p>
                            <p>• AS365/565, H125M/H125</p>
                            <p>• Bell 412EPI</p>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-blue-800 mb-3">Komponen Aerostruktur</h4>
                        <div class="space-y-2 text-gray-700">
                            <p>• Boeing (737, 767)</p>
                            <p>• Airbus (A320–A380, A350)</p>
                            <p>• Tail booms dan fuselage untuk helikopter Airbus dan Bell</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Layanan & Teknologi -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-blue-900 mb-8 text-center">Layanan & Teknologi</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow-md p-6 card-hover text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-blue-800 mb-2">MRO</h4>
                    <p class="text-sm text-gray-600">Maintenance, Repair & Overhaul untuk berbagai pesawat</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 card-hover text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-green-800 mb-2">Aerostructure</h4>
                    <p class="text-sm text-gray-600">Fasilitas lengkap CNC, sheet metal, machining</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 card-hover text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 11H7v9a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2h-3V5a2 2 0 00-2-2H9a2 2 0 00-2 2v6z"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-purple-800 mb-2">UAV & Teknologi</h4>
                    <p class="text-sm text-gray-600">UAV Wulung, UAV MALE, simulator penerbangan</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 card-hover text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-red-800 mb-2">Produk Pertahanan</h4>
                    <p class="text-sm text-gray-600">Roket R-Han 122 (jangkauan 32 km)</p>
                </div>
            </div>
        </section>

        <!-- Capaian & Kerja Sama -->
        <section class="mb-16">
            <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-8">
                <h2 class="text-3xl font-bold text-blue-900 mb-8 text-center">Capaian & Kerja Sama Internasional</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-xl font-semibold text-green-800 mb-4">🏆 Pencapaian Global</h4>
                        <ul class="space-y-2 text-gray-700">
                            <li>• Lebih dari 400-470 pesawat diproduksi dan dikirim</li>
                            <li>• Motor penggerak industri dirgantara nasional</li>
                            <li>• Andalan pada pameran pertahanan Indo Defence</li>
                            <li>• Kerjasama MRO dengan AMMROC (UAE)</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-blue-800 mb-4">🌍 Negara Mitra</h4>
                        <div class="grid grid-cols-2 gap-2 text-sm text-gray-700">
                            <div>• Malaysia</div>
                            <div>• Thailand</div>
                            <div>• UEA</div>
                            <div>• Senegal</div>
                            <div>• Brunei</div>
                            <div>• Pakistan</div>
                            <div>• Korea Selatan</div>
                            <div>• Vietnam</div>
                            <div>• Filipina</div>
                            <div>• Nepal</div>
                            <div>• Pantai Gading</div>
                            <div>• Australia</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ringkasan Cepat -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-blue-900 mb-8 text-center">Ringkasan Cepat</h2>
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Aspek</th>
                                <th class="px-6 py-4 text-left font-semibold">Detail Singkat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Tahun berdiri</td>
                                <td class="px-6 py-4 text-gray-700">1976 (sebagai IPTN)</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Lokasi utama</td>
                                <td class="px-6 py-4 text-gray-700">Bandung, Jawa Barat</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Produk unggulan</td>
                                <td class="px-6 py-4 text-gray-700">Pesawat (CN235, NC212i, N219, CN295), helikopter, UAV, roket</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Layanan</td>
                                <td class="px-6 py-4 text-gray-700">MRO, aerostruktur, pengembangan teknologi, simulator</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Capaian global</td>
                                <td class="px-6 py-4 text-gray-700">>400 unit pesawat dikirim ke berbagai negara, banyak kerja sama internasional</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Inovasi terbaru</td>
                                <td class="px-6 py-4 text-gray-700">UAV, roket R-Han 122, N-245, N-219 dan CN-295 versi terbaru</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="gradient-bg text-white py-12">
        <div class="container mx-auto px-6 text-center">
            <div class="mb-6">
                <svg class="w-12 h-12 mx-auto mb-4 text-white opacity-80" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-2">PT Dirgantara Indonesia</h3>
            <p class="text-lg opacity-90 mb-4">Membanggakan Indonesia di Langit Dunia</p>
            <div class="text-sm opacity-75">
                <p>Bandung, Jawa Barat • Didirikan 1976</p>
                <p class="mt-2">Industri Kedirgantaraan Terdepan Indonesia</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling untuk navigasi internal
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animasi fade-in saat scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Terapkan animasi ke semua section
        document.querySelectorAll('section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });

        // Header sudah terlihat dari awal
        document.querySelector('header').style.opacity = '1';
        document.querySelector('header').style.transform = 'translateY(0)';
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'978acd226148f932',t:'MTc1Njc5Mjk3Ni4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

@endsection
