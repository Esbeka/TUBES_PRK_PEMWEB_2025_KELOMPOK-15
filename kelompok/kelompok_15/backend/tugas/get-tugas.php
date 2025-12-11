<?php
/**
 * GET TUGAS - List semua tugas dalam kelas
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session-helper.php';
require_once __DIR__ . '/../config/database.php';

try {
    if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'dosen') throw new Exception('Unauthorized');

    $id_kelas = $_GET['id_kelas'] ?? null;
    $id_dosen = $_SESSION['id_user'];
    
    if (!$id_kelas) throw new Exception('id_kelas required');

    $checkStmt = $pdo->prepare('SELECT id_kelas FROM kelas WHERE id_kelas = ? AND id_dosen = ?');
    $checkStmt->execute([$id_kelas, $id_dosen]);
    if (!$checkStmt->fetch()) throw new Exception('Forbidden');

    $stmt = $pdo->prepare('
        SELECT t.id_tugas, t.judul, t.deskripsi, t.deadline, t.bobot, t.status, t.created_at,
               COUNT(s.id_submission) as jumlah_submission
        FROM tugas t
        LEFT JOIN submission_tugas s ON t.id_tugas = s.id_tugas
        WHERE t.id_kelas = ?
        GROUP BY t.id_tugas
        ORDER BY t.deadline ASC
    ');
    $stmt->execute([$id_kelas]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'data' => $data]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
