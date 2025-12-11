<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Belajar - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/export-system.js" defer></script>
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
        @keyframes progressBar {
            from { width: 0%; }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
        .animate-slide-in { animation: slideIn 0.6s ease-out forwards; }
        .animate-pulse-soft { animation: pulse 1.5s ease-in-out infinite; }
        .progress-animated {
            animation: progressBar 1.5s ease-out forwards;
        }
        
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
            background: linear-gradient(135deg, #ec4899, #8b5cf6);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #db2777, #7c3aed);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-50 via-purple-50 to-pink-50 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-pink-600 via-purple-600 to-pink-500 shadow-2xl sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-white p-2 rounded-lg shadow-lg">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">KelasOnline</h1>
                        <p class="text-pink-200 text-sm">Progress Belajar Saya</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="dashboard-mahasiswa.php" class="text-white hover:text-pink-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <div class="flex items-center space-x-3">
                        <img src="https://ui-avatars.com/api/?name=Cindy+Mahasiswa&background=ec4899&color=fff&size=128" alt="Profile" class="w-10 h-10 rounded-full border-2 border-white shadow-lg">
                        <div class="text-right">
                            <p class="text-white font-semibold text-sm">Cindy</p>
                            <p class="text-pink-200 text-xs">NPM: 2115101015</p>
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
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent mb-2">✨ Progress Belajar Saya</h2>
                    <p class="text-gray-600">Yuk lihat sejauh mana perkembangan belajar kamu! 🚀</p>
                </div>
                <button onclick="exportSystem.openModal('progress')" class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-700 hover:to-purple-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export Laporan
                </button>
            </div>
        </div>

        <!-- Overall Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            
            <!-- Total Progress -->
            <div class="bg-gradient-to-br from-pink-600 to-purple-600 rounded-2xl shadow-xl p-6 text-white animate-slide-in" style="animation-delay: 0.1s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-2xl">⚡</span>
                </div>
                <h3 class="text-sm font-medium mb-2 text-pink-100">Progress Keseluruhan</h3>
                <p class="text-4xl font-bold mb-2">76.5%</p>
                <div class="flex items-center text-sm text-pink-100">
                    <span>🎯 153 / 200 item selesai</span>
                </div>
            </div>

            <!-- Materi Selesai -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-pink-500 animate-slide-in" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-pink-500 to-pink-400 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-2xl">📚</span>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Materi Dipelajari</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">62 / 80</p>
                <p class="text-pink-600 text-sm font-semibold">✨ 77.5% selesai</p>
            </div>

            <!-- Tugas Dikumpulkan -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-purple-500 animate-slide-in" style="animation-delay: 0.3s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-400 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-2xl">📝</span>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Tugas Dikumpulkan</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">28 / 36</p>
                <p class="text-purple-600 text-sm font-semibold">💪 77.8% tepat waktu</p>
            </div>

            <!-- Rata-rata Nilai -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-yellow-500 animate-slide-in" style="animation-delay: 0.4s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-yellow-500 to-yellow-400 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <span class="text-2xl">🏆</span>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Rata-rata Nilai</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">86.8</p>
                <p class="text-yellow-600 text-sm font-semibold">🌟 24 tugas dinilai</p>
            </div>

        </div>

        <!-- Progress per Kelas -->
        <div class="space-y-6">
            
            <!-- Kelas 1: Pemrograman Web -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in border-l-4 border-pink-500">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-br from-pink-600 to-pink-500 p-3 rounded-xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                💻 Pemrograman Web
                            </h3>
                            <p class="text-sm text-gray-600">Dr. Budi Santoso, M.Kom • Semester 5</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-pink-600">88%</p>
                        <p class="text-sm text-gray-600">✨ Cemerlang</p>
                    </div>
                </div>

                <!-- Overall Progress Bar -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-700">🎯 Progress Keseluruhan</span>
                        <span class="text-sm font-bold text-pink-600">44 / 50 item (88%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                        <div class="bg-gradient-to-r from-pink-600 to-purple-600 h-full rounded-full progress-animated shadow-lg" style="width: 88%;"></div>
                    </div>
                </div>

                <!-- Materi & Tugas Progress -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Materi Progress -->
                    <div class="bg-gradient-to-br from-pink-50 to-white rounded-xl p-5 border-2 border-pink-200">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="bg-gradient-to-br from-pink-600 to-pink-500 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800">📚 Materi</h4>
                        </div>
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">Progress</span>
                                <span class="text-sm font-bold text-pink-600">23 / 25 (92%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-pink-600 to-pink-500 h-full rounded-full progress-animated shadow-md" style="width: 92%; animation-delay: 0.2s;"></div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">✅ PDF dibaca</span>
                                <span class="font-semibold text-gray-800">15 / 16</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">▶️ Video ditonton</span>
                                <span class="font-semibold text-gray-800">8 / 9</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tugas Progress -->
                    <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-5 border-2 border-purple-200">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="bg-gradient-to-br from-purple-600 to-purple-500 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800">📝 Tugas</h4>
                        </div>
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">Progress</span>
                                <span class="text-sm font-bold text-purple-600">10 / 12 (83.3%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-purple-600 to-purple-500 h-full rounded-full progress-animated shadow-md" style="width: 83.3%; animation-delay: 0.3s;"></div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">✅ Dikumpulkan</span>
                                <span class="font-semibold text-gray-800">10 tugas</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">⏳ Belum submit</span>
                                <span class="font-semibold text-orange-600">2 tugas</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">🌟 Rata-rata nilai</span>
                                <span class="font-semibold text-green-600">88.5</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Detail List -->
                <div class="mt-6 pt-6 border-t-2 border-gray-100">
                    <button onclick="toggleDetail('pemweb')" class="flex items-center justify-between w-full text-left hover:text-pink-600 transition-colors">
                        <span class="font-semibold text-gray-700">🔍 Lihat Detail Materi & Tugas</span>
                        <svg id="arrow-pemweb" class="w-5 h-5 text-gray-600 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="detail-pemweb" class="hidden mt-4 space-y-2">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-pink-50 p-3 rounded-lg border border-pink-200">
                                <div class="flex items-center space-x-2 mb-1">
                                    <svg class="w-4 h-4 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-700">✨ Materi 1-11</span>
                                </div>
                                <p class="text-xs text-gray-600">23 materi selesai dipelajari</p>
                            </div>
                            <div class="bg-orange-50 p-3 rounded-lg border border-orange-200">
                                <div class="flex items-center space-x-2 mb-1">
                                    <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-700">📚 Materi 12</span>
                                </div>
                                <p class="text-xs text-gray-600">2 video belum ditonton</p>
                            </div>
                            <div class="bg-green-50 p-3 rounded-lg border border-green-200">
                                <div class="flex items-center space-x-2 mb-1">
                                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-700">🎯 Tugas 1-10</span>
                                </div>
                                <p class="text-xs text-gray-600">Sudah dinilai, rata-rata 88.5</p>
                            </div>
                            <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                                <div class="flex items-center space-x-2 mb-1">
                                    <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-700">⚠️ Tugas 11-12</span>
                                </div>
                                <p class="text-xs text-gray-600">Deadline: 15 Des 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kelas 2: Struktur Data -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in border-l-4 border-purple-500">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-br from-purple-600 to-purple-500 p-3 rounded-xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                📊 Struktur Data
                            </h3>
                            <p class="text-sm text-gray-600">Prof. Siti Rahayu, Ph.D • Semester 3</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-purple-600">81%</p>
                        <p class="text-sm text-gray-600">💪 Bagus</p>
                    </div>
                </div>

                <!-- Overall Progress Bar -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-700">🎯 Progress Keseluruhan</span>
                        <span class="text-sm font-bold text-purple-600">36 / 45 item (81%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-600 to-purple-500 h-full rounded-full progress-animated shadow-lg" style="width: 81%; animation-delay: 0.2s;"></div>
                    </div>
                </div>

                <!-- Materi & Tugas Progress -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Materi Progress -->
                    <div class="bg-gradient-to-br from-pink-50 to-white rounded-xl p-5 border-2 border-pink-200">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="bg-gradient-to-br from-pink-600 to-pink-500 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800">📚 Materi</h4>
                        </div>
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">Progress</span>
                                <span class="text-sm font-bold text-pink-600">17 / 20 (85%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-pink-600 to-pink-500 h-full rounded-full progress-animated shadow-md" style="width: 85%; animation-delay: 0.4s;"></div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">✅ PDF dibaca</span>
                                <span class="font-semibold text-gray-800">11 / 12</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">▶️ Video ditonton</span>
                                <span class="font-semibold text-gray-800">6 / 8</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tugas Progress -->
                    <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-5 border-2 border-purple-200">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="bg-gradient-to-br from-purple-600 to-purple-500 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800">📝 Tugas</h4>
                        </div>
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">Progress</span>
                                <span class="text-sm font-bold text-purple-600">8 / 10 (80%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-purple-600 to-purple-500 h-full rounded-full progress-animated shadow-md" style="width: 80%; animation-delay: 0.5s;"></div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">✅ Dikumpulkan</span>
                                <span class="font-semibold text-gray-800">8 tugas</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">⏳ Belum submit</span>
                                <span class="font-semibold text-orange-600">2 tugas</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">🌟 Rata-rata nilai</span>
                                <span class="font-semibold text-green-600">84.2</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Kelas 3: Basis Data -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in border-l-4 border-blue-500">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-br from-blue-600 to-blue-500 p-3 rounded-xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                💾 Basis Data
                            </h3>
                            <p class="text-sm text-gray-600">Ir. Ahmad Fauzi, M.T • Semester 4</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-blue-600">71%</p>
                        <p class="text-sm text-gray-600">🚀 Terus tingkatkan!</p>
                    </div>
                </div>

                <!-- Overall Progress Bar -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-700">🎯 Progress Keseluruhan</span>
                        <span class="text-sm font-bold text-blue-600">33 / 46 item (71%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-500 h-full rounded-full progress-animated shadow-lg" style="width: 71%; animation-delay: 0.3s;"></div>
                    </div>
                </div>

                <!-- Materi & Tugas Progress -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Materi Progress -->
                    <div class="bg-gradient-to-br from-pink-50 to-white rounded-xl p-5 border-2 border-pink-200">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="bg-gradient-to-br from-pink-600 to-pink-500 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800">📚 Materi</h4>
                        </div>
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">Progress</span>
                                <span class="text-sm font-bold text-pink-600">14 / 20 (70%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-pink-600 to-pink-500 h-full rounded-full progress-animated shadow-md" style="width: 70%; animation-delay: 0.6s;"></div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">✅ PDF dibaca</span>
                                <span class="font-semibold text-gray-800">9 / 12</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">▶️ Video ditonton</span>
                                <span class="font-semibold text-gray-800">5 / 8</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tugas Progress -->
                    <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-5 border-2 border-purple-200">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="bg-gradient-to-br from-purple-600 to-purple-500 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800">📝 Tugas</h4>
                        </div>
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">Progress</span>
                                <span class="text-sm font-bold text-purple-600">6 / 9 (66.7%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-purple-600 to-purple-500 h-full rounded-full progress-animated shadow-md" style="width: 66.7%; animation-delay: 0.7s;"></div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">✅ Dikumpulkan</span>
                                <span class="font-semibold text-gray-800">6 tugas</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">⏳ Belum submit</span>
                                <span class="font-semibold text-orange-600">3 tugas</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">🌟 Rata-rata nilai</span>
                                <span class="font-semibold text-green-600">86.5</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Kelas 4: Algoritma Pemrograman -->
            <div class="bg-white rounded-2xl shadow-xl p-6 animate-fade-in border-l-4 border-orange-500">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-br from-orange-600 to-orange-500 p-3 rounded-xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                🧠 Algoritma Pemrograman
                            </h3>
                            <p class="text-sm text-gray-600">Drs. Budi Rahardjo, M.Kom • Semester 1</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-orange-600">68%</p>
                        <p class="text-sm text-gray-600">💪 Keep going!</p>
                    </div>
                </div>

                <!-- Overall Progress Bar -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-700">🎯 Progress Keseluruhan</span>
                        <span class="text-sm font-bold text-orange-600">38 / 56 item (68%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                        <div class="bg-gradient-to-r from-orange-600 to-orange-500 h-full rounded-full progress-animated shadow-lg" style="width: 68%; animation-delay: 0.4s;"></div>
                    </div>
                </div>

                <!-- Materi & Tugas Progress -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Materi Progress -->
                    <div class="bg-gradient-to-br from-pink-50 to-white rounded-xl p-5 border-2 border-pink-200">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="bg-gradient-to-br from-pink-600 to-pink-500 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800">📚 Materi</h4>
                        </div>
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">Progress</span>
                                <span class="text-sm font-bold text-pink-600">14 / 20 (70%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-pink-600 to-pink-500 h-full rounded-full progress-animated shadow-md" style="width: 70%; animation-delay: 0.8s;"></div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">✅ PDF dibaca</span>
                                <span class="font-semibold text-gray-800">10 / 14</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">▶️ Video ditonton</span>
                                <span class="font-semibold text-gray-800">4 / 6</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tugas Progress -->
                    <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-5 border-2 border-purple-200">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="bg-gradient-to-br from-purple-600 to-purple-500 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800">📝 Tugas</h4>
                        </div>
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">Progress</span>
                                <span class="text-sm font-bold text-purple-600">4 / 6 (66.7%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-purple-600 to-purple-500 h-full rounded-full progress-animated shadow-md" style="width: 66.7%; animation-delay: 0.9s;"></div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">✅ Dikumpulkan</span>
                                <span class="font-semibold text-gray-800">4 tugas</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">⏳ Belum submit</span>
                                <span class="font-semibold text-orange-600">2 tugas</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">🌟 Rata-rata nilai</span>
                                <span class="font-semibold text-green-600">87.2</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>
        // Toggle detail function
        function toggleDetail(kelasId) {
            const detail = document.getElementById('detail-' + kelasId);
            const arrow = document.getElementById('arrow-' + kelasId);
            
            if (detail.classList.contains('hidden')) {
                detail.classList.remove('hidden');
                arrow.style.transform = 'rotate(180deg)';
            } else {
                detail.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
            }
        }

        // Animate progress bars on load
        window.addEventListener('load', function() {
            const progressBars = document.querySelectorAll('.progress-animated');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100);
            });
        });
    </script>

</body>
</html>
