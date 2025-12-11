# 🎓 SISTEM E-LEARNING KELASONLINE
**Tugas Besar Praktikum Pemrograman Web 2025 - Kelompok 15**

### Laboratorium Teknik Komputer — Universitas Lampung

---

## 📌 DESKRIPSI PROYEK

**KelasOnline** adalah platform e-learning mini yang memungkinkan:
- 👨‍🏫 **Dosen** membuat kelas, upload materi (PDF/video), membuat tugas, dan menilai submission mahasiswa
- 👨‍🎓 **Mahasiswa** join kelas dengan kode, mengakses materi pembelajaran, submit tugas, dan melihat nilai

Platform ini dibangun dengan **teknologi native** (HTML5, CSS3, JavaScript, PHP Native, MySQL) tanpa framework untuk memahami fundamental web development.

---

## 👥 TIM PENGEMBANG

| Nama | Role | Tanggung Jawab Utama |
|------|------|---------------------|
| **Cindy** | Frontend Developer & UI/UX | Semua halaman HTML/CSS, validasi JavaScript, design responsif |
| **Surya** | Backend Developer | Autentikasi, fitur Dosen (kelas & materi), session management |
| **Elisa** | Database Engineer & Backend | Database design, fitur Mahasiswa (join kelas & tugas) |
| **Juan** | Integration & Testing | Integrasi frontend-backend, testing, Git workflow, dokumentasi |

---

## 🎯 FITUR UTAMA

### ✅ MUST HAVE (Fitur Wajib)
1. **Autentikasi & Authorization** - Register, Login, Logout, Role-based access
2. **Manajemen Kelas (Dosen)** - CRUD kelas, generate kode kelas otomatis
3. **Manajemen Materi (Dosen)** - Upload PDF, embed video, CRUD materi
4. **Manajemen Tugas (Dosen)** - CRUD tugas, deadline, lihat submission, beri nilai
5. **Join Kelas (Mahasiswa)** - Join dengan kode unik, lihat daftar kelas
6. **Akses Materi (Mahasiswa)** - Lihat & download materi, tracking akses
7. **Submit Tugas (Mahasiswa)** - Upload file tugas, status on-time/late, lihat nilai
8. **Manajemen Profil** - Edit profil, ganti password, upload foto
9. **Dashboard & Statistik** - Dashboard mahasiswa & dosen dengan statistik

### ⭐ NICE TO HAVE (Bonus)
10. **Notifikasi Real-time** - Notifikasi tugas baru, deadline reminder
11. **Search & Filter** - Cari kelas, filter by semester/tahun
12. **Export & Reporting** - Export daftar mahasiswa & nilai ke Excel/PDF

---

## 🛠️ TEKNOLOGI

- **Frontend:** HTML5, CSS3 Native (dengan Glass Morphism & Gradient Modern)
- **JavaScript:** ES6+ Native (Validation, AJAX, File Upload Handler)
- **Backend:** PHP 8.x Native
- **Database:** MySQL 8.x
- **Server:** Apache (XAMPP/LAMP)
- **Version Control:** Git & GitHub

---

## 📋 PEMBAGIAN TUGAS PER FITUR

### 🔐 **FITUR 1: AUTENTIKASI & AUTHORIZATION**

**👤 CINDY (Frontend):**
- ✅ Halaman `register.html` dengan form registrasi (nama, email, password, role, NPM/NIDN)
- ✅ Halaman `login.html` dengan form login & remember me
- ✅ Password strength indicator & toggle show/hide
- ✅ Validasi JavaScript (`validation.js`): email format, password criteria, konfirmasi password
- ✅ Alert messages untuk success/error

**💻 SURYA (Backend - Auth Specialist):**
- [ ] `backend/auth/register.php` - Validasi server-side, hash password (`password_hash()`), insert user
- [ ] `backend/auth/login.php` - Validasi credentials, `password_verify()`, buat session, rate limiting
- [ ] `backend/auth/logout.php` - Destroy session
- [ ] `backend/auth/session-check.php` - Middleware proteksi halaman, cek role user

