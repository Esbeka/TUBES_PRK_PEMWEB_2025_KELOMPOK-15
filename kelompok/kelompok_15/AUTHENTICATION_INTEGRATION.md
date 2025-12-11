# Testing & Integration Dokumentasi - Autentikasi

## Ringkasan
Dokumentasi ini mencakup integrasi form login/register dengan backend dan testing yang komprehensif untuk validasi flow autentikasi, session management, dan role-based access control.

---

## 1. INTEGRASI FORM LOGIN/REGISTER DENGAN BACKEND

### 1.1 Perubahan pada Form Login (`pages/login.html`)

**Perubahan Utama:**
- Mengubah field input dari `npm_nidn` menjadi `email` (sesuai dengan backend)
- Menghapus role selection radio button (role ditentukan oleh backend saat login)
- Menambahkan AJAX handler untuk form submission
- Menambahkan alert container untuk error/success messages
- Menambahkan loading state pada button

**Field Input:**
```html
<!-- Email Input -->
<input 
    type="email" 
    id="email"
    name="email" 
    required
    placeholder="Masukkan email Anda"
/>

<!-- Password Input -->
<input 
    type="password" 
    name="password" 
    id="password"
    required
    placeholder="Masukkan password"
/>
```

**Form Handler (JavaScript):**
```javascript
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    const response = await Auth.login(email, password);
    
    if (response.status) {
        // Store user data & redirect based on role
        localStorage.setItem('user', JSON.stringify(response.user));
        window.location.href = response.user.role === 'dosen' 
            ? './dashboard-dosen.php' 
            : './dashboard-mahasiswa.php';
    } else {
        Auth.showAlert('error', response.message);
    }
});
```

### 1.2 Perubahan pada Form Register (`pages/register.html`)

**Perubahan Utama:**
- Mengubah field `confirm_password` menjadi `password_confirm` (sesuai backend)
- Menambahkan password strength indicator
- Menambahkan real-time password match validation
- Menambahkan AJAX handler untuk form submission
- Menambahkan terms & conditions checkbox
- Menambahkan alert container

**Field Input Baru:**
```html
<!-- Password Strength Indicator -->
<div id="passwordStrength" class="password-strength"></div>
<p id="passwordRequirements" class="text-xs text-gray-600 mt-1"></p>

<!-- Password Match Validation -->
<p id="passwordMatch" class="text-xs mt-1"></p>

<!-- Terms & Conditions -->
<input type="checkbox" id="termsCheckbox" required>
```

**Validasi Real-time:**
```javascript
function checkPasswordStrength() {
    const password = document.getElementById('password').value;
    // Check: length >= 8, uppercase, numbers
    // Show strength bar: weak/medium/strong
}

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('passwordConfirm').value;
    // Show match status
}
```

**Form Handler:**
```javascript
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const userData = {
        nama: document.getElementById('nama').value,
        email: document.getElementById('email').value,
        npm_nidn: document.getElementById('npm_nidn').value,
        password: document.getElementById('password').value,
        password_confirm: document.getElementById('passwordConfirm').value,
        role: document.querySelector('input[name="role"]:checked').value
    };
    
    const response = await Auth.register(userData);
    
    if (response.status) {
        Auth.showAlert('success', response.message);
        setTimeout(() => {
            window.location.href = './login.html';
        }, 2000);
    } else {
        Auth.showAlert('error', response.message);
    }
});
```

### 1.3 Perubahan Backend

**login.php:**
- Support untuk JSON data (Content-Type: application/json)
- Support untuk form data (application/x-www-form-urlencoded)
- Rate limiting: max 5 percobaan per 15 menit
- Return user data + role untuk redirect client-side

**register.php:**
- Support untuk JSON data
- Validasi password strength: min 8 chars, huruf besar, angka
- Cek email duplicate (HTTP 409 Conflict)
- Hash password dengan password_hash()

---

## 2. TESTING FLOW REGISTRASI & LOGIN

### 2.1 Test Cases - Registrasi

