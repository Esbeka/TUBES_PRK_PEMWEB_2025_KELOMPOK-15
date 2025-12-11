<?php
/**
 * DELETE MATERI
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session-helper.php';
require_once __DIR__ . '/../config/database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        throw new Exception('Method not allowed');
    }

    if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'dosen') {
        http_response_code(401);
        throw new Exception('Unauthorized');
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $id_materi = $data['id_materi'] ?? null;
    $id_dosen = $_SESSION['id_user'];

    if (!$id_materi) {
        http_response_code(400);
        throw new Exception('id_materi required');
    }

    $stmt = $pdo->prepare('SELECT file_path FROM materi WHERE id_materi = ? AND id_dosen = ?');
    $stmt->execute([$id_materi, $id_dosen]);
    $materi = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$materi) {
        http_response_code(403);
        throw new Exception('Forbidden');
    }

    $file_path = __DIR__ . '/../../uploads/materi/' . $materi['file_path'];
    if (file_exists($file_path)) unlink($file_path);

    $delStmt = $pdo->prepare('DELETE FROM materi WHERE id_materi = ?');
    $delStmt->execute([$id_materi]);

    echo json_encode(['success' => true, 'message' => 'Materi berhasil dihapus']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
