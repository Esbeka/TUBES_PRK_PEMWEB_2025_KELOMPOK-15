<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data - Demo System</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/export-system.css">
    
    <!-- JavaScript -->
    <script src="../assets/js/ui-interactions.js" defer></script>
    <script src="../assets/js/export-system.js" defer></script>
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
                
                <a href="export-demo.php" class="navbar-link active">
                    <svg class="navbar-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Data
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
    <main class="main-content" style="margin-left: 0; width: 100%;">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-title-section">
                    <h1 class="page-title">Export & Reporting</h1>
                    <p class="page-subtitle">Export data mahasiswa dan nilai dalam berbagai format</p>
                </div>
            </div>

            <!-- Export Cards Grid - PREMIUM GRADIENT VERSION -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px; margin-bottom: 40px;">
                
                <!-- Card 1: Export Mahasiswa - Blue Gradient -->
                <div class="export-card" style="position: relative; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%); border-radius: 20px; padding: 28px; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3); transition: all 0.3s ease; overflow: hidden; cursor: pointer;" onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 20px 40px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 10px 30px rgba(59, 130, 246, 0.3)'">
                    <!-- Decorative circles -->
                    <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%; blur: 40px;"></div>
                    <div style="position: absolute; bottom: -30px; left: -30px; width: 120px; height: 120px; background: rgba(255,255,255,0.08); border-radius: 50%; blur: 30px;"></div>
                    
                    <div style="position: relative; z-index: 1;">
                        <!-- Icon & Title -->
                        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                            <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-size: 24px; font-weight: 800; color: white; margin: 0; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    Daftar Mahasiswa
                                </h3>
                                <p style="font-size: 13px; color: rgba(255,255,255,0.9); margin: 4px 0 0 0;">
                                    Export Data Lengkap
                                </p>
                            </div>
                        </div>

                        <p style="font-size: 14px; color: rgba(255,255,255,0.85); margin-bottom: 20px; line-height: 1.6;">
                            Export daftar lengkap mahasiswa termasuk NPM, nama, email, dan status aktif.
                        </p>
                        
                        <!-- Stats -->
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 24px;">
                            <div style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 12px; padding: 16px; text-align: center;">
                                <div style="font-size: 28px; font-weight: 800; color: white; line-height: 1; margin-bottom: 6px;">45</div>
                                <div style="font-size: 11px; color: rgba(255,255,255,0.8); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total</div>
                            </div>
                            <div style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 12px; padding: 16px; text-align: center;">
                                <div style="font-size: 28px; font-weight: 800; color: #10b981; line-height: 1; margin-bottom: 6px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">42</div>
                                <div style="font-size: 11px; color: rgba(255,255,255,0.8); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Aktif</div>
                            </div>
                            <div style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 12px; padding: 16px; text-align: center;">
                                <div style="font-size: 28px; font-weight: 800; color: #fbbf24; line-height: 1; margin-bottom: 6px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">3</div>
                                <div style="font-size: 11px; color: rgba(255,255,255,0.8); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Inactive</div>
                            </div>
                        </div>

                        <button 
                            class="export-button" 
                            data-export-type="mahasiswa"
                            data-export-data='{"kelas_id": 1, "semester": "5"}'
                            style="width: 100%; background: rgba(255,255,255,0.25); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); color: white; padding: 14px 20px; border-radius: 12px; font-size: 15px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.15);"
                            onmouseover="this.style.background='rgba(255,255,255,0.35)'; this.style.transform='scale(1.05)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.25)'; this.style.transform='scale(1)'">
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Export Mahasiswa
                        </button>
                    </div>
                </div>

                <!-- Card 2: Export Nilai - Green Gradient -->
                <div class="export-card" style="position: relative; background: linear-gradient(135deg, #065f46 0%, #10b981 50%, #34d399 100%); border-radius: 20px; padding: 28px; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3); transition: all 0.3s ease; overflow: hidden; cursor: pointer;" onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 20px 40px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 10px 30px rgba(16, 185, 129, 0.3)'">
                    <!-- Decorative circles -->
                    <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%; blur: 40px;"></div>
                    <div style="position: absolute; bottom: -30px; left: -30px; width: 120px; height: 120px; background: rgba(255,255,255,0.08); border-radius: 50%; blur: 30px;"></div>
                    
                    <div style="position: relative; z-index: 1;">
                        <!-- Icon & Title -->
                        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                            <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-size: 24px; font-weight: 800; color: white; margin: 0; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    Rekap Nilai
                                </h3>
                                <p style="font-size: 13px; color: rgba(255,255,255,0.9); margin: 4px 0 0 0;">
                                    Export Statistik Lengkap
                                </p>
                            </div>
                        </div>

                        <p style="font-size: 14px; color: rgba(255,255,255,0.85); margin-bottom: 20px; line-height: 1.6;">
                            Export rekap nilai lengkap dengan statistik, rata-rata, dan status kelulusan mahasiswa.
                        </p>
                        
                        <!-- Stats -->
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 24px;">
                            <div style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 12px; padding: 16px; text-align: center;">
                                <div style="font-size: 28px; font-weight: 800; color: white; line-height: 1; margin-bottom: 6px;">12</div>
                                <div style="font-size: 11px; color: rgba(255,255,255,0.8); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Tugas</div>
                            </div>
                            <div style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 12px; padding: 16px; text-align: center;">
                                <div style="font-size: 28px; font-weight: 800; color: #fbbf24; line-height: 1; margin-bottom: 6px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">85.3</div>
                                <div style="font-size: 11px; color: rgba(255,255,255,0.8); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Rata-Rata</div>
                            </div>
                            <div style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 12px; padding: 16px; text-align: center;">
                                <div style="font-size: 28px; font-weight: 800; color: #3b82f6; line-height: 1; margin-bottom: 6px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">92%</div>
                                <div style="font-size: 11px; color: rgba(255,255,255,0.8); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Submit</div>
                            </div>
                        </div>

                        <button 
                            class="export-button" 
                            data-export-type="nilai"
                            data-export-data='{"kelas_id": 1, "include_stats": true}'
                            style="width: 100%; background: rgba(255,255,255,0.25); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); color: white; padding: 14px 20px; border-radius: 12px; font-size: 15px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.15);"
                            onmouseover="this.style.background='rgba(255,255,255,0.35)'; this.style.transform='scale(1.05)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.25)'; this.style.transform='scale(1)'">
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Export Nilai
                        </button>
                    </div>
                </div>
            </div>

            <!-- Data Tables -->
            <div class="card" style="padding: 0; overflow: hidden; margin-bottom: 40px;">
                <div style="padding: 24px 32px; background: linear-gradient(135deg, rgba(30, 58, 138, 0.05) 0%, rgba(59, 130, 246, 0.05) 100%); border-bottom: 2px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h3 style="font-size: 20px; font-weight: 700; color: #1e3a8a; margin: 0 0 4px 0;">
                            Daftar Mahasiswa - Pemrograman Web
                        </h3>
                        <p style="font-size: 14px; color: #6b7280; margin: 0;">
                            Semester 5 • Tahun Ajaran 2024/2025
                        </p>
                    </div>
                    <button 
                        class="export-button secondary" 
                        data-export-type="mahasiswa"
                        data-export-data='{"kelas_id": 1}'>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Export
                    </button>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f9fafb;">
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">No</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">NPM</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">Nama</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">Email</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">Joined</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px 24px; font-size: 14px; color: #6b7280;">1</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937; font-weight: 500;">2011234567</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937;">Ahmad Rizki</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #6b7280;">ahmad.rizki@student.unila.ac.id</td>
                                <td style="padding: 16px 24px; font-size: 13px; color: #6b7280;">01 Sep 2024</td>
                                <td style="padding: 16px 24px;"><span class="badge badge-success">Aktif</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px 24px; font-size: 14px; color: #6b7280;">2</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937; font-weight: 500;">2011234568</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937;">Siti Nurhaliza</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #6b7280;">siti.nurhaliza@student.unila.ac.id</td>
                                <td style="padding: 16px 24px; font-size: 13px; color: #6b7280;">01 Sep 2024</td>
                                <td style="padding: 16px 24px;"><span class="badge badge-success">Aktif</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px 24px; font-size: 14px; color: #6b7280;">3</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937; font-weight: 500;">2011234569</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937;">Budi Santoso</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #6b7280;">budi.santoso@student.unila.ac.id</td>
                                <td style="padding: 16px 24px; font-size: 13px; color: #6b7280;">02 Sep 2024</td>
                                <td style="padding: 16px 24px;"><span class="badge badge-success">Aktif</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px 24px; font-size: 14px; color: #6b7280;">4</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937; font-weight: 500;">2011234570</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937;">Dewi Lestari</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #6b7280;">dewi.lestari@student.unila.ac.id</td>
                                <td style="padding: 16px 24px; font-size: 13px; color: #6b7280;">03 Sep 2024</td>
                                <td style="padding: 16px 24px;"><span class="badge badge-success">Aktif</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px 24px; font-size: 14px; color: #6b7280;">5</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937; font-weight: 500;">2011234571</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937;">Eko Prasetyo</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #6b7280;">eko.prasetyo@student.unila.ac.id</td>
                                <td style="padding: 16px 24px; font-size: 13px; color: #6b7280;">05 Sep 2024</td>
                                <td style="padding: 16px 24px;"><span class="badge badge-warning">Tidak Aktif</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="padding: 16px 32px; background: #f9fafb; border-top: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 13px; color: #6b7280;">
                        Menampilkan 5 dari 45 mahasiswa
                    </div>
                    <button 
                        class="export-button secondary" 
                        data-export-type="mahasiswa-full"
                        style="padding: 8px 16px; font-size: 13px;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Export Semua Data
                    </button>
                </div>
            </div>

            <!-- Nilai Table -->
            <div class="card" style="padding: 0; overflow: hidden;">
                <div style="padding: 24px 32px; background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(5, 150, 105, 0.05) 100%); border-bottom: 2px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h3 style="font-size: 20px; font-weight: 700; color: #065f46; margin: 0 0 4px 0;">
                            Rekap Nilai - Tugas 1 sampai 12
                        </h3>
                        <p style="font-size: 14px; color: #6b7280; margin: 0;">
                            Rata-rata kelas: 85.3 • Submit rate: 92.3%
                        </p>
                    </div>
                    <button 
                        class="export-button" 
                        data-export-type="nilai"
                        data-export-data='{"tugas": "all", "include_stats": true}'>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Export Nilai
                    </button>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f9fafb;">
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">NPM</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">Nama</th>
                                <th style="padding: 16px 24px; text-align: center; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">T1</th>
                                <th style="padding: 16px 24px; text-align: center; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">T2</th>
                                <th style="padding: 16px 24px; text-align: center; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">T3</th>
                                <th style="padding: 16px 24px; text-align: center; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">Rata-rata</th>
                                <th style="padding: 16px 24px; text-align: center; font-size: 13px; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937; font-weight: 500;">2011234567</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937;">Ahmad Rizki</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">85</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">90</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">88</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 15px; color: #10b981; font-weight: 700;">87.7</td>
                                <td style="padding: 16px 24px; text-align: center;"><span class="badge badge-success">Lulus</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937; font-weight: 500;">2011234568</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937;">Siti Nurhaliza</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">92</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">95</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">90</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 15px; color: #10b981; font-weight: 700;">92.3</td>
                                <td style="padding: 16px 24px; text-align: center;"><span class="badge badge-success">Lulus</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937; font-weight: 500;">2011234569</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937;">Budi Santoso</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">78</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">82</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">80</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 15px; color: #3b82f6; font-weight: 700;">80.0</td>
                                <td style="padding: 16px 24px; text-align: center;"><span class="badge badge-success">Lulus</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937; font-weight: 500;">2011234570</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937;">Dewi Lestari</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">88</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">86</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">90</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 15px; color: #10b981; font-weight: 700;">88.0</td>
                                <td style="padding: 16px 24px; text-align: center;"><span class="badge badge-success">Lulus</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937; font-weight: 500;">2011234571</td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #1f2937;">Eko Prasetyo</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #6b7280;">-</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #1f2937; font-weight: 600;">75</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 14px; color: #6b7280;">-</td>
                                <td style="padding: 16px 24px; text-align: center; font-size: 15px; color: #f59e0b; font-weight: 700;">75.0</td>
                                <td style="padding: 16px 24px; text-align: center;"><span class="badge badge-warning">Review</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="padding: 16px 32px; background: #f9fafb; border-top: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 13px; color: #6b7280;">
                        Menampilkan 5 dari 45 mahasiswa
                    </div>
                    <button 
                        class="export-button" 
                        data-export-type="nilai-lengkap"
                        style="padding: 8px 16px; font-size: 13px;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Export Nilai Lengkap
                    </button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
