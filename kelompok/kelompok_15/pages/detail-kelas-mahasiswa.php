<?php
// Ambil ID kelas dari URL parameter
$kelas_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Data kelas berdasarkan ID (sesuai dengan dashboard)
$kelas_data = [
    1 => [
        'nama' => 'Pemrograman Web',
        'kode' => 'KOM123',
        'kode_kelas' => 'ABC123',
        'dosen' => 'Prof. Dr. Budi Santoso',
        'semester' => 'Semester 5',
        'tahun' => '2024/2025',
        'kelas' => 'TI2021A',
        'deskripsi' => 'Mata kuliah ini membahas tentang pengembangan website modern menggunakan HTML5, CSS3, JavaScript, dan PHP Native. Mahasiswa akan belajar membuat website dinamis, responsif, dan interaktif.',
        'mahasiswa' => 45,
        'materi' => 24,
        'tugas' => 12,
        'jadwal' => 'Senin, 08:00 - 10:30 WIB',
        'ruangan' => 'Lab Komputer 2 (Gedung H Lantai 3)',
        'warna' => 'purple',
        'warna_from' => 'purple-600',
        'warna_to' => 'purple-400',
        'initial' => 'BS',
        'initial_bg' => 'purple-600'
    ],
    2 => [
        'nama' => 'Basis Data',
        'kode' => 'KOM201',
        'kode_kelas' => 'DEF456',
        'dosen' => 'Dr. Siti Nurhaliza',
        'semester' => 'Semester 5',
        'tahun' => '2024/2025',
        'kelas' => 'TI2021A',
        'deskripsi' => 'Mata kuliah ini membahas konsep database relasional, SQL, normalisasi, dan implementasi sistem basis data menggunakan MySQL. Mahasiswa akan belajar merancang dan mengelola database yang efisien.',
        'mahasiswa' => 42,
        'materi' => 20,
        'tugas' => 10,
        'jadwal' => 'Selasa, 10:00 - 12:30 WIB',
        'ruangan' => 'Lab Database (Gedung H Lantai 2)',
        'warna' => 'pink',
        'warna_from' => 'pink-600',
        'warna_to' => 'pink-400',
        'initial' => 'SN',
        'initial_bg' => 'pink-600'
    ],
    3 => [
        'nama' => 'Struktur Data',
        'kode' => 'KOM202',
        'kode_kelas' => 'GHI789',
        'dosen' => 'Dr. Ahmad Wijaya',
        'semester' => 'Semester 5',
        'tahun' => '2024/2025',
        'kelas' => 'TI2021A',
        'deskripsi' => 'Mata kuliah ini membahas struktur data fundamental seperti array, linked list, stack, queue, tree, dan graph. Mahasiswa akan mempelajari implementasi dan analisis kompleksitas algoritma.',
        'mahasiswa' => 40,
        'materi' => 22,
        'tugas' => 11,
        'jadwal' => 'Rabu, 13:00 - 15:30 WIB',
        'ruangan' => 'Ruang Kelas 301 (Gedung F Lantai 3)',
        'warna' => 'blue',
        'warna_from' => 'blue-600',
        'warna_to' => 'blue-400',
        'initial' => 'AW',
        'initial_bg' => 'blue-600'
    ],
    4 => [
        'nama' => 'Jaringan Komputer',
        'kode' => 'KOM301',
        'kode_kelas' => 'JKL012',
        'dosen' => 'Prof. Joko Susilo',
        'semester' => 'Semester 5',
        'tahun' => '2024/2025',
        'kelas' => 'TI2021A',
        'deskripsi' => 'Mata kuliah ini membahas konsep jaringan komputer, protokol TCP/IP, routing, switching, dan keamanan jaringan. Mahasiswa akan belajar konfigurasi dan troubleshooting jaringan.',
        'mahasiswa' => 38,
        'materi' => 18,
        'tugas' => 9,
        'jadwal' => 'Kamis, 08:00 - 10:30 WIB',
        'ruangan' => 'Lab Jaringan (Gedung H Lantai 4)',
        'warna' => 'green',
        'warna_from' => 'green-600',
        'warna_to' => 'green-400',
        'initial' => 'JS',
        'initial_bg' => 'green-600'
    ],
    5 => [
        'nama' => 'Sistem Operasi',
        'kode' => 'KOM302',
        'kode_kelas' => 'MNO345',
        'dosen' => 'Dr. Rina Kusuma',
        'semester' => 'Semester 5',
        'tahun' => '2024/2025',
        'kelas' => 'TI2021A',
        'deskripsi' => 'Mata kuliah ini membahas konsep sistem operasi, manajemen proses, memori, file system, dan virtualisasi. Mahasiswa akan mempelajari cara kerja sistem operasi Linux dan Windows.',
        'mahasiswa' => 36,
        'materi' => 19,
        'tugas' => 8,
        'jadwal' => 'Jumat, 10:00 - 12:30 WIB',
        'ruangan' => 'Lab Sistem (Gedung H Lantai 3)',
        'warna' => 'indigo',
        'warna_from' => 'indigo-600',
        'warna_to' => 'indigo-400',
        'initial' => 'RK',
        'initial_bg' => 'indigo-600'
    ],
    6 => [
        'nama' => 'Matematika Diskrit',
        'kode' => 'MTK201',
        'kode_kelas' => 'PQR678',
        'dosen' => 'Prof. Hadi Wijaya',
        'semester' => 'Semester 4',
        'tahun' => '2023/2024',
        'kelas' => 'TI2021A',
        'deskripsi' => 'Mata kuliah ini membahas logika matematika, teori himpunan, kombinatorik, graph theory, dan matematika diskrit lainnya yang penting untuk ilmu komputer.',
        'mahasiswa' => 44,
        'materi' => 16,
        'tugas' => 7,
        'jadwal' => 'Senin, 13:00 - 15:30 WIB',
        'ruangan' => 'Ruang Kelas 201 (Gedung F Lantai 2)',
        'warna' => 'orange',
        'warna_from' => 'orange-600',
        'warna_to' => 'orange-400',
        'initial' => 'HW',
        'initial_bg' => 'orange-600'
    ],
    7 => [
        'nama' => 'Keamanan Informasi',
        'kode' => 'KOM401',
        'kode_kelas' => 'STU901',
        'dosen' => 'Dr. Lisa Hartono',
        'semester' => 'Semester 7',
        'tahun' => '2023/2024',
        'kelas' => 'TI2020A',
        'deskripsi' => 'Mata kuliah ini membahas keamanan sistem informasi, kriptografi, ethical hacking, dan cyber security. Mahasiswa akan belajar mengidentifikasi dan mengatasi ancaman keamanan.',
        'mahasiswa' => 32,
        'materi' => 15,
        'tugas' => 6,
        'jadwal' => 'Selasa, 13:00 - 15:30 WIB',
        'ruangan' => 'Lab Security (Gedung H Lantai 4)',
        'warna' => 'teal',
        'warna_from' => 'teal-600',
        'warna_to' => 'teal-400',
        'initial' => 'LH',
        'initial_bg' => 'teal-600'
    ],
    8 => [
        'nama' => 'Machine Learning',
        'kode' => 'KOM501',
        'kode_kelas' => 'VWX234',
        'dosen' => 'Dr. Andi Prabowo',
        'semester' => 'Semester 7',
        'tahun' => '2023/2024',
        'kelas' => 'TI2020A',
        'deskripsi' => 'Mata kuliah ini membahas konsep machine learning, supervised learning, unsupervised learning, dan deep learning. Mahasiswa akan belajar implementasi model ML menggunakan Python.',
        'mahasiswa' => 30,
        'materi' => 17,
        'tugas' => 8,
        'jadwal' => 'Rabu, 10:00 - 12:30 WIB',
        'ruangan' => 'Lab AI (Gedung H Lantai 5)',
        'warna' => 'yellow',
        'warna_from' => 'yellow-600',
        'warna_to' => 'amber-400',
        'initial' => 'AP',
        'initial_bg' => 'amber-600'
    ],
    9 => [
        'nama' => 'Cloud Computing',
        'kode' => 'KOM502',
        'kode_kelas' => 'YZA567',
        'dosen' => 'Prof. Maya Sari',
        'semester' => 'Semester 7',
        'tahun' => '2023/2024',
        'kelas' => 'TI2020A',
        'deskripsi' => 'Mata kuliah ini membahas konsep cloud computing, layanan AWS, Azure, Google Cloud, dan deployment aplikasi di cloud. Mahasiswa akan belajar merancang arsitektur cloud.',
        'mahasiswa' => 28,
        'materi' => 14,
        'tugas' => 7,
        'jadwal' => 'Kamis, 13:00 - 15:30 WIB',
        'ruangan' => 'Lab Cloud (Gedung H Lantai 5)',
        'warna' => 'cyan',
        'warna_from' => 'cyan-600',
        'warna_to' => 'cyan-400',
        'initial' => 'MS',
        'initial_bg' => 'cyan-600'
    ],
    10 => [
        'nama' => 'Mobile Programming',
        'kode' => 'KOM402',
        'kode_kelas' => 'BCD890',
        'dosen' => 'Dr. Rudi Hartono',
        'semester' => 'Semester 7',
        'tahun' => '2023/2024',
        'kelas' => 'TI2020A',
        'deskripsi' => 'Mata kuliah ini membahas pengembangan aplikasi mobile untuk Android dan iOS menggunakan Flutter dan React Native. Mahasiswa akan belajar membuat aplikasi mobile yang responsif.',
        'mahasiswa' => 35,
        'materi' => 16,
        'tugas' => 9,
        'jadwal' => 'Jumat, 08:00 - 10:30 WIB',
        'ruangan' => 'Lab Mobile (Gedung H Lantai 4)',
        'warna' => 'lime',
        'warna_from' => 'lime-600',
        'warna_to' => 'lime-400',
        'initial' => 'RH',
        'initial_bg' => 'lime-700'
    ],
    11 => [
        'nama' => 'Data Mining',
        'kode' => 'KOM503',
        'kode_kelas' => 'EFG123',
        'dosen' => 'Prof. Nina Putri',
        'semester' => 'Semester 7',
        'tahun' => '2023/2024',
        'kelas' => 'TI2020A',
        'deskripsi' => 'Mata kuliah ini membahas teknik data mining, clustering, classification, dan pattern recognition. Mahasiswa akan belajar mengekstrak informasi dari big data.',
        'mahasiswa' => 27,
        'materi' => 13,
        'tugas' => 6,
        'jadwal' => 'Senin, 10:00 - 12:30 WIB',
        'ruangan' => 'Lab Data (Gedung H Lantai 5)',
        'warna' => 'rose',
        'warna_from' => 'rose-600',
        'warna_to' => 'rose-400',
        'initial' => 'NP',
        'initial_bg' => 'rose-600'
    ],
    12 => [
        'nama' => 'Kecerdasan Buatan',
        'kode' => 'KOM504',
        'kode_kelas' => 'HIJ456',
        'dosen' => 'Dr. Faisal Akbar',
        'semester' => 'Semester 7',
        'tahun' => '2023/2024',
        'kelas' => 'TI2020A',
        'deskripsi' => 'Mata kuliah ini membahas konsep kecerdasan buatan, search algorithms, game theory, dan expert systems. Mahasiswa akan belajar membangun sistem AI yang cerdas.',
        'mahasiswa' => 29,
        'materi' => 15,
        'tugas' => 7,
        'jadwal' => 'Selasa, 08:00 - 10:30 WIB',
        'ruangan' => 'Lab AI (Gedung H Lantai 5)',
        'warna' => 'violet',
        'warna_from' => 'violet-600',
        'warna_to' => 'violet-400',
        'initial' => 'FA',
        'initial_bg' => 'violet-600'
    ]
];

