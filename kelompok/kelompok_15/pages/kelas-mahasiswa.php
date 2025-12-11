<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas Saya - KelasOnline</title>
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
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        .animate-slide-in { animation: slideIn 0.6s ease-out; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        .no-results-message { display: none; }
        .no-results-message.active { display: block; }
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">KelasOnline</h1>
                        <p class="text-xs text-gray-600">Daftar Kelas Saya</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="dashboard-mahasiswa.php" class="text-gray-600 hover:text-pink-600 font-medium text-sm">← Kembali ke Dashboard</a>
                    <button class="p-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-xl transition-colors relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                    </button>
                    
                    <div class="relative">
                        <button class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg hover:shadow-xl transition-shadow">
                            AM
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-pink-500 via-purple-500 to-purple-600 rounded-2xl shadow-2xl p-8 mb-8 text-white animate-fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2">📚 Kelas Saya</h2>
                    <p class="text-pink-100 text-lg">Kelola dan akses semua kelas yang Anda ikuti</p>
                </div>
                <button onclick="showJoinKelasModal()" class="inline-flex items-center gap-2 bg-white hover:bg-white/90 text-pink-600 font-bold px-6 py-3 rounded-xl shadow-xl hover:shadow-2xl transition-all transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Join Kelas Baru
                </button>
            </div>
        </div>

        <!-- Search & Filter Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 animate-slide-in">
            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="searchInput" 
                        placeholder="Cari kelas (nama, kode, dosen)..."
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all"
                        oninput="filterKelas()"
                    >
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Semester Filter -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Semester</label>
                    <select id="filterSemester" onchange="filterKelas()" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all">
                        <option value="all">Semua Semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                        <option value="8">Semester 8</option>
                    </select>
                </div>

                <!-- Tahun Filter -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Ajaran</label>
                    <select id="filterTahun" onchange="filterKelas()" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all">
                        <option value="all">Semua Tahun</option>
                        <option value="2024/2025">2024/2025</option>
                        <option value="2023/2024">2023/2024</option>
                        <option value="2022/2023">2022/2023</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select id="filterStatus" onchange="filterKelas()" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all">
                        <option value="all">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <!-- Reset Button -->
                <div class="flex items-end">
                    <button onclick="resetFilters()" class="w-full px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset
                    </button>
                </div>
            </div>

            <!-- Result Count -->
            <div class="mt-6 flex items-center justify-between border-t pt-4">
                <p id="resultCount" class="text-sm text-gray-600">Menampilkan <strong class="text-pink-600">12</strong> dari <strong>12</strong> kelas</p>
                
                <!-- Widget: Tugas Pending & Deadline -->
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2 text-sm">
                        <div class="w-3 h-3 bg-orange-500 rounded-full animate-pulse"></div>
                        <span class="text-gray-600">Tugas Pending: <strong class="text-orange-600">3</strong></span>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                        <span class="text-gray-600">Deadline Terdekat: <strong class="text-red-600">Besok</strong></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelas Grid -->
        <div id="kelasGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            
            <!-- Card template akan diisi menggunakan JavaScript berdasarkan filter -->
            
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="no-results-message text-center py-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak ada kelas ditemukan</h3>
            <p class="text-gray-600">Coba ubah filter atau kata kunci pencarian Anda</p>
        </div>

    </div>

    <script>
        // Data kelas (sesuai dengan dashboard-mahasiswa.php)
        const kelasData = [
            { id: 1, nama: 'Pemrograman Web', kode: 'KOM123', dosen: 'Prof. Dr. Budi Santoso', semester: 5, tahun: '2024/2025', status: 'aktif', warna: 'purple', warna_from: 'purple-600', warna_to: 'purple-700', label: 'WEB', tugas: 2 },
            { id: 2, nama: 'Basis Data', kode: 'KOM201', dosen: 'Dr. Siti Nurhaliza', semester: 5, tahun: '2024/2025', status: 'aktif', warna: 'pink', warna_from: 'pink-600', warna_to: 'pink-700', label: 'DB', tugas: 0 },
            { id: 3, nama: 'Struktur Data', kode: 'KOM202', dosen: 'Dr. Ahmad Wijaya', semester: 5, tahun: '2024/2025', status: 'aktif', warna: 'blue', warna_from: 'blue-600', warna_to: 'blue-700', label: 'DATA', tugas: 1 },
            { id: 4, nama: 'Jaringan Komputer', kode: 'KOM301', dosen: 'Prof. Joko Susilo', semester: 5, tahun: '2024/2025', status: 'aktif', warna: 'green', warna_from: 'green-600', warna_to: 'green-700', label: 'NET', tugas: 0 },
            { id: 5, nama: 'Sistem Operasi', kode: 'KOM302', dosen: 'Dr. Rina Kusuma', semester: 5, tahun: '2024/2025', status: 'aktif', warna: 'indigo', warna_from: 'indigo-600', warna_to: 'indigo-700', label: 'OS', tugas: 0 },
            { id: 6, nama: 'Matematika Diskrit', kode: 'MTK201', dosen: 'Prof. Hadi Wijaya', semester: 4, tahun: '2023/2024', status: 'selesai', warna: 'orange', warna_from: 'orange-600', warna_to: 'orange-700', label: 'MATH', tugas: 0 },
            { id: 7, nama: 'Keamanan Informasi', kode: 'KOM401', dosen: 'Dr. Lisa Hartono', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'teal', warna_from: 'teal-600', warna_to: 'teal-700', label: 'SEC', tugas: 0 },
            { id: 8, nama: 'Machine Learning', kode: 'KOM501', dosen: 'Dr. Andi Prabowo', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'yellow', warna_from: 'yellow-600', warna_to: 'amber-700', label: 'ML', tugas: 0 },
            { id: 9, nama: 'Cloud Computing', kode: 'KOM502', dosen: 'Prof. Maya Sari', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'cyan', warna_from: 'cyan-600', warna_to: 'cyan-700', label: 'CLOUD', tugas: 0 },
            { id: 10, nama: 'Mobile Programming', kode: 'KOM402', dosen: 'Dr. Rudi Hartono', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'lime', warna_from: 'lime-600', warna_to: 'lime-700', label: 'MOBI', tugas: 0 },
            { id: 11, nama: 'Data Mining', kode: 'KOM503', dosen: 'Prof. Nina Putri', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'rose', warna_from: 'rose-600', warna_to: 'rose-700', label: 'DATA', tugas: 0 },
            { id: 12, nama: 'Kecerdasan Buatan', kode: 'KOM504', dosen: 'Dr. Faisal Akbar', semester: 7, tahun: '2023/2024', status: 'selesai', warna: 'violet', warna_from: 'violet-600', warna_to: 'violet-700', label: 'AI', tugas: 0 }
        ];

        // Render kelas cards
        function renderKelas(kelasArray) {
            const grid = document.getElementById('kelasGrid');
            const noResults = document.getElementById('noResults');
            
            if (kelasArray.length === 0) {
                grid.innerHTML = '';
                noResults.classList.add('active');
                return;
            }
            
            noResults.classList.remove('active');
            
            grid.innerHTML = kelasArray.map(kelas => `
                <div class="group bg-gradient-to-br from-${kelas.warna}-100 via-${kelas.warna}-50 to-white rounded-2xl overflow-hidden shadow-lg border-2 border-${kelas.warna}-200 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-${kelas.warna}-200 to-${kelas.warna}-100 p-6 flex items-center justify-center h-32 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute top-2 left-4 w-16 h-20 bg-${kelas.warna}-400 rounded transform rotate-12"></div>
                            <div class="absolute bottom-2 right-4 w-16 h-20 bg-${kelas.warna}-500 rounded transform -rotate-6"></div>
                        </div>
                        <div class="relative w-20 h-24 bg-gradient-to-br from-${kelas.warna_from} to-${kelas.warna_to} rounded-lg shadow-xl transform -rotate-3">
                            <div class="h-4 bg-${kelas.warna_to} rounded-t-lg"></div>
                            <div class="p-2 text-white text-xs font-bold">${kelas.label}</div>
                        </div>
                    </div>
                    <div class="p-5 bg-white">
                        <h3 class="text-${kelas.warna}-900 font-bold text-lg mb-1 line-clamp-2">${kelas.nama}</h3>
                        <p class="text-${kelas.warna}-600 text-sm mb-3">${kelas.kode} • ${kelas.dosen}</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center gap-1 bg-${kelas.status === 'aktif' ? 'green' : 'orange'}-100 text-${kelas.status === 'aktif' ? 'green' : 'orange'}-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-${kelas.status === 'aktif' ? 'green' : 'orange'}-500 rounded-full"></span>
                                ${kelas.status.toUpperCase()}
                            </span>
                            <span class="text-${kelas.warna}-700 text-sm font-semibold">${kelas.tugas} Tugas</span>
                        </div>
                        <a href="detail-kelas-mahasiswa.php?id=${kelas.id}" class="block w-full text-center bg-gradient-to-r from-${kelas.warna_from} to-${kelas.warna_to} hover:from-${kelas.warna_to} hover:to-${kelas.warna_from} text-white font-bold py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            `).join('');
            
            updateResultCount(kelasArray.length, kelasData.length);
        }

        // Filter kelas
        function filterKelas() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const semesterFilter = document.getElementById('filterSemester').value;
            const tahunFilter = document.getElementById('filterTahun').value;
            const statusFilter = document.getElementById('filterStatus').value;
            
            const filtered = kelasData.filter(kelas => {
                const matchSearch = searchTerm === '' || 
                    kelas.nama.toLowerCase().includes(searchTerm) ||
                    kelas.kode.toLowerCase().includes(searchTerm) ||
                    kelas.dosen.toLowerCase().includes(searchTerm);
                
                const matchSemester = semesterFilter === 'all' || kelas.semester == semesterFilter;
                const matchTahun = tahunFilter === 'all' || kelas.tahun === tahunFilter;
                const matchStatus = statusFilter === 'all' || kelas.status === statusFilter;
                
                return matchSearch && matchSemester && matchTahun && matchStatus;
            });
            
            renderKelas(filtered);
        }

        // Reset filters
        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterSemester').value = 'all';
            document.getElementById('filterTahun').value = 'all';
            document.getElementById('filterStatus').value = 'all';
            renderKelas(kelasData);
        }

        // Update result count
        function updateResultCount(shown, total) {
            document.getElementById('resultCount').innerHTML = 
                `Menampilkan <strong class="text-pink-600">${shown}</strong> dari <strong>${total}</strong> kelas`;
        }

        // Show join kelas modal
        function showJoinKelasModal() {
            document.getElementById('joinKelasModal').classList.add('show');
            document.body.style.overflow = 'hidden';
            // Reset modal state
            resetJoinModal();
        }

        // Close join kelas modal
        function closeJoinKelasModal() {
            document.getElementById('joinKelasModal').classList.remove('show');
            document.body.style.overflow = '';
            resetJoinModal();
        }

        // Reset modal to initial state
        function resetJoinModal() {
            document.getElementById('kodeKelasInput').value = '';
            document.getElementById('previewSection').classList.add('hidden');
            document.getElementById('previewLoading').classList.add('hidden');
            document.getElementById('previewError').classList.add('hidden');
            document.getElementById('previewContent').classList.add('hidden');
            document.getElementById('btnJoinKelas').disabled = true;
            document.getElementById('btnJoinKelas').classList.add('opacity-50', 'cursor-not-allowed');
        }

        // Preview kelas with AJAX
        let previewTimeout = null;
        let currentKodeKelas = '';

        function previewKelas() {
            const kodeKelas = document.getElementById('kodeKelasInput').value.trim().toUpperCase();
            
            // Clear previous timeout
            if (previewTimeout) {
                clearTimeout(previewTimeout);
            }
            
            // Minimum 4 characters to preview
            if (kodeKelas.length < 4) {
                document.getElementById('previewSection').classList.add('hidden');
                document.getElementById('btnJoinKelas').disabled = true;
                document.getElementById('btnJoinKelas').classList.add('opacity-50', 'cursor-not-allowed');
                return;
            }
            
            // Debounce: wait 500ms before making request
            previewTimeout = setTimeout(() => {
                fetchPreview(kodeKelas);
            }, 500);
        }

        // Fetch preview from backend
        async function fetchPreview(kodeKelas) {
            currentKodeKelas = kodeKelas;
            
            // Show loading state
            document.getElementById('previewSection').classList.remove('hidden');
            document.getElementById('previewLoading').classList.remove('hidden');
            document.getElementById('previewError').classList.add('hidden');
            document.getElementById('previewContent').classList.add('hidden');
            document.getElementById('btnJoinKelas').disabled = true;
            document.getElementById('btnJoinKelas').classList.add('opacity-50', 'cursor-not-allowed');

            try {
                const response = await fetch(`../backend/kelas/preview-kelas.php?kode_kelas=${encodeURIComponent(kodeKelas)}`);
                const result = await response.json();

                // Check if this is still the current request
                if (kodeKelas !== currentKodeKelas) return;

                document.getElementById('previewLoading').classList.add('hidden');

                if (result.success) {
                    displayPreview(result.data);
                } else {
                    showPreviewError(result.message || 'Kode kelas tidak ditemukan');
                }
            } catch (error) {
                if (kodeKelas !== currentKodeKelas) return;
                document.getElementById('previewLoading').classList.add('hidden');
                showPreviewError('Gagal terhubung ke server. Silakan coba lagi.');
                console.error('Preview error:', error);
            }
        }

        // Display preview data
        function displayPreview(data) {
            document.getElementById('previewContent').classList.remove('hidden');
            
            // Fill preview data
            document.getElementById('prevNamaMatkul').textContent = data.nama_matakuliah;
            document.getElementById('prevKodeMatkul').textContent = data.kode_matakuliah;
            document.getElementById('prevNamaDosen').textContent = data.dosen.nama;
            document.getElementById('prevEmailDosen').textContent = data.dosen.email;
            document.getElementById('prevSemester').textContent = `Semester ${data.semester}`;
            document.getElementById('prevTahunAjaran').textContent = data.tahun_ajaran;
            document.getElementById('prevDeskripsi').textContent = data.deskripsi || 'Tidak ada deskripsi';
            
            // Capacity info
            const sisaSlot = data.sisa_slot;
            const kapasitas = data.kapasitas;
            const jumlahMahasiswa = data.jumlah_mahasiswa;
            const percentage = (jumlahMahasiswa / kapasitas) * 100;
            const sudahTerdaftar = data.sudah_terdaftar || false;
            
            document.getElementById('prevKapasitas').textContent = `${jumlahMahasiswa}/${kapasitas} mahasiswa`;
            document.getElementById('prevSisaSlot').textContent = `${sisaSlot} slot tersisa`;
            document.getElementById('prevProgressBar').style.width = `${percentage}%`;
            
            // Update progress bar color based on capacity
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

            // Handle join button state based on multiple conditions
            const btnJoin = document.getElementById('btnJoinKelas');
            
            if (sudahTerdaftar) {
                // Already enrolled
                btnJoin.disabled = true;
                btnJoin.classList.add('opacity-50', 'cursor-not-allowed');
                btnJoin.classList.remove('from-pink-500', 'to-purple-600');
                btnJoin.classList.add('bg-blue-500');
                btnJoin.innerHTML = `
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Sudah Terdaftar
                `;
                sisaSlotEl.textContent = 'Anda sudah terdaftar di kelas ini';
                sisaSlotEl.classList.remove('text-green-600', 'text-orange-600', 'text-red-600');
                sisaSlotEl.classList.add('text-blue-600');
            } else if (sisaSlot <= 0) {
                // Class is full
                btnJoin.disabled = true;
                btnJoin.classList.add('opacity-50', 'cursor-not-allowed');
                btnJoin.textContent = 'Kelas Penuh';
            } else {
                // Can join
                btnJoin.disabled = false;
                btnJoin.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-blue-500');
                btnJoin.classList.add('from-pink-500', 'to-purple-600');
                btnJoin.textContent = 'Join Kelas Ini';
            }
        }

        // Show preview error
        function showPreviewError(message) {
            document.getElementById('previewError').classList.remove('hidden');
            document.getElementById('previewErrorMsg').textContent = message;
            document.getElementById('previewContent').classList.add('hidden');
            document.getElementById('btnJoinKelas').disabled = true;
            document.getElementById('btnJoinKelas').classList.add('opacity-50', 'cursor-not-allowed');
        }

        // Join kelas function
        async function joinKelas() {
            const kodeKelas = document.getElementById('kodeKelasInput').value.trim().toUpperCase();
            
            if (!kodeKelas) {
                showNotification('Silakan masukkan kode kelas terlebih dahulu', 'error');
                return;
            }

            const btn = document.getElementById('btnJoinKelas');
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.innerHTML = `
                <svg class="animate-spin h-5 w-5 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            `;

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
                    closeJoinKelasModal();
                    
                    // Reload page to show new class (in production, you'd add to the grid dynamically)
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    // Handle specific error cases
                    let errorType = 'error';
                    if (result.message.includes('sudah terdaftar')) {
                        errorType = 'warning';
                    }
                    showNotification(result.message || 'Gagal bergabung ke kelas', errorType);
                    btn.disabled = false;
                    btn.textContent = originalText;
                }
            } catch (error) {
                console.error('Join error:', error);
                showNotification('Gagal terhubung ke server. Silakan coba lagi.', 'error');
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // Notification function
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
            notif.innerHTML = `
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${icons[type]}
                </svg>
                <span class="font-medium">${message}</span>
            `;

            notifContainer.appendChild(notif);
            
            // Animate in
            setTimeout(() => {
                notif.classList.remove('translate-x-full');
            }, 100);

            // Auto remove after 4 seconds
            setTimeout(() => {
                notif.classList.add('translate-x-full');
                setTimeout(() => {
                    notif.remove();
                }, 300);
            }, 4000);
        }

        // Initial render
        renderKelas(kelasData);
    </script>

    <!-- Join Kelas Modal -->
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
                            <!-- Dosen -->
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

                            <!-- Semester & Tahun -->
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

                        <!-- Deskripsi -->
                        <div class="bg-gray-50 rounded-lg p-3 mb-4">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                                <span class="text-xs text-gray-500 font-medium">Deskripsi</span>
                            </div>
                            <p id="prevDeskripsi" class="text-gray-700 text-sm">Deskripsi kelas...</p>
                        </div>

                        <!-- Kapasitas -->
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
                    <button 
                        onclick="closeJoinKelasModal()" 
                        class="flex-1 px-4 py-3 border-2 border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors"
                    >
                        Batal
                    </button>
                    <button 
                        id="btnJoinKelas"
                        onclick="joinKelas()"
                        disabled
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold rounded-xl hover:shadow-lg transition-all opacity-50 cursor-not-allowed"
                    >
                        Join Kelas Ini
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="notificationContainer" class="fixed top-4 right-4 z-[60] space-y-2"></div>

    <style>
        #joinKelasModal.show {
            display: flex !important;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

</body>
</html>
