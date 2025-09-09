@extends('layouts.app')
@section('title', 'Lisensi')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lisensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { 
            font-family: 'Inter', sans-serif; 
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .gradient-bg { 
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%); 
        }
        .card-shadow { 
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); 
        }
        .license-badge { 
            background: linear-gradient(45deg, #10b981, #059669);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }
        .status-active { 
            background: linear-gradient(90deg, #10b981, #059669);
            color: white;
        }
        .aerospace-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(59, 130, 246, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(16, 185, 129, 0.08) 0%, transparent 50%);
        }
        
        /* Mobile optimizations */
        @media (max-width: 768px) {
            .mobile-stack { flex-direction: column; }
            .mobile-full { width: 100%; }
            .mobile-text-center { text-align: center; }
            .mobile-mb-4 { margin-bottom: 1rem; }
        }
        
        /* Touch targets for mobile */
        .touch-target {
            min-height: 44px;
            min-width: 44px;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    
    <!-- Main Content -->
    <main class="w-full">
        <!-- Header Section - Mobile Optimized -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-6 px-4 sm:py-8 sm:px-6">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-center sm:text-left">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2">LISENSI PELATIHAN</h1>
                        <p class="text-blue-100 text-sm sm:text-base">Sertifikat Kompetensi Dirgantara</p>
                    </div>
                    <div class="license-badge px-4 py-2 sm:px-6 sm:py-3 rounded-full">
                        <span class="text-white font-bold text-base sm:text-lg" id="license-status">AKTIF</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Breadcrumb Navigation -->
        <nav class="mb-6" aria-label="Breadcrumb">
            <div class="bg-white rounded-lg shadow-sm p-4">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{route('index')}}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors" onclick="navigateTo('home')">
                            🏠 Home
                        </a>
                    </li>
                    <li class="text-gray-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <a href="{{route('training.index')}}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors" onclick="navigateTo('training')">
                            📚 Training
                        </a>
                    </li>
                    <li class="text-gray-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <a href="{{route('license.training')}}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors" onclick="navigateTo('data')">
                            📊 lisensi
                        </a>
                    </li>
                    
                </ol>
            </div>
        </nav>
        <!-- License Content -->
        <div class="max-w-6xl mx-auto px-4 py-6 sm:px-6 sm:py-12">
            <!-- License Card -->
            <div class="bg-white rounded-xl sm:rounded-2xl card-shadow overflow-hidden aerospace-pattern">
                <!-- License Details -->
                <div class="p-4 sm:p-6 lg:p-8">
                    <!-- Mobile: Single Column, Desktop: Two Columns -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                        <!-- Left Column -->
                        <div class="space-y-4 sm:space-y-6">
                            <!-- License Info Card -->
                            <div class="bg-gray-50 p-4 sm:p-6 rounded-lg sm:rounded-xl">
                                <h3 class="font-semibold text-gray-800 mb-3 sm:mb-4 flex items-center text-sm sm:text-base">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                    Informasi Lisensi
                                </h3>
                                <div class="space-y-2 sm:space-y-3">
                                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-0">
                                        <span class="text-gray-600 text-xs sm:text-sm">Nomor Lisensi:</span>
                                        <span class="font-semibold text-sm sm:text-base" id="license-number">AER-2024-001234 contoh</span>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-0">
                                        <span class="text-gray-600 text-xs sm:text-sm">Kategori:</span>
                                        <span class="font-semibold text-sm sm:text-base" id="license-category">Pelatihan Dirgantara</span>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-0">
                                        <span class="text-gray-600 text-xs sm:text-sm">Tingkat:</span>
                                        <span class="font-semibold text-sm sm:text-base" id="license-level">Profesional</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Institution Card -->
                            <div class="bg-blue-50 p-4 sm:p-6 rounded-lg sm:rounded-xl border border-blue-200">
                                <h3 class="font-semibold text-blue-800 mb-3 sm:mb-4 flex items-center text-sm sm:text-base">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    Lembaga Penyelenggara
                                </h3>
                                <p class="text-blue-700 font-medium text-sm sm:text-base" id="institution-name">PT.Dirga</p>
                                <p class="text-blue-600 text-xs sm:text-sm mt-1" id="institution-desc">Lembaga resmi yang ditunjuk oleh Kementerian Perhubungan RI</p>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4 sm:space-y-6">
                            <!-- Status Card -->
                            <div class="bg-green-50 p-4 sm:p-6 rounded-lg sm:rounded-xl border border-green-200">
                                <h3 class="font-semibold text-green-800 mb-3 sm:mb-4 flex items-center text-sm sm:text-base">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Status & Masa Berlaku
                                </h3>
                                <div class="space-y-2 sm:space-y-3">
                                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1 sm:gap-0">
                                        <span class="text-gray-600 text-xs sm:text-sm">Status:</span>
                                        <span class="status-active px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-medium w-fit" id="status-badge">AKTIF</span>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-0">
                                        <span class="text-gray-600 text-xs sm:text-sm">Tanggal Terbit:</span>
                                        <span class="font-semibold text-sm sm:text-base" id="issued-date">15 Januari 2024</span>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-0">
                                        <span class="text-gray-600 text-xs sm:text-sm">Masa Berlaku:</span>
                                        <span class="font-semibold text-green-600 text-sm sm:text-base" id="expiry-date">15 Januari 2027</span>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-0">
                                        <span class="text-gray-600 text-xs sm:text-sm">Sisa Waktu:</span>
                                        <span class="font-semibold text-orange-600 text-sm sm:text-base" id="remaining-time">2 tahun 11 bulan</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Training Scopes Card -->
                            <div class="bg-gray-50 p-4 sm:p-6 rounded-lg sm:rounded-xl">
                                <h3 class="font-semibold text-gray-800 mb-3 sm:mb-4 flex items-center text-sm sm:text-base">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                                    </svg>
                                    Cakupan Pelatihan
                                </h3>
                                <ul class="space-y-2 text-xs sm:text-sm" id="training-scopes">
                                    <li class="flex items-start">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-3 mt-1.5 flex-shrink-0"></div>
                                        <span>Sistem Navigasi Penerbangan</span>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-3 mt-1.5 flex-shrink-0"></div>
                                        <span>Keselamatan Operasi Dirgantara</span>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-3 mt-1.5 flex-shrink-0"></div>
                                        <span>Manajemen Lalu Lintas Udara</span>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-3 mt-1.5 flex-shrink-0"></div>
                                        <span>Teknologi Pesawat Terbang</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Important Notice -->
                    <div class="mt-6 sm:mt-8 bg-yellow-50 border-l-4 border-yellow-400 p-4 sm:p-6 rounded-r-lg sm:rounded-r-xl">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-400 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L1 21h22L12 2zm0 3.99L19.53 19H4.47L12 5.99zM11 16h2v2h-2v-2zm0-6h2v4h-2v-4z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-yellow-800 mb-2 text-sm sm:text-base">Penting untuk Diperhatikan</h4>
                                <p class="text-yellow-700 text-xs sm:text-sm leading-relaxed" id="notice-text">
                                    Lisensi ini dikeluarkan oleh lembaga resmi yang ditunjuk negara dan memiliki masa berlaku terbatas. 
                                    Pastikan untuk melakukan perpanjangan sebelum masa berlaku habis. Lisensi ini wajib diperbaharui 
                                    setiap 3 tahun dengan mengikuti pelatihan penyegaran yang diselenggarakan oleh lembaga bersertifikat.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons - Mobile Optimized -->
                    <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row gap-3 sm:gap-4 sm:justify-center">
                        <button onclick="downloadCertificate()" class="touch-target bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white px-6 py-3 sm:px-8 rounded-lg sm:rounded-xl font-medium transition-colors duration-200 flex items-center justify-center text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                                <polyline points="14,2 14,8 20,8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <polyline points="10,9 9,9 8,9"/>
                            </svg>
                            Unduh Sertifikat
                        </button>
                        <button onclick="renewLicense()" class="touch-target bg-green-600 hover:bg-green-700 active:bg-green-800 text-white px-6 py-3 sm:px-8 rounded-lg sm:rounded-xl font-medium transition-colors duration-200 flex items-center justify-center text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            Perpanjang Lisensi
                        </button>
                        <button onclick="verifyOnline()" class="touch-target bg-gray-600 hover:bg-gray-700 active:bg-gray-800 text-green px-6 py-3 sm:px-8 rounded-lg sm:rounded-xl font-medium transition-colors duration-200 flex items-center justify-center text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Verifikasi Online
                        </button>
                    </div>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="mt-6 sm:mt-8 text-center px-4">
                <p class="text-gray-600 text-xs sm:text-sm mb-2">
                    Untuk informasi lebih lanjut hubungi:<br class="sm:hidden">
                    <span class="font-medium" id="contact-email">sekretariatptdi@indonesian-aerospace.com</span>
                    <span class="hidden sm:inline"> | </span><br class="sm:hidden">
                    <span class="font-medium" id="contact-phone">+62 821-1909-6623 contoh</span>
                </p>
                <p class="text-gray-500 text-xs mt-2" id="copyright">
                    © PT-Dirgantara.<br class="sm:hidden"> Bebas mau di isi apa
                </p>
            </div>
        </div>
    </main>

    <script>
        // Fungsi untuk mengisi data lisensi dari Laravel
        function populateLicenseData(data) {
            // Update semua elemen dengan data dari backend
            if (data.license_number) document.getElementById('license-number').textContent = data.license_number;
            if (data.category) document.getElementById('license-category').textContent = data.category;
            if (data.level) document.getElementById('license-level').textContent = data.level;
            if (data.status) {
                document.getElementById('license-status').textContent = data.status.toUpperCase();
                document.getElementById('status-badge').textContent = data.status.toUpperCase();
            }
            if (data.institution) document.getElementById('institution-name').textContent = data.institution;
            if (data.institution_description) document.getElementById('institution-desc').textContent = data.institution_description;
            if (data.issued_date) document.getElementById('issued-date').textContent = data.issued_date;
            if (data.expiry_date) document.getElementById('expiry-date').textContent = data.expiry_date;
            if (data.remaining_time) document.getElementById('remaining-time').textContent = data.remaining_time;
            if (data.notice) document.getElementById('notice-text').textContent = data.notice;
            
            // Update training scopes jika ada
            if (data.training_scopes && data.training_scopes.length > 0) {
                const scopesList = document.getElementById('training-scopes');
                scopesList.innerHTML = '';
                data.training_scopes.forEach(scope => {
                    const li = document.createElement('li');
                    li.className = 'flex items-start';
                    li.innerHTML = `
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-3 mt-1.5 flex-shrink-0"></div>
                        <span>${scope}</span>
                    `;
                    scopesList.appendChild(li);
                });
            }
            
            // Update contact info
            if (data.contact_email) document.getElementById('contact-email').textContent = data.contact_email;
            if (data.contact_phone) document.getElementById('contact-phone').textContent = data.contact_phone;
            if (data.company_name) {
                document.getElementById('copyright').innerHTML = `© ${new Date().getFullYear()} ${data.company_name}.<br class="sm:hidden"> Semua hak dilindungi undang-undang.`;
            }
        }

        // Fungsi untuk tombol-tombol aksi
        function downloadCertificate() {
            // Redirect ke route download atau panggil API
            window.location.href = '/license/download/' + (window.licenseId || '1');
        }

        function renewLicense() {
            // Redirect ke halaman perpanjangan
            window.location.href = '/license/renew/' + (window.licenseId || '1');
        }

        function verifyOnline() {
            // Redirect ke halaman verifikasi
            const licenseNumber = document.getElementById('license-number').textContent;
            window.location.href = '/license/verify/' + licenseNumber;
        }

        // Contoh penggunaan dengan data dari Laravel
        // Panggil fungsi ini dari controller Laravel
        window.setLicenseData = function(data) {
            window.licenseId = data.id;
            populateLicenseData(data);
        };

        // Untuk development - contoh data
        document.addEventListener('DOMContentLoaded', function() {
            // Contoh data yang bisa dikirim dari Laravel Controller
            const sampleData = {
                id: 1,
                license_number: 'AER-2024-001234 contoh',
                category: 'Pelatihan Dirgantara',
                level: 'Profesional',
                status: 'aktif',
                institution: 'PT.Dirga',
                institution_description: 'Lembaga resmi yang ditunjuk oleh Kementerian Perhubungan RI',
                issued_date: '15 Januari 2024',
                expiry_date: '15 Januari 2027',
                remaining_time: '2 tahun 11 bulan',
                training_scopes: [
                    'Sistem Navigasi Penerbangan',
                    'Keselamatan Operasi Dirgantara',
                    'Manajemen Lalu Lintas Udara',
                    'Teknologi Pesawat Terbang'
                ],
                notice: 'Lisensi ini dikeluarkan oleh lembaga resmi yang ditunjuk negara dan memiliki masa berlaku terbatas.',
                contact_email: 'info@dirgantara-training.go.id',
                contact_phone: '+62-21-1234-5678',
                company_name: 'Lembaga Sertifikasi Dirgantara Indonesia'
            };
            
            // Uncomment untuk testing
            // window.setLicenseData(sampleData);
        });

        // Touch feedback untuk mobile
        document.addEventListener('touchstart', function() {}, true);
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'97c4a9e473319bda',t:'MTc1NzM5OTcwNi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>


@endsection