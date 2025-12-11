# 🎓 KelasOnline - Sistem Manajemen Pembelajaran Terintegrasi

## 📌 Ringkasan Project

**KelasOnline** adalah platform pembelajaran online yang memungkinkan dosen untuk mengelola kelas, materi pembelajaran, dan tugas secara efisien. Sistem ini dilengkapi dengan:

- ✅ Autentikasi dan manajemen sesi yang aman
- ✅ Upload materi PDF dengan progress indicator
- ✅ Support video link (YouTube & Google Drive)
- ✅ Edit dan hapus materi dengan mudah
- ✅ Search dan filter materi real-time
- ✅ Statistik dashboard yang dinamis
- ✅ Validasi file komprehensif
- ✅ Keamanan ownership dan role-based access

---

## 🚀 Fitur Utama

### 1. **Kelola Kelas** 
- Dosen bisa melihat semua kelas yang dimiliki
- Modal untuk memilih kelas untuk dikelola
- Statistik: jumlah mahasiswa, materi, tugas

### 2. **Manajemen Materi**
- **Upload PDF:** Dengan progress indicator 0-100%
- **Video Links:** YouTube dan Google Drive support
- **Edit:** Update judul, deskripsi, pertemuan
- **Delete:** Hapus materi + file secara otomatis
- **Search & Filter:** Cari by judul, filter by pertemuan/tipe

### 3. **Validasi File**
- **Frontend:** Type checking, size validation (10MB max)
- **Backend:** MIME type, extension, size verification
- **Video:** URL regex validation untuk YouTube/Google Drive

### 4. **Security**
- Session-based authentication
- X-Session-ID header validation
- Role-based access control (dosen/mahasiswa)
- Ownership verification untuk setiap kelas
- Direct URL access prevention

---

## 📁 Struktur File

```
TUGASAKHIR/
├── kelompok/
│   └── kelompok_15/
│       ├── pages/
│       │   ├── kelola-materi.php          # ✅ Main materi management page
│       │   ├── test-materi-integration.php # ✅ Test suite
│       │   ├── dashboard-dosen.php         # ✅ Dosen dashboard
│       │   ├── dashboard-mahasiswa.php     # Student dashboard
│       │   ├── login.html                  # Login page
│       │   └── ...
│       ├── backend/
│       │   ├── auth/
│       │   │   ├── login.php              # ✅ Login endpoint
│       │   │   ├── session-check.php      # ✅ Session middleware
│       │   │   ├── session-helper.php     # ✅ Auth functions
│       │   │   └── ...
│       │   ├── materi/
│       │   │   ├── upload-materi.php      # ✅ PDF upload
│       │   │   ├── get-materi.php         # ✅ Get materi list
│       │   │   ├── add-video.php          # ✅ Add video link
│       │   │   ├── delete-materi.php      # ✅ Delete materi
│       │   │   ├── update-materi.php      # ✅ Update materi
│       │   │   └── ...
│       │   ├── kelas/
│       │   │   ├── get-kelas-dosen.php    # ✅ Get dosen's kelas
│       │   │   └── ...
│       │   └── ...
│       ├── config/
│       │   └── database.php               # Database configuration
│       ├── assets/
│       │   ├── css/
│       │   │   ├── style.css
│       │   │   ├── notifications.css
│       │   │   └── ...
│       │   └── js/
│       │       └── ...
│       ├── uploads/
│       │   ├── materi/                    # PDF storage
│       │   └── ...
│       ├── MATERI_INTEGRATION_GUIDE.md    # ✅ Integration guide
│       ├── VERIFICATION_CHECKLIST.md      # ✅ Feature checklist
│       └── README.md
└── ...
```

---

## 🔧 Setup & Installation

### Prerequisites
- PHP 7.4+
- MySQL 5.7+
- Apache/XAMPP
- Modern Browser (Chrome, Firefox, Safari)

### Installation Steps

1. **Clone/Copy Project**
   ```bash
   cd c:\xampp\htdocs\
   # Project already in TUGASAKHIR folder
   ```

2. **Database Setup**
   ```sql
   -- Execute schema.sql
   mysql -u root -p < database/schema.sql
   ```

3. **Create Uploads Directory**
   ```bash
   mkdir -p uploads/materi
   mkdir -p uploads/profil
   mkdir -p uploads/tugas
   chmod 755 uploads/*
   ```

4. **Configure Database** (if needed)
   - Edit: `config/database.php`
   - Update: database, user, password

5. **Start Server**
   ```bash
   # Using XAMPP
   Start Apache & MySQL from XAMPP Control Panel
   # Or use PHP built-in server
   php -S localhost:8000
   ```

