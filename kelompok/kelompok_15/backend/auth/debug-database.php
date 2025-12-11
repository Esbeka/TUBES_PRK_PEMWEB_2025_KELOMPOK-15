<?php
/**
 * DEBUG: Database Connection & Data Check
 */

header('Content-Type: application/json');

try {
    require_once '../../config/database.php';
    
    // Test connection
    $test_query = $pdo->query("SELECT 1");
    $connected = $test_query !== false;
    
    // Check users table
    $users_stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
    $users_count = $users_stmt->fetch()['total'];
    
    // Get all users (for testing)
    $all_users = $pdo->query("SELECT id_user, nama, email, npm_nidn, role FROM users")->fetchAll();
    
    // Check kelas table
    $kelas_stmt = $pdo->query("SELECT COUNT(*) as total FROM kelas");
    $kelas_count = $kelas_stmt->fetch()['total'];
    
    $response = [
        'database' => [
            'connected' => $connected,
            'name' => 'kelasonline'
        ],
        'tables' => [
            'users' => [
                'count' => (int)$users_count,
                'data' => $all_users
            ],
            'kelas' => [
                'count' => (int)$kelas_count
            ]
        ]
    ];
    
    echo json_encode($response, JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ], JSON_PRETTY_PRINT);
}
?>
