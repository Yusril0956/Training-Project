@extends('layouts.app')
@section('title', 'Training')

@section('content')
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
        .progress-bar { transition: width 0.3s ease; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="bg-white rounded-2xl shadow-xl p-10 mx-auto w-[90%] max-w-6xl min-h-[80vh] mt-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
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

        <!-- Card Progress (kecil) -->
        <div class="bg-white border border-gray-200 rounded-lg shadow p-4 mb-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-medium text-gray-700">Progress Pelatihan</span>
                <span class="text-sm font-medium text-blue-600" id="progressText">0%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-blue-600 h-3 rounded-full progress-bar" style="width: 0%" id="progressBar"></div>
            </div>
        </div>

        <!-- Card Info Training -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-100 border border-gray-200 rounded-lg shadow p-6 flex items-center mb-8">
            <!-- Logo -->
            <div class="flex-shrink-0 bg-blue-600 text-white p-4 rounded-full mr-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path d="M12 14l6.16-3.422A12.083 12.083 0 0118 20H6a12.083 12.083 0 01-.16-9.422L12 14z" />
                </svg>
            </div>
            <!-- Text + Button -->
            <div class="flex-1">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Training Keselamatan Kerja</h2>
                <p class="text-sm text-gray-600 mb-3">
                    Pelatihan ini wajib diikuti semua karyawan untuk memahami prosedur keselamatan kerja.
                </p>
                <a href="customer-requested/1" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition-colors">
                    Masuk Training
                </a>
            </div>
        </div>

        <!-- Training Content -->
        <div id="trainingContent">
            <!-- Module 1 -->
            <div class="training-module" id="module1">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Modul 1: Pengenalan Keselamatan Kerja</h2>
                <p class="text-gray-700 mb-4">Keselamatan kerja adalah prioritas utama di tempat kerja...</p>
            </div>

            <!-- Module 2 -->
            <div class="training-module hidden" id="module2">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Modul 2: Identifikasi Bahaya</h2>
                <p class="text-gray-700 mb-4">Jenis-jenis bahaya yang umum ditemui di tempat kerja...</p>
            </div>

            <!-- Module 3 -->
            <div class="training-module hidden" id="module3">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Modul 3: Prosedur Darurat</h2>
                <p class="text-gray-700 mb-4">Dalam situasi darurat, ikuti prosedur berikut...</p>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center mt-8 pt-6 border-t">
            <button id="prevBtn" 
                    class="bg-gray-300 text-gray-600 px-6 py-2 rounded-lg font-medium cursor-not-allowed" disabled>
                ← Sebelumnya
            </button>
            <div class="text-sm text-gray-500" id="moduleInfo">Modul 1 dari 3</div>
            <button id="nextBtn" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                Selanjutnya →
            </button>
        </div>

        <!-- Quiz Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mt-6 hidden" id="quizSection">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kuis Evaluasi</h2>
            <p class="text-gray-700 mb-3">1. Apa yang harus dilakukan pertama kali saat terjadi kecelakaan kerja?</p>
            <label class="block"><input type="radio" name="q1" value="a"> Melaporkan kepada atasan</label>
            <label class="block"><input type="radio" name="q1" value="b"> Memberikan pertolongan pertama</label>
            <label class="block"><input type="radio" name="q1" value="c"> Mengambil foto untuk dokumentasi</label>
            <br>
            <p class="text-gray-700 mb-3">2. Kapan APD (Alat Pelindung Diri) harus digunakan?</p>
            <label class="block"><input type="radio" name="q2" value="a"> Hanya saat ada inspeksi</label>
            <label class="block"><input type="radio" name="q2" value="b"> Setiap saat selama bekerja</label>
            <label class="block"><input type="radio" name="q2" value="c"> Hanya saat merasa tidak aman</label>
            <br>
            <button id="submitQuiz" 
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium">
                Kirim Jawaban
            </button>
        </div>

        <!-- Certificate -->
        <div class="bg-white rounded-lg shadow-lg p-6 mt-6 hidden" id="certificateSection">
            <div class="text-center">
                <div class="text-6xl mb-4">🏆</div>
                <h2 class="text-2xl font-bold text-green-600 mb-2">Selamat!</h2>
                <p class="text-gray-700 mb-4">Anda telah berhasil menyelesaikan pelatihan wajib</p>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                    <p class="text-green-800"><strong>Sertifikat Kelulusan</strong></p>
                    <p class="text-sm text-green-700">Berlaku hingga: <span id="expiryDate"></span></p>
                </div>
                <button id="downloadCert" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
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
            document.querySelectorAll('.training-module').forEach(m => m.classList.add('hidden'));
            document.getElementById(`module${moduleNum}`).classList.remove('hidden');
            prevBtn.disabled = moduleNum === 1;
            prevBtn.className = moduleNum === 1
                ? 'bg-gray-300 text-gray-600 px-6 py-2 rounded-lg font-medium cursor-not-allowed'
                : 'bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium';
            nextBtn.textContent = (moduleNum === totalModules) ? 'Lanjut ke Kuis →' : 'Selanjutnya →';
        }

        prevBtn.addEventListener('click', () => {
            if (currentModule > 1) {
                currentModule--; showModule(currentModule); updateProgress();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentModule < totalModules) {
                currentModule++; showModule(currentModule); updateProgress();
            } else if (currentModule === totalModules && !quizCompleted) {
                document.getElementById('trainingContent').classList.add('hidden');
                quizSection.classList.remove('hidden');
                nextBtn.style.display = 'none';
                prevBtn.style.display = 'none';
            }
        });

        document.getElementById('submitQuiz').addEventListener('click', () => {
            const q1 = document.querySelector('input[name="q1"]:checked');
            const q2 = document.querySelector('input[name="q2"]:checked');
            if (!q1 || !q2) { alert('Jawab semua pertanyaan dulu!'); return; }
            const score = (q1.value === 'b' ? 1 : 0) + (q2.value === 'b' ? 1 : 0);
            if (score >= 2) {
                quizCompleted = true;
                quizSection.classList.add('hidden');
                certificateSection.classList.remove('hidden');
                const expiryDate = new Date(); expiryDate.setFullYear(expiryDate.getFullYear() + 1);
                document.getElementById('expiryDate').textContent = expiryDate.toLocaleDateString('id-ID');
                progressBar.style.width = '100%'; progressText.textContent = '100%';
            } else {
                alert('Nilai belum cukup. Ulangi lagi.');
                currentModule = 1; showModule(currentModule); updateProgress();
                document.getElementById('trainingContent').classList.remove('hidden');
                quizSection.classList.add('hidden');
                nextBtn.style.display = 'block'; prevBtn.style.display = 'block';
            }
        });

        document.getElementById('downloadCert').addEventListener('click', () => {
            const certContent = `
SERTIFIKAT PELATIHAN KESELAMATAN KERJA

Dengan ini menyatakan bahwa karyawan telah menyelesaikan Pelatihan Wajib Keselamatan Kerja.

Tanggal Penyelesaian: ${new Date().toLocaleDateString('id-ID')}
Berlaku hingga: ${document.getElementById('expiryDate').textContent}
            `;
            const blob = new Blob([certContent], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url; a.download = 'Sertifikat_Keselamatan_Kerja.txt';
            document.body.appendChild(a); a.click();
            document.body.removeChild(a); URL.revokeObjectURL(url);
        });

        showModule(1); updateProgress();
    </script>
</body>
</html>
@endsection
