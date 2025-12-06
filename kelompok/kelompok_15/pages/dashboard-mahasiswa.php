<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        .animate-slide-in { animation: slideIn 0.6s ease-out; }
        .countdown-urgent { animation: pulse 1.5s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md shadow-lg border-b border-blue-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-950 via-blue-800 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-blue-900 to-blue-600 bg-clip-text text-transparent">KelasOnline</h1>
                        <p class="text-xs text-gray-500">Dashboard Mahasiswa</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button class="p-2 hover:bg-blue-50 rounded-lg transition-colors relative">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-600 rounded-full"></span>
                    </button>
                    <div class="relative">
                        <button class="w-10 h-10 bg-gradient-to-br from-blue-800 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold shadow-lg hover:shadow-xl transition-shadow">
                            M
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-950 via-blue-800 to-blue-600 bg-clip-text text-transparent">
                        Selamat Datang, Ahmad! 👋
                    </h2>
                    <p class="text-gray-600 mt-1">NPM: 2111081001 • Teknik Informatika</p>
                </div>
                <button onclick="openJoinKelasModal()" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Join Kelas
                </button>
            </div>
        </div>

        <!-- Stats Cards - PREMIUM GRADIENT VERSION -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-slide-in">
            <!-- Card 1: Total Kelas - Blue Gradient -->
            <div class="group relative bg-gradient-to-br from-blue-600 via-blue-500 to-blue-400 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-semibold mb-2 tracking-wide">TOTAL KELAS</p>
                        <h3 class="text-5xl font-extrabold text-white mb-1">8</h3>
                        <p class="text-blue-200 text-xs">Semester ini</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 2: Tugas Pending - Orange Gradient -->
            <div class="group relative bg-gradient-to-br from-orange-600 via-orange-500 to-orange-400 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-semibold mb-2 tracking-wide">TUGAS PENDING</p>
                        <h3 class="text-5xl font-extrabold text-white mb-1">5</h3>
                        <p class="text-orange-200 text-xs">Harus dikerjakan</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-12 transition-all">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 3: Tugas Graded - Green Gradient -->
            <div class="group relative bg-gradient-to-br from-green-600 via-green-500 to-green-400 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-semibold mb-2 tracking-wide">TUGAS GRADED</p>
                        <h3 class="text-5xl font-extrabold text-white mb-1">12</h3>
                        <p class="text-green-200 text-xs">Sudah dinilai</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 4: Rata-rata Nilai - Purple Gradient -->
            <div class="group relative bg-gradient-to-br from-purple-600 via-purple-500 to-purple-400 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-semibold mb-2 tracking-wide">RATA-RATA NILAI</p>
                        <h3 class="text-5xl font-extrabold text-white mb-1">85.5</h3>
                        <p class="text-purple-200 text-xs">Performance bagus! 🎉</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            
            <!-- Left Column - Kelas List -->
            <div class="lg:col-span-2 space-y-6">
                <h3 class="text-xl font-bold text-gray-800">Kelas Saya</h3>
                
                <!-- Kelas Card 1 -->
                <div class="bg-white rounded-xl shadow-lg border border-blue-100 overflow-hidden hover:shadow-xl transition-shadow animate-fade-in">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-400 px-5 py-3 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-bold">Pemrograman Web</h4>
                                <p class="text-blue-100 text-xs mt-1">Prof. Dr. Budi Santoso • Semester 5</p>
                            </div>
                            <span class="px-2.5 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">TI2021A</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-4 text-xs text-gray-600 mb-4">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                45 Mahasiswa
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                24 Materi
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                3 Tugas Aktif
                            </div>
                        </div>
                        <a href="detail-kelas-mahasiswa.php?id=1" class="inline-flex items-center gap-1.5 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold text-sm px-4 py-2.5 rounded-lg shadow-md transition-all">sition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Buka Kelas
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 2 -->
                <div class="bg-white rounded-xl shadow-lg border border-green-100 overflow-hidden hover:shadow-xl transition-shadow animate-fade-in" style="animation-delay: 0.1s;">
                    <div class="bg-gradient-to-r from-green-600 to-green-400 px-5 py-3 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-bold">Basis Data Lanjut</h4>
                                <p class="text-green-100 text-xs mt-1">Dr. Siti Aminah • Semester 5</p>
                            </div>
                            <span class="px-2.5 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">TI2021A</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-4 text-xs text-gray-600 mb-4">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                42 Mahasiswa
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                18 Materi
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                2 Tugas Aktif
                            </div>
                        </div>
                        <a href="detail-kelas-mahasiswa.php?id=2" class="inline-flex items-center gap-1.5 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-semibold text-sm px-4 py-2.5 rounded-lg shadow-md transition-all">sition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Buka Kelas
                        </a>
                    </div>
                </div>

                <a href="kelas-mahasiswa.php" class="block text-center text-blue-600 hover:text-blue-700 font-semibold py-3">
                    Lihat Semua Kelas →
                </a>
            </div>

            <!-- Right Column - Widgets -->
            <div class="space-y-6">
                
                <!-- Widget Tugas Pending -->
                <div class="bg-white rounded-xl shadow-lg border-2 border-yellow-100 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Tugas Pending</h3>
                    </div>

                    <div class="space-y-3">
                        <div class="p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                            <h4 class="text-sm font-semibold text-gray-800 mb-1">Project Website E-Commerce</h4>
                            <p class="text-xs text-gray-600 mb-2">Pemrograman Web</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-red-600 font-semibold countdown-urgent">2 Jam 15 Menit</span>
                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded">URGENT</span>
                            </div>
                        </div>

                        <div class="p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                            <h4 class="text-sm font-semibold text-gray-800 mb-1">Analisis UX/UI Website</h4>
                            <p class="text-xs text-gray-600 mb-2">Pemrograman Web</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-600">5 Hari 12 Jam</span>
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded">PENDING</span>
                            </div>
                        </div>

                        <div class="p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                            <h4 class="text-sm font-semibold text-gray-800 mb-1">ERD & Normalisasi Database</h4>
                            <p class="text-xs text-gray-600 mb-2">Basis Data Lanjut</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-600">3 Hari 8 Jam</span>
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded">PENDING</span>
                            </div>
                        </div>
                    </div>

                    <a href="kelas-mahasiswa.php" class="block mt-4 text-center text-yellow-600 hover:text-yellow-700 font-semibold text-sm">
                        Lihat Semua →
                    </a>
                </div>

                <!-- Widget Deadline Terdekat -->
                <div class="bg-white rounded-xl shadow-lg border-2 border-red-100 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Deadline Terdekat</h3>
                    </div>

                    <div class="space-y-3">
                        <div class="p-3 bg-red-50 rounded-lg border border-red-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-2 py-1 bg-red-600 text-white text-xs font-bold rounded">HARI INI</span>
                                <span class="text-xs text-gray-500">23:59</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-800">Project Website E-Commerce</h4>
                            <p class="text-xs text-gray-600 mt-1">Pemrograman Web</p>
                        </div>

                        <div class="p-3 bg-orange-50 rounded-lg border border-orange-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-2 py-1 bg-orange-600 text-white text-xs font-bold rounded">3 HARI</span>
                                <span class="text-xs text-gray-500">23:59</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-800">ERD & Normalisasi Database</h4>
                            <p class="text-xs text-gray-600 mt-1">Basis Data Lanjut</p>
                        </div>

                        <div class="p-3 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-2 py-1 bg-blue-600 text-white text-xs font-bold rounded">5 HARI</span>
                                <span class="text-xs text-gray-500">23:59</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-800">Analisis UX/UI Website</h4>
                            <p class="text-xs text-gray-600 mt-1">Pemrograman Web</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="bg-gradient-to-br from-blue-950 via-blue-800 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                    <div class="space-y-2">
                        <a href="profil.php" class="flex items-center gap-3 p-3 bg-white/10 hover:bg-white/20 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="font-medium">Edit Profil</span>
                        </a>
                        <a href="kelas-mahasiswa.php" class="flex items-center gap-3 p-3 bg-white/10 hover:bg-white/20 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span class="font-medium">Lihat Semua Kelas</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Join Kelas -->
    <div id="modalJoinKelas" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto animate-fade-in">
            <div class="sticky top-0 bg-gradient-to-r from-blue-950 via-blue-800 to-blue-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Join Kelas Baru</h3>
                </div>
                <button onclick="closeJoinKelasModal()" class="text-white/80 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-6">
                
                <!-- Step 1: Input Kode -->
                <div id="step1">
                    <div class="text-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800">Masukkan Kode Kelas</h4>
                        <p class="text-sm text-gray-600 mt-2">Kode kelas terdiri dari 6 karakter (huruf & angka)</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 text-center">KODE KELAS</label>
                        <input 
                            type="text" 
                            id="kodeKelas" 
                            maxlength="6"
                            placeholder="ABC123"
                            class="w-full px-6 py-4 text-3xl font-bold text-center border-3 border-blue-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all uppercase tracking-widest"
                            oninput="this.value = this.value.toUpperCase()">
                        <p class="text-xs text-gray-500 text-center mt-2">Otomatis uppercase & max 6 karakter</p>
                    </div>

                    <button onclick="previewKelas()" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-4 rounded-lg shadow-lg transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari Kelas
                    </button>

                    <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded-r-lg mt-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-blue-800 mb-1">Tips Join Kelas</p>
                                <ul class="text-xs text-blue-700 space-y-1">
                                    <li>• Tanyakan kode kelas ke dosen pengampu</li>
                                    <li>• Kode kelas bersifat unik untuk setiap mata kuliah</li>
                                    <li>• Pastikan Anda memasukkan kode dengan benar</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Preview Kelas (Hidden by default) -->
                <div id="step2" class="hidden">
                    <div class="text-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-green-600">Kelas Ditemukan!</h4>
                        <p class="text-sm text-gray-600 mt-2">Periksa detail kelas sebelum bergabung</p>
                    </div>

                    <!-- Preview Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-white border-2 border-blue-200 rounded-xl p-6 mb-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h4 class="text-2xl font-bold text-gray-800">Pemrograman Web 2025</h4>
                                <p class="text-sm text-gray-600 mt-1">TINFC2025 • Semester 5 • 2024/2025</p>
                            </div>
                            <span class="px-3 py-1 bg-blue-600 text-white text-xs font-bold rounded-full shadow-md">ABC123</span>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-400 rounded-full flex items-center justify-center text-white font-bold">
                                    BS
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Prof. Dr. Budi Santoso</p>
                                    <p class="text-xs text-gray-500">Dosen Pengampu</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-4 pt-4 border-t border-blue-200">
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-blue-600">45</p>
                                    <p class="text-xs text-gray-600">Mahasiswa</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-green-600">24</p>
                                    <p class="text-xs text-gray-600">Materi</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-yellow-600">12</p>
                                    <p class="text-xs text-gray-600">Tugas</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg p-4 border border-blue-200">
                            <p class="text-sm text-gray-700">
                                <span class="font-semibold">Deskripsi:</span> Mata kuliah ini membahas tentang pengembangan website modern menggunakan HTML5, CSS3, JavaScript, dan PHP Native.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button onclick="backToStep1()" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                            ← Kembali
                        </button>
                        <button onclick="confirmJoin()" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Join Kelas
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="hidden fixed bottom-8 right-8 bg-white rounded-lg shadow-2xl border-2 border-green-200 p-4 animate-fade-in z-50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Berhasil!</p>
                <p id="toastMessage" class="text-sm text-gray-600"></p>
            </div>
        </div>
    </div>

    <script>
        // Modal Join Kelas
        function openJoinKelasModal() {
            document.getElementById('modalJoinKelas').classList.remove('hidden');
            document.getElementById('step1').classList.remove('hidden');
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('kodeKelas').value = '';
            document.getElementById('kodeKelas').focus();
            document.body.style.overflow = 'hidden';
        }

        function closeJoinKelasModal() {
            document.getElementById('modalJoinKelas').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function previewKelas() {
            const kode = document.getElementById('kodeKelas').value.trim();
            
            if (kode.length !== 6) {
                alert('❌ Kode kelas harus 6 karakter!');
                return;
            }

            // Simulate API call untuk preview kelas
            // Di real app, ini akan fetch data dari backend
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
        }

        function backToStep1() {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
        }

        function confirmJoin() {
            // Simulate join kelas
            showToast('Berhasil join kelas Pemrograman Web 2025!');
            closeJoinKelasModal();
            
            // Refresh page atau update UI
            setTimeout(() => {
                location.reload();
            }, 1500);
        }

        // Toast
        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }

        // ESC & Backdrop
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeJoinKelasModal();
        });

        document.getElementById('modalJoinKelas').addEventListener('click', function(e) {
            if (e.target === this) closeJoinKelasModal();
        });

        // Auto uppercase on input
        document.getElementById('kodeKelas').addEventListener('input', function(e) {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
        });
    </script>

</body>
</html>
