<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Tugas - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/export-system.js" defer></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        .animate-slide-in { animation: slideIn 0.6s ease-out; }
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
                        <p class="text-xs text-gray-500">Lihat Submission</p>
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
            <div class="flex items-center gap-3 mb-2">
                <a href="kelola-tugas.php" class="p-2 hover:bg-white rounded-lg transition-colors">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-950 via-blue-800 to-blue-600 bg-clip-text text-transparent">
                        Tugas 1: Project Website E-Commerce
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Deadline: 6 Des 2024, 23:59 • Max 50MB • PDF/ZIP</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8 animate-slide-in">
            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-blue-100 hover:shadow-xl transition-shadow">
                <div class="text-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center mx-auto mb-2 shadow-sm">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-xs font-medium mb-1">Total Mahasiswa</p>
                    <h3 class="text-2xl font-bold text-blue-600">45</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-green-100 hover:shadow-xl transition-shadow">
                <div class="text-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center mx-auto mb-2 shadow-sm">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-xs font-medium mb-1">Sudah Submit</p>
                    <h3 class="text-2xl font-bold text-green-600">28</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-yellow-100 hover:shadow-xl transition-shadow">
                <div class="text-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-lg flex items-center justify-center mx-auto mb-2 shadow-sm">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-xs font-medium mb-1">Belum Submit</p>
                    <h3 class="text-2xl font-bold text-yellow-600">17</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-blue-100 hover:shadow-xl transition-shadow">
                <div class="text-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center mx-auto mb-2 shadow-sm">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-xs font-medium mb-1">Sudah Dinilai</p>
                    <h3 class="text-2xl font-bold text-blue-600">15</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-red-100 hover:shadow-xl transition-shadow">
                <div class="text-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center mx-auto mb-2 shadow-sm">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-xs font-medium mb-1">Terlambat</p>
                    <h3 class="text-2xl font-bold text-red-600">5</h3>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-blue-100 mb-8">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-gray-800">Progress Submission</h3>
                <span class="text-blue-600 font-bold text-lg">28 / 45 Mahasiswa (62%)</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-400 h-4 rounded-full transition-all duration-500 flex items-center justify-end pr-2" style="width: 62%">
                    <span class="text-white text-xs font-bold">62%</span>
                </div>
            </div>
        </div>

        <!-- Filter & Actions -->
        <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-blue-100 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="searchSubmission" placeholder="Cari mahasiswa..." class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <select class="px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    <option value="">Semua Status</option>
                    <option value="submitted">Sudah Submit</option>
                    <option value="not_submitted">Belum Submit</option>
                    <option value="graded">Sudah Dinilai</option>
                    <option value="not_graded">Belum Dinilai</option>
                    <option value="late">Terlambat</option>
                </select>
                <button onclick="exportSystem.openModal('submissions')" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export Data
                </button>
            </div>
        </div>

        <!-- Submission Table -->
        <div class="bg-white rounded-xl shadow-lg border-2 border-blue-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-950 via-blue-800 to-blue-600 text-white">
                            <th class="px-6 py-4 text-left text-sm font-bold">No</th>
                            <th class="px-6 py-4 text-left text-sm font-bold">NPM</th>
                            <th class="px-6 py-4 text-left text-sm font-bold">Nama Mahasiswa</th>
                            <th class="px-6 py-4 text-left text-sm font-bold">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-bold">Waktu Submit</th>
                            <th class="px-6 py-4 text-left text-sm font-bold">File</th>
                            <th class="px-6 py-4 text-left text-sm font-bold">Nilai</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        
                        <!-- Row 1 - Submitted & Graded -->
                        <tr class="hover:bg-blue-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-600">1</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">2111081001</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-400 rounded-full flex items-center justify-center text-white font-bold">
                                        A
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Ahmad Fauzi</p>
                                        <p class="text-xs text-gray-500">ahmad.fauzi@student.unila.ac.id</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">ON TIME</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">5 Des 2024<br>14:30</td>
                            <td class="px-6 py-4">
                                <button onclick="downloadFile(1)" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-lg font-bold text-green-600">85</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button onclick="viewDetail(1)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="openNilaiModal(1)" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Edit Nilai">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 - Submitted & Not Graded -->
                        <tr class="hover:bg-blue-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-600">2</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">2111081002</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-400 rounded-full flex items-center justify-center text-white font-bold">
                                        B
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Budi Santoso</p>
                                        <p class="text-xs text-gray-500">budi.santoso@student.unila.ac.id</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">ON TIME</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">6 Des 2024<br>10:15</td>
                            <td class="px-6 py-4">
                                <button onclick="downloadFile(2)" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-yellow-600 font-semibold">Belum Dinilai</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button onclick="viewDetail(2)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="openNilaiModal(2)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Beri Nilai">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 - Late Submission -->
                        <tr class="hover:bg-blue-50/50 transition-colors bg-red-50/30">
                            <td class="px-6 py-4 text-sm text-gray-600">3</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">2111081003</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-400 rounded-full flex items-center justify-center text-white font-bold">
                                        C
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Cindy Maharani</p>
                                        <p class="text-xs text-gray-500">cindy.maharani@student.unila.ac.id</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">LATE</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-red-600 font-semibold">7 Des 2024<br>08:45<br><span class="text-xs">(12 jam terlambat)</span></td>
                            <td class="px-6 py-4">
                                <button onclick="downloadFile(3)" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-yellow-600 font-semibold">Belum Dinilai</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button onclick="viewDetail(3)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="openNilaiModal(3)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Beri Nilai">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 - Not Submitted -->
                        <tr class="hover:bg-blue-50/50 transition-colors bg-yellow-50/30">
                            <td class="px-6 py-4 text-sm text-gray-600">4</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">2111081004</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-gray-600 to-gray-400 rounded-full flex items-center justify-center text-white font-bold">
                                        D
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Dedi Kurniawan</p>
                                        <p class="text-xs text-gray-500">dedi.kurniawan@student.unila.ac.id</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">NOT SUBMITTED</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">-</td>
                            <td class="px-6 py-4 text-sm text-gray-400">-</td>
                            <td class="px-6 py-4 text-sm text-gray-400">-</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    <span class="text-xs text-gray-400">No action</span>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal Beri Nilai -->
    <div id="modalNilai" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto animate-fade-in">
            <div class="sticky top-0 bg-gradient-to-r from-blue-950 via-blue-800 to-blue-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Beri Nilai & Feedback</h3>
                </div>
                <button onclick="closeNilaiModal()" class="text-white/80 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="formNilai" class="p-6 space-y-6">
                
                <!-- Student Info -->
                <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            A
                        </div>
                        <div class="flex-1">
                            <h4 class="text-lg font-bold text-gray-800">Ahmad Fauzi</h4>
                            <p class="text-sm text-gray-600">NPM: 2111081001</p>
                            <p class="text-xs text-gray-500">Submit: 5 Des 2024, 14:30 • Status: <span class="text-green-600 font-semibold">ON TIME</span></p>
                        </div>
                    </div>
                </div>

                <!-- Download File -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">File Submission</label>
                    <button type="button" onclick="downloadFile(1)" class="w-full inline-flex items-center justify-center gap-3 bg-gray-100 hover:bg-gray-200 border-2 border-gray-300 rounded-lg p-4 transition-all">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <div class="text-left">
                            <p class="font-semibold text-gray-800">Tugas_Ahmad_Fauzi.zip</p>
                            <p class="text-sm text-gray-500">42.3 MB</p>
                        </div>
                        <svg class="w-6 h-6 text-blue-600 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Nilai -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nilai (0-100)</label>
                    <input type="number" id="nilaiInput" min="0" max="100" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-2xl font-bold text-center" placeholder="85">
                </div>

                <!-- Feedback -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Feedback untuk Mahasiswa</label>
                    <textarea id="feedbackInput" rows="5" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all resize-none" placeholder="Berikan feedback yang konstruktif untuk membantu mahasiswa belajar..."></textarea>
                </div>

                <!-- Quick Feedback Templates -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Template Feedback</label>
                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" onclick="insertFeedback('Bagus')" class="px-3 py-2 bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 text-xs font-medium rounded-lg transition-all">✓ Sangat Baik</button>
                        <button type="button" onclick="insertFeedback('Perlu Perbaikan')" class="px-3 py-2 bg-yellow-50 hover:bg-yellow-100 border border-yellow-200 text-yellow-700 text-xs font-medium rounded-lg transition-all">! Perlu Perbaikan</button>
                        <button type="button" onclick="insertFeedback('Kurang Lengkap')" class="px-3 py-2 bg-orange-50 hover:bg-orange-100 border border-orange-200 text-orange-700 text-xs font-medium rounded-lg transition-all">⚠ Kurang Lengkap</button>
                        <button type="button" onclick="insertFeedback('Tidak Sesuai')" class="px-3 py-2 bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 text-xs font-medium rounded-lg transition-all">✗ Tidak Sesuai</button>
                    </div>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded-r-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-blue-700">Berikan feedback yang konstruktif dan spesifik untuk membantu mahasiswa memahami kekurangan dan cara memperbaikinya.</p>
                    </div>
                </div>

                <div class="flex gap-3 pt-4 border-t-2 border-gray-100">
                    <button type="button" onclick="closeNilaiModal()" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Nilai
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
        // Modal Nilai
        function openNilaiModal(id) {
            document.getElementById('modalNilai').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeNilaiModal() {
            document.getElementById('modalNilai').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('formNilai').reset();
        }

        function insertFeedback(template) {
            const textarea = document.getElementById('feedbackInput');
            const templates = {
                'Bagus': 'Pekerjaan yang sangat baik! Kode rapi, terstruktur dengan baik, dan memenuhi semua requirements yang diminta.',
                'Perlu Perbaikan': 'Ada beberapa aspek yang perlu diperbaiki terutama dalam hal struktur kode dan implementasi fitur.',
                'Kurang Lengkap': 'Tugas ini masih kurang lengkap. Beberapa fitur yang diminta belum diimplementasikan.',
                'Tidak Sesuai': 'Tugas tidak sesuai dengan requirement yang diminta. Silakan pelajari kembali soal dengan teliti.'
            };
            textarea.value = templates[template] || '';
        }

        function viewDetail(id) {
            alert('View detail submission ID: ' + id);
        }

        function downloadFile(id) {
            showToast('File sedang didownload...');
        }

        // Form Submit
        document.getElementById('formNilai').addEventListener('submit', function(e) {
            e.preventDefault();
            showToast('Nilai berhasil disimpan!');
            closeNilaiModal();
            // Refresh table or update UI
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
            if (e.key === 'Escape') closeNilaiModal();
        });

        document.getElementById('modalNilai').addEventListener('click', function(e) {
            if (e.target === this) closeNilaiModal();
        });
    </script>

</body>
</html>
