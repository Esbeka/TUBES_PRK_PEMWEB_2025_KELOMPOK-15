<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Materi - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/notifications.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
        .animate-slideIn { animation: slideIn 0.4s ease-out; }
        
        /* Drag & Drop Styles */
        .drag-area {
            border: 2px dashed #3b82f6;
            transition: all 0.3s ease;
        }
        .drag-area.drag-over {
            border-color: #ec4899;
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%);
            transform: scale(1.02);
        }
        
        /* Progress Bar */
        .progress-bar-container {
            height: 4px;
            background: rgba(236, 72, 153, 0.2);
            border-radius: 2px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #ec4899 0%, #a855f7 100%);
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
        
        .loading-skeleton {
            background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-200 via-purple-200 to-pink-300 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-lg border-b border-pink-200 sticky top-0 z-40 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
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
                            <p class="text-xs text-gray-600">Kelola Materi</p>
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Back Button -->
        <a href="dashboard-dosen.php" class="inline-flex items-center gap-2 text-gray-700 hover:text-pink-600 font-semibold mb-6 transition-colors">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Dashboard
        </a>

        <!-- Header -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8 hover:shadow-2xl transition-all duration-300 animate-fadeIn">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-2">Kelola Materi</h2>
                    <p class="text-gray-600">Pemrograman Web • Kelas A • Semester Ganjil 2024/2025</p>
                </div>
                <button onclick="openTambahMateriModal()" class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Materi
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-in">
            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-pink-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Total Materi</p>
                        <h3 id="totalMateri" class="text-3xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">0</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-100 to-purple-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 mb-1">24</h3>
                    <p class="text-sm font-bold text-gray-600">Total Materi</p>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-purple-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">PDF Files</p>
                        <h3 id="pdfCount" class="text-3xl font-bold text-purple-600">0</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 mb-1">18</h3>
                    <p class="text-sm font-bold text-gray-600">PDF Files</p>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-red-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Video Links</p>
                        <h3 id="videoCount" class="text-3xl font-bold text-red-600">0</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 mb-1">6</h3>
                    <p class="text-sm font-bold text-gray-600">Video Links</p>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-green-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Pertemuan</p>
                        <h3 id="pertemuanCount" class="text-3xl font-bold text-green-600">0</h3>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 mb-1">14</h3>
                    <p class="text-sm font-bold text-gray-600">Pertemuan</p>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="bg-white rounded-2xl p-6 shadow-xl mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="searchMateri" placeholder="Cari materi..." class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 transition-all duration-300">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <select id="filterPertemuan" class="px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    <option value="">Semua Pertemuan</option>
                </select>
            </div>
        </div>

        <!-- Materi List by Pertemuan -->
        <div id="materiContainer" class="space-y-6">
            
            <!-- Loading Skeleton for Pertemuan 1 -->
            <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 overflow-hidden loading-skeleton" style="height: 300px;"></div>
            <!-- Loading Skeleton for Pertemuan 2 -->
            <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 overflow-hidden loading-skeleton" style="height: 300px;"></div>
        </div>

    </div>

    <!-- Modal Tambah Materi -->
    <div id="modalTambahMateri" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto animate-fadeIn">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-pink-500 via-purple-500 to-purple-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
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
                    <input type="text" id="judulMateri" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 transition-all duration-300" placeholder="Masukkan judul materi">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="deskripsiMateri" rows="3" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 transition-all duration-300 resize-none" placeholder="Deskripsikan materi pembelajaran"></textarea>
                </div>

                <!-- Pertemuan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pertemuan Ke</label>
                    <select id="pertemuanMateri" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 transition-all duration-300">
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
                        <div id="dropZone" class="drag-area border-2 border-dashed border-pink-400 rounded-xl p-8 text-center bg-gradient-to-br from-pink-50 to-purple-50 cursor-pointer hover:border-pink-600 transition-all">
                            <input type="file" id="fileInput" accept=".pdf,.doc,.docx" class="hidden">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-pink-100 to-purple-200 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-700 font-semibold mb-1">Drag & drop file PDF di sini</p>
                                    <p class="text-sm text-gray-500">atau <span class="text-pink-600 font-semibold">klik untuk browse</span></p>
                                </div>
                                <p class="text-xs text-gray-400">Max 10MB • PDF only</p>
                            </div>
                        </div>

                        <!-- File Preview -->
                        <div id="filePreview" class="file-preview bg-pink-50 border-2 border-pink-200 rounded-lg p-4">
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
                            <input type="url" id="videoLink" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all duration-300" placeholder="https://youtube.com/watch?v=...">
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
                <div class="bg-pink-50 border-l-4 border-pink-500 p-4 rounded-r-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-pink-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-pink-800 mb-1">Tips Upload Materi</p>
                            <ul class="text-xs text-pink-700 space-y-1">
                                <li>• PDF max 10MB untuk performa optimal</li>
                                <li>• Video gunakan YouTube/Google Drive untuk hemat storage</li>
                                <li>• Pastikan judul & deskripsi jelas untuk mahasiswa</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4 border-t-2 border-gray-100">
                    <button type="button" onclick="closeTambahMateriModal()" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Materi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="hidden fixed bottom-4 right-4 bg-white border-2 border-green-500 rounded-xl shadow-2xl p-4 z-50 max-w-sm">
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
        let idKelas = null;
        let materiData = [];

        // apiFetch helper (same as dashboard)
        async function apiFetch(url, options = {}) {
            const sessionId = localStorage.getItem('sessionId');
            const defaultHeaders = {
                'Content-Type': 'application/json',
                'X-Session-ID': sessionId || ''
            };
            
            return fetch(url, {
                ...options,
                headers: { ...defaultHeaders, ...options.headers },
                credentials: 'include'
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', async function() {
            // Get id_kelas from URL or use from dashboard
            const params = new URLSearchParams(window.location.search);
            idKelas = params.get('id_kelas');
            
            if (!idKelas) {
                alert('Kelas tidak ditemukan');
                window.location.href = 'dashboard-dosen.php';
                return;
            }

            await loadMateri();
            setupEventListeners();
        });

        // Load materi dari backend
        async function loadMateri() {
            const container = document.getElementById('materiContainer');
            
            try {
                const response = await apiFetch(`../backend/materi/get-materi.php?id_kelas=${idKelas}`);
                const result = await response.json();

                if (!response.ok || !result.success) {
                    throw new Error(result.message || 'Gagal load materi');
                }

                materiData = result.data || [];
                
                // Update stats
                updateStats();
                
                // Group by pertemuan
                const groupedData = {};
                materiData.forEach(item => {
                    if (!groupedData[item.pertemuan_ke]) {
                        groupedData[item.pertemuan_ke] = [];
                    }
                    groupedData[item.pertemuan_ke].push(item);
                });

                // Render pertemuan sections
                container.innerHTML = '';
                if (Object.keys(groupedData).length === 0) {
                    container.innerHTML = `
                        <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-8 text-center">
                            <p class="text-blue-600 font-semibold mb-4">Belum ada materi. Mulai tambahkan materi pembelajaran!</p>
                            <button onclick="openTambahMateriModal()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Tambah Materi Pertama
                            </button>
                        </div>
                    `;
                } else {
                    Object.keys(groupedData)
                        .sort((a, b) => parseInt(a) - parseInt(b))
                        .forEach((pertemuan, idx) => {
                            const section = createPertemuanSection(pertemuan, groupedData[pertemuan], idx);
                            container.appendChild(section);
                        });
                }

                // Populate filter dropdown
                const filterSelect = document.getElementById('filterPertemuan');
                // Clear existing (except first option)
                while (filterSelect.options.length > 1) {
                    filterSelect.remove(1);
                }
                
                Object.keys(groupedData)
                    .sort((a, b) => parseInt(a) - parseInt(b))
                    .forEach(pertemuan => {
                        const option = document.createElement('option');
                        option.value = pertemuan;
                        option.textContent = `Pertemuan ${pertemuan}`;
                        filterSelect.appendChild(option);
                    });

            } catch (error) {
                console.error('Error loading materi:', error);
                container.innerHTML = `
                    <div class="bg-red-50 border-2 border-red-200 rounded-lg p-6 text-center">
                        <p class="text-red-600 font-semibold">${error.message}</p>
                        <button onclick="location.reload()" class="mt-4 px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Coba Lagi
                        </button>
                    </div>
                `;
            }
        }

        // Update statistics
        function updateStats() {
            const totalMateri = materiData.length;
            const pdfCount = materiData.filter(m => m.file_path && m.file_path !== '').length;
            const videoCount = materiData.filter(m => !m.file_path || m.file_path === '').length;
            const pertemuanCount = new Set(materiData.map(m => m.pertemuan_ke)).size;

            document.getElementById('totalMateri').textContent = totalMateri;
            document.getElementById('pdfCount').textContent = pdfCount;
            document.getElementById('videoCount').textContent = videoCount;
            document.getElementById('pertemuanCount').textContent = pertemuanCount;
        }

        // Create pertemuan section HTML
        function createPertemuanSection(pertemuan, items, index) {
            const colors = ['pink', 'purple', 'blue', 'indigo'];
            const color = colors[index % colors.length];
            const colorMap = {
                pink: { from: 'from-pink-500 to-purple-600', bg: 'from-pink-50 to-purple-50', border: 'border-pink-100', text: 'text-pink-600' },
                purple: { from: 'from-purple-500 to-pink-600', bg: 'from-purple-50 to-pink-50', border: 'border-purple-100', text: 'text-purple-600' },
                blue: { from: 'from-blue-500 to-indigo-600', bg: 'from-blue-50 to-indigo-50', border: 'border-blue-100', text: 'text-blue-600' },
                indigo: { from: 'from-indigo-500 to-blue-600', bg: 'from-indigo-50 to-blue-50', border: 'border-indigo-100', text: 'text-indigo-600' }
            };
            const style = colorMap[color];

            const section = document.createElement('div');
            section.className = `bg-white rounded-xl shadow-lg border-2 ${style.border} overflow-hidden animate-fade-in`;
            section.style.animationDelay = `${index * 0.1}s`;

            // Header
            const header = document.createElement('div');
            header.className = `bg-gradient-to-r ${style.bg} px-6 py-4 border-b-2 ${style.border}`;
            header.innerHTML = `
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br ${style.from} rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                            ${pertemuan}
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Pertemuan ${pertemuan}</h3>
                            <p class="text-sm text-gray-600">${items.length} Materi</p>
                        </div>
                    </div>
                </div>
            `;
            section.appendChild(header);

            // Items
            const divider = document.createElement('div');
            divider.className = 'divide-y divide-gray-100';
            
            items.forEach(item => {
                const itemEl = createMateriItem(item, style);
                divider.appendChild(itemEl);
            });

            section.appendChild(divider);
            return section;
        }

        // Create materi item HTML
        function createMateriItem(item, style) {
            const div = document.createElement('div');
            div.className = `p-6 hover:bg-gray-50 transition-colors group`;
            div.setAttribute('data-materi-id', item.id_materi);
            div.setAttribute('data-pertemuan', item.pertemuan_ke);
            
            const hasFile = item.file_path && item.file_path !== '';
            const fileTypeBadge = hasFile ? `<span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full shadow-md">PDF</span>` : `<span class="px-3 py-1 bg-blue-700 text-white text-xs font-bold rounded-full shadow-md">LINK</span>`;
            
            const formattedDate = new Date(item.created_at).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });

            div.innerHTML = `
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm group-hover:shadow-md transition-shadow">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-1">${item.judul}</h4>
                                <p class="text-sm text-gray-600 mb-2">${item.deskripsi}</p>
                                <div class="flex items-center gap-4 text-xs text-gray-500">
                                    <span class="inline-flex items-center gap-1">
                                        ${hasFile ? '📁 File' : '🔗 Link'}
                                    </span>
                                    <span>${formattedDate}</span>
                                </div>
                            </div>
                            ${fileTypeBadge}
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="editMateri(${item.id_materi})" class="p-2 ${style.text} hover:bg-pink-50 rounded-lg transition-colors" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button onclick="deleteMateri(${item.id_materi})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            return div;
        }

        // Setup event listeners
        function setupEventListeners() {
            // Search
            document.getElementById('searchMateri').addEventListener('input', filterMateri);
            
            // Filter pertemuan
            document.getElementById('filterPertemuan').addEventListener('change', filterMateri);

            // Form submit
            document.getElementById('formTambahMateri').addEventListener('submit', handleFormSubmit);

            // Modal controls
            document.getElementById('modalTambahMateri').addEventListener('click', function(e) {
                if (e.target === this) closeTambahMateriModal();
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeTambahMateriModal();
            });

            // Drag & drop
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('fileInput');

            dropZone.addEventListener('click', () => fileInput.click());
            
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => dropZone.classList.add('drag-over'));
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => dropZone.classList.remove('drag-over'));
            });

            dropZone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                handleFileSelect();
            });

            fileInput.addEventListener('change', handleFileSelect);
        }

        // Handle file selection
        function handleFileSelect() {
            const fileInput = document.getElementById('fileInput');
            const file = fileInput.files[0];

            if (!file) return;

            // Validate file size (10MB)
            const maxSize = 10 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('File terlalu besar. Maksimal 10MB');
                fileInput.value = '';
                return;
            }

            // Show preview
            const filePreview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');

            fileName.textContent = file.name;
            fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            filePreview.classList.add('show');
        }

        // Filter materi
        function filterMateri() {
            const search = document.getElementById('searchMateri').value.toLowerCase();
            const pertemuan = document.getElementById('filterPertemuan').value;
            
            const items = document.querySelectorAll('[data-materi-id]');
            items.forEach(item => {
                let show = true;
                
                if (search) {
                    const judul = item.querySelector('h4').textContent.toLowerCase();
                    show = judul.includes(search);
                }
                
                if (show && pertemuan) {
                    show = item.dataset.pertemuan === pertemuan;
                }
                
                item.style.display = show ? '' : 'none';
            });
        }

        // Handle form submit
        async function handleFormSubmit(e) {
            e.preventDefault();

            const judul = document.getElementById('judulMateri').value;
            const deskripsi = document.getElementById('deskripsiMateri').value;
            const pertemuan = document.getElementById('pertemuanMateri').value;
            const fileInput = document.getElementById('fileInput');

            if (!fileInput.files[0] && !document.getElementById('videoLink').value) {
                alert('Silakan upload file atau masukkan link video');
                return;
            }

            const formData = new FormData();
            formData.append('id_kelas', idKelas);
            formData.append('judul', judul);
            formData.append('deskripsi', deskripsi);
            formData.append('pertemuan_ke', pertemuan);

            if (fileInput.files[0]) {
                formData.append('file', fileInput.files[0]);
            } else {
                formData.append('file_path', document.getElementById('videoLink').value);
            }

            try {
                const response = await apiFetch('../backend/materi/upload-materi.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (!response.ok || !result.success) {
                    throw new Error(result.message || 'Gagal upload materi');
                }

                showToast('Materi berhasil ditambahkan!');
                closeTambahMateriModal();
                await loadMateri();

            } catch (error) {
                console.error('Upload error:', error);
                alert('Error: ' + error.message);
            }
        }

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
            switchTab('pdf');
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
                tabVideo.className = 'flex-1 py-3 px-4 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg shadow-md transition-all';
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

        // Edit Materi
        async function editMateri(id) {
            const materi = materiData.find(m => m.id_materi === id);
            if (!materi) return;

            const newJudul = prompt('Edit Judul:', materi.judul);
            if (newJudul === null) return;

            try {
                const response = await apiFetch('../backend/materi/update-materi.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        id_materi: id,
                        judul: newJudul,
                        deskripsi: materi.deskripsi,
                        pertemuan_ke: materi.pertemuan_ke
                    })
                });

                const result = await response.json();
                if (!response.ok || !result.success) {
                    throw new Error(result.message || 'Gagal update materi');
                }

                showToast('Materi berhasil diupdate!');
                await loadMateri();

            } catch (error) {
                console.error('Edit error:', error);
                alert('Error: ' + error.message);
            }
        }

        // Delete Materi
        async function deleteMateri(id) {
            if (!confirm('Yakin ingin menghapus materi ini?')) return;

            try {
                const response = await apiFetch('../backend/materi/delete-materi.php', {
                    method: 'POST',
                    body: JSON.stringify({ id_materi: id })
                });

                const result = await response.json();
                if (!response.ok || !result.success) {
                    throw new Error(result.message || 'Gagal delete materi');
                }

                showToast('Materi berhasil dihapus!');
                await loadMateri();

            } catch (error) {
                console.error('Delete error:', error);
                alert('Error: ' + error.message);
            }
        }

        // Toast
        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }
    </script>

</body>
</html>