// Ambil data kelas yang dipilih, default ke kelas 1 jika tidak ada
$kelas = isset($kelas_data[$kelas_id]) ? $kelas_data[$kelas_id] : $kelas_data[1];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas - <?php echo $kelas['nama']; ?> - KelasOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        .animate-slide-in { animation: slideIn 0.6s ease-out; }
        .countdown-urgent { animation: pulse 1.5s ease-in-out infinite; }
        .tab-active { 
            border-bottom: 3px solid currentColor;
            font-weight: bold;
        }
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .accordion-content.active {
            max-height: 2000px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md shadow-lg border-b border-blue-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-<?php echo $kelas['warna_from']; ?> to-<?php echo $kelas['warna_to']; ?> rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">KelasOnline</h1>
                        <p class="text-xs text-gray-500">Dashboard Mahasiswa</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="dashboard-mahasiswa.php" class="text-gray-600 hover:text-blue-600 font-medium text-sm">← Kembali ke Dashboard</a>
                    <button class="p-2 hover:bg-blue-50 rounded-lg transition-colors relative">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-600 rounded-full"></span>
                    </button>
                    <div class="relative">
                        <button class="w-10 h-10 bg-gradient-to-br from-blue-800 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold shadow-lg hover:shadow-xl transition-shadow">
                            M
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header Kelas -->
        <div class="bg-gradient-to-r from-<?php echo $kelas['warna_from']; ?> to-<?php echo $kelas['warna_to']; ?> rounded-xl shadow-xl p-8 mb-8 text-white animate-fade-in">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <h2 class="text-3xl font-bold"><?php echo $kelas['nama']; ?></h2>
                        <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-sm font-bold rounded-full"><?php echo $kelas['kelas']; ?></span>
                    </div>
                    <p class="text-white/90 text-lg mb-4"><?php echo $kelas['kode']; ?> • <?php echo $kelas['semester']; ?> • <?php echo $kelas['tahun']; ?></p>
                    
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-<?php echo $kelas['initial_bg']; ?> to-<?php echo str_replace('600', '400', $kelas['initial_bg']); ?> rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                            <?php echo $kelas['initial']; ?>
                        </div>
                        <div>
                            <p class="font-semibold text-lg"><?php echo $kelas['dosen']; ?></p>
                            <p class="text-white/80 text-sm">Dosen Pengampu</p>
                        </div>
                    </div>

                    <p class="text-white/90 leading-relaxed max-w-3xl">
                        <?php echo $kelas['deskripsi']; ?>
                    </p>
                </div>

                <div class="flex flex-col gap-3">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center min-w-[120px]">
                        <p class="text-3xl font-bold"><?php echo $kelas['mahasiswa']; ?></p>
                        <p class="text-white/80 text-sm">Mahasiswa</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                        <p class="text-3xl font-bold"><?php echo $kelas['materi']; ?></p>
                        <p class="text-white/80 text-sm">Materi</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                        <p class="text-3xl font-bold"><?php echo $kelas['tugas']; ?></p>
                        <p class="text-white/80 text-sm">Tugas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="bg-white rounded-xl shadow-lg mb-8 animate-slide-in">
            <div class="border-b border-gray-200">
                <div class="flex">
                    <button onclick="switchTab('info')" id="tab-info" class="flex-1 px-6 py-4 text-gray-600 hover:text-blue-600 transition-colors">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Info Kelas
                        </div>
                    </button>
                    <button onclick="switchTab('materi')" id="tab-materi" class="flex-1 px-6 py-4 text-gray-600 hover:text-blue-600 transition-colors tab-active">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Materi
                        </div>
                    </button>
                    <button onclick="switchTab('tugas')" id="tab-tugas" class="flex-1 px-6 py-4 text-gray-600 hover:text-blue-600 transition-colors">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Tugas
                        </div>
                    </button>
                    <button onclick="switchTab('nilai')" id="tab-nilai" class="flex-1 px-6 py-4 text-gray-600 hover:text-blue-600 transition-colors">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Nilai
                        </div>
                    </button>
                </div>
            </div>

            <!-- Tab Content: Info Kelas -->
            <div id="content-info" class="p-6 hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Kelas</h3>
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm font-semibold text-gray-600 mb-1">Kode Kelas</p>
                        <p class="text-lg font-bold text-<?php echo $kelas['warna']; ?>-600"><?php echo $kelas['kode_kelas']; ?></p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm font-semibold text-gray-600 mb-1">Jadwal</p>
                        <p class="text-lg text-gray-800"><?php echo $kelas['jadwal']; ?></p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm font-semibold text-gray-600 mb-1">Ruangan</p>
                        <p class="text-lg text-gray-800"><?php echo $kelas['ruangan']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Materi -->
            <div id="content-materi" class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Materi Pembelajaran</h3>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-red-500 rounded"></div>
                            <span class="text-sm text-gray-600">PDF</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-purple-500 rounded"></div>
                            <span class="text-sm text-gray-600">Video</span>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="bg-<?php echo $kelas['warna']; ?>-50 rounded-lg p-4 mb-6 border border-<?php echo $kelas['warna']; ?>-200">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-semibold text-<?php echo $kelas['warna']; ?>-900">Progress Materi</p>
                        <p class="text-sm font-bold text-<?php echo $kelas['warna']; ?>-600">18 / <?php echo $kelas['materi']; ?> Materi (75%)</p>
                    </div>
                    <div class="w-full bg-<?php echo $kelas['warna']; ?>-200 rounded-full h-3 overflow-hidden shadow-inner">
                        <div class="bg-gradient-to-r from-<?php echo $kelas['warna_from']; ?> to-<?php echo $kelas['warna_to']; ?> h-3 rounded-full shadow-sm" style="width: 75%"></div>
                    </div>
                </div>

                <!-- Materi List by Pertemuan -->
                <div class="space-y-4">
                    
                    <!-- Pertemuan 1 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <button onclick="toggleAccordion('pertemuan1')" class="w-full bg-gradient-to-r from-<?php echo $kelas['warna']; ?>-50 to-white hover:from-<?php echo $kelas['warna']; ?>-100 hover:to-<?php echo $kelas['warna']; ?>-50 px-6 py-4 flex items-center justify-between transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-<?php echo $kelas['warna_from']; ?> to-<?php echo $kelas['warna_to']; ?> rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                                    1
                                </div>
                                <div class="text-left">
                                    <h4 class="text-lg font-bold text-gray-800">Pertemuan 1</h4>
                                    <p class="text-sm text-gray-600">Pengenalan <?php echo $kelas['nama']; ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="px-3 py-1 bg-<?php echo $kelas['warna']; ?>-100 text-<?php echo $kelas['warna']; ?>-700 text-xs font-bold rounded-full">3 Materi</span>
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="pertemuan1" class="accordion-content active">
                            <div class="p-6 bg-gray-50 space-y-3">
                                
                                <!-- Materi 1 - PDF -->
                                <div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start gap-4 flex-1">
                                            <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-400 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <h5 class="text-base font-bold text-gray-800">Slide Pengenalan Web Development</h5>
                                                    <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs font-bold rounded">PDF</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-2">Overview tentang web development, teknologi yang digunakan, dan roadmap pembelajaran.</p>
                                                <div class="flex items-center gap-4 text-xs text-gray-500">
                                                    <span>2.4 MB</span>
                                                    <span>•</span>
                                                    <span>Diupload 2 hari yang lalu</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button onclick="downloadMateri(1)" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-all text-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            Download
                                        </button>
                                    </div>
                                </div>

                                <!-- Materi 2 - Video -->
                                <div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start gap-4 flex-1">
                                            <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-400 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <h5 class="text-base font-bold text-gray-800">Tutorial HTML Dasar</h5>
                                                    <span class="px-2 py-0.5 bg-purple-100 text-purple-700 text-xs font-bold rounded">VIDEO</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-2">Video tutorial lengkap tentang HTML dasar: tag, atribut, struktur halaman web.</p>
                                                <div class="flex items-center gap-4 text-xs text-gray-500">
                                                    <span>28:45 menit</span>
                                                    <span>•</span>
                                                    <span>YouTube</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button onclick="playVideo('https://www.youtube.com/embed/dQw4w9WgXcQ', 'Tutorial HTML Dasar')" class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-700 hover:to-purple-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-all text-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Play Video
                                        </button>
                                    </div>
                                </div>

                                <!-- Materi 3 - PDF -->
                                <div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start gap-4 flex-1">
                                            <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-400 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <h5 class="text-base font-bold text-gray-800">Latihan HTML - Form & Table</h5>
                                                    <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs font-bold rounded">PDF</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-2">Soal latihan membuat form dan tabel HTML dengan berbagai atribut.</p>
                                                <div class="flex items-center gap-4 text-xs text-gray-500">
                                                    <span>1.8 MB</span>
                                                    <span>•</span>
                                                    <span>Diupload 2 hari yang lalu</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button onclick="downloadMateri(3)" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-all text-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            Download
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Pertemuan 2 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <button onclick="toggleAccordion('pertemuan2')" class="w-full bg-gradient-to-r from-green-50 to-white hover:from-green-100 hover:to-green-50 px-6 py-4 flex items-center justify-between transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-400 rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                                    2
                                </div>
                                <div class="text-left">
                                    <h4 class="text-lg font-bold text-gray-800">Pertemuan 2</h4>
                                    <p class="text-sm text-gray-600">CSS Fundamentals & Styling</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">4 Materi</span>
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="pertemuan2" class="accordion-content">
                            <div class="p-6 bg-gray-50 space-y-3">
                                
                                <!-- Materi CSS 1 -->
                                <div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start gap-4 flex-1">
                                            <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-400 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <h5 class="text-base font-bold text-gray-800">CSS Selector & Properties</h5>
                                                    <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs font-bold rounded">PDF</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-2">Penjelasan lengkap tentang CSS selector, properties, dan penggunaannya.</p>
                                                <div class="flex items-center gap-4 text-xs text-gray-500">
                                                    <span>3.2 MB</span>
                                                    <span>•</span>
                                                    <span>Diupload 5 hari yang lalu</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button onclick="downloadMateri(4)" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-all text-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            Download
                                        </button>
                                    </div>
                                </div>

                                <!-- Materi CSS 2 - Video -->
                                <div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start gap-4 flex-1">
                                            <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-400 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <h5 class="text-base font-bold text-gray-800">CSS Flexbox Complete Guide</h5>
                                                    <span class="px-2 py-0.5 bg-purple-100 text-purple-700 text-xs font-bold rounded">VIDEO</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-2">Panduan lengkap CSS Flexbox untuk membuat layout responsif.</p>
                                                <div class="flex items-center gap-4 text-xs text-gray-500">
                                                    <span>42:30 menit</span>
                                                    <span>•</span>
                                                    <span>YouTube</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button onclick="playVideo('https://www.youtube.com/embed/dQw4w9WgXcQ', 'CSS Flexbox Complete Guide')" class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-700 hover:to-purple-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-all text-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Play Video
                                        </button>
                                    </div>
                                </div>

                                <!-- More materials... -->
                                <div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start gap-4 flex-1">
                                            <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-400 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <h5 class="text-base font-bold text-gray-800">CSS Grid Layout System</h5>
                                                    <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs font-bold rounded">PDF</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-2">Materi CSS Grid untuk membuat layout 2 dimensi yang kompleks.</p>
                                                <div class="flex items-center gap-4 text-xs text-gray-500">
                                                    <span>2.8 MB</span>
                                                    <span>•</span>
                                                    <span>Diupload 5 hari yang lalu</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button onclick="downloadMateri(6)" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-all text-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            Download
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Pertemuan 3 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <button onclick="toggleAccordion('pertemuan3')" class="w-full bg-gradient-to-r from-purple-50 to-white hover:from-purple-100 hover:to-purple-50 px-6 py-4 flex items-center justify-between transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-400 rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                                    3
                                </div>
                                <div class="text-left">
                                    <h4 class="text-lg font-bold text-gray-800">Pertemuan 3</h4>
                                    <p class="text-sm text-gray-600">JavaScript Fundamentals</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-full">5 Materi</span>
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="pertemuan3" class="accordion-content">
                            <div class="p-6 bg-gray-50 space-y-3">
                                <div class="text-center py-8 text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="font-semibold">Materi Pertemuan 3 akan tersedia minggu depan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Tab Content: Tugas -->
            <div id="content-tugas" class="p-6 hidden">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Daftar Tugas</h3>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-red-600 rounded-full"></div>
                            <span class="text-sm text-gray-600">Urgent</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-green-600 rounded-full"></div>
                            <span class="text-sm text-gray-600">Aktif</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                            <span class="text-sm text-gray-600">Expired</span>
                        </div>
                    </div>
                </div>

                <!-- Progress Overview -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-4 mb-6 border border-blue-200">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-semibold text-blue-900">Progress Tugas Kelas Ini</p>
                        <p class="text-sm font-bold text-blue-600">8 / 12 Tugas (67%)</p>
                    </div>
                    <div class="w-full bg-blue-200 rounded-full h-3 overflow-hidden shadow-inner">
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-3 rounded-full shadow-sm" style="width: 67%"></div>
                    </div>
                </div>

                <!-- Tugas List -->
                <div class="space-y-4">
                    
                    <!-- Tugas 1 - URGENT (< 6 jam) -->
                    <div class="bg-white rounded-xl border-2 border-red-200 shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="bg-gradient-to-r from-red-600 to-red-500 px-6 py-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-bold rounded-full flex items-center gap-1 countdown-urgent">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        URGENT
                                    </span>
                                    <span class="text-white text-sm font-semibold" data-deadline="2025-12-06T23:59:00">2 Jam 15 Menit</span>
                                </div>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">BELUM SUBMIT</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Project Website E-Commerce</h4>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                Buat website e-commerce sederhana dengan fitur: katalog produk, keranjang belanja, dan checkout. Gunakan HTML, CSS, JavaScript Native, dan PHP.
                            </p>
                            
                            <!-- Deadline Warning -->
                            <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-r-lg mb-4 countdown-urgent">
                                <div class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-red-800 mb-1">⚠️ DEADLINE SANGAT DEKAT!</p>
                                        <p class="text-xs text-red-700">Segera submit tugas Anda! Deadline dalam hitungan jam. Keterlambatan akan mempengaruhi nilai.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6 text-sm text-gray-600 mb-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Deadline: Hari Ini, 23:59
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Max 50 MB
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Bobot: 30%
                                </div>
                            </div>
                            
                            <a href="upload-tugas.php?id=1" class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white font-bold px-6 py-3 rounded-lg shadow-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Upload Sekarang
                            </a>
                        </div>
                    </div>

                    <!-- Tugas 2 - WARNING (< 24 jam) -->
                    <div class="bg-white rounded-xl border-2 border-orange-200 shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="bg-gradient-to-r from-orange-500 to-orange-400 px-6 py-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-bold rounded-full">MENDEKATI DEADLINE</span>
                                    <span class="text-white text-sm font-semibold" data-deadline="2025-12-07T23:59:00">18 Jam</span>
                                </div>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">BELUM SUBMIT</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Analisis UX/UI Website</h4>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                Analisis UX/UI dari sebuah website populer (e-commerce atau media sosial). Tulis laporan PDF minimal 5 halaman dengan screenshot.
                            </p>
                            
                            <!-- Deadline Warning -->
                            <div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded-r-lg mb-4">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-orange-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-orange-800 mb-1">Deadline kurang dari 24 jam!</p>
                                        <p class="text-xs text-orange-700">Segera selesaikan dan upload tugas Anda.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6 text-sm text-gray-600 mb-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Deadline: Besok, 23:59
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Max 10 MB
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Bobot: 15%
                                </div>
                            </div>
                            
                            <a href="upload-tugas.php?id=2" class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-400 hover:from-orange-600 hover:to-orange-500 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Upload Tugas
                            </a>
                        </div>
                    </div>

                    <!-- Tugas 3 - AKTIF (Sudah Submit) -->
                    <div class="bg-white rounded-xl border-2 border-green-200 shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="bg-gradient-to-r from-green-600 to-green-500 px-6 py-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-bold rounded-full">AKTIF</span>
                                    <span class="text-white text-sm font-semibold" data-deadline="2025-12-10T23:59:00">3 Hari 18 Jam</span>
                                </div>
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    SUDAH SUBMIT
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Form Validasi JavaScript</h4>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                Buat form pendaftaran dengan validasi JavaScript (email, password strength, phone number, dll). Submit file HTML + JS.
                            </p>

                            <!-- Submitted Info -->
                            <div class="bg-green-50 border-l-4 border-green-600 p-4 rounded-r-lg mb-4">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-green-800 mb-1">✓ Tugas sudah disubmit</p>
                                        <p class="text-xs text-green-700">Disubmit: 3 Desember 2025, 14:30 WIB (ON TIME)</p>
                                        <p class="text-xs text-green-700">File: form-validasi-ahmad.zip (2.4 MB)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6 text-sm text-gray-600 mb-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Deadline: 10 Des 2025, 23:59
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Bobot: 20%
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="font-bold text-green-600">Nilai: 90</span>
                                </div>
                            </div>
                            
                            <div class="flex gap-3">
                                <a href="upload-tugas.php?id=3" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Update Submission
                                </a>
                                <button class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-3 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Feedback
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tugas 4 - AKTIF (Normal, masih lama) -->
                    <div class="bg-white rounded-xl border-2 border-blue-200 shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-bold rounded-full">AKTIF</span>
                                    <span class="text-white text-sm font-semibold" data-deadline="2025-12-15T23:59:00">8 Hari 18 Jam</span>
                                </div>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">BELUM SUBMIT</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Database Relasi & ERD</h4>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                Desain database untuk sistem perpustakaan digital. Buat ERD lengkap dengan minimal 5 tabel dan relasi yang sesuai.
                            </p>

                            <div class="flex items-center gap-6 text-sm text-gray-600 mb-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Deadline: 15 Des 2025, 23:59
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Max 20 MB
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Bobot: 25%
                                </div>
                            </div>
                            
                            <a href="upload-tugas.php?id=4" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Upload Tugas
                            </a>
                        </div>
                    </div>

                    <!-- Tugas 5 - EXPIRED -->
                    <div class="bg-white rounded-xl border-2 border-gray-300 shadow-lg overflow-hidden opacity-60">
                        <div class="bg-gradient-to-r from-gray-500 to-gray-400 px-6 py-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-bold rounded-full">EXPIRED</span>
                                    <span class="text-white text-sm font-semibold">Deadline lewat</span>
                                </div>
                                <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">TERLAMBAT</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Quiz CSS Responsive</h4>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                Quiz online tentang CSS Flexbox, Grid, dan Media Queries. Durasi: 60 menit.
                            </p>

                            <!-- Late Submission Info -->
                            <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-r-lg mb-4">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-red-800 mb-1">Submission Terlambat</p>
                                        <p class="text-xs text-red-700">Disubmit: 2 Desember 2025, 08:15 WIB (2 hari terlambat)</p>
                                        <p class="text-xs text-red-700">Pengurangan nilai: -20 poin</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6 text-sm text-gray-600 mb-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Deadline: 30 Nov 2025, 23:59
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Bobot: 10%
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="font-bold text-red-600">Nilai: 65</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Tab Content: Nilai -->
            <div id="content-nilai" class="p-6 hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Nilai Saya</h3>
                <div class="text-center py-12 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <p class="font-semibold">Tab Nilai - Coming Soon</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Video Player -->
    <div id="modalVideoPlayer" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden animate-fade-in">
            <div class="sticky top-0 bg-gradient-to-r from-purple-600 to-purple-500 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 id="videoTitle" class="text-xl font-bold text-white">Video Player</h3>
                </div>
                <button onclick="closeVideoModal()" class="text-white/80 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-0">
                <div class="aspect-video bg-black">
                    <iframe 
                        id="videoFrame" 
                        class="w-full h-full" 
                        src="" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="hidden fixed bottom-8 right-8 bg-white rounded-lg shadow-2xl border-2 border-green-200 p-4 animate-fade-in z-50">
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

    <script>
        // Tab Switching
        function switchTab(tab) {
            // Hide all content
            document.getElementById('content-info').classList.add('hidden');
            document.getElementById('content-materi').classList.add('hidden');
            document.getElementById('content-tugas').classList.add('hidden');
            document.getElementById('content-nilai').classList.add('hidden');

            // Remove active class from all tabs
            document.getElementById('tab-info').classList.remove('tab-active');
            document.getElementById('tab-materi').classList.remove('tab-active');
            document.getElementById('tab-tugas').classList.remove('tab-active');
            document.getElementById('tab-nilai').classList.remove('tab-active');

            // Show selected content & activate tab
            document.getElementById('content-' + tab).classList.remove('hidden');
            document.getElementById('tab-' + tab).classList.add('tab-active');
        }

        // Accordion Toggle
        function toggleAccordion(id) {
            const content = document.getElementById(id);
            const button = content.previousElementSibling;
            const arrow = button.querySelector('svg');
            
            content.classList.toggle('active');
            arrow.classList.toggle('rotate-180');
        }

        // Download Materi
        function downloadMateri(id) {
            // Simulate download (in real app, this would be a backend call)
            showToast('Materi sedang didownload...');
            
            // In real app:
            // window.location.href = `/backend/materi/download-materi.php?id=${id}`;
        }

        // Play Video
        function playVideo(url, title) {
            document.getElementById('videoTitle').textContent = title;
            document.getElementById('videoFrame').src = url;
            document.getElementById('modalVideoPlayer').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Close Video Modal
        function closeVideoModal() {
            document.getElementById('modalVideoPlayer').classList.add('hidden');
            document.getElementById('videoFrame').src = '';
            document.body.style.overflow = 'auto';
        }

        // Toast
        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }

        // Real-time Countdown Update
        function updateCountdowns() {
            const elements = document.querySelectorAll('[data-deadline]');
            const now = new Date();
            
            elements.forEach(el => {
                const deadline = new Date(el.getAttribute('data-deadline'));
                const diff = deadline - now;
                
                if (diff <= 0) {
                    el.textContent = 'Deadline lewat';
                    return;
                }
                
                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                
                if (days > 0) {
                    el.textContent = `${days} Hari ${hours} Jam`;
                } else if (hours > 0) {
                    el.textContent = `${hours} Jam ${minutes} Menit`;
                } else {
                    el.textContent = `${minutes} Menit`;
                }
            });
        }
        
        // Update countdown every minute
        updateCountdowns();
        setInterval(updateCountdowns, 60000);

        // ESC key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeVideoModal();
        });

        // Backdrop click to close modal
        document.getElementById('modalVideoPlayer').addEventListener('click', function(e) {
            if (e.target === this) closeVideoModal();
        });
    </script>

</body>
</html>
