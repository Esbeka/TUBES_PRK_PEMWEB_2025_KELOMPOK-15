<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FITUR 12: Export & Reporting - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../assets/js/export-system.js" defer></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">KelasOnline</h1>
                        <p class="text-pink-200 text-sm">Export & Reporting System</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="dashboard-mahasiswa.php" class="text-white hover:text-pink-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <div class="flex items-center space-x-3">
                        <img src="https://ui-avatars.com/api/?name=Cindy&background=ec4899&color=fff&size=128" alt="Profile" class="w-10 h-10 rounded-full border-2 border-white shadow-lg">
                        <div class="text-right">
                            <p class="text-white font-semibold text-sm">Cindy</p>
                            <p class="text-pink-200 text-xs">Frontend Developer</p>
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
            <h2 class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent mb-2">
                📊 FITUR 12: Export & Reporting System
            </h2>
            <p class="text-gray-600 text-lg">Demo lengkap fitur export data dengan modal pilihan format dan loading indicator</p>
        </div>

        <!-- Feature Info -->
        <div class="bg-gradient-to-br from-pink-600 to-purple-600 rounded-3xl shadow-2xl p-8 mb-8 text-white">
            <h3 class="text-2xl font-bold mb-4">✨ Fitur yang Diimplementasikan:</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6">
                    <div class="text-4xl mb-3">📤</div>
                    <h4 class="font-bold text-lg mb-2">Export Button</h4>
                    <p class="text-pink-100 text-sm">Button export yang menarik di halaman list mahasiswa & nilai</p>
                </div>
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6">
                    <div class="text-4xl mb-3">🎨</div>
                    <h4 class="font-bold text-lg mb-2">Modal Pilih Format</h4>
                    <p class="text-pink-100 text-sm">Modal interaktif untuk memilih format Excel atau PDF</p>
                </div>
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6">
                    <div class="text-4xl mb-3">⏳</div>
                    <h4 class="font-bold text-lg mb-2">Loading Indicator</h4>
                    <p class="text-pink-100 text-sm">Animasi loading dengan progress bar saat generate file</p>
                </div>
            </div>
        </div>

        <!-- Demo Sections -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <!-- Demo 1: List Submission -->
            <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-blue-200 hover:border-blue-400 transition-all">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Data Submission Tugas</h3>
                        <p class="text-sm text-gray-600">Export daftar submission & nilai</p>
                    </div>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>45 Mahasiswa • 28 Sudah submit • 15 Dinilai</span>
                    </div>
                </div>

                <button onclick="exportSystem.openModal('submissions')" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Data Submission
                </button>
            </div>

            <!-- Demo 2: Progress Mahasiswa -->
            <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-purple-200 hover:border-purple-400 transition-all">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Progress Belajar</h3>
                        <p class="text-sm text-gray-600">Export laporan progress mahasiswa</p>
                    </div>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Progress: 76.5% • Rata-rata: 86.8</span>
                    </div>
                </div>

                <button onclick="exportSystem.openModal('progress')" class="w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Laporan Progress
                </button>
            </div>

            <!-- Demo 3: Statistik Kelas -->
            <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-green-200 hover:border-green-400 transition-all">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Statistik Kelas</h3>
                        <p class="text-sm text-gray-600">Export data statistik kelas</p>
                    </div>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>5 Kelas • 125 Mahasiswa • 87% Kehadiran</span>
                    </div>
                </div>

                <button onclick="exportSystem.openModal('statistics')" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Statistik Kelas
                </button>
            </div>

            <!-- Demo 4: Nilai Mahasiswa -->
            <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-pink-200 hover:border-pink-400 transition-all">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Daftar Nilai</h3>
                        <p class="text-sm text-gray-600">Export transkrip nilai mahasiswa</p>
                    </div>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-pink-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>24 Tugas dinilai • IPK: 3.67</span>
                    </div>
                </div>

                <button onclick="exportSystem.openModal('grades')" class="w-full bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Transkrip Nilai
                </button>
            </div>

        </div>

        <!-- Technical Info -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border-l-4 border-pink-500">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                <span class="text-3xl">🔧</span>
                Technical Implementation
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                        <span class="w-2 h-2 bg-pink-500 rounded-full"></span>
                        Frontend (Cindy)
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-pink-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span><strong>ExportSystem Class</strong> - OOP JavaScript untuk handle export</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-pink-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span><strong>Modal Component</strong> - Dynamic modal dengan backdrop blur</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-pink-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span><strong>Loading Overlay</strong> - Animated loading dengan progress bar</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-pink-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span><strong>Notification System</strong> - Toast notifications untuk success/error</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-pink-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span><strong>Tailwind CSS</strong> - Modern styling dengan gradient & animations</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                        <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                        Backend Integration
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-purple-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span><code>callExportAPI()</code> - Fetch API untuk backend communication</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-purple-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Blob handling untuk file download</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-purple-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Error handling & retry mechanism</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-purple-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Dynamic filename dengan timestamp</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-purple-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Session & authorization handling</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 p-6 bg-gradient-to-r from-pink-50 to-purple-50 rounded-2xl border border-pink-200">
                <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                    <span class="text-2xl">📋</span>
                    Halaman yang Menggunakan Fitur Export:
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                    <div class="flex items-center gap-2 text-gray-700">
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                        <code class="bg-white px-2 py-1 rounded">lihat-submission.php</code> (Dosen)
                    </div>
                    <div class="flex items-center gap-2 text-gray-700">
                        <span class="w-1.5 h-1.5 bg-purple-500 rounded-full"></span>
                        <code class="bg-white px-2 py-1 rounded">progress-mahasiswa.php</code> (Mahasiswa)
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
