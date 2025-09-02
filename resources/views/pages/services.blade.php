<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan & Dukungan - PT Dirgantara Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; transition: all 0.3s ease; }
        .gradient-bg { background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .service-icon { transition: all 0.3s ease; }
        .service-card:hover .service-icon { transform: scale(1.1); }
        
        /* Dark Mode Styles */
        .dark {
            background-color: #0f172a;
            color: #e2e8f0;
        }
        .dark .bg-white { background-color: #1e293b !important; }
        .dark .bg-gray-50 { background-color: #0f172a !important; }
        .dark .bg-gray-100 { background-color: #1e293b !important; }
        .dark .text-gray-800 { color: #e2e8f0 !important; }
        .dark .text-gray-700 { color: #cbd5e1 !important; }
        .dark .text-gray-600 { color: #94a3b8 !important; }
        .dark .text-gray-500 { color: #64748b !important; }
        .dark .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.3) !important; }
        .dark .border-gray-200 { border-color: #374151 !important; }
        .dark .border-t { border-color: #374151 !important; }
        .dark .border-b { border-color: #374151 !important; }
        .dark .border { border-color: #374151 !important; }
        
        /* Dark mode for specific color backgrounds */
        .dark .bg-blue-50 { background-color: #1e3a8a !important; }
        .dark .bg-green-50 { background-color: #14532d !important; }
        .dark .bg-purple-50 { background-color: #581c87 !important; }
        .dark .bg-orange-50 { background-color: #9a3412 !important; }
        .dark .bg-red-50 { background-color: #991b1b !important; }
        
        /* Dark mode for borders */
        .dark .border-blue-200 { border-color: #1e40af !important; }
        .dark .border-green-200 { border-color: #16a34a !important; }
        .dark .border-purple-200 { border-color: #9333ea !important; }
        .dark .border-orange-200 { border-color: #ea580c !important; }
        .dark .border-red-200 { border-color: #dc2626 !important; }
        
        /* Dark mode for icon backgrounds */
        .dark .bg-blue-100 { background-color: #1e40af !important; }
        .dark .bg-green-100 { background-color: #16a34a !important; }
        .dark .bg-purple-100 { background-color: #9333ea !important; }
        .dark .bg-orange-100 { background-color: #ea580c !important; }
        
        /* Dark mode hover states */
        .dark .hover\:bg-blue-50:hover { background-color: #1e3a8a !important; }
        .dark .hover\:bg-gray-50:hover { background-color: #374151 !important; }
        .dark .hover\:bg-gray-700:hover { background-color: #4b5563 !important; }
        
        /* Notification Animation */
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% { transform: translate3d(0,0,0); }
            40%, 43% { transform: translate3d(0, -8px, 0); }
            70% { transform: translate3d(0, -4px, 0); }
            90% { transform: translate3d(0, -2px, 0); }
        }
        .notification-bounce { animation: bounce 1s ease-in-out; }
        
        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg sticky top-0 z-40">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white-600 rounded-lg flex items-center justify-center">
                       <img src="images/LOGOFULL.png" alt="" class="logo">
                    </div>
                    <span class="text-xl font-bold text-gray-800">PT. Dirgantara</span>
                </div>
                
                <!-- Navigation Menu -->
                <div class="hidden md:flex items-center space-x-4">
    {{-- Home --}}
    <a href="{{ route('index') }}"
       class="text-gray-700 hover:text-blue-600 font-medium transition duration-300
              {{ request()->is('home') ? 'text-blue-600' : '' }}">
        Home
    </a>

    {{-- Training --}}
    <a href="{{ route('training.index') }}"
       class="text-gray-700 hover:text-blue-600 font-medium transition duration-300
              {{ request()->is('training*') ? 'text-blue-600' : '' }}">
        Training
    </a>

    {{-- Dropdown More --}}
    <div class="relative group">
        <button
            class="text-gray-700 hover:text-blue-600 font-medium transition duration-300 flex items-center">
            More
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <div
            class="absolute top-full left-0 mt-2 w-48 bg-white dark:bg-gray-800
                   rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible
                   transition-all duration-300">

            <a href="{{ route('404') }}"
               class="block px-4 py-3 text-gray-700 dark:text-gray-300
                      hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 transition duration-300">
                Setting
            </a>

            <a href="{{ route('profile') }}"
               class="block px-4 py-3 text-gray-700 dark:text-gray-300
                      hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 transition duration-300">
                Profile
            </a>

            <a href="{{ route('help') }}"
               class="block px-4 py-3 text-gray-700 dark:text-gray-300
                      hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 transition duration-300">
                Help
            </a>
        </div>
    </div>
</div>

                    
                    <!-- Notification Bell -->
                    <div class="relative">
                        <button id="notificationBtn" onclick="toggleNotifications()" class="text-gray-700 hover:text-blue-600 transition duration-300 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span id="notificationBadge" class="notification-badge">3</span>
                        </button>
                    </div>
                    
                    <!-- Dark Mode Toggle -->
                    <button onclick="toggleDarkMode()" class="text-gray-700 hover:text-blue-600 transition duration-300">
                        <svg id="darkModeIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center space-x-4">
                    <!-- Mobile Notification Bell -->
                    <div class="relative">
                        <button id="mobileNotificationBtn" onclick="toggleNotifications()" class="text-gray-700 hover:text-blue-600 transition duration-300 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="notification-badge">3</span>
                        </button>
                    </div>
                    
                    <!-- Mobile Dark Mode Toggle -->
                    <button onclick="toggleDarkMode()" class="text-gray-700 hover:text-blue-600 transition duration-300">
                        <svg id="mobileDarkModeIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>
                    
                    <button onclick="toggleMobileMenu()" class="text-gray-700 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="md:hidden hidden bg-white border-t">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="#" class="block px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">Home</a>
                    <a href="#" class="block px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">Training</a>
                    <a href="#" class="block px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">Tentang Kami</a>
                    <a href="#" class="block px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">Produk</a>
                    <a href="#" class="block px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">Karir</a>
                    <a href="#" class="block px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-4">
        <div class="container mx-auto px-6">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Home</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-600 font-medium">Layanan & Dukungan</span>
            </nav>
        </div>
    </div>

    <!-- Header -->
    <header class="gradient-bg text-white py-16">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan & Dukungan PTDI</h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-4xl mx-auto leading-relaxed">
                    PT Dirgantara Indonesia menyediakan berbagai layanan maintenance, repair, overhaul, dan dukungan teknis untuk pesawat dan komponen, baik produk PTDI maupun non-PTDI.
                </p>
            </div>
        </div>
    </header>

    <!-- Main Services Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-4">Layanan Pesawat & Mesin</h2>
                <p class="text-lg text-gray-600 dark:text-gray-300">Aircraft & Engine Services - MRO untuk berbagai jenis pesawat dan komponen</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <!-- Produk Kolaborasi -->
                <div class="service-card bg-white rounded-xl shadow-lg p-8 card-hover">
                    <div class="service-icon bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Produk Kolaborasi</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>CN-295</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>NC-212 (berbagai seri)</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>H225M/H225</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>H215</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Bell 412EP/EPI</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>AS365+/AS565MBe</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>H125, NAS332, NBO-105</li>
                    </ul>
                </div>

                <!-- Pesawat Non-PTDI -->
                <div class="service-card bg-white rounded-xl shadow-lg p-8 card-hover">
                    <div class="service-icon bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Pesawat Non-PTDI</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Boeing 737-200</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Boeing 737-300</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Boeing 737-400</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Boeing 737-500</li>
                    </ul>
                </div>

                <!-- Komponen -->
                <div class="service-card bg-white rounded-xl shadow-lg p-8 card-hover">
                    <div class="service-icon bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Komponen</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Avionics (navigasi & komunikasi)</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Komponen dinamis/gearbox</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Airframe</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- After Sales Services -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Layanan "Purna Jual"</h2>
                <p class="text-lg text-gray-600">Dukungan komprehensif untuk semua kebutuhan after-sales Anda</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gray-50 rounded-lg p-6 text-center card-hover">
                    <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 11-9.75 9.75A9.75 9.75 0 0112 2.25z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Dukungan Teknis</h3>
                    <p class="text-sm text-gray-600">Nasihat, perwakilan teknologi, insinyur layanan lapangan</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-6 text-center card-hover">
                    <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Dokumen & Pelatihan</h3>
                    <p class="text-sm text-gray-600">Manual teknis dan pelatihan untuk pilot dan mekanik</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-6 text-center card-hover">
                    <div class="bg-orange-100 w-12 h-12 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a1 1 0 01-1-1V9a1 1 0 011-1h1a2 2 0 100-4H4a1 1 0 01-1-1V4a1 1 0 011-1h3a1 1 0 001-1z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">MRO Services</h3>
                    <p class="text-sm text-gray-600">Pemeliharaan, perbaikan, dan overhaul pesawat & komponen</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-6 text-center card-hover">
                    <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Modifikasi</h3>
                    <p class="text-sm text-gray-600">Re-engine, instalasi TCAS/TAWS/FDR, interior pesawat</p>
                </div>
            </div>

            <!-- Additional Services -->
            <div class="mt-12 grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <h4 class="font-semibold text-gray-800 mb-3">Suku Cadang & Logistik</h4>
                    <p class="text-gray-600">Penyediaan suku cadang dan dukungan logistik lengkap</p>
                </div>
                <div class="text-center">
                    <h4 class="font-semibold text-gray-800 mb-3">Petunjuk Kelaikan Udara</h4>
                    <p class="text-gray-600">Penyusunan petunjuk kelaikan udara dan buletin layanan</p>
                </div>
                <div class="text-center">
                    <h4 class="font-semibold text-gray-800 mb-3">Inspeksi Berkala</h4>
                    <p class="text-gray-600">C-check, CPCP, inspeksi tahunan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Engineering Services -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Layanan Engineering & Sistem Senjata</h2>
                <p class="text-lg text-gray-600">Solusi engineering komprehensif untuk kebutuhan industri penerbangan</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg p-8 text-center card-hover">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Engineering</h3>
                    <p class="text-gray-600">Desain, pengembangan, dan pengujian sistem penerbangan</p>
                </div>

                <div class="bg-white rounded-lg p-8 text-center card-hover">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Subkontrak Manufaktur</h3>
                    <p class="text-gray-600">Layanan manufaktur berkualitas tinggi untuk industri penerbangan</p>
                </div>

                <div class="bg-white rounded-lg p-8 text-center card-hover">
                    <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Aircraft & Engine MRO</h3>
                    <p class="text-gray-600">Maintenance, Repair and Overhaul untuk pesawat dan mesin</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quality Management -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Sistem Manajemen Mutu</h2>
                <p class="text-lg text-gray-600">Semua layanan berstandar internasional dan regulasi penerbangan Indonesia</p>
            </div>

            <div class="flex flex-wrap justify-center gap-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg px-6 py-4">
                    <span class="font-semibold text-blue-800">CASR 145</span>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg px-6 py-4">
                    <span class="font-semibold text-green-800">CASR 57</span>
                </div>
                <div class="bg-purple-50 border border-purple-200 rounded-lg px-6 py-4">
                    <span class="font-semibold text-purple-800">DOA</span>
                </div>
                <div class="bg-orange-50 border border-orange-200 rounded-lg px-6 py-4">
                    <span class="font-semibold text-orange-800">ISO 9001</span>
                </div>
                <div class="bg-red-50 border border-red-200 rounded-lg px-6 py-4">
                    <span class="font-semibold text-red-800">AS/EN 9110</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 gradient-bg text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Butuh Informasi Lebih Lanjut?</h2>
            <p class="text-xl text-blue-100 mb-8">Hubungi tim dukungan kami untuk konsultasi dan layanan khusus</p>
            <button class="bg-white text-blue-600 font-semibold px-8 py-4 rounded-lg hover:bg-blue-50 transition duration-300 transform hover:scale-105" onclick="showContactInfo()">
                Hubungi Kami
            </button>
        </div>
    </section>

    <!-- Notification Panel -->
    <div id="notificationPanel" class="fixed top-16 right-4 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl border dark:border-gray-700 hidden z-50 max-h-96 overflow-y-auto">
        <div class="p-4 border-b dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Notifikasi</h3>
                <button onclick="clearAllNotifications()" class="text-sm text-blue-600 hover:text-blue-800">Hapus Semua</button>
            </div>
        </div>
        <div id="notificationList" class="divide-y dark:divide-gray-700">
            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300">
                <div class="flex items-start space-x-3">
                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Layanan MRO Terbaru</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Kami telah menambahkan layanan MRO untuk Boeing 737-800. Hubungi tim kami untuk informasi lebih lanjut.</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-2">2 jam yang lalu</p>
                    </div>
                </div>
            </div>
            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300">
                <div class="flex items-start space-x-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Sertifikasi ISO 9001 Diperbaharui</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">PTDI berhasil memperbarui sertifikasi ISO 9001:2015 untuk semua layanan engineering.</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-2">1 hari yang lalu</p>
                    </div>
                </div>
            </div>
            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300">
                <div class="flex items-start space-x-3">
                    <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 flex-shrink-0"></div>
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Program Pelatihan Baru</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Daftar sekarang untuk program pelatihan maintenance CN-295 yang akan dimulai bulan depan.</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-2">3 hari yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 max-w-md mx-4">
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Hubungi Tim Dukungan</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Tim ahli kami siap membantu kebutuhan layanan penerbangan Anda.</p>
            <div class="space-y-3 mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-gray-700 dark:text-gray-300">pub-rel@indonesian-aerospace.com</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-gray-700 dark:text-gray-300">sekretariatptdi@indonesian-aerospace.com</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-gray-700 dark:text-gray-300">marketing-ptdi@indonesian-aerospace.com</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span class="text-gray-700 dark:text-gray-300">+62 Contoh</span>
                </div>
            </div>
            <button onclick="hideContactInfo()" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                Tutup
            </button>
        </div>
    </div>

    <script>
        // Dark Mode Functions
        function toggleDarkMode() {
            const body = document.body;
            const isDark = body.classList.contains('dark');
            
            if (isDark) {
                body.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
                updateDarkModeIcon(false);
            } else {
                body.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
                updateDarkModeIcon(true);
            }
        }

        function updateDarkModeIcon(isDark) {
            const desktopIcon = document.getElementById('darkModeIcon');
            const mobileIcon = document.getElementById('mobileDarkModeIcon');
            
            if (isDark) {
                // Sun icon for light mode
                desktopIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>';
                mobileIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>';
            } else {
                // Moon icon for dark mode
                desktopIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>';
                mobileIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>';
            }
        }

        // Notification Functions
        function toggleNotifications() {
            const panel = document.getElementById('notificationPanel');
            const btn = document.getElementById('notificationBtn');
            
            if (panel.classList.contains('hidden')) {
                panel.classList.remove('hidden');
                btn.classList.add('notification-bounce');
                setTimeout(() => btn.classList.remove('notification-bounce'), 1000);
            } else {
                panel.classList.add('hidden');
            }
        }

        function clearAllNotifications() {
            const notificationList = document.getElementById('notificationList');
            const badge = document.getElementById('notificationBadge');
            
            notificationList.innerHTML = '<div class="p-8 text-center text-gray-500 dark:text-gray-400"><p>Tidak ada notifikasi</p></div>';
            badge.style.display = 'none';
            
            // Hide panel after clearing
            setTimeout(() => {
                document.getElementById('notificationPanel').classList.add('hidden');
            }, 1000);
        }

        function showContactInfo() {
            document.getElementById('contactModal').classList.remove('hidden');
            document.getElementById('contactModal').classList.add('flex');
        }

        function hideContactInfo() {
            document.getElementById('contactModal').classList.add('hidden');
            document.getElementById('contactModal').classList.remove('flex');
        }

        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        }

        // Initialize dark mode on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Check for saved dark mode preference
            const savedDarkMode = localStorage.getItem('darkMode');
            if (savedDarkMode === 'true') {
                document.body.classList.add('dark');
                updateDarkModeIcon(true);
            }

            // Close notification panel when clicking outside
            document.addEventListener('click', function(e) {
                const panel = document.getElementById('notificationPanel');
                const btn = document.getElementById('notificationBtn');
                const mobileBtn = document.getElementById('mobileNotificationBtn');
                
                if (!panel.contains(e.target) && !btn.contains(e.target) && !mobileBtn.contains(e.target)) {
                    panel.classList.add('hidden');
                }
            });

            // Close modal when clicking outside
            document.getElementById('contactModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideContactInfo();
                }
            });

            // Add smooth scrolling for better UX
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Simulate new notifications periodically
            setInterval(() => {
                const badge = document.getElementById('notificationBadge');
                if (badge.style.display !== 'none') {
                    badge.classList.add('notification-bounce');
                    setTimeout(() => badge.classList.remove('notification-bounce'), 1000);
                }
            }, 30000); // Every 30 seconds
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'978184c8d27487e9',t:'MTc1NjY5NTY0MC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