#### Test 1: Valid Registration (Mahasiswa)
**Input:**
- nama: "Test Mahasiswa"
- email: "test_mahasiswa@unilamp.ac.id"
- npm_nidn: "2024001"
- password: "Password123"
- password_confirm: "Password123"
- role: "mahasiswa"

**Expected Output:**
- HTTP Status: 201 Created
- Response: `{"status": true, "message": "Registrasi berhasil..."}`

#### Test 2: Valid Registration (Dosen)
**Input:**
- role: "dosen"
- npm_nidn: "202400001"

**Expected Output:**
- HTTP Status: 201 Created
- User dapat login sebagai dosen

#### Test 3: Missing Fields
**Input:**
- Tidak ada field nama atau email

**Expected Output:**
- HTTP Status: 400 Bad Request
- Response: `{"status": false, "message": "Semua field harus diisi"}`

#### Test 4: Invalid Email Format
**Input:**
- email: "invalid-email-format"

**Expected Output:**
- HTTP Status: 400 Bad Request
- Response: `{"status": false, "message": "Format email tidak valid"}`

#### Test 5: Password Mismatch
**Input:**
- password: "Password123"
- password_confirm: "Password456"

**Expected Output:**
- HTTP Status: 400 Bad Request
- Response: `{"status": false, "message": "Password tidak cocok"}`

#### Test 6: Weak Password
**Input:**
- password: "weak"

**Expected Output:**
- HTTP Status: 400 Bad Request
- Response: `{"status": false, "message": "Password minimal 8 karakter"}`

**Password Requirements:**
- Minimum 8 characters
- At least 1 uppercase letter
- At least 1 number

#### Test 7: Duplicate Email
**Input:**
- Register dengan email yang sudah terdaftar

**Expected Output:**
- HTTP Status: 409 Conflict
- Response: `{"status": false, "message": "Email sudah terdaftar"}`

#### Test 8: Invalid Role
**Input:**
- role: "admin"

**Expected Output:**
- HTTP Status: 400 Bad Request
- Response: `{"status": false, "message": "Role tidak valid"}`

### 2.2 Test Cases - Login

#### Test 1: Valid Login
**Input:**
- email: "test_mahasiswa@unilamp.ac.id"
- password: "Password123"

**Expected Output:**
- HTTP Status: 200 OK
- Response: 
```json
{
    "status": true,
    "message": "Login berhasil",
    "user": {
        "id_user": 1,
        "nama": "Test Mahasiswa",
        "email": "test_mahasiswa@unilamp.ac.id",
        "role": "mahasiswa"
    }
}
```

#### Test 2: Invalid Email
**Input:**
- email: "nonexistent@unilamp.ac.id"
- password: "Password123"

**Expected Output:**
- HTTP Status: 401 Unauthorized
- Response: `{"status": false, "message": "Email atau password salah"}`

#### Test 3: Wrong Password
**Input:**
- email: "test_mahasiswa@unilamp.ac.id"
- password: "WrongPassword123"

**Expected Output:**
- HTTP Status: 401 Unauthorized
- Response: `{"status": false, "message": "Email atau password salah"}`

#### Test 4: Missing Fields
**Input:**
- email: "test@unilamp.ac.id"
- password: "" (kosong)

**Expected Output:**
- HTTP Status: 400 Bad Request
- Response: `{"status": false, "message": "Email dan password harus diisi"}`

#### Test 5: Rate Limiting
**Input:**
- 5 login attempts dengan password salah dalam 15 menit

**Expected Output pada attempt ke-6:**
- HTTP Status: 429 Too Many Requests
- Response: `{"status": false, "message": "Terlalu banyak percobaan login. Coba lagi nanti."}`

**Behavior:**
- Setiap failed login increment counter
- Counter direset setelah 15 menit
- Successful login juga mereset counter

---

## 3. SESSION MANAGEMENT

### 3.1 Session Creation Flow

**Login Success Flow:**
1. Backend verifikasi password
2. Create PHP session:
   ```php
   $_SESSION['id_user'] = $user['id_user'];
   $_SESSION['nama'] = $user['nama'];
   $_SESSION['email'] = $user['email'];
   $_SESSION['role'] = $user['role'];
   ```
3. Return user data ke frontend
4. Frontend store di localStorage
5. Frontend redirect ke dashboard

### 3.2 Session Check (Middleware)

**File:** `backend/auth/session-check.php`

**Fungsi-fungsi:**
```php
isLoggedIn()      // Check if user logged in
isDosen()         // Check if user is dosen
isMahasiswa()     // Check if user is mahasiswa
requireLogin()    // Redirect if not logged in
requireDosen()    // Redirect if not dosen
requireMahasiswa()// Redirect if not mahasiswa
```

**Usage pada Protected Pages:**
```php
require_once __DIR__ . '/../auth/session-check.php';
requireLogin(); // Redirect jika tidak logged in
requireDosen(); // Redirect jika bukan dosen
```

### 3.3 Session Persistence Testing

**Test Case:**
```
1. Login successful -> Session created
2. Refresh page -> Session masih exist
3. Logout -> Session destroyed
4. Try access protected page -> Redirect to login
```

---

## 4. ROLE-BASED ACCESS CONTROL

### 4.1 Role Types

**Mahasiswa:**
- Dapat: Join kelas, submit tugas, lihat materi
- Tidak dapat: Create kelas, score tugas

**Dosen:**
- Dapat: Create kelas, upload materi, score tugas
- Tidak dapat: Join kelas, submit tugas

### 4.2 Role Assignment

**During Registration:**
- User pilih role (mahasiswa/dosen)
- Backend store role di database

**During Login:**
- Backend return user role
- Frontend store di localStorage
- Frontend route ke dashboard sesuai role

### 4.3 Role-based Access Test Cases

#### Test 1: Mahasiswa Dashboard Access
**Scenario:**
1. Register sebagai mahasiswa
2. Login dengan mahasiswa account
3. Access dashboard

**Expected:**
- Redirect ke `dashboard-mahasiswa.php`
- Dapat access kelas yang di-join
- Tidak dapat create kelas

#### Test 2: Dosen Dashboard Access
**Scenario:**
1. Register sebagai dosen
2. Login dengan dosen account
3. Access dashboard

**Expected:**
- Redirect ke `dashboard-dosen.php`
- Dapat create kelas
- Dapat upload materi

#### Test 3: Cross-role Access Prevention
**Scenario:**
1. Login sebagai mahasiswa
2. Try access dosen-only page directly

**Expected:**
- Redirect to login atau show error
- Atau button disabled untuk non-authorized actions

#### Test 4: Middleware Protection
**Scenario:**
1. Logout
2. Try access protected page directly

**Expected:**
- Redirect to login.html
- Session data cleared

---

## 5. MENJALANKAN TESTS

### 5.1 Automated Testing

**File:** `backend/auth/test-auth.php`

**Cara Menjalankan:**
```bash
# Via Browser
http://localhost/kelompok/kelompok_15/backend/auth/test-auth.php

# Via Terminal
php test-auth.php
```

**Test Suites:**
1. Registrasi (8 test cases)
2. Login (5 test cases)
3. Session Management (3 test cases)
4. Role-based Access (2 test cases)

**Output:**
- ✓ PASSED - Test berhasil
- ✗ FAILED - Test gagal
- ⚠ SKIPPED - Test tidak dapat dijalankan
- Summary: Total, Passed, Failed, Success Rate

### 5.2 Manual Testing via Postman

**1. Test Register - Valid**
```
POST: http://localhost/kelompok/kelompok_15/backend/auth/register.php
Content-Type: application/json

Body:
{
    "nama": "Test User",
    "email": "test@unilamp.ac.id",
    "npm_nidn": "2024001",
    "password": "Password123",
    "password_confirm": "Password123",
    "role": "mahasiswa"
}
```

**2. Test Login - Valid**
```
POST: http://localhost/kelompok/kelompok_15/backend/auth/login.php
Content-Type: application/json

Body:
{
    "email": "test@unilamp.ac.id",
    "password": "Password123"
}
```

### 5.3 Manual Testing via Browser

