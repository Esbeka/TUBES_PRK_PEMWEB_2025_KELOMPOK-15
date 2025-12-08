<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress - KelasOnline</title>
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
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
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
            transition: width 1s ease;
        }

        .circular-progress {
            transform: rotate(-90deg);
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
                <a href="kelas-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-book"></i>
                    <span>My Classes</span>
                </a>
                <a href="progress-mahasiswa.php" class="menu-item active flex items-center gap-3 px-4 py-3 text-sm font-medium">
                    <i class="fas fa-chart-line"></i>
                    <span>Progress</span>
                </a>
                <a href="schedule-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-calendar"></i>
                    <span>Schedule</span>
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
                    <p class="text-xs font-semibold text-purple-900 mb-1">📊 Great Progress!</p>
                    <p class="text-xs text-purple-700">Keep learning every day</p>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <!-- Header -->
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">My Progress 📊</h2>
                    <p class="text-gray-500 text-sm mt-1">Track your learning journey</p>
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

            <div class="grid grid-cols-3 gap-6 mb-8">
                <!-- Overall Progress -->
                <div class="col-span-2">
                    <div class="card-3d rounded-2xl p-6 shadow-lg border border-gray-100 mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Overall Progress</h3>
                        
                        <div class="grid grid-cols-4 gap-4 mb-6">
                            <div class="text-center">
                                <div class="relative inline-flex items-center justify-center">
                                    <svg class="w-24 h-24 transform -rotate-90">
                                        <circle cx="48" cy="48" r="40" stroke="#e0e0e0" stroke-width="8" fill="none"/>
                                        <circle cx="48" cy="48" r="40" stroke="url(#gradient1)" stroke-width="8" fill="none" stroke-dasharray="251.2" stroke-dashoffset="62.8" stroke-linecap="round"/>
                                        <defs>
                                            <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" style="stop-color:#667eea"/>
                                                <stop offset="100%" style="stop-color:#764ba2"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <span class="absolute text-xl font-bold text-gray-800">75%</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2 font-semibold">Completed</p>
                            </div>

                            <div class="text-center">
                                <div class="relative inline-flex items-center justify-center">
                                    <svg class="w-24 h-24 transform -rotate-90">
                                        <circle cx="48" cy="48" r="40" stroke="#e0e0e0" stroke-width="8" fill="none"/>
                                        <circle cx="48" cy="48" r="40" stroke="url(#gradient2)" stroke-width="8" fill="none" stroke-dasharray="251.2" stroke-dashoffset="175.84" stroke-linecap="round"/>
                                        <defs>
                                            <linearGradient id="gradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" style="stop-color:#3b82f6"/>
                                                <stop offset="100%" style="stop-color:#06b6d4"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <span class="absolute text-xl font-bold text-gray-800">30%</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2 font-semibold">In Progress</p>
                            </div>

                            <div class="text-center">
                                <div class="w-20 h-20 mx-auto bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex flex-col items-center justify-center text-white mb-2">
                                    <p class="text-2xl font-bold">85</p>
                                    <p class="text-xs">Avg Score</p>
                                </div>
                                <p class="text-sm text-gray-600 font-semibold">Average</p>
                            </div>

                            <div class="text-center">
                                <div class="w-20 h-20 mx-auto bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex flex-col items-center justify-center text-white mb-2">
                                    <p class="text-2xl font-bold">245</p>
                                    <p class="text-xs">Hours</p>
                                </div>
                                <p class="text-sm text-gray-600 font-semibold">Study Time</p>
                            </div>
                        </div>
                    </div>

                    <!-- Course Progress -->
                    <div class="card-3d rounded-2xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Course Progress</h3>
                        
                        <div class="space-y-6">
                            <!-- Course 1 -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl flex items-center justify-center text-xl">
                                            📚
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Pemrograman Web</h4>
                                            <p class="text-xs text-gray-500">9 of 12 materials completed</p>
                                        </div>
                                    </div>
                                    <span class="badge-cute bg-yellow-100 text-yellow-600">75%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 75%"></div>
                                </div>
                            </div>

                            <!-- Course 2 -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center text-xl">
                                            🗄️
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Basis Data</h4>
                                            <p class="text-xs text-gray-500">6 of 10 materials completed</p>
                                        </div>
                                    </div>
                                    <span class="badge-cute bg-blue-100 text-blue-600">60%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 60%"></div>
                                </div>
                            </div>

                            <!-- Course 3 -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-pink-400 to-pink-600 rounded-xl flex items-center justify-center text-xl">
                                            🎨
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">UI/UX Design</h4>
                                            <p class="text-xs text-gray-500">4 of 8 materials completed</p>
                                        </div>
                                    </div>
                                    <span class="badge-cute bg-pink-100 text-pink-600">50%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 50%"></div>
                                </div>
                            </div>

                            <!-- Course 4 -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center text-xl">
                                            📱
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Mobile Apps Dev</h4>
                                            <p class="text-xs text-gray-500">4 of 14 materials completed</p>
                                        </div>
                                    </div>
                                    <span class="badge-cute bg-purple-100 text-purple-600">30%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 30%"></div>
                                </div>
                            </div>

                            <!-- Course 5 -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center text-xl">
                                            ✅
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Algoritma Pemrograman</h4>
                                            <p class="text-xs text-gray-500">16 of 16 materials completed</p>
                                        </div>
                                    </div>
                                    <span class="badge-cute bg-green-100 text-green-600">100%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Stats -->
                <div>
                    <!-- Achievements -->
                    <div class="card-3d rounded-2xl p-6 shadow-lg border border-gray-100 mb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Achievements 🏆</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 p-3 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-xl">
                                <div class="text-3xl">🥇</div>
                                <div>
                                    <p class="font-semibold text-sm text-gray-800">First Class Completed</p>
                                    <p class="text-xs text-gray-500">Algoritma Pemrograman</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl">
                                <div class="text-3xl">📚</div>
                                <div>
                                    <p class="font-semibold text-sm text-gray-800">Bookworm</p>
                                    <p class="text-xs text-gray-500">Read 50 materials</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl">
                                <div class="text-3xl">⚡</div>
                                <div>
                                    <p class="font-semibold text-sm text-gray-800">Quick Learner</p>
                                    <p class="text-xs text-gray-500">Completed 10 quizzes</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="card-3d rounded-2xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Activity</h3>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Quiz Completed</p>
                                    <p class="text-xs text-gray-500">Database Design - Score: 88</p>
                                    <p class="text-xs text-gray-400">2 hours ago</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Material Read</p>
                                    <p class="text-xs text-gray-500">Chapter 5: Normalization</p>
                                    <p class="text-xs text-gray-400">5 hours ago</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Assignment Submitted</p>
                                    <p class="text-xs text-gray-500">Wireframe Design Project</p>
                                    <p class="text-xs text-gray-400">1 day ago</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mt-2"></div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Class Joined</p>
                                    <p class="text-xs text-gray-500">Mobile Apps Development</p>
                                    <p class="text-xs text-gray-400">2 days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
