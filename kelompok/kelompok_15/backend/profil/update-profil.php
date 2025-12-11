<?php
/**
 * FITUR 8: MANAJEMEN PROFIL - UPDATE PROFIL
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Update profil user
 * - Update nama, no_telp
 * - Validasi input
 * - Return JSON success/error
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
    if (empty($_POST['nama'])) {
        throw new Exception('Nama harus diisi');
    }

    $user_id = getUserId();
    $nama = trim($_POST['nama']);
    $no_telp = isset($_POST['no_telp']) ? trim($_POST['no_telp']) : null;

    // Validasi nama
    if (strlen($nama) < 3) {
        throw new Exception('Nama minimal 3 karakter');
    }

    // Validasi no_telp jika ada
    if ($no_telp !== null && !empty($no_telp)) {
        if (!preg_match('/^(\+62|62|0)[0-9]{9,12}$/', $no_telp)) {
            throw new Exception('Format nomor telepon tidak valid');
        }
    }

    // 3. Update users WHERE id_user = session id
    $update = "UPDATE users SET nama = ?, no_telp = ? WHERE id_user = ?";
    
    $stmt = $pdo->prepare($update);
    $stmt->execute([$nama, $no_telp, $user_id]);

    // 4. Return JSON success
    $response['success'] = true;
    $response['message'] = 'Profil berhasil diupdate';

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
