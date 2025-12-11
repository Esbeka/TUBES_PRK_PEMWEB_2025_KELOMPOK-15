<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
        .animate-slideIn {
            animation: slideIn 0.4s ease-out;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease-out;
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
                    <a href="dashboard-dosen.php" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">KelasOnline</h1>
                            <p class="text-xs text-gray-600">Detail Kelas</p>
                        </div>
                    </a>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    <button class="relative p-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-xl transition-colors">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-pink-500 rounded-full animate-pulse"></span>
                    </button>

                    <div class="flex items-center gap-3 pl-3 border-l border-pink-200">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">Dr. Budi Santoso</p>
                            <p class="text-xs text-gray-600">Dosen</p>
                        </div>
                        <button class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                            BS
                        </button>
                    </div>

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
        <!-- Back Button -->
        <a href="dashboard-dosen.php" class="inline-flex items-center gap-2 text-gray-700 hover:text-pink-600 font-semibold mb-6 transition-colors">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Dashboard
        </a>

        <!-- Header Card with Class Code -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 mb-6 hover:shadow-2xl transition-all duration-300 animate-fadeIn">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-sm font-bold px-4 py-1.5 rounded-full">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            AKTIF
                        </span>
                        <span class="text-sm text-gray-600">Semester Ganjil 2024/2025</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-gray-900 mb-2">Pemrograman Web</h1>
                    <p class="text-gray-600 mb-4">KOM123 • Kelas A</p>
                    <p class="text-gray-700">Mata kuliah yang membahas fundamental pemrograman web modern meliputi HTML, CSS, JavaScript, dan PHP.</p>
                </div>

                <!-- Kode Kelas Card -->
                <div class="bg-gradient-to-br from-pink-100 to-purple-100 rounded-2xl p-6 border-2 border-pink-300 shadow-xl hover:shadow-2xl transition-all duration-300">
                    <p class="text-sm font-semibold text-gray-700 mb-2">🔑 Kode Kelas</p>
                    <div class="flex items-center gap-3">
                        <div class="bg-white px-6 py-3 rounded-xl shadow-inner">
                            <p id="kodeKelas" class="text-3xl font-black bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent tracking-wider">ABC123</p>
                        </div>
                        <button onclick="copyKodeKelas()" class="p-3 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">Bagikan kode ini ke mahasiswa</p>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 pt-6 border-t border-gray-200">
                <div class="text-center">
                    <p class="text-3xl font-black text-gray-900">32</p>
                    <p class="text-sm text-gray-600">Mahasiswa</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black text-gray-900">40</p>
                    <p class="text-sm text-gray-600">Kapasitas</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black text-gray-900">12</p>
                    <p class="text-sm text-gray-600">Materi</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black text-gray-900">8</p>
                    <p class="text-sm text-gray-600">Tugas</p>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="bg-white rounded-2xl shadow-xl p-2 mb-6 animate-fadeIn">
            <div class="flex flex-wrap gap-2">
                <button onclick="switchTab('info')" class="tab-btn active flex-1 min-w-[120px] px-6 py-3 rounded-xl font-bold transition-all duration-300" data-tab="info">
                    <svg class="w-5 h-5 inline-block mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    Info Kelas
                </button>
                <button onclick="switchTab('mahasiswa')" class="tab-btn flex-1 min-w-[120px] px-6 py-3 rounded-xl font-bold transition-all duration-300" data-tab="mahasiswa">
                    <svg class="w-5 h-5 inline-block mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Mahasiswa
                </button>
                <button onclick="switchTab('materi')" class="tab-btn flex-1 min-w-[120px] px-6 py-3 rounded-xl font-bold transition-all duration-300" data-tab="materi">
                    <svg class="w-5 h-5 inline-block mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                    Materi
                </button>
                <button onclick="switchTab('tugas')" class="tab-btn flex-1 min-w-[120px] px-6 py-3 rounded-xl font-bold transition-all duration-300" data-tab="tugas">
                    <svg class="w-5 h-5 inline-block mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <path d="M14 2v6h6"></path>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <line x1="10" y1="9" x2="8" y2="9"></line>
                    </svg>
                    Tugas
                </button>
            </div>
        </div>

        <!-- Tab Contents -->
        
        <!-- Tab: Info Kelas -->
        <div id="info-tab" class="tab-content active">
            <div class="bg-white rounded-3xl shadow-2xl p-8 hover:shadow-2xl transition-all duration-300 animate-fadeIn">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Informasi Kelas</h2>
                    <button onclick="openEditKelasModal()" class="inline-flex items-center gap-2 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        Edit Kelas
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border-2 border-purple-200">
                        <p class="text-sm font-semibold text-gray-600 mb-1">Nama Mata Kuliah</p>
                        <p class="text-xl font-bold text-gray-900">Pemrograman Web</p>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl border-2 border-blue-200">
                        <p class="text-sm font-semibold text-gray-600 mb-1">Kode Mata Kuliah</p>
                        <p class="text-xl font-bold text-gray-900">KOM123</p>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-green-50 to-teal-50 rounded-2xl border-2 border-green-200">
                        <p class="text-sm font-semibold text-gray-600 mb-1">Semester</p>
                        <p class="text-xl font-bold text-gray-900">Ganjil 2024/2025</p>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-orange-50 to-yellow-50 rounded-2xl border-2 border-orange-200">
                        <p class="text-sm font-semibold text-gray-600 mb-1">Kapasitas</p>
                        <p class="text-xl font-bold text-gray-900">40 Mahasiswa</p>
                    </div>
                </div>

                <div class="mt-6 p-6 bg-gray-50 rounded-2xl">
                    <p class="text-sm font-semibold text-gray-600 mb-2">Deskripsi</p>
                    <p class="text-gray-700 leading-relaxed">Mata kuliah yang membahas fundamental pemrograman web modern meliputi HTML, CSS, JavaScript, dan PHP. Mahasiswa akan belajar membuat website responsif, interaktif, dan dinamis.</p>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <button onclick="openDeleteKelasModal()" class="inline-flex items-center gap-2 bg-red-100 hover:bg-red-200 text-red-700 font-bold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 6h18"></path>
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                        </svg>
                        Hapus Kelas
                    </button>
                </div>
            </div>
        </div>

        <!-- Tab: Mahasiswa -->
        <div id="mahasiswa-tab" class="tab-content">
            <div class="bg-white rounded-3xl shadow-2xl p-8 hover:shadow-2xl transition-all duration-300 animate-fadeIn">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Daftar Mahasiswa</h2>
                        <p class="text-gray-600">32 dari 40 mahasiswa terdaftar</p>
                    </div>
                    <div class="flex gap-3">
                        <input type="text" placeholder="Cari mahasiswa..." class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-pink-500 focus:ring-4 focus:ring-pink-500/10 outline-none transition-all duration-300">
                        <button class="px-6 py-3 bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                            Export Excel
                        </button>
                    </div>
                </div>

                <!-- Mahasiswa List -->
                <div class="space-y-3">
                    <!-- Mahasiswa Item 1 -->
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl border-2 border-purple-200 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                AW
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Ahmad Wijaya</p>
                                <p class="text-sm text-gray-600">NPM: 2024001</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Bergabung:</p>
                            <p class="font-semibold text-gray-900">01 Sep 2024</p>
                        </div>
                    </div>

                    <!-- Mahasiswa Item 2 -->
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl border-2 border-blue-200 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                SP
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Siti Putri</p>
                                <p class="text-sm text-gray-600">NPM: 2024002</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Bergabung:</p>
                            <p class="font-semibold text-gray-900">01 Sep 2024</p>
                        </div>
                    </div>

                    <!-- Mahasiswa Item 3 -->
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-teal-50 rounded-2xl border-2 border-green-200 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                BK
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Budi Kurniawan</p>
                                <p class="text-sm text-gray-600">NPM: 2024003</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Bergabung:</p>
                            <p class="font-semibold text-gray-900">02 Sep 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Materi -->
        <div id="materi-tab" class="tab-content">
            <div class="bg-white rounded-3xl shadow-2xl p-8 hover:shadow-2xl transition-all duration-300 animate-fadeIn">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Materi Pembelajaran</h2>
                        <p class="text-gray-600">12 materi tersedia</p>
                    </div>
                    <a href="kelola-materi.php" class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Tambah Materi
                    </a>
                </div>

                <!-- Materi List -->
                <div class="space-y-4">
                    <!-- Materi Item 1 -->
                    <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl border-2 border-purple-200 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center text-white font-bold">
                                    1
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg">Pengenalan HTML</h3>
                                    <p class="text-sm text-gray-600">Pertemuan 1 • 5 Sep 2024</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">PDF</span>
                        </div>
                        <p class="text-gray-700 mb-4">Materi dasar HTML meliputi tag, atribut, dan struktur dokumen HTML5.</p>
                        <div class="flex gap-2">
                            <button class="px-4 py-2.5 bg-blue-100 text-blue-700 font-semibold rounded-lg hover:bg-blue-200 transition-all duration-300 transform hover:scale-105">
                                Lihat Materi
                            </button>
                            <button class="px-4 py-2.5 bg-yellow-100 text-yellow-700 font-semibold rounded-lg hover:bg-yellow-200 transition-all duration-300 transform hover:scale-105">
                                Edit
                            </button>
                            <button class="px-4 py-2.5 bg-red-100 text-red-700 font-semibold rounded-lg hover:bg-red-200 transition-all duration-300 transform hover:scale-105">
                                Hapus
                            </button>
                        </div>
                    </div>

                    <!-- Materi Item 2 -->
                    <div class="p-6 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl border-2 border-blue-200 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center text-white font-bold">
                                    2
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg">CSS Fundamental</h3>
                                    <p class="text-sm text-gray-600">Pertemuan 2 • 12 Sep 2024</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">VIDEO</span>
                        </div>
                        <p class="text-gray-700 mb-4">Styling website menggunakan CSS, selector, properties, dan layout.</p>
                        <div class="flex gap-2">
                            <button class="px-4 py-2.5 bg-blue-100 text-blue-700 font-semibold rounded-lg hover:bg-blue-200 transition-all duration-300 transform hover:scale-105">
                                Lihat Video
                            </button>
                            <button class="px-4 py-2.5 bg-yellow-100 text-yellow-700 font-semibold rounded-lg hover:bg-yellow-200 transition-all duration-300 transform hover:scale-105">
                                Edit
                            </button>
                            <button class="px-4 py-2.5 bg-red-100 text-red-700 font-semibold rounded-lg hover:bg-red-200 transition-all duration-300 transform hover:scale-105">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Tugas -->
        <div id="tugas-tab" class="tab-content">
            <div class="bg-white rounded-3xl shadow-2xl p-8 hover:shadow-2xl transition-all duration-300 animate-fadeIn">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Daftar Tugas</h2>
                        <p class="text-gray-600">8 tugas diberikan</p>
                    </div>
                    <a href="kelola-tugas.php" class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Tambah Tugas
                    </a>
                </div>

                <!-- Tugas List -->
                <div class="space-y-4">
                    <!-- Tugas Item 1 -->
                    <div class="p-6 bg-gradient-to-r from-orange-50 to-yellow-50 rounded-2xl border-2 border-orange-200 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Tugas 1: Membuat Landing Page</h3>
                                <p class="text-sm text-gray-600">Deadline: 20 Sep 2024 • 23:59</p>
                            </div>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">12 PENDING</span>
                        </div>
                        <p class="text-gray-700 mb-4">Buat landing page sederhana menggunakan HTML dan CSS dengan tema bebas.</p>
                        <div class="flex gap-2">
                            <button class="px-4 py-2.5 bg-blue-100 text-blue-700 font-semibold rounded-lg hover:bg-blue-200 transition-all duration-300 transform hover:scale-105">
                                Lihat Submission (28/32)
                            </button>
                            <button class="px-4 py-2.5 bg-yellow-100 text-yellow-700 font-semibold rounded-lg hover:bg-yellow-200 transition-all duration-300 transform hover:scale-105">
                                Edit
                            </button>
                            <button class="px-4 py-2.5 bg-red-100 text-red-700 font-semibold rounded-lg hover:bg-red-200 transition-all duration-300 transform hover:scale-105">
                                Hapus
                            </button>
                        </div>
                    </div>

                    <!-- Tugas Item 2 -->
                    <div class="p-6 bg-gradient-to-r from-green-50 to-teal-50 rounded-2xl border-2 border-green-200 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Tugas 2: Responsive Design</h3>
                                <p class="text-sm text-gray-600">Deadline: 27 Sep 2024 • 23:59</p>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">SEMUA SELESAI</span>
                        </div>
                        <p class="text-gray-700 mb-4">Implementasi responsive design menggunakan media queries dan flexbox.</p>
                        <div class="flex gap-2">
                            <button class="px-4 py-2.5 bg-blue-100 text-blue-700 font-semibold rounded-lg hover:bg-blue-200 transition-all duration-300 transform hover:scale-105">
                                Lihat Submission (32/32)
                            </button>
                            <button class="px-4 py-2.5 bg-yellow-100 text-yellow-700 font-semibold rounded-lg hover:bg-yellow-200 transition-all duration-300 transform hover:scale-105">
                                Edit
                            </button>
                            <button class="px-4 py-2.5 bg-red-100 text-red-700 font-semibold rounded-lg hover:bg-red-200 transition-all duration-300 transform hover:scale-105">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-4 right-4 bg-white border-2 border-green-500 rounded-xl shadow-2xl p-4 hidden z-50 max-w-sm">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="flex-1">
                <p class="font-bold text-gray-900" id="toastTitle">Berhasil!</p>
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
        // Tab Switching
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-gradient-to-r', 'from-pink-500', 'to-purple-600', 'text-white', 'shadow-lg');
                btn.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
            });
            
            // Show selected tab
            document.getElementById(tabName + '-tab').classList.add('active');
            
            // Add active class to clicked button
            const activeBtn = document.querySelector(`[data-tab="${tabName}"]`);
            activeBtn.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
            activeBtn.classList.add('active', 'bg-gradient-to-r', 'from-pink-500', 'to-purple-600', 'text-white', 'shadow-lg');
        }

        // Copy Kode Kelas
        function copyKodeKelas() {
            const kodeKelas = document.getElementById('kodeKelas').textContent;
            navigator.clipboard.writeText(kodeKelas).then(() => {
                showToast('Berhasil!', 'Kode kelas "' + kodeKelas + '" berhasil disalin');
            }).catch(err => {
                console.error('Failed to copy: ', err);
                showToast('Gagal!', 'Gagal menyalin kode kelas', 'error');
            });
        }

        // Toast Notification
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            document.getElementById('toastTitle').textContent = title;
            document.getElementById('toastMessage').textContent = message;
            
            if (type === 'error') {
                toast.classList.remove('border-green-500');
                toast.classList.add('border-red-500');
                toast.querySelector('.bg-green-100').classList.remove('bg-green-100');
                toast.querySelector('.bg-green-100').classList.add('bg-red-100');
            }
            
            toast.classList.remove('hidden');
            setTimeout(() => {
                closeToast();
            }, 3000);
        }

        function closeToast() {
            document.getElementById('toast').classList.add('hidden');
        }

        // Initialize first tab as active
        document.addEventListener('DOMContentLoaded', function() {
            const firstBtn = document.querySelector('.tab-btn[data-tab="info"]');
            firstBtn.classList.add('bg-gradient-to-r', 'from-pink-500', 'to-purple-600', 'text-white', 'shadow-lg');
            firstBtn.classList.remove('bg-gray-100', 'text-gray-700');
        });

        // Modal functions (placeholder - implement based on dashboard-dosen.php modals)
        function openEditKelasModal() {
            alert('Edit Kelas Modal - akan terintegrasi dengan modal di dashboard');
        }

        function openDeleteKelasModal() {
            alert('Delete Kelas Modal - akan terintegrasi dengan modal di dashboard');
        }
    </script>
</body>
</html>
