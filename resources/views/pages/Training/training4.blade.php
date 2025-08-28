<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Sertifikat - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .certificate-card {
            transition: all 0.3s ease;
        }
        .certificate-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .upload-area {
            border: 2px dashed #e5e7eb;
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            border-color: #3b82f6;
            background-color: #f8fafc;
        }
        .upload-area.dragover {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-white-600 rounded-lg flex items-center justify-center">
                        <img src="{{asset('images/LOGOrl2.png')}}" class="navbar-brand-image " alt="logo">
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Sertifikat/Lisensi</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <h1>Selamat datang kembali, {{ Auth::user()->name }}</h1>

                    
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


        <!-- Certificate Management Section -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white">Manajemen Sertifikat</h2>
                    <button onclick="openUploadModal()" class="bg-white text-green-600 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        <i class="fas fa-plus mr-2"></i>Unggah Sertifikat
                    </button>
                </div>
            </div>
            
            <!-- Certificates Grid -->
            <div class="p-6">
                <div id="certificatesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Sample Certificate 1 -->
                    <div class="certificate-card bg-white border-2 border-gray-200 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-award text-blue-600 text-xl"></i>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="editCertificate(1)" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteCertificate(1)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Certificate Photo -->
                        <div class="mb-3 rounded-lg overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100 p-4">
                            <svg viewBox="0 0 400 280" class="w-full h-32">
                                <rect width="400" height="280" fill="#1e40af" rx="8"/>
                                <rect x="20" y="20" width="360" height="240" fill="white" rx="4"/>
                                <text x="200" y="60" text-anchor="middle" fill="#1e40af" font-size="24" font-weight="bold">SERTIFIKAT</text>
                                <text x="200" y="90" text-anchor="middle" fill="#374151" font-size="16">Pengembangan Web</text>
                                <text x="200" y="130" text-anchor="middle" fill="#6b7280" font-size="12">Diberikan kepada</text>
                                <text x="200" y="155" text-anchor="middle" fill="#1f2937" font-size="18" font-weight="bold">Admin User</text>
                                <text x="200" y="190" text-anchor="middle" fill="#6b7280" font-size="12">Atas keberhasilan menyelesaikan program</text>
                                <text x="200" y="210" text-anchor="middle" fill="#6b7280" font-size="12">Pengembangan Web Lanjutan</text>
                                <circle cx="80" cy="220" r="25" fill="#fbbf24"/>
                                <text x="80" y="225" text-anchor="middle" fill="white" font-size="10" font-weight="bold">SEAL</text>
                                <text x="320" y="235" text-anchor="middle" fill="#6b7280" font-size="10">Tech Academy</text>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Sertifikat Pengembangan Web</h3>
                        <p class="text-sm text-gray-600 mb-3">Diterbitkan oleh Tech Academy</p>
                        <div class="text-xs text-gray-500 space-y-1">
                            <div>Tanggal Terbit: 15 Jan 2024</div>
                            <div>Berlaku Hingga: 15 Jan 2027</div>
                        </div>
                        <button class="mt-3 w-full bg-gray-100 text-gray-700 py-2 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                            Lihat Sertifikat
                        </button>
                    </div>

                    <!-- Sample Certificate 2 -->
                    <div class="certificate-card bg-white border-2 border-gray-200 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-medal text-green-600 text-xl"></i>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="editCertificate(2)" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteCertificate(2)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Certificate Photo -->
                        <div class="mb-3 rounded-lg overflow-hidden bg-gradient-to-br from-green-50 to-green-100 p-4">
                            <svg viewBox="0 0 400 280" class="w-full h-32">
                                <rect width="400" height="280" fill="#059669" rx="8"/>
                                <rect x="20" y="20" width="360" height="240" fill="white" rx="4"/>
                                <text x="200" y="60" text-anchor="middle" fill="#059669" font-size="24" font-weight="bold">SERTIFIKAT</text>
                                <text x="200" y="90" text-anchor="middle" fill="#374151" font-size="16">Manajemen Proyek</text>
                                <text x="200" y="130" text-anchor="middle" fill="#6b7280" font-size="12">Diberikan kepada</text>
                                <text x="200" y="155" text-anchor="middle" fill="#1f2937" font-size="18" font-weight="bold">Admin User</text>
                                <text x="200" y="190" text-anchor="middle" fill="#6b7280" font-size="12">Atas keberhasilan menyelesaikan program</text>
                                <text x="200" y="210" text-anchor="middle" fill="#6b7280" font-size="12">Manajemen Proyek Profesional</text>
                                <circle cx="80" cy="220" r="25" fill="#f59e0b"/>
                                <text x="80" y="225" text-anchor="middle" fill="white" font-size="10" font-weight="bold">PMI</text>
                                <text x="320" y="235" text-anchor="middle" fill="#6b7280" font-size="10">PMI Institute</text>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Manajemen Proyek</h3>
                        <p class="text-sm text-gray-600 mb-3">Diterbitkan oleh PMI Institute</p>
                        <div class="text-xs text-gray-500 space-y-1">
                            <div>Tanggal Terbit: 10 Mar 2024</div>
                            <div>Berlaku Hingga: 10 Mar 2027</div>
                        </div>
                        <button class="mt-3 w-full bg-gray-100 text-gray-700 py-2 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                            Lihat Sertifikat
                        </button>
                    </div>

                    <!-- Add Certificate Card -->
                    <div onclick="openUploadModal()" class="certificate-card bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl p-4 flex flex-col items-center justify-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all">
                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center mb-3">
                            <i class="fas fa-plus text-gray-400 text-xl"></i>
                        </div>
                        <p class="text-gray-500 text-center">Klik untuk mengunggah sertifikat baru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Unggah Sertifikat</h3>
                <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="upload-area rounded-lg p-8 text-center mb-4" ondrop="handleDrop(event)" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)">
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600 mb-2">Seret dan lepas sertifikat Anda di sini</p>
                    <p class="text-sm text-gray-500 mb-4">atau</p>
                    <input type="file" id="certificateFile" accept=".pdf,.jpg,.jpeg,.png" class="hidden" onchange="handleFileSelect(event)">
                    <button onclick="document.getElementById('certificateFile').click()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Pilih File
                    </button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Sertifikat</label>
                        <input type="text" id="certName" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nama sertifikat">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Organisasi Penerbit</label>
                        <input type="text" id="certOrg" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nama organisasi">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Terbit</label>
                            <input type="date" id="issueDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kedaluwarsa</label>
                            <input type="date" id="expiryDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end space-x-3 p-6 border-t">
                <button onclick="closeUploadModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button onclick="uploadCertificate()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Unggah Sertifikat
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Edit Sertifikat</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Sertifikat</label>
                        <input type="text" id="editCertName" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Organisasi Penerbit</label>
                        <input type="text" id="editCertOrg" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Terbit</label>
                            <input type="date" id="editIssueDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kedaluwarsa</label>
                            <input type="date" id="editExpiryDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end space-x-3 p-6 border-t">
                <button onclick="closeEditModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button onclick="saveEditedCertificate()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>

    <script>
        // Certificate data storage
        let certificates = [
            {
                id: 1,
                name: "Sertifikat Pengembangan Web",
                organization: "Tech Academy",
                issueDate: "2024-01-15",
                expiryDate: "2027-01-15",
                icon: "fas fa-award",
                color: "blue"
            },
            {
                id: 2,
                name: "Manajemen Proyek",
                organization: "PMI Institute",
                issueDate: "2024-03-10",
                expiryDate: "2027-03-10",
                icon: "fas fa-medal",
                color: "green"
            }
        ];

        let currentEditId = null;

        // Modal functions
        function openUploadModal() {
            document.getElementById('uploadModal').classList.remove('hidden');
            document.getElementById('uploadModal').classList.add('flex');
        }

        function closeUploadModal() {
            document.getElementById('uploadModal').classList.add('hidden');
            document.getElementById('uploadModal').classList.remove('flex');
            clearUploadForm();
        }

        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
            currentEditId = null;
        }

        // File handling
        function handleDragOver(e) {
            e.preventDefault();
            e.currentTarget.classList.add('dragover');
        }

        function handleDragLeave(e) {
            e.currentTarget.classList.remove('dragover');
        }

        function handleDrop(e) {
            e.preventDefault();
            e.currentTarget.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFile(files[0]);
            }
        }

        function handleFileSelect(e) {
            const file = e.target.files[0];
            if (file) {
                handleFile(file);
            }
        }

        function handleFile(file) {
            // Simulate file processing
            const fileName = file.name.replace(/\.[^/.]+$/, "");
            document.getElementById('certName').value = fileName;
            
            // Show success message
            showNotification('File selected: ' + file.name, 'success');
        }

        // Certificate management
        function uploadCertificate() {
            const name = document.getElementById('certName').value;
            const org = document.getElementById('certOrg').value;
            const issueDate = document.getElementById('issueDate').value;
            const expiryDate = document.getElementById('expiryDate').value;

            if (!name || !org || !issueDate) {
                showNotification('Harap isi semua field yang diperlukan', 'error');
                return;
            }

            const newCert = {
                id: Date.now(),
                name: name,
                organization: org,
                issueDate: issueDate,
                expiryDate: expiryDate,
                icon: "fas fa-certificate",
                color: "purple"
            };

            certificates.push(newCert);
            renderCertificates();
            closeUploadModal();
            showNotification('Sertifikat berhasil diunggah!', 'success');
        }

        function editCertificate(id) {
            const cert = certificates.find(c => c.id === id);
            if (cert) {
                currentEditId = id;
                document.getElementById('editCertName').value = cert.name;
                document.getElementById('editCertOrg').value = cert.organization;
                document.getElementById('editIssueDate').value = cert.issueDate;
                document.getElementById('editExpiryDate').value = cert.expiryDate;
                openEditModal();
            }
        }

        function saveEditedCertificate() {
            if (!currentEditId) return;

            const name = document.getElementById('editCertName').value;
            const org = document.getElementById('editCertOrg').value;
            const issueDate = document.getElementById('editIssueDate').value;
            const expiryDate = document.getElementById('editExpiryDate').value;

            if (!name || !org || !issueDate) {
                showNotification('Harap isi semua field yang diperlukan', 'error');
                return;
            }

            const certIndex = certificates.findIndex(c => c.id === currentEditId);
            if (certIndex !== -1) {
                certificates[certIndex] = {
                    ...certificates[certIndex],
                    name: name,
                    organization: org,
                    issueDate: issueDate,
                    expiryDate: expiryDate
                };
                renderCertificates();
                closeEditModal();
                showNotification('Sertifikat berhasil diperbarui!', 'success');
            }
        }

        function deleteCertificate(id) {
            if (confirm('Apakah Anda yakin ingin menghapus sertifikat ini?')) {
                certificates = certificates.filter(c => c.id !== id);
                renderCertificates();
                showNotification('Sertifikat berhasil dihapus!', 'success');
            }
        }

        // Render certificates
        function renderCertificates() {
            const grid = document.getElementById('certificatesGrid');
            const addCard = grid.querySelector('.cursor-pointer'); // Save the add card
            
            grid.innerHTML = '';
            
            certificates.forEach(cert => {
                const certCard = createCertificateCard(cert);
                grid.appendChild(certCard);
            });
            
            // Re-add the "Add Certificate" card
            grid.appendChild(addCard);
        }

        function createCertificateCard(cert) {
            const div = document.createElement('div');
            div.className = 'certificate-card bg-white border-2 border-gray-200 rounded-xl p-4';
            
            const colorClasses = {
                blue: 'bg-blue-100 text-blue-600',
                green: 'bg-green-100 text-green-600',
                purple: 'bg-purple-100 text-purple-600'
            };
            
            const colorClass = colorClasses[cert.color] || colorClasses.purple;
            const bgColorClass = cert.color === 'blue' ? 'from-blue-50 to-blue-100' : 
                                 cert.color === 'green' ? 'from-green-50 to-green-100' : 
                                 'from-purple-50 to-purple-100';
            const certColor = cert.color === 'blue' ? '#1e40af' : 
                             cert.color === 'green' ? '#059669' : 
                             '#7c3aed';
            
            div.innerHTML = `
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 ${colorClass} rounded-lg flex items-center justify-center">
                        <i class="${cert.icon} text-xl"></i>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="editCertificate(${cert.id})" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteCertificate(${cert.id})" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <!-- Certificate Photo -->
                <div class="mb-3 rounded-lg overflow-hidden bg-gradient-to-br ${bgColorClass} p-4">
                    <svg viewBox="0 0 400 280" class="w-full h-32">
                        <rect width="400" height="280" fill="${certColor}" rx="8"/>
                        <rect x="20" y="20" width="360" height="240" fill="white" rx="4"/>
                        <text x="200" y="60" text-anchor="middle" fill="${certColor}" font-size="24" font-weight="bold">SERTIFIKAT</text>
                        <text x="200" y="90" text-anchor="middle" fill="#374151" font-size="16">${cert.name}</text>
                        <text x="200" y="130" text-anchor="middle" fill="#6b7280" font-size="12">Diberikan kepada</text>
                        <text x="200" y="155" text-anchor="middle" fill="#1f2937" font-size="18" font-weight="bold">Admin User</text>
                        <text x="200" y="190" text-anchor="middle" fill="#6b7280" font-size="12">Atas keberhasilan menyelesaikan program</text>
                        <text x="200" y="210" text-anchor="middle" fill="#6b7280" font-size="12">${cert.name}</text>
                        <circle cx="80" cy="220" r="25" fill="#fbbf24"/>
                        <text x="80" y="225" text-anchor="middle" fill="white" font-size="10" font-weight="bold">SEAL</text>
                        <text x="320" y="235" text-anchor="middle" fill="#6b7280" font-size="10">${cert.organization}</text>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">${cert.name}</h3>
                <p class="text-sm text-gray-600 mb-3">Diterbitkan oleh ${cert.organization}</p>
                <div class="text-xs text-gray-500 space-y-1">
                    <div>Tanggal Terbit: ${formatDate(cert.issueDate)}</div>
                    ${cert.expiryDate ? `<div>Berlaku Hingga: ${formatDate(cert.expiryDate)}</div>` : ''}
                </div>
                <button class="mt-3 w-full bg-gray-100 text-gray-700 py-2 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                    Lihat Sertifikat
                </button>
            `;
            
            return div;
        }

        // Utility functions
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            });
        }

        function clearUploadForm() {
            document.getElementById('certName').value = '';
            document.getElementById('certOrg').value = '';
            document.getElementById('issueDate').value = '';
            document.getElementById('expiryDate').value = '';
            document.getElementById('certificateFile').value = '';
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            renderCertificates();
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9761122a83d2fe03',t:'MTc1NjM1NTQwMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
