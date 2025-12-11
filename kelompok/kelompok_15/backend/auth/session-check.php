<?php
/**
 * SESSION CHECK & AUTHORIZATION MIDDLEWARE
 * Helper functions untuk session management & role validation
 */

// Ensure session is started dengan proper configuration
require_once __DIR__ . '/session-helper.php';

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
