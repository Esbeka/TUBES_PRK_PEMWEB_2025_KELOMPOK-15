<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule - KelasOnline</title>
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

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .calendar-day:hover {
            background: rgba(102, 126, 234, 0.1);
        }

        .calendar-day.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: bold;
        }

        .calendar-day.has-event::after {
            content: '';
            position: absolute;
            bottom: 8px;
            width: 6px;
            height: 6px;
            background: #ef4444;
            border-radius: 50%;
        }

        .time-slot {
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .time-slot:hover {
            border-left-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
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
                <a href="schedule-mahasiswa.php" class="menu-item active flex items-center gap-3 px-4 py-3 text-sm font-medium">
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
                    <p class="text-xs font-semibold text-purple-900 mb-1">📅 Today's Tasks</p>
                    <p class="text-xs text-purple-700">3 classes scheduled</p>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <!-- Header -->
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">My Schedule 📅</h2>
                    <p class="text-gray-500 text-sm mt-1">Manage your classes and activities</p>
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

            <div class="grid grid-cols-3 gap-6">
                <!-- Calendar Section -->
                <div class="col-span-2">
                    <!-- Mini Calendar -->
                    <div class="card-3d rounded-2xl p-6 shadow-lg border border-gray-100 mb-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Desember 2025</h3>
                            <div class="flex gap-2">
                                <button class="p-2 hover:bg-gray-100 rounded-lg">
                                    <i class="fas fa-chevron-left text-gray-600"></i>
                                </button>
                                <button class="p-2 hover:bg-gray-100 rounded-lg">
                                    <i class="fas fa-chevron-right text-gray-600"></i>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-7 gap-2 mb-4">
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">MIN</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">SEN</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">SEL</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">RAB</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">KAM</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">JUM</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">SAB</div>
                        </div>

                        <div class="grid grid-cols-7 gap-2">
                            <div class="calendar-day text-gray-400">1</div>
                            <div class="calendar-day text-gray-400">2</div>
                            <div class="calendar-day text-gray-400">3</div>
                            <div class="calendar-day text-gray-400">4</div>
                            <div class="calendar-day text-gray-400">5</div>
                            <div class="calendar-day text-gray-400">6</div>
                            <div class="calendar-day text-gray-400">7</div>
                            <div class="calendar-day active has-event">8</div>
                            <div class="calendar-day has-event">9</div>
                            <div class="calendar-day has-event">10</div>
                            <div class="calendar-day">11</div>
                            <div class="calendar-day has-event">12</div>
                            <div class="calendar-day">13</div>
                            <div class="calendar-day">14</div>
                            <div class="calendar-day has-event">15</div>
                            <div class="calendar-day">16</div>
                            <div class="calendar-day">17</div>
                            <div class="calendar-day has-event">18</div>
                            <div class="calendar-day">19</div>
                            <div class="calendar-day">20</div>
                            <div class="calendar-day">21</div>
                            <div class="calendar-day has-event">22</div>
                            <div class="calendar-day">23</div>
                            <div class="calendar-day">24</div>
                            <div class="calendar-day">25</div>
                            <div class="calendar-day">26</div>
                            <div class="calendar-day">27</div>
                            <div class="calendar-day">28</div>
                            <div class="calendar-day">29</div>
                            <div class="calendar-day">30</div>
                            <div class="calendar-day">31</div>
                        </div>
                    </div>

                    <!-- Today's Schedule -->
                    <div class="card-3d rounded-2xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Today's Schedule</h3>
                        
                        <div class="space-y-4">
                            <!-- Time Slot 1 -->
                            <div class="time-slot p-4 rounded-xl bg-gradient-to-r from-blue-50 to-cyan-50">
                                <div class="flex items-start gap-4">
                                    <div class="text-center">
                                        <div class="text-sm font-bold text-blue-600">08:00</div>
                                        <div class="text-xs text-gray-500">09:40</div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center text-xl">
                                                📚
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-800">Pemrograman Web</h4>
                                                <p class="text-xs text-gray-500">Dr. Budi Santoso</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3 text-xs text-gray-600">
                                            <span><i class="fas fa-map-marker-alt mr-1"></i> Ruang 301</span>
                                            <span><i class="fas fa-video mr-1"></i> Online Meeting</span>
                                        </div>
                                    </div>
                                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">
                                        Join
                                    </button>
                                </div>
                            </div>

                            <!-- Time Slot 2 -->
                            <div class="time-slot p-4 rounded-xl bg-gradient-to-r from-purple-50 to-pink-50">
                                <div class="flex items-start gap-4">
                                    <div class="text-center">
                                        <div class="text-sm font-bold text-purple-600">10:00</div>
                                        <div class="text-xs text-gray-500">11:40</div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center text-xl">
                                                🗄️
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-800">Basis Data</h4>
                                                <p class="text-xs text-gray-500">Prof. Dr. Siti Aminah</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3 text-xs text-gray-600">
                                            <span><i class="fas fa-map-marker-alt mr-1"></i> Ruang 205</span>
                                        </div>
                                    </div>
                                    <span class="badge-cute bg-purple-100 text-purple-600">Upcoming</span>
                                </div>
                            </div>

                            <!-- Time Slot 3 -->
                            <div class="time-slot p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50">
                                <div class="flex items-start gap-4">
                                    <div class="text-center">
                                        <div class="text-sm font-bold text-green-600">13:00</div>
                                        <div class="text-xs text-gray-500">14:40</div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center text-xl">
                                                🎨
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-800">UI/UX Design</h4>
                                                <p class="text-xs text-gray-500">Dr. Ahmad Rahman</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3 text-xs text-gray-600">
                                            <span><i class="fas fa-video mr-1"></i> Zoom Meeting</span>
                                        </div>
                                    </div>
                                    <span class="badge-cute bg-green-100 text-green-600">Later</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events Sidebar -->
                <div>
                    <!-- Quick Stats -->
                    <div class="card-3d rounded-2xl p-6 shadow-lg border border-gray-100 mb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">This Week</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-chalkboard text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">15</p>
                                        <p class="text-xs text-gray-500">Classes</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-tasks text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">8</p>
                                        <p class="text-xs text-gray-500">Assignments</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-check text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">3</p>
                                        <p class="text-xs text-gray-500">Exams</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Deadlines -->
                    <div class="card-3d rounded-2xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Upcoming Deadlines</h3>
                        <div class="space-y-3">
                            <div class="p-3 bg-red-50 rounded-xl border border-red-100">
                                <div class="flex items-center gap-2 mb-1">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                    <p class="text-sm font-semibold text-gray-800">Final Project</p>
                                </div>
                                <p class="text-xs text-gray-500 mb-1">Pemrograman Web</p>
                                <span class="badge-cute bg-red-100 text-red-600">Due in 2 days</span>
                            </div>

                            <div class="p-3 bg-orange-50 rounded-xl border border-orange-100">
                                <div class="flex items-center gap-2 mb-1">
                                    <i class="fas fa-clock text-orange-500"></i>
                                    <p class="text-sm font-semibold text-gray-800">Quiz Database</p>
                                </div>
                                <p class="text-xs text-gray-500 mb-1">Basis Data</p>
                                <span class="badge-cute bg-orange-100 text-orange-600">Due in 4 days</span>
                            </div>

                            <div class="p-3 bg-yellow-50 rounded-xl border border-yellow-100">
                                <div class="flex items-center gap-2 mb-1">
                                    <i class="fas fa-file-alt text-yellow-500"></i>
                                    <p class="text-sm font-semibold text-gray-800">Wireframe Design</p>
                                </div>
                                <p class="text-xs text-gray-500 mb-1">UI/UX Design</p>
                                <span class="badge-cute bg-yellow-100 text-yellow-600">Due in 1 week</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
