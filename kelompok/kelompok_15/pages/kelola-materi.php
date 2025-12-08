<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Materi - KelasOnline</title>
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
        
        /* Drag & Drop Styles */
        .drag-area {
            border: 2px dashed #3b82f6;
            transition: all 0.3s ease;
        }
        .drag-area.drag-over {
            border-color: #1e40af;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
            transform: scale(1.02);
        }
        
        /* Progress Bar */
        .progress-bar-container {
            height: 4px;
            background: rgba(59, 130, 246, 0.2);
            border-radius: 2px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6 0%, #1e40af 100%);
            transition: width 0.3s ease;
        }
        
        /* File Preview */
        .file-preview {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        .file-preview.show {
            max-height: 200px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md shadow-lg border-b border-blue-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-950 via-blue-800 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-blue-900 to-blue-600 bg-clip-text text-transparent">KelasOnline</h1>
                        <p class="text-xs text-gray-500">Kelola Materi</p>
                    </div>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center gap-4">
                    <button class="p-2 hover:bg-blue-50 rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>
                    
                    <div class="relative">
                        <button class="w-10 h-10 bg-gradient-to-br from-blue-800 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold shadow-lg hover:shadow-xl transition-shadow">
                            D
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
                <div class="flex items-center gap-3">
                    <a href="dashboard-dosen.php" class="p-2 hover:bg-white rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-950 via-blue-800 to-blue-600 bg-clip-text text-transparent">
                        Pemrograman Web 2025
                    </h2>
                </div>
                <button onclick="openTambahMateriModal()" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Materi
                </button>
            </div>
            <p class="text-gray-600 ml-14">Kelola materi pembelajaran untuk kelas Anda</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-in">
            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-blue-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Materi</p>
                        <h3 class="text-3xl font-bold text-blue-600">24</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-purple-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">PDF Files</p>
                        <h3 class="text-3xl font-bold text-purple-600">18</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-red-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Video Links</p>
                        <h3 class="text-3xl font-bold text-red-600">6</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-green-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Pertemuan</p>
                        <h3 class="text-3xl font-bold text-green-600">14</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-blue-100 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="searchMateri" placeholder="Cari materi..." class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <select class="px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    <option value="">Semua Pertemuan</option>
                    <option value="1">Pertemuan 1</option>
                    <option value="2">Pertemuan 2</option>
                    <option value="3">Pertemuan 3</option>
                </select>
                <select class="px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    <option value="">Semua Tipe</option>
                    <option value="pdf">PDF</option>
                    <option value="video">Video</option>
                </select>
            </div>
        </div>

        <!-- Materi List by Pertemuan -->
        <div class="space-y-6">
            
            <!-- Pertemuan 1 -->
            <div class="bg-white rounded-xl shadow-lg border-2 border-blue-100 overflow-hidden animate-fade-in">
                <div class="bg-gradient-to-r from-blue-50 to-white px-6 py-4 border-b-2 border-blue-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-800 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                                1
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Pertemuan 1</h3>
                                <p class="text-sm text-gray-500">3 Materi • 15 Sep 2024</p>
                            </div>
                        </div>
                        <button class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                            Lihat Semua
                        </button>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    <!-- Materi Item 1 - PDF -->
                    <div class="p-6 hover:bg-blue-50/50 transition-colors group">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm group-hover:shadow-md transition-shadow">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Pengenalan HTML & CSS</h4>
                                        <p class="text-sm text-gray-600 mb-2">Materi dasar HTML5 dan CSS3 untuk membangun website modern</p>
                                        <div class="flex items-center gap-4 text-xs text-gray-500">
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                                PDF • 2.4 MB
                                            </span>
                                            <span>15 Sep 2024, 10:30</span>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full shadow-md">PDF</span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="editMateri(1)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteMateri(1)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Materi Item 2 - Video -->
                    <div class="p-6 hover:bg-blue-50/50 transition-colors group">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm group-hover:shadow-md transition-shadow">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Tutorial CSS Flexbox</h4>
                                        <p class="text-sm text-gray-600 mb-2">Video tutorial lengkap tentang CSS Flexbox untuk layout modern</p>
                                        <div class="flex items-center gap-4 text-xs text-gray-500">
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                                </svg>
                                                YouTube • 15:30
                                            </span>
                                            <span>15 Sep 2024, 11:00</span>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-blue-700 text-white text-xs font-bold rounded-full shadow-md">VIDEO</span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="editMateri(2)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteMateri(2)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Materi Item 3 - PDF -->
                    <div class="p-6 hover:bg-blue-50/50 transition-colors group">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm group-hover:shadow-md transition-shadow">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Latihan Soal HTML/CSS</h4>
                                        <p class="text-sm text-gray-600 mb-2">Kumpulan latihan soal dan jawaban untuk praktik</p>
                                        <div class="flex items-center gap-4 text-xs text-gray-500">
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                                PDF • 1.8 MB
                                            </span>
                                            <span>16 Sep 2024, 09:00</span>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full shadow-md">PDF</span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="editMateri(3)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteMateri(3)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pertemuan 2 -->
            <div class="bg-white rounded-xl shadow-lg border-2 border-blue-100 overflow-hidden animate-fade-in" style="animation-delay: 0.1s;">
                <div class="bg-gradient-to-r from-blue-50 to-white px-6 py-4 border-b-2 border-blue-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-800 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                                2
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Pertemuan 2</h3>
                                <p class="text-sm text-gray-500">2 Materi • 22 Sep 2024</p>
                            </div>
                        </div>
                        <button class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                            Lihat Semua
                        </button>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    <!-- Materi Item 4 -->
                    <div class="p-6 hover:bg-blue-50/50 transition-colors group">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm group-hover:shadow-md transition-shadow">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800 mb-1">JavaScript Fundamental</h4>
                                        <p class="text-sm text-gray-600 mb-2">Dasar-dasar JavaScript: variabel, function, DOM manipulation</p>
                                        <div class="flex items-center gap-4 text-xs text-gray-500">
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                                PDF • 3.1 MB
                                            </span>
                                            <span>22 Sep 2024, 10:30</span>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full shadow-md">PDF</span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="editMateri(4)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteMateri(4)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Modal Tambah Materi -->
    <div id="modalTambahMateri" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto animate-fade-in">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-blue-950 via-blue-800 to-blue-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Tambah Materi Baru</h3>
                </div>
                <button onclick="closeTambahMateriModal()" class="text-white/80 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form id="formTambahMateri" class="p-6 space-y-6">
                
                <!-- Judul Materi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Materi</label>
                    <input type="text" id="judulMateri" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Masukkan judul materi">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="deskripsiMateri" rows="3" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all resize-none" placeholder="Deskripsikan materi pembelajaran"></textarea>
                </div>

                <!-- Pertemuan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pertemuan Ke</label>
                    <select id="pertemuanMateri" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                        <option value="">Pilih Pertemuan</option>
                        <option value="1">Pertemuan 1</option>
                        <option value="2">Pertemuan 2</option>
                        <option value="3">Pertemuan 3</option>
                        <option value="4">Pertemuan 4</option>
                        <option value="5">Pertemuan 5</option>
                        <option value="6">Pertemuan 6</option>
                        <option value="7">Pertemuan 7</option>
                        <option value="8">Pertemuan 8</option>
                        <option value="9">Pertemuan 9</option>
                        <option value="10">Pertemuan 10</option>
                        <option value="11">Pertemuan 11</option>
                        <option value="12">Pertemuan 12</option>
                        <option value="13">Pertemuan 13</option>
                        <option value="14">Pertemuan 14</option>
                    </select>
                </div>

                <!-- Tab Tipe Materi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Tipe Materi</label>
                    <div class="flex gap-2 mb-4">
                        <button type="button" onclick="switchTab('pdf')" id="tabPDF" class="flex-1 py-3 px-4 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg shadow-md transition-all">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Upload PDF
                            </div>
                        </button>
                        <button type="button" onclick="switchTab('video')" id="tabVideo" class="flex-1 py-3 px-4 bg-gray-200 text-gray-600 font-semibold rounded-lg transition-all hover:bg-gray-300">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                                Link Video
                            </div>
                        </button>
                    </div>

                    <!-- PDF Upload Area -->
                    <div id="pdfUploadArea" class="space-y-4">
                        <div id="dropZone" class="drag-area border-2 border-dashed border-blue-400 rounded-xl p-8 text-center bg-gradient-to-br from-blue-50 to-white cursor-pointer hover:border-blue-600 transition-all">
                            <input type="file" id="fileInput" accept=".pdf" class="hidden">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-700 font-semibold mb-1">Drag & drop file PDF di sini</p>
                                    <p class="text-sm text-gray-500">atau <span class="text-blue-600 font-semibold">klik untuk browse</span></p>
                                </div>
                                <p class="text-xs text-gray-400">Max 10MB • PDF only</p>
                            </div>
                        </div>

                        <!-- File Preview -->
                        <div id="filePreview" class="file-preview bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p id="fileName" class="text-sm font-semibold text-gray-800"></p>
                                        <p id="fileSize" class="text-xs text-gray-500"></p>
                                    </div>
                                </div>
                                <button type="button" onclick="removeFile()" class="text-red-600 hover:bg-red-100 p-2 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Progress Bar -->
                            <div class="progress-bar-container mt-3">
                                <div id="progressBar" class="progress-bar" style="width: 0%"></div>
                            </div>
                            <p id="progressText" class="text-xs text-blue-600 mt-1"></p>
                        </div>
                    </div>

                    <!-- Video Link Area -->
                    <div id="videoLinkArea" class="hidden space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Link Video (YouTube/Google Drive)</label>
                            <input type="url" id="videoLink" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="https://youtube.com/watch?v=...">
                            <p class="text-xs text-gray-500 mt-2">Paste link video dari YouTube atau Google Drive</p>
                        </div>
                        
                        <!-- Video Preview -->
                        <div id="videoPreview" class="hidden bg-gray-900 rounded-lg aspect-video flex items-center justify-center">
                            <svg class="w-12 h-12 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Alert Info -->
                <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded-r-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-blue-800 mb-1">Tips Upload Materi</p>
                            <ul class="text-xs text-blue-700 space-y-1">
                                <li>• PDF max 10MB untuk performa optimal</li>
                                <li>• Video gunakan YouTube/Google Drive untuk hemat storage</li>
                                <li>• Pastikan judul & deskripsi jelas untuk mahasiswa</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4 border-t-2 border-gray-100">
                    <button type="button" onclick="closeTambahMateriModal()" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Materi
                    </button>
                </div>
            </form>
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

    <script src="../assets/js/file-upload-handler.js"></script>
    <script>
        // Modal Controls
        function openTambahMateriModal() {
            document.getElementById('modalTambahMateri').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeTambahMateriModal() {
            document.getElementById('modalTambahMateri').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('formTambahMateri').reset();
            removeFile();
        }

        // Tab Switching
        function switchTab(type) {
            const tabPDF = document.getElementById('tabPDF');
            const tabVideo = document.getElementById('tabVideo');
            const pdfArea = document.getElementById('pdfUploadArea');
            const videoArea = document.getElementById('videoLinkArea');

            if (type === 'pdf') {
                tabPDF.className = 'flex-1 py-3 px-4 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg shadow-md transition-all';
                tabVideo.className = 'flex-1 py-3 px-4 bg-gray-200 text-gray-600 font-semibold rounded-lg transition-all hover:bg-gray-300';
                pdfArea.classList.remove('hidden');
                videoArea.classList.add('hidden');
            } else {
                tabVideo.className = 'flex-1 py-3 px-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg shadow-md transition-all';
                tabPDF.className = 'flex-1 py-3 px-4 bg-gray-200 text-gray-600 font-semibold rounded-lg transition-all hover:bg-gray-300';
                videoArea.classList.remove('hidden');
                pdfArea.classList.add('hidden');
            }
        }

        // File Remove
        function removeFile() {
            document.getElementById('fileInput').value = '';
            document.getElementById('filePreview').classList.remove('show');
            document.getElementById('progressBar').style.width = '0%';
            document.getElementById('progressText').textContent = '';
        }

        // Form Submit
        document.getElementById('formTambahMateri').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulate upload
            showToast('Materi berhasil ditambahkan!');
            closeTambahMateriModal();
        });

        // Toast
        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }

        // Edit Materi
        function editMateri(id) {
            alert('Edit materi ID: ' + id);
        }

        // Delete Materi
        function deleteMateri(id) {
            if (confirm('Yakin ingin menghapus materi ini?')) {
                showToast('Materi berhasil dihapus!');
            }
        }

        // Close modal on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeTambahMateriModal();
            }
        });

        // Close modal on backdrop click
        document.getElementById('modalTambahMateri').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTambahMateriModal();
            }
        });
    </script>

</body>
</html>
