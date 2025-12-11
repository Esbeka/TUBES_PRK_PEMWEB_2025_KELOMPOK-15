-- ============================================
-- TEST DATA - JOIN KELAS FEATURE TESTING
-- Tanggung Jawab: Testing Join Kelas dengan berbagai skenario
-- ============================================

USE kelasonline;

-- ============================================
-- 1. SETUP TEST DOSEN (jika belum ada)
-- ============================================
INSERT INTO users (nama, email, password, role, npm_nidn)
SELECT 'Dr. Test Dosen', 'testdosen@kelasonline.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dosen', '1234567890'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = 'testdosen@kelasonline.com');

-- Get the test dosen ID
SET @test_dosen_id = (SELECT id_user FROM users WHERE email = 'testdosen@kelasonline.com');

-- ============================================
-- 2. SETUP TEST MAHASISWA (jika belum ada)
-- ============================================
INSERT INTO users (nama, email, password, role, npm_nidn)
SELECT 'Test Mahasiswa', 'testmahasiswa@kelasonline.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mahasiswa', '2024010001'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = 'testmahasiswa@kelasonline.com');

INSERT INTO users (nama, email, password, role, npm_nidn)
SELECT 'Test Mahasiswa 2', 'testmahasiswa2@kelasonline.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mahasiswa', '2024010002'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = 'testmahasiswa2@kelasonline.com');

-- ============================================
-- 3. TEST KELAS - NORMAL CAPACITY
-- Kode: TEST01
-- Skenario: Kelas normal dengan kapasitas 50
-- ============================================
INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas)
SELECT @test_dosen_id, 'Pemrograman Web Lanjut', 'TST101', '5', '2024/2025', 
       'Kelas untuk testing fitur join kelas dengan kapasitas normal. Mempelajari framework PHP modern dan JavaScript.', 
       'TEST01', 50
WHERE NOT EXISTS (SELECT 1 FROM kelas WHERE kode_kelas = 'TEST01');

-- ============================================
-- 4. TEST KELAS - FULL CAPACITY
-- Kode: FULL01
-- Skenario: Kelas dengan kapasitas penuh (1 slot)
-- ============================================
INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas)
SELECT @test_dosen_id, 'Kelas Kapasitas Penuh', 'TST102', '5', '2024/2025', 
       'Kelas untuk testing kapasitas penuh. Kapasitas: 1 mahasiswa saja.', 
       'FULL01', 1
WHERE NOT EXISTS (SELECT 1 FROM kelas WHERE kode_kelas = 'FULL01');

-- Isi kelas FULL01 dengan 1 mahasiswa untuk membuat penuh
SET @full_kelas_id = (SELECT id_kelas FROM kelas WHERE kode_kelas = 'FULL01');
SET @mahasiswa2_id = (SELECT id_user FROM users WHERE email = 'testmahasiswa2@kelasonline.com');

INSERT INTO kelas_mahasiswa (id_kelas, id_mahasiswa)
SELECT @full_kelas_id, @mahasiswa2_id
WHERE NOT EXISTS (
    SELECT 1 FROM kelas_mahasiswa 
    WHERE id_kelas = @full_kelas_id AND id_mahasiswa = @mahasiswa2_id
);

-- ============================================
-- 5. TEST KELAS - ALMOST FULL (80%+ capacity)
-- Kode: WARN01
-- Skenario: Kelas hampir penuh (warning state)
-- ============================================
INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas)
SELECT @test_dosen_id, 'Kelas Hampir Penuh', 'TST103', '5', '2024/2025', 
       'Kelas untuk testing kondisi warning (hampir penuh). Kapasitas: 5 mahasiswa, terisi 4.', 
       'WARN01', 5
WHERE NOT EXISTS (SELECT 1 FROM kelas WHERE kode_kelas = 'WARN01');

-- ============================================
-- 6. TEST KELAS - DUPLICATE TESTING
-- Kode: DUP001
-- Skenario: Untuk testing duplicate enrollment
-- ============================================
INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas)
SELECT @test_dosen_id, 'Kelas Duplicate Test', 'TST104', '5', '2024/2025', 
       'Kelas untuk testing pencegahan duplicate enrollment.', 
       'DUP001', 50
WHERE NOT EXISTS (SELECT 1 FROM kelas WHERE kode_kelas = 'DUP001');

-- ============================================
-- 7. VERIFICATION QUERIES
-- ============================================

-- Tampilkan semua test kelas
SELECT 
    k.id_kelas,
    k.kode_kelas,
    k.nama_matakuliah,
    k.kapasitas,
    COUNT(km.id_mahasiswa) AS terisi,
    k.kapasitas - COUNT(km.id_mahasiswa) AS sisa_slot,
    ROUND((COUNT(km.id_mahasiswa) / k.kapasitas) * 100, 1) AS persen_terisi,
    u.nama AS dosen
FROM kelas k
LEFT JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
LEFT JOIN users u ON k.id_dosen = u.id_user
WHERE k.kode_kelas IN ('TEST01', 'FULL01', 'WARN01', 'DUP001')
GROUP BY k.id_kelas, k.kode_kelas, k.nama_matakuliah, k.kapasitas, u.nama;

-- Tampilkan test users
SELECT id_user, nama, email, role, npm_nidn 
FROM users 
WHERE email LIKE '%test%';

-- ============================================
-- 8. CLEANUP QUERIES (OPSIONAL)
-- Jalankan jika ingin reset test data
-- ============================================

-- DELETE FROM kelas_mahasiswa WHERE id_kelas IN (SELECT id_kelas FROM kelas WHERE kode_kelas IN ('TEST01', 'FULL01', 'WARN01', 'DUP001'));
-- DELETE FROM kelas WHERE kode_kelas IN ('TEST01', 'FULL01', 'WARN01', 'DUP001');
-- DELETE FROM users WHERE email LIKE 'test%@kelasonline.com';

-- ============================================
-- TEST SCENARIOS SUMMARY:
-- ============================================
-- 
-- TEST01: Valid join test
--   - Kapasitas: 50
--   - Status: Available
--   - Expected: Join berhasil
--
-- FULL01: Full capacity test  
--   - Kapasitas: 1 (sudah terisi 1)
--   - Status: Full
--   - Expected: Error "Kelas sudah penuh"
--
-- WARN01: Warning capacity test
--   - Kapasitas: 5
--   - Status: Almost full (untuk visual test)
--   - Expected: Join berhasil, warning UI
--
-- DUP001: Duplicate enrollment test
--   - Join pertama: Berhasil
--   - Join kedua: Error "Anda sudah terdaftar"
--
-- XXXZZZ: Invalid code test
--   - Kode tidak ada di database
--   - Expected: Error "Kode kelas tidak ditemukan"
-- ============================================
