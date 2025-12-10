<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tugas - KelasOnline</title>
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
        .animate-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        
        /* Countdown Animation */
        .countdown-urgent {
            animation: pulse 1.5s ease-in-out infinite;
        }
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-blue-900 to-blue-600 bg-clip-text text-transparent">KelasOnline</h1>
                        <p class="text-xs text-gray-500">Kelola Tugas</p>
                    </div>
                </div>

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
                <button onclick="openCreateTugasModal()" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Buat Tugas
                </button>
            </div>
            <p class="text-gray-600 ml-14">Kelola tugas dan deadline untuk mahasiswa</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-in">
            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-blue-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Tugas</p>
                        <h3 class="text-3xl font-bold text-blue-600">12</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-green-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Aktif</p>
                        <h3 class="text-3xl font-bold text-green-600">8</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-red-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Expired</p>
                        <h3 class="text-3xl font-bold text-red-600">4</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-yellow-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Pending Review</p>
                        <h3 class="text-3xl font-bold text-yellow-600">23</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                        <input type="text" id="searchTugas" placeholder="Cari tugas..." class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <select class="px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    <option value="">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="expired">Expired</option>
                </select>
                <select class="px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    <option value="">Urutkan</option>
                    <option value="deadline_asc">Deadline Terdekat</option>
                    <option value="deadline_desc">Deadline Terjauh</option>
                    <option value="submission">Submission Terbanyak</option>
                </select>
            </div>
        </div>

        <!-- Tugas List -->
        <div class="space-y-6">
            
            <!-- Tugas Card 1 - Active (Urgent) -->
            <div class="bg-white rounded-xl shadow-lg border-2 border-red-200 overflow-hidden animate-fade-in">
                <div class="bg-gradient-to-r from-red-50 to-white px-6 py-4 border-b-2 border-red-100">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-xl font-bold text-gray-800">Tugas 1: Project Website E-Commerce</h3>
                                <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full shadow-md animate-pulse">URGENT</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Buat website e-commerce dengan fitur keranjang belanja menggunakan HTML, CSS, JavaScript, dan PHP native.</p>
                            
                            <!-- Countdown Timer -->
                            <div class="flex items-center gap-6 text-sm">
                                <div class="flex items-center gap-2 text-red-600 font-semibold countdown-urgent">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span id="countdown1">2 Jam 15 Menit</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Deadline: 6 Des 2024, 23:59
                                </div>
                                <div class="flex items-center gap-2 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Max 50MB • PDF/ZIP
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 ml-4">
                            <button onclick="viewSubmissions(1)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Submission">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="editTugas(1)" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="deleteTugas(1)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-4">
                        <div class="flex items-center justify-between text-sm mb-2">
                            <span class="text-gray-600 font-medium">Progress Submission</span>
                            <span class="text-blue-600 font-bold">28 / 45 Mahasiswa (62%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-600 to-blue-400 h-3 rounded-full transition-all duration-500" style="width: 62%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tugas Card 2 - Active -->
            <div class="bg-white rounded-xl shadow-lg border-2 border-blue-100 overflow-hidden animate-fade-in" style="animation-delay: 0.1s;">
                <div class="bg-gradient-to-r from-blue-50 to-white px-6 py-4 border-b-2 border-blue-100">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-xl font-bold text-gray-800">Tugas 2: Analisis UX/UI Website</h3>
                                <span class="px-3 py-1 bg-green-600 text-white text-xs font-bold rounded-full shadow-md">AKTIF</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Analisis 3 website e-commerce populer dari segi user experience dan user interface. Buat laporan dalam format PDF.</p>
                            
                            <div class="flex items-center gap-6 text-sm">
                                <div class="flex items-center gap-2 text-green-600 font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span id="countdown2">5 Hari 12 Jam</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Deadline: 12 Des 2024, 23:59
                                </div>
                                <div class="flex items-center gap-2 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Max 10MB • PDF
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 ml-4">
                            <button onclick="viewSubmissions(2)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Submission">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="editTugas(2)" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="deleteTugas(2)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="flex items-center justify-between text-sm mb-2">
                            <span class="text-gray-600 font-medium">Progress Submission</span>
                            <span class="text-blue-600 font-bold">35 / 45 Mahasiswa (78%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-600 to-green-400 h-3 rounded-full transition-all duration-500" style="width: 78%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tugas Card 3 - Expired -->
            <div class="bg-white rounded-xl shadow-lg border-2 border-gray-200 overflow-hidden animate-fade-in opacity-75" style="animation-delay: 0.2s;">
                <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b-2 border-gray-100">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-xl font-bold text-gray-600">Tugas 3: Quiz JavaScript Fundamental</h3>
                                <span class="px-3 py-1 bg-gray-600 text-white text-xs font-bold rounded-full shadow-md">EXPIRED</span>
                            </div>
                            <p class="text-sm text-gray-500 mb-3">Kerjakan 20 soal pilihan ganda tentang JavaScript fundamental. Submit jawaban dalam format PDF.</p>
                            
                            <div class="flex items-center gap-6 text-sm">
                                <div class="flex items-center gap-2 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="line-through">Expired 3 hari lalu</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Deadline: 3 Des 2024, 23:59
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 ml-4">
                            <button onclick="viewSubmissions(3)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Submission">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="flex items-center justify-between text-sm mb-2">
                            <span class="text-gray-500 font-medium">Progress Submission</span>
                            <span class="text-gray-600 font-bold">42 / 45 Mahasiswa (93%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-gray-600 to-gray-400 h-3 rounded-full transition-all duration-500" style="width: 93%"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Modal Create/Edit Tugas -->
    <div id="modalTugas" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto animate-fade-in">
            <div class="sticky top-0 bg-gradient-to-r from-blue-950 via-blue-800 to-blue-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Buat Tugas Baru</h3>
                </div>
                <button onclick="closeTugasModal()" class="text-white/80 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="formTugas" class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Tugas</label>
                    <input type="text" id="judulTugas" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Masukkan judul tugas">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Tugas</label>
                    <textarea id="deskripsiTugas" rows="4" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all resize-none" placeholder="Jelaskan detail tugas yang harus dikerjakan mahasiswa"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Deadline</label>
                        <input type="date" id="deadlineDate" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Deadline</label>
                        <input type="time" id="deadlineTime" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ukuran File Maksimal</label>
                        <select id="maxFileSize" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="">Pilih ukuran</option>
                            <option value="5">5 MB</option>
                            <option value="10">10 MB</option>
                            <option value="20">20 MB</option>
                            <option value="50">50 MB</option>
                            <option value="100">100 MB</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Format File yang Diizinkan</label>
                        <select id="allowedFormats" multiple required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="pdf" selected>PDF</option>
                            <option value="doc">DOC/DOCX</option>
                            <option value="zip">ZIP/RAR</option>
                            <option value="jpg">JPG/PNG</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Tahan Ctrl untuk pilih multiple</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Bobot Nilai (%)</label>
                    <input type="number" id="bobotNilai" min="1" max="100" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Masukkan bobot nilai (1-100)">
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded-r-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-blue-800 mb-1">Tips Membuat Tugas</p>
                            <ul class="text-xs text-blue-700 space-y-1">
                                <li>• Berikan deskripsi yang jelas dan detail</li>
                                <li>• Set deadline yang realistis untuk mahasiswa</li>
                                <li>• Sesuaikan ukuran file dengan jenis tugas</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 pt-4 border-t-2 border-gray-100">
                    <button type="button" onclick="closeTugasModal()" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Tugas
                    </button>
                </div>
            </form>
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
        // Modal
        function openCreateTugasModal() {
            document.getElementById('modalTugas').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeTugasModal() {
            document.getElementById('modalTugas').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('formTugas').reset();
        }

        function editTugas(id) {
            openCreateTugasModal();
            // Load data tugas untuk edit
        }

        function deleteTugas(id) {
            if (confirm('Yakin ingin menghapus tugas ini? Semua submission akan terhapus!')) {
                showToast('Tugas berhasil dihapus!');
            }
        }

        function viewSubmissions(id) {
            window.location.href = 'lihat-submission.php?id=' + id;
        }

        // Form Submit
        document.getElementById('formTugas').addEventListener('submit', function(e) {
            e.preventDefault();
            showToast('Tugas berhasil dibuat!');
            closeTugasModal();
        });

        // Toast
        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }

        // ESC & Backdrop
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeTugasModal();
        });

        document.getElementById('modalTugas').addEventListener('click', function(e) {
            if (e.target === this) closeTugasModal();
        });

        // Countdown Timer (Real-time)
        function updateCountdowns() {
            // Countdown 1 - Urgent
            const deadline1 = new Date('2024-12-06T23:59:00');
            const now = new Date();
            const diff1 = deadline1 - now;
            
            if (diff1 > 0) {
                const hours = Math.floor(diff1 / (1000 * 60 * 60));
                const minutes = Math.floor((diff1 % (1000 * 60 * 60)) / (1000 * 60));
                document.getElementById('countdown1').textContent = `${hours} Jam ${minutes} Menit`;
            } else {
                document.getElementById('countdown1').textContent = 'EXPIRED';
            }
        }

        // Update every minute
        updateCountdowns();
        setInterval(updateCountdowns, 60000);
    </script>

</body>
</html>
