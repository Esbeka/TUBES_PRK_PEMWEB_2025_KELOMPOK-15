# KELAS CRUD INTEGRATION - DOKUMENTASI LENGKAP

## ✅ Fitur CRUD Kelas

### 1. Backend APIs

#### `backend/kelas/create-kelas.php`
**Endpoint**: POST `/backend/kelas/create-kelas.php`

**Authentication**: Dosen only (session required)

**Parameters**:
```
nama_matakuliah (string, required) - Min 3 characters
kode_matakuliah (string, required) - Min 2 characters
semester (string, required) - e.g. "5", "6", "7"
tahun_ajaran (string, required) - e.g. "2024"
deskripsi (string, optional)
kapasitas (int, optional) - Default 50, Range 1-500
```

**Features**:
- ✅ Auto-generate unique 6-character code (uppercase alphanumeric)
- ✅ Prevent duplicate codes (max 10 attempts)
- ✅ Ownership: Auto-set id_dosen from session
- ✅ Input validation on server-side
- ✅ HTTP 201 Created on success

**Response Success**:
```json
{
  "success": true,
  "message": "Kelas berhasil dibuat",
  "data": {
    "id_kelas": 59,
    "kode_kelas": "W0O7RX",
    "nama_matakuliah": "Pemrograman Web",
    "kode_matakuliah": "WEB101"
  }
}
```

**Response Error**:
```json
{
  "success": false,
  "message": "Nama matakuliah minimal 3 karakter"
}
```

---

#### `backend/kelas/get-kelas-dosen.php`
**Endpoint**: GET `/backend/kelas/get-kelas-dosen.php`

**Authentication**: Dosen only (session required)

**Features**:
- ✅ Fetch all classes created by logged-in dosen
- ✅ Count students, materials, tasks
- ✅ Ordered by creation date (newest first)
- ✅ HTTP 200 OK

**Response**:
```json
{
  "success": true,
  "message": "4 kelas ditemukan",
  "data": [
    {
      "id_kelas": 59,
      "nama_matakuliah": "Pemrograman Web Updated",
      "kode_matakuliah": "WEB101",
      "kode_kelas": "W0O7RX",
      "semester": "5",
      "tahun_ajaran": "2024",
      "deskripsi": "...",
      "kapasitas": 50,
      "jumlah_mahasiswa": 0,
      "jumlah_materi": 0,
      "jumlah_tugas": 0,
      "created_at": "2024-12-11 15:30:00"
    }
  ]
}
```

---

#### `backend/kelas/update-kelas.php`
**Endpoint**: POST `/backend/kelas/update-kelas.php`

**Authentication**: Dosen only (session required)

**Authorization**: Only class owner can update

**Parameters**:
```
id_kelas (int, required)
nama_matakuliah (string, required)
kode_matakuliah (string, required)
semester (string, optional)
tahun_ajaran (string, optional)
deskripsi (string, optional)
kapasitas (int, optional)
```

**Features**:
- ✅ Ownership validation (only owner can edit)
- ✅ Input validation
- ✅ Update timestamp (updated_at)
- ✅ HTTP 403 if not owner, 404 if not found

**Response Success**:
```json
{
  "success": true,
  "message": "Kelas berhasil diupdate"
}
```

---

#### `backend/kelas/delete-kelas.php`
**Endpoint**: POST `/backend/kelas/delete-kelas.php`

**Authentication**: Dosen only (session required)

**Authorization**: Only class owner can delete

**Parameters**:
```
id_kelas (int, required)
```

**Features**:
- ✅ Ownership validation
- ✅ Cascade delete ALL related data:
  - All student enrollments (kelas_mahasiswa)
  - All materials (materi)
  - All tasks (tugas)
  - All task submissions (submission_tugas)
  - All grades (nilai)
- ✅ HTTP 200 OK

**Response Success**:
```json
{
  "success": true,
  "message": "Kelas \"Pemrograman Web\" dan semua data terkait berhasil dihapus"
}
```

---

### 2. Session & Authorization Middleware

#### `backend/auth/session-check.php`
Helper functions untuk session management & authorization:

```php
// Check if logged in
isLoggedIn() → bool

// Get user info
getUserId() → int
getUserRole() → string ('dosen'|'mahasiswa')
getUserName() → string

// Check role
isDosen() → bool
isMahasiswa() → bool

// Require functions (throw exception if not met)
requireLogin() → void
requireRole('dosen') → void
requireDosen() → void
requireMahasiswa() → void

// HTTP method validation
validatePostMethod() → void
validateGetMethod() → void
```

---

## 🧪 Test Results

### Test Coverage: 9/9 PASSED ✅

1. ✅ **Create Valid Class** - Class dibuat dengan code unik
2. ✅ **Generate Unique Code** - Code tidak duplikat di database
3. ✅ **Create Second Class** - Multiple classes dengan code berbeda
4. ✅ **Read Dosen's Classes** - Fetch hanya class milik dosen
5. ✅ **Update Own Class** - Dosen bisa update class sendiri
6. ✅ **Authorization Check** - Different owner terdeteksi
7. ✅ **Cascade Delete Setup** - Class + related data dibuat
8. ✅ **Cascade Delete** - Semua related data otomatis terhapus
9. ✅ **Delete Authorization** - Prevent unauthorized deletion

**Run test**: `php test_kelas_crud.php`

---

## 🔐 Security Features

| Feature | Implementation | Status |
|---------|----------------|--------|
| **Authentication** | Session check on all endpoints | ✅ |
| **Role-based Access** | requireDosen() for all dosen APIs | ✅ |
| **Ownership Validation** | Verify id_dosen before edit/delete | ✅ |
| **SQL Injection Prevention** | Parameterized PDO queries | ✅ |
| **HTTP Status Codes** | Proper codes (200, 201, 400, 403, 404, 405, 500) | ✅ |
| **Input Validation** | Server-side validation on all inputs | ✅ |
| **Cascade Delete Safety** | Foreign keys with ON DELETE CASCADE | ✅ |

