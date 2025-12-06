<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas - Search & Filter Demo</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/search-filter.css">
    
    <!-- JavaScript -->
    <script src="../assets/js/ui-interactions.js" defer></script>
    <script src="../assets/js/search-filter.js" defer></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <svg class="navbar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="navbar-title">KelasOnline</span>
            </div>
            
            <div class="navbar-menu">
                <a href="dashboard-mahasiswa.php" class="navbar-link">
                    <svg class="navbar-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                
                <a href="search-filter-demo.php" class="navbar-link active">
                    <svg class="navbar-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Kelas Saya
                </a>
                
                <a href="profil.php" class="navbar-link">
                    <svg class="navbar-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-title-section">
                    <h1 class="page-title">Daftar Kelas</h1>
                    <p class="page-subtitle">Kelola dan akses semua kelas yang Anda ikuti</p>
                </div>
                
                <button class="btn-primary" onclick="showJoinKelasModal()">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Join Kelas
                </button>
            </div>

            <!-- Search & Filter Section -->
            <div class="search-filter-section" data-search-filter style="background: linear-gradient(135deg, rgba(30, 58, 138, 0.08) 0%, rgba(59, 130, 246, 0.12) 100%); border: 2px solid rgba(59, 130, 246, 0.2); padding: 32px; margin-bottom: 40px; border-radius: 24px; backdrop-filter: blur(20px); box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);">
                <!-- Search Bar -->
                <div class="search-bar-container" style="margin-bottom: 28px;">
                    <div class="search-bar" style="background: white; border: 3px solid #e5e7eb; border-radius: 16px; padding: 16px 20px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); position: relative; overflow: hidden;">
                        <!-- Decorative gradient on hover -->
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(147, 51, 234, 0.05)); opacity: 0; transition: opacity 0.3s ease; pointer-events: none;"></div>
                        
                        <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 24px; height: 24px; color: #3b82f6; margin-right: 14px; flex-shrink: 0; transition: all 0.3s ease; position: relative; z-index: 1;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input 
                            type="text" 
                            id="searchInput" 
                            placeholder="🔍 Cari kelas favorit kamu... (nama, kode, deskripsi)"
                            autocomplete="off"
                            style="flex: 1; border: none; outline: none; font-size: 16px; color: #1f2937; background: transparent; padding: 0; position: relative; z-index: 1; font-weight: 500;"
                        >
                        <div class="search-loading" style="position: relative; z-index: 1;"></div>
                        <button class="search-clear-btn" onclick="document.getElementById('searchInput').value = ''; searchFilterSystem.handleSearch()" style="width: 28px; height: 28px; border: none; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; opacity: 0; transform: scale(0); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); margin-left: 12px; font-size: 18px; font-weight: 700; box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3); position: relative; z-index: 1;">
                            ✕
                        </button>
                        
                        <style>
                            .search-bar:focus-within {
                                border-color: #3b82f6 !important;
                                box-shadow: 0 0 0 6px rgba(59, 130, 246, 0.15), 0 8px 24px rgba(59, 130, 246, 0.2) !important;
                                transform: translateY(-2px);
                            }
                            .search-bar:focus-within > div:first-child {
                                opacity: 1;
                            }
                            .search-bar:focus-within .search-icon {
                                color: #2563eb !important;
                                transform: scale(1.1) rotate(90deg);
                            }
                            #searchInput:not(:placeholder-shown) ~ .search-clear-btn {
                                opacity: 1;
                                transform: scale(1);
                            }
                            .search-clear-btn:hover {
                                transform: scale(1.15) rotate(90deg);
                                background: linear-gradient(135deg, #dc2626, #b91c1c);
                            }
                        </style>
                    </div>
                </div>

                <!-- Filter Controls -->
                <div class="filter-controls" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    <!-- Semester Filter -->
                    <div class="filter-group">
                        <label class="filter-label" for="filterSemester" style="display: block; font-size: 13px; font-weight: 700; color: #1e3a8a; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                            📚 Semester
                        </label>
                        <select id="filterSemester" class="filter-select" style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 14px; font-weight: 600; color: #374151; background: white; cursor: pointer; transition: all 0.3s ease; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%233b82f6%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 20px; padding-right: 40px;">
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
                    <div class="filter-group">
                        <label class="filter-label" for="filterTahun" style="display: block; font-size: 13px; font-weight: 700; color: #1e3a8a; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                            📅 Tahun Ajaran
                        </label>
                        <select id="filterTahun" class="filter-select" style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 14px; font-weight: 600; color: #374151; background: white; cursor: pointer; transition: all 0.3s ease; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%233b82f6%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 20px; padding-right: 40px;">
                            <option value="all">Semua Tahun</option>
                            <option value="2024/2025">2024/2025</option>
                            <option value="2023/2024">2023/2024</option>
                            <option value="2022/2023">2022/2023</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="filter-group">
                        <label class="filter-label" for="filterStatus" style="display: block; font-size: 13px; font-weight: 700; color: #1e3a8a; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                            🎯 Status
                        </label>
                        <select id="filterStatus" class="filter-select" style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 14px; font-weight: 600; color: #374151; background: white; cursor: pointer; transition: all 0.3s ease; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%233b82f6%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 20px; padding-right: 40px;">
                            <option value="all">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>

                    <!-- Sort Options -->
                    <div class="filter-group">
                        <label class="filter-label" for="sortSelect" style="display: block; font-size: 13px; font-weight: 700; color: #1e3a8a; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                            ⚡ Urutkan
                        </label>
                        <select id="sortSelect" class="filter-select" style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 14px; font-weight: 600; color: #374151; background: white; cursor: pointer; transition: all 0.3s ease; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%233b82f6%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 20px; padding-right: 40px;">
                            <option value="nama-asc">Nama (A-Z)</option>
                            <option value="nama-desc">Nama (Z-A)</option>
                            <option value="tanggal-desc">Terbaru</option>
                            <option value="tanggal-asc">Terlama</option>
                            <option value="semester-asc">Semester (Rendah-Tinggi)</option>
                            <option value="semester-desc">Semester (Tinggi-Rendah)</option>
                        </select>
                    </div>

                    <!-- Clear Filters Button -->
                    <div class="filter-group" style="display: flex; flex-direction: column; justify-content: flex-end;">
                        <button id="clearFiltersBtn" class="clear-filters-btn" disabled style="width: 100%; padding: 12px 20px; border: 2px solid #e5e7eb; border-radius: 12px; background: white; color: #6b7280; font-size: 14px; font-weight: 700; cursor: not-allowed; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 8px;">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 18px; height: 18px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reset Filter
                        </button>
                    </div>
                </div>
                
                <style>
                    .filter-select:hover {
                        border-color: #3b82f6;
                        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
                    }
                    .filter-select:focus {
                        border-color: #2563eb;
                        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
                        outline: none;
                    }
                    #clearFiltersBtn:not(:disabled) {
                        background: linear-gradient(135deg, #ef4444, #dc2626);
                        border-color: #ef4444;
                        color: white;
                        cursor: pointer;
                        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
                    }
                    #clearFiltersBtn:not(:disabled):hover {
                        transform: translateY(-2px);
                        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
                        background: linear-gradient(135deg, #dc2626, #b91c1c);
                    }
                </style>
            </div>

            <!-- Result Status -->
            <div class="result-status" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.1)); border-radius: 16px; padding: 20px 24px; margin-bottom: 32px; backdrop-filter: blur(10px); border: 2px solid rgba(59, 130, 246, 0.2); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);">
                <div id="resultCount" class="result-count" style="font-size: 15px; font-weight: 700; color: #1e3a8a; display: flex; align-items: center; gap: 12px;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 24px; height: 24px; color: #3b82f6;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span>Menampilkan <strong style="color: #2563eb; font-size: 18px; padding: 0 6px;">12</strong> kelas</span>
                </div>
            </div>

            <!-- Kelas Grid -->
            <div id="kelasGrid" class="grid grid-cols-3" style="transition: opacity 0.3s ease, transform 0.3s ease;">
                <!-- Kelas 1 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Pemrograman Web"
                     data-kode="IF301"
                     data-semester="5"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="Belajar HTML CSS JavaScript PHP">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Pemrograman Web</h3>
                            <p class="kelas-code">IF301</p>
                        </div>
                        <span class="badge badge-success">Aktif</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Dr. Ahmad Sutanto, M.Kom</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 5 • 2024/2025</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">24</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">12</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">85%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=1" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kelas 2 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Struktur Data"
                     data-kode="IF202"
                     data-semester="3"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="Array Linked List Stack Queue Tree Graph">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Struktur Data</h3>
                            <p class="kelas-code">IF202</p>
                        </div>
                        <span class="badge badge-success">Aktif</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Prof. Siti Rahma, Ph.D</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 3 • 2024/2025</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">20</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">10</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">78%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=2" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kelas 3 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Basis Data"
                     data-kode="IF303"
                     data-semester="5"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="MySQL SQL Query Normalisasi ERD">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Basis Data</h3>
                            <p class="kelas-code">IF303</p>
                        </div>
                        <span class="badge badge-success">Aktif</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Dr. Budi Santoso, M.T</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 5 • 2024/2025</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">26</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">15</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">68%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=3" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kelas 4 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Algoritma Pemrograman"
                     data-kode="IF101"
                     data-semester="1"
                     data-tahun="2023/2024"
                     data-status="selesai"
                     data-tanggal="2023-09-01"
                     data-deskripsi="Flowchart Pseudocode Sorting Searching">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Algoritma Pemrograman</h3>
                            <p class="kelas-code">IF101</p>
                        </div>
                        <span class="badge badge-secondary">Selesai</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Ir. Dewi Lestari, M.Kom</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 1 • 2023/2024</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">18</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">8</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">100%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=4" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kelas 5 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Jaringan Komputer"
                     data-kode="IF404"
                     data-semester="7"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="TCP IP OSI Routing Switching">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #ea580c 0%, #f97316 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Jaringan Komputer</h3>
                            <p class="kelas-code">IF404</p>
                        </div>
                        <span class="badge badge-success">Aktif</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Dr. Hendra Wijaya, M.Sc</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 7 • 2024/2025</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">22</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">11</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">62%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=5" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kelas 6 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Sistem Operasi"
                     data-kode="IF302"
                     data-semester="5"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="Linux Windows Process Thread Scheduling">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Sistem Operasi</h3>
                            <p class="kelas-code">IF302</p>
                        </div>
                        <span class="badge badge-success">Aktif</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Dr. Irfan Maulana, M.T</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 5 • 2024/2025</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">28</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">14</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">71%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=6" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kelas 7 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Pemrograman Mobile"
                     data-kode="IF405"
                     data-semester="7"
                     data-tahun="2024/2025"
                     data-status="pending"
                     data-tanggal="2024-12-01"
                     data-deskripsi="Android React Native Flutter Kotlin">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #c026d3 0%, #d946ef 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Pemrograman Mobile</h3>
                            <p class="kelas-code">IF405</p>
                        </div>
                        <span class="badge badge-warning">Pending</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Dr. Joko Prasetyo, M.Kom</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 7 • 2024/2025</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=7" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kelas 8 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Machine Learning"
                     data-kode="IF406"
                     data-semester="8"
                     data-tahun="2024/2025"
                     data-status="pending"
                     data-tanggal="2025-02-01"
                     data-deskripsi="Python TensorFlow Neural Network">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Machine Learning</h3>
                            <p class="kelas-code">IF406</p>
                        </div>
                        <span class="badge badge-warning">Pending</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Prof. Kartika Sari, Ph.D</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 8 • 2024/2025</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=8" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kelas 9 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Pemrograman Python"
                     data-kode="IF201"
                     data-semester="2"
                     data-tahun="2023/2024"
                     data-status="selesai"
                     data-tanggal="2024-01-15"
                     data-deskripsi="Python Pandas NumPy OOP">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Pemrograman Python</h3>
                            <p class="kelas-code">IF201</p>
                        </div>
                        <span class="badge badge-secondary">Selesai</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Dr. Lina Marlina, M.Kom</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 2 • 2023/2024</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">16</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">9</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">100%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=9" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kelas 10 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Keamanan Jaringan"
                     data-kode="IF407"
                     data-semester="8"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="Cryptography Firewall Security">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #991b1b 0%, #b91c1c 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Keamanan Jaringan</h3>
                            <p class="kelas-code">IF407</p>
                        </div>
                        <span class="badge badge-success">Aktif</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Dr. Muhammad Rizki, M.Sc</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 8 • 2024/2025</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">19</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">11</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">55%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=10" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kelas 11 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Rekayasa Perangkat Lunak"
                     data-kode="IF304"
                     data-semester="6"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="UML SDLC Agile Scrum">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Rekayasa Perangkat Lunak</h3>
                            <p class="kelas-code">IF304</p>
                        </div>
                        <span class="badge badge-success">Aktif</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Dr. Nur Hidayat, M.T</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 6 • 2024/2025</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">23</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">13</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">73%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=11" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kelas 12 -->
                <div class="kelas-card" 
                     data-item
                     data-nama="Sistem Informasi"
                     data-kode="IF203"
                     data-semester="4"
                     data-tahun="2024/2025"
                     data-status="aktif"
                     data-tanggal="2024-09-01"
                     data-deskripsi="Business Process ERP CRM">
                    <div class="kelas-card-header" style="background: linear-gradient(135deg, #15803d 0%, #16a34a 100%);">
                        <div class="kelas-info">
                            <h3 class="kelas-title">Sistem Informasi</h3>
                            <p class="kelas-code">IF203</p>
                        </div>
                        <span class="badge badge-success">Aktif</span>
                    </div>
                    <div class="kelas-card-body">
                        <div class="kelas-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Dr. Oktavia Rani, M.Kom</span>
                            </div>
                            <div class="meta-item">
                                <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Semester 4 • 2024/2025</span>
                            </div>
                        </div>
                        <div class="kelas-stats">
                            <div class="stat-item">
                                <div class="stat-value">21</div>
                                <div class="stat-label">Materi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">12</div>
                                <div class="stat-label">Tugas</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">80%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <a href="detail-kelas-mahasiswa.php?id=12" class="btn-card">
                            Lihat Detail
                            <svg class="btn-icon-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- No Results Placeholder (Hidden by default) -->
            <div id="noResults" class="no-results-message" style="display: none;">
                <div class="no-results-card">
                    <svg class="no-results-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <h3>Tidak Ada Hasil</h3>
                    <p>Tidak ada kelas yang cocok dengan filter Anda. Coba ubah kriteria pencarian.</p>
                    <button onclick="searchFilterSystem.clearFilters()" class="btn-clear-inline">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Join Kelas Modal (Dummy) -->
    <script>
        function showJoinKelasModal() {
            alert('Join Kelas Modal (Coming Soon)');
        }
    </script>
</body>
</html>