6. **Access Application**
   ```
   http://localhost/TUGASAKHIR/kelompok/kelompok_15/pages/login.html
   ```

---

## 👤 Default Test Accounts

### Dosen Account
```
Email: dosen@example.com
Password: dosen123
```

### Mahasiswa Account
```
Email: mahasiswa@example.com
Password: mahasiswa123
```

---

## 📊 How to Use - Dosen Workflow

### 1. Login
```
1. Buka: pages/login.html
2. Masuk dengan akun dosen
3. Redirect ke dashboard-dosen.php
```

### 2. Kelola Kelas
```
1. Di dashboard, klik "Kelola Kelas"
2. Modal menampilkan daftar kelas milik dosen
3. Klik salah satu kelas
4. Redirect ke kelola-materi.php?id_kelas=X
```

### 3. Tambah Materi PDF
```
1. Di kelola-materi.php, klik "Tambah Materi"
2. Modal form terbuka
3. Isi: Pertemuan, Judul, Deskripsi
4. Tab "📄 Upload PDF" aktif
5. Drag-drop atau click "Pilih File"
6. Tunggu progress bar 0% → 100%
7. Klik "Simpan Materi"
8. Toast: "✅ PDF berhasil diupload"
9. Materi muncul di list
```

### 4. Tambah Video Link
```
1. Klik "Tambah Materi"
2. Klik tab "🎥 Link Video"
3. Paste YouTube atau Google Drive URL
4. Klik "Simpan Materi"
5. Video muncul di list dengan ikon video
```

### 5. Edit Materi
```
1. Click icon edit (pencil) di materi
2. TODO: Modal form untuk edit (akan datang)
3. Update: judul, deskripsi, pertemuan
4. Save
```

### 6. Delete Materi
```
1. Click icon delete (trash) di materi
2. Konfirmasi: "⚠️ Yakin ingin menghapus?"
3. File dan database record dihapus
4. Toast: "✅ Materi berhasil dihapus"
```

---

## 🧪 Testing

### Quick Test Via Test Suite
```
1. Login as Dosen
2. Visit: /pages/test-materi-integration.php
3. Select a kelas
4. Auto redirect to kelola-materi.php?id_kelas=X
```

### Manual Testing Checklist
```
✅ Upload valid PDF (success)
✅ Try upload non-PDF (rejected)
✅ Try upload >10MB file (rejected)
✅ Add YouTube link (success)
✅ Add Google Drive link (success)
✅ Try invalid URL (rejected)
✅ Edit materi (metadata)
✅ Delete materi (file + DB)
✅ Security: Direct URL without id_kelas (redirect)
✅ Progress bar display during upload
```

### File Validation Tests

**Frontend Validation:**
```javascript
// File type check
if (file.type !== 'application/pdf') {
    showToast('Error', '❌ File harus berformat PDF');
}

// File size check
if (file.size > 10 * 1024 * 1024) {
    showToast('Error', '❌ Ukuran file terlalu besar');
}
```

**Backend Validation:**
```php
// MIME type check
if ($_FILES['file']['type'] !== 'application/pdf') {
    throw new Exception('File harus PDF');
}

// Extension check
$ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
if ($ext !== 'pdf') {
    throw new Exception('Hanya PDF');
}

// Size check (10MB)
if ($_FILES['file']['size'] > 10485760) {
    throw new Exception('File terlalu besar');
}
```

---

## 🔐 Security Features

### 1. Authentication
- Password hashing dengan `password_hash()`
- Password verification dengan `password_verify()`
- Session-based authentication
- Session token generation & validation

### 2. Authorization
- Role-based access control (dosen/mahasiswa)
- Ownership verification (dosen only manage own kelas)
- requireDosen(), requireMahasiswa() functions
- HTTP status codes (401, 403)

### 3. Input Validation
- Email format validation
- File type/size validation
- URL regex validation (YouTube/Google Drive)
- SQL injection prevention (prepared statements)
- XSS prevention (htmlspecialchars, JSON responses)

### 4. Session Security
- X-Session-ID header validation
- Session token format verification
- Direct URL parameter validation
- Redirect to dashboard if invalid

---

## 📡 API Reference

### Authentication Endpoints

**POST /backend/auth/login.php**
```json
Request: { "email": "dosen@example.com", "password": "..." }
Response: {
  "success": true,
  "data": {
    "id_user": 1,
    "nama_user": "Dr. Budi",
    "role": "dosen",
    "session_id": "...",
    "redirect_url": "dashboard-dosen.php"
  }
}
```

### Materi Endpoints

