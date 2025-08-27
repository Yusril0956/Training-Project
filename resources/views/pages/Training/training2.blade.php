<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelatihan Wajib - Keselamatan Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .progress-bar {
            transition: width 0.3s ease;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Breadcrumb Navigation -->
        <nav class="mb-6" aria-label="Breadcrumb">
            <div class="bg-white rounded-lg shadow-sm p-4">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium transition-colors" onclick="navigateTo('home')">
                            🏠 Home
                        </a>
                    </li>
                    <li class="text-gray-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium transition-colors" onclick="navigateTo('training')">
                            📚 Training
                        </a>
                    </li>
                    <li class="text-gray-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium transition-colors" onclick="navigateTo('data')">
                            📊 Data
                        </a>
                    </li>
                    <li class="text-gray-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <span class="text-gray-700 font-medium">
                            ⚠️ Mandatory
                        </span>
                    </li>
                </ol>
            </div>
        </nav>

        <!-- Header -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Pelatihan Wajib Keselamatan Kerja</h1>
                    <p class="text-gray-600 mt-1">Modul Pelatihan Regulasi K3 - Wajib untuk Semua Karyawan</p>
                </div>
                <div class="text-right">
                    <div class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                        WAJIB
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Batas Waktu: 30 Hari</p>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-medium text-gray-700">Progress Pelatihan</span>
                <span class="text-sm font-medium text-blue-600" id="progressText">0%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-blue-600 h-3 rounded-full progress-bar" style="width: 0%" id="progressBar"></div>
            </div>
        </div>

        <!-- Training Content -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div id="trainingContent">
                <!-- Module 1 -->
                <div class="training-module" id="module1">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Modul 1: Pengenalan Keselamatan Kerja</h2>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 mb-4">Keselamatan kerja adalah prioritas utama di tempat kerja. Setiap karyawan memiliki tanggung jawab untuk:</p>
                        <ul class="list-disc pl-6 text-gray-700 mb-4">
                            <li>Mengikuti semua prosedur keselamatan yang ditetapkan</li>
                            <li>Menggunakan alat pelindung diri (APD) yang sesuai</li>
                            <li>Melaporkan kondisi tidak aman kepada supervisor</li>
                            <li>Berpartisipasi dalam pelatihan keselamatan reguler</li>
                        </ul>
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                            <p class="text-yellow-800"><strong>Penting:</strong> Kecelakaan kerja dapat dicegah dengan kesadaran dan kepatuhan terhadap prosedur.</p>
                        </div>
                    </div>
                </div>

                <!-- Module 2 -->
                <div class="training-module hidden" id="module2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Modul 2: Identifikasi Bahaya di Tempat Kerja</h2>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 mb-4">Jenis-jenis bahaya yang umum ditemui di tempat kerja:</p>
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div class="bg-red-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-red-800 mb-2">Bahaya Fisik</h3>
                                <ul class="text-sm text-red-700">
                                    <li>• Mesin bergerak</li>
                                    <li>• Listrik</li>
                                    <li>• Kebisingan</li>
                                    <li>• Suhu ekstrem</li>
                                </ul>
                            </div>
                            <div class="bg-orange-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-orange-800 mb-2">Bahaya Kimia</h3>
                                <ul class="text-sm text-orange-700">
                                    <li>• Bahan beracun</li>
                                    <li>• Gas berbahaya</li>
                                    <li>• Cairan korosif</li>
                                    <li>• Debu berbahaya</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Module 3 -->
                <div class="training-module hidden" id="module3">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Modul 3: Prosedur Darurat</h2>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 mb-4">Dalam situasi darurat, ikuti prosedur berikut:</p>
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                            <h3 class="font-semibold text-red-800 mb-2">🚨 Prosedur Evakuasi</h3>
                            <ol class="list-decimal pl-6 text-red-700">
                                <li>Tetap tenang dan jangan panik</li>
                                <li>Hentikan semua aktivitas dengan aman</li>
                                <li>Ikuti jalur evakuasi yang telah ditentukan</li>
                                <li>Berkumpul di titik kumpul yang aman</li>
                                <li>Tunggu instruksi dari petugas keselamatan</li>
                            </ol>
                        </div>
                        <p class="text-gray-700">Nomor darurat: <strong class="text-red-600">119 (Pemadam Kebakaran), 118 (Ambulans)</strong></p>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between items-center mt-8 pt-6 border-t">
                <button id="prevBtn" class="bg-gray-300 text-gray-600 px-6 py-2 rounded-lg font-medium cursor-not-allowed" disabled>
                    ← Sebelumnya
                </button>
                <div class="text-sm text-gray-500" id="moduleInfo">
                    Modul 1 dari 3
                </div>
                <button id="nextBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    Selanjutnya →
                </button>
            </div>
        </div>

        <!-- Quiz Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6 hidden" id="quizSection">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kuis Evaluasi</h2>
            <div id="quizContent">
                <div class="quiz-question mb-6">
                    <p class="font-medium text-gray-800 mb-3">1. Apa yang harus dilakukan pertama kali saat terjadi kecelakaan kerja?</p>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="q1" value="a" class="mr-3">
                            <span>Melaporkan kepada atasan</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="q1" value="b" class="mr-3">
                            <span>Memberikan pertolongan pertama yang aman</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="q1" value="c" class="mr-3">
                            <span>Mengambil foto untuk dokumentasi</span>
                        </label>
                    </div>
                </div>

                <div class="quiz-question mb-6">
                    <p class="font-medium text-gray-800 mb-3">2. Kapan APD (Alat Pelindung Diri) harus digunakan?</p>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="q2" value="a" class="mr-3">
                            <span>Hanya saat ada inspeksi</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="q2" value="b" class="mr-3">
                            <span>Setiap saat selama bekerja di area berisiko</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="q2" value="c" class="mr-3">
                            <span>Hanya saat merasa tidak aman</span>
                        </label>
                    </div>
                </div>

                <button id="submitQuiz" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    Kirim Jawaban
                </button>
            </div>
        </div>

        <!-- Completion Certificate -->
        <div class="bg-white rounded-lg shadow-lg p-6 hidden" id="certificateSection">
            <div class="text-center">
                <div class="text-6xl mb-4">🏆</div>
                <h2 class="text-2xl font-bold text-green-600 mb-2">Selamat!</h2>
                <p class="text-gray-700 mb-4">Anda telah berhasil menyelesaikan pelatihan wajib Keselamatan Kerja</p>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                    <p class="text-green-800"><strong>Sertifikat Kelulusan</strong></p>
                    <p class="text-sm text-green-700">Berlaku hingga: <span id="expiryDate"></span></p>
                </div>
                <button id="downloadCert" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    Unduh Sertifikat
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentModule = 1;
        const totalModules = 3;
        let quizCompleted = false;

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        const moduleInfo = document.getElementById('moduleInfo');
        const quizSection = document.getElementById('quizSection');
        const certificateSection = document.getElementById('certificateSection');

        function updateProgress() {
            const progress = (currentModule / totalModules) * 100;
            progressBar.style.width = progress + '%';
            progressText.textContent = Math.round(progress) + '%';
            moduleInfo.textContent = `Modul ${currentModule} dari ${totalModules}`;
        }

        function showModule(moduleNum) {
            // Hide all modules
            document.querySelectorAll('.training-module').forEach(module => {
                module.classList.add('hidden');
            });
            
            // Show current module
            document.getElementById(`module${moduleNum}`).classList.remove('hidden');
            
            // Update navigation buttons
            prevBtn.disabled = moduleNum === 1;
            prevBtn.className = moduleNum === 1 
                ? 'bg-gray-300 text-gray-600 px-6 py-2 rounded-lg font-medium cursor-not-allowed'
                : 'bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition-colors';
            
            if (moduleNum === totalModules) {
                nextBtn.textContent = 'Lanjut ke Kuis →';
            } else {
                nextBtn.textContent = 'Selanjutnya →';
            }
        }

        prevBtn.addEventListener('click', () => {
            if (currentModule > 1) {
                currentModule--;
                showModule(currentModule);
                updateProgress();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentModule < totalModules) {
                currentModule++;
                showModule(currentModule);
                updateProgress();
            } else if (currentModule === totalModules && !quizCompleted) {
                // Show quiz
                document.getElementById('trainingContent').classList.add('hidden');
                quizSection.classList.remove('hidden');
                nextBtn.style.display = 'none';
                prevBtn.style.display = 'none';
            }
        });

        document.getElementById('submitQuiz').addEventListener('click', () => {
            const q1 = document.querySelector('input[name="q1"]:checked');
            const q2 = document.querySelector('input[name="q2"]:checked');
            
            if (!q1 || !q2) {
                alert('Mohon jawab semua pertanyaan sebelum mengirim.');
                return;
            }
            
            // Check answers (correct answers: b, b)
            const score = (q1.value === 'b' ? 1 : 0) + (q2.value === 'b' ? 1 : 0);
            
            if (score >= 2) {
                quizCompleted = true;
                quizSection.classList.add('hidden');
                certificateSection.classList.remove('hidden');
                
                // Set expiry date (1 year from now)
                const expiryDate = new Date();
                expiryDate.setFullYear(expiryDate.getFullYear() + 1);
                document.getElementById('expiryDate').textContent = expiryDate.toLocaleDateString('id-ID');
                
                // Update progress to 100%
                progressBar.style.width = '100%';
                progressText.textContent = '100%';
            } else {
                alert('Nilai Anda belum mencukupi. Silakan ulangi pelatihan dan coba lagi.');
                // Reset to module 1
                currentModule = 1;
                showModule(currentModule);
                updateProgress();
                document.getElementById('trainingContent').classList.remove('hidden');
                quizSection.classList.add('hidden');
                nextBtn.style.display = 'block';
                prevBtn.style.display = 'block';
            }
        });

        document.getElementById('downloadCert').addEventListener('click', () => {
            // Create certificate content
            const certContent = `
SERTIFIKAT PELATIHAN KESELAMATAN KERJA

Dengan ini menyatakan bahwa karyawan telah berhasil menyelesaikan
Pelatihan Wajib Keselamatan Kerja sesuai dengan regulasi perusahaan.

Tanggal Penyelesaian: ${new Date().toLocaleDateString('id-ID')}
Berlaku hingga: ${document.getElementById('expiryDate').textContent}

Sertifikat ini valid untuk keperluan audit dan compliance.
            `;
            
            const blob = new Blob([certContent], { type: 'text/plain' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Sertifikat_Keselamatan_Kerja.txt';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        });

        // Navigation function for breadcrumbs
        function navigateTo(section) {
            const messages = {
                'home': 'Navigasi ke halaman utama sistem...',
                'training': 'Kembali ke daftar semua pelatihan...',
                'data': 'Menuju halaman data pelatihan dan laporan...'
            };
            
            alert(messages[section] + '\n\nBELUM BERES NJER, ini akan mengarahkan ke halaman ' + section.toUpperCase() + '.');
        }

        // Initialize
        showModule(1);
        updateProgress();
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9759e30410a53e24',t:'MTc1NjI4MDA3MC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
