<?php
/**
 * FITUR 1: AUTENTIKASI - LOGIN
 * Handle login user dengan validasi credentials
 */

require_once __DIR__ . '/session-helper.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');

require_once '../../config/database.php';

try {
    // Validasi method POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method tidak diizinkan', 405);
    }

    // Get input
    $npm_nidn = trim($_POST['npm_nidn'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'mahasiswa';

    // Validasi input
    if (empty($npm_nidn) || empty($password)) {
        throw new Exception('NPM/NIDN dan password harus diisi', 400);
    }

    if (!in_array($role, ['mahasiswa', 'dosen'])) {
        throw new Exception('Role tidak valid', 400);
    }

    // Query user berdasarkan npm_nidn & role
    $stmt = $pdo->prepare('
        SELECT id_user, nama, email, npm_nidn, role, password 
        FROM users 
        WHERE npm_nidn = ? AND role = ?
        LIMIT 1
    ');
    $stmt->execute([$npm_nidn, $role]);
    $user = $stmt->fetch();

    // Cek user ada atau tidak
    if (!$user) {
        throw new Exception('NPM/NIDN atau password salah', 401);
    }

    // Verify password
    if (!password_verify($password, $user['password'])) {
        throw new Exception('NPM/NIDN atau password salah', 401);
    }

    // Create session
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['npm_nidn'] = $user['npm_nidn'];
    $_SESSION['role'] = $user['role'];

    // CRITICAL: Force session to write/persist BEFORE sending response
    session_write_close();
    
    // Explicitly send Set-Cookie header with maximum compatibility
    $session_id = session_id();
    $cookie_value = $session_id;
    
    // Send custom Set-Cookie header to ensure browser receives it
    header('Set-Cookie: PHPID=' . $cookie_value . '; Path=/; HttpOnly=false; SameSite=None; Secure=false', false);
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Origin: ' . ($_SERVER['HTTP_ORIGIN'] ?? '*'));
    
    // Restart session for next request
    session_start();

    // Determine redirect URL based on role
    $redirect_url = ($user['role'] === 'dosen') 
        ? '/TUGASAKHIR/kelompok/kelompok_15/pages/dashboard-dosen.php'
        : '/TUGASAKHIR/kelompok/kelompok_15/pages/dashboard-mahasiswa.php';

    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Login berhasil',
        'redirect' => $redirect_url,
        'user' => [
            'id_user' => $user['id_user'],
            'nama' => $user['nama'],
            'email' => $user['email'],
            'role' => $user['role']
        ],
        'session_id' => $session_id,
        'debug' => [
            'session_id_value' => $session_id,
            'session_name' => session_name(),
            'save_path' => ini_get('session.save_path'),
            'headers_sent' => headers_sent()
        ]
    ]);

} catch (Exception $e) {
    $code = $e->getCode() ?: 500;
    http_response_code($code);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
