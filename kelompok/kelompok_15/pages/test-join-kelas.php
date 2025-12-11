<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing Join Kelas - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        #joinKelasModal.show { display: flex !important; }
        .test-card { transition: all 0.3s ease; }
        .test-card:hover { transform: translateY(-2px); }
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">Testing Center</h1>
                        <p class="text-xs text-gray-600">Join Kelas Feature Testing</p>
                    </div>
                </div>
                <a href="kelas-mahasiswa.php" class="text-gray-600 hover:text-pink-600 font-medium text-sm">← Kembali ke Kelas</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-pink-500 via-purple-500 to-purple-600 rounded-2xl shadow-2xl p-8 mb-8 text-white animate-fade-in">
            <h2 class="text-3xl font-bold mb-2">🧪 Testing Join Kelas</h2>
            <p class="text-pink-100 text-lg">Pengujian fitur join kelas dengan berbagai skenario</p>
        </div>

        <!-- Test Cases Section -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 animate-slide-in">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                Test Scenarios
            </h3>

            <div class="grid gap-4">
                <!-- Test 1: Valid Code -->
                <div class="test-card bg-green-50 border-2 border-green-200 rounded-xl p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold">1</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-green-800">Test Kode Valid</h4>
                                <p class="text-green-600 text-sm mb-2">Testing join dengan kode kelas yang valid dan tersedia</p>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block bg-green-100 text-green-700 text-xs font-mono px-2 py-1 rounded">Expected: Success</span>
                                    <span class="inline-block bg-green-100 text-green-700 text-xs font-mono px-2 py-1 rounded">Status: 200</span>
                                </div>
                            </div>
                        </div>
                        <button onclick="runTest('valid')" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition-colors text-sm">
                            Run Test
                        </button>
                    </div>
                </div>

                <!-- Test 2: Invalid Code -->
                <div class="test-card bg-red-50 border-2 border-red-200 rounded-xl p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold">2</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-red-800">Test Kode Invalid</h4>
                                <p class="text-red-600 text-sm mb-2">Testing join dengan kode kelas yang tidak ada di database</p>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block bg-red-100 text-red-700 text-xs font-mono px-2 py-1 rounded">Expected: Error 404</span>
                                    <span class="inline-block bg-red-100 text-red-700 text-xs font-mono px-2 py-1 rounded">Kode tidak ditemukan</span>
                                </div>
                            </div>
                        </div>
                        <button onclick="runTest('invalid')" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition-colors text-sm">
                            Run Test
                        </button>
                    </div>
                </div>

                <!-- Test 3: Duplicate Prevention -->
                <div class="test-card bg-orange-50 border-2 border-orange-200 rounded-xl p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold">3</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-orange-800">Test Duplicate Prevention</h4>
                                <p class="text-orange-600 text-sm mb-2">Testing join kelas yang sudah di-join sebelumnya</p>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block bg-orange-100 text-orange-700 text-xs font-mono px-2 py-1 rounded">Expected: Error 400</span>
                                    <span class="inline-block bg-orange-100 text-orange-700 text-xs font-mono px-2 py-1 rounded">Sudah terdaftar</span>
                                </div>
                            </div>
                        </div>
                        <button onclick="runTest('duplicate')" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg transition-colors text-sm">
                            Run Test
                        </button>
                    </div>
                </div>

                <!-- Test 4: Full Capacity -->
                <div class="test-card bg-purple-50 border-2 border-purple-200 rounded-xl p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold">4</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-purple-800">Test Kapasitas Penuh</h4>
                                <p class="text-purple-600 text-sm mb-2">Testing join kelas yang kapasitasnya sudah penuh</p>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block bg-purple-100 text-purple-700 text-xs font-mono px-2 py-1 rounded">Expected: Error 400</span>
                                    <span class="inline-block bg-purple-100 text-purple-700 text-xs font-mono px-2 py-1 rounded">Kelas penuh</span>
                                </div>
                            </div>
                        </div>
                        <button onclick="runTest('full')" class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white font-semibold rounded-lg transition-colors text-sm">
                            Run Test
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manual Test Section -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                </svg>
                Manual Testing
            </h3>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Preview Test -->
                <div class="border-2 border-gray-200 rounded-xl p-4">
                    <h4 class="font-bold text-gray-800 mb-3">Test Preview AJAX</h4>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Kode Kelas</label>
                        <input 
                            type="text" 
                            id="testKodePreview" 
                            placeholder="Masukkan kode..."
                            class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-pink-500 uppercase font-mono"
                        >
                    </div>
                    <button onclick="testPreview()" class="w-full px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white font-semibold rounded-lg transition-colors">
                        Test Preview
                    </button>
                </div>

                <!-- Join Test -->
                <div class="border-2 border-gray-200 rounded-xl p-4">
                    <h4 class="font-bold text-gray-800 mb-3">Test Join POST</h4>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Kode Kelas</label>
                        <input 
                            type="text" 
                            id="testKodeJoin" 
                            placeholder="Masukkan kode..."
                            class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-pink-500 uppercase font-mono"
                        >
                    </div>
                    <button onclick="testJoin()" class="w-full px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white font-semibold rounded-lg transition-colors">
                        Test Join
                    </button>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Test Results
            </h3>
            
            <div id="testResults" class="bg-gray-900 rounded-xl p-4 font-mono text-sm text-green-400 h-64 overflow-y-auto">
                <p class="text-gray-500">// Test results will appear here...</p>
                <p class="text-gray-500">// Click a test button above to start</p>
            </div>

            <div class="flex gap-3 mt-4">
                <button onclick="clearResults()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition-colors">
                    Clear Results
                </button>
                <button onclick="runAllTests()" class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-semibold rounded-lg transition-colors">
                    Run All Tests
                </button>
            </div>
        </div>

        <!-- Open Modal Button -->
        <div class="text-center mb-8">
            <button onclick="showJoinKelasModal()" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold rounded-xl shadow-xl hover:shadow-2xl transition-all transform hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Open Join Kelas Modal
            </button>
        </div>

        <!-- Setup Instructions -->
        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-2xl p-6">
            <h3 class="text-lg font-bold text-yellow-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Setup Testing Data
            </h3>
            <p class="text-yellow-700 mb-4">Jalankan SQL berikut untuk membuat data testing:</p>
            <div class="bg-yellow-100 rounded-lg p-4 font-mono text-xs text-yellow-900 overflow-x-auto">
                <pre>-- Insert test kelas (normal capacity)
INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas)
VALUES (1, 'Testing Normal', 'TST101', '1', '2024/2025', 'Kelas untuk testing join normal', 'TEST01', 50);

-- Insert test kelas (full capacity - kapasitas 1)
INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas)
VALUES (1, 'Testing Full', 'TST102', '1', '2024/2025', 'Kelas untuk testing kapasitas penuh', 'FULL01', 1);

-- Insert 1 mahasiswa ke kelas full (untuk membuat kelas penuh)
INSERT INTO kelas_mahasiswa (id_kelas, id_mahasiswa) 
SELECT k.id_kelas, (SELECT id_user FROM users WHERE role='mahasiswa' LIMIT 1)
FROM kelas k WHERE k.kode_kelas = 'FULL01';</pre>
            </div>
        </div>

    </div>

    <!-- Join Kelas Modal (Copy from kelas-mahasiswa.php) -->
    <div id="joinKelasModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" style="display: none;">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto animate-fade-in">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-pink-500 to-purple-600 p-6 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Join Kelas Baru</h3>
                            <p class="text-pink-100 text-sm">Masukkan kode kelas dari dosen</p>
                        </div>
                    </div>
                    <button onclick="closeJoinKelasModal()" class="text-white/80 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <!-- Input Kode Kelas -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Kelas</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="kodeKelasInput" 
                            placeholder="Contoh: ABC123"
                            maxlength="10"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all text-center text-2xl font-mono tracking-widest uppercase"
                            oninput="previewKelas()"
                            onkeyup="if(event.key === 'Enter' && !document.getElementById('btnJoinKelas').disabled) joinKelas()"
                        >
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 text-center">Kode kelas terdiri dari 6 karakter (huruf & angka)</p>
                </div>

                <!-- Preview Section -->
                <div id="previewSection" class="hidden">
                    <!-- Loading State -->
                    <div id="previewLoading" class="hidden text-center py-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-pink-100 rounded-full mb-4">
                            <svg class="animate-spin h-8 w-8 text-pink-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600">Mencari kelas...</p>
                    </div>

                    <!-- Error State -->
                    <div id="previewError" class="hidden bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-red-100 rounded-full mb-3">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <p id="previewErrorMsg" class="text-red-600 font-medium">Kode kelas tidak ditemukan</p>
                        <p class="text-red-500 text-sm mt-1">Periksa kembali kode kelas Anda</p>
                    </div>

                    <!-- Preview Content -->
                    <div id="previewContent" class="hidden">
                        <div class="border-t border-gray-200 pt-4 mb-4">
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Preview Kelas</h4>
                        </div>

                        <!-- Class Info Card -->
                        <div class="bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl p-4 mb-4">
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 id="prevNamaMatkul" class="font-bold text-gray-800 text-lg">Nama Matakuliah</h4>
                                    <p id="prevKodeMatkul" class="text-pink-600 font-medium text-sm">KODE123</p>
                                </div>
                            </div>
                        </div>

                        <!-- Details Grid -->
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="flex items-center gap-2 mb-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-500 font-medium">Dosen</span>
                                </div>
                                <p id="prevNamaDosen" class="font-semibold text-gray-800 text-sm">Nama Dosen</p>
                                <p id="prevEmailDosen" class="text-gray-500 text-xs truncate">email@example.com</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="flex items-center gap-2 mb-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-500 font-medium">Periode</span>
                                </div>
                                <p id="prevSemester" class="font-semibold text-gray-800 text-sm">Semester 1</p>
                                <p id="prevTahunAjaran" class="text-gray-500 text-xs">2024/2025</p>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-3 mb-4">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                                <span class="text-xs text-gray-500 font-medium">Deskripsi</span>
                            </div>
                            <p id="prevDeskripsi" class="text-gray-700 text-sm">Deskripsi kelas...</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-3">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-500 font-medium">Kapasitas Kelas</span>
                                </div>
                                <span id="prevSisaSlot" class="text-xs font-semibold text-green-600">X slot tersisa</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div id="prevProgressBar" class="bg-green-500 h-2.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                            </div>
                            <p id="prevKapasitas" class="text-gray-600 text-xs mt-1 text-right">0/50 mahasiswa</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 pb-6">
                <div class="flex gap-3">
                    <button onclick="closeJoinKelasModal()" class="flex-1 px-4 py-3 border-2 border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button id="btnJoinKelas" onclick="joinKelas()" disabled class="flex-1 px-4 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold rounded-xl hover:shadow-lg transition-all opacity-50 cursor-not-allowed">
                        Join Kelas Ini
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="notificationContainer" class="fixed top-4 right-4 z-[60] space-y-2"></div>

    <script>
        // Test codes for different scenarios
        const testCodes = {
            valid: 'TEST01',    // Valid code (you need to create this in DB)
            invalid: 'XXXZZZ',  // Invalid code (doesn't exist)
            duplicate: 'TEST01', // Same as valid - for testing duplicate
            full: 'FULL01'      // Full capacity class
        };

        // Log results to results panel
        function log(message, type = 'info') {
            const results = document.getElementById('testResults');
            const timestamp = new Date().toLocaleTimeString();
            const colors = {
                info: 'text-blue-400',
                success: 'text-green-400',
                error: 'text-red-400',
                warning: 'text-yellow-400'
            };
            
            const line = document.createElement('p');
            line.className = colors[type] || colors.info;
            line.innerHTML = `<span class="text-gray-500">[${timestamp}]</span> ${message}`;
            results.appendChild(line);
            results.scrollTop = results.scrollHeight;
        }

        // Clear results
        function clearResults() {
            const results = document.getElementById('testResults');
            results.innerHTML = '<p class="text-gray-500">// Results cleared</p>';
        }

        // Run specific test
        async function runTest(testType) {
            const kode = testCodes[testType];
            log(`Starting test: ${testType.toUpperCase()} with code: ${kode}`, 'info');
            
            try {
                // First test preview
                log(`Testing preview for: ${kode}`);
                const previewResponse = await fetch(`../backend/kelas/preview-kelas.php?kode_kelas=${encodeURIComponent(kode)}`);
                const previewResult = await previewResponse.json();
                
                if (previewResult.success) {
                    log(`Preview SUCCESS: ${previewResult.data.nama_matakuliah} (${previewResult.data.jumlah_mahasiswa}/${previewResult.data.kapasitas})`, 'success');
                } else {
                    log(`Preview FAILED: ${previewResult.message}`, testType === 'invalid' ? 'success' : 'error');
                    if (testType === 'invalid') {
                        log('✓ Test PASSED: Invalid code correctly rejected', 'success');
                        return;
                    }
                }

                // Then test join
                log(`Testing join for: ${kode}`);
                const formData = new FormData();
                formData.append('kode_kelas', kode);
                
                const joinResponse = await fetch('../backend/kelas/join-kelas.php', {
                    method: 'POST',
                    body: formData
                });
                const joinResult = await joinResponse.json();
                
                if (joinResult.success) {
                    log(`Join SUCCESS: ${joinResult.message}`, 'success');
                    if (testType === 'valid') {
                        log('✓ Test PASSED: Valid join completed', 'success');
                    }
                } else {
                    log(`Join FAILED: ${joinResult.message}`, 'warning');
                    
                    // Check expected failures
                    if (testType === 'duplicate' && joinResult.message.includes('sudah terdaftar')) {
                        log('✓ Test PASSED: Duplicate correctly prevented', 'success');
                    } else if (testType === 'full' && joinResult.message.includes('penuh')) {
                        log('✓ Test PASSED: Full capacity correctly blocked', 'success');
                    } else {
                        log('✗ Test result unexpected', 'error');
                    }
                }
                
            } catch (error) {
                log(`Error: ${error.message}`, 'error');
            }
            
            log('---', 'info');
        }

        // Run all tests
        async function runAllTests() {
            log('========== RUNNING ALL TESTS ==========', 'info');
            
            // Test invalid code first
            await runTest('invalid');
            await new Promise(r => setTimeout(r, 500));
            
            // Test full capacity
            await runTest('full');
            await new Promise(r => setTimeout(r, 500));
            
            // Test valid code
            await runTest('valid');
            await new Promise(r => setTimeout(r, 500));
            
            // Test duplicate (after valid join)
            await runTest('duplicate');
            
            log('========== ALL TESTS COMPLETED ==========', 'info');
        }

        // Manual preview test
        async function testPreview() {
            const kode = document.getElementById('testKodePreview').value.trim().toUpperCase();
            if (!kode) {
                log('Error: Please enter a code', 'error');
                return;
            }
            
            log(`Manual Preview Test: ${kode}`);
            
            try {
                const response = await fetch(`../backend/kelas/preview-kelas.php?kode_kelas=${encodeURIComponent(kode)}`);
                const result = await response.json();
                log(`Response: ${JSON.stringify(result, null, 2)}`, result.success ? 'success' : 'error');
            } catch (error) {
                log(`Error: ${error.message}`, 'error');
            }
        }

        // Manual join test
        async function testJoin() {
            const kode = document.getElementById('testKodeJoin').value.trim().toUpperCase();
            if (!kode) {
                log('Error: Please enter a code', 'error');
                return;
            }
            
            log(`Manual Join Test: ${kode}`);
            
            try {
                const formData = new FormData();
                formData.append('kode_kelas', kode);
                
                const response = await fetch('../backend/kelas/join-kelas.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                log(`Response: ${JSON.stringify(result, null, 2)}`, result.success ? 'success' : 'error');
            } catch (error) {
                log(`Error: ${error.message}`, 'error');
            }
        }

        // Modal Functions (same as kelas-mahasiswa.php)
        function showJoinKelasModal() {
            document.getElementById('joinKelasModal').classList.add('show');
            document.body.style.overflow = 'hidden';
            resetJoinModal();
        }

        function closeJoinKelasModal() {
            document.getElementById('joinKelasModal').classList.remove('show');
            document.body.style.overflow = '';
            resetJoinModal();
        }

        function resetJoinModal() {
            document.getElementById('kodeKelasInput').value = '';
            document.getElementById('previewSection').classList.add('hidden');
            document.getElementById('previewLoading').classList.add('hidden');
            document.getElementById('previewError').classList.add('hidden');
            document.getElementById('previewContent').classList.add('hidden');
            document.getElementById('btnJoinKelas').disabled = true;
            document.getElementById('btnJoinKelas').classList.add('opacity-50', 'cursor-not-allowed');
        }

        let previewTimeout = null;
        let currentKodeKelas = '';

        function previewKelas() {
            const kodeKelas = document.getElementById('kodeKelasInput').value.trim().toUpperCase();
            
            if (previewTimeout) clearTimeout(previewTimeout);
            
            if (kodeKelas.length < 4) {
                document.getElementById('previewSection').classList.add('hidden');
                document.getElementById('btnJoinKelas').disabled = true;
                document.getElementById('btnJoinKelas').classList.add('opacity-50', 'cursor-not-allowed');
                return;
            }
            
            previewTimeout = setTimeout(() => fetchPreview(kodeKelas), 500);
        }

        async function fetchPreview(kodeKelas) {
            currentKodeKelas = kodeKelas;
            
            document.getElementById('previewSection').classList.remove('hidden');
            document.getElementById('previewLoading').classList.remove('hidden');
            document.getElementById('previewError').classList.add('hidden');
            document.getElementById('previewContent').classList.add('hidden');
            document.getElementById('btnJoinKelas').disabled = true;
            document.getElementById('btnJoinKelas').classList.add('opacity-50', 'cursor-not-allowed');

            try {
                const response = await fetch(`../backend/kelas/preview-kelas.php?kode_kelas=${encodeURIComponent(kodeKelas)}`);
                const result = await response.json();

                if (kodeKelas !== currentKodeKelas) return;

                document.getElementById('previewLoading').classList.add('hidden');

                if (result.success) {
                    displayPreview(result.data);
                    log(`Modal Preview: ${result.data.nama_matakuliah}`, 'success');
                } else {
                    showPreviewError(result.message || 'Kode kelas tidak ditemukan');
                    log(`Modal Preview Error: ${result.message}`, 'error');
                }
            } catch (error) {
                if (kodeKelas !== currentKodeKelas) return;
                document.getElementById('previewLoading').classList.add('hidden');
                showPreviewError('Gagal terhubung ke server.');
                log(`Modal Preview Error: ${error.message}`, 'error');
            }
        }

        function displayPreview(data) {
            document.getElementById('previewContent').classList.remove('hidden');
            
            document.getElementById('prevNamaMatkul').textContent = data.nama_matakuliah;
            document.getElementById('prevKodeMatkul').textContent = data.kode_matakuliah;
            document.getElementById('prevNamaDosen').textContent = data.dosen.nama;
            document.getElementById('prevEmailDosen').textContent = data.dosen.email;
            document.getElementById('prevSemester').textContent = `Semester ${data.semester}`;
            document.getElementById('prevTahunAjaran').textContent = data.tahun_ajaran;
            document.getElementById('prevDeskripsi').textContent = data.deskripsi || 'Tidak ada deskripsi';
            
            const sisaSlot = data.sisa_slot;
            const kapasitas = data.kapasitas;
            const jumlahMahasiswa = data.jumlah_mahasiswa;
            const percentage = (jumlahMahasiswa / kapasitas) * 100;
            const sudahTerdaftar = data.sudah_terdaftar || false;
            
            document.getElementById('prevKapasitas').textContent = `${jumlahMahasiswa}/${kapasitas} mahasiswa`;
            document.getElementById('prevSisaSlot').textContent = `${sisaSlot} slot tersisa`;
            document.getElementById('prevProgressBar').style.width = `${percentage}%`;
            
            const progressBar = document.getElementById('prevProgressBar');
            const sisaSlotEl = document.getElementById('prevSisaSlot');
            progressBar.className = 'h-full rounded-full transition-all duration-300';
            sisaSlotEl.classList.remove('text-green-600', 'text-orange-600', 'text-red-600', 'text-blue-600');
            
            if (percentage >= 100) {
                progressBar.classList.add('bg-red-500');
                sisaSlotEl.classList.add('text-red-600');
            } else if (percentage >= 80) {
                progressBar.classList.add('bg-orange-500');
                sisaSlotEl.classList.add('text-orange-600');
            } else {
                progressBar.classList.add('bg-green-500');
                sisaSlotEl.classList.add('text-green-600');
            }

            // Handle join button state
            const btnJoin = document.getElementById('btnJoinKelas');
            
            if (sudahTerdaftar) {
                btnJoin.disabled = true;
                btnJoin.classList.add('opacity-50', 'cursor-not-allowed');
                btnJoin.innerHTML = `<svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Sudah Terdaftar`;
                sisaSlotEl.textContent = 'Anda sudah terdaftar di kelas ini';
                sisaSlotEl.classList.add('text-blue-600');
                log(`Preview: User already enrolled in this class`, 'warning');
            } else if (sisaSlot <= 0) {
                btnJoin.disabled = true;
                btnJoin.classList.add('opacity-50', 'cursor-not-allowed');
                btnJoin.textContent = 'Kelas Penuh';
                log(`Preview: Class is full (${jumlahMahasiswa}/${kapasitas})`, 'warning');
            } else {
                btnJoin.disabled = false;
                btnJoin.classList.remove('opacity-50', 'cursor-not-allowed');
                btnJoin.textContent = 'Join Kelas Ini';
            }
        }

        function showPreviewError(message) {
            document.getElementById('previewError').classList.remove('hidden');
            document.getElementById('previewErrorMsg').textContent = message;
            document.getElementById('previewContent').classList.add('hidden');
            document.getElementById('btnJoinKelas').disabled = true;
            document.getElementById('btnJoinKelas').classList.add('opacity-50', 'cursor-not-allowed');
        }

        async function joinKelas() {
            const kodeKelas = document.getElementById('kodeKelasInput').value.trim().toUpperCase();
            
            if (!kodeKelas) {
                showNotification('Silakan masukkan kode kelas terlebih dahulu', 'error');
                return;
            }

            const btn = document.getElementById('btnJoinKelas');
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.innerHTML = `<svg class="animate-spin h-5 w-5 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...`;

            try {
                const formData = new FormData();
                formData.append('kode_kelas', kodeKelas);

                const response = await fetch('../backend/kelas/join-kelas.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    showNotification(result.message || 'Berhasil bergabung ke kelas!', 'success');
                    log(`Modal Join SUCCESS: ${result.message}`, 'success');
                    closeJoinKelasModal();
                } else {
                    let errorType = 'error';
                    if (result.message.includes('sudah terdaftar')) errorType = 'warning';
                    showNotification(result.message || 'Gagal bergabung ke kelas', errorType);
                    log(`Modal Join FAILED: ${result.message}`, 'error');
                    btn.disabled = false;
                    btn.textContent = originalText;
                }
            } catch (error) {
                showNotification('Gagal terhubung ke server.', 'error');
                log(`Modal Join ERROR: ${error.message}`, 'error');
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        function showNotification(message, type = 'info') {
            const notifContainer = document.getElementById('notificationContainer');
            if (!notifContainer) return;

            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                warning: 'bg-orange-500',
                info: 'bg-blue-500'
            };

            const icons = {
                success: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>',
                error: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>',
                warning: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>',
                info: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
            };

            const notif = document.createElement('div');
            notif.className = `${colors[type]} text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 transform translate-x-full transition-transform duration-300`;
            notif.innerHTML = `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">${icons[type]}</svg><span class="font-medium">${message}</span>`;

            notifContainer.appendChild(notif);
            setTimeout(() => notif.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                notif.classList.add('translate-x-full');
                setTimeout(() => notif.remove(), 300);
            }, 4000);
        }

        // Initialize
        log('Test page initialized. Ready to run tests.', 'info');
        log('Make sure you have test data in the database (see Setup Instructions below)', 'warning');
    </script>

</body>
</html>
