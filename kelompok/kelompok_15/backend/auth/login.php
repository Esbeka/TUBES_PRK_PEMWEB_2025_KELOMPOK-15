<?php
/**
 * FITUR 1: AUTENTIKASI - LOGIN
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Handle login user
 * - Validasi credentials (email + password)
 * - Gunakan password_verify()
 * - Buat session dengan user data
 * - Implement rate limiting (max 5 percobaan)
 * - Return JSON dengan redirect URL
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/database.php';

session_start();

$response = ['success' => false, 'message' => '', 'redirect' => ''];

try {
    // 1. Validasi input POST (email, password)
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method tidak diizinkan');
    }

    if (empty($_POST['email']) || empty($_POST['password'])) {
        throw new Exception('Email dan password harus diisi');
    }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Format email tidak valid');
    }

    // Rate limiting check (simple implementation using session)
    $rateLimitKey = 'login_attempts_' . md5($email);
    if (!isset($_SESSION[$rateLimitKey])) {
        $_SESSION[$rateLimitKey] = ['count' => 0, 'time' => time()];
    }

    // Reset counter if 15 minutes passed
    if (time() - $_SESSION[$rateLimitKey]['time'] > 900) {
        $_SESSION[$rateLimitKey] = ['count' => 0, 'time' => time()];
    }

    // Check if max attempts reached
    if ($_SESSION[$rateLimitKey]['count'] >= 5) {
        $remainingTime = 900 - (time() - $_SESSION[$rateLimitKey]['time']);
        throw new Exception('Terlalu banyak percobaan login. Coba lagi dalam ' . ceil($remainingTime / 60) . ' menit');
    }

    // 2. Query user by email
    $sql = "SELECT id_user, nama, email, password, role, npm_nidn, foto_profil 
            FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        $_SESSION[$rateLimitKey]['count']++;
        throw new Exception('Email atau password salah');
    }

    // 3. Verify password dengan password_verify()
    if (!password_verify($password, $user['password'])) {
        $_SESSION[$rateLimitKey]['count']++;
        throw new Exception('Email atau password salah');
    }

    // Reset rate limit on successful login
    unset($_SESSION[$rateLimitKey]);

    // 4. Create session (id_user, nama, email, role)
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['npm_nidn'] = $user['npm_nidn'];
    $_SESSION['foto_profil'] = $user['foto_profil'];
    $_SESSION['logged_in'] = true;
    $_SESSION['login_time'] = time();

    // 5. Determine redirect based on role
    $redirect = ($user['role'] === 'dosen') 
        ? '../pages/dashboard-dosen.php' 
        : '../pages/dashboard-mahasiswa.php';

    // 6. Return JSON dengan redirect berdasarkan role
    $response['success'] = true;
    $response['message'] = 'Login berhasil! Selamat datang, ' . $user['nama'];
    $response['redirect'] = $redirect;
    $response['user'] = [
        'id_user' => $user['id_user'],
        'nama' => $user['nama'],
        'email' => $user['email'],
        'role' => $user['role']
    ];

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
