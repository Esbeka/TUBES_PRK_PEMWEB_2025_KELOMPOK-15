<?php
/**
 * FITUR 10: NOTIFIKASI - GET NOTIFICATIONS
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Query notifikasi user (unread first)
 * - Get semua notifikasi user
 * - Order by is_read (unread dulu) & created_at DESC
 * - Return JSON array notifikasi
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/database.php';

session_start();

// Cek session user (mahasiswa atau dosen)
if (!isset($_SESSION['id_user']) || !isset($_SESSION['role'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized. User belum login.']);
    exit;
}

$id_user = (int) $_SESSION['id_user'];

// Optional: limit parameter
$limit = isset($_GET['limit']) && is_numeric($_GET['limit']) ? (int) $_GET['limit'] : 10;
$limit = min($limit, 50); // Max 50

try {
    // Query notifikasi user - unread first, then by created_at DESC
    $sql = "SELECT 
                id_notification,
                id_user,
                title,
                message,
                link,
                is_read,
                created_at
            FROM notifications
            WHERE id_user = :id_user
            ORDER BY is_read ASC, created_at DESC
            LIMIT :limit";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Count unread notifications
    $sql_unread = "SELECT COUNT(*) FROM notifications WHERE id_user = :id_user AND is_read = FALSE";
    $stmt_unread = $pdo->prepare($sql_unread);
    $stmt_unread->execute(['id_user' => $id_user]);
    $unread_count = (int) $stmt_unread->fetchColumn();
    
    // Format response
    $notifications_formatted = array_map(function($n) {
        return [
            'id_notification' => (int) $n['id_notification'],
            'title' => $n['title'],
            'message' => $n['message'],
            'link' => $n['link'],
            'is_read' => (bool) $n['is_read'],
            'created_at' => $n['created_at']
        ];
    }, $notifications);
    
    echo json_encode([
        'success' => true,
        'message' => 'Notifikasi berhasil diambil.',
        'data' => [
            'total' => count($notifications),
            'unread_count' => $unread_count,
            'notifications' => $notifications_formatted
        ]
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
