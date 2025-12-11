<?php
/**
 * SESSION CHECK & AUTHORIZATION MIDDLEWARE
 * Helper functions untuk session management & role validation
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

/**
 * Check if user is logged in
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);
}

/**
 * Get current user ID
 * @return int|null
 */
function getUserId() {
    return $_SESSION['id_user'] ?? null;
}

/**
 * Get current user role
 * @return string|null
 */
function getUserRole() {
    return $_SESSION['role'] ?? null;
}

/**
 * Get current user name
 * @return string|null
 */
function getUserName() {
    return $_SESSION['nama'] ?? null;
}

/**
 * Check if user is dosen
 * @return bool
 */
function isDosen() {
    return (getUserRole() === 'dosen');
}

/**
 * Check if user is mahasiswa
 * @return bool
 */
function isMahasiswa() {
    return (getUserRole() === 'mahasiswa');
}

/**
 * Require user to be logged in
 * @throws Exception if not logged in
 */
function requireLogin() {
    if (!isLoggedIn()) {
        http_response_code(401);
        throw new Exception('Anda harus login terlebih dahulu', 401);
    }
}

/**
 * Require specific role
 * @param string $requiredRole - 'dosen' or 'mahasiswa'
 * @throws Exception if role doesn't match
 */
function requireRole($requiredRole) {
    requireLogin();
    
    if (getUserRole() !== $requiredRole) {
        http_response_code(403);
        throw new Exception('Akses ditolak - hanya ' . $requiredRole . ' yang dapat mengakses', 403);
    }
}

/**
 * Require dosen role
 * @throws Exception if user is not dosen
 */
function requireDosen() {
    requireRole('dosen');
}

/**
 * Require mahasiswa role
 * @throws Exception if user is not mahasiswa
 */
function requireMahasiswa() {
    requireRole('mahasiswa');
}

/**
 * Validate POST method
 * @throws Exception if not POST
 */
function validatePostMethod() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        throw new Exception('Method tidak diizinkan. Gunakan POST.', 405);
    }
}

/**
 * Validate GET method
 * @throws Exception if not GET
 */
function validateGetMethod() {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405);
        throw new Exception('Method tidak diizinkan. Gunakan GET.', 405);
    }
}
?>

