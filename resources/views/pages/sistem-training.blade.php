<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Training - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-2">
                <div class="bg-blue-500 p-3 rounded-lg">
                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">PT. Dirgantara Training Center</h1>
                    <p class="text-gray-600">Platform Pelatihan Karyawan Industri Penerbangan</p>
                </div>
            </div>
        </div>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pelatihan</p>
                        <p class="text-3xl font-bold text-gray-900">24</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-book text-blue-500 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Peserta Aktif</p>
                        <p class="text-3xl font-bold text-gray-900">156</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-users text-green-500 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Sedang Berlangsung</p>
                        <p class="text-3xl font-bold text-gray-900">8</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-clock text-yellow-500 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tingkat Kelulusan</p>
                        <p class="text-3xl font-bold text-gray-900">92%</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-trophy text-purple-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Training List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold text-gray-800">Daftar Pelatihan</h2>
                            <button onclick="showAddTrainingModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Pelatihan</span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4" id="trainingList">
                            <!-- Training items will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <button onclick="showAddTrainingModal()" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 px-4 rounded-lg transition-colors flex items-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>Buat Pelatihan Baru</span>
                        </button>
                        <button onclick="showParticipantsModal()" class="w-full bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-lg transition-colors flex items-center space-x-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Kelola Peserta</span>
                        </button>
                        <button onclick="showReportsModal()" class="w-full bg-purple-500 hover:bg-purple-600 text-white py-3 px-4 rounded-lg transition-colors flex items-center space-x-2">
                            <i class="fas fa-chart-bar"></i>
                            <span>Lihat Laporan</span>
                        </button>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Aktivitas Terbaru</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <div class="bg-blue-100 p-2 rounded-full">
                                <i class="fas fa-user-check text-blue-500 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">John Doe menyelesaikan pelatihan "Digital Marketing"</p>
                                <p class="text-xs text-gray-500">2 jam yang lalu</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="bg-green-100 p-2 rounded-full">
                                <i class="fas fa-plus text-green-500 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">Pelatihan baru "Leadership Skills" ditambahkan</p>
                                <p class="text-xs text-gray-500">5 jam yang lalu</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="bg-yellow-100 p-2 rounded-full">
                                <i class="fas fa-clock text-yellow-500 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">Pelatihan "Project Management" dimulai</p>
                                <p class="text-xs text-gray-500">1 hari yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Training Modal -->
    <div id="addTrainingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Tambah Pelatihan Baru</h3>
                    <button onclick="hideAddTrainingModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <form onsubmit="saveTraining(event)" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pelatihan</label>
                        <input type="text" id="trainingName" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select id="trainingCategory" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Pilih Kategori</option>
                            <option value="Aircraft Maintenance">Aircraft Maintenance</option>
                            <option value="Flight Operations">Flight Operations</option>
                            <option value="Aviation Safety">Aviation Safety</option>
                            <option value="Quality Control">Quality Control</option>
                            <option value="Manufacturing">Manufacturing</option>
                            <option value="Leadership">Leadership</option>
                            <option value="Technical Skills">Technical Skills</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Durasi (jam)</label>
                        <input type="number" id="trainingDuration" required min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" id="trainingStartDate" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" id="trainingEndDate" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Instruktur</label>
                        <input type="text" id="trainingInstructor" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <input type="text" id="trainingLocation" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Maksimal Peserta</label>
                        <input type="number" id="trainingMaxParticipants" required min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-3">
                                <input type="radio" id="paidTraining" name="trainingType" value="paid" checked onchange="togglePriceInput()" class="text-blue-500">
                                <label for="paidTraining" class="text-sm text-gray-700">Berbayar</label>
                                <input type="radio" id="freeTraining" name="trainingType" value="free" onchange="togglePriceInput()" class="text-blue-500">
                                <label for="freeTraining" class="text-sm text-gray-700">Gratis</label>
                            </div>
                            <input type="number" id="trainingPrice" required min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="trainingDescription" required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                </div>
                
                <div class="flex space-x-3 mt-6">
                    <button type="button" onclick="hideAddTrainingModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit" id="submitBtn" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition-colors">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Participants Modal -->
    <div id="participantsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[80vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Kelola Peserta</h3>
                    <button onclick="hideParticipantsModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <div class="mb-4">
                    <input type="text" placeholder="Cari peserta..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%23059669'/%3E%3Ctext x='20' y='26' text-anchor='middle' fill='white' font-size='14' font-weight='bold'%3EJD%3C/text%3E%3C/svg%3E" alt="Avatar" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-medium text-gray-800">John Doe</p>
                                <p class="text-sm text-gray-600">john.doe@company.com</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Aktif</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%23DC2626'/%3E%3Ctext x='20' y='26' text-anchor='middle' fill='white' font-size='14' font-weight='bold'%3EJS%3C/text%3E%3C/svg%3E" alt="Avatar" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-medium text-gray-800">Jane Smith</p>
                                <p class="text-sm text-gray-600">jane.smith@company.com</p>
                            </div>
                        </div>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Sedang Training</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%237C3AED'/%3E%3Ctext x='20' y='26' text-anchor='middle' fill='white' font-size='14' font-weight='bold'%3EMJ%3C/text%3E%3C/svg%3E" alt="Avatar" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-medium text-gray-800">Mike Johnson</p>
                                <p class="text-sm text-gray-600">mike.johnson@company.com</p>
                            </div>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">Menunggu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Training Detail Modal -->
    <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[80vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Detail Pelatihan</h3>
                    <button onclick="hideDetailModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6" id="detailContent">
                <!-- Detail content will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Reports Modal -->
    <div id="reportsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 max-h-[80vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Laporan Training</h3>
                    <button onclick="hideReportsModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-blue-800 mb-2">Pelatihan Terpopuler</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm">Digital Marketing</span>
                                <span class="text-sm font-medium">45 peserta</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm">Leadership Skills</span>
                                <span class="text-sm font-medium">38 peserta</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm">Project Management</span>
                                <span class="text-sm font-medium">32 peserta</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-green-800 mb-2">Tingkat Kelulusan</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm">Technical Training</span>
                                <span class="text-sm font-medium">95%</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm">Soft Skills</span>
                                <span class="text-sm font-medium">92%</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm">Safety Training</span>
                                <span class="text-sm font-medium">98%</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-4">Grafik Progress Bulanan</h4>
                    <div class="h-32 bg-white rounded border flex items-end justify-around p-4">
                        <div class="bg-blue-500 w-8" style="height: 60%"></div>
                        <div class="bg-blue-500 w-8" style="height: 80%"></div>
                        <div class="bg-blue-500 w-8" style="height: 45%"></div>
                        <div class="bg-blue-500 w-8" style="height: 90%"></div>
                        <div class="bg-blue-500 w-8" style="height: 70%"></div>
                        <div class="bg-blue-500 w-8" style="height: 85%"></div>
                    </div>
                    <div class="flex justify-around mt-2 text-xs text-gray-600">
                        <span>Jan</span>
                        <span>Feb</span>
                        <span>Mar</span>
                        <span>Apr</span>
                        <span>Mei</span>
                        <span>Jun</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample training data with Laravel-like structure
        let trainings = [
            {
                id: 1,
                name: "Aircraft Engine Maintenance Fundamentals",
                category: "Aircraft Maintenance",
                duration: 40,
                startDate: "2024-01-15",
                endDate: "2024-02-15",
                participants: 25,
                maxParticipants: 30,
                status: "Aktif",
                instructor: "Capt. Ir. Bambang Sutrisno",
                description: "Pelatihan komprehensif tentang pemeliharaan mesin pesawat, termasuk troubleshooting, inspeksi rutin, dan prosedur keselamatan sesuai standar DGCA.",
                location: "Hangar Training Center",
                price: 15000000,
                isFree: false,
                created_at: "2024-01-01T10:00:00Z",
                updated_at: "2024-01-10T15:30:00Z"
            },
            {
                id: 2,
                name: "Aviation Leadership & Crew Resource Management",
                category: "Leadership",
                duration: 24,
                startDate: "2024-01-20",
                endDate: "2024-02-20",
                participants: 18,
                maxParticipants: 25,
                status: "Sedang Berlangsung",
                instructor: "Capt. Maria Sari, M.Aero",
                description: "Mengembangkan kemampuan kepemimpinan dalam industri penerbangan dengan fokus pada CRM, decision making, dan komunikasi efektif di cockpit.",
                location: "Flight Simulator Room",
                price: 8500000,
                isFree: false,
                created_at: "2024-01-05T09:00:00Z",
                updated_at: "2024-01-15T14:20:00Z"
            },
            {
                id: 3,
                name: "Basic Aviation Safety & Emergency Procedures",
                category: "Aviation Safety",
                duration: 16,
                startDate: "2024-01-25",
                endDate: "2024-01-27",
                participants: 32,
                maxParticipants: 40,
                status: "Menunggu",
                instructor: "Ir. Ahmad Wijaya, M.Eng",
                description: "Pelatihan dasar keselamatan penerbangan dan prosedur darurat untuk semua karyawan PT. Dirgantara. Pelatihan wajib dan gratis untuk seluruh karyawan baru.",
                location: "Safety Training Center",
                price: 0,
                isFree: true,
                created_at: "2024-01-08T11:00:00Z",
                updated_at: "2024-01-18T16:45:00Z"
            },
            {
                id: 4,
                name: "Aircraft Manufacturing Quality Control",
                category: "Quality Control",
                duration: 32,
                startDate: "2024-02-01",
                endDate: "2024-02-16",
                participants: 15,
                maxParticipants: 20,
                status: "Menunggu",
                instructor: "Dr. Eng. Siti Nurhaliza",
                description: "Pelatihan kontrol kualitas dalam manufaktur pesawat, meliputi inspeksi material, testing procedures, dan dokumentasi sesuai standar internasional.",
                location: "Quality Lab",
                price: 12000000,
                isFree: false,
                created_at: "2024-01-12T09:00:00Z",
                updated_at: "2024-01-20T11:30:00Z"
            },
            {
                id: 5,
                name: "Orientation Program - New Employee",
                category: "Technical Skills",
                duration: 8,
                startDate: "2024-02-05",
                endDate: "2024-02-05",
                participants: 45,
                maxParticipants: 50,
                status: "Menunggu",
                instructor: "HR Team & Senior Engineers",
                description: "Program orientasi gratis untuk karyawan baru PT. Dirgantara, mencakup pengenalan perusahaan, budaya kerja, dan dasar-dasar industri penerbangan.",
                location: "Main Auditorium",
                price: 0,
                isFree: true,
                created_at: "2024-01-15T14:00:00Z",
                updated_at: "2024-01-22T10:15:00Z"
            }
        ];

        let editingId = null;

        // Toggle price input based on training type
        function togglePriceInput() {
            const isFree = document.getElementById('freeTraining').checked;
            const priceInput = document.getElementById('trainingPrice');
            
            if (isFree) {
                priceInput.value = '0';
                priceInput.disabled = true;
                priceInput.classList.add('bg-gray-100');
            } else {
                priceInput.disabled = false;
                priceInput.classList.remove('bg-gray-100');
                if (priceInput.value === '0') {
                    priceInput.value = '';
                }
            }
        }

        // Render training list
        function renderTrainings() {
            const trainingList = document.getElementById('trainingList');
            trainingList.innerHTML = '';

            trainings.forEach(training => {
                const statusColor = {
                    'Aktif': 'bg-green-100 text-green-800',
                    'Sedang Berlangsung': 'bg-blue-100 text-blue-800',
                    'Menunggu': 'bg-yellow-100 text-yellow-800'
                };

                const trainingCard = document.createElement('div');
                trainingCard.className = 'bg-gray-50 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer';
                trainingCard.innerHTML = `
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1" onclick="showTrainingDetail(${training.id})">
                            <div class="flex items-center space-x-2 mb-1">
                                <h3 class="font-semibold text-gray-800 hover:text-blue-600 transition-colors">${training.name}</h3>
                                ${training.isFree ? '<span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">GRATIS</span>' : ''}
                            </div>
                            <p class="text-sm text-gray-600">${training.category} • ${training.duration} jam • ${training.instructor}</p>
                            <p class="text-sm ${training.isFree ? 'text-green-600 font-semibold' : 'text-gray-500'} mt-1">${training.isFree ? 'Pelatihan Gratis' : 'Rp ' + training.price.toLocaleString('id-ID')}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm ${statusColor[training.status]}">${training.status}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                            <span><i class="fas fa-calendar mr-1"></i>${new Date(training.startDate).toLocaleDateString('id-ID')}</span>
                            <span><i class="fas fa-users mr-1"></i>${training.participants}/${training.maxParticipants} peserta</span>
                            <span><i class="fas fa-map-marker-alt mr-1"></i>${training.location}</span>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="showTrainingDetail(${training.id})" class="text-green-500 hover:text-green-700 p-2" title="Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="editTraining(${training.id})" class="text-blue-500 hover:text-blue-700 p-2" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteTraining(${training.id})" class="text-red-500 hover:text-red-700 p-2" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                trainingList.appendChild(trainingCard);
            });
        }

        // Modal functions
        function showAddTrainingModal() {
            editingId = null;
            clearForm();
            document.getElementById('submitBtn').textContent = 'Tambah';
            document.getElementById('addTrainingModal').classList.remove('hidden');
            document.getElementById('addTrainingModal').classList.add('flex');
        }

        function hideAddTrainingModal() {
            document.getElementById('addTrainingModal').classList.add('hidden');
            document.getElementById('addTrainingModal').classList.remove('flex');
            clearForm();
            editingId = null;
        }

        function showParticipantsModal() {
            document.getElementById('participantsModal').classList.remove('hidden');
            document.getElementById('participantsModal').classList.add('flex');
        }

        function hideParticipantsModal() {
            document.getElementById('participantsModal').classList.add('hidden');
            document.getElementById('participantsModal').classList.remove('flex');
        }

        function showReportsModal() {
            document.getElementById('reportsModal').classList.remove('hidden');
            document.getElementById('reportsModal').classList.add('flex');
        }

        function hideReportsModal() {
            document.getElementById('reportsModal').classList.add('hidden');
            document.getElementById('reportsModal').classList.remove('flex');
        }

        function showDetailModal() {
            document.getElementById('detailModal').classList.remove('hidden');
            document.getElementById('detailModal').classList.add('flex');
        }

        function hideDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.getElementById('detailModal').classList.remove('flex');
        }

        // Clear form function
        function clearForm() {
            document.getElementById('trainingName').value = '';
            document.getElementById('trainingCategory').value = '';
            document.getElementById('trainingDuration').value = '';
            document.getElementById('trainingStartDate').value = '';
            document.getElementById('trainingEndDate').value = '';
            document.getElementById('trainingInstructor').value = '';
            document.getElementById('trainingLocation').value = '';
            document.getElementById('trainingMaxParticipants').value = '';
            document.getElementById('trainingPrice').value = '';
            document.getElementById('trainingDescription').value = '';
            
            // Reset training type to paid
            document.getElementById('paidTraining').checked = true;
            document.getElementById('freeTraining').checked = false;
            togglePriceInput();
        }

        // Show training detail
        function showTrainingDetail(id) {
            const training = trainings.find(t => t.id === id);
            if (training) {
                const statusColor = {
                    'Aktif': 'bg-green-100 text-green-800',
                    'Sedang Berlangsung': 'bg-blue-100 text-blue-800',
                    'Menunggu': 'bg-yellow-100 text-yellow-800'
                };

                document.getElementById('detailContent').innerHTML = `
                    <div class="space-y-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">${training.name}</h2>
                                <span class="px-3 py-1 rounded-full text-sm ${statusColor[training.status]}">${training.status}</span>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold ${training.isFree ? 'text-green-600' : 'text-blue-600'}">${training.isFree ? 'GRATIS' : 'Rp ' + training.price.toLocaleString('id-ID')}</p>
                                <p class="text-sm text-gray-500">${training.isFree ? 'Pelatihan Gratis' : 'Per peserta'}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-2">Informasi Pelatihan</h4>
                                    <div class="space-y-2 text-sm">
                                        <p><span class="font-medium">Kategori:</span> ${training.category}</p>
                                        <p><span class="font-medium">Durasi:</span> ${training.duration} jam</p>
                                        <p><span class="font-medium">Instruktur:</span> ${training.instructor}</p>
                                        <p><span class="font-medium">Lokasi:</span> ${training.location}</p>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-2">Jadwal</h4>
                                    <div class="space-y-2 text-sm">
                                        <p><span class="font-medium">Mulai:</span> ${new Date(training.startDate).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                                        <p><span class="font-medium">Selesai:</span> ${new Date(training.endDate).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-2">Peserta</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm text-gray-600">Terdaftar</span>
                                            <span class="font-semibold">${training.participants}/${training.maxParticipants}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-500 h-2 rounded-full" style="width: ${(training.participants / training.maxParticipants) * 100}%"></div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-2">Riwayat</h4>
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <p><span class="font-medium">Dibuat:</span> ${new Date(training.created_at).toLocaleDateString('id-ID')}</p>
                                        <p><span class="font-medium">Diperbarui:</span> ${new Date(training.updated_at).toLocaleDateString('id-ID')}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Deskripsi</h4>
                            <p class="text-gray-600 leading-relaxed">${training.description}</p>
                        </div>

                        <div class="flex space-x-3 pt-4 border-t">
                            <button onclick="editTraining(${training.id}); hideDetailModal();" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition-colors">
                                <i class="fas fa-edit mr-2"></i>Edit Pelatihan
                            </button>
                            <button onclick="deleteTraining(${training.id}); hideDetailModal();" class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition-colors">
                                <i class="fas fa-trash mr-2"></i>Hapus Pelatihan
                            </button>
                        </div>
                    </div>
                `;
                showDetailModal();
            }
        }

        // Save training function (handles both add and edit)
        function saveTraining(event) {
            event.preventDefault();
            
            const isFree = document.getElementById('freeTraining').checked;
            const price = isFree ? 0 : parseInt(document.getElementById('trainingPrice').value);
            
            const formData = {
                name: document.getElementById('trainingName').value,
                category: document.getElementById('trainingCategory').value,
                duration: parseInt(document.getElementById('trainingDuration').value),
                startDate: document.getElementById('trainingStartDate').value,
                endDate: document.getElementById('trainingEndDate').value,
                instructor: document.getElementById('trainingInstructor').value,
                location: document.getElementById('trainingLocation').value,
                maxParticipants: parseInt(document.getElementById('trainingMaxParticipants').value),
                price: price,
                isFree: isFree,
                description: document.getElementById('trainingDescription').value
            };

            if (editingId) {
                // Update existing training
                const index = trainings.findIndex(t => t.id === editingId);
                if (index !== -1) {
                    trainings[index] = {
                        ...trainings[index],
                        ...formData,
                        updated_at: new Date().toISOString()
                    };
                    alert('Pelatihan berhasil diperbarui!');
                }
            } else {
                // Add new training
                const newTraining = {
                    id: Math.max(...trainings.map(t => t.id)) + 1,
                    ...formData,
                    participants: 0,
                    status: 'Menunggu',
                    created_at: new Date().toISOString(),
                    updated_at: new Date().toISOString()
                };
                trainings.push(newTraining);
                alert('Pelatihan berhasil ditambahkan!');
            }

            renderTrainings();
            hideAddTrainingModal();
        }

        // Edit training function
        function editTraining(id) {
            const training = trainings.find(t => t.id === id);
            if (training) {
                editingId = id;
                document.getElementById('trainingName').value = training.name;
                document.getElementById('trainingCategory').value = training.category;
                document.getElementById('trainingDuration').value = training.duration;
                document.getElementById('trainingStartDate').value = training.startDate;
                document.getElementById('trainingEndDate').value = training.endDate;
                document.getElementById('trainingInstructor').value = training.instructor;
                document.getElementById('trainingLocation').value = training.location;
                document.getElementById('trainingMaxParticipants').value = training.maxParticipants;
                document.getElementById('trainingPrice').value = training.price;
                document.getElementById('trainingDescription').value = training.description;
                
                // Set training type (free or paid)
                if (training.isFree) {
                    document.getElementById('freeTraining').checked = true;
                } else {
                    document.getElementById('paidTraining').checked = true;
                }
                togglePriceInput();
                
                document.getElementById('submitBtn').textContent = 'Perbarui';
                showAddTrainingModal();
            }
        }

        // Delete training function
        function deleteTraining(id) {
            const training = trainings.find(t => t.id === id);
            if (training && confirm(`Apakah Anda yakin ingin menghapus pelatihan "${training.name}"?`)) {
                trainings = trainings.filter(t => t.id !== id);
                renderTrainings();
                alert('Pelatihan berhasil dihapus!');
            }
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            renderTrainings();
        });

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            const modals = ['addTrainingModal', 'participantsModal', 'reportsModal', 'detailModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (event.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    if (modalId === 'addTrainingModal') {
                        clearForm();
                        editingId = null;
                    }
                }
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9793442b7323fd74',t:'MTc1Njg4MTczOC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
