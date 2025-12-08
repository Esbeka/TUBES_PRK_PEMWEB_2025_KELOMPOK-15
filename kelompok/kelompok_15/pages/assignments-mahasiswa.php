<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments - KelasOnline</title>
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

        .tab-btn {
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .tab-btn:not(.active) {
            color: #6b7280;
        }

        .tab-btn:not(.active):hover {
            background: #f3f4f6;
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
                <a href="progress-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-chart-line"></i>
                    <span>Progress</span>
                </a>
                <a href="schedule-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600">
                    <i class="fas fa-calendar"></i>
                    <span>Schedule</span>
                </a>
                <a href="assignments-mahasiswa.php" class="menu-item active flex items-center gap-3 px-4 py-3 text-sm font-medium">
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
                    <p class="text-xs font-semibold text-purple-900 mb-1">📝 4 Pending Tasks</p>
                    <p class="text-xs text-purple-700">Keep up the good work!</p>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <!-- Header -->
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">My Assignments 📝</h2>
                    <p class="text-gray-500 text-sm mt-1">Track and manage all your assignments</p>
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

            <!-- Stats Cards -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                            📋
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-gray-800">12</h4>
                            <p class="text-xs text-gray-500">Total</p>
                        </div>
                    </div>
                </div>

                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center text-2xl">
                            ⏰
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-gray-800">4</h4>
                            <p class="text-xs text-gray-500">Pending</p>
                        </div>
                    </div>
                </div>

                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center text-2xl">
                            ✅
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-gray-800">7</h4>
                            <p class="text-xs text-gray-500">Completed</p>
                        </div>
                    </div>
                </div>

                <div class="card-3d p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-red-400 to-red-600 rounded-2xl flex items-center justify-center text-2xl">
                            ⚠️
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-gray-800">1</h4>
                            <p class="text-xs text-gray-500">Overdue</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex gap-3 mb-6">
                <button class="tab-btn active">All Assignments</button>
                <button class="tab-btn">Pending</button>
                <button class="tab-btn">Completed</button>
                <button class="tab-btn">Overdue</button>
            </div>

            <!-- Assignments List -->
            <div class="space-y-4">
                <!-- Assignment 1 - Overdue -->
                <div class="card-3d rounded-2xl p-6 shadow-lg border-l-4 border-red-500">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="w-16 h-16 bg-gradient-to-br from-red-400 to-red-600 rounded-2xl flex items-center justify-center text-2xl shrink-0">
                                📱
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-bold text-gray-800">App Prototype Design</h3>
                                    <span class="badge-cute bg-red-100 text-red-600">Overdue</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">Create mobile app prototype using Figma with at least 5 screens</p>
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <span><i class="fas fa-book mr-2"></i>Mobile Apps Dev</span>
                                    <span><i class="fas fa-user mr-2"></i>Drs. Joko Widodo</span>
                                    <span><i class="fas fa-calendar-times mr-2 text-red-500"></i>Was due 2 days ago</span>
                                </div>
                            </div>
                        </div>
                        <button class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition-all">
                            Submit Now
                        </button>
                    </div>
                </div>

                <!-- Assignment 2 - Due Soon -->
                <div class="card-3d rounded-2xl p-6 shadow-lg border-l-4 border-orange-500">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center text-2xl shrink-0">
                                📚
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-bold text-gray-800">Final Project Web Development</h3>
                                    <span class="badge-cute bg-orange-100 text-orange-600">Due in 2 days</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">Build a complete web application using HTML, CSS, JavaScript, and PHP</p>
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <span><i class="fas fa-book mr-2"></i>Pemrograman Web</span>
                                    <span><i class="fas fa-user mr-2"></i>Dr. Budi Santoso</span>
                                    <span><i class="fas fa-clock mr-2 text-orange-500"></i>Due: Dec 10, 2025</span>
                                </div>
                            </div>
                        </div>
                        <button class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold rounded-xl transition-all">
                            Start Now
                        </button>
                    </div>
                </div>

                <!-- Assignment 3 - Pending -->
                <div class="card-3d rounded-2xl p-6 shadow-lg border-l-4 border-blue-500">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center text-2xl shrink-0">
                                🗄️
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-bold text-gray-800">Database Design Quiz</h3>
                                    <span class="badge-cute bg-blue-100 text-blue-600">Due in 4 days</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">Multiple choice quiz about database normalization and ER diagram</p>
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <span><i class="fas fa-book mr-2"></i>Basis Data</span>
                                    <span><i class="fas fa-user mr-2"></i>Prof. Dr. Siti Aminah</span>
                                    <span><i class="fas fa-clock mr-2 text-blue-500"></i>Due: Dec 12, 2025</span>
                                </div>
                            </div>
                        </div>
                        <button class="px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold rounded-xl transition-all">
                            Take Quiz
                        </button>
                    </div>
                </div>

                <!-- Assignment 4 - Pending -->
                <div class="card-3d rounded-2xl p-6 shadow-lg border-l-4 border-purple-500">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center text-2xl shrink-0">
                                🎨
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-bold text-gray-800">Wireframe Design Project</h3>
                                    <span class="badge-cute bg-purple-100 text-purple-600">Due in 1 week</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">Design low-fidelity and high-fidelity wireframes for an e-commerce app</p>
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <span><i class="fas fa-book mr-2"></i>UI/UX Design</span>
                                    <span><i class="fas fa-user mr-2"></i>Dr. Ahmad Rahman</span>
                                    <span><i class="fas fa-clock mr-2 text-purple-500"></i>Due: Dec 15, 2025</span>
                                </div>
                            </div>
                        </div>
                        <button class="px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl border-2 border-gray-200 transition-all">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Assignment 5 - Completed -->
                <div class="card-3d rounded-2xl p-6 shadow-lg border-l-4 border-green-500 opacity-75">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center text-2xl shrink-0">
                                ✅
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-bold text-gray-800">Sorting Algorithm Analysis</h3>
                                    <span class="badge-cute bg-green-100 text-green-600">Completed</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">Write and analyze time complexity of various sorting algorithms</p>
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <span><i class="fas fa-book mr-2"></i>Algoritma Pemrograman</span>
                                    <span><i class="fas fa-user mr-2"></i>Dr. Rina Wijaya</span>
                                    <span><i class="fas fa-check-circle mr-2 text-green-500"></i>Submitted on Dec 1, 2025</span>
                                    <span class="badge-cute bg-green-100 text-green-600">Score: 95/100</span>
                                </div>
                            </div>
                        </div>
                        <button class="px-6 py-3 bg-green-100 text-green-600 font-semibold rounded-xl cursor-not-allowed">
                            <i class="fas fa-check mr-2"></i>Graded
                        </button>
                    </div>
                </div>

                <!-- Assignment 6 - Completed -->
                <div class="card-3d rounded-2xl p-6 shadow-lg border-l-4 border-green-500 opacity-75">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center text-2xl shrink-0">
                                ✅
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-bold text-gray-800">Midterm Exam Report</h3>
                                    <span class="badge-cute bg-green-100 text-green-600">Completed</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">Comprehensive database theory and SQL queries examination</p>
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <span><i class="fas fa-book mr-2"></i>Basis Data</span>
                                    <span><i class="fas fa-user mr-2"></i>Prof. Dr. Siti Aminah</span>
                                    <span><i class="fas fa-check-circle mr-2 text-green-500"></i>Submitted on Nov 28, 2025</span>
                                    <span class="badge-cute bg-green-100 text-green-600">Score: 88/100</span>
                                </div>
                            </div>
                        </div>
                        <button class="px-6 py-3 bg-green-100 text-green-600 font-semibold rounded-xl cursor-not-allowed">
                            <i class="fas fa-check mr-2"></i>Graded
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
