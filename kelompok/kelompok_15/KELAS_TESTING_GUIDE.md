#!/bin/bash
# QUICK REFERENCE - TESTING KELAS DOSEN

## ✅ Test Status: ALL PASSED (10/10)

---

## 🚀 How to Run Tests

### Windows PowerShell
```powershell
cd C:\xampp\htdocs\TUGASAKHIR\kelompok\kelompok_15
C:\xampp\php\php.exe backend/kelas/test-kelas.php
```

### Command Prompt
```cmd
cd C:\xampp\htdocs\TUGASAKHIR\kelompok\kelompok_15
C:\xampp\php\php.exe backend\kelas\test-kelas.php
```

### Git Bash / Linux
```bash
cd /c/xampp/htdocs/TUGASAKHIR/kelompok/kelompok_15
php backend/kelas/test-kelas.php
```

---

## 📋 Test Cases Breakdown

### TEST 1: Unique Code Generation (4 Tests)
```
✅ Test 1: Generate kode unik untuk kelas pertama
   └─ Result: Kode unik: PN1017

✅ Test 2: Verifikasi kode tidak bisa duplikat
   └─ Result: Constraint violation terdeteksi (expected)

✅ Test 3: Generate 10 kode unik dan verifikasi berbeda
   └─ Result: 10 kode unik berhasil di-generate: SH4243, GG6550, MH7980...

✅ Test 4: Format kode 2 huruf + 4 angka
   └─ Result: Format kode valid (AA0000 pattern)
```

### TEST 2: Cascade Delete (2 Tests)
```
✅ Test 5: Verifikasi data terkait ada sebelum delete
   └─ Result: Semua data terkait ada (kelas, mahasiswa, materi, tugas, submission)

✅ Test 6: Delete kelas dan verifikasi cascade
   └─ Result: Cascade delete berhasil! Semua data terkait dihapus
```

### TEST 3: Authorization (4 Tests)
```
✅ Test 7: Dosen 2 tidak bisa edit kelas milik Dosen 1
   └─ Result: Authorization check passed

✅ Test 8: Dosen 2 tidak bisa hapus kelas milik Dosen 1
   └─ Result: Authorization check passed

✅ Test 9: Dosen 2 bisa edit kelas miliknya sendiri
   └─ Result: Ownership verified

✅ Test 10: Get kelas dosen hanya menampilkan kelas miliknya
   └─ Result: Kelas filtering bekerja
```

---

## 🎯 Expected Output

```
====================================================================================================
TESTING SUITE - MANAJEMEN KELAS DOSEN
====================================================================================================

[SETUP] Membuat data dosen untuk testing...
✓ Dosen 1 berhasil dibuat (ID: 4)
✓ Dosen 2 berhasil dibuat (ID: 5)

[TEST 1] Generate Kode Unik (Tidak Duplikat)
----------------------------------------------------------------------------------------------------
✓ Test 1: Generate kode unik untuk kelas pertama
✓ Test 2: Verifikasi kode unik tidak bisa duplikat (sama dalam database)
✓ Test 3: Generate 10 kode unik dan verifikasi semuanya berbeda
✓ Test 4: Format kode harus 2 huruf + 4 angka

[TEST 2] Cascade Delete (Semua Data Terkait Terhapus)
----------------------------------------------------------------------------------------------------
✓ Test 5: Verifikasi data terkait ada sebelum delete
✓ Test 6: Delete kelas dan verifikasi cascade ke semua data terkait

[TEST 3] Authorization (Dosen Lain Tidak Bisa Edit/Hapus)
----------------------------------------------------------------------------------------------------
✓ Test 7: Dosen 2 tidak bisa edit kelas milik dosen 1 (authorization check)
✓ Test 8: Dosen 2 tidak bisa hapus kelas milik dosen 1 (authorization check)
✓ Test 9: Dosen 2 bisa edit kelas miliknya sendiri (ownership verified)
✓ Test 10: Get kelas dosen hanya menampilkan kelas milik dosen tersebut

[CLEANUP] Menghapus data test...
✓ Data test berhasil dihapus

====================================================================================================
SUMMARY TEST RESULTS
====================================================================================================
Total Tests: 10
Passed: 10 ✅
Failed: 0
Success Rate: 100%

✓ ALL TESTS PASSED! System ready for production.
====================================================================================================
```

---

## 🔍 Manual Testing Guide

