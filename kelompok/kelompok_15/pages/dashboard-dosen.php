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
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Title -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-950 via-blue-800 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-gray-900">KelasOnline</h1>
                            <p class="text-xs text-gray-500">Dashboard Dosen</p>
                        </div>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- User Profile -->
                    <div class="flex items-center gap-3 pl-3 border-l border-gray-200">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">Dr. Budi Santoso</p>
                            <p class="text-xs text-gray-500">NIDN: 0012345678</p>
                        </div>
                        <button class="w-10 h-10 bg-gradient-to-br from-blue-800 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold shadow-lg hover:shadow-xl transition-shadow">
                            BS
                        </button>
                    </div>

                    <!-- Logout -->
                    <a href="login.html" class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
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
        <!-- Header Section -->
        <div class="mb-8 animate-fadeIn">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Dosen</h2>
                    <p class="text-gray-600">Kelola kelas dan pantau progress mahasiswa Anda</p>
                </div>
                <button onclick="openCreateModal()" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Buat Kelas Baru
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Kelas -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow animate-slideIn">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">8</h3>
                <p class="text-sm text-gray-600">Total Kelas</p>
            </div>

            <!-- Total Mahasiswa -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow animate-slideIn" style="animation-delay: 0.1s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">245</h3>
                <p class="text-sm text-gray-600">Total Mahasiswa</p>
            </div>

            <!-- Tugas Pending -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow animate-slideIn" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 6v6l4 2"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">12</h3>
                <p class="text-sm text-gray-600">Tugas Pending Review</p>
            </div>

            <!-- Materi Upload -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow animate-slideIn" style="animation-delay: 0.3s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <path d="M14 2v6h6"></path>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <line x1="10" y1="9" x2="8" y2="9"></line>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">56</h3>
                <p class="text-sm text-gray-600">Materi Terupload</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="export-demo.php" class="group bg-gradient-to-br from-green-50 to-white border-2 border-green-200 rounded-xl p-6 hover:shadow-xl hover:border-green-600 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4 mb-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-lg flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 group-hover:text-green-600 transition-colors">Export Data</h4>
                        <p class="text-xs text-gray-500">Mahasiswa & Nilai</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Export daftar mahasiswa dan rekap nilai dalam format Excel, PDF, atau CSV</p>
            </a>
        </div>

        <!-- Daftar Kelas -->
        <div class="mb-8">
            <!-- Header Section -->
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Daftar Kelas</h2>
                <p class="text-gray-600">Kelola dan akses semua kelas yang Anda ikuti</p>
            </div>

            <!-- Join Kelas Button -->
            <button onclick="openJoinKelasModal()" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg transition-all shadow-md mb-6">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Join Kelas
            </button>

            <!-- Search & Filter Bar -->
            <div class="bg-gray-50 rounded-xl p-4 mb-6">
                <div class="flex flex-col md:flex-row gap-3">
                    <!-- Search Input -->
                    <div class="flex-1 relative">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <input type="text" placeholder="Cari kelas (nama, kode, deskripsi)..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                    </div>
                    
                    <!-- Filters -->
                    <select class="px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                        <option>Semua Semester</option>
                        <option>Ganjil 2024/2025</option>
                        <option>Genap 2023/2024</option>
                    </select>
                    
                    <select class="px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                        <option>Semua Tahun</option>
                        <option>2024/2025</option>
                        <option>2023/2024</option>
                    </select>
                    
                    <select class="px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Selesai</option>
                    </select>
                    
                    <select class="px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                        <option>Nama (A-Z)</option>
                        <option>Nama (Z-A)</option>
                        <option>Terbaru</option>
                        <option>Terlama</option>
                    </select>
                    
                    <button class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">
                        Reset Filter
                    </button>
                </div>
            </div>

            <!-- Results Counter -->
            <div class="mb-6">
                <p class="text-blue-600 font-semibold">Menampilkan <span class="text-gray-900">12 item</span></p>
            </div>

            <!-- Kelas Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5" id="kelasGrid">
                <!-- Kelas Card 1 - Pemrograman Web -->
                <div class="group bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <!-- Card Header with gradient -->
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Pemrograman Web</h3>
                        <p class="text-blue-100 text-sm mb-3">KOM123 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <!-- White footer section -->
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=1" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 2 - Struktur Data -->
                <div class="group bg-gradient-to-br from-purple-600 to-purple-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Struktur Data</h3>
                        <p class="text-purple-100 text-sm mb-3">KOM202 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=2" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 3 - Basis Data -->
                <div class="group bg-gradient-to-br from-green-600 to-green-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Basis Data</h3>
                        <p class="text-green-100 text-sm mb-3">KOM201 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=3" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 4 - Algoritma -->
                <div class="group bg-gradient-to-br from-orange-600 to-orange-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Algoritma dan Pemrograman</h3>
                        <p class="text-orange-100 text-sm mb-3">KOM101 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=4" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 5 - Jaringan Komputer -->
                <div class="group bg-gradient-to-br from-red-600 to-red-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Jaringan Komputer</h3>
                        <p class="text-red-100 text-sm mb-3">KOM301 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=5" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 6 - Sistem Operasi -->
                <div class="group bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Sistem Operasi</h3>
                        <p class="text-indigo-100 text-sm mb-3">KOM302 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=6" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 7 - Matematika Diskrit -->
                <div class="group bg-gradient-to-br from-pink-600 to-pink-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Matematika Diskrit</h3>
                        <p class="text-pink-100 text-sm mb-3">MTK201 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=7" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 8 - Keamanan Informasi -->
                <div class="group bg-gradient-to-br from-teal-600 to-teal-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Keamanan Informasi</h3>
                        <p class="text-teal-100 text-sm mb-3">KOM401 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=8" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 9 - Machine Learning -->
                <div class="group bg-gradient-to-br from-yellow-600 to-yellow-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Machine Learning</h3>
                        <p class="text-yellow-100 text-sm mb-3">KOM501 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=9" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 10 - Cloud Computing -->
                <div class="group bg-gradient-to-br from-cyan-600 to-cyan-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Cloud Computing</h3>
                        <p class="text-cyan-100 text-sm mb-3">KOM502 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=10" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 11 - Mobile Programming -->
                <div class="group bg-gradient-to-br from-lime-600 to-lime-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Mobile Programming</h3>
                        <p class="text-lime-100 text-sm mb-3">KOM402 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=11" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Kelas Card 12 - Data Mining -->
                <div class="group bg-gradient-to-br from-rose-600 to-rose-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="p-5 pb-3">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">Data Mining</h3>
                        <p class="text-rose-100 text-sm mb-3">KOM503 • Ganjil 2024/2025</p>
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded">AKTIF</span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <a href="detail-kelas-dosen.php?id=12" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                            Lihat Detail
                        </a>
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
        // Modal Functions
        function openJoinKelasModal() {
            document.getElementById('createModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('createKelasForm').reset();
        }

        function openEditModal(kodeKelas) {
            document.getElementById('editModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            // TODO: Load data kelas berdasarkan kode
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openDeleteModal(kodeKelas, namaKelas) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteKelasName').textContent = namaKelas;
            document.body.style.overflow = 'hidden';
            // Store kodeKelas for deletion
            window.currentDeleteKode = kodeKelas;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function confirmDelete() {
            // TODO: Send delete request to backend
            console.log('Deleting kelas:', window.currentDeleteKode);
            showToast('Kelas Dihapus', 'Kelas berhasil dihapus dari sistem', 'success');
            closeDeleteModal();
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
        document.getElementById('createKelasForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const alertContainer = document.getElementById('createAlertContainer');
            
            // TODO: Send to backend
            console.log('Creating kelas:', Object.fromEntries(formData));
            
            // Simulate success
            alertContainer.innerHTML = `
                <div class="bg-green-50 border-2 border-green-500 rounded-lg p-4 flex items-start gap-3">
                    <svg class="w-6 h-6 text-green-600 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <div class="flex-1">
                        <strong class="block text-green-900 font-semibold mb-1">Kelas Berhasil Dibuat!</strong>
                        <p class="text-green-700 text-sm">Kode kelas: <strong>ABC123</strong></p>
                    </div>
                </div>
            `;
            
            setTimeout(() => {
                closeCreateModal();
                showToast('Kelas Dibuat', 'Kelas baru berhasil ditambahkan', 'success');
                // TODO: Refresh kelas list
            }, 1500);
        });

        // Form Submit Handler - Edit Kelas
        document.getElementById('editKelasForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const alertContainer = document.getElementById('editAlertContainer');
            
            // TODO: Send to backend
            console.log('Updating kelas:', Object.fromEntries(formData));
            
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
                // TODO: Refresh kelas list
            }, 1500);
        });

        // Close modals on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCreateModal();
                closeEditModal();
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>
