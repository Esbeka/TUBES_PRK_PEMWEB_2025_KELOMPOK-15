<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas Saya - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        .animate-slide-in { animation: slideIn 0.6s ease-out; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        .no-results-message { display: none; }
        .no-results-message.active { display: block; }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-200 via-purple-200 to-pink-300 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-lg border-b border-pink-200 sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">KelasOnline</h1>
                        <p class="text-xs text-gray-600">Daftar Kelas Saya</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="dashboard-mahasiswa.php" class="text-gray-600 hover:text-pink-600 font-medium text-sm">← Kembali ke Dashboard</a>
                    <button class="p-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-xl transition-colors relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                    </button>
                    
                    <div class="relative">
                        <button class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg hover:shadow-xl transition-shadow">
                            AM
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-pink-500 via-purple-500 to-purple-600 rounded-2xl shadow-2xl p-8 mb-8 text-white animate-fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2">📚 Kelas Saya</h2>
                    <p class="text-pink-100 text-lg">Kelola dan akses semua kelas yang Anda ikuti</p>
                </div>
                <button onclick="showJoinKelasModal()" class="inline-flex items-center gap-2 bg-white hover:bg-white/90 text-pink-600 font-bold px-6 py-3 rounded-xl shadow-xl hover:shadow-2xl transition-all transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Join Kelas Baru
                </button>
            </div>
        </div>

        <!-- Search & Filter Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 animate-slide-in">
            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="searchInput" 
                        placeholder="Cari kelas (nama, kode, dosen)..."
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all"
                        oninput="filterKelas()"
                    >
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Semester Filter -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Semester</label>
                    <select id="filterSemester" onchange="filterKelas()" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all">
                        <option value="all">Semua Semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                        <option value="8">Semester 8</option>
                    </select>
                </div>

                <!-- Tahun Filter -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Ajaran</label>
                    <select id="filterTahun" onchange="filterKelas()" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all">
                        <option value="all">Semua Tahun</option>
                        <option value="2024/2025">2024/2025</option>
                        <option value="2023/2024">2023/2024</option>
                        <option value="2022/2023">2022/2023</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select id="filterStatus" onchange="filterKelas()" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all">
                        <option value="all">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <!-- Reset Button -->
                <div class="flex items-end">
                    <button onclick="resetFilters()" class="w-full px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset
                    </button>
                </div>
            </div>

            <!-- Result Count -->
            <div class="mt-6 flex items-center justify-between border-t pt-4">
                <p id="resultCount" class="text-sm text-gray-600">Menampilkan <strong class="text-pink-600">12</strong> dari <strong>12</strong> kelas</p>
                
                <!-- Widget: Tugas Pending & Deadline -->
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2 text-sm">
                        <div class="w-3 h-3 bg-orange-500 rounded-full animate-pulse"></div>
                        <span class="text-gray-600">Tugas Pending: <strong class="text-orange-600">3</strong></span>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                        <span class="text-gray-600">Deadline Terdekat: <strong class="text-red-600">Besok</strong></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelas Grid -->
        <div id="kelasGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            
            <!-- Card template akan diisi menggunakan JavaScript berdasarkan filter -->
            
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="no-results-message text-center py-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak ada kelas ditemukan</h3>
            <p class="text-gray-600">Coba ubah filter atau kata kunci pencarian Anda</p>
        </div>

    </div>

    <script>
        // Data kelas (sesuai dengan dashboard-mahasiswa.php)
        const kelasData = [
            { id: 1, nama: 'Pemrograman Web', kode: 'KOM123', dosen: 'Prof. Dr. Budi Santoso', semester: 5, tahun: '2024/2025', status: 'aktif', warna: 'purple', warna_from: 'purple-600', warna_to: 'purple-700', label: 'WEB', tugas: 2 },
            { id: 2, nama: 'Basis Data', kode: 'KOM201', dosen: 'Dr. Siti Nurhaliza', semester: 5, tahun: '2024/2025', status: 'aktif', warna: 'pink', warna_from: 'pink-600', warna_to: 'pink-700', label: 'DB', tugas: 0 },
            { id: 3, nama: 'Struktur Data', kode: 'KOM202', dosen: 'Dr. Ahmad Wijaya', semester: 5, tahun: '2024/2025', status: 'aktif', warna: 'blue', warna_from: 'blue-600', warna_to: 'blue-700', label: 'DATA', tugas: 1 },
            { id: 4, nama: 'Jaringan Komputer', kode: 'KOM301', dosen: 'Prof. Joko Susilo', semester: 5, tahun: '2024/2025', status: 'aktif', warna: 'green', warna_from: 'green-600', warna_to: 'green-700', label: 'NET', tugas: 0 },
            { id: 5, nama: 'Sistem Operasi', kode: 'KOM302', dosen: 'Dr. Rina Kusuma', semester: 5, tahun: '2024/2025', status: 'aktif', warna: 'indigo', warna_from: 'indigo-600', warna_to: 'indigo-700', label: 'OS', tugas: 0 },
            { id: 6, nama: 'Matematika Diskrit', kode: 'MTK201', dosen: 'Prof. Hadi Wijaya', semester: 4, tahun: '2023/2024', status: 'selesai', warna: 'orange', warna_from: 'orange-600', warna_to: 'orange-700', label: 'MATH', tugas: 0 },
            { id: 7, nama: 'Keamanan Informasi', kode: 'KOM401', dosen: 'Dr. Lisa Hartono', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'teal', warna_from: 'teal-600', warna_to: 'teal-700', label: 'SEC', tugas: 0 },
            { id: 8, nama: 'Machine Learning', kode: 'KOM501', dosen: 'Dr. Andi Prabowo', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'yellow', warna_from: 'yellow-600', warna_to: 'amber-700', label: 'ML', tugas: 0 },
            { id: 9, nama: 'Cloud Computing', kode: 'KOM502', dosen: 'Prof. Maya Sari', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'cyan', warna_from: 'cyan-600', warna_to: 'cyan-700', label: 'CLOUD', tugas: 0 },
            { id: 10, nama: 'Mobile Programming', kode: 'KOM402', dosen: 'Dr. Rudi Hartono', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'lime', warna_from: 'lime-600', warna_to: 'lime-700', label: 'MOBI', tugas: 0 },
            { id: 11, nama: 'Data Mining', kode: 'KOM503', dosen: 'Prof. Nina Putri', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'rose', warna_from: 'rose-600', warna_to: 'rose-700', label: 'DATA', tugas: 0 },
            { id: 12, nama: 'Kecerdasan Buatan', kode: 'KOM504', dosen: 'Dr. Faisal Akbar', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'violet', warna_from: 'violet-600', warna_to: 'violet-700', label: 'AI', tugas: 0 }
        ];

        // Render kelas cards
        function renderKelas(kelasArray) {
            const grid = document.getElementById('kelasGrid');
            const noResults = document.getElementById('noResults');
            
            if (kelasArray.length === 0) {
                grid.innerHTML = '';
                noResults.classList.add('active');
                return;
            }
            
            noResults.classList.remove('active');
            
            grid.innerHTML = kelasArray.map(kelas => `
                <div class="group bg-gradient-to-br from-${kelas.warna}-100 via-${kelas.warna}-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-${kelas.warna}-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-${kelas.warna}-200 to-${kelas.warna}-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute top-2 left-4 w-16 h-20 bg-${kelas.warna}-400 rounded transform rotate-12"></div>
                            <div class="absolute bottom-2 right-4 w-16 h-20 bg-${kelas.warna}-500 rounded transform -rotate-6"></div>
                        </div>
                        <div class="relative w-20 h-24 bg-gradient-to-br from-${kelas.warna_from} to-${kelas.warna_to} rounded-lg shadow-xl transform -rotate-3">
                            <div class="h-4 bg-${kelas.warna_to} rounded-t-lg"></div>
                            <div class="p-2 text-white text-xs font-bold">${kelas.label}</div>
                        </div>
                    </div>
                    <div class="p-5 bg-white">
                        <h3 class="text-${kelas.warna}-900 font-bold text-lg mb-1 line-clamp-2">${kelas.nama}</h3>
                        <p class="text-${kelas.warna}-600 text-sm mb-3">${kelas.kode} • ${kelas.dosen}</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-${kelas.status === 'aktif' ? 'green' : 'orange'}-100 text-${kelas.status === 'aktif' ? 'green' : 'orange'}-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-${kelas.status === 'aktif' ? 'green' : 'orange'}-500 rounded-full"></span>
                                ${kelas.status.toUpperCase()}
                            </span>
                            <span class="text-${kelas.warna}-700 text-sm font-semibold">${kelas.tugas} Tugas</span>
                        </div>
                        <a href="detail-kelas-mahasiswa.php?id=${kelas.id}" class="block w-full text-center bg-gradient-to-r from-${kelas.warna_from} to-${kelas.warna_to} hover:from-${kelas.warna_to} hover:to-${kelas.warna_from} text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            `).join('');
            
            updateResultCount(kelasArray.length, kelasData.length);
        }

        // Filter kelas
        function filterKelas() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const semesterFilter = document.getElementById('filterSemester').value;
            const tahunFilter = document.getElementById('filterTahun').value;
            const statusFilter = document.getElementById('filterStatus').value;
            
            const filtered = kelasData.filter(kelas => {
                const matchSearch = searchTerm === '' || 
                    kelas.nama.toLowerCase().includes(searchTerm) ||
                    kelas.kode.toLowerCase().includes(searchTerm) ||
                    kelas.dosen.toLowerCase().includes(searchTerm);
                
                const matchSemester = semesterFilter === 'all' || kelas.semester == semesterFilter;
                const matchTahun = tahunFilter === 'all' || kelas.tahun === tahunFilter;
                const matchStatus = statusFilter === 'all' || kelas.status === statusFilter;
                
                return matchSearch && matchSemester && matchTahun && matchStatus;
            });
            
            renderKelas(filtered);
        }

        // Reset filters
        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterSemester').value = 'all';
            document.getElementById('filterTahun').value = 'all';
            document.getElementById('filterStatus').value = 'all';
            renderKelas(kelasData);
        }

        // Update result count
        function updateResultCount(shown, total) {
            document.getElementById('resultCount').innerHTML = 
                `Menampilkan <strong class="text-pink-600">${shown}</strong> dari <strong>${total}</strong> kelas`;
        }

        // Show join kelas modal
        function showJoinKelasModal() {
            // Redirect to dashboard with modal trigger
            window.location.href = 'dashboard-mahasiswa.php#join';
        }

        // Initial render
        renderKelas(kelasData);
    </script>

</body>
</html>
