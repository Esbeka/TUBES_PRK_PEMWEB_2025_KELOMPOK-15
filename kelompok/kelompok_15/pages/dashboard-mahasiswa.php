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
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        .animate-slide-in { animation: slideIn 0.6s ease-out; }
        .animate-float { animation: float 3s ease-in-out infinite; }
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
                        <p class="text-xs text-gray-600">Dashboard Mahasiswa</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button class="p-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-xl transition-colors relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                    </button>
                    
                    <div class="relative">
                        <a href="profil.php" class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg hover:shadow-xl transition-shadow">
                            AM
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-pink-400 via-pink-300 to-purple-400 rounded-3xl shadow-2xl overflow-hidden mb-8 animate-fade-in relative">
            <div class="relative z-10 flex items-center justify-between p-8 lg:p-12">
                <div class="flex-1 max-w-2xl">
                    <!-- Welcome Badge -->
                    <div class="inline-flex items-center gap-2 bg-white/30 backdrop-blur-md rounded-full px-4 py-2 mb-6 shadow-lg">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        <span class="text-white text-sm font-semibold">Selamat Belajar! 🎓</span>
                    </div>
                    
                    <h2 class="text-4xl lg:text-5xl font-extrabold text-white mb-4 drop-shadow-lg">
                        Selamat Datang,<br>Ahmad! 👋
                    </h2>
                    <p class="text-white/90 text-lg mb-8 drop-shadow-md">
                        Mari lanjutkan perjalanan belajar Anda hari ini dan raih prestasi terbaik!
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-4">
                        <button onclick="openJoinKelasModal()" class="inline-flex items-center gap-2 bg-white hover:bg-white/90 text-pink-600 font-bold px-6 py-3.5 rounded-xl shadow-xl hover:shadow-2xl transition-all transform hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Join Kelas Baru
                        </button>
                        <a href="#kelas-saya" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white font-bold px-6 py-3.5 rounded-xl border-2 border-white/50 transition-all transform hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                            Lihat Kelas
                        </a>
                    </div>
                </div>
                
                <!-- Illustration with Badges -->
                <div class="hidden lg:block relative animate-float">
                    <!-- Student Illustration Circle -->
                    <div class="relative w-72 h-72">
                        <!-- Background Gradient Circle -->
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-white/5 rounded-full backdrop-blur-sm"></div>
                        
                        <!-- Student SVG -->
                        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 200 200" fill="none">
                            <!-- Head -->
                            <circle cx="100" cy="70" r="30" fill="white" opacity="0.9"/>
                            <!-- Body -->
                            <path d="M70 100 Q70 130 100 150 Q130 130 130 100 L130 95 Q100 110 70 95 Z" fill="white" opacity="0.9"/>
                            <!-- Book -->
                            <rect x="85" y="115" width="30" height="25" rx="2" fill="#ec4899" opacity="0.8"/>
                            <line x1="100" y1="115" x2="100" y2="140" stroke="white" stroke-width="2"/>
                        </svg>
                        
                        <!-- Badge 1: Total Kelas -->
                        <div class="absolute -top-4 -left-4 bg-white rounded-full px-5 py-3 shadow-2xl border-4 border-pink-200 transform hover:scale-110 transition-transform">
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 font-semibold">Total Kelas</p>
                                    <p class="text-lg font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">5 Kelas</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Badge 2: Tugas Pending -->
                        <div class="absolute -bottom-4 -right-4 bg-white rounded-full px-5 py-3 shadow-2xl border-4 border-purple-200 transform hover:scale-110 transition-transform">
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 font-semibold">Tugas Pending</p>
                                    <p class="text-lg font-bold text-orange-600">3 Tugas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-in">
            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-purple-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Kelas Aktif</p>
                        <h3 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">5</h3>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-orange-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Tugas Pending</p>
                        <h3 class="text-3xl font-bold text-orange-600">3</h3>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-green-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Sudah Dinilai</p>
                        <h3 class="text-3xl font-bold text-green-600">8</h3>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-pink-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Rata-rata Nilai</p>
                        <h3 class="text-3xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">85.5</h3>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-pink-100 to-purple-200 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Menu -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 animate-fade-in">
            <!-- Progress Belajar Card -->
            <a href="progress-mahasiswa.php" class="group block bg-gradient-to-br from-pink-500 to-purple-600 rounded-3xl shadow-xl p-8 hover:shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden relative">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div class="text-white">
                                <h3 class="text-2xl font-bold mb-1">📊 Progress Belajar</h3>
                                <p class="text-pink-100 text-sm">Pantau perkembangan belajar kamu</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-white/90">
                            <span class="text-sm font-semibold">Lihat Progress</span>
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Notifikasi Card -->
            <a href="notifikasi.php" class="group block bg-gradient-to-br from-orange-500 to-orange-600 rounded-3xl shadow-xl p-8 hover:shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden relative">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center relative">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                            </div>
                            <div class="text-white">
                                <h3 class="text-2xl font-bold mb-1">🔔 Notifikasi</h3>
                                <p class="text-orange-100 text-sm">Lihat update terbaru</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-white/90">
                            <span class="text-sm font-semibold">Lihat Semua</span>
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Search & Filter Card -->
        <a href="search-filter-demo.php" class="group block bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl shadow-xl p-8 hover:shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden relative mb-8 animate-fade-in">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/10 rounded-full"></div>
            <div class="relative flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <div class="text-white">
                            <h3 class="text-2xl font-bold mb-1">🔍 Cari & Filter Kelas</h3>
                            <p class="text-blue-100 text-sm">Temukan kelas dengan mudah menggunakan filter</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-white/90">
                        <span class="text-sm font-semibold">Buka Search & Filter</span>
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </div>
            </div>
        </a>

        <!-- Action Section -->
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">Kelas Saya</h3>
            <button onclick="openJoinKelasModal()" class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Join Kelas Baru
            </button>
        </div>

        <!-- Kelas Grid -->
        <div id="kelas-saya" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            
            <!-- Kelas Card 1 - Pemrograman Web -->
            <div class="group bg-gradient-to-br from-purple-100 via-purple-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-purple-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-purple-200 to-purple-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-purple-400 rounded transform rotate-12"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-purple-500 rounded transform -rotate-6"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-purple-500 to-purple-700 rounded-lg shadow-xl transform -rotate-3">
                        <div class="h-4 bg-purple-700 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">WEB</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-purple-900 font-bold text-lg mb-1 line-clamp-2">Pemrograman Web</h3>
                    <p class="text-purple-600 text-sm mb-3">KOM123 • Prof. Budi Santoso</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            AKTIF
                        </span>
                        <span class="text-purple-700 text-sm font-semibold">2 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=1" class="block w-full text-center bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Kelas Card 2 - Basis Data -->
            <div class="group bg-gradient-to-br from-pink-100 via-pink-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-pink-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-pink-200 to-pink-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-pink-400 rounded transform rotate-6"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-pink-500 rounded transform -rotate-12"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-pink-500 to-pink-700 rounded-lg shadow-xl transform rotate-6">
                        <div class="h-4 bg-pink-700 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">DB</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-pink-900 font-bold text-lg mb-1 line-clamp-2">Basis Data</h3>
                    <p class="text-pink-600 text-sm mb-3">KOM201 • Dr. Siti Nurhaliza</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            AKTIF
                        </span>
                        <span class="text-pink-700 text-sm font-semibold">0 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=2" class="block w-full text-center bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Kelas Card 3 - Struktur Data -->
            <div class="group bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-blue-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-blue-200 to-blue-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-blue-400 rounded transform -rotate-6"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-blue-500 rounded transform rotate-12"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg shadow-xl transform -rotate-6">
                        <div class="h-4 bg-blue-700 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">DATA</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-blue-900 font-bold text-lg mb-1 line-clamp-2">Struktur Data</h3>
                    <p class="text-blue-600 text-sm mb-3">KOM202 • Dr. Ahmad Wijaya</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            AKTIF
                        </span>
                        <span class="text-blue-700 text-sm font-semibold">1 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=3" class="block w-full text-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Kelas Card 4 - Jaringan Komputer -->
            <div class="group bg-gradient-to-br from-green-100 via-green-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-green-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-green-200 to-green-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-green-400 rounded transform -rotate-12"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-green-500 rounded transform rotate-6"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-green-500 to-green-700 rounded-lg shadow-xl transform -rotate-3">
                        <div class="h-4 bg-green-700 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">NET</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-green-900 font-bold text-lg mb-1 line-clamp-2">Jaringan Komputer</h3>
                    <p class="text-green-600 text-sm mb-3">KOM301 • Prof. Joko Susilo</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            AKTIF
                        </span>
                        <span class="text-green-700 text-sm font-semibold">0 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=4" class="block w-full text-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Kelas Card 5 - Sistem Operasi -->
            <div class="group bg-gradient-to-br from-indigo-100 via-indigo-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-indigo-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-indigo-200 to-indigo-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-indigo-400 rounded transform rotate-6"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-indigo-500 rounded transform -rotate-3"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-lg shadow-xl transform rotate-6">
                        <div class="h-4 bg-indigo-700 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">OS</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-indigo-900 font-bold text-lg mb-1 line-clamp-2">Sistem Operasi</h3>
                    <p class="text-indigo-600 text-sm mb-3">KOM302 • Dr. Rina Kusuma</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            AKTIF
                        </span>
                        <span class="text-indigo-700 text-sm font-semibold">0 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=5" class="block w-full text-center bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Kelas Card 6 - Matematika Diskrit -->
            <div class="group bg-gradient-to-br from-orange-100 via-orange-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-orange-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-orange-200 to-orange-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-orange-400 rounded transform -rotate-6"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-orange-500 rounded transform rotate-12"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-orange-500 to-orange-700 rounded-lg shadow-xl transform -rotate-6">
                        <div class="h-4 bg-orange-700 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">MATH</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-orange-900 font-bold text-lg mb-1 line-clamp-2">Matematika Diskrit</h3>
                    <p class="text-orange-600 text-sm mb-3">MTK201 • Prof. Hadi Wijaya</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                            SELESAI
                        </span>
                        <span class="text-orange-700 text-sm font-semibold">0 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=6" class="block w-full text-center bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Kelas Card 7 - Keamanan Informasi -->
            <div class="group bg-gradient-to-br from-teal-100 via-teal-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-teal-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-teal-200 to-teal-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-teal-400 rounded transform rotate-3"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-teal-500 rounded transform -rotate-12"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-teal-500 to-teal-700 rounded-lg shadow-xl transform rotate-3">
                        <div class="h-4 bg-teal-700 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">SEC</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-teal-900 font-bold text-lg mb-1 line-clamp-2">Keamanan Informasi</h3>
                    <p class="text-teal-600 text-sm mb-3">KOM401 • Dr. Lisa Hartono</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                            SELESAI
                        </span>
                        <span class="text-teal-700 text-sm font-semibold">0 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=7" class="block w-full text-center bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Kelas Card 8 - Machine Learning -->
            <div class="group bg-gradient-to-br from-yellow-100 via-amber-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-yellow-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-yellow-200 to-amber-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-yellow-400 rounded transform rotate-12"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-amber-500 rounded transform -rotate-6"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-yellow-600 to-amber-700 rounded-lg shadow-xl transform rotate-12">
                        <div class="h-4 bg-amber-700 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">ML</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-yellow-900 font-bold text-lg mb-1 line-clamp-2">Machine Learning</h3>
                    <p class="text-yellow-600 text-sm mb-3">KOM501 • Dr. Andi Prabowo</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                            SELESAI
                        </span>
                        <span class="text-yellow-700 text-sm font-semibold">0 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=8" class="block w-full text-center bg-gradient-to-r from-yellow-600 to-amber-700 hover:from-yellow-700 hover:to-amber-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Kelas Card 9 - Cloud Computing -->
            <div class="group bg-gradient-to-br from-cyan-100 via-cyan-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-cyan-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-cyan-200 to-cyan-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-cyan-400 rounded transform -rotate-6"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-cyan-500 rounded transform rotate-12"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-cyan-600 to-cyan-800 rounded-lg shadow-xl transform -rotate-6">
                        <div class="h-4 bg-cyan-800 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">CLOUD</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-cyan-900 font-bold text-lg mb-1 line-clamp-2">Cloud Computing</h3>
                    <p class="text-cyan-600 text-sm mb-3">KOM502 • Prof. Maya Sari</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                            SELESAI
                        </span>
                        <span class="text-cyan-700 text-sm font-semibold">0 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=9" class="block w-full text-center bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Kelas Card 10 - Mobile Programming -->
            <div class="group bg-gradient-to-br from-lime-100 via-lime-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-lime-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-lime-200 to-lime-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-lime-400 rounded transform rotate-6"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-lime-500 rounded transform -rotate-12"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-lime-600 to-lime-800 rounded-lg shadow-xl transform rotate-6">
                        <div class="h-4 bg-lime-800 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">MOBI</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-lime-900 font-bold text-lg mb-1 line-clamp-2">Mobile Programming</h3>
                    <p class="text-lime-600 text-sm mb-3">KOM402 • Dr. Rudi Hartono</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                            SELESAI
                        </span>
                        <span class="text-lime-700 text-sm font-semibold">0 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=10" class="block w-full text-center bg-gradient-to-r from-lime-600 to-lime-700 hover:from-lime-700 hover:to-lime-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Kelas Card 11 - Data Mining -->
            <div class="group bg-gradient-to-br from-rose-100 via-rose-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-rose-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-rose-200 to-rose-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-rose-400 rounded transform -rotate-12"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-rose-500 rounded transform rotate-6"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-rose-600 to-rose-800 rounded-lg shadow-xl transform -rotate-12">
                        <div class="h-4 bg-rose-800 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">DATA</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-rose-900 font-bold text-lg mb-1 line-clamp-2">Data Mining</h3>
                    <p class="text-rose-600 text-sm mb-3">KOM503 • Prof. Nina Putri</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                            SELESAI
                        </span>
                        <span class="text-rose-700 text-sm font-semibold">0 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=11" class="block w-full text-center bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-700 hover:to-rose-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Kelas Card 12 - Kecerdasan Buatan -->
            <div class="group bg-gradient-to-br from-violet-100 via-violet-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-violet-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-violet-200 to-violet-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-violet-400 rounded transform rotate-3"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-violet-500 rounded transform -rotate-6"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-gradient-to-br from-violet-600 to-violet-800 rounded-lg shadow-xl transform rotate-3">
                        <div class="h-4 bg-violet-800 rounded-t-lg"></div>
                        <div class="p-2 text-white text-xs font-bold">AI</div>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="text-violet-900 font-bold text-lg mb-1 line-clamp-2">Kecerdasan Buatan</h3>
                    <p class="text-violet-600 text-sm mb-3">KOM504 • Dr. Faisal Akbar</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                            SELESAI
                        </span>
                        <span class="text-violet-700 text-sm font-semibold">0 Tugas</span>
                    </div>
                    <a href="detail-kelas-mahasiswa.php?id=12" class="block w-full text-center bg-gradient-to-r from-violet-600 to-violet-700 hover:from-violet-700 hover:to-violet-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>
            
        </div>

        <!-- Deadline Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-pink-100 mb-8">
            <h3 class="text-xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent mb-4">📅 Deadline Terdekat</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">Tugas 1: Website E-Commerce</p>
                        <p class="text-sm text-gray-600">Pemrograman Web • TI2021A</p>
                    </div>
                    <div class="text-right">
                        <p class="text-red-600 font-bold text-sm">Besok, 23:59</p>
                        <p class="text-xs text-red-500">⏰ 1 hari lagi</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-4 bg-orange-50 border-l-4 border-orange-500 rounded-lg">
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">Quiz: SQL Advanced</p>
                        <p class="text-sm text-gray-600">Basis Data • TI2021A</p>
                    </div>
                    <div class="text-right">
                        <p class="text-orange-600 font-bold text-sm">12 Des, 14:00</p>
                        <p class="text-xs text-orange-500">⏰ 3 hari lagi</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg">
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">Project: Implementasi Binary Tree</p>
                        <p class="text-sm text-gray-600">Algoritma & Struktur Data • TI2021A</p>
                    </div>
                    <div class="text-right">
                        <p class="text-yellow-600 font-bold text-sm">15 Des, 23:59</p>
                        <p class="text-xs text-yellow-600">⏰ 6 hari lagi</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Join Kelas -->
    <div id="modalJoinKelas" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md animate-fade-in">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-pink-500 via-purple-500 to-purple-600 px-6 py-4 flex items-center justify-between rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
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

            <!-- Modal Body -->
            <div class="p-6">
                <form id="formJoinKelas" onsubmit="return previewKelas(event)">
                    <!-- Input Kode Kelas -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Kelas (6 Karakter)</label>
                        <input 
                            type="text" 
                            id="kodeKelas" 
                            maxlength="6" 
                            required 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all text-center text-2xl font-bold uppercase tracking-widest" 
                            placeholder="ABC123"
                            oninput="this.value = this.value.toUpperCase()"
                        >
                        <p class="text-xs text-gray-500 mt-2 text-center">Masukkan kode 6 karakter dari dosen</p>
                    </div>

                    <!-- Preview Kelas Area (Hidden by default) -->
                    <div id="previewKelasArea" class="hidden mb-6">
                        <div class="bg-gradient-to-r from-pink-50 to-purple-50 border-2 border-pink-200 rounded-xl p-4">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 id="previewNamaMK" class="font-bold text-gray-800 text-lg">-</h4>
                                    <p id="previewDosen" class="text-sm text-gray-600">-</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 text-sm">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span id="previewSemester">-</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <span id="previewKapasitas">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-pink-50 border-l-4 border-pink-500 p-4 rounded-r-lg mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-pink-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-pink-800 mb-1">Cara Join Kelas</p>
                                <ul class="text-xs text-pink-700 space-y-1">
                                    <li>• Dapatkan kode kelas 6 karakter dari dosen</li>
                                    <li>• Masukkan kode dan klik "Cek Kelas"</li>
                                    <li>• Verifikasi info kelas sebelum join</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button type="button" onclick="closeJoinKelasModal()" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" id="btnCekKelas" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cek Kelas
                        </button>
                        <button type="button" id="btnJoinKelas" onclick="joinKelas()" class="hidden flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Gabung
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
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
        // Modal Controls
        function openJoinKelasModal() {
            document.getElementById('modalJoinKelas').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.getElementById('kodeKelas').focus();
        }

        function closeJoinKelasModal() {
            document.getElementById('modalJoinKelas').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('formJoinKelas').reset();
            document.getElementById('previewKelasArea').classList.add('hidden');
            document.getElementById('btnCekKelas').classList.remove('hidden');
            document.getElementById('btnJoinKelas').classList.add('hidden');
        }

        // Preview Kelas (AJAX simulation)
        function previewKelas(event) {
            event.preventDefault();
            
            const kode = document.getElementById('kodeKelas').value.toUpperCase();
            
            if (kode.length !== 6) {
                alert('Kode kelas harus 6 karakter!');
                return false;
            }

            // Simulate AJAX call to backend
            // backend/kelas/preview-kelas.php?kode=ABC123
            
            // Dummy data for preview
            const kelasData = {
                'ABC123': {
                    nama: 'Pemrograman Web',
                    dosen: 'Prof. Dr. Budi Santoso',
                    semester: 'Semester 5',
                    kapasitas: '32/40 Mahasiswa'
                },
                'DEF456': {
                    nama: 'Basis Data Lanjut',
                    dosen: 'Dr. Siti Nurhaliza',
                    semester: 'Semester 5',
                    kapasitas: '28/35 Mahasiswa'
                },
                'GHI789': {
                    nama: 'Algoritma & Struktur Data',
                    dosen: 'Dr. Ahmad Wijaya',
                    semester: 'Semester 5',
                    kapasitas: '30/40 Mahasiswa'
                }
            };

            if (kelasData[kode]) {
                // Show preview
                const kelas = kelasData[kode];
                document.getElementById('previewNamaMK').textContent = kelas.nama;
                document.getElementById('previewDosen').textContent = kelas.dosen;
                document.getElementById('previewSemester').textContent = kelas.semester;
                document.getElementById('previewKapasitas').textContent = kelas.kapasitas;
                
                document.getElementById('previewKelasArea').classList.remove('hidden');
                document.getElementById('btnCekKelas').classList.add('hidden');
                document.getElementById('btnJoinKelas').classList.remove('hidden');
            } else {
                alert('❌ Kode kelas tidak ditemukan!\n\nPastikan kode yang Anda masukkan benar.');
                document.getElementById('kodeKelas').value = '';
                document.getElementById('kodeKelas').focus();
            }
            
            return false;
        }

        // Join Kelas
        function joinKelas() {
            const kode = document.getElementById('kodeKelas').value;
            
            // Simulate AJAX call to backend
            // backend/kelas/join-kelas.php
            
            showToast(`Berhasil join kelas dengan kode ${kode}!`);
            closeJoinKelasModal();
            
            // Redirect or reload after delay
            setTimeout(() => {
                location.reload();
            }, 1500);
        }

        // Toast Notification
        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }

        // Auto uppercase input
        document.getElementById('kodeKelas').addEventListener('input', function(e) {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
        });

        // Close modal on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeJoinKelasModal();
            }
        });

        // Close modal on backdrop click
        document.getElementById('modalJoinKelas').addEventListener('click', function(e) {
            if (e.target === this) {
                closeJoinKelasModal();
            }
        });
    </script>

</body>
</html>
