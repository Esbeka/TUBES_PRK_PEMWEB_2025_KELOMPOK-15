<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/notifications.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-blue-50 min-h-screen">

    <!-- Navbar dengan Notification Bell -->
    <nav class="bg-gradient-to-r from-blue-950 via-blue-800 to-blue-600 shadow-2xl sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-white p-2 rounded-lg shadow-lg">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">KelasOnline</h1>
                        <p class="text-blue-200 text-sm">Notifikasi</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    <!-- Notification Bell -->
                    <div class="notification-container">
                        <button id="notificationBell" class="relative text-white hover:text-blue-200 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="notification-badge" style="display: none;">0</span>
                        </button>
                        <!-- Dropdown will be injected here by JavaScript -->
                    </div>
                    
                    <!-- Profile -->
                    <div class="flex items-center space-x-3">
                        <img src="https://ui-avatars.com/api/?name=Cindy+Mahasiswa&background=3b82f6&color=fff&size=128" alt="Profile" class="w-10 h-10 rounded-full border-2 border-white shadow-lg">
                        <div class="text-right">
                            <p class="text-white font-semibold text-sm">Cindy</p>
                            <p class="text-blue-200 text-xs">NPM: 2115101015</p>
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
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Semua Notifikasi 🔔</h2>
            <p class="text-gray-600">Pantau semua notifikasi dan pembaruan Anda</p>
        </div>

        <!-- Filter Tabs -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
            <div class="flex items-center space-x-4 border-b-2 border-gray-100 pb-4">
                <button class="tab-button active" data-tab="all">
                    <span class="tab-text">Semua</span>
                    <span class="tab-badge">12</span>
                </button>
                <button class="tab-button" data-tab="unread">
                    <span class="tab-text">Belum Dibaca</span>
                    <span class="tab-badge">3</span>
                </button>
                <button class="tab-button" data-tab="read">
                    <span class="tab-text">Sudah Dibaca</span>
                    <span class="tab-badge">9</span>
                </button>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="space-y-4">
            
            <!-- Notification Group: Hari Ini -->
            <div>
                <h3 class="text-sm font-bold text-gray-600 mb-3 uppercase tracking-wider">Hari Ini</h3>
                
                <!-- Notification Card 1 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-4 border-l-4 border-blue-600 animate-fade-in hover:shadow-xl transition-all cursor-pointer">
                    <div class="flex items-start space-x-4">
                        <div class="bg-gradient-to-br from-blue-600 to-blue-500 p-3 rounded-xl shadow-lg flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="text-lg font-bold text-gray-800">Tugas Baru: REST API</h4>
                                <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full font-semibold">BARU</span>
                            </div>
                            <p class="text-gray-600 mb-3">Tugas "REST API Development" telah ditambahkan di kelas Pemrograman Web. Deadline: 15 Desember 2025, 23:59</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">📚 Pemrograman Web • 2 menit yang lalu</span>
                                <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">Lihat Detail →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification Card 2 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-4 border-l-4 border-green-600 animate-fade-in hover:shadow-xl transition-all cursor-pointer">
                    <div class="flex items-start space-x-4">
                        <div class="bg-gradient-to-br from-green-600 to-green-500 p-3 rounded-xl shadow-lg flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="text-lg font-bold text-gray-800">Tugas Dinilai</h4>
                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-semibold">BARU</span>
                            </div>
                            <p class="text-gray-600 mb-3">Tugas "Binary Tree Implementation" telah dinilai oleh Prof. Siti Rahayu. <span class="font-bold text-green-600">Nilai: 92/100</span></p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">📊 Struktur Data • 1 jam yang lalu</span>
                                <a href="#" class="text-green-600 hover:text-green-700 font-semibold text-sm">Lihat Feedback →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification Card 3 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-4 border-l-4 border-orange-600 animate-fade-in hover:shadow-xl transition-all cursor-pointer">
                    <div class="flex items-start space-x-4">
                        <div class="bg-gradient-to-br from-orange-600 to-orange-500 p-3 rounded-xl shadow-lg flex-shrink-0 relative">
                            <svg class="w-6 h-6 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="text-lg font-bold text-gray-800">⚠️ Deadline Reminder</h4>
                                <span class="bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full font-semibold animate-pulse">URGENT</span>
                            </div>
                            <p class="text-gray-600 mb-3">Tugas "Normalisasi Database" akan berakhir dalam <span class="font-bold text-orange-600">6 jam</span>. Segera submit sebelum deadline!</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">🗄️ Basis Data • 3 jam yang lalu</span>
                                <a href="#" class="text-orange-600 hover:text-orange-700 font-semibold text-sm">Upload Tugas →</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Notification Group: Kemarin -->
            <div>
                <h3 class="text-sm font-bold text-gray-600 mb-3 uppercase tracking-wider">Kemarin</h3>
                
                <!-- Notification Card 4 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-4 border-l-4 border-purple-600 animate-fade-in hover:shadow-xl transition-all cursor-pointer opacity-80">
                    <div class="flex items-start space-x-4">
                        <div class="bg-gradient-to-br from-purple-600 to-purple-500 p-3 rounded-xl shadow-lg flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-lg font-bold text-gray-800 mb-2">Materi Baru Ditambahkan</h4>
                            <p class="text-gray-600 mb-3">Materi "Pertemuan 12: RESTful API Best Practices" telah ditambahkan. 2 PDF dan 1 video tersedia.</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">📚 Pemrograman Web • Kemarin, 14:30</span>
                                <a href="#" class="text-purple-600 hover:text-purple-700 font-semibold text-sm">Buka Materi →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification Card 5 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-4 border-l-4 border-green-600 animate-fade-in hover:shadow-xl transition-all cursor-pointer opacity-80">
                    <div class="flex items-start space-x-4">
                        <div class="bg-gradient-to-br from-green-600 to-green-500 p-3 rounded-xl shadow-lg flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-lg font-bold text-gray-800 mb-2">Berhasil Join Kelas</h4>
                            <p class="text-gray-600 mb-3">Anda telah berhasil bergabung ke kelas "Pemrograman Web" dengan kode ABC123. Selamat belajar!</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">🎓 Sistem • Kemarin, 09:15</span>
                                <a href="#" class="text-green-600 hover:text-green-700 font-semibold text-sm">Lihat Kelas →</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Load More Button -->
        <div class="text-center mt-8">
            <button class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-8 py-3 rounded-xl hover:shadow-lg transition-all font-semibold">
                Muat Lebih Banyak
            </button>
        </div>

    </div>

    <!-- Scripts -->
    <script src="../assets/js/notifications.js"></script>
    <script>
        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                const tab = button.getAttribute('data-tab');
                console.log('Switching to tab:', tab);
                // Here you would filter notifications based on tab
            });
        });
    </script>

    <style>
        .tab-button {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 600;
            color: #6b7280;
        }

        .tab-button:hover {
            background: #f3f4f6;
            color: #1f2937;
        }

        .tab-button.active {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .tab-badge {
            background: rgba(0, 0, 0, 0.1);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
        }

        .tab-button.active .tab-badge {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>

</body>
</html>