**🗄️ ELISA (Database):**
- [ ] Tabel `users` dengan field: id, nama, email, password (hashed), role, npm_nidn, foto_profil, timestamps
- [ ] Index pada email & role untuk query cepat

**🔗 JUAN (Integration & Testing):**
- [ ] Integrasi form login/register dengan backend
- [ ] Testing flow registrasi & login (valid/invalid credentials)
- [ ] Testing session management & role-based access
- [ ] Security testing: SQL injection, XSS prevention

---

### 👨‍🏫 **FITUR 2: MANAJEMEN KELAS (DOSEN)**

**👤 CINDY (Frontend):**
- [ ] Dashboard dosen dengan grid kelas & button "Buat Kelas"
- [ ] Modal/form Create & Edit kelas (nama MK, kode MK, semester, tahun, deskripsi, kapasitas)
- [ ] Halaman `detail-kelas-dosen.php` dengan tab: Info, Mahasiswa, Materi, Tugas
- [ ] Display kode kelas dengan copy button
- [ ] Konfirmasi delete dengan modal

**💻 SURYA (Backend - Dosen Features):**
- [ ] `backend/kelas/create-kelas.php` - Generate kode unik 6 karakter, insert kelas
- [ ] `backend/kelas/get-kelas-dosen.php` - Query kelas by id_dosen, hitung jumlah mahasiswa
- [ ] `backend/kelas/update-kelas.php` - Validasi ownership, update kelas
- [ ] `backend/kelas/delete-kelas.php` - Delete cascade (kelas + materi + tugas + submissions)
- [ ] `backend/kelas/get-detail-kelas.php` - Get info lengkap kelas dengan statistik

**🗄️ ELISA (Database):**
- [ ] Tabel `kelas`: id, id_dosen (FK), nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas (unique), kapasitas, timestamps
- [ ] Index pada kode_kelas & id_dosen

**🔗 JUAN (Integration & Testing):**
- [ ] Integrasi CRUD kelas frontend-backend
- [ ] Testing generate kode unik (tidak duplikat)
- [ ] Testing cascade delete (semua data terkait terhapus)
- [ ] Testing authorization (dosen lain tidak bisa edit/hapus kelas)

---

### 📖 **FITUR 3: MANAJEMEN MATERI (DOSEN)**

**👤 CINDY (Frontend):**
- [ ] Halaman `kelola-materi.php` dengan list materi per pertemuan
- [ ] Form tambah/edit materi: judul, deskripsi, pertemuan, tab (Upload PDF / Link Video)
- [ ] File upload dengan drag & drop area (`file-upload-handler.js`)
- [ ] Progress bar saat upload
- [ ] Validasi file (type, size) di client-side

**💻 SURYA (Backend - Materi Management):**
- [ ] `backend/materi/upload-materi.php` - Validasi PDF (max 10MB), upload ke `/uploads/materi/`, rename file, insert record
- [ ] `backend/materi/add-video.php` - Validasi URL, insert link video
- [ ] `backend/materi/get-materi.php` - Query materi by id_kelas, group by pertemuan
- [ ] `backend/materi/update-materi.php` - Edit info materi, ganti file
- [ ] `backend/materi/delete-materi.php` - Delete record & file fisik

**🗄️ ELISA (Database):**
- [ ] Tabel `materi`: id, id_kelas (FK), judul, deskripsi, tipe (pdf/video), file_path, video_url, pertemuan_ke, uploaded_at
- [ ] Index pada id_kelas & pertemuan_ke

**🔗 JUAN (Integration & Testing):**
- [ ] Integrasi upload PDF dengan progress indicator
- [ ] Testing validasi format file (reject non-PDF)
- [ ] Testing add video link (YouTube, Google Drive)
- [ ] Testing edit & delete materi
- [ ] Security testing: prevent direct URL access

---

### 📝 **FITUR 4: MANAJEMEN TUGAS (DOSEN)**

