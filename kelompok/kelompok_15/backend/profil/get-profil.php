<?php
/**
 * FITUR 8: MANAJEMEN PROFIL - GET PROFIL
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Get data profil user
 * - Query data user by id dari session
 * - Return JSON profil lengkap
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => '', 'data' => null];

try {
    // 1. Cek session
    requireLogin();
    
    $user_id = getUserId();

    // 2. Query users WHERE id_user = session id
    $query = "SELECT id_user, nama, email, role, npm_nidn, no_telp, foto_profil, created_at 
              FROM users 
              WHERE id_user = ?";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    
    if (!$user) {
        throw new Exception('User tidak ditemukan');
    }

    // 3. Return JSON profil (tanpa password)
    $response['success'] = true;
    $response['message'] = 'Data profil berhasil diambil';
    $response['data'] = [
        'id_user' => intval($user['id_user']),
        'nama' => $user['nama'],
        'email' => $user['email'],
        'role' => $user['role'],
        'npm_nidn' => $user['npm_nidn'],
        'no_telp' => $user['no_telp'],
        'foto_profil' => $user['foto_profil'],
        'created_at' => $user['created_at']
    ];

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
