<?php
// Delete assignment with cascade delete
require_once '../config/database.php';
require_once '../auth/session-helper.php';

// Check authentication & role
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'dosen') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Parse JSON input
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data || !isset($data['id_tugas'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    $id_tugas = $data['id_tugas'];
    $id_dosen = $_SESSION['id_user'];
    
    // Get tugas with kelas verification
    $stmt = $db->prepare("
        SELECT t.*, k.id_dosen 
        FROM tugas t
        JOIN kelas k ON t.id_kelas = k.id_kelas
        WHERE t.id_tugas = ? AND k.id_dosen = ?
    ");
    $stmt->execute([$id_tugas, $id_dosen]);
    $tugas = $stmt->fetch();
    
    if (!$tugas) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Forbidden - tugas not found']);
        exit;
    }

    // Get all submissions to delete files
    $stmt = $db->prepare("
        SELECT file_path FROM submission_tugas 
        WHERE id_tugas = ? AND file_path IS NOT NULL
    ");
    $stmt->execute([$id_tugas]);
    $submissions = $stmt->fetchAll();

    // Delete submission files
    foreach ($submissions as $submission) {
        $filePath = '../uploads/tugas/' . $submission['file_path'];
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }

    // Delete tugas (cascade will handle submissions and nilai)
    $stmt = $db->prepare("DELETE FROM tugas WHERE id_tugas = ?");
    $stmt->execute([$id_tugas]);

    echo json_encode([
        'success' => true,
        'message' => 'Tugas deleted successfully'
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;
}
?>
