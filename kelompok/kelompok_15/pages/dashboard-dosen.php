<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen - KelasOnline</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-slideIn {
            animation: slideIn 0.4s ease-out;
        }
        /* Modal backdrop */
        .modal-backdrop {
            backdrop-filter: blur(8px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-200 via-purple-200 to-pink-300 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-lg border-b border-pink-200 sticky top-0 z-40 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Title -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">KelasOnline</h1>
                            <p class="text-xs text-gray-600">Dashboard Dosen</p>
                        </div>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-xl transition-colors">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-pink-500 rounded-full animate-pulse"></span>
                    </button>

                    <!-- User Profile -->
                    <div class="flex items-center gap-3 pl-3 border-l border-pink-200">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">Dr. Budi Santoso</p>
                            <p class="text-xs text-gray-600">Dosen</p>
                        </div>
                        <button class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg hover:shadow-xl transition-shadow">
                            BS
                        </button>
                    </div>

                    <!-- Logout -->
                    <a href="login.html" class="p-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-xl transition-colors">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Hero Banner Section -->
        <div class="mb-8 animate-fadeIn">
            <div class="relative bg-gradient-to-br from-pink-400 via-pink-300 to-purple-400 rounded-3xl overflow-hidden shadow-2xl">
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl"></div>
                    <div class="absolute bottom-10 right-10 w-40 h-40 bg-purple-300 rounded-full blur-3xl"></div>
                </div>
                
                <div class="relative px-8 py-12 flex items-center justify-between">
                    <div class="max-w-xl z-10">
                        <div class="mb-4">
                            <span class="inline-block bg-white/90 text-pink-600 px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                🎓 Selamat Datang Kembali, Dosen!
                            </span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 leading-tight">
                            "Buka Potensi Anda Bersama Kami – Jelajahi, Belajar, dan Berkembang!"
                        </h1>
                        <p class="text-gray-800 text-base mb-6 leading-relaxed">
                            Kelola kelas dengan mudah, pantau perkembangan mahasiswa, dan ciptakan pengalaman belajar yang interaktif dan menarik.
                        </p>
                        <div class="flex gap-3">
                            <button onclick="openCreateModal()" class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M12 5v14M5 12h14"/>
                                </svg>
                                Buat Kelas Baru
                            </button>
                            <button class="inline-flex items-center gap-2 bg-white/90 hover:bg-white text-gray-900 font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                                Lihat Tutorial
                            </button>
                        </div>
                    </div>
                    
                    <!-- Student Illustration -->
                    <div class="hidden lg:block relative">
                        <div class="relative">
                            <!-- Circle Badge for 1000+ Students -->
                            <div class="absolute -top-4 -left-8 bg-white rounded-2xl shadow-xl px-4 py-3 z-10">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600">1000+</p>
                                        <p class="text-xs font-bold text-gray-900">Mahasiswa</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Circle Badge for 100+ Courses -->
                            <div class="absolute bottom-0 -right-4 bg-white rounded-2xl shadow-xl px-4 py-3 z-10">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600">100+</p>
                                        <p class="text-xs font-bold text-gray-900">Kelas Aktif</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Main circular background with student -->
                            <div class="w-72 h-72 bg-gradient-to-br from-purple-300 to-purple-500 rounded-full flex items-center justify-center shadow-2xl">
                                <div class="w-64 h-64 bg-gradient-to-br from-pink-200 to-pink-300 rounded-full flex items-center justify-center">
                                    <!-- Placeholder for student image -->
                                    <div class="w-48 h-56 bg-gradient-to-b from-blue-400 to-blue-600 rounded-t-full relative">
                                        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-32 h-40 bg-white rounded-lg"></div>
                                        <div class="absolute top-4 left-1/2 -translate-x-1/2 w-16 h-16 bg-pink-300 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Kelas -->
            <div class="relative bg-white rounded-3xl shadow-xl p-6 hover:shadow-2xl hover:scale-105 transition-all duration-300 animate-slideIn overflow-hidden">
                <div class="absolute -top-6 -right-6 w-32 h-32 bg-gradient-to-br from-purple-200 to-pink-200 rounded-full opacity-50"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center shadow-xl transform rotate-6">
                            <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 mb-1">8</h3>
                    <p class="text-sm font-bold text-gray-600">Kelas Aktif</p>
                </div>
            </div>

            <!-- Total Mahasiswa -->
            <div class="relative bg-white rounded-3xl shadow-xl p-6 hover:shadow-2xl hover:scale-105 transition-all duration-300 animate-slideIn overflow-hidden" style="animation-delay: 0.1s;">
                <div class="absolute -top-6 -right-6 w-32 h-32 bg-gradient-to-br from-green-200 to-teal-200 rounded-full opacity-50"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center shadow-xl transform -rotate-6">
                            <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 mb-1">245</h3>
                    <p class="text-sm font-bold text-gray-600">Mahasiswa Aktif</p>
                </div>
            </div>

            <!-- Tugas Pending -->
            <div class="relative bg-white rounded-3xl shadow-xl p-6 hover:shadow-2xl hover:scale-105 transition-all duration-300 animate-slideIn overflow-hidden" style="animation-delay: 0.2s;">
                <div class="absolute -top-6 -right-6 w-32 h-32 bg-gradient-to-br from-orange-200 to-yellow-200 rounded-full opacity-50"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center shadow-xl transform rotate-12">
                            <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 6v6l4 2"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 mb-1">12</h3>
                    <p class="text-sm font-bold text-gray-600">Menunggu Review</p>
                </div>
            </div>

            <!-- Materi Upload -->
            <div class="relative bg-white rounded-3xl shadow-xl p-6 hover:shadow-2xl hover:scale-105 transition-all duration-300 animate-slideIn overflow-hidden" style="animation-delay: 0.3s;">
                <div class="absolute -top-6 -right-6 w-32 h-32 bg-gradient-to-br from-pink-200 to-rose-200 rounded-full opacity-50"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl transform -rotate-12">
                            <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <path d="M14 2v6h6"></path>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <line x1="10" y1="9" x2="8" y2="9"></line>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 mb-1">56</h3>
                    <p class="text-sm font-bold text-gray-600">Materi Diunggah</p>
                </div>
            </div>
        </div>

        <!-- Quick Access Menu -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Statistik Kelas Card -->
            <a href="statistik-kelas.php" class="group block bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl shadow-xl p-8 hover:shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden relative">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div class="text-white">
                                <h3 class="text-2xl font-bold mb-1">📊 Statistik Kelas</h3>
                                <p class="text-blue-100 text-sm">Lihat analisis performa mahasiswa</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-white/90">
                            <span class="text-sm font-semibold">Lihat Detail</span>
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Kelola Kelas Card -->
            <a href="#daftar-kelas" class="group block bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl shadow-xl p-8 hover:shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden relative">
            <button onclick="openKelolaMaterModal()" class="group block w-full text-left bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl shadow-xl p-8 hover:shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden relative border-0 cursor-pointer">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="text-white">
                                <h3 class="text-2xl font-bold mb-1">📚 Kelola Kelas</h3>
                                <p class="text-pink-100 text-sm">Kelola materi dan tugas kelas</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-white/90">
                            <span class="text-sm font-semibold">Lihat Kelas</span>
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
            </button>
        </div>

        <!-- Daftar Kelas -->
        <div class="mb-8">
            <!-- Header Section -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Daftar Kelas</h2>
                <p class="text-gray-600 text-sm">Kelola dan akses semua kelas yang Anda ajarkan</p>
            </div>

            <!-- Search & Filter Bar -->
            <div class="flex flex-col sm:flex-row gap-3 mb-6">
                <!-- Search Input -->
                <div class="flex-1 relative">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" placeholder="Cari kelas..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                </div>
                
                <select class="px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Selesai</option>
                </select>
            </div>

            <!-- Kelas Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="kelasGrid">
                <!-- Kelas Card 1 - Pemrograman Web -->
                <div class="group bg-gradient-to-br from-purple-100 via-purple-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-purple-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <!-- Illustration Section -->
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
                    
                    <!-- Content Section -->
                    <div class="p-5 bg-white">
                        <h3 class="text-purple-900 font-bold text-lg mb-1 line-clamp-2">Pemrograman Web</h3>
                        <p class="text-purple-600 text-sm mb-3">KOM123 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-purple-700 text-sm font-semibold">32 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=1" class="flex-1 text-center bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(1)" class="flex-1 text-center bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kelas Card 2 - Struktur Data -->
                <div class="group bg-gradient-to-br from-pink-100 via-pink-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-pink-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-pink-200 to-pink-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute top-2 left-4 w-16 h-20 bg-pink-400 rounded transform rotate-6"></div>
                            <div class="absolute bottom-2 right-4 w-16 h-20 bg-pink-500 rounded transform -rotate-12"></div>
                        </div>
                        <div class="relative w-20 h-24 bg-gradient-to-br from-pink-500 to-pink-700 rounded-lg shadow-xl transform rotate-6">
                            <div class="h-4 bg-pink-700 rounded-t-lg"></div>
                            <div class="p-2 text-white text-xs font-bold">DATA</div>
                        </div>
                    </div>
                    <div class="p-5 bg-white">
                        <h3 class="text-pink-900 font-bold text-lg mb-1 line-clamp-2">Struktur Data</h3>
                        <p class="text-pink-600 text-sm mb-3">KOM202 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-pink-700 text-sm font-semibold">28 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=2" class="flex-1 text-center bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(2)" class="flex-1 text-center bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kelas Card 3 - Basis Data -->
                <div class="group bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-blue-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-blue-200 to-blue-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute top-2 left-4 w-16 h-20 bg-blue-400 rounded transform -rotate-6"></div>
                            <div class="absolute bottom-2 right-4 w-16 h-20 bg-blue-500 rounded transform rotate-12"></div>
                        </div>
                        <div class="relative w-20 h-24 bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg shadow-xl transform -rotate-6">
                            <div class="h-4 bg-blue-700 rounded-t-lg"></div>
                            <div class="p-2 text-white text-xs font-bold">DB</div>
                        </div>
                    </div>
                    <div class="p-5 bg-white">
                        <h3 class="text-blue-900 font-bold text-lg mb-1 line-clamp-2">Basis Data</h3>
                        <p class="text-blue-600 text-sm mb-3">KOM201 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-blue-700 text-sm font-semibold">35 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=3" class="flex-1 text-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(3)" class="flex-1 text-center bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kelas Card 4 - Algoritma -->
                <div class="group bg-gradient-to-br from-yellow-100 via-yellow-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-yellow-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-yellow-200 to-yellow-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute top-2 left-4 w-16 h-20 bg-yellow-400 rounded transform rotate-3"></div>
                            <div class="absolute bottom-2 right-4 w-16 h-20 bg-yellow-500 rounded transform -rotate-6"></div>
                        </div>
                        <div class="relative w-20 h-24 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-lg shadow-xl transform rotate-3">
                            <div class="h-4 bg-yellow-700 rounded-t-lg"></div>
                            <div class="p-2 text-white text-xs font-bold">ALGO</div>
                        </div>
                    </div>
                    <div class="p-5 bg-white">
                        <h3 class="text-yellow-900 font-bold text-lg mb-1 line-clamp-2">Algoritma & Pemrograman</h3>
                        <p class="text-yellow-600 text-sm mb-3">KOM101 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-yellow-700 text-sm font-semibold">30 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=4" class="flex-1 text-center bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(4)" class="flex-1 text-center bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kelas Card 5 - Jaringan Komputer -->
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
                        <p class="text-green-600 text-sm mb-3">KOM301 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-green-700 text-sm font-semibold">26 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=5" class="flex-1 text-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(5)" class="flex-1 text-center bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kelas Card 6 - Sistem Operasi -->
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
                        <p class="text-indigo-600 text-sm mb-3">KOM302 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-indigo-700 text-sm font-semibold">29 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=6" class="flex-1 text-center bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(6)" class="flex-1 text-center bg-gradient-to-r from-violet-600 to-violet-700 hover:from-violet-700 hover:to-violet-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kelas Card 7 - Matematika Diskrit -->
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
                        <p class="text-orange-600 text-sm mb-3">MTK201 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-orange-700 text-sm font-semibold">31 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=7" class="flex-1 text-center bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(7)" class="flex-1 text-center bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kelas Card 8 - Keamanan Informasi -->
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
                        <p class="text-teal-600 text-sm mb-3">KOM401 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-teal-700 text-sm font-semibold">27 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=8" class="flex-1 text-center bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(8)" class="flex-1 text-center bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kelas Card 9 - Machine Learning -->
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
                        <p class="text-yellow-600 text-sm mb-3">KOM501 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-yellow-700 text-sm font-semibold">24 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=9" class="flex-1 text-center bg-gradient-to-r from-yellow-600 to-amber-700 hover:from-yellow-700 hover:to-amber-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(9)" class="flex-1 text-center bg-gradient-to-r from-orange-500 to-yellow-600 hover:from-orange-600 hover:to-yellow-700 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kelas Card 10 - Cloud Computing -->
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
                        <p class="text-cyan-600 text-sm mb-3">KOM502 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-cyan-700 text-sm font-semibold">28 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=10" class="flex-1 text-center bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(10)" class="flex-1 text-center bg-gradient-to-r from-sky-600 to-sky-700 hover:from-sky-700 hover:to-sky-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kelas Card 11 - Mobile Programming -->
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
                        <p class="text-lime-600 text-sm mb-3">KOM402 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-lime-700 text-sm font-semibold">33 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=11" class="flex-1 text-center bg-gradient-to-r from-lime-600 to-lime-700 hover:from-lime-700 hover:to-lime-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(11)" class="flex-1 text-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kelas Card 12 - Data Mining -->
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
                        <p class="text-rose-600 text-sm mb-3">KOM503 • Ganjil 2024/2025</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                AKTIF
                            </span>
                            <span class="text-rose-700 text-sm font-semibold">25 Mhs</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="detail-kelas-dosen.php?id=12" class="flex-1 text-center bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-700 hover:to-rose-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                            </a>
                            <button onclick="goToKelolaMaterI(12)" class="flex-1 text-center bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                                Kelola Materi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal: Create Kelas -->
    <div id="createModal" class="fixed inset-0 bg-black/50 modal-backdrop hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-fadeIn">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Buat Kelas Baru</h3>
                        <p class="text-sm text-gray-600">Isi form untuk membuat kelas</p>
                    </div>
                </div>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-colors">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form id="createKelasForm" class="p-6 space-y-5">
                <!-- Nama Mata Kuliah -->
                <div>
                    <label for="namaMK" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Mata Kuliah <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="namaMK" 
                        name="namaMK" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900 placeholder-gray-400" 
                        placeholder="contoh: Pemrograman Web"
                        required
                    >
                </div>

                <!-- Kode MK -->
                <div>
                    <label for="kodeMK" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kode Mata Kuliah <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="kodeMK" 
                        name="kodeMK" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900 placeholder-gray-400" 
                        placeholder="contoh: KOM123"
                        required
                    >
                </div>

                <!-- Semester & Tahun -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="semester" class="block text-sm font-semibold text-gray-700 mb-2">
                            Semester <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="semester" 
                            name="semester" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900"
                            required
                        >
                            <option value="">Pilih Semester</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div>
                        <label for="tahun" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tahun Ajaran <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="tahun" 
                            name="tahun" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900 placeholder-gray-400" 
                            placeholder="2024/2025"
                            required
                        >
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea 
                        id="deskripsi" 
                        name="deskripsi" 
                        rows="4"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900 placeholder-gray-400 resize-none" 
                        placeholder="Deskripsi singkat tentang mata kuliah..."
                    ></textarea>
                </div>

                <!-- Kapasitas -->
                <div>
                    <label for="kapasitas" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kapasitas Mahasiswa <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="kapasitas" 
                        name="kapasitas" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900 placeholder-gray-400" 
                        placeholder="contoh: 40"
                        min="1"
                        required
                    >
                </div>

                <!-- Alert Container -->
                <div id="createAlertContainer"></div>

                <!-- Modal Footer -->
                <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeCreateModal()" class="flex-1 px-6 py-3 border-2 border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Buat Kelas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Edit Kelas -->
    <div id="editModal" class="fixed inset-0 bg-black/50 modal-backdrop hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-fadeIn">
            <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Edit Kelas</h3>
                        <p class="text-sm text-gray-600">Update informasi kelas</p>
                    </div>
                </div>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-colors">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <form id="editKelasForm" class="p-6 space-y-5">
                <!-- Same fields as create form -->
                <div>
                    <label for="editNamaMK" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Mata Kuliah <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="editNamaMK" 
                        name="namaMK" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900"
                        value="Pemrograman Web"
                        required
                    >
                </div>

                <div>
                    <label for="editKodeMK" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kode Mata Kuliah <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="editKodeMK" 
                        name="kodeMK" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900"
                        value="KOM123"
                        required
                    >
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="editSemester" class="block text-sm font-semibold text-gray-700 mb-2">
                            Semester <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="editSemester" 
                            name="semester" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900"
                            required
                        >
                            <option value="Ganjil" selected>Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div>
                        <label for="editTahun" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tahun Ajaran <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="editTahun" 
                            name="tahun" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900"
                            value="2024/2025"
                            required
                        >
                    </div>
                </div>

                <div>
                    <label for="editDeskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea 
                        id="editDeskripsi" 
                        name="deskripsi" 
                        rows="4"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900 resize-none"
                    >Mata kuliah pemrograman web dengan fokus HTML, CSS, JavaScript, dan PHP</textarea>
                </div>

                <div>
                    <label for="editKapasitas" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kapasitas Mahasiswa <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="editKapasitas" 
                        name="kapasitas" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-gray-900"
                        value="40"
                        min="1"
                        required
                    >
                </div>

                <div id="editAlertContainer"></div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeEditModal()" class="flex-1 px-6 py-3 border-2 border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Delete Confirmation -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 modal-backdrop hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-fadeIn">
            <div class="p-6">
                <!-- Icon -->
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>

                <!-- Content -->
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2">
                    Hapus Kelas?
                </h3>
                <p class="text-gray-600 text-center mb-6">
                    Anda yakin ingin menghapus kelas <strong id="deleteKelasName" class="text-gray-900"></strong>?
                    Semua data materi, tugas, dan submission akan terhapus permanen.
                </p>

                <!-- Actions -->
                <div class="flex items-center gap-3">
                    <button onclick="closeDeleteModal()" class="flex-1 px-6 py-3 border-2 border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button onclick="confirmDelete()" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 6h18"></path>
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                        </svg>
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-4 right-4 bg-white border-2 border-green-500 rounded-lg shadow-2xl p-4 hidden z-50 animate-fadeIn max-w-sm">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="flex-1">
                <h4 class="font-semibold text-gray-900 mb-1" id="toastTitle">Berhasil!</h4>
                <p class="text-sm text-gray-600" id="toastMessage">Kode kelas berhasil disalin</p>
            </div>
            <button onclick="closeToast()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
    </div>

    <script>
        // Global state untuk kelas
        let allKelas = [];
        let currentEditKelasId = null;
        let currentDeleteKelasId = null;

        // Helper function untuk fetch dengan session ID
        async function apiFetch(url, options = {}) {
            const sessionId = localStorage.getItem('sessionId');
            
            // Initialize headers if not provided
            if (!options.headers) {
                options.headers = {};
            }
            
            // Add session ID header jika tersedia
            if (sessionId) {
                options.headers['X-Session-ID'] = sessionId;
            }
            
            // Always include credentials
            options.credentials = 'include';
            
            return fetch(url, options);
        }

        // Load kelas dari backend saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            loadKelasFromBackend();
        });

        // Load semua kelas dari backend
        async function loadKelasFromBackend() {
            try {
                console.log('📥 Loading kelas...');
                const response = await apiFetch('../backend/kelas/get-kelas-dosen.php');
                const result = await response.json();
                
                console.log('✅ API Response:', result);
                
                if (result.success && result.data) {
                    console.log('📊 Setting allKelas to', result.data.length, 'items');
                    allKelas = result.data;
                    console.log('🎨 Calling renderKelasCards()');
                    renderKelasCards();
                } else {
                    console.error('❌ Error loading kelas:', result.message);
                }
            } catch (error) {
                console.error('❌ Fetch error:', error);
            }
        }

        // Render kelas cards
        function renderKelasCards() {
            console.log('🎨 renderKelasCards called');
            console.log('   allKelas.length:', allKelas.length);
            
            // Target kelasGrid dengan ID yang pasti
            const kelasGrid = document.getElementById('kelasGrid');
            
            if (!kelasGrid) {
                console.error('❌ kelasGrid element not found! Searching for alternatives...');
                const allGrids = document.querySelectorAll('[id*="grid"], [id*="Grid"]');
                console.log('   Found', allGrids.length, 'grid-like elements:', Array.from(allGrids).map(e => e.id));
                return;
            }
            
            console.log('✅ Found kelasGrid element');
            console.log('   Current children:', kelasGrid.children.length);

            // Clear semua cards yang lama
            const oldCards = kelasGrid.querySelectorAll('[data-kelas-id]');
            console.log('   Removing', oldCards.length, 'old cards');
            oldCards.forEach(card => card.remove());

            // Add kelas dari backend
            console.log('   Creating', allKelas.length, 'new cards');
            allKelas.forEach((kelas, index) => {
                try {
                    const colors = getColorForKelas(kelas.id_kelas);
                    const card = createKelasCard(kelas, colors);
                    kelasGrid.appendChild(card);
                    console.log(`   ✅ Card ${index + 1} added: ${kelas.nama_matakuliah}`);
                } catch (err) {
                    console.error(`   ❌ Error creating card ${index + 1}:`, err);
                }
            });
            
            console.log(`✅ Render complete. Grid now has ${kelasGrid.children.length} children`);
        }

        // Create kelas card element
        function createKelasCard(kelas, colors) {
            try {
                const div = document.createElement('div');
                div.className = 'group bg-gradient-to-br from-pink-100 via-pink-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 hover:shadow-2xl hover:scale-105 transition-all duration-300';
                div.style.borderColor = colors.border;
                div.setAttribute('data-kelas-id', kelas.id_kelas);

                const gradientColor = colors.gradient;
                const textColor = colors.text;

                div.innerHTML = `
                <div class="bg-gradient-to-br p-6 flex items-center justify-center h-32 relative overflow-hidden" style="background: linear-gradient(135deg, ${gradientColor} 0%, ${colors.gradientDark} 100%);">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-2 left-4 w-16 h-20 bg-white/20 rounded transform -rotate-12"></div>
                        <div class="absolute bottom-2 right-4 w-16 h-20 bg-white/20 rounded transform rotate-6"></div>
                    </div>
                    <div class="relative w-20 h-24 bg-white/10 rounded-lg shadow-xl transform -rotate-12 flex items-center justify-center">
                        <span class="text-3xl font-bold text-white/80">${kelas.kode_matakuliah.substring(0, 2)}</span>
                    </div>
                </div>
                <div class="p-5 bg-white">
                    <h3 class="font-bold text-lg mb-1 line-clamp-2" style="color: ${textColor};">${kelas.nama_matakuliah}</h3>
                    <p class="text-sm mb-3" style="color: ${colors.textMuted};">${kelas.kode_matakuliah} • ${kelas.semester} ${kelas.tahun_ajaran}</p>
                    
                    <!-- Kode Kelas -->
                    <div class="mb-3 p-3 bg-blue-50 rounded-lg border border-blue-200 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-600 font-semibold">Kode Kelas</p>
                            <p class="text-lg font-bold text-blue-700">${kelas.kode_kelas}</p>
                        </div>
                        <button onclick="copyKodeKelas('${kelas.kode_kelas}')" class="p-2 hover:bg-blue-100 rounded-lg transition-colors" title="Salin kode">
                            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            AKTIF
                        </span>
                        <span style="color: ${textColor};" class="text-sm font-semibold">${kelas.jumlah_mahasiswa} Mhs</span>
                    </div>

                    <div class="flex gap-2">
                        <a href="detail-kelas-dosen.php?id=${kelas.id_kelas}" class="flex-1 text-center text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg" style="background: linear-gradient(135deg, ${gradientColor} 0%, ${colors.gradientDark} 100%);">
                            Lihat Detail
                        </a>
                        <button onclick="openEditModal(${kelas.id_kelas})" class="p-2.5 hover:bg-gray-100 rounded-lg transition-colors" title="Edit">
                            <svg class="w-5 h-5 text-yellow-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                        <button onclick="openDeleteModal(${kelas.id_kelas}, '${kelas.nama_matakuliah.replace(/'/g, "\\'")}')" class="p-2.5 hover:bg-gray-100 rounded-lg transition-colors" title="Hapus">
                            <svg class="w-5 h-5 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
                
                return div;
            } catch (err) {
                console.error('Error in createKelasCard:', err);
                throw err;
            }
        }

        // Get warna untuk kelas
        function getColorForKelas(id) {
            const colors = [
                { border: '#ec4899', gradient: '#ec4899', gradientDark: '#be185d', text: '#831843', textMuted: '#ec4899' },
                { border: '#f59e0b', gradient: '#f59e0b', gradientDark: '#d97706', text: '#b45309', textMuted: '#f59e0b' },
                { border: '#8b5cf6', gradient: '#8b5cf6', gradientDark: '#6d28d9', text: '#4c1d95', textMuted: '#8b5cf6' },
                { border: '#06b6d4', gradient: '#06b6d4', gradientDark: '#0891b2', text: '#164e63', textMuted: '#06b6d4' },
                { border: '#10b981', gradient: '#10b981', gradientDark: '#059669', text: '#065f46', textMuted: '#10b981' },
                { border: '#f43f5e', gradient: '#f43f5e', gradientDark: '#be185d', text: '#831843', textMuted: '#f43f5e' }
            ];
            
            return colors[id % colors.length];
        }

        // Modal Functions
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('createKelasForm').reset();
            document.getElementById('createAlertContainer').innerHTML = '';
        }

        async function openEditModal(kelasId) {
            const kelas = allKelas.find(k => k.id_kelas === kelasId);
            if (!kelas) return;

            currentEditKelasId = kelasId;
            document.getElementById('editNamaMK').value = kelas.nama_matakuliah;
            document.getElementById('editKodeMK').value = kelas.kode_matakuliah;
            document.getElementById('editSemester').value = kelas.semester;
            document.getElementById('editTahun').value = kelas.tahun_ajaran;
            document.getElementById('editDeskripsi').value = kelas.deskripsi || '';
            document.getElementById('editKapasitas').value = kelas.kapasitas;
            document.getElementById('editAlertContainer').innerHTML = '';
            
            document.getElementById('editModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentEditKelasId = null;
        }

        function openDeleteModal(kelasId, namaKelas) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteKelasName').textContent = namaKelas;
            document.body.style.overflow = 'hidden';
            currentDeleteKelasId = kelasId;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentDeleteKelasId = null;
        }

        async function confirmDelete() {
            if (!currentDeleteKelasId) return;

            try {
                const response = await apiFetch('../backend/kelas/delete-kelas.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_kelas: currentDeleteKelasId
                    })
                });

                const result = await response.json();
                
                if (result.success) {
                    closeDeleteModal();
                    showToast('Kelas Dihapus', result.message, 'success');
                    loadKelasFromBackend();
                } else {
                    showToast('Error', result.message, 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Error', 'Gagal menghapus kelas', 'error');
            }
        }

        // Copy Kode Kelas
        function copyKodeKelas(kode) {
            navigator.clipboard.writeText(kode).then(() => {
                showToast('Kode Disalin', `Kode kelas "${kode}" berhasil disalin ke clipboard`, 'success');
            });
        }

        // Toast Notification
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            document.getElementById('toastTitle').textContent = title;
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('hidden');
            
            setTimeout(() => {
                closeToast();
            }, 3000);
        }

        function closeToast() {
            document.getElementById('toast').classList.add('hidden');
        }

        // Form Submit Handler - Create Kelas
        document.getElementById('createKelasForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = {
                nama_matakuliah: document.getElementById('namaMK').value,
                kode_matakuliah: document.getElementById('kodeMK').value,
                semester: document.getElementById('semester').value,
                tahun_ajaran: document.getElementById('tahun').value,
                deskripsi: document.getElementById('deskripsi').value,
                kapasitas: parseInt(document.getElementById('kapasitas').value)
            };

            const alertContainer = document.getElementById('createAlertContainer');
            
            try {
                const response = await apiFetch('../backend/kelas/create-kelas.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();
                
                if (result.success) {
                    alertContainer.innerHTML = `
                        <div class="bg-green-50 border-2 border-green-500 rounded-lg p-4 flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            <div class="flex-1">
                                <strong class="block text-green-900 font-semibold mb-1">Kelas Berhasil Dibuat!</strong>
                                <p class="text-green-700 text-sm">Kode kelas: <strong>${result.data.kode_kelas}</strong></p>
                            </div>
                        </div>
                    `;
                    
                    setTimeout(() => {
                        closeCreateModal();
                        showToast('Kelas Dibuat', 'Kelas baru berhasil ditambahkan', 'success');
                        loadKelasFromBackend();
                    }, 1500);
                } else {
                    alertContainer.innerHTML = `
                        <div class="bg-red-50 border-2 border-red-500 rounded-lg p-4 flex items-start gap-3">
                            <svg class="w-6 h-6 text-red-600 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                            <div class="flex-1">
                                <strong class="block text-red-900 font-semibold mb-1">Error!</strong>
                                <p class="text-red-700 text-sm">${result.message}</p>
                            </div>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error:', error);
                alertContainer.innerHTML = `
                    <div class="bg-red-50 border-2 border-red-500 rounded-lg p-4 flex items-start gap-3">
                        <svg class="w-6 h-6 text-red-600 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        <div class="flex-1">
                            <strong class="block text-red-900 font-semibold mb-1">Error!</strong>
                            <p class="text-red-700 text-sm">Gagal membuat kelas</p>
                        </div>
                    </div>
                `;
            }
        });

        // Form Submit Handler - Edit Kelas
        document.getElementById('editKelasForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = {
                id_kelas: currentEditKelasId,
                nama_matakuliah: document.getElementById('editNamaMK').value,
                kode_matakuliah: document.getElementById('editKodeMK').value,
                semester: document.getElementById('editSemester').value,
                tahun_ajaran: document.getElementById('editTahun').value,
                deskripsi: document.getElementById('editDeskripsi').value,
                kapasitas: parseInt(document.getElementById('editKapasitas').value)
            };

            const alertContainer = document.getElementById('editAlertContainer');
            
            try {
                const response = await apiFetch('../backend/kelas/update-kelas.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();
                
                if (result.success) {
                    alertContainer.innerHTML = `
                        <div class="bg-green-50 border-2 border-green-500 rounded-lg p-4 flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            <div class="flex-1">
                                <strong class="block text-green-900 font-semibold mb-1">Perubahan Disimpan!</strong>
                                <p class="text-green-700 text-sm">Data kelas berhasil diupdate</p>
                            </div>
                        </div>
                    `;
                    
                    setTimeout(() => {
                        closeEditModal();
                        showToast('Kelas Diupdate', 'Perubahan berhasil disimpan', 'success');
                        loadKelasFromBackend();
                    }, 1500);
                } else {
                    alertContainer.innerHTML = `
                        <div class="bg-red-50 border-2 border-red-500 rounded-lg p-4 flex items-start gap-3">
                            <svg class="w-6 h-6 text-red-600 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                            <div class="flex-1">
                                <strong class="block text-red-900 font-semibold mb-1">Error!</strong>
                                <p class="text-red-700 text-sm">${result.message}</p>
                            </div>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error:', error);
                alertContainer.innerHTML = `
                    <div class="bg-red-50 border-2 border-red-500 rounded-lg p-4 flex items-start gap-3">
                        <svg class="w-6 h-6 text-red-600 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        <div class="flex-1">
                            <strong class="block text-red-900 font-semibold mb-1">Error!</strong>
                            <p class="text-red-700 text-sm">Gagal mengupdate kelas</p>
                        </div>
                    </div>
                `;
            }
        });

        // Kelola Materi Modal
        function openKelolaMaterModal() {
            const modal = document.getElementById('kelolaMaterModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            loadKelasToModal();
        }

        function closeKelolaMaterModal() {
            const modal = document.getElementById('kelolaMaterModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function pilihKelasUntukKelola(id_kelas, nama_kelas) {
            window.location.href = `kelola-materi.php?id_kelas=${id_kelas}`;
        }

        async function loadKelasToModal() {
            const kelasList = document.getElementById('kelasList');
            kelasList.innerHTML = '<div class="text-center py-8 text-gray-500"><p class="text-sm">Memuat data kelas...</p></div>';

            try {
                const response = await apiFetch('../backend/kelas/get-kelas-dosen.php', {
                    method: 'GET'
                });

                const result = await response.json();
                
                if (result.success && result.data && result.data.length > 0) {
                    kelasList.innerHTML = result.data.map(kelas => `
                        <button onclick="pilihKelasUntukKelola(${kelas.id_kelas}, '${kelas.nama_matakuliah}')" 
                                class="w-full text-left p-4 bg-gradient-to-r from-purple-50 to-pink-50 hover:from-purple-100 hover:to-pink-100 rounded-xl border-2 border-purple-200 hover:border-pink-400 transition-all duration-200 group">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 group-hover:text-purple-700 transition-colors">${kelas.nama_matakuliah}</h4>
                                    <p class="text-sm text-gray-600 mt-1">${kelas.kode_matakuliah}</p>
                                </div>
                                <div class="text-right ml-3">
                                    <span class="inline-flex items-center gap-1 bg-purple-100 text-purple-700 text-xs font-bold px-2 py-1 rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                        </svg>
                                        ${kelas.jumlah_mahasiswa || 0}
                                    </span>
                                </div>
                            </div>
                        </button>
                    `).join('');
                } else {
                    kelasList.innerHTML = '<div class="text-center py-8 text-gray-500"><p class="text-sm">Anda belum memiliki kelas</p></div>';
                }
            } catch (error) {
                console.error('Error loading kelas:', error);
                kelasList.innerHTML = '<div class="text-center py-8 text-red-500"><p class="text-sm">Error memuat data kelas</p></div>';
            }
        }

        // Close modals on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCreateModal();
                closeEditModal();
                closeDeleteModal();
                closeKelolaMaterModal();
            }
        });

        // Navigate to Kelola Materi page
        function goToKelolaMaterI(idKelas) {
            window.location.href = 'kelola-materi.php?id_kelas=' + idKelas;
        }

        // Scroll to Kelas List section
        function showKelasList() {
            const kelasSection = document.getElementById('kelasGrid');
            if (kelasSection) {
                kelasSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    </script>

    <!-- Kelola Materi Modal -->
    <div id="kelolaMaterModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 animate-fadeIn">
            <!-- Header -->
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4 flex items-center justify-between">
                <h3 class="text-xl font-bold text-white">Pilih Kelas untuk Dikelola</h3>
                <button onclick="closeKelolaMaterModal()" class="text-white hover:bg-white/20 p-2 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="space-y-3 max-h-96 overflow-y-auto" id="kelasList">
                    <!-- Kelas akan di-load dari backend -->
                    <div class="text-center py-8 text-gray-500">
                        <p class="text-sm">Memuat data kelas...</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="border-t px-6 py-4 flex justify-end gap-3">
                <button onclick="closeKelolaMaterModal()" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors font-semibold">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</body>
</html>
