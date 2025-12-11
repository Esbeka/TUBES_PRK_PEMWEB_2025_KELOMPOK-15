<?php
/**
 * UNENROLL MAHASISWA DARI KELAS
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session-helper.php';
require_once __DIR__ . '/../config/database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Method not allowed');
    if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'dosen') throw new Exception('Unauthorized');

    $data = json_decode(file_get_contents('php://input'), true);
    $id_kelas = $data['id_kelas'] ?? null;
    $id_mahasiswa = $data['id_mahasiswa'] ?? null;
    $id_dosen = $_SESSION['id_user'];

    if (!$id_kelas || !$id_mahasiswa) throw new Exception('id_kelas dan id_mahasiswa required');

    // Check ownership
    $checkStmt = $pdo->prepare('SELECT id_kelas FROM kelas WHERE id_kelas = ? AND id_dosen = ?');
    $checkStmt->execute([$id_kelas, $id_dosen]);
    if (!$checkStmt->fetch()) throw new Exception('Forbidden');

    // Unenroll
    $stmt = $pdo->prepare('DELETE FROM kelas_mahasiswa WHERE id_kelas = ? AND id_mahasiswa = ?');
    $stmt->execute([$id_kelas, $id_mahasiswa]);

    echo json_encode(['success' => true, 'message' => 'Mahasiswa berhasil dihapus dari kelas']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>