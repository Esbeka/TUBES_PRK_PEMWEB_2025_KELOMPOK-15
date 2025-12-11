<?php
/**
 * GET MAHASISWA DALAM KELAS
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session-helper.php';
require_once __DIR__ . '/../config/database.php';

try {
    if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'dosen') throw new Exception('Unauthorized');

    $id_kelas = $_GET['id_kelas'] ?? null;
    $id_dosen = $_SESSION['id_user'];
    
    if (!$id_kelas) throw new Exception('id_kelas required');

    // Check ownership
    $checkStmt = $pdo->prepare('SELECT id_kelas FROM kelas WHERE id_kelas = ? AND id_dosen = ?');
    $checkStmt->execute([$id_kelas, $id_dosen]);
    if (!$checkStmt->fetch()) throw new Exception('Forbidden');

    // Get mahasiswa
    $stmt = $pdo->prepare('
        SELECT u.id_user, u.nama, u.email, u.npm_nidn, km.id_kelas_mahasiswa, km.joined_at
        FROM kelas_mahasiswa km
        JOIN users u ON km.id_mahasiswa = u.id_user
        WHERE km.id_kelas = ?
        ORDER BY km.joined_at DESC
    ');
    $stmt->execute([$id_kelas]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'data' => $data]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>