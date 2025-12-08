<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - KelasOnline</title>
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
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .card-3d:hover {
            transform: translateY(-4px);
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

        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .preview-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
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

            <nav class="space-y-1">
                <a href="dashboard-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-gray-700">
                    <i class="fas fa-home w-5"></i>
                    <span class="font-medium">Home</span>
                </a>
                <a href="kelas-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-gray-700">
                    <i class="fas fa-book-open w-5"></i>
                    <span class="font-medium">My Classes</span>
                </a>
                <a href="progress-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-gray-700">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="font-medium">Progress</span>
                </a>
                <a href="schedule-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-gray-700">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span class="font-medium">Schedule</span>
                </a>
                <a href="assignments-mahasiswa.php" class="menu-item flex items-center gap-3 px-4 py-3 text-gray-700">
                    <i class="fas fa-tasks w-5"></i>
                    <span class="font-medium">Assignments</span>
                </a>
                <a href="profil.php" class="menu-item active flex items-center gap-3 px-4 py-3">
                    <i class="fas fa-user w-5"></i>
                    <span class="font-medium">Profile</span>
                </a>
            </nav>

            <div class="mt-auto pt-8">
                <a href="login.html" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-all">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="font-medium">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Profil Saya 👤</h2>
                    <p class="text-gray-600 mt-1">Kelola informasi profil Anda</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <button class="w-12 h-12 bg-white rounded-full flex items-center justify-center hover:shadow-lg transition-all">
                            <i class="fas fa-bell text-gray-600"></i>
                        </button>
                        <div class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="flex items-center gap-3 bg-white rounded-full px-4 py-2">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Zulfikar&background=667eea&color=fff" alt="User" class="w-8 h-8 rounded-full">
                        <span class="font-semibold text-gray-800 text-sm">Ahmad Zulfikar</span>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="max-w-4xl">
                <!-- Edit Profile Card -->
                <div class="card-3d rounded-3xl p-8 mb-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-user-edit text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Edit Profil</h3>
                            <p class="text-sm text-gray-600">Perbarui informasi profil Anda</p>
                        </div>
                    </div>

                    <form id="formEditProfil" class="space-y-6">
                        <!-- Upload Foto -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Foto Profil</label>
                            <div class="flex items-center gap-6">
                                <img id="previewFoto" src="https://ui-avatars.com/api/?name=Ahmad+Zulfikar&size=200&background=667eea&color=fff" alt="Preview" class="preview-image border-4 border-purple-100 shadow-lg">
                                <div class="flex-1">
                                    <input type="file" id="fotoInput" accept="image/jpeg,image/png,image/jpg" class="hidden" onchange="previewImage(event)">
                                    <button type="button" onclick="document.getElementById('fotoInput').click()" class="btn-gradient text-white font-semibold px-6 py-3 rounded-xl shadow-md">
                                        <i class="fas fa-camera mr-2"></i>
                                        Pilih Foto
                                    </button>
                                    <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG (Max 2MB)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="nama" value="Ahmad Zulfikar" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" placeholder="Masukkan nama lengkap">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" value="ahmad.zulfikar@students.unila.ac.id" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50" readonly>
                            <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- NPM -->
                            <div>
                                <label for="npm" class="block text-sm font-semibold text-gray-700 mb-2">NPM</label>
                                <input type="text" id="npm" value="2215051234" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50" readonly>
                            </div>

                            <!-- Program Studi -->
                            <div>
                                <label for="prodi" class="block text-sm font-semibold text-gray-700 mb-2">Program Studi</label>
                                <input type="text" id="prodi" value="Teknik Informatika" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" placeholder="Program Studi">
                            </div>
                        </div>

                        <!-- No. Telepon -->
                        <div>
                            <label for="telepon" class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon</label>
                            <input type="tel" id="telepon" value="082123456789" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" placeholder="Masukkan nomor telepon">
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                            <textarea id="alamat" rows="3" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" placeholder="Masukkan alamat lengkap">Jl. Prof. Dr. Ir. Sumantri Brojonegoro No. 1, Gedong Meneng, Bandar Lampung</textarea>
                        </div>

                        <button type="submit" class="btn-gradient w-full py-4 text-white font-semibold rounded-xl shadow-lg">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

                <!-- Change Password Card -->
                <div class="card-3d rounded-3xl p-8 mb-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-lock text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Ubah Password</h3>
                            <p class="text-sm text-gray-600">Perbarui password akun Anda</p>
                        </div>
                    </div>

                    <form id="formChangePassword" class="space-y-6">
                        <!-- Current Password -->
                        <div>
                            <label for="currentPassword" class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
                            <div class="relative">
                                <input type="password" id="currentPassword" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" placeholder="Masukkan password saat ini">
                                <button type="button" onclick="togglePassword('currentPassword')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="newPassword" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                            <div class="relative">
                                <input type="password" id="newPassword" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" placeholder="Masukkan password baru">
                                <button type="button" onclick="togglePassword('newPassword')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div>
                            <label for="confirmPassword" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <div class="relative">
                                <input type="password" id="confirmPassword" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" placeholder="Konfirmasi password baru">
                                <button type="button" onclick="togglePassword('confirmPassword')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn-gradient w-full py-4 text-white font-semibold rounded-xl shadow-lg">
                            <i class="fas fa-key mr-2"></i>
                            Ubah Password
                        </button>
                    </form>
                </div>

                <!-- Account Stats -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="card-3d rounded-2xl p-6 text-center">
                        <div class="text-4xl mb-2">📚</div>
                        <div class="text-2xl font-bold text-gray-800">12</div>
                        <div class="text-sm text-gray-600">Kelas Aktif</div>
                    </div>
                    <div class="card-3d rounded-2xl p-6 text-center">
                        <div class="text-4xl mb-2">✅</div>
                        <div class="text-2xl font-bold text-gray-800">45</div>
                        <div class="text-sm text-gray-600">Tugas Selesai</div>
                    </div>
                    <div class="card-3d rounded-2xl p-6 text-center">
                        <div class="text-4xl mb-2">⭐</div>
                        <div class="text-2xl font-bold text-gray-800">85</div>
                        <div class="text-sm text-gray-600">Rata-rata Nilai</div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewFoto').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        document.getElementById('formEditProfil').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('✅ Profil berhasil diperbarui!');
        });

        document.getElementById('formChangePassword').addEventListener('submit', function(e) {
            e.preventDefault();
            const newPass = document.getElementById('newPassword').value;
            const confirmPass = document.getElementById('confirmPassword').value;
            
            if (newPass !== confirmPass) {
                alert('❌ Password baru dan konfirmasi tidak cocok!');
                return;
            }
            
            alert('✅ Password berhasil diubah!');
            this.reset();
        });
    </script>
</body>
</html>
