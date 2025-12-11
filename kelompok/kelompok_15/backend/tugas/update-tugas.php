<?php
// Update assignment
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

    // Update allowed fields
    $updateFields = [];
    $params = [];

    if (isset($data['judul'])) {
        $updateFields[] = 'judul = ?';
        $params[] = $data['judul'];
    }

    if (isset($data['deskripsi'])) {
        $updateFields[] = 'deskripsi = ?';
        $params[] = $data['deskripsi'];
    }

    if (isset($data['deadline'])) {
        // Validate deadline is in future
        if (strtotime($data['deadline']) <= time()) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Deadline must be in the future']);
            exit;
        }
        $updateFields[] = 'deadline = ?';
        $params[] = $data['deadline'];
    }

    if (isset($data['bobot'])) {
        $bobot = intval($data['bobot']);
        if ($bobot < 1 || $bobot > 100) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Bobot must be between 1-100']);
            exit;
        }
        $updateFields[] = 'bobot = ?';
        $params[] = $bobot;
    }

    if (isset($data['status'])) {
        $validStatuses = ['active', 'closed', 'archived'];
        if (!in_array($data['status'], $validStatuses)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid status']);
            exit;
        }
        $updateFields[] = 'status = ?';
        $params[] = $data['status'];
    }

    if (empty($updateFields)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'No fields to update']);
        exit;
    }

    // Add id_tugas to params for WHERE clause
    $params[] = $id_tugas;

    // Build and execute update query
    $sql = 'UPDATE tugas SET ' . implode(', ', $updateFields) . ' WHERE id_tugas = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute($params);

    echo json_encode([
        'success' => true,
        'message' => 'Tugas updated successfully',
        'id_tugas' => $id_tugas
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;
}
?>
