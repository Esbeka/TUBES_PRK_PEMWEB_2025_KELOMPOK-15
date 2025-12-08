<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Kelas - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
        .animate-slide-in { animation: slideIn 0.6s ease-out forwards; }
        .animate-pulse-soft { animation: pulse 1.5s ease-in-out infinite; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-blue-50 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-950 via-blue-800 to-blue-600 shadow-2xl sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-white p-2 rounded-lg shadow-lg">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">KelasOnline</h1>
                        <p class="text-blue-200 text-sm">Statistik Kelas</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="dashboard-dosen.php" class="text-white hover:text-blue-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <div class="flex items-center space-x-3">
                        <img src="https://ui-avatars.com/api/?name=Dr+Budi+Santoso&background=3b82f6&color=fff&size=128" alt="Profile" class="w-10 h-10 rounded-full border-2 border-white shadow-lg">
                        <div class="text-right">
                            <p class="text-white font-semibold text-sm">Dr. Budi Santoso, M.Kom</p>
                            <p class="text-blue-200 text-xs">NIDN: 0012345678</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
        
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Statistik Kelas</h2>
                    <p class="text-gray-600">Analisis performa dan progress kelas Anda</p>
                </div>
                
                <!-- Filter Kelas -->
                <div class="flex items-center space-x-4">
                    <select id="filterKelas" class="px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 bg-white font-semibold text-gray-700">
                        <option value="all">Semua Kelas</option>
                        <option value="pemweb" selected>Pemrograman Web</option>
                        <option value="strdat">Struktur Data</option>
                        <option value="basdat">Basis Data</option>
                        <option value="algopro">Algoritma Pemrograman</option>
                    </select>
                    
                    <button class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-2 rounded-lg hover:shadow-lg transition-all font-semibold flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <span>Export PDF</span>
                    </button>
                </div>
            </div>

            <!-- Kelas Info Card -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-2xl shadow-2xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Pemrograman Web</h3>
                        <div class="flex items-center space-x-6 text-blue-100">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                </svg>
                                <span>45 Mahasiswa</span>
                            </span>
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                                <span>24 Materi</span>
                            </span>
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                                <span>12 Tugas</span>
                            </span>
                            <span class="bg-white text-blue-600 px-4 py-1 rounded-full text-sm font-bold">Semester 5 • 2024/2025</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold mb-1">82.5</p>
                        <p class="text-blue-100 text-sm">Rata-rata Nilai Kelas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            
            <!-- Completion Rate -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-green-600 animate-slide-in" style="animation-delay: 0.1s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-green-600 to-green-500 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Completion Rate</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">78.5%</p>
                <p class="text-green-600 text-sm font-semibold">+5.2% dari bulan lalu</p>
            </div>

            <!-- Submission Rate -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-blue-600 animate-slide-in" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-500 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Submission Rate</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">92.3%</p>
                <p class="text-blue-600 text-sm font-semibold">416 / 451 tugas</p>
            </div>

            <!-- Avg Response Time -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-purple-600 animate-slide-in" style="animation-delay: 0.3s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-purple-600 to-purple-500 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Avg Grading Time</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">2.3 hari</p>
                <p class="text-purple-600 text-sm font-semibold">Feedback response</p>
            </div>

            <!-- Active Students -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-orange-600 animate-slide-in" style="animation-delay: 0.4s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-orange-600 to-orange-500 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Active Students</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">42 / 45</p>
                <p class="text-orange-600 text-sm font-semibold">93.3% engagement</p>
            </div>

        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <!-- Chart 1: Rata-rata Nilai per Tugas -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Rata-rata Nilai per Tugas</h3>
                        <p class="text-gray-600 text-sm">Trend nilai mahasiswa</p>
                    </div>
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
                <div class="relative h-80">
                    <canvas id="nilaiChart"></canvas>
                </div>
            </div>

            <!-- Chart 2: Submission Rate per Tugas -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Submission Rate per Tugas</h3>
                        <p class="text-gray-600 text-sm">Tingkat pengumpulan tugas</p>
                    </div>
                    <div class="bg-green-100 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
                <div class="relative h-80">
                    <canvas id="submissionChart"></canvas>
                </div>
            </div>

            <!-- Chart 3: Distribusi Nilai -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Distribusi Nilai</h3>
                        <p class="text-gray-600 text-sm">Persebaran nilai mahasiswa</p>
                    </div>
                    <div class="bg-purple-100 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </div>
                </div>
                <div class="relative h-80 flex items-center justify-center">
                    <canvas id="distribusiChart"></canvas>
                </div>
            </div>

            <!-- Chart 4: Aktivitas Mahasiswa -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Aktivitas Submission</h3>
                        <p class="text-gray-600 text-sm">Timeline pengumpulan tugas</p>
                    </div>
                    <div class="bg-orange-100 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                </div>
                <div class="relative h-80">
                    <canvas id="aktivitasChart"></canvas>
                </div>
            </div>

        </div>

        <!-- Top Performers & Bottom Performers -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <!-- Top Performers -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-br from-green-600 to-green-500 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Top 5 Performers</h3>
                    </div>
                    <span class="text-green-600 text-sm font-semibold">🏆 Mahasiswa Terbaik</span>
                </div>

                <div class="space-y-4">
                    
                    <!-- Rank 1 -->
                    <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-green-50 to-white rounded-xl border-2 border-green-200">
                        <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-green-600 to-green-500 text-white rounded-full font-bold text-lg shadow-lg">1</div>
                        <img src="https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=10b981&color=fff&size=128" alt="Siti" class="w-12 h-12 rounded-full border-2 border-green-300">
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-800">Siti Nurhaliza</h4>
                            <p class="text-sm text-gray-600">NPM: 2115101002</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-green-600">95.5</p>
                            <p class="text-xs text-gray-500">12/12 tugas</p>
                        </div>
                    </div>

                    <!-- Rank 2 -->
                    <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-blue-50 to-white rounded-xl border-2 border-blue-200">
                        <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-500 text-white rounded-full font-bold text-lg shadow-lg">2</div>
                        <img src="https://ui-avatars.com/api/?name=Andi+Pratama&background=3b82f6&color=fff&size=128" alt="Andi" class="w-12 h-12 rounded-full border-2 border-blue-300">
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-800">Andi Pratama</h4>
                            <p class="text-sm text-gray-600">NPM: 2115101001</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-blue-600">92.8</p>
                            <p class="text-xs text-gray-500">12/12 tugas</p>
                        </div>
                    </div>

                    <!-- Rank 3 -->
                    <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-purple-50 to-white rounded-xl border-2 border-purple-200">
                        <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-500 text-white rounded-full font-bold text-lg shadow-lg">3</div>
                        <img src="https://ui-avatars.com/api/?name=Dewi+Lestari&background=8b5cf6&color=fff&size=128" alt="Dewi" class="w-12 h-12 rounded-full border-2 border-purple-300">
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-800">Dewi Lestari</h4>
                            <p class="text-sm text-gray-600">NPM: 2115101004</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-purple-600">90.2</p>
                            <p class="text-xs text-gray-500">11/12 tugas</p>
                        </div>
                    </div>

                    <!-- Rank 4 -->
                    <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-xl">
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-400 text-white rounded-full font-bold shadow">4</div>
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&background=6b7280&color=fff&size=128" alt="Ahmad" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-sm">Ahmad Fauzi</h4>
                            <p class="text-xs text-gray-600">NPM: 2115101008</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-gray-700">88.5</p>
                            <p class="text-xs text-gray-500">11/12</p>
                        </div>
                    </div>

                    <!-- Rank 5 -->
                    <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-xl">
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-400 text-white rounded-full font-bold shadow">5</div>
                        <img src="https://ui-avatars.com/api/?name=Rina+Wati&background=6b7280&color=fff&size=128" alt="Rina" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-sm">Rina Wati</h4>
                            <p class="text-xs text-gray-600">NPM: 2115101012</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-gray-700">87.3</p>
                            <p class="text-xs text-gray-500">12/12</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Students Need Attention -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-br from-orange-600 to-orange-500 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Perlu Perhatian</h3>
                    </div>
                    <span class="text-orange-600 text-sm font-semibold animate-pulse-soft">⚠️ 5 Mahasiswa</span>
                </div>

                <div class="space-y-4">
                    
                    <!-- Student 1 -->
                    <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-red-50 to-white rounded-xl border-2 border-red-200">
                        <img src="https://ui-avatars.com/api/?name=Budi+Setiawan&background=ef4444&color=fff&size=128" alt="Budi" class="w-12 h-12 rounded-full border-2 border-red-300">
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-800">Budi Setiawan</h4>
                            <p class="text-sm text-gray-600 mb-2">NPM: 2115101003</p>
                            <div class="flex items-center space-x-2">
                                <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full font-semibold">4 Tugas Belum</span>
                                <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full font-semibold">2 Late</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-red-600">62.5</p>
                            <p class="text-xs text-gray-500">8/12 tugas</p>
                        </div>
                    </div>

                    <!-- Student 2 -->
                    <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-orange-50 to-white rounded-xl border-2 border-orange-200">
                        <img src="https://ui-avatars.com/api/?name=Rudi+Hartono&background=f97316&color=fff&size=128" alt="Rudi" class="w-12 h-12 rounded-full border-2 border-orange-300">
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-800">Rudi Hartono</h4>
                            <p class="text-sm text-gray-600 mb-2">NPM: 2115101005</p>
                            <div class="flex items-center space-x-2">
                                <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full font-semibold">2 Tugas Belum</span>
                                <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full font-semibold">Nilai Rendah</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-orange-600">68.2</p>
                            <p class="text-xs text-gray-500">10/12 tugas</p>
                        </div>
                    </div>

                    <!-- Student 3 -->
                    <div class="flex items-center space-x-4 p-3 bg-orange-50 rounded-xl">
                        <img src="https://ui-avatars.com/api/?name=Lisa+Permata&background=fb923c&color=fff&size=128" alt="Lisa" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-sm">Lisa Permata</h4>
                            <p class="text-xs text-gray-600 mb-1">NPM: 2115101015</p>
                            <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full font-semibold">1 Tugas Belum</span>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-gray-700">72.8</p>
                            <p class="text-xs text-gray-500">11/12</p>
                        </div>
                    </div>

                    <!-- Student 4 -->
                    <div class="flex items-center space-x-4 p-3 bg-orange-50 rounded-xl">
                        <img src="https://ui-avatars.com/api/?name=Yoga+Pratama&background=fb923c&color=fff&size=128" alt="Yoga" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-sm">Yoga Pratama</h4>
                            <p class="text-xs text-gray-600 mb-1">NPM: 2115101018</p>
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full font-semibold">Nilai Rendah</span>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-gray-700">70.5</p>
                            <p class="text-xs text-gray-500">12/12</p>
                        </div>
                    </div>

                    <!-- Student 5 -->
                    <div class="flex items-center space-x-4 p-3 bg-orange-50 rounded-xl">
                        <img src="https://ui-avatars.com/api/?name=Nina+Sari&background=fb923c&color=fff&size=128" alt="Nina" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-sm">Nina Sari</h4>
                            <p class="text-xs text-gray-600 mb-1">NPM: 2115101022</p>
                            <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full font-semibold">1 Tugas Belum</span>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-gray-700">71.2</p>
                            <p class="text-xs text-gray-500">11/12</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>
        // Chart.js Configuration
        
        // 1. Rata-rata Nilai per Tugas (Line Chart)
        const nilaiCtx = document.getElementById('nilaiChart').getContext('2d');
        new Chart(nilaiCtx, {
            type: 'line',
            data: {
                labels: ['Tugas 1', 'Tugas 2', 'Tugas 3', 'Tugas 4', 'Tugas 5', 'Tugas 6', 'Tugas 7', 'Tugas 8', 'Tugas 9', 'Tugas 10', 'Tugas 11', 'Tugas 12'],
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: [78, 82, 85, 79, 88, 84, 86, 90, 83, 87, 85, 82],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 1
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 60,
                        max: 100,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: { size: 12 }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { size: 11 }
                        }
                    }
                }
            }
        });

        // 2. Submission Rate per Tugas (Bar Chart)
        const submissionCtx = document.getElementById('submissionChart').getContext('2d');
        new Chart(submissionCtx, {
            type: 'bar',
            data: {
                labels: ['Tugas 1', 'Tugas 2', 'Tugas 3', 'Tugas 4', 'Tugas 5', 'Tugas 6', 'Tugas 7', 'Tugas 8', 'Tugas 9', 'Tugas 10', 'Tugas 11', 'Tugas 12'],
                datasets: [{
                    label: 'Submission Rate (%)',
                    data: [100, 97.8, 95.6, 93.3, 97.8, 91.1, 95.6, 88.9, 93.3, 86.7, 84.4, 68.9],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgb(16, 185, 129)',
                        'rgb(16, 185, 129)',
                        'rgb(16, 185, 129)',
                        'rgb(16, 185, 129)',
                        'rgb(16, 185, 129)',
                        'rgb(16, 185, 129)',
                        'rgb(16, 185, 129)',
                        'rgb(16, 185, 129)',
                        'rgb(16, 185, 129)',
                        'rgb(251, 146, 60)',
                        'rgb(251, 146, 60)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y.toFixed(1) + '%';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            },
                            font: { size: 12 }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { size: 11 }
                        }
                    }
                }
            }
        });

        // 3. Distribusi Nilai (Doughnut Chart)
        const distribusiCtx = document.getElementById('distribusiChart').getContext('2d');
        new Chart(distribusiCtx, {
            type: 'doughnut',
            data: {
                labels: ['A (85-100)', 'B (70-84)', 'C (60-69)', 'D (50-59)', 'E (<50)'],
                datasets: [{
                    data: [18, 15, 8, 3, 1],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgb(16, 185, 129)',
                        'rgb(59, 130, 246)',
                        'rgb(251, 191, 36)',
                        'rgb(251, 146, 60)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 3,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 20,
                            font: {
                                size: 13,
                                weight: 'bold'
                            },
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return label + ': ' + value + ' mhs (' + percentage + '%)';
                            }
                        }
                    }
                },
                cutout: '60%'
            }
        });

        // 4. Aktivitas Submission (Area Chart)
        const aktivitasCtx = document.getElementById('aktivitasChart').getContext('2d');
        new Chart(aktivitasCtx, {
            type: 'line',
            data: {
                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4', 'Minggu 5', 'Minggu 6', 'Minggu 7', 'Minggu 8', 'Minggu 9', 'Minggu 10', 'Minggu 11', 'Minggu 12'],
                datasets: [
                    {
                        label: 'On Time',
                        data: [42, 44, 41, 38, 43, 39, 40, 37, 40, 35, 33, 28],
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.2)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        pointBackgroundColor: 'rgb(16, 185, 129)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    },
                    {
                        label: 'Late',
                        data: [3, 1, 2, 4, 2, 5, 3, 6, 3, 7, 8, 10],
                        borderColor: 'rgb(251, 146, 60)',
                        backgroundColor: 'rgba(251, 146, 60, 0.2)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        pointBackgroundColor: 'rgb(251, 146, 60)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            padding: 15,
                            font: { size: 13, weight: 'bold' },
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12
                    }
                },
                scales: {
                    y: {
                        stacked: false,
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: { size: 12 }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { size: 11 }
                        }
                    }
                }
            }
        });

        // Filter Kelas functionality
        document.getElementById('filterKelas').addEventListener('change', function() {
            console.log('Filter changed to:', this.value);
            // Here you would update charts with new data
            // For demo purposes, just show a message
            const kelasName = this.options[this.selectedIndex].text;
            console.log('Loading data for:', kelasName);
        });
    </script>

</body>
</html>
