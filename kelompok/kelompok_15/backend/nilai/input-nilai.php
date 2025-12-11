<?php
// Input/create nilai (grade) for submission
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
    
    if (!$data || !isset($data['id_submission']) || !isset($data['nilai'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    $id_submission = $data['id_submission'];
    $nilai = intval($data['nilai']);
    $umpan_balik = $data['umpan_balik'] ?? '';
    $id_dosen = $_SESSION['id_user'];
    
    // Validate nilai (0-100)
    if ($nilai < 0 || $nilai > 100) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Nilai must be between 0-100']);
        exit;
    }

    // Get submission with tugas and kelas verification
    $stmt = $db->prepare("
        SELECT s.*, t.id_kelas 
        FROM submission_tugas s
        JOIN tugas t ON s.id_tugas = t.id_tugas
        JOIN kelas k ON t.id_kelas = k.id_kelas
        WHERE s.id_submission = ? AND k.id_dosen = ?
    ");
    $stmt->execute([$id_submission, $id_dosen]);
    $submission = $stmt->fetch();
    
    if (!$submission) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Forbidden - submission not found']);
        exit;
    }

    // Check if nilai already exists
    $stmt = $db->prepare("SELECT id_nilai FROM nilai WHERE id_submission = ?");
    $stmt->execute([$id_submission]);
    $existingNilai = $stmt->fetch();

    if ($existingNilai) {
        // Update existing
        $stmt = $db->prepare("
            UPDATE nilai 
            SET nilai = ?, umpan_balik = ?, tanggal_penilaian = NOW()
            WHERE id_submission = ?
        ");
        $stmt->execute([$nilai, $umpan_balik, $id_submission]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Nilai updated successfully'
        ]);
    } else {
        // Insert new
        $stmt = $db->prepare("
            INSERT INTO nilai (id_submission, nilai, umpan_balik, tanggal_penilaian)
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->execute([$id_submission, $nilai, $umpan_balik]);
        
        http_response_code(201);
        echo json_encode([
            'success' => true,
            'message' => 'Nilai created successfully',
            'id_nilai' => $db->lastInsertId()
        ]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;
}
?>