**👤 CINDY (Frontend):**
- [ ] Halaman `kelola-tugas.php` dengan list tugas, status badge, countdown deadline
- [ ] Form create/edit tugas: judul, deskripsi, deadline (date & time picker), max size, format allowed
- [ ] Halaman `lihat-submission.php` dengan table submission & filter
- [ ] Modal untuk beri nilai & feedback
- [ ] Progress bar: submitted / total mahasiswa

**💻 SURYA (Backend - Tugas Management):**
- [ ] `backend/tugas/create-tugas.php` - Insert tugas dengan deadline validation
- [ ] `backend/tugas/get-tugas.php` - Query tugas, hitung submission, check status (active/expired)
- [ ] `backend/tugas/update-tugas.php` - Validasi: deadline hanya ubah jika belum lewat
- [ ] `backend/tugas/delete-tugas.php` - Delete cascade
- [ ] `backend/tugas/get-submissions.php` - Query submission dengan status (on time/late)
- [ ] `backend/tugas/nilai-tugas.php` - Insert/update nilai & feedback

**🗄️ ELISA (Database):**
- [ ] Tabel `tugas`: id, id_kelas (FK), judul, deskripsi, deadline, max_file_size, allowed_formats, bobot, timestamps
- [ ] Tabel `submission_tugas`: id, id_tugas (FK), id_mahasiswa (FK), file_path, keterangan, submitted_at, status
- [ ] Tabel `nilai`: id, id_submission (FK), nilai, feedback, graded_at
- [ ] Trigger auto-set status (submitted/late) based on deadline

**🔗 JUAN (Integration & Testing):**
- [ ] Integrasi CRUD tugas & submission list
- [ ] Testing deadline validation
- [ ] Testing beri nilai dengan berbagai skenario
- [ ] Testing cascade delete tugas

---

### 🎓 **FITUR 5: JOIN KELAS (MAHASISWA)**

**👤 CINDY (Frontend):**
- ✅ Dashboard mahasiswa dengan grid kelas & button "Join Kelas"
- [ ] Modal join kelas: input kode (6 char, auto uppercase), preview kelas sebelum join
- ✅ Halaman `kelas-mahasiswa.php` dengan filter semester/tahun
- [ ] Widget: Tugas pending, Deadline terdekat

**💻 SURYA (Backend - Preview Kelas):**
- [ ] `backend/kelas/preview-kelas.php` - Get info kelas by kode (untuk preview sebelum join)

**🗄️ ELISA (Database & Backend Mahasiswa):**
- [ ] Tabel `kelas_mahasiswa` (junction): id, id_kelas (FK), id_mahasiswa (FK), joined_at, unique constraint
- [ ] `backend/kelas/join-kelas.php` - Validasi kode exists, cek duplicate, cek kapasitas, insert enrollment
- [ ] `backend/kelas/get-kelas-mahasiswa.php` - Query kelas yang diikuti, hitung progress
- [ ] `backend/kelas/leave-kelas.php` - Delete enrollment (opsional)

**🔗 JUAN (Integration & Testing):**
- [ ] Integrasi modal join kelas dengan preview AJAX
- [ ] Testing join dengan kode valid/invalid
- [ ] Testing duplicate prevention
- [ ] Testing kapasitas kelas penuh

---

### 📥 **FITUR 6: AKSES MATERI (MAHASISWA)**

**👤 CINDY (Frontend):**
- ✅ Halaman `detail-kelas-mahasiswa.php` Tab Materi
- [ ] List materi per pertemuan dengan icon PDF/Video
- [ ] Button download untuk PDF, button play untuk video
- [ ] Modal video player (embed YouTube/external link)

**💻 SURYA (Backend - Materi Access Control):**
- [ ] `backend/materi/download-materi.php` - Validasi akses, stream file PDF, prevent direct URL access

