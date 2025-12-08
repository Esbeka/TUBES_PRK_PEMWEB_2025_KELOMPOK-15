<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Classes - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #d4c5f9 0%, #c5b8e8 100%);
            min-height: 100vh;
        }

        .card-3d {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .card-3d:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(0,0,0,0.05);
        }

        .menu-item {
            transition: all 0.3s ease;
            border-radius: 12px;
            margin: 4px 0;
        }

        .menu-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(8px);
        }

        .menu-item.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .badge-cute {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .illustration-box {
            width: 100%;
            height: 180px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            position: relative;
            overflow: hidden;
        }

        .illustration-box::before {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            top: -20px;
            right: -20px;
        }

        .progress-bar {
            height: 8px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        .notification-dot {
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            position: absolute;
            top: -2px;
            right: -2px;
            border: 2px solid white;
        }

        .search-box {
            background: white;
            border-radius: 16px;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .search-box input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 14px;
        }

        .filter-btn {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .filter-btn:hover, .filter-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-64 p-6 fixed h-full">
            <div class="mb-8">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    📚 KelasOnline
                </h1>
                <p class="text-xs text-gray-500 mt-1">Student Dashboard</p>
            </div>

            <nav class="space-y-2">
                <a href="dashboard-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="kelas-mahasiswa.php" class="menu-item active flex items-center gap-3 px-4 py-3 text-sm font-medium">
                    <i class="fas fa-book"></i>
                    <span>My Classes</span>
                </a>
                <a href="progress-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-chart-line"></i>
                    <span>Progress</span>
                </a>
                <a href="schedule-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-calendar"></i>
                    <span>Schedule</span>
                    <span class="notification-dot"></span>
                </a>
                <a href="assignments-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-file-alt"></i>
                    <span>Assignments</span>
                </a>
                <a href="profil.php" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </nav>

            <div class="mt-auto pt-8 absolute bottom-6 left-6 right-6">
                <div class="bg-gradient-to-r from-purple-100 to-pink-100 p-4 rounded-2xl">
                    <p class="text-xs font-semibold text-purple-900 mb-1">🎉 Keep Learning!</p>
                    <p class="text-xs text-purple-700">You're doing great</p>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <!-- Header -->
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">My Classes 📚</h2>
                    <p class="text-gray-500 text-sm mt-1">Manage and explore all your enrolled classes</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="relative p-3 bg-white rounded-full shadow-md hover:shadow-lg transition-all">
                        <i class="fas fa-bell text-gray-600"></i>
                        <span class="notification-dot"></span>
                    </button>
                    <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-full shadow-md">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold">
                            C
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">Cindy</p>
                            <p class="text-xs text-gray-500">Student</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Search & Filter -->
            <div class="mb-8">
                <div class="flex gap-4 mb-6">
                    <div class="search-box flex-1">
                        <i class="fas fa-search text-gray-400"></i>
                        <input type="text" placeholder="Search classes..." />
                    </div>
                    <button class="bg-white px-6 py-3 rounded-2xl shadow-md hover:shadow-lg transition-all">
                        <i class="fas fa-sliders-h text-purple-600"></i>
                    </button>
                </div>

                <div class="flex gap-3">
                    <button class="filter-btn active">All Classes</button>
                    <button class="filter-btn">In Progress</button>
                    <button class="filter-btn">Completed</button>
                    <button class="filter-btn">Upcoming</button>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                            📖
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-gray-800">12</h4>
                            <p class="text-xs text-gray-500">Total Kelas</p>
                        </div>
                    </div>
                </div>

                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center text-2xl">
                            ✅
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-gray-800">8</h4>
                            <p class="text-xs text-gray-500">Selesai</p>
                        </div>
                    </div>
                </div>

                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center text-2xl">
                            🎯
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-gray-800">3</h4>
                            <p class="text-xs text-gray-500">Aktif</p>
                        </div>
                    </div>
                </div>

                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center text-2xl">
                            ⏰
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-gray-800">1</h4>
                            <p class="text-xs text-gray-500">Upcoming</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Classes Grid -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Class Card 1 -->
                <div class="card-3d rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="illustration-box" style="background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);">
                        📚
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="badge-cute bg-yellow-100 text-yellow-600">In Progress</span>
                            <button class="text-gray-400 hover:text-purple-600">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg mb-2">Pemrograman Web</h4>
                        <p class="text-sm text-gray-500 mb-4">Dr. Budi Santoso, M.Kom</p>
                        
                        <div class="flex items-center gap-4 text-xs text-gray-600 mb-4">
                            <span><i class="fas fa-users mr-1"></i> 48 Students</span>
                            <span><i class="fas fa-book-open mr-1"></i> 12 Materi</span>
                        </div>

                        <div class="progress-bar mb-2">
                            <div class="progress-fill" style="width: 75%"></div>
                        </div>
                        <p class="text-xs text-gray-600 font-semibold mb-4">75% Complete</p>

                        <a href="detail-kelas-mahasiswa.php" class="block w-full text-center bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold py-3 rounded-xl transition-all">
                            Continue Learning →
                        </a>
                    </div>
                </div>

                <!-- Class Card 2 -->
                <div class="card-3d rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="illustration-box" style="background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);">
                        🗄️
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="badge-cute bg-blue-100 text-blue-600">In Progress</span>
                            <button class="text-gray-400 hover:text-purple-600">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg mb-2">Basis Data</h4>
                        <p class="text-sm text-gray-500 mb-4">Prof. Dr. Siti Aminah</p>
                        
                        <div class="flex items-center gap-4 text-xs text-gray-600 mb-4">
                            <span><i class="fas fa-users mr-1"></i> 52 Students</span>
                            <span><i class="fas fa-book-open mr-1"></i> 10 Materi</span>
                        </div>

                        <div class="progress-bar mb-2">
                            <div class="progress-fill" style="width: 60%"></div>
                        </div>
                        <p class="text-xs text-gray-600 font-semibold mb-4">60% Complete</p>

                        <a href="detail-kelas-mahasiswa.php" class="block w-full text-center bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold py-3 rounded-xl transition-all">
                            Continue Learning →
                        </a>
                    </div>
                </div>

                <!-- Class Card 3 -->
                <div class="card-3d rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="illustration-box" style="background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);">
                        🎨
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="badge-cute bg-pink-100 text-pink-600">In Progress</span>
                            <button class="text-gray-400 hover:text-purple-600">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg mb-2">UI/UX Design</h4>
                        <p class="text-sm text-gray-500 mb-4">Dr. Ahmad Rahman</p>
                        
                        <div class="flex items-center gap-4 text-xs text-gray-600 mb-4">
                            <span><i class="fas fa-users mr-1"></i> 38 Students</span>
                            <span><i class="fas fa-book-open mr-1"></i> 8 Materi</span>
                        </div>

                        <div class="progress-bar mb-2">
                            <div class="progress-fill" style="width: 45%"></div>
                        </div>
                        <p class="text-xs text-gray-600 font-semibold mb-4">45% Complete</p>

                        <a href="detail-kelas-mahasiswa.php" class="block w-full text-center bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold py-3 rounded-xl transition-all">
                            Continue Learning →
                        </a>
                    </div>
                </div>

                <!-- Class Card 4 -->
                <div class="card-3d rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="illustration-box" style="background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);">
                        📱
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="badge-cute bg-purple-100 text-purple-600">In Progress</span>
                            <button class="text-gray-400 hover:text-purple-600">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg mb-2">Mobile Apps Dev</h4>
                        <p class="text-sm text-gray-500 mb-4">Drs. Joko Widodo</p>
                        
                        <div class="flex items-center gap-4 text-xs text-gray-600 mb-4">
                            <span><i class="fas fa-users mr-1"></i> 45 Students</span>
                            <span><i class="fas fa-book-open mr-1"></i> 14 Materi</span>
                        </div>

                        <div class="progress-bar mb-2">
                            <div class="progress-fill" style="width: 30%"></div>
                        </div>
                        <p class="text-xs text-gray-600 font-semibold mb-4">30% Complete</p>

                        <a href="detail-kelas-mahasiswa.php" class="block w-full text-center bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold py-3 rounded-xl transition-all">
                            Continue Learning →
                        </a>
                    </div>
                </div>

                <!-- Class Card 5 -->
                <div class="card-3d rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="illustration-box" style="background: linear-gradient(135deg, #55efc4 0%, #00b894 100%);">
                        💻
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="badge-cute bg-green-100 text-green-600">Completed</span>
                            <button class="text-purple-600">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg mb-2">Algoritma Pemrograman</h4>
                        <p class="text-sm text-gray-500 mb-4">Dr. Rina Wijaya</p>
                        
                        <div class="flex items-center gap-4 text-xs text-gray-600 mb-4">
                            <span><i class="fas fa-users mr-1"></i> 60 Students</span>
                            <span><i class="fas fa-book-open mr-1"></i> 16 Materi</span>
                        </div>

                        <div class="progress-bar mb-2">
                            <div class="progress-fill" style="width: 100%"></div>
                        </div>
                        <p class="text-xs text-gray-600 font-semibold mb-4">100% Complete</p>

                        <a href="detail-kelas-mahasiswa.php" class="block w-full text-center bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-semibold py-3 rounded-xl transition-all">
                            Review Course →
                        </a>
                    </div>
                </div>

                <!-- Class Card 6 -->
                <div class="card-3d rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="illustration-box" style="background: linear-gradient(135deg, #fab1a0 0%, #ff7675 100%);">
                        🔒
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="badge-cute bg-red-100 text-red-600">Upcoming</span>
                            <button class="text-gray-400 hover:text-purple-600">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg mb-2">Keamanan Jaringan</h4>
                        <p class="text-sm text-gray-500 mb-4">Prof. Dr. Hendra Kusuma</p>
                        
                        <div class="flex items-center gap-4 text-xs text-gray-600 mb-4">
                            <span><i class="fas fa-users mr-1"></i> 35 Students</span>
                            <span><i class="fas fa-book-open mr-1"></i> 11 Materi</span>
                        </div>

                        <div class="progress-bar mb-2">
                            <div class="progress-fill" style="width: 0%"></div>
                        </div>
                        <p class="text-xs text-gray-600 font-semibold mb-4">Starts in 5 days</p>

                        <button class="block w-full text-center bg-gray-200 text-gray-500 font-semibold py-3 rounded-xl cursor-not-allowed">
                            Not Started Yet
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
