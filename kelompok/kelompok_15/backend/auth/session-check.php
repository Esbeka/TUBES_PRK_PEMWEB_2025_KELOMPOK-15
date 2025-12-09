<?php
/**
 * FITUR 1: AUTENTIKASI - SESSION CHECK (Middleware)
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Middleware untuk proteksi halaman
 * - Cek user sudah login
 * - Cek role user untuk authorization
 * - Include di setiap halaman protected
 */

// Session management functions
/**
 * Cek apakah user sudah login
 */
function isLoggedIn() {
    return isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);
}

/**
 * Cek apakah user adalah dosen
 */
function isDosen() {
    return isLoggedIn() && isset($_SESSION['role']) && $_SESSION['role'] === 'dosen';
}

/**
 * Cek apakah user adalah mahasiswa
 */
function isMahasiswa() {
    return isLoggedIn() && isset($_SESSION['role']) && $_SESSION['role'] === 'mahasiswa';
}

/**
 * Redirect ke login jika belum login
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /TUGASAKHIR/kelompok/kelompok_15/pages/login.html');
        exit;
    }
}

/**
 * Redirect ke login jika bukan dosen
 */
function requireDosen() {
    if (!isDosen()) {
        header('Location: /TUGASAKHIR/kelompok/kelompok_15/pages/login.html');
        exit;
    }
}

/**
 * Redirect ke login jika bukan mahasiswa
 */
function requireMahasiswa() {
    if (!isMahasiswa()) {
        header('Location: /TUGASAKHIR/kelompok/kelompok_15/pages/login.html');
        exit;
    }
}

?>