---

## 📋 Unique Code Generation

Algorithm untuk generate `kode_kelas`:
```php
// Format: 6 karakter alphanumeric uppercase (A-Z, 0-9)
// Contoh: W0O7RX, ABC123, XYZ789

1. Generate random 6 chars dari 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
2. Check if kode_kelas exists in database
3. If exists, regenerate (max 10 attempts)
4. If not exists, use it
5. If 10 attempts failed, throw exception
```

**Why This Works**:
- Large possibility space: 36^6 = 2,176,782,336 combinations
- Even with 10,000 codes, chance of collision < 0.0001%
- Fast generation & check

---

## 🗑️ Cascade Delete Behavior

Ketika kelas dihapus, semua data terkait otomatis terhapus via database foreign keys:

```
DELETE FROM kelas WHERE id_kelas = ?
    ↓
Cascades to:
    → kelas_mahasiswa (enrollment records)
    → materi (learning materials)
    → tugas (assignments)
        ↓ Cascades to:
        → submission_tugas (student submissions)
            ↓ Cascades to:
            → nilai (grades)
```

**Database constraint**:
```sql
FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas) ON DELETE CASCADE
```

---

## 👥 Authorization Examples

### ✅ Allowed Operations:
- Dosen 1 membuat kelas → Dosen 1 bisa edit/delete
- Dosen 1 membuat kelas → Dosen 1 bisa add materials/tasks
- Dosen 1 get-kelas → Hanya class milik Dosen 1

### ❌ Forbidden Operations:
- Dosen 2 try edit Dosen 1's class → HTTP 403 Forbidden
- Dosen 2 try delete Dosen 1's class → HTTP 403 Forbidden
- Mahasiswa try create class → HTTP 403 Forbidden
- Not logged in try any operation → HTTP 401 Unauthorized

---

## 📝 Validation Rules

### Nama Matakuliah:
```
Minimum: 3 characters
Maximum: 100 characters (database)
Pattern: Any characters allowed
```

### Kode Matakuliah:
```
Minimum: 2 characters
Maximum: 20 characters (database)
Pattern: Any characters allowed
Example: "WEB101", "DB", "PROG"
```

### Semester:
```
Accepted values: Any string (typically "1"-"8")
Example: "5", "6", "7"
```

### Tahun Ajaran:
```
Format: Typically "2024", "2023/2024"
Example: "2024", "2023"
```

### Kapasitas:
```
Minimum: 1
Maximum: 500
Default: 50
Type: Integer
```

### Kode Kelas (auto-generated):
```
Length: Exactly 6 characters
Pattern: Uppercase alphanumeric (A-Z, 0-9)
Uniqueness: UNIQUE constraint in database
Example: "W0O7RX", "ABC123"
```

---

## 🚀 API Integration Flow

### Create Kelas Flow:
```
Frontend Form
    ↓
POST /backend/kelas/create-kelas.php
    ↓
Backend:
  1. Check session (user logged in?)
  2. Check role (dosen?)
  3. Validate input
  4. Generate unique code (max 10 attempts)
  5. Insert to database
    ↓
Response JSON (201 Created)
    ↓
Frontend redirect to class list
```

### Delete Kelas Flow:
```
User click "Delete" button
    ↓
Confirmation dialog
    ↓
POST /backend/kelas/delete-kelas.php
    ↓
Backend:
  1. Check session
  2. Check role (dosen?)
  3. Get class info
  4. Verify ownership (id_dosen == current user?)
  5. Delete class (cascade to related data)
    ↓
Response JSON (200 OK)
    ↓
Frontend remove from list & show success
```

---

## 🔧 HTTP Status Codes

| Code | Scenario | Example |
|------|----------|---------|
| 200 | Success (GET, PUT, DELETE) | Class updated |
| 201 | Resource created | New class created |
| 400 | Bad request (validation fail) | Missing field |
| 401 | Not authenticated | No session |
| 403 | Not authorized | Not owner |
| 404 | Not found | Class doesn't exist |
| 405 | Method not allowed | GET instead of POST |
| 500 | Server error | Database error |

---

## 📊 Database Schema (Relevant Tables)

```sql
CREATE TABLE kelas (
    id_kelas INT PRIMARY KEY AUTO_INCREMENT,
    id_dosen INT NOT NULL,
    nama_matakuliah VARCHAR(100) NOT NULL,
    kode_matakuliah VARCHAR(20) NOT NULL,
    semester VARCHAR(20) NOT NULL,
    tahun_ajaran VARCHAR(10) NOT NULL,
    deskripsi TEXT,
    kode_kelas VARCHAR(6) UNIQUE NOT NULL,
    kapasitas INT DEFAULT 50,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_dosen) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Indexes
CREATE INDEX idx_kode_kelas ON kelas(kode_kelas);
CREATE INDEX idx_id_dosen ON kelas(id_dosen);
```

---

## 🎯 Testing Checklist

- [x] Create class with valid data
- [x] Generate unique code (no duplicates)
- [x] Create multiple classes with different codes
- [x] Read dosen's own classes
- [x] Update own class
- [x] Prevent editing other dosen's class
- [x] Create class with related data
- [x] Cascade delete (materials & tasks deleted)
- [x] Prevent other dosen from deleting
- [x] All data integrity maintained

---

*Last Updated: December 11, 2025*
*Status: ✅ PRODUCTION READY*
*Test Success Rate: 100% (9/9 PASSED)*
