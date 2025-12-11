# LOGIN & REGISTER INTEGRATION - DOKUMENTASI

## ✅ Fitur yang Diimplementasi

### 1. Backend Authentication APIs

#### `backend/auth/register.php`
- ✅ Validasi server-side untuk semua input:
  - Nama: 3-100 karakter
  - Email: Format valid & unik
  - NPM/NIDN: 8-15 angka & unik
  - Password: Min 8 char, ada uppercase, lowercase, & number
  - Confirm password: Harus match

- ✅ Security:
  - Password hashing dengan BCRYPT (cost 12)
  - Parameterized SQL queries (prevent SQL injection)
  - Input validation & sanitization
  
- ✅ Response:
  - 201 Created: Registrasi berhasil
  - 400 Bad Request: Validasi gagal
  - 409 Conflict: Email/NPM sudah terdaftar

**Contoh Success Response:**
```json
{
  "success": true,
  "message": "Registrasi berhasil! Silakan login dengan akun Anda.",
  "data": {
    "id_user": 1,
    "nama": "Ahmad Zulfikar",
    "email": "ahmad@test.com",
    "npm_nidn": "2111081001",
    "role": "mahasiswa"
  }
}
```

#### `backend/auth/login.php`
- ✅ Validasi credentials (npm_nidn + password + role)
- ✅ Password verification dengan password_verify()
- ✅ Create session dengan user data:
  - id_user
  - nama
  - email
  - npm_nidn
  - role
  
- ✅ Smart redirect berdasarkan role:
  - Mahasiswa → dashboard-mahasiswa.php
  - Dosen → dashboard-dosen.php

- ✅ Response:
  - 200 OK: Login berhasil + redirect URL
  - 401 Unauthorized: Credentials salah
  - 405 Method Not Allowed: Bukan POST

**Contoh Success Response:**
```json
{
  "success": true,
  "message": "Login berhasil",
  "redirect": "/TUGASAKHIR/kelompok/kelompok_15/pages/dashboard-mahasiswa.php",
  "user": {
    "id_user": 1,
    "nama": "Ahmad Zulfikar",
    "email": "ahmad@test.com",
    "role": "mahasiswa"
  }
}
```

### 2. Frontend Forms

#### `pages/login.html`
- ✅ NPM/NIDN field
- ✅ Password field with toggle show/hide
- ✅ Role selection (Mahasiswa/Dosen)
- ✅ Remember me checkbox
- ✅ Error alert display
- ✅ Loading state pada submit button
- ✅ Form submission handler dengan AJAX
- ✅ Auto redirect setelah login success

#### `pages/register.html`
- ✅ Role selection (Mahasiswa/Dosen)
- ✅ Nama field
- ✅ NPM/NIDN field
- ✅ Email field
- ✅ Password field with toggle
- ✅ Confirm password field with toggle
- ✅ Terms & conditions checkbox
- ✅ Error & success alerts
- ✅ Form submission handler dengan AJAX
- ✅ Auto redirect ke login setelah success

---

## 🧪 Testing Results

### Test Scenarios Covered:

#### Register Tests:
1. ✅ Valid registration - Mahasiswa
2. ✅ Valid registration - Dosen
3. ✅ Duplicate email rejection
4. ✅ Short password rejection (< 8 chars)
5. ✅ No uppercase rejection
6. ✅ No number rejection
7. ✅ Invalid email format rejection

#### Login Tests:
8. ✅ Valid login with correct credentials
9. ✅ Wrong password rejection
10. ✅ Non-existent user rejection

**Run test:** `php test_auth_flow.php`

---

## 🔐 Security Features

| Feature | Implementation | Status |
|---------|----------------|--------|
| **Password Hashing** | BCRYPT with cost 12 | ✅ |
| **Password Verification** | password_verify() | ✅ |
| **SQL Injection Prevention** | Parameterized PDO queries | ✅ |
| **Input Validation** | Server-side validation | ✅ |
| **Email Uniqueness** | Database constraint check | ✅ |
| **NPM/NIDN Uniqueness** | Database constraint check | ✅ |
| **Session Management** | Server-side sessions | ✅ |
| **AJAX Form Submission** | Prevent page reload | ✅ |
| **Error Handling** | User-friendly messages | ✅ |
| **HTTP Status Codes** | Proper codes (200, 201, 400, 401, 409) | ✅ |

---

## 📋 Validasi Rules

### Password Requirements:
```
Minimum 8 characters
Maximum 128 characters
Must contain uppercase letter (A-Z)
Must contain lowercase letter (a-z)
Must contain number (0-9)
```

### NPM/NIDN Format:
```
8-15 angka
Format: 2111081001 atau 198512345678
```

### Email:
```
Format valid: user@domain.com
Unique di database
```

### Nama:
```
Minimum 3 characters
Maximum 100 characters
```

---

## 🚀 User Flow

### Registration Flow:
1. User pilih role (Mahasiswa/Dosen)
2. Isi data lengkap (Nama, NPM/NIDN, Email, Password)
3. Submit form
4. Backend validasi:
   - ✓ Format email valid
   - ✓ Email belum terdaftar
   - ✓ NPM/NIDN belum terdaftar
   - ✓ Password memenuhi kriteria
5. Password di-hash dengan BCRYPT
6. Data insert ke database
7. Show success message
8. Auto redirect ke login

### Login Flow:
1. User enter NPM/NIDN
2. User enter password
3. User pilih role (Mahasiswa/Dosen)
4. Submit form
5. Backend validasi:
   - ✓ NPM/NIDN & role ada di database
   - ✓ Password cocok (verify)
6. Create session dengan user data
7. Determine redirect URL based on role
8. Auto redirect ke dashboard

---

## 📝 Test Credentials

Setelah registrasi, gunakan data yang sama untuk login.

**Example:**
- Email: ahmad@test.com
- NPM/NIDN: 2111081001
- Password: TestPass123
- Role: Mahasiswa

---

## 🔧 Database Requirements

Table `users` harus memiliki:
```sql
CREATE TABLE users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    npm_nidn VARCHAR(15) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('mahasiswa', 'dosen') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

---

## 🎯 Testing Checklist

- [x] Register dengan data valid (Mahasiswa)
- [x] Register dengan data valid (Dosen)
- [x] Registrasi gagal - Email sudah terdaftar
- [x] Registrasi gagal - NPM/NIDN sudah terdaftar
- [x] Registrasi gagal - Password < 8 karakter
- [x] Registrasi gagal - Password tanpa uppercase
- [x] Registrasi gagal - Password tanpa lowercase
- [x] Registrasi gagal - Password tanpa number
- [x] Registrasi gagal - Email format invalid
- [x] Login dengan credentials benar
- [x] Login gagal - Password salah
- [x] Login gagal - NPM/NIDN tidak ada
- [x] Login redirect ke dashboard sesuai role

---

*Last Updated: December 11, 2025*
*Status: ✅ PRODUCTION READY*
