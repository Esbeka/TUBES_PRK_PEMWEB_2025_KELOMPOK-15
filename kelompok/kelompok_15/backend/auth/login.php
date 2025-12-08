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

header('Content-Type: application/json');
require_once __DIR__ . '/../../config/database.php';

session_start();

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
$email = isset($input['email']) ? trim($input['email']) : '';
$password = isset($input['password']) ? $input['password'] : '';

// Validasi field kosong
if (empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Email dan password harus diisi']);
    exit;
}

// Rate limiting (max 5 percobaan per 15 menit)
$rate_limit_key = 'login_attempts_' . $email;
$max_attempts = 5;
$timeout = 900; // 15 menit

if (isset($_SESSION[$rate_limit_key])) {
    if ($_SESSION[$rate_limit_key]['attempts'] >= $max_attempts) {
        if (time() - $_SESSION[$rate_limit_key]['first_attempt'] < $timeout) {
            http_response_code(429);
            echo json_encode(['status' => false, 'message' => 'Terlalu banyak percobaan login. Coba lagi nanti.']);
            exit;
        } else {
            // Reset attempts setelah timeout
            unset($_SESSION[$rate_limit_key]);
        }
    }
}

try {
    // Query user by email
    $stmt = $pdo->prepare("
        SELECT id_user, nama, email, password, role 
        FROM users 
        WHERE email = ?
    ");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if (!$user) {
        // Increment failed attempts
        if (!isset($_SESSION[$rate_limit_key])) {
            $_SESSION[$rate_limit_key] = [
                'attempts' => 1,
                'first_attempt' => time()
            ];
        } else {
            $_SESSION[$rate_limit_key]['attempts']++;
        }
        
        http_response_code(401);
        echo json_encode(['status' => false, 'message' => 'Email atau password salah']);
        exit;
    }
    
    // Verify password
    if (!password_verify($password, $user['password'])) {
        // Increment failed attempts
        if (!isset($_SESSION[$rate_limit_key])) {
            $_SESSION[$rate_limit_key] = [
                'attempts' => 1,
                'first_attempt' => time()
            ];
        } else {
            $_SESSION[$rate_limit_key]['attempts']++;
        }
        
        http_response_code(401);
        echo json_encode(['status' => false, 'message' => 'Email atau password salah']);
        exit;
    }
    
    // Clear rate limiting on successful login
    if (isset($_SESSION[$rate_limit_key])) {
        unset($_SESSION[$rate_limit_key]);
    }
    
    // Create session
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    
    http_response_code(200);
    echo json_encode([
        'status' => true,
        'message' => 'Login berhasil',
        'user' => [
            'id_user' => $user['id_user'],
            'nama' => $user['nama'],
            'email' => $user['email'],
            'role' => $user['role']
        ]
    ]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => false, 
        'message' => 'Terjadi kesalahan database. Silakan coba lagi.'
    ]);
}

?>
