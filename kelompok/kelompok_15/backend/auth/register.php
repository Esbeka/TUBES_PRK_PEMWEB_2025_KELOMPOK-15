<?php
/**
 * FITUR 1: AUTENTIKASI - REGISTER
 * Handle registrasi user baru (mahasiswa & dosen)
 */

header('Content-Type: application/json');

require_once '../../config/database.php';

try {
    // Validasi method POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method tidak diizinkan', 405);
    }

    // Get input
    $nama = trim($_POST['nama'] ?? '');
    $npm_nidn = trim($_POST['npm_nidn'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $role = $_POST['role'] ?? 'mahasiswa';

    // Validasi input
    if (empty($nama) || empty($npm_nidn) || empty($email) || empty($password)) {
        throw new Exception('Semua field harus diisi', 400);
    }

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Format email tidak valid', 400);
    }

    // Validasi nama (min 3 chars)
    if (strlen($nama) < 3 || strlen($nama) > 100) {
        throw new Exception('Nama harus 3-100 karakter', 400);
    }

    // Validasi npm_nidn (10-15 karakter)
    if (!preg_match('/^\d{8,15}$/', $npm_nidn)) {
        throw new Exception('NPM/NIDN harus 8-15 angka', 400);
    }

    // Validasi password
    if (strlen($password) < 8 || strlen($password) > 128) {
        throw new Exception('Password minimal 8 karakter', 400);
    }

    if (!preg_match('/[A-Z]/', $password)) {
        throw new Exception('Password harus mengandung huruf besar', 400);
    }

    if (!preg_match('/[a-z]/', $password)) {
        throw new Exception('Password harus mengandung huruf kecil', 400);
    }

    if (!preg_match('/\d/', $password)) {
        throw new Exception('Password harus mengandung angka', 400);
    }

    // Validasi confirm password
    if ($password !== $confirm_password) {
        throw new Exception('Password dan konfirmasi password tidak sesuai', 400);
    }

    // Validasi role
    if (!in_array($role, ['mahasiswa', 'dosen'])) {
        throw new Exception('Role tidak valid', 400);
    }

    // Cek email sudah terdaftar
    $stmt = $pdo->prepare('SELECT id_user FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        throw new Exception('Email sudah terdaftar', 409);
    }

    // Cek npm_nidn sudah terdaftar
    $stmt = $pdo->prepare('SELECT id_user FROM users WHERE npm_nidn = ? LIMIT 1');
    $stmt->execute([$npm_nidn]);
    if ($stmt->fetch()) {
        throw new Exception('NPM/NIDN sudah terdaftar', 409);
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    // Insert user ke database
    $stmt = $pdo->prepare('
        INSERT INTO users (nama, email, npm_nidn, password, role, created_at)
        VALUES (?, ?, ?, ?, ?, NOW())
    ');
    $stmt->execute([$nama, $email, $npm_nidn, $password_hash, $role]);

    http_response_code(201);
    echo json_encode([
        'success' => true,
        'message' => 'Registrasi berhasil! Silakan login dengan akun Anda.',
        'data' => [
            'id_user' => $pdo->lastInsertId(),
            'nama' => $nama,
            'email' => $email,
            'npm_nidn' => $npm_nidn,
            'role' => $role
        ]
    ]);

} catch (Exception $e) {
    $code = $e->getCode() ?: 500;
    if ($code === 0) $code = 500;
    
    http_response_code($code);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