**Test Flow 1: Happy Path**
1. Buka login.html
2. Klik "Daftar sekarang"
3. Isi form registrasi dengan valid data
4. Submit
5. Redirect ke login.html
6. Isi email & password
7. Submit
8. Redirect ke dashboard sesuai role

**Test Flow 2: Validation Testing**
1. Buka register.html
2. Isi nama saja, submit -> Error "Semua field harus diisi"
3. Isi email invalid, submit -> Error "Format email tidak valid"
4. Password terlalu pendek -> Error "Password minimal 8 karakter"
5. Password & confirm tidak cocok -> Error "Password tidak cocok"

**Test Flow 3: Rate Limiting**
1. Buka login.html
2. Masukkan email & wrong password
3. Submit 5 kali berturut-turut
4. Attempt ke-6 -> Error "Terlalu banyak percobaan login"

---

## 6. BUG FIXES & IMPROVEMENTS

### 6.1 Fixed Issues

1. **Form Field Mismatch**
   - ❌ Login menggunakan `npm_nidn`, Backend expects `email`
   - ✅ Fixed: Login now uses `email` field

2. **Password Confirmation Field Name**
   - ❌ Register form uses `confirm_password`
   - ✅ Fixed: Now uses `password_confirm` (sesuai backend)

3. **Missing JSON Support**
   - ❌ Backend hanya support form data
   - ✅ Fixed: Backend now support JSON & form data

4. **Missing Alert Container**
   - ❌ No place untuk show error/success messages
   - ✅ Fixed: Added alert container di setiap form

5. **No Loading State**
   - ❌ User tidak tahu form sedang disubmit
   - ✅ Fixed: Button shows loading spinner

### 6.2 Security Improvements

1. **Password Hashing**: bcrypt dengan PASSWORD_BCRYPT
2. **Rate Limiting**: Max 5 attempts per 15 minutes
3. **Email Validation**: filter_var() dengan FILTER_VALIDATE_EMAIL
4. **SQL Injection Prevention**: Prepared statements dengan PDO
5. **Password Requirements**: Min 8 chars, uppercase, numbers

### 6.3 UX Improvements

1. **Real-time Validation**: Password strength indicator
2. **Password Match Check**: Confirm password validation
3. **Loading State**: Disabled button during submission
4. **Error Messages**: Clear, specific error messages
5. **Success Feedback**: Green alert untuk successful actions

---

## 7. SUMMARY CHECKLIST

### Integrasi
- ✅ Form login terintegrasi dengan backend
- ✅ Form register terintegrasi dengan backend
- ✅ AJAX submission untuk form
- ✅ Error handling & display
- ✅ Success redirect

### Testing - Registrasi
- ✅ Valid registration (mahasiswa & dosen)
- ✅ Missing fields validation
- ✅ Invalid email format validation
- ✅ Password mismatch validation
- ✅ Weak password validation
- ✅ Duplicate email validation
- ✅ Invalid role validation

### Testing - Login
- ✅ Valid login dengan correct credentials
- ✅ Invalid email error handling
- ✅ Wrong password error handling
- ✅ Missing fields validation
- ✅ Rate limiting implementation

### Session Management
- ✅ Session creation pada login
- ✅ Session data storage
- ✅ Session persistence
- ✅ Session check middleware
- ✅ Session destruction pada logout

### Role-based Access
- ✅ Mahasiswa role assignment
- ✅ Dosen role assignment
- ✅ Role-based redirect
- ✅ Protected page access
- ✅ Cross-role access prevention

---

## 8. NEXT STEPS

1. **Database Seeding**: Buat test data untuk development
2. **Email Verification**: Implementasi email verification untuk registrasi
3. **Password Recovery**: Implementasi "Lupa Password" feature
4. **Two-factor Authentication**: Opsi 2FA untuk security
5. **OAuth Integration**: Google/Microsoft login
6. **Profile Management**: Edit profile, change password
7. **Activity Logging**: Log login/logout activities
8. **Session Timeout**: Auto-logout after inactivity

---

**Last Updated:** December 8, 2025
**Status:** Complete & Ready for Testing