**🗄️ ELISA (Database & Backend Mahasiswa):**
- [ ] `backend/materi/get-materi-mahasiswa.php` - Cek akses mahasiswa (harus join kelas), query materi
- [ ] `backend/materi/log-akses.php` - Log tracking (opsional)
- [ ] Tabel `log_akses_materi` (opsional): id, id_mahasiswa (FK), id_materi (FK), accessed_at

**🔗 JUAN (Integration & Testing):**
- [ ] Testing akses materi (permission: hanya mahasiswa yang join)
- [ ] Testing download PDF di berbagai browser
- [ ] Testing play video (embed & external)
- [ ] Security testing: prevent direct file access

---

### 📤 **FITUR 7: SUBMIT TUGAS (MAHASISWA)**

**👤 CINDY (Frontend):**
- ✅ Tab Tugas di `detail-kelas-mahasiswa.php` dengan status badge & countdown
- ✅ Halaman `upload-tugas.php` dengan drag & drop, progress bar
- ✅ Validasi file preview (size, format) sebelum upload
- [ ] Deadline warning jika mendekati

**💻 SURYA (Backend - Koordinasi dengan Elisa):**
- [ ] Bantu koordinasi submission logic dengan Elisa

**🗄️ ELISA (Database & Backend Mahasiswa):**
- [ ] `backend/tugas/submit-tugas.php` - Validasi deadline, file (format & size), upload ke `/uploads/tugas/`, insert/update submission, set status
- [ ] `backend/tugas/update-submission.php` - Replace file lama dengan baru
- [ ] `backend/tugas/get-tugas-mahasiswa.php` - Query tugas dengan status submission
- [ ] `backend/tugas/get-nilai.php` - Query nilai & feedback mahasiswa

**🔗 JUAN (Integration & Testing):**
- [ ] Integrasi upload tugas dengan progress bar
- [ ] Testing submit sebelum & setelah deadline
- [ ] Testing validasi format & size
- [ ] Testing update submission (replace file)

---

### 👤 **FITUR 8: MANAJEMEN PROFIL**

**👤 CINDY (Frontend):**
- ✅ Halaman `profil.php` dengan display foto, info profil (card)
- [ ] Form edit profil: nama, foto, no telepon
- [ ] Form ganti password dengan password strength indicator
- [ ] Preview foto sebelum upload

**💻 SURYA (Backend - Profil Management):**
- [ ] `backend/profil/get-profil.php` - Query user by session id
- [ ] `backend/profil/update-profil.php` - Update nama, no_telp
- [ ] `backend/profil/upload-foto.php` - Validasi image (JPG/PNG, max 2MB), resize (500x500), upload, delete foto lama
- [ ] `backend/profil/change-password.php` - Validasi password lama, hash password baru, update

**🗄️ ELISA (Database):**
- [ ] Pastikan tabel `users` ada field: foto_profil, no_telp, updated_at

**🔗 JUAN (Integration & Testing):**
- [ ] Integrasi edit profil & upload foto
- [ ] Testing ganti password (valid/invalid)
- [ ] Security testing: user hanya edit profil sendiri
- [ ] Testing image resize & compression

---

### 📊 **FITUR 9: DASHBOARD & STATISTIK**

**👤 CINDY (Frontend):**
- ✅ Dashboard Mahasiswa: Widget cards (total kelas, tugas pending, tugas graded), upcoming deadlines, timeline activities
**💻 SURYA (Backend - Dashboard Dosen):**
- [ ] `backend/dashboard/get-stats-dosen.php` - Hitung total kelas, mahasiswa, tugas belum dinilai, recent submissions

**🗄️ ELISA (Database & Backend Dashboard Mahasiswa):**
- [ ] `backend/dashboard/get-stats-mahasiswa.php` - Hitung kelas, tugas pending, graded, 5 deadline terdekat
- [ ] `backend/dashboard/get-statistik-kelas.php` - Rata-rata nilai, submission rate, engagement
- [ ] `backend/dashboard/get-progress-mahasiswa.php` - Progress per kelas, materi accessed, tugas completed
- [ ] Create view `view_kelas_stats` untuk optimize query (opsional)

