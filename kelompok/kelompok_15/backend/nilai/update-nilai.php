<?php
// Update nilai (grade)
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
    
    if (!$data || !isset($data['id_nilai'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing id_nilai']);
        exit;
    }

    $id_nilai = $data['id_nilai'];
    $id_dosen = $_SESSION['id_user'];
    
    // Verify ownership via submission->tugas->kelas->dosen
    $stmt = $db->prepare("
        SELECT n.id_nilai FROM nilai n
        JOIN submission_tugas s ON n.id_submission = s.id_submission
        JOIN tugas t ON s.id_tugas = t.id_tugas
        JOIN kelas k ON t.id_kelas = k.id_kelas
        WHERE n.id_nilai = ? AND k.id_dosen = ?
    ");
    $stmt->execute([$id_nilai, $id_dosen]);
    $nilai = $stmt->fetch();
    
    if (!$nilai) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Forbidden']);
        exit;
    }

    // Update fields
    $updateFields = [];
    $params = [];

    if (isset($data['nilai'])) {
        $nilaiVal = intval($data['nilai']);
        if ($nilaiVal < 0 || $nilaiVal > 100) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Nilai must be between 0-100']);
            exit;
        }
        $updateFields[] = 'nilai = ?';
        $params[] = $nilaiVal;
    }

    if (isset($data['umpan_balik'])) {
        $updateFields[] = 'umpan_balik = ?';
        $params[] = $data['umpan_balik'];
    }

    if (empty($updateFields)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'No fields to update']);
        exit;
    }

    // Add update timestamp and id
    $updateFields[] = 'tanggal_penilaian = NOW()';
    $params[] = $id_nilai;

    // Build and execute update query
    $sql = 'UPDATE nilai SET ' . implode(', ', $updateFields) . ' WHERE id_nilai = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute($params);

    echo json_encode([
        'success' => true,
        'message' => 'Nilai updated successfully'
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;
}
?>
