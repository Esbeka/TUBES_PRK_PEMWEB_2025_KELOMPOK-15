<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - KelasOnline</title>
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

        .hero-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 24px;
            position: relative;
            overflow: hidden;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .hero-banner::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .illustration-box {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
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

        .floating-icon {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
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
                <a href="#" class="menu-item active flex items-center gap-3 px-4 py-3 text-sm font-medium">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="kelas-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-book"></i>
                    <span>My Classes</span>
                </a>
                <a href="progress-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-chart-line"></i>
                    <span>Progress</span>
                </a>
                <a href="#" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-calendar"></i>
                    <span>Schedule</span>
                    <span class="notification-dot"></span>
                </a>
                <a href="#" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
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
                    <h2 class="text-3xl font-bold text-gray-800">Hi, Cindy! 👋</h2>
                    <p class="text-gray-500 text-sm mt-1">Welcome back, ready to learn today?</p>
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

            <!-- Hero Banner -->
            <div class="hero-banner p-8 mb-8 relative">
                <div class="relative z-10 flex justify-between items-center">
                    <div class="text-white">
                        <h3 class="text-2xl font-bold mb-2">Hi, Selamat Muhammad Ghozi!</h3>
                        <p class="text-purple-100 mb-4">Let's finish your goals & make your dream come true</p>
                        <button class="bg-white text-purple-600 px-6 py-2 rounded-full font-semibold hover:bg-purple-50 transition-all">
                            View Schedule →
                        </button>
                    </div>
                    <div class="text-8xl floating-icon">
                        📚
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center text-2xl">
                            📖
                        </div>
                        <span class="badge-cute bg-blue-100 text-blue-600">Active</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 mb-1">12</h4>
                    <p class="text-sm text-gray-500">Total Kelas</p>
                </div>

                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center text-2xl">
                            ✅
                        </div>
                        <span class="badge-cute bg-green-100 text-green-600">+2 Today</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 mb-1">8</h4>
                    <p class="text-sm text-gray-500">Tugas Selesai</p>
                </div>

                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl flex items-center justify-center text-2xl">
                            ⏰
                        </div>
                        <span class="badge-cute bg-orange-100 text-orange-600">Due Soon</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 mb-1">4</h4>
                    <p class="text-sm text-gray-500">Tugas Pending</p>
                </div>

                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center text-2xl">
                            ⭐
                        </div>
                        <span class="badge-cute bg-purple-100 text-purple-600">Great!</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 mb-1">85</h4>
                    <p class="text-sm text-gray-500">Rata-rata Nilai</p>
                </div>
            </div>

            <!-- Popular & Ongoing Classes -->
            <div class="grid grid-cols-2 gap-8 mb-8">
                <!-- Popular -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Popular</h3>
                        <a href="kelas-mahasiswa.php" class="text-sm text-purple-600 hover:text-purple-700 font-semibold">View all →</a>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="card-3d rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                            <div class="illustration-box" style="background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);">
                                📚
                            </div>
                            <div class="p-4">
                                <span class="badge-cute bg-yellow-100 text-yellow-600 mb-2">Popular</span>
                                <h4 class="font-bold text-gray-800 mb-1">Pemrograman Web</h4>
                                <p class="text-xs text-gray-500 mb-3">48 Students • 12 Materi</p>
                                <div class="progress-bar mb-2">
                                    <div class="progress-fill" style="width: 75%"></div>
                                </div>
                                <p class="text-xs text-gray-600 font-semibold">75% Complete</p>
                            </div>
                        </div>

                        <div class="card-3d rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                            <div class="illustration-box" style="background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);">
                                🗄️
                            </div>
                            <div class="p-4">
                                <span class="badge-cute bg-blue-100 text-blue-600 mb-2">Popular</span>
                                <h4 class="font-bold text-gray-800 mb-1">Basis Data</h4>
                                <p class="text-xs text-gray-500 mb-3">52 Students • 10 Materi</p>
                                <div class="progress-bar mb-2">
                                    <div class="progress-fill" style="width: 60%"></div>
                                </div>
                                <p class="text-xs text-gray-600 font-semibold">60% Complete</p>
                            </div>
                        </div>

                        <div class="card-3d rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                            <div class="illustration-box" style="background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);">
                                🎨
                            </div>
                            <div class="p-4">
                                <span class="badge-cute bg-pink-100 text-pink-600 mb-2">Trending</span>
                                <h4 class="font-bold text-gray-800 mb-1">UI/UX Design</h4>
                                <p class="text-xs text-gray-500 mb-3">38 Students • 8 Materi</p>
                                <div class="progress-bar mb-2">
                                    <div class="progress-fill" style="width: 45%"></div>
                                </div>
                                <p class="text-xs text-gray-600 font-semibold">45% Complete</p>
                            </div>
                        </div>

                        <div class="card-3d rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                            <div class="illustration-box" style="background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);">
                                📱
                            </div>
                            <div class="p-4">
                                <span class="badge-cute bg-purple-100 text-purple-600 mb-2">New</span>
                                <h4 class="font-bold text-gray-800 mb-1">Mobile Apps</h4>
                                <p class="text-xs text-gray-500 mb-3">45 Students • 14 Materi</p>
                                <div class="progress-bar mb-2">
                                    <div class="progress-fill" style="width: 30%"></div>
                                </div>
                                <p class="text-xs text-gray-600 font-semibold">30% Complete</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ongoing -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Ongoing</h3>
                        <a href="#" class="text-sm text-purple-600 hover:text-purple-700 font-semibold">See all activity →</a>
                    </div>
                    <div class="card-3d rounded-2xl p-6 shadow-lg border border-gray-100">
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                                    📝
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 text-sm">Tugas Final Project</h4>
                                    <p class="text-xs text-gray-500">Pemrograman Web</p>
                                </div>
                                <span class="badge-cute bg-orange-100 text-orange-600">Due 2 days</span>
                            </div>

                            <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                                    🎯
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 text-sm">Quiz Database</h4>
                                    <p class="text-xs text-gray-500">Basis Data</p>
                                </div>
                                <span class="badge-cute bg-blue-100 text-blue-600">In Progress</span>
                            </div>

                            <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                                    ✅
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 text-sm">Design Wireframe</h4>
                                    <p class="text-xs text-gray-500">UI/UX Design</p>
                                </div>
                                <span class="badge-cute bg-green-100 text-green-600">Completed</span>
                            </div>

                            <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-pink-50 to-rose-50 rounded-xl">
                                <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-pink-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                                    📱
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 text-sm">App Prototype</h4>
                                    <p class="text-xs text-gray-500">Mobile Apps</p>
                                </div>
                                <span class="badge-cute bg-red-100 text-red-600">Overdue</span>
                            </div>

                            <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-xl">
                                <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                                    💡
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 text-sm">Research Paper</h4>
                                    <p class="text-xs text-gray-500">Metodologi Penelitian</p>
                                </div>
                                <span class="badge-cute bg-yellow-100 text-yellow-600">Starting</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
