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

session_start();

/**
 * Check if user is logged in
 * Return true jika user sudah login, false sebaliknya
 */
function isLoggedIn() {
    return isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);
}

/**
 * Check if user is dosen
 * Return true jika user adalah dosen, false sebaliknya
 */
function isDosen() {
    return isLoggedIn() && $_SESSION['role'] === 'dosen';
}

/**
 * Check if user is mahasiswa
 * Return true jika user adalah mahasiswa, false sebaliknya
 */
function isMahasiswa() {
    return isLoggedIn() && $_SESSION['role'] === 'mahasiswa';
}

/**
 * Redirect to login if not logged in
 * Digunakan di awal halaman yang memerlukan autentikasi
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /pages/login.html');
        exit;
    }
}

/**
 * Redirect to login if not dosen
 * Digunakan di halaman yang hanya bisa diakses dosen
 */
function requireDosen() {
    if (!isDosen()) {
        header('Location: /pages/login.html');
        exit;
    }
}

/**
 * Redirect to login if not mahasiswa
 * Digunakan di halaman yang hanya bisa diakses mahasiswa
 */
function requireMahasiswa() {
    if (!isMahasiswa()) {
        header('Location: /pages/login.html');
        exit;
    }
}

/**
 * Get user data from session
 * Return array user data atau null jika tidak login
 */
function getUserData() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return [
        'id_user' => $_SESSION['id_user'],
        'nama' => $_SESSION['nama'],
        'email' => $_SESSION['email'],
        'role' => $_SESSION['role']
    ];
}

?>
