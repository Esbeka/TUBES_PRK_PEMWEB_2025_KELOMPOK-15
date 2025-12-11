<?php
/**
 * FITUR 8: MANAJEMEN PROFIL - GANTI PASSWORD
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Ganti password user
 * - Validasi password lama benar
 * - Validasi password baru (criteria)
 * - Hash password baru
 * - Update di database
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => ''];

try {
    // 1. Cek session
    requireLogin();
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed');
    }

    // 2. Validasi input POST
    if (empty($_POST['password_lama']) || empty($_POST['password_baru']) || empty($_POST['konfirmasi_password'])) {
        throw new Exception('Semua field password harus diisi');
    }

    $user_id = getUserId();
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // 3. Query user untuk get password lama
    $query = "SELECT password FROM users WHERE id_user = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    
    if (!$user) {
        throw new Exception('User tidak ditemukan');
    }

    // 4. Verify password lama dengan password_verify()
    if (!password_verify($password_lama, $user['password'])) {
        throw new Exception('Password lama tidak sesuai');
    }

    // 5. Validasi password baru (min 8 char, ada huruf besar & angka)
    if (strlen($password_baru) < 8) {
        throw new Exception('Password baru minimal 8 karakter');
    }
    
    if (!preg_match('/[A-Z]/', $password_baru)) {
        throw new Exception('Password baru harus mengandung huruf besar');
    }
    
    if (!preg_match('/[0-9]/', $password_baru)) {
        throw new Exception('Password baru harus mengandung angka');
    }

    // Validasi konfirmasi password
    if ($password_baru !== $konfirmasi_password) {
        throw new Exception('Konfirmasi password tidak sesuai');
    }

    // 6. Hash password baru
    $password_hash = password_hash($password_baru, PASSWORD_BCRYPT);

    // 7. Update password di users
    $update = "UPDATE users SET password = ? WHERE id_user = ?";
    $stmt = $pdo->prepare($update);
    $stmt->execute([$password_hash, $user_id]);

    // 8. Return JSON success
    $response['success'] = true;
    $response['message'] = 'Password berhasil diubah';

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
