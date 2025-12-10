<?php
/**
 * FITUR 10: NOTIFIKASI - MARK READ
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Update status notifikasi menjadi read
 * - Validasi id_notification ownership
 * - Update is_read = TRUE
 * - Support single atau multiple notifications
 * - Return JSON success/error
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/database.php';

session_start();

// Cek session user
if (!isset($_SESSION['id_user']) || !isset($_SESSION['role'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized. User belum login.']);
    exit;
}

$id_user = (int) $_SESSION['id_user'];

// Validasi input
if (!isset($_POST['id_notification']) && !isset($_POST['id_notifications'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter id_notification atau id_notifications wajib diisi.']);
    exit;
}

try {
    // Support both single notification atau multiple
    $ids = [];
    
    if (isset($_POST['id_notification']) && is_numeric($_POST['id_notification'])) {
        // Single notification
        $ids = [(int) $_POST['id_notification']];
    } elseif (isset($_POST['id_notifications'])) {
        // Multiple notifications (array or JSON)
        $input = $_POST['id_notifications'];
        
        // If it's JSON string, decode it
        if (is_string($input)) {
            $decoded = json_decode($input, true);
            if (is_array($decoded)) {
                $ids = array_map('intval', $decoded);
            } else {
                // Try as comma-separated
                $ids = array_map('intval', explode(',', $input));
            }
        } elseif (is_array($input)) {
            $ids = array_map('intval', $input);
        }
    }
    
    if (empty($ids)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Tidak ada notification ID yang diberikan.']);
        exit;
    }
    
    // Validasi ownership dan update
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "UPDATE notifications 
            SET is_read = TRUE 
            WHERE id_notification IN ($placeholders) 
            AND id_user = ?";
    
    $stmt = $pdo->prepare($sql);
    
    // Bind values
    $params = array_merge($ids, [$id_user]);
    $stmt->execute($params);
    
    $rows_updated = $stmt->rowCount();
    
    if ($rows_updated > 0) {
        echo json_encode([
            'success' => true,
            'message' => "$rows_updated notifikasi berhasil ditandai sebagai read.",
            'data' => [
                'updated_count' => $rows_updated
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Notifikasi tidak ditemukan atau sudah dibaca.'
        ]);
    }
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
