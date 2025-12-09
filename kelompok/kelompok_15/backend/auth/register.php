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

header('Content-Type: application/json');
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get POST data - support both JSON and form data
$input = [];
if ($_SERVER['CONTENT_TYPE'] === 'application/json' || strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
    $input = json_decode(file_get_contents("php://input"), true) ?? [];
} else {
    $input = $_POST;
}

// Validasi input
$nama = isset($input['nama']) ? trim($input['nama']) : '';
$email = isset($input['email']) ? trim($input['email']) : '';
$password = isset($input['password']) ? $input['password'] : '';
$password_confirm = isset($input['password_confirm']) ? $input['password_confirm'] : '';
$role = isset($input['role']) ? trim($input['role']) : '';
$npm_nidn = isset($input['npm_nidn']) ? trim($input['npm_nidn']) : '';

// Validasi field kosong
if (empty($nama) || empty($email) || empty($password) || empty($role) || empty($npm_nidn)) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Semua field harus diisi']);
    exit;
}

// Validasi format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Format email tidak valid']);
    exit;
}

// Validasi password confirm
if ($password !== $password_confirm) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Password tidak cocok']);
    exit;
}

// Validasi password strength (min 8 karakter, ada huruf besar & angka)
if (strlen($password) < 8) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Password minimal 8 karakter']);
    exit;
}

if (!preg_match('/[A-Z]/', $password)) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Password harus mengandung huruf besar']);
    exit;
}

if (!preg_match('/[0-9]/', $password)) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Password harus mengandung angka']);
    exit;
}

// Validasi role
if (!in_array($role, ['mahasiswa', 'dosen'])) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Role tidak valid']);
    exit;
}

try {
    // Cek email sudah terdaftar
    $stmt = $pdo->prepare("SELECT id_user FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        http_response_code(409);
        echo json_encode(['status' => false, 'message' => 'Email sudah terdaftar']);
        exit;
    }
    
    // Hash password
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);
    
    // Insert user
    $stmt = $pdo->prepare("
        INSERT INTO users (nama, email, password, role, npm_nidn) 
        VALUES (?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([$nama, $email, $password_hashed, $role, $npm_nidn]);
    
    http_response_code(201);
    echo json_encode([
        'status' => true, 
        'message' => 'Registrasi berhasil. Silahkan login.',
        'redirect' => '/login.html'
    ]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => false, 
        'message' => 'Terjadi kesalahan database. Silakan coba lagi.'
    ]);
}

?>