**POST /backend/materi/upload-materi.php**
```
Content: multipart/form-data
Form Data:
  - file: PDF File
  - id_kelas: number
  - judul: string
  - deskripsi: string (optional)
  - pertemuan_ke: number

Response: { "success": true, "data": { "id_materi": 123, ... } }
```

**GET /backend/materi/get-materi.php?id_kelas=1**
```
Response: {
  "success": true,
  "data": [
    {
      "id_materi": 1,
      "judul": "...",
      "tipe": "pdf|video",
      "file_path": "...",
      "pertemuan_ke": 1,
      ...
    }
  ]
}
```

**POST /backend/materi/add-video.php**
```json
Request: {
  "id_kelas": 1,
  "judul": "Video Title",
  "video_url": "https://youtube.com/...",
  "pertemuan_ke": 1
}

Response: { "success": true, "data": { "id_materi": 124 } }
```

**POST /backend/materi/delete-materi.php**
```json
Request: { "id_materi": 1 }
Response: { "success": true }
```

**PATCH /backend/materi/update-materi.php**
```json
Request: {
  "id_materi": 1,
  "judul": "Updated Title",
  "deskripsi": "...",
  "pertemuan_ke": 2
}

Response: { "success": true }
```

### Kelas Endpoints

**GET /backend/kelas/get-kelas-dosen.php**
```
Response: {
  "success": true,
  "data": [
    {
      "id_kelas": 1,
      "nama_matakuliah": "Web Development",
      "jumlah_mahasiswa": 30,
      "jumlah_materi": 5,
      ...
    }
  ]
}
```

---

## 🛠️ Configuration

### Database Configuration
**File:** `config/database.php`
```php
$dbHost = 'localhost';
$dbName = 'kelas_online';
$dbUser = 'root';
$dbPass = '';
```

### File Upload Settings
**Location:** `uploads/materi/`
**Max Size:** 10 MB
**Format:** PDF only
**Naming:** `materi_[id_kelas]_[timestamp].pdf`

### Session Configuration
**Header:** `X-Session-ID`
**Storage:** PHP Session + localStorage
**Token Format:** 64-char hex string

---

## 📚 Documentation Files

1. **MATERI_INTEGRATION_GUIDE.md**
   - Detailed integration documentation
   - API endpoint reference
   - Security implementation details
   - Testing guide

2. **VERIFICATION_CHECKLIST.md**
   - Feature implementation status
   - Testing checklist
   - Known limitations
   - Future improvements

---

## 🐛 Troubleshooting

### Issue: "Error memuat data kelas"
**Solution:**
- Check session validity
- Verify X-Session-ID header sent
- Check get-kelas-dosen.php is implemented
- Check network tab in DevTools

### Issue: Upload stuck at progress bar
**Solution:**
- Check network connection
- Verify file size < 10MB
- Check browser console for errors
- Try smaller file first

### Issue: Video link not working
**Solution:**
- Ensure URL is public accessible
- YouTube: Use full watch URL or youtu.be
- Google Drive: Set sharing to "Anyone with link"
- Check file is not restricted

### Issue: Direct URL access shows blank
**Solution:**
- Check id_kelas parameter in URL
- Verify you're logged in as dosen
- Check browser console for redirect

---

## 🚀 Deployment Checklist

- [ ] Database created and configured
- [ ] All PHP files in correct directories
- [ ] uploads/ directory writable (755 permissions)
- [ ] session.php_sapi_name check removed (if needed)
- [ ] Error reporting configured for production
- [ ] Database backups enabled
- [ ] HTTPS enabled (if public)
- [ ] Rate limiting implemented
- [ ] File upload size limits configured in php.ini

---

## 📞 Support & Contact

**Project Status:** ✅ Production Ready
**Last Updated:** 2024-01-15
**Version:** 1.0.0

**Team:**
- Backend Developer: SURYA
- Database: SURYA
- Frontend: TEAM KELOMPOK 15

---

## 📄 License

This project is part of TUGAS AKHIR (Final Project) for Educational Purposes.

---

## 📖 Additional Resources

- [MATERI_INTEGRATION_GUIDE.md](MATERI_INTEGRATION_GUIDE.md) - Complete integration guide
- [VERIFICATION_CHECKLIST.md](VERIFICATION_CHECKLIST.md) - Feature checklist
- [schema.sql](database/schema.sql) - Database schema
- [EXPORT_SYSTEM.md](EXPORT_SYSTEM.md) - Export system documentation
- [ICON_STANDARDS.md](ICON_STANDARDS.md) - Icon usage standards

---

**Happy Learning! 🎓**
