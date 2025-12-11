<?php
/**
 * GET MATERI - List semua materi dalam kelas
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session-helper.php';
require_once __DIR__ . '/../config/database.php';

try {
    if (!isset($_SESSION['id_user']) || !isset($_SESSION['role'])) {
        http_response_code(401);
        throw new Exception('Unauthorized');
    }

    $id_kelas = $_GET['id_kelas'] ?? null;
    $id_dosen = $_SESSION['id_user'];
    
    if (!$id_kelas) {
        http_response_code(400);
        throw new Exception('id_kelas required');
    }

    $checkStmt = $pdo->prepare('SELECT id_kelas FROM kelas WHERE id_kelas = ? AND id_dosen = ?');
    $checkStmt->execute([$id_kelas, $id_dosen]);
    if (!$checkStmt->fetch()) {
        http_response_code(403);
        throw new Exception('Forbidden');
    }

    $stmt = $pdo->prepare('SELECT id_materi, judul, deskripsi, file_path, pertemuan_ke, created_at FROM materi WHERE id_kelas = ? ORDER BY pertemuan_ke ASC, created_at DESC');
    $stmt->execute([$id_kelas]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'data' => $data]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
