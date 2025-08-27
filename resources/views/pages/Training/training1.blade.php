<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DirgantaraLearn - Pelatihan Pengetahuan Umum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 50%, #1e40af 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
        .progress-bar { transition: width 0.5s ease-in-out; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="gradient-bg text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <img src="{{asset('images/LOGOrl2.png')}}" class="navbar-brand-image " alt="logo">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">PT.Dirgantara</h1>
                        <p class="text-blue-100 text-sm">Keunggulan Pelatihan Dirgantara</p>
                    </div>
                </div>
                <nav class="hidden md:flex space-x-6">
                    <a href="#dashboard" class="hover:text-blue-200 transition-colors">Dasbor</a>
                    <a href="#courses" class="hover:text-blue-200 transition-colors">Kursus</a>
                    <a href="#progress" class="hover:text-blue-200 transition-colors">Kemajuan</a>
                    <a href="#resources" class="hover:text-blue-200 transition-colors">Sumber Daya</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Breadcrumb Navigation -->
    <div class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-6 py-3">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="#" class="hover:text-blue-600 transition-colors" onclick="navigateTo('home')">🏠 Home</a>
                <span class="text-gray-400">></span>
                <a href="#" class="hover:text-blue-600 transition-colors" onclick="navigateTo('training')">📚 Training</a>
                <span class="text-gray-400">></span>
                <a href="#" class="hover:text-blue-600 transition-colors" onclick="navigateTo('data')">💾 Data</a>
                <span class="text-gray-400">></span>
                <span class="text-gray-800 font-medium">🧠 General Knowledge</span>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <!-- Welcome Section -->
        <section id="dashboard" class="mb-12">
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Selamat Datang di Pelatihan Pengetahuan Umum Dirgantara PT.Dirgantara</h2>
                <p class="text-gray-600 text-lg mb-6">Tingkatkan pemahaman Anda tentang dasar-dasar dirgantara, protokol keselamatan, dan standar industri melalui modul pelatihan komprehensif kami.</p>
                
                <!-- Progress Overview -->
                <div class="grid md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 rounded-lg p-6 text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-2">12</div>
                        <div class="text-gray-600">Modul Selesai</div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-6 text-center">
                        <div class="text-3xl font-bold text-green-600 mb-2">85%</div>
                        <div class="text-gray-600">Kemajuan Keseluruhan</div>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-6 text-center">
                        <div class="text-3xl font-bold text-purple-600 mb-2">24</div>
                        <div class="text-gray-600">Jam Selesai</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Training Modules -->
        <section id="courses" class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Modul Pelatihan</h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Module 1 -->
                <div class="bg-white rounded-xl shadow-lg card-hover cursor-pointer" onclick="openModule('aerospace-fundamentals')">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <span class="text-2xl">✈️</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Dasar-dasar Dirgantara</h4>
                                <p class="text-sm text-gray-500">Prinsip dan konsep dasar</p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Kemajuan</span>
                                <span>100%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full progress-bar" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">8 pelajaran • 2 jam</span>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Selesai</span>
                        </div>
                    </div>
                </div>

                <!-- Module 2 -->
                <div class="bg-white rounded-xl shadow-lg card-hover cursor-pointer" onclick="openModule('safety-protocols')">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                <span class="text-2xl">🛡️</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Protokol Keselamatan</h4>
                                <p class="text-sm text-gray-500">Prosedur keselamatan kritis</p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Kemajuan</span>
                                <span>75%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full progress-bar" style="width: 75%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">10 pelajaran • 3 jam</span>
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Sedang Berlangsung</span>
                        </div>
                    </div>
                </div>

                <!-- Module 3 -->
                <div class="bg-white rounded-xl shadow-lg card-hover cursor-pointer" onclick="openModule('materials-science')">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                <span class="text-2xl">🔬</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Ilmu Material</h4>
                                <p class="text-sm text-gray-500">Material dirgantara & properti</p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Kemajuan</span>
                                <span>0%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-300 h-2 rounded-full progress-bar" style="width: 0%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">12 pelajaran • 4 jam</span>
                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">Belum Dimulai</span>
                        </div>
                    </div>
                </div>

                <!-- Module 4 -->
                <div class="bg-white rounded-xl shadow-lg card-hover cursor-pointer" onclick="openModule('regulations')">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                <span class="text-2xl">📋</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Regulasi Industri</h4>
                                <p class="text-sm text-gray-500">FAA, EASA, dan standar internasional</p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Kemajuan</span>
                                <span>45%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full progress-bar" style="width: 45%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">15 pelajaran • 5 jam</span>
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Sedang Berlangsung</span>
                        </div>
                    </div>
                </div>

                <!-- Module 5 -->
                <div class="bg-white rounded-xl shadow-lg card-hover cursor-pointer" onclick="openModule('quality-assurance')">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <span class="text-2xl">✅</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Jaminan Kualitas</h4>
                                <p class="text-sm text-gray-500">Proses dan standar QA</p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Kemajuan</span>
                                <span>90%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full progress-bar" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">8 pelajaran • 3 jam</span>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Hampir Selesai</span>
                        </div>
                    </div>
                </div>

                <!-- Module 6 -->
                <div class="bg-white rounded-xl shadow-lg card-hover cursor-pointer" onclick="openModule('project-management')">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                                <span class="text-2xl">📊</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Manajemen Proyek</h4>
                                <p class="text-sm text-gray-500">Siklus hidup proyek dirgantara</p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Kemajuan</span>
                                <span>0%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-300 h-2 rounded-full progress-bar" style="width: 0%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">10 pelajaran • 4 jam</span>
                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">Belum Dimulai</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Resources -->
        <section id="resources" class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Sumber Daya Cepat</h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6 text-center card-hover cursor-pointer" onclick="openResource('glossary')">
                    <div class="text-3xl mb-3">📚</div>
                    <h4 class="font-semibold text-gray-800 mb-2">Glosarium Dirgantara</h4>
                    <p class="text-sm text-gray-600">Istilah teknis dan definisi</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center card-hover cursor-pointer" onclick="openResource('calculator')">
                    <div class="text-3xl mb-3">🧮</div>
                    <h4 class="font-semibold text-gray-800 mb-2">Konverter Satuan</h4>
                    <p class="text-sm text-gray-600">Konversi pengukuran dirgantara</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center card-hover cursor-pointer" onclick="openResource('standards')">
                    <div class="text-3xl mb-3">📐</div>
                    <h4 class="font-semibold text-gray-800 mb-2">Perpustakaan Standar</h4>
                    <p class="text-sm text-gray-600">Referensi standar industri</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center card-hover cursor-pointer" onclick="openResource('news')">
                    <div class="text-3xl mb-3">📰</div>
                    <h4 class="font-semibold text-gray-800 mb-2">Berita Industri</h4>
                    <p class="text-sm text-gray-600">Update terbaru dirgantara</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Module Modal -->
    <div id="moduleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 id="modalTitle" class="text-2xl font-bold text-gray-800"></h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                </div>
            </div>
            <div id="modalContent" class="p-6">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h4 class="font-semibold mb-4">DirgantaraLearn PT.Dirgantara</h4>
                    <p class="text-gray-300 text-sm">Pendidikan dirgantara komprehensif untuk profesional industri.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Dukungan</h4>
                    <ul class="text-gray-300 text-sm space-y-2">
                        <li><a href="#" class="hover:text-white">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-white">Hubungi Dukungan</a></li>
                        <li><a href="#" class="hover:text-white">Panduan Pelatihan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Perusahaan</h4>
                    <ul class="text-gray-300 text-sm space-y-2">
                        <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white">Sertifikasi</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300 text-sm">
                <p>&copy; 2025 ini WM by:Reqi :V</p>
            </div>
        </div>
    </footer>

    <script>
        function openModule(moduleId) {
            const modal = document.getElementById('moduleModal');
            const title = document.getElementById('modalTitle');
            const content = document.getElementById('modalContent');
            
            const moduleData = {
                'aerospace-fundamentals': {
                    title: 'Dasar-dasar Dirgantara',
                    content: `
                        <div class="space-y-6">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <span class="text-green-600 text-xl mr-3">✅</span>
                                    <span class="font-semibold text-green-800">Modul Selesai</span>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Gambaran Kursus</h4>
                                    <ul class="space-y-2 text-gray-600">
                                        <li>• Prinsip dasar aerodinamika</li>
                                        <li>• Gambaran sistem pesawat</li>
                                        <li>• Dasar-dasar mekanika penerbangan</li>
                                        <li>• Dasar sistem propulsi</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Hasil Pembelajaran</h4>
                                    <ul class="space-y-2 text-gray-600">
                                        <li>• Memahami gaya angkat dan hambat</li>
                                        <li>• Mengidentifikasi komponen utama pesawat</li>
                                        <li>• Menjelaskan prinsip dasar penerbangan</li>
                                        <li>• Mengenali jenis-jenis propulsi</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">Tinjau Modul</button>
                                <button class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors">Unduh Sertifikat</button>
                            </div>
                        </div>
                    `
                },
                'safety-protocols': {
                    title: 'Safety Protocols',
                    content: `
                        <div class="space-y-6">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <span class="text-blue-600 text-xl mr-3">📚</span>
                                    <span class="font-semibold text-blue-800">75% Complete - Continue Learning</span>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Completed Lessons</h4>
                                    <ul class="space-y-2 text-gray-600">
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Workplace safety fundamentals</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Personal protective equipment</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Hazard identification</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Emergency procedures</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Chemical safety protocols</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Fire safety systems</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Electrical safety basics</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Remaining Lessons</h4>
                                    <ul class="space-y-2 text-gray-600">
                                        <li class="flex items-center"><span class="text-gray-400 mr-2">○</span> Confined space safety</li>
                                        <li class="flex items-center"><span class="text-gray-400 mr-2">○</span> Lockout/Tagout procedures</li>
                                        <li class="flex items-center"><span class="text-gray-400 mr-2">○</span> Safety reporting systems</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">Continue Module</button>
                                <button class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors">Review Progress</button>
                            </div>
                        </div>
                    `
                },
                'materials-science': {
                    title: 'Materials Science',
                    content: `
                        <div class="space-y-6">
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <span class="text-gray-600 text-xl mr-3">📖</span>
                                    <span class="font-semibold text-gray-800">Ready to Start</span>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Module Content</h4>
                                    <ul class="space-y-2 text-gray-600">
                                        <li>• Aerospace material properties</li>
                                        <li>• Composite materials overview</li>
                                        <li>• Metal alloys in aerospace</li>
                                        <li>• Material testing methods</li>
                                        <li>• Fatigue and stress analysis</li>
                                        <li>• Corrosion prevention</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Prerequisites</h4>
                                    <ul class="space-y-2 text-gray-600">
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Aerospace Fundamentals</li>
                                        <li class="flex items-center"><span class="text-blue-500 mr-2">→</span> Basic chemistry knowledge recommended</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">Start Module</button>
                                <button class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors">Preview Content</button>
                            </div>
                        </div>
                    `
                },
                'regulations': {
                    title: 'Industry Regulations',
                    content: `
                        <div class="space-y-6">
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <span class="text-yellow-600 text-xl mr-3">⚡</span>
                                    <span class="font-semibold text-yellow-800">45% Complete - Keep Going!</span>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Completed Topics</h4>
                                    <ul class="space-y-2 text-gray-600">
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> FAA regulations overview</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Part 21 certification</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Quality system requirements</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Documentation standards</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> EASA regulations basics</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> International standards</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Compliance auditing</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Next Up</h4>
                                    <ul class="space-y-2 text-gray-600">
                                        <li class="flex items-center"><span class="text-blue-500 mr-2">→</span> Export control regulations</li>
                                        <li class="flex items-center"><span class="text-gray-400 mr-2">○</span> Environmental regulations</li>
                                        <li class="flex items-center"><span class="text-gray-400 mr-2">○</span> Supply chain compliance</li>
                                        <li class="flex items-center"><span class="text-gray-400 mr-2">○</span> Regulatory updates</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">Continue Learning</button>
                                <button class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors">Take Quiz</button>
                            </div>
                        </div>
                    `
                },
                'quality-assurance': {
                    title: 'Quality Assurance',
                    content: `
                        <div class="space-y-6">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <span class="text-green-600 text-xl mr-3">🎯</span>
                                    <span class="font-semibold text-green-800">90% Complete - Almost Done!</span>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Mastered Concepts</h4>
                                    <ul class="space-y-2 text-gray-600">
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> QA fundamentals</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Statistical process control</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Inspection procedures</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Non-conformance handling</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Corrective actions</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Supplier quality</li>
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Quality metrics</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Final Assessment</h4>
                                    <div class="bg-blue-50 p-4 rounded-lg">
                                        <p class="text-gray-700 mb-3">Complete the final assessment to earn your Quality Assurance certification.</p>
                                        <ul class="space-y-1 text-sm text-gray-600">
                                            <li>• 25 multiple choice questions</li>
                                            <li>• 80% passing score required</li>
                                            <li>• 45 minutes time limit</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">Take Final Assessment</button>
                                <button class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors">Review Materials</button>
                            </div>
                        </div>
                    `
                },
                'project-management': {
                    title: 'Project Management',
                    content: `
                        <div class="space-y-6">
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <span class="text-gray-600 text-xl mr-3">🚀</span>
                                    <span class="font-semibold text-gray-800">Advanced Module - Prerequisites Required</span>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Course Outline</h4>
                                    <ul class="space-y-2 text-gray-600">
                                        <li>• Aerospace project lifecycle</li>
                                        <li>• Risk management strategies</li>
                                        <li>• Resource allocation</li>
                                        <li>• Timeline management</li>
                                        <li>• Stakeholder communication</li>
                                        <li>• Budget control</li>
                                        <li>• Change management</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3">Prerequisites</h4>
                                    <ul class="space-y-2 text-gray-600">
                                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span> Aerospace Fundamentals</li>
                                        <li class="flex items-center"><span class="text-yellow-500 mr-2">⚠</span> Industry Regulations (45% complete)</li>
                                        <li class="flex items-center"><span class="text-red-500 mr-2">✗</span> Materials Science (not started)</li>
                                    </ul>
                                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                        <p class="text-sm text-yellow-800">Complete prerequisite modules to unlock this course.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <button class="bg-gray-400 text-white px-6 py-2 rounded-lg cursor-not-allowed" disabled>Module Locked</button>
                                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">Complete Prerequisites</button>
                            </div>
                        </div>
                    `
                }
            };
            
            const data = moduleData[moduleId];
            if (data) {
                title.textContent = data.title;
                content.innerHTML = data.content;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function openResource(resourceId) {
            const modal = document.getElementById('moduleModal');
            const title = document.getElementById('modalTitle');
            const content = document.getElementById('modalContent');
            
            const resourceData = {
                'glossary': {
                    title: 'Aerospace Glossary',
                    content: `
                        <div class="space-y-4">
                            <div class="mb-6">
                                <input type="text" placeholder="Search terms..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div class="grid gap-4">
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <h4 class="font-semibold text-gray-800">Aerodynamics</h4>
                                    <p class="text-gray-600 text-sm">The study of the motion of air and the forces acting on bodies moving through air.</p>
                                </div>
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <h4 class="font-semibold text-gray-800">Airworthiness</h4>
                                    <p class="text-gray-600 text-sm">The condition of an aircraft being safe and suitable for flight operations.</p>
                                </div>
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <h4 class="font-semibold text-gray-800">Composite Materials</h4>
                                    <p class="text-gray-600 text-sm">Materials made from two or more constituent materials with different physical properties.</p>
                                </div>
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <h4 class="font-semibold text-gray-800">FAA</h4>
                                    <p class="text-gray-600 text-sm">Federal Aviation Administration - The regulatory body for civil aviation in the United States.</p>
                                </div>
                            </div>
                        </div>
                    `
                },
                'calculator': {
                    title: 'Unit Converter',
                    content: `
                        <div class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-gray-800 mb-3">Length Conversion</h4>
                                    <div class="space-y-3">
                                        <input type="number" placeholder="Enter value" class="w-full px-3 py-2 border border-gray-300 rounded">
                                        <select class="w-full px-3 py-2 border border-gray-300 rounded">
                                            <option>Feet</option>
                                            <option>Meters</option>
                                            <option>Inches</option>
                                            <option>Centimeters</option>
                                        </select>
                                        <div class="text-center text-gray-500">↓</div>
                                        <select class="w-full px-3 py-2 border border-gray-300 rounded">
                                            <option>Meters</option>
                                            <option>Feet</option>
                                            <option>Inches</option>
                                            <option>Centimeters</option>
                                        </select>
                                        <div class="bg-blue-50 p-3 rounded text-center">
                                            <span class="font-semibold text-blue-800">Result: 0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-gray-800 mb-3">Weight Conversion</h4>
                                    <div class="space-y-3">
                                        <input type="number" placeholder="Enter value" class="w-full px-3 py-2 border border-gray-300 rounded">
                                        <select class="w-full px-3 py-2 border border-gray-300 rounded">
                                            <option>Pounds</option>
                                            <option>Kilograms</option>
                                            <option>Ounces</option>
                                            <option>Grams</option>
                                        </select>
                                        <div class="text-center text-gray-500">↓</div>
                                        <select class="w-full px-3 py-2 border border-gray-300 rounded">
                                            <option>Kilograms</option>
                                            <option>Pounds</option>
                                            <option>Ounces</option>
                                            <option>Grams</option>
                                        </select>
                                        <div class="bg-blue-50 p-3 rounded text-center">
                                            <span class="font-semibold text-blue-800">Result: 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                },
                'standards': {
                    title: 'Standards Library',
                    content: `
                        <div class="space-y-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">AS9100</h4>
                                    <p class="text-sm text-gray-600 mb-3">Quality management systems for aerospace</p>
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">View Standard →</button>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">RTCA DO-178C</h4>
                                    <p class="text-sm text-gray-600 mb-3">Software considerations in airborne systems</p>
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">View Standard →</button>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">MIL-STD-810</h4>
                                    <p class="text-sm text-gray-600 mb-3">Environmental engineering considerations</p>
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">View Standard →</button>
                                </div>
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">SAE ARP4754A</h4>
                                    <p class="text-sm text-gray-600 mb-3">Development of civil aircraft systems</p>
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">View Standard →</button>
                                </div>
                            </div>
                        </div>
                    `
                },
                'news': {
                    title: 'Industry News',
                    content: `
                        <div class="space-y-4">
                            <div class="border-l-4 border-blue-500 pl-4 pb-4 border-b border-gray-200">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-semibold text-gray-800">New FAA Regulations for Drone Operations</h4>
                                    <span class="text-sm text-gray-500">2 days ago</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">The FAA has announced new regulations affecting commercial drone operations in controlled airspace...</p>
                                <button class="text-blue-600 hover:text-blue-800 text-sm">Read More →</button>
                            </div>
                            <div class="border-l-4 border-green-500 pl-4 pb-4 border-b border-gray-200">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-semibold text-gray-800">Advances in Composite Materials Testing</h4>
                                    <span class="text-sm text-gray-500">1 week ago</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">New testing methodologies for carbon fiber composites show improved accuracy in fatigue analysis...</p>
                                <button class="text-blue-600 hover:text-blue-800 text-sm">Read More →</button>
                            </div>
                            <div class="border-l-4 border-purple-500 pl-4 pb-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-semibold text-gray-800">Industry Safety Report Released</h4>
                                    <span class="text-sm text-gray-500">2 weeks ago</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">Annual aerospace safety statistics show continued improvement in incident reduction...</p>
                                <button class="text-blue-600 hover:text-blue-800 text-sm">Read More →</button>
                            </div>
                        </div>
                    `
                }
            };
            
            const data = resourceData[resourceId];
            if (data) {
                title.textContent = data.title;
                content.innerHTML = data.content;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeModal() {
            const modal = document.getElementById('moduleModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('moduleModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Breadcrumb navigation function
        function navigateTo(section) {
            const messages = {
                'home': 'Navigasi ke halaman utama...',
                'training': 'Membuka menu pelatihan...',
                'data': 'Mengakses bagian data...'
            };
            
            // Show a temporary message
            const tempDiv = document.createElement('div');
            tempDiv.className = 'fixed top-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 transition-all duration-300';
            tempDiv.textContent = messages[section] || 'Navigasi...';
            document.body.appendChild(tempDiv);
            
            // Remove the message after 2 seconds
            setTimeout(() => {
                tempDiv.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(tempDiv);
                }, 300);
            }, 2000);
        }

        // Smooth scrolling for navigation
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
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9759ee3e76cf9e2f',t:'MTc1NjI4MDUzMC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
