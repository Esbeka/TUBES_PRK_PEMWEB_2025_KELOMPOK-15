<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - KelasOnline</title>
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
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        .animate-slide-in { animation: slideIn 0.6s ease-out; }
        
        .password-strength-bar {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        .strength-weak { width: 33%; background: #ef4444; }
        .strength-medium { width: 66%; background: #f59e0b; }
        .strength-strong { width: 100%; background: #10b981; }
        
        .preview-image {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
        }
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 7V6a2 2 0 012-2h14a2 2 0 012 2v1" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 7h18v11a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">KelasOnline</h1>
                        <p class="text-xs text-gray-500">Manajemen Profil</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="dashboard-mahasiswa.php" class="text-gray-600 hover:text-pink-600 font-medium text-sm">← Kembali ke Dashboard</a>
                    <button class="p-2 hover:bg-pink-50 rounded-xl transition-colors relative">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                    </button>
                    <div class="relative">
                        <a href="profil.php" class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center text-white font-bold shadow-lg hover:shadow-xl transition-shadow">
                            M
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <div class="bg-gradient-to-r from-pink-400 via-pink-300 to-purple-400 rounded-3xl shadow-2xl overflow-hidden mb-4 p-8 flex items-center gap-6">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-white mb-2 drop-shadow-lg">Profil Saya</h2>
                    <p class="text-white/90 text-lg drop-shadow-md">Kelola informasi profil dan pengaturan akun Anda</p>
                </div>
                <div class="hidden lg:block flex-1 text-right">
                    <img src="https://undraw.co/api/illustrations/undraw_profile_re_4a55.svg" alt="Profil Illustration" class="w-40 h-40 inline-block animate-float">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column - Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl border-2 border-pink-200 p-6 animate-slide-in sticky top-24">
                    <div class="text-center mb-6">
                        <div class="relative inline-block mb-4">
                            <img id="currentProfilePic" src="https://ui-avatars.com/api/?name=Ahmad+Zulfikar&size=200&background=1e40af&color=fff&bold=true" alt="Profile" class="w-32 h-32 rounded-full mx-auto border-4 border-blue-100 shadow-lg">
                            <button onclick="document.getElementById('fotoInput').click()" class="absolute bottom-0 right-0 w-10 h-10 bg-gradient-to-r from-blue-800 to-blue-600 rounded-full flex items-center justify-center text-white shadow-lg hover:shadow-xl transition-shadow">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Ahmad Zulfikar</h3>
                        <p class="text-sm text-gray-600 mb-1">NPM: 2111081001</p>
                        <p class="text-sm text-gray-600 mb-3">Teknik Informatika</p>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            MAHASISWA
                        </span>
                    </div>

                    <div class="border-t border-gray-200 pt-4 space-y-3">
                        <div class="flex items-center gap-3 text-sm">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-600">ahmad.zulfikar@student.unila.ac.id</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-600">+62 812-3456-7890</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-600">Bergabung: 1 Agustus 2024</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <button onclick="logout()" class="w-full inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-3 rounded-lg shadow-md transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column - Edit Forms -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Form Edit Profil -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl border-2 border-pink-200 p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Edit Profil</h3>
                            <p class="text-sm text-gray-600">Perbarui informasi profil Anda</p>
                        </div>
                    </div>

                    <form id="formEditProfil" class="space-y-6">
                        
                        <!-- Upload Foto dengan Preview -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Foto Profil</label>
                            <div class="flex items-center gap-6">
                                <div class="relative">
                                    <img id="previewFoto" src="https://ui-avatars.com/api/?name=Ahmad+Zulfikar&size=200&background=1e40af&color=fff&bold=true" alt="Preview" class="preview-image border-4 border-blue-100 shadow-lg">
                                    <div id="uploadOverlay" class="hidden absolute inset-0 bg-black/50 rounded-full flex items-center justify-center">
                                        <div class="text-white text-center">
                                            <svg class="w-12 h-12 mx-auto mb-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                            <p class="text-sm font-semibold">Processing...</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <input type="file" id="fotoInput" accept="image/jpeg,image/png,image/jpg" class="hidden" onchange="previewImage(event)">
                                    <button type="button" onclick="document.getElementById('fotoInput').click()" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all mb-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Pilih Foto
                                    </button>
                                    <p class="text-xs text-gray-500 mb-1">Format: JPG, PNG (Max 2MB)</p>
                                    <p class="text-xs text-gray-500">Resolusi: Minimal 500x500 px</p>
                                    <p id="fileInfo" class="text-xs text-green-600 font-semibold mt-2 hidden"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="nama" value="Ahmad Zulfikar" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Masukkan nama lengkap">
                        </div>

                        <!-- Email (Read Only) -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" value="ahmad.zulfikar@student.unila.ac.id" readonly class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed">
                            <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah</p>
                        </div>

                        <!-- No Telepon -->
                        <div>
                            <label for="noTelp" class="block text-sm font-semibold text-gray-700 mb-2">No Telepon</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500">+62</span>
                                </div>
                                <input type="tel" id="noTelp" value="812-3456-7890" class="w-full pl-14 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="812-3456-7890" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Format: 812-3456-7890</p>
                        </div>

                        <!-- NPM/NIDN (Read Only) -->
                        <div>
                            <label for="npm" class="block text-sm font-semibold text-gray-700 mb-2">NPM</label>
                            <input type="text" id="npm" value="2111081001" readonly class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed">
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-800 to-blue-600 hover:from-blue-900 hover:to-blue-700 text-white font-bold px-6 py-3 rounded-lg shadow-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                            <button type="reset" onclick="resetForm()" class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Form Ganti Password -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl border-2 border-purple-200 p-6 animate-fade-in" style="animation-delay: 0.1s;">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Ganti Password</h3>
                            <p class="text-sm text-gray-600">Perbarui password untuk keamanan akun</p>
                        </div>
                    </div>

                    <form id="formGantiPassword" class="space-y-6">
                        
                        <!-- Password Lama -->
                        <div>
                            <label for="passwordLama" class="block text-sm font-semibold text-gray-700 mb-2">Password Lama</label>
                            <div class="relative">
                                <input type="password" id="passwordLama" class="w-full px-4 py-3 pr-12 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" placeholder="Masukkan password lama">
                                <button type="button" onclick="togglePassword('passwordLama')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Password Baru -->
                        <div>
                            <label for="passwordBaru" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                            <div class="relative">
                                <input type="password" id="passwordBaru" oninput="checkPasswordStrength(this.value)" class="w-full px-4 py-3 pr-12 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" placeholder="Masukkan password baru">
                                <button type="button" onclick="togglePassword('passwordBaru')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Password Strength Indicator -->
                            <div class="mt-3">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-semibold text-gray-600">Kekuatan Password:</span>
                                    <span id="strengthText" class="text-xs font-bold text-gray-400">-</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1 overflow-hidden">
                                    <div id="strengthBar" class="password-strength-bar bg-gray-300" style="width: 0%"></div>
                                </div>
                                <div class="mt-3 space-y-1">
                                    <p id="check1" class="text-xs text-gray-400 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Minimal 8 karakter
                                    </p>
                                    <p id="check2" class="text-xs text-gray-400 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Kombinasi huruf besar & kecil
                                    </p>
                                    <p id="check3" class="text-xs text-gray-400 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Minimal 1 angka
                                    </p>
                                    <p id="check4" class="text-xs text-gray-400 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Minimal 1 karakter spesial (!@#$%^&*)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div>
                            <label for="passwordKonfirmasi" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <div class="relative">
                                <input type="password" id="passwordKonfirmasi" class="w-full px-4 py-3 pr-12 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" placeholder="Ulangi password baru">
                                <button type="button" onclick="togglePassword('passwordKonfirmasi')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                            <p id="passwordMatch" class="text-xs mt-1 hidden"></p>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-purple-50 border-l-4 border-purple-600 p-4 rounded-r-lg">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-purple-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-purple-800 mb-1">Tips Keamanan Password</p>
                                    <ul class="text-xs text-purple-700 space-y-1">
                                        <li>• Gunakan kombinasi karakter yang kuat</li>
                                        <li>• Jangan gunakan informasi pribadi</li>
                                        <li>• Ganti password secara berkala</li>
                                        <li>• Jangan bagikan password ke siapapun</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-700 hover:to-purple-600 text-white font-bold px-6 py-3 rounded-lg shadow-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Ganti Password
                            </button>
                            <button type="button" onclick="clearPasswordForm()" class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="hidden fixed bottom-8 right-8 bg-white rounded-lg shadow-2xl border-2 p-4 animate-fade-in z-50 min-w-[300px]">
        <div class="flex items-center gap-3">
            <div id="toastIcon" class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"></div>
            <div class="flex-1">
                <p id="toastTitle" class="font-semibold text-gray-800"></p>
                <p id="toastMessage" class="text-sm text-gray-600"></p>
            </div>
        </div>
    </div>

    <script>
        // Preview Image Before Upload
        function previewImage(event) {
            const file = event.target.files[0];
            
            if (!file) return;
            
            // Validasi tipe file
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!allowedTypes.includes(file.type)) {
                showToast('error', 'Format Tidak Valid', 'Hanya file JPG, PNG yang diperbolehkan');
                event.target.value = '';
                return;
            }
            
            // Validasi ukuran file (max 2MB)
            const maxSize = 2 * 1024 * 1024; // 2MB
            if (file.size > maxSize) {
                showToast('error', 'File Terlalu Besar', 'Maksimal ukuran file 2MB');
                event.target.value = '';
                return;
            }
            
            // Show file info
            const fileSize = (file.size / 1024).toFixed(2);
            document.getElementById('fileInfo').textContent = `✓ ${file.name} (${fileSize} KB)`;
            document.getElementById('fileInfo').classList.remove('hidden');
            
            // Preview image
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewFoto').src = e.target.result;
                document.getElementById('currentProfilePic').src = e.target.result;
                showToast('success', 'Preview Foto', 'Foto berhasil dipilih. Klik "Simpan Perubahan" untuk mengupload.');
            };
            reader.readAsDataURL(file);
        }

        // Password Strength Checker
        function checkPasswordStrength(password) {
            let strength = 0;
            const checks = {
                length: password.length >= 8,
                mixed: /[a-z]/.test(password) && /[A-Z]/.test(password),
                number: /\d/.test(password),
                special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
            };
            
            // Update checkmarks
            updateCheck('check1', checks.length);
            updateCheck('check2', checks.mixed);
            updateCheck('check3', checks.number);
            updateCheck('check4', checks.special);
            
            // Calculate strength
            Object.values(checks).forEach(check => {
                if (check) strength++;
            });
            
            // Update UI
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            strengthBar.className = 'password-strength-bar';
            
            if (strength === 0) {
                strengthBar.style.width = '0%';
                strengthText.textContent = '-';
                strengthText.className = 'text-xs font-bold text-gray-400';
            } else if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = 'Lemah';
                strengthText.className = 'text-xs font-bold text-red-600';
            } else if (strength === 3) {
                strengthBar.classList.add('strength-medium');
                strengthText.textContent = 'Sedang';
                strengthText.className = 'text-xs font-bold text-orange-600';
            } else {
                strengthBar.classList.add('strength-strong');
                strengthText.textContent = 'Kuat';
                strengthText.className = 'text-xs font-bold text-green-600';
            }
            
            // Check password match
            const konfirmasi = document.getElementById('passwordKonfirmasi').value;
            if (konfirmasi) {
                checkPasswordMatch();
            }
        }

        function updateCheck(id, passed) {
            const check = document.getElementById(id);
            if (passed) {
                check.className = 'text-xs text-green-600 flex items-center gap-2';
                check.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
            } else {
                check.className = 'text-xs text-gray-400 flex items-center gap-2';
                check.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            }
        }

        // Check Password Match
        function checkPasswordMatch() {
            const password = document.getElementById('passwordBaru').value;
            const konfirmasi = document.getElementById('passwordKonfirmasi').value;
            const matchText = document.getElementById('passwordMatch');
            
            if (!konfirmasi) {
                matchText.classList.add('hidden');
                return;
            }
            
            matchText.classList.remove('hidden');
            
            if (password === konfirmasi) {
                matchText.textContent = '✓ Password cocok';
                matchText.className = 'text-xs text-green-600 font-semibold mt-1';
            } else {
                matchText.textContent = '✗ Password tidak cocok';
                matchText.className = 'text-xs text-red-600 font-semibold mt-1';
            }
        }

        document.getElementById('passwordKonfirmasi').addEventListener('input', checkPasswordMatch);

        // Toggle Password Visibility
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        // Form Submit - Edit Profil
        document.getElementById('formEditProfil').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nama = document.getElementById('nama').value;
            const noTelp = document.getElementById('noTelp').value;
            
            if (!nama || !noTelp) {
                showToast('error', 'Gagal', 'Semua field harus diisi!');
                return;
            }
            
            // Simulate upload
            document.getElementById('uploadOverlay').classList.remove('hidden');
            
            setTimeout(() => {
                document.getElementById('uploadOverlay').classList.add('hidden');
                showToast('success', 'Berhasil', 'Profil berhasil diperbarui!');
                
                // Update profile card
                document.querySelector('.lg\\:col-span-1 h3').textContent = nama;
            }, 1500);
        });

        // Form Submit - Ganti Password
        document.getElementById('formGantiPassword').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const passwordLama = document.getElementById('passwordLama').value;
            const passwordBaru = document.getElementById('passwordBaru').value;
            const passwordKonfirmasi = document.getElementById('passwordKonfirmasi').value;
            
            if (!passwordLama || !passwordBaru || !passwordKonfirmasi) {
                showToast('error', 'Gagal', 'Semua field password harus diisi!');
                return;
            }
            
            if (passwordBaru !== passwordKonfirmasi) {
                showToast('error', 'Gagal', 'Password baru dan konfirmasi tidak cocok!');
                return;
            }
            
            if (passwordBaru.length < 8) {
                showToast('error', 'Gagal', 'Password minimal 8 karakter!');
                return;
            }
            
            // Simulate API call
            showToast('success', 'Berhasil', 'Password berhasil diubah!');
            clearPasswordForm();
        });

        // Reset Form
        function resetForm() {
            document.getElementById('formEditProfil').reset();
            document.getElementById('previewFoto').src = 'https://ui-avatars.com/api/?name=Ahmad+Zulfikar&size=200&background=1e40af&color=fff&bold=true';
            document.getElementById('fileInfo').classList.add('hidden');
        }

        // Clear Password Form
        function clearPasswordForm() {
            document.getElementById('formGantiPassword').reset();
            document.getElementById('strengthBar').style.width = '0%';
            document.getElementById('strengthText').textContent = '-';
            document.getElementById('strengthText').className = 'text-xs font-bold text-gray-400';
            document.getElementById('passwordMatch').classList.add('hidden');
            
            // Reset checkmarks
            ['check1', 'check2', 'check3', 'check4'].forEach(id => {
                const check = document.getElementById(id);
                check.className = 'text-xs text-gray-400 flex items-center gap-2';
                check.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            });
        }

        // Logout
        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                showToast('success', 'Logout', 'Anda akan dialihkan ke halaman login...');
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 1500);
            }
        }

        // Toast Notification
        function showToast(type, title, message) {
            const toast = document.getElementById('toast');
            const toastIcon = document.getElementById('toastIcon');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');
            
            // Set icon and color based on type
            if (type === 'success') {
                toast.className = 'fixed bottom-8 right-8 bg-white rounded-lg shadow-2xl border-2 border-green-200 p-4 animate-fade-in z-50 min-w-[300px]';
                toastIcon.className = 'w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0';
                toastIcon.innerHTML = '<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            } else {
                toast.className = 'fixed bottom-8 right-8 bg-white rounded-lg shadow-2xl border-2 border-red-200 p-4 animate-fade-in z-50 min-w-[300px]';
                toastIcon.className = 'w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0';
                toastIcon.innerHTML = '<svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
            }
            
            toastTitle.textContent = title;
            toastMessage.textContent = message;
            toast.classList.remove('hidden');
            
            setTimeout(() => toast.classList.add('hidden'), 4000);
        }
    </script>

</body>
</html>
