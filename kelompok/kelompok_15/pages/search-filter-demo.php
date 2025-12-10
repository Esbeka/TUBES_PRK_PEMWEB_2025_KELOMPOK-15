<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas - Search & Filter Demo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/search-filter.css">
    
    <!-- JavaScript -->
    <script src="../assets/js/ui-interactions.js" defer></script>
    <script src="../assets/js/search-filter.js" defer></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        
        /* Modern Card Style */
        .kelas-card {
            @apply bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] overflow-hidden border-2 border-white/50 animate-fade-in;
            display: flex;
            flex-direction: column;
            height: 100%;
            max-width: 350px;
        }
        
        /* Card Icon Header with 3D effect */
        .card-icon-wrapper {
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 200px;
            position: relative;
            perspective: 1000px;
        }
        
        .card-3d-icon {
            width: 140px;
            height: 160px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            color: white;
            transform: rotate(-8deg);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            position: relative;
            z-index: 2;
        }
        
        .card-3d-bg1, .card-3d-bg2 {
            position: absolute;
            border-radius: 16px;
        }
        
        .card-3d-bg1 {
            width: 130px;
            height: 150px;
            opacity: 0.3;
            transform: rotate(5deg);
            z-index: 0;
            top: 50%;
            left: 50%;
            margin-left: -65px;
            margin-top: -75px;
        }
        
        .card-3d-bg2 {
            width: 120px;
            height: 140px;
            opacity: 0.2;
            transform: rotate(-15deg);
            z-index: 1;
            top: 50%;
            left: 50%;
            margin-left: -60px;
            margin-top: -70px;
        }
        
        .kelas-card-body {
            @apply px-6 pb-4;
            flex: 1;
        }
        
        .kelas-title {
            @apply text-xl font-bold mb-2;
            color: #1f2937;
        }
        
        .kelas-code {
            @apply text-sm font-semibold mb-4;
        }
        
        .status-row {
            @apply flex items-center justify-between mb-4;
        }
        
        .status-badge {
            @apply flex items-center gap-2 text-sm font-bold;
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        
        .kelas-card-footer {
            @apply px-6 pb-6;
        }
        
        .btn-card {
            @apply w-full text-center text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all;
            font-size: 15px;
        }
        
        .kelas-meta, .kelas-stats {
            display: none;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-200 via-purple-200 to-pink-300 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-lg border-b border-pink-200 sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">KelasOnline</h1>
                        <p class="text-xs text-gray-600">Daftar Kelas</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <a href="dashboard-mahasiswa.php" class="p-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-xl transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                        CM
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="animate-fade-in">
            <!-- Page Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent mb-2">🔍 Daftar Kelas</h1>
                    <p class="text-gray-700">Kelola dan akses semua kelas yang kamu ikuti</p>
                </div>
                
                <button onclick="showJoinKelasModal()" class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Join Kelas
                </button>
            </div>

            <!-- Search & Filter Section -->
            <div class="bg-white/95 backdrop-blur-lg rounded-2xl shadow-xl p-6 mb-6 border-2 border-pink-200" data-search-filter>
                <!-- Search Bar -->
                <div class="mb-6">
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input 
                            type="text" 
                            id="searchInput" 
                            placeholder="🔍 Cari kelas (nama, kode, deskripsi)..."
                            autocomplete="off"
                            class="w-full pl-12 pr-12 py-3 border-2 border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent bg-white text-gray-900 placeholder-gray-400"
                        >
                        <button onclick="document.getElementById('searchInput').value = ''; searchFilterSystem.handleSearch()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-pink-600 transition-colors">
                            ✕
                        </button>
                    </div>
                </div>

                <!-- Filter Controls -->
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <!-- Semester Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="filterSemester">📚 Semester</label>
                        <select id="filterSemester" class="w-full px-4 py-2 border-2 border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent bg-white text-gray-900">
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
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="filterTahun">📅 Tahun Ajaran</label>
                        <select id="filterTahun" class="w-full px-4 py-2 border-2 border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent bg-white text-gray-900">
                            <option value="all">Semua Tahun</option>
                            <option value="2024/2025">2024/2025</option>
                            <option value="2023/2024">2023/2024</option>
                            <option value="2022/2023">2022/2023</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="filterStatus">✨ Status</label>
                        <select id="filterStatus" class="w-full px-4 py-2 border-2 border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent bg-white text-gray-900">
                            <option value="all">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>

                    <!-- Sort Options -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="sortSelect">🔄 Urutkan</label>
                        <select id="sortSelect" class="w-full px-4 py-2 border-2 border-pink-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent bg-white text-gray-900">
                            <option value="nama-asc">Nama (A-Z)</option>
                            <option value="nama-desc">Nama (Z-A)</option>
                            <option value="tanggal-desc">Terbaru</option>
                            <option value="tanggal-asc">Terlama</option>
                            <option value="semester-asc">Semester (Rendah-Tinggi)</option>
                            <option value="semester-desc">Semester (Tinggi-Rendah)</option>
                        </select>
                    </div>

                    <!-- Clear Filters Button -->
                    <div class="flex items-end">
                        <button id="clearFiltersBtn" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold px-4 py-2 rounded-xl shadow-lg hover:shadow-xl transition-all" disabled>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Result Status -->
            <div class="mb-6">
                <div id="resultCount" class="text-gray-700 font-semibold">
                    Menampilkan <span class="text-pink-600">12</span> kelas
                </div>
            </div>

            <!-- Kelas Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" data-kelas-container>
                <!-- Kelas 1 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Pemrograman Web"
                     data-kode="IF301"
                     data-semester="5"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="Belajar HTML CSS JavaScript PHP">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #e9d5ff 0%, #f3e8ff 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #a855f7 0%, #c084fc 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #a855f7 0%, #c084fc 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #7e22ce 0%, #9333ea 100%);">
                            WEB
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Pemrograman Web</h3>
                        <p class="kelas-code" style="color: #a855f7;">KOM123 • Prof. Budi Santoso</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #16a34a;">
                                <span class="status-dot" style="background: #16a34a;"></span>
                                AKTIF
                            </div>
                            <span style="color: #7e22ce; font-weight: bold;">2 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=1" class="btn-card" style="background: linear-gradient(135deg, #7e22ce 0%, #9333ea 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas 2 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Basis Data"
                     data-kode="KOM201"
                     data-semester="3"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="SQL NoSQL Database Design">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #fce7f3 0%, #fce7f3 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #f472b6 0%, #f9a8d4 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #f472b6 0%, #f9a8d4 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #db2777 0%, #ec4899 100%);">
                            DB
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Basis Data</h3>
                        <p class="kelas-code" style="color: #db2777;">KOM201 • Dr. Siti Nurhaliza</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #16a34a;">
                                <span class="status-dot" style="background: #16a34a;"></span>
                                AKTIF
                            </div>
                            <span style="color: #db2777; font-weight: bold;">0 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=2" class="btn-card" style="background: linear-gradient(135deg, #db2777 0%, #ec4899 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas 3 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Struktur Data"
                     data-kode="IF303"
                     data-semester="5"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="MySQL SQL Query Normalisasi ERD">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #60a5fa 0%, #93c5fd 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #60a5fa 0%, #93c5fd 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);">
                            DATA
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Struktur Data</h3>
                        <p class="kelas-code" style="color: #2563eb;">KOM202 • Dr. Ahmad Wijaya</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #16a34a;">
                                <span class="status-dot" style="background: #16a34a;"></span>
                                AKTIF
                            </div>
                            <span style="color: #2563eb; font-weight: bold;">1 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=3" class="btn-card" style="background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas 4 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Jaringan Komputer"
                     data-kode="IF101"
                     data-semester="1"
                     data-tahun="2023/2024"
                     data-status="aktif"
                     data-tanggal="2023-09-01"
                     data-deskripsi="Flowchart Pseudocode Sorting Searching">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #d1fae5 0%, #ecfdf5 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #34d399 0%, #6ee7b7 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #34d399 0%, #6ee7b7 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                            NET
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Jaringan Komputer</h3>
                        <p class="kelas-code" style="color: #059669;">KOM301 • Prof. Joko Susilo</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #16a34a;">
                                <span class="status-dot" style="background: #16a34a;"></span>
                                AKTIF
                            </div>
                            <span style="color: #059669; font-weight: bold;">0 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=4" class="btn-card" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas 5 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Sistem Operasi"
                     data-kode="IF302"
                     data-semester="5"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="Linux Windows Process Thread">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #60a5fa 0%, #93c5fd 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #60a5fa 0%, #93c5fd 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);">
                            OS
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Sistem Operasi</h3>
                        <p class="kelas-code" style="color: #1e40af;">KOM302 • Dr. Rina Kusuma</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #16a34a;">
                                <span class="status-dot" style="background: #16a34a;"></span>
                                AKTIF
                            </div>
                            <span style="color: #1e40af; font-weight: bold;">0 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=5" class="btn-card" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas 6 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Matematika Diskrit"
                     data-kode="MTK201"
                     data-semester="3"
                     data-tahun="2023/2024"
                     data-status="selesai"
                     data-tanggal="2024-01-15"
                     data-deskripsi="Logic Set Graph Theory">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #fed7aa 0%, #ffedd5 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #fb923c 0%, #fdba74 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #fb923c 0%, #fdba74 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #c2410c 0%, #ea580c 100%);">
                            MATH
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Matematika Diskrit</h3>
                        <p class="kelas-code" style="color: #c2410c;">MTK201 • Prof. Hadi Wijaya</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #ea580c;">
                                <span class="status-dot" style="background: #ea580c;"></span>
                                SELESAI
                            </div>
                            <span style="color: #c2410c; font-weight: bold;">0 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=6" class="btn-card" style="background: linear-gradient(135deg, #c2410c 0%, #ea580c 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas 7 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Keamanan Informasi"
                     data-kode="IF405"
                     data-semester="7"
                     data-tahun="2024/2025"
                     data-status="selesai"
                     data-tanggal="2024-12-01"
                     data-deskripsi="Android React Native Flutter">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #ccfbf1 0%, #f0fdfa 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #5eead4 0%, #99f6e4 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #5eead4 0%, #99f6e4 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);">
                            SEC
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Keamanan Informasi</h3>
                        <p class="kelas-code" style="color: #0f766e;">KOM401 • Dr. Lisa Hartono</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #ea580c;">
                                <span class="status-dot" style="background: #ea580c;"></span>
                                SELESAI
                            </div>
                            <span style="color: #0f766e; font-weight: bold;">0 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=7" class="btn-card" style="background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas 8 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Machine Learning"
                     data-kode="IF406"
                     data-semester="8"
                     data-tahun="2024/2025"
                     data-status="selesai"
                     data-tanggal="2025-02-01"
                     data-deskripsi="Python TensorFlow Neural Network">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #fef3c7 0%, #fefce8 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #fbbf24 0%, #fcd34d 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #fbbf24 0%, #fcd34d 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #92400e 0%, #b45309 100%);">
                            ML
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Machine Learning</h3>
                        <p class="kelas-code" style="color: #92400e;">KOM501 • Dr. Andi Prabowo</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #ea580c;">
                                <span class="status-dot" style="background: #ea580c;"></span>
                                SELESAI
                            </div>
                            <span style="color: #92400e; font-weight: bold;">0 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=8" class="btn-card" style="background: linear-gradient(135deg, #92400e 0%, #b45309 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas 9 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Pemrograman Python"
                     data-kode="KOM601"
                     data-semester="2"
                     data-tahun="2023/2024"
                     data-status="selesai"
                     data-tanggal="2024-01-15"
                     data-deskripsi="Python Pandas NumPy OOP">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #fecaca 0%, #fee2e2 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #f87171 0%, #fca5a5 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #f87171 0%, #fca5a5 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);">
                            PY
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Pemrograman Python</h3>
                        <p class="kelas-code" style="color: #b91c1c;">KOM601 • Dr. Lina Marlina</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #ea580c;">
                                <span class="status-dot" style="background: #ea580c;"></span>
                                SELESAI
                            </div>
                            <span style="color: #b91c1c; font-weight: bold;">0 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=9" class="btn-card" style="background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas 10 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Keamanan Jaringan"
                     data-kode="KOM602"
                     data-semester="8"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="Cryptography Firewall Security">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #fecaca 0%, #fee2e2 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #f87171 0%, #fca5a5 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #f87171 0%, #fca5a5 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #991b1b 0%, #b91c1c 100%);">
                            SEC
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Keamanan Jaringan</h3>
                        <p class="kelas-code" style="color: #991b1b;">KOM602 • Dr. Muhammad Rizki</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #16a34a;">
                                <span class="status-dot" style="background: #16a34a;"></span>
                                AKTIF
                            </div>
                            <span style="color: #991b1b; font-weight: bold;">1 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=10" class="btn-card" style="background: linear-gradient(135deg, #991b1b 0%, #b91c1c 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas 11 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Rekayasa Perangkat Lunak"
                     data-kode="KOM603"
                     data-semester="6"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="UML SDLC Agile Scrum">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #60a5fa 0%, #93c5fd 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #60a5fa 0%, #93c5fd 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);">
                            RPL
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Rekayasa Perangkat Lunak</h3>
                        <p class="kelas-code" style="color: #1e40af;">KOM603 • Dr. Nur Hidayat</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #16a34a;">
                                <span class="status-dot" style="background: #16a34a;"></span>
                                AKTIF
                            </div>
                            <span style="color: #1e40af; font-weight: bold;">2 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=11" class="btn-card" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas 12 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Sistem Informasi"
                     data-kode="KOM604"
                     data-semester="4"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="Business Process ERP CRM">
                    <div class="card-icon-wrapper" style="background: linear-gradient(135deg, #d1fae5 0%, #ecfdf5 100%);">
                        <div class="card-3d-bg1" style="background: linear-gradient(135deg, #34d399 0%, #6ee7b7 100%);"></div>
                        <div class="card-3d-bg2" style="background: linear-gradient(135deg, #34d399 0%, #6ee7b7 100%);"></div>
                        <div class="card-3d-icon" style="background: linear-gradient(135deg, #15803d 0%, #16a34a 100%);">
                            SI
                        </div>
                    </div>
                    <div class="kelas-card-body">
                        <h3 class="kelas-title">Sistem Informasi</h3>
                        <p class="kelas-code" style="color: #15803d;">KOM604 • Dr. Oktavia Rani</p>
                        <div class="status-row">
                            <div class="status-badge" style="color: #16a34a;">
                                <span class="status-dot" style="background: #16a34a;"></span>
                                AKTIF
                            </div>
                            <span style="color: #15803d; font-weight: bold;">0 Tugas</span>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=12" class="btn-card" style="background: linear-gradient(135deg, #15803d 0%, #16a34a 100%);">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <!-- No Results Placeholder (Hidden by default) -->
            <div id="noResults" class="hidden text-center py-16" style="display: none;">
                <div class="inline-block p-8 bg-pink-50 rounded-3xl border-2 border-pink-200">
                    <svg class="w-20 h-20 mx-auto text-pink-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">🔍 Tidak Ada Hasil</h3>
                    <p class="text-gray-600 mb-4">Tidak ada kelas yang cocok dengan filter Anda. Coba ubah kriteria pencarian.</p>
                    <button onclick="searchFilterSystem.clearFilters()" class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Join Kelas Modal (Dummy) -->
    <script>
        function showJoinKelasModal() {
            alert('Join Kelas Modal (Coming Soon)');
        }
    </script>
</body>
</html>