**🔗 JUAN (Integration & Testing):**
- [ ] Integrasi semua widget dashboard
- [ ] Testing statistik dengan berbagai data
- [ ] Performance testing (query optimization)

---

### 🔔 **FITUR 10: NOTIFIKASI (BONUS)**

**👤 CINDY (Frontend):**
- [ ] Notification bell icon di navbar dengan badge counter
- [ ] Dropdown notifikasi (5 terbaru)
- [ ] Mark as read on click
- [ ] Real-time update (AJAX polling)

**💻 SURYA (Backend - Notification System):**
- [ ] `backend/notifications/create-notification.php` - Function helper dipanggil saat event (tugas baru, dinilai, submission, join kelas)

**🗄️ ELISA (Database & Backend):**
- [ ] Tabel `notifications`: id, id_user (FK), title, message, link, is_read, created_at
- [ ] `backend/notifications/get-notifications.php` - Query notifikasi user (unread first)
- [ ] `backend/notifications/mark-read.php` - Update status read
- [ ] Index pada id_user & is_read

**🔗 JUAN (Integration & Testing):**
- [ ] Testing create notification on events
- [ ] Testing real-time update
- [ ] Testing mark as read & redirect link

---

### 🔍 **FITUR 11: SEARCH & FILTER (BONUS)**

**👤 CINDY (Frontend):**
- [ ] Search bar di halaman kelas dengan live search
- [ ] Filter dropdown (semester, tahun, status)
- [ ] Sort options (nama, tanggal, deadline)
- [ ] Clear filters button

**💻 SURYA (Backend - Search Implementation):**
- [ ] `backend/search/search-kelas.php` - Query dengan LIKE, filter by semester/tahun, sort by column

**🗄️ ELISA (Database):**
- [ ] Create FULLTEXT index untuk optimize search (opsional)

**🔗 JUAN (Integration & Testing):**
- [ ] Testing search dengan berbagai keyword
- [ ] Testing filter & sort combination
- [ ] Testing performance

---

### 📄 **FITUR 12: EXPORT & REPORTING (BONUS)**

**👤 CINDY (Frontend):**
- ✅ Button "Export" di halaman list mahasiswa & nilai
- ✅ Modal pilih format (Excel/PDF/CSV)
- ✅ Loading indicator saat generate

**💻 SURYA (Backend - Export Features):**
- [ ] `backend/export/export-mahasiswa.php` - Generate Excel dengan PHPSpreadsheet
- [ ] `backend/export/export-nilai.php` - Generate Excel/PDF nilai
- [ ] Install library: PHPSpreadsheet, TCPDF

**🗄️ ELISA (Database):**
- [ ] Optimize query untuk export (large data)

**🔗 JUAN (Integration & Testing):**
- [ ] Testing export dengan berbagai jumlah data
- [ ] Testing format Excel & PDF
- [ ] Performance testing (large dataset)

---

## 📁 STRUKTUR FOLDER

```
TUBES_PRK_PEMWEB_2025_KELOMPOK-15/
│
├── assets/
│   ├── css/
│   │   ├── style.css (Premium Blue Gradient Theme - 1000+ lines) ✅
│   │   ├── dashboard.css (Dashboard layouts - 600+ lines) ✅
│   │   └── forms.css (Enhanced forms - 700+ lines) ✅
│   ├── js/
│   │   ├── validation.js ✅
│   │   ├── ui-interactions.js ✅
│   │   └── file-upload-handler.js ✅
│   └── images/
│
├── backend/
│   ├── auth/ (Surya)
│   ├── kelas/ (Surya + Elisa)
│   ├── materi/ (Surya + Elisa)
│   ├── tugas/ (Surya + Elisa)
│   ├── profil/ (Surya)
│   ├── dashboard/ (Surya + Elisa)
│   ├── notifications/ (Surya + Elisa - Bonus)
│   ├── search/ (Surya - Bonus)
│   └── export/ (Surya - Bonus)
│
├── config/
│   ├── database.php (Elisa)
│   └── config.php
│
├── database/ (Elisa)
│   ├── erd.png
│   ├── schema.sql
│   └── seed.sql
│
├── pages/ (Cindy)
│   ├── index.html ✅
│   ├── login.html ✅
│   ├── register.html ✅
│   ├── dashboard-mahasiswa.php ✅
│   ├── kelas-mahasiswa.php ✅
│   ├── detail-kelas-mahasiswa.php ✅
│   ├── upload-tugas.php ✅
│   ├── profil.php ✅
│   └── [dosen pages...]
│
├── uploads/
│   ├── materi/
│   ├── tugas/
│   ├── profil/
│   └── .htaccess
│
├── docs/ (Juan)
│   ├── FITUR_LENGKAP.md ✅
│   ├── PEMBAGIAN_TUGAS_PER_FITUR.md ✅
│   └── USER_GUIDE.md
│
├── .gitignore
├── README.md ✅ (File ini)
└── CHANGELOG.md
```

