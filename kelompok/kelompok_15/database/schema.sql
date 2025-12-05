-- ============================================
-- DATABASE SCHEMA - SISTEM E-LEARNING KELASONLINE
-- Tanggung Jawab: ELISA (Database Engineer)
-- ============================================

-- Create database
CREATE DATABASE IF NOT EXISTS kelasonline;
USE kelasonline;

-- ============================================
-- TABEL 1: USERS
-- Menyimpan data user (mahasiswa & dosen)
-- ============================================
CREATE TABLE users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('mahasiswa', 'dosen') NOT NULL,
    npm_nidn VARCHAR(20) NOT NULL,
    foto_profil VARCHAR(255) DEFAULT NULL,
    no_telp VARCHAR(20) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Index untuk performance
CREATE INDEX idx_email ON users(email);
CREATE INDEX idx_role ON users(role);

-- ============================================
-- TABEL 2: KELAS
-- Menyimpan data kelas yang dibuat dosen
-- ============================================
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
    FOREIGN KEY (id_dosen) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Index untuk performance
CREATE INDEX idx_kode_kelas ON kelas(kode_kelas);
CREATE INDEX idx_id_dosen ON kelas(id_dosen);

-- ============================================
-- TABEL 3: KELAS_MAHASISWA (Junction Table)
-- Menyimpan enrollment mahasiswa ke kelas
-- ============================================
CREATE TABLE kelas_mahasiswa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_kelas INT NOT NULL,
    id_mahasiswa INT NOT NULL,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas) ON DELETE CASCADE,
    FOREIGN KEY (id_mahasiswa) REFERENCES users(id_user) ON DELETE CASCADE,
    UNIQUE KEY unique_enrollment (id_kelas, id_mahasiswa)
);

-- Index untuk performance
CREATE INDEX idx_id_kelas ON kelas_mahasiswa(id_kelas);
CREATE INDEX idx_id_mahasiswa ON kelas_mahasiswa(id_mahasiswa);

-- ============================================
-- TABEL 4: MATERI
-- Menyimpan materi pembelajaran (PDF/Video)
-- ============================================
CREATE TABLE materi (
    id_materi INT PRIMARY KEY AUTO_INCREMENT,
    id_kelas INT NOT NULL,
    judul VARCHAR(150) NOT NULL,
    deskripsi TEXT,
    tipe ENUM('pdf', 'video') NOT NULL,
    file_path VARCHAR(255) DEFAULT NULL,
    video_url VARCHAR(255) DEFAULT NULL,
    pertemuan_ke INT NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas) ON DELETE CASCADE
);

-- Index untuk performance
CREATE INDEX idx_id_kelas_materi ON materi(id_kelas);
CREATE INDEX idx_pertemuan ON materi(pertemuan_ke);

-- ============================================
-- TABEL 5: TUGAS
-- Menyimpan data tugas yang dibuat dosen
-- ============================================
CREATE TABLE tugas (
    id_tugas INT PRIMARY KEY AUTO_INCREMENT,
    id_kelas INT NOT NULL,
    judul VARCHAR(150) NOT NULL,
    deskripsi TEXT NOT NULL,
    deadline DATETIME NOT NULL,
    max_file_size INT DEFAULT 10,
    allowed_formats VARCHAR(50) DEFAULT 'pdf,zip,docx',
    bobot INT DEFAULT 100,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas) ON DELETE CASCADE
);

-- Index untuk performance
CREATE INDEX idx_id_kelas_tugas ON tugas(id_kelas);
CREATE INDEX idx_deadline ON tugas(deadline);

-- ============================================
-- TABEL 6: SUBMISSION_TUGAS
-- Menyimpan submission tugas dari mahasiswa
-- ============================================
CREATE TABLE submission_tugas (
    id_submission INT PRIMARY KEY AUTO_INCREMENT,
    id_tugas INT NOT NULL,
    id_mahasiswa INT NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    keterangan TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('submitted', 'late', 'graded') NOT NULL,
    FOREIGN KEY (id_tugas) REFERENCES tugas(id_tugas) ON DELETE CASCADE,
    FOREIGN KEY (id_mahasiswa) REFERENCES users(id_user) ON DELETE CASCADE,
    UNIQUE KEY unique_submission (id_tugas, id_mahasiswa)
);

-- Index untuk performance
CREATE INDEX idx_id_tugas_submission ON submission_tugas(id_tugas);
CREATE INDEX idx_id_mahasiswa_submission ON submission_tugas(id_mahasiswa);
CREATE INDEX idx_status ON submission_tugas(status);

-- ============================================
-- TABEL 7: NILAI
-- Menyimpan nilai & feedback dari dosen
-- ============================================
CREATE TABLE nilai (
    id_nilai INT PRIMARY KEY AUTO_INCREMENT,
    id_submission INT NOT NULL,
    nilai DECIMAL(5,2) NOT NULL,
    feedback TEXT,
    graded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_submission) REFERENCES submission_tugas(id_submission) ON DELETE CASCADE
);

-- Index untuk performance
CREATE INDEX idx_id_submission ON nilai(id_submission);

-- ============================================
-- TABEL 8: NOTIFICATIONS (BONUS)
-- Menyimpan notifikasi real-time
-- ============================================
CREATE TABLE notifications (
    id_notification INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    link VARCHAR(255),
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Index untuk performance
CREATE INDEX idx_id_user_notif ON notifications(id_user);
CREATE INDEX idx_is_read ON notifications(is_read);

-- ============================================
-- TABEL 9: LOG_AKSES_MATERI (BONUS/OPTIONAL)
-- Menyimpan tracking akses materi mahasiswa
-- ============================================
CREATE TABLE log_akses_materi (
    id_log INT PRIMARY KEY AUTO_INCREMENT,
    id_mahasiswa INT NOT NULL,
    id_materi INT NOT NULL,
    accessed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_mahasiswa) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_materi) REFERENCES materi(id_materi) ON DELETE CASCADE
);

-- Index untuk performance
CREATE INDEX idx_id_mahasiswa_log ON log_akses_materi(id_mahasiswa);
CREATE INDEX idx_id_materi_log ON log_akses_materi(id_materi);

-- ============================================
-- TRIGGER: Auto-set status submission
-- Status 'submitted' jika <= deadline
-- Status 'late' jika > deadline
-- ============================================
DELIMITER $$
CREATE TRIGGER set_submission_status 
BEFORE INSERT ON submission_tugas
FOR EACH ROW
BEGIN
    DECLARE task_deadline DATETIME;
    SELECT deadline INTO task_deadline FROM tugas WHERE id_tugas = NEW.id_tugas;
    IF NOW() > task_deadline THEN
        SET NEW.status = 'late';
    ELSE
        SET NEW.status = 'submitted';
    END IF;
END$$
DELIMITER ;

-- ============================================
-- VIEW: Statistik Kelas (OPTIONAL)
-- Untuk optimize query dashboard
-- ============================================
CREATE VIEW view_kelas_stats AS
SELECT 
    k.id_kelas,
    k.nama_matakuliah,
    k.kode_kelas,
    COUNT(DISTINCT km.id_mahasiswa) as jumlah_mahasiswa,
    COUNT(DISTINCT m.id_materi) as jumlah_materi,
    COUNT(DISTINCT t.id_tugas) as jumlah_tugas
FROM kelas k
LEFT JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
LEFT JOIN materi m ON k.id_kelas = m.id_kelas
LEFT JOIN tugas t ON k.id_kelas = t.id_kelas
GROUP BY k.id_kelas;

-- ============================================
-- SELESAI - Database schema created!
-- Next: Create seed.sql untuk sample data
-- ============================================
