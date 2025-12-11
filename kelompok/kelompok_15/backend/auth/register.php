<?php
/**
 * FITUR 1: AUTENTIKASI - REGISTER
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Handle registrasi user baru (mahasiswa & dosen)
 * - Validasi server-side (email unique, password criteria)
 * - Hash password dengan password_hash()
 * - Insert user ke database
 * - Return JSON response
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/database.php';

$response = ['success' => false, 'message' => ''];

try {
    // Check method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method tidak diizinkan');
    }

    // 1. Validasi input POST (nama, email, password, role, npm_nidn)
    $requiredFields = ['nama', 'email', 'password', 'confirm_password', 'role', 'npm_nidn'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Field {$field} harus diisi");
        }
    }

    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $role = $_POST['role'];
    $npmNidn = trim($_POST['npm_nidn']);

    // Validasi nama (min 3 karakter)
    if (strlen($nama) < 3) {
        throw new Exception('Nama minimal 3 karakter');
    }

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Format email tidak valid');
    }

    // Validasi role
    if (!in_array($role, ['mahasiswa', 'dosen'])) {
        throw new Exception('Role tidak valid');
    }

    // 3. Validasi password (min 8 karakter, ada huruf besar & angka)
    if (strlen($password) < 8) {
        throw new Exception('Password minimal 8 karakter');
    }
    if (!preg_match('/[A-Z]/', $password)) {
        throw new Exception('Password harus mengandung minimal 1 huruf besar');
    }
    if (!preg_match('/[0-9]/', $password)) {
        throw new Exception('Password harus mengandung minimal 1 angka');
    }

    // Validasi confirm password
    if ($password !== $confirmPassword) {
        throw new Exception('Konfirmasi password tidak cocok');
    }

    // Validasi NPM/NIDN
    if ($role === 'mahasiswa' && strlen($npmNidn) < 8) {
        throw new Exception('NPM minimal 8 karakter');
    }
    if ($role === 'dosen' && strlen($npmNidn) < 8) {
        throw new Exception('NIDN minimal 8 karakter');
    }

    // 2. Cek email sudah terdaftar atau belum
    $checkSql = "SELECT COUNT(*) FROM users WHERE email = :email";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute(['email' => $email]);
    
    if ($checkStmt->fetchColumn() > 0) {
        throw new Exception('Email sudah terdaftar. Silakan gunakan email lain atau login');
    }

    // Cek NPM/NIDN sudah terdaftar
    $checkNpmSql = "SELECT COUNT(*) FROM users WHERE npm_nidn = :npm_nidn";
    $checkNpmStmt = $pdo->prepare($checkNpmSql);
    $checkNpmStmt->execute(['npm_nidn' => $npmNidn]);
    
    if ($checkNpmStmt->fetchColumn() > 0) {
        $label = ($role === 'mahasiswa') ? 'NPM' : 'NIDN';
        throw new Exception("{$label} sudah terdaftar");
    }

    // 4. Hash password dengan password_hash()
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 5. Insert ke tabel users
    $insertSql = "INSERT INTO users (nama, email, password, role, npm_nidn) 
                  VALUES (:nama, :email, :password, :role, :npm_nidn)";
    $insertStmt = $pdo->prepare($insertSql);
    $insertStmt->execute([
        'nama' => $nama,
        'email' => $email,
        'password' => $hashedPassword,
        'role' => $role,
        'npm_nidn' => $npmNidn
    ]);

    // 6. Return JSON success
    $response['success'] = true;
    $response['message'] = 'Registrasi berhasil! Silakan login dengan akun Anda';

} catch (PDOException $e) {
    $response['message'] = 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