---

## 🚀 CARA INSTALASI

### 1. Prerequisites
- XAMPP/LAMP (PHP 8.x + MySQL 8.x + Apache)
- Git
- Text Editor (VS Code recommended)

### 2. Clone Repository
```bash
cd C:\xampp\htdocs
git clone https://github.com/Esbeka/TUBES_PRK_PEMWEB_2025_KELOMPOK-15.git
cd TUBES_PRK_PEMWEB_2025_KELOMPOK-15
```

### 3. Setup Database
1. Buka phpMyAdmin (http://localhost/phpmyadmin)
2. Create database baru: `kelasonline`
3. Import file: `database/schema.sql`
4. (Opsional) Import file: `database/seed.sql` untuk sample data

### 4. Konfigurasi Database
Edit file `config/database.php`:
```php
<?php
$host = 'localhost';
$dbname = 'kelasonline';
$username = 'root';
$password = ''; // Sesuaikan dengan password MySQL Anda
?>
```

### 5. Jalankan Aplikasi
1. Copy folder project ke `C:\xampp\htdocs\` (Windows)
2. Start Apache & MySQL di XAMPP Control Panel
3. Buka browser: `http://localhost/TUBES_PRK_PEMWEB_2025_KELOMPOK-15/pages/index.html`

---

## 📖 CARA PENGGUNAAN

### Untuk Mahasiswa:
1. Register dengan role "Mahasiswa" & NPM
2. Login dengan email & password
3. Di dashboard, klik "Join Kelas" dan masukkan kode kelas dari dosen
4. Akses materi pembelajaran (PDF/Video)
5. Submit tugas sebelum deadline
6. Lihat nilai & feedback dari dosen

### Untuk Dosen:
1. Register dengan role "Dosen" & NIDN
2. Login dengan email & password
3. Buat kelas baru (otomatis dapat kode unik 6 karakter)
4. Share kode kelas ke mahasiswa
5. Upload materi (PDF atau link video YouTube)
6. Buat tugas dengan deadline
7. Lihat submission mahasiswa & beri nilai

---

## ⏰ TIMELINE PENGERJAAN

| Minggu | Target | PIC |
|--------|--------|-----|
| **1-2** | Setup project, Database design, Fitur 1-2 (Autentikasi & Kelas) | Semua |
| **3-4** | Fitur 3-4 (Materi & Tugas), Fitur 5 (Join Kelas) | Cindy, Surya, Elisa |
| **5-6** | Fitur 6-7 (Akses Materi & Submit Tugas), Fitur 8 (Profil) | Cindy, Surya, Elisa, Juan |
| **7-8** | Fitur 9 (Dashboard & Statistik), Integration Testing, Bug Fixing | Semua |
| **9-10** | Fitur Bonus (10-12), UI Polish, Documentation, Final Testing | Semua |

---

## 📝 PROGRESS TRACKING

### ✅ COMPLETED (60% Frontend)
- **Cindy**: Register & Login pages, Dashboard mahasiswa, Detail kelas, Upload tugas, Profil, CSS Premium (3 files), JS Validation (3 files)
- **Dokumentasi**: FITUR_LENGKAP.md, PEMBAGIAN_TUGAS_PER_FITUR.md, README.md

### 🔨 IN PROGRESS
- **Elisa**: Database schema design
- **Surya**: Backend authentication

### ⏳ PENDING
- Backend kelas, materi, tugas (Surya)
- Backend mahasiswa features (Elisa)
- Integration frontend-backend (Juan)
- Testing & bug fixing (Juan)
- Bonus features (Fitur 10-12)

---

## 🌿 GIT WORKFLOW & BRANCHING STRATEGY

### 📋 Branch Structure

Kami menggunakan **feature branch workflow** untuk memastikan setiap orang bekerja di branch masing-masing tanpa konflik:

```
master (main branch - production ready)
├── feature/cindy-frontend-ui (Frontend & UI/UX - CINDY)
├── feature/surya-backend-core (Backend Core & Auth - SURYA)
├── feature/elisa-backend-student (Backend Student & Database - ELISA)
└── feature/juan-testing-integration (Testing & Integration - JUAN)
```

### 🎯 Tanggung Jawab per Branch

| Branch | Developer | File/Folder yang Dikerjakan |
|--------|-----------|----------------------------|
| `feature/cindy-frontend-ui` | **CINDY** | `pages/`, `assets/css/`, `assets/js/` |
| `feature/surya-backend-core` | **SURYA** | `backend/auth/`, `backend/kelas/` (dosen), `backend/materi/` (dosen), `backend/tugas/` (dosen), `backend/profil/`, `backend/dashboard/get-stats-dosen.php` |
| `feature/elisa-backend-student` | **ELISA** | `database/`, `backend/kelas/` (mahasiswa), `backend/materi/get-materi-mahasiswa.php`, `backend/tugas/` (mahasiswa), `backend/dashboard/` (mahasiswa) |
| `feature/juan-testing-integration` | **JUAN** | Testing, integration, bug fixes across all modules |

### 🚀 Workflow untuk Setiap Developer

#### 1️⃣ Mulai Kerja di Branch Sendiri
```bash
# Pindah ke branch kamu
git checkout feature/nama-kamu

# Pull update terbaru dari master (jika ada)
git pull origin master

# Lihat status
git status
```

#### 2️⃣ Kerja & Commit Secara Berkala
```bash
# Tambahkan file yang diubah
git add .

# Commit dengan pesan yang jelas
git commit -m "✨ feat: Implement login validation"

# Atau commit spesifik
git commit -m "🐛 fix: Fix password validation regex"
git commit -m "💄 style: Update button hover effect"
git commit -m "📝 docs: Add API documentation"
```

**💡 Commit Message Convention:**
- `✨ feat:` - Fitur baru
- `🐛 fix:` - Bug fix
- `💄 style:` - Styling/UI changes
- `♻️ refactor:` - Refactoring code
- `📝 docs:` - Documentation
- `✅ test:` - Testing
- `🔧 config:` - Configuration

#### 3️⃣ Push ke Remote Repository
```bash
# Push branch kamu ke GitHub
git push origin feature/nama-kamu
```

#### 4️⃣ Buat Pull Request (PR) di GitHub
1. Buka GitHub repository
2. Klik tombol **"Compare & pull request"**
3. Tulis deskripsi perubahan:
   - Apa yang dikerjakan?
   - Testing checklist
   - Screenshot (jika ada perubahan UI)
4. Assign **Juan** sebagai reviewer
5. Submit Pull Request

#### 5️⃣ Review & Merge (oleh Juan)
```bash
# Juan akan review code
# Jika ada revisi, kamu perbaiki di branch kamu
# Setelah approved, Juan akan merge ke master

git checkout master
git merge feature/nama-kamu --no-ff
git push origin master
```

### ⚠️ ATURAN PENTING

1. **JANGAN KERJA LANGSUNG DI MASTER!**
   - Master hanya untuk kode yang sudah tested & approved
   
2. **JANGAN EDIT FILE DI BRANCH ORANG LAIN**
   - Cindy: hanya edit `pages/`, `assets/`
   - Surya: hanya edit `backend/auth/`, `backend/kelas/` (dosen), dll
   - Elisa: hanya edit `database/`, `backend/kelas/` (mahasiswa), dll
   - Juan: boleh edit semua untuk bug fixing & integration
   
3. **SERING-SERING COMMIT & PUSH**
   - Commit minimal 1x sehari
   - Push setiap selesai fitur kecil
   
4. **SYNC DENGAN MASTER SECARA BERKALA**
   ```bash
   # Update branch kamu dengan perubahan master
   git checkout feature/nama-kamu
   git pull origin master
   ```

5. **TESTING SEBELUM PUSH**
   - Test fitur kamu sendiri dulu
   - Pastikan tidak ada error
   
6. **KOMUNIKASI DI GRUP**
   - Kasih tahu kalau sudah push
   - Kasih tahu kalau butuh review
   - Kasih tahu kalau ada konflik

### 🔄 Contoh Workflow Lengkap (SURYA)

```bash
# 1. Pindah ke branch SURYA
git checkout feature/surya-backend-core

# 2. Mulai coding (misal: buat login.php)
# Edit file backend/auth/login.php

# 3. Test di localhost
# http://localhost/TUBES_PRK_PEMWEB_2025_KELOMPOK-15/backend/auth/login.php

# 4. Commit
git add backend/auth/login.php
git commit -m "✨ feat: Implement login with session management"

# 5. Push ke GitHub
git push origin feature/surya-backend-core

# 6. Buat Pull Request di GitHub
# Tunggu review dari Juan

# 7. Setelah di-merge, pull master
git checkout master
git pull origin master
```

### 🐛 Troubleshooting

**Problem: Ada konflik saat merge**
```bash
# 1. Pull master dulu
git checkout feature/nama-kamu
git pull origin master

# 2. Resolve conflict di VS Code
# (VS Code akan highlight conflict)

# 3. Commit hasil resolve
git add .
git commit -m "🔀 merge: Resolve conflict with master"
git push origin feature/nama-kamu
```

**Problem: Salah commit di branch master**
```bash
# 1. Bikin branch baru dari master
git branch feature/fix-nama-kamu

# 2. Reset master ke commit sebelumnya
git checkout master
git reset --hard origin/master

# 3. Checkout ke branch baru
git checkout feature/fix-nama-kamu
```

---

## 📞 KONTAK TIM

| Anggota | Role | Expertise |
|---------|------|-----------|
| **Cindy** | Frontend & UI/UX | HTML, CSS, JavaScript |
| **Surya** | Backend | PHP, Auth, Dosen Features |
| **Elisa** | Database & Backend | MySQL, Mahasiswa Features |
| **Juan** | Integration & Testing | Testing, Git, Documentation |

**Koordinator per Modul:**
- Frontend Issues → **Cindy**
- Authentication Issues → **Surya**
- Database Issues → **Elisa**
- Integration/Git Issues → **Juan**

---

## 🏆 KRITERIA SUKSES

- ✅ Semua 9 fitur MUST HAVE berfungsi 100%
- ✅ Tidak ada bug critical
- ✅ Database design solid (normalized, indexed, dengan ERD)
- ✅ Code clean & well-documented
- ✅ Responsive di semua device
- ✅ Security best practices diterapkan
- ✅ Git history clean
- ✅ Demo berjalan lancar
- ✅ Performance optimal (page load < 3s)

---

## 🎯 GOOD LUCK TEAM!

**"Satu tim, satu tujuan. Kerja paralel, minim tabrakan!"** 🚀

*Frontend sudah ready 60%, mari kita selesaikan backend & integrasi bersama!*

---

**Made with ❤️ by Kelompok 15**

*Terakhir diupdate: 4 Desember 2025*