### 1. Test Create Kelas (Frontend)
```
1. Open: http://localhost/TUGASAKHIR/kelompok/kelompok_15/pages/dashboard-dosen.html
2. Login as dosen
3. Click "Tambah Kelas Baru"
4. Fill form:
   - Nama Mata Kuliah: "Test Kelas"
   - Kode Mata Kuliah: "TEST101"
   - Semester: "5"
   - Tahun Ajaran: "2024/2025"
   - Deskripsi: "Testing"
   - Kapasitas: "50"
5. Click "Simpan"
6. Expected: Success alert dengan kode kelas auto-generated (e.g., AB1234)
```

### 2. Test Update Kelas
```
1. Click "Edit" di kelas yang baru dibuat
2. Change: Nama Mata Kuliah menjadi "Test Kelas Updated"
3. Click "Update"
4. Expected: Success alert, list refresh, nama updated
```

### 3. Test Unauthorized Edit (dosen lain)
```
1. Create kelas sebagai Dosen 1
2. Login as Dosen 2
3. Coba akses: http://localhost/.../get-detail-kelas.php?id_kelas=1
4. Expected: HTTP 403 Forbidden
```

### 4. Test Delete & Cascade
```
1. Create kelas sebagai Dosen
2. Add mahasiswa ke kelas
3. Add materi ke kelas
4. Add tugas ke kelas
5. Click "Hapus"
6. Confirm "Hapus"
7. Expected: Kelas & semua data terkait dihapus
```

---

## 📊 Test Summary

| Test | Category | Status | Details |
|------|----------|--------|---------|
| 1 | Unique Code Gen | ✅ PASS | Kode unik: PN1017 |
| 2 | Unique Constraint | ✅ PASS | Duplikat blocked |
| 3 | Batch Generation | ✅ PASS | 10 codes, no collision |
| 4 | Format Validation | ✅ PASS | AA0000 pattern |
| 5 | Pre-Delete Data | ✅ PASS | All tables exist |
| 6 | Cascade Delete | ✅ PASS | 5 tables cleaned |
| 7 | Auth Edit | ✅ PASS | 403 Forbidden |
| 8 | Auth Delete | ✅ PASS | 403 Forbidden |
| 9 | Owner Edit | ✅ PASS | Allowed |
| 10 | Data Isolation | ✅ PASS | Filtered by dosen |

---

## 🔧 Troubleshooting

### Test Not Running
```
Error: PHP not found
Solution: Use full path: C:\xampp\php\php.exe
```

### Database Connection Failed
```
Error: Database error
Solution: Check config/database.php is correct
         Verify MySQL running
```

### Authorization Tests Fail
```
Error: Ownership check failed
Solution: Check session-check.php has isDosen() function
         Verify ownership check in update/delete endpoints
```

### Cascade Delete Not Working
```
Error: Related data still exists
Solution: Check database foreign keys have ON DELETE CASCADE
         Run schema.sql again if needed
```

---

## 📁 Important Files

```
Testing:
├─ backend/kelas/test-kelas.php          ← Run this
├─ backend/kelas/create-kelas.php
├─ backend/kelas/update-kelas.php
├─ backend/kelas/delete-kelas.php
├─ backend/kelas/get-kelas-dosen.php
└─ backend/kelas/get-detail-kelas.php

Frontend:
├─ pages/dashboard-dosen.html
└─ assets/js/kelas-dosen.js

Documentation:
├─ KELAS_CRUD_DOCUMENTATION.md
└─ KELAS_CRUD_SUMMARY.md
```

---

## ✅ Verification Checklist

- [x] All 10 tests passing
- [x] Unique code generation working
- [x] Cascade delete verified
- [x] Authorization checks implemented
- [x] Frontend dashboard created
- [x] AJAX integration complete
- [x] Error handling comprehensive
- [x] Security features applied
- [x] Documentation complete
- [x] Ready for production

---

## 🚀 Deployment Checklist

Before production deployment:

- [ ] Run test-kelas.php and verify all 10 tests pass
- [ ] Test frontend at /pages/dashboard-dosen.html
- [ ] Verify database constraints exist
- [ ] Check error handling in all endpoints
- [ ] Review authorization checks
- [ ] Test cascade delete manually
- [ ] Verify unique code generation
- [ ] Check error logs
- [ ] Review security settings
- [ ] Deploy to production

---

## 📞 Quick Support

**Test Failed?** Run: `php backend/kelas/test-kelas.php`  
**Documentation:** Open `KELAS_CRUD_DOCUMENTATION.md`  
**API Endpoint:** POST to `/backend/kelas/create-kelas.php`

---

**Last Updated:** January 2025  
**Test Status:** ✅ ALL PASSED (10/10)  
**Production Ready:** YES
