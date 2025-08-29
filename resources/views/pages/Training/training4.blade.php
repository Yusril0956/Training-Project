<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white">Manajemen Sertifikat</h2>
                    <button onclick="openUploadModal()" class="bg-white text-green-600 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        <i class="fas fa-plus mr-2"></i>Unggah Sertifikat
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <div id="certificatesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
    let certificates = [];
    let currentEditId = null;
    let uploadedFile = null;

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
        uploadedFile = file;
        const fileNameDisplay = document.querySelector('.upload-area p.text-gray-600');
        if (fileNameDisplay) {
            fileNameDisplay.textContent = 'File terpilih: ' + file.name;
        }
        showNotification('File terpilih: ' + file.name, 'success');
    }

    async function uploadCertificate() {
        const name = document.getElementById('certName').value;
        const org = document.getElementById('certOrg').value;
        const issueDate = document.getElementById('issueDate').value;
        const expiryDate = document.getElementById('expiryDate').value;

        if (!uploadedFile || !name || !org || !issueDate) {
            showNotification('Harap isi semua field dan unggah file.', 'error');
            return;
        }

        const formData = new FormData();
        formData.append('file', uploadedFile);
        formData.append('name', name);
        formData.append('organization', org);
        formData.append('issue_date', issueDate);
        formData.append('expiry_date', expiryDate);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        try {
            const response = await fetch('/certificates', {
                method: 'POST',
                body: formData,
            });

            const result = await response.json();

            if (response.ok) {
                renderCertificates();
                closeUploadModal();
                showNotification(result.message, 'success');
            } else {
                showNotification('Error: ' + JSON.stringify(result.errors), 'error');
            }
        } catch (error) {
            showNotification('Terjadi kesalahan saat mengunggah sertifikat.', 'error');
            console.error('Error:', error);
        }
    }

    function editCertificate(id) {
        const cert = certificates.find(c => c.id === id);
        if (cert) {
            currentEditId = id;
            document.getElementById('editCertName').value = cert.name;
            document.getElementById('editCertOrg').value = cert.organization;
            document.getElementById('editIssueDate').value = cert.issue_date;
            document.getElementById('editExpiryDate').value = cert.expiry_date;
            openEditModal();
        }
    }

    // Ganti fungsi saveEditedCertificate() yang sudah ada
async function saveEditedCertificate() {
    if (!currentEditId) return;

    const name = document.getElementById('editCertName').value;
    const org = document.getElementById('editCertOrg').value;
    const issueDate = document.getElementById('editIssueDate').value;
    const expiryDate = document.getElementById('editExpiryDate').value;

    if (!name || !org || !issueDate) {
        showNotification('Harap isi semua field yang diperlukan', 'error');
        return;
    }

    try {
        const response = await fetch(`/certificates/${currentEditId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                name: name,
                organization: org,
                issue_date: issueDate,
                expiry_date: expiryDate
            })
        });

        const result = await response.json();

        if (response.ok) {
            renderCertificates();
            closeEditModal();
            showNotification(result.message, 'success');
        } else {
            showNotification('Error: ' + JSON.stringify(result.errors), 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan saat menyimpan perubahan.', 'error');
        console.error('Error:', error);
    }
}

// Ganti fungsi deleteCertificate() yang sudah ada
async function deleteCertificate(id) {
    if (confirm('Apakah Anda yakin ingin menghapus sertifikat ini?')) {
        try {
            const response = await fetch(`/certificates/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            });

            const result = await response.json();

            if (response.ok) {
                renderCertificates();
                showNotification(result.message, 'success');
            } else {
                showNotification('Error: ' + JSON.stringify(result.message), 'error');
            }
        } catch (error) {
            showNotification('Terjadi kesalahan saat menghapus sertifikat.', 'error');
            console.error('Error:', error);
        }
    }
}

    function renderCertificates() {
        const grid = document.getElementById('certificatesGrid');
        const addCard = grid.querySelector('.cursor-pointer');
        grid.innerHTML = '';

        fetch('/certificates')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                data.forEach(cert => {
                    const certCard = createCertificateCard(cert);
                    grid.appendChild(certCard);
                });
                grid.appendChild(addCard);
            })
            .catch(error => {
                console.error('Error fetching certificates:', error);
                showNotification('Gagal memuat sertifikat. Periksa koneksi backend.', 'error');
            });
    }

    function createCertificateCard(cert) {
        const div = document.createElement('div');
        div.className = 'certificate-card bg-white border-2 border-gray-200 rounded-xl p-4';
        
        div.innerHTML = `
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-award text-blue-600 text-xl"></i>
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
            <div class="mb-3 rounded-lg overflow-hidden bg-gray-100 p-4 flex items-center justify-center">
                <img src="/storage/${cert.file_path}" alt="Sertifikat" class="w-full h-auto max-h-48 object-contain">
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">${cert.name}</h3>
            <p class="text-sm text-gray-600 mb-3">Diterbitkan oleh ${cert.organization}</p>
            <div class="text-xs text-gray-500 space-y-1">
                <div>Tanggal Terbit: ${formatDate(cert.issue_date)}</div>
                ${cert.expiry_date ? `<div>Berlaku Hingga: ${formatDate(cert.expiry_date)}</div>` : ''}
            </div>
            <a href="/storage/${cert.file_path}" target="_blank" class="mt-3 w-full block text-center bg-gray-100 text-gray-700 py-2 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                Lihat Sertifikat
            </a>
        `;
        
        return div;
    }

    function formatDate(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
    }

    function clearUploadForm() {
        document.getElementById('certName').value = '';
        document.getElementById('certOrg').value = '';
        document.getElementById('issueDate').value = '';
        document.getElementById('expiryDate').value = '';
        document.getElementById('certificateFile').value = '';
        uploadedFile = null;
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

    document.addEventListener('DOMContentLoaded', function() {
        renderCertificates();
    });
</script>
</body>
</html>