<?php
/**
 * Simple test: Create session & retrieve
 */

// Set session configuration
ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_only_cookies', '1');
session_start();

header('Content-Type: application/json');

// Set test data
if ($_GET['action'] === 'set') {
    $_SESSION['test_id'] = 123;
    $_SESSION['test_role'] = 'dosen';
    
    echo json_encode([
        'action' => 'set',
        'session_id' => session_id(),
        'data_set' => [
            'test_id' => $_SESSION['test_id'],
            'test_role' => $_SESSION['test_role']
        ],
        'cookie_set' => true
    ]);
} 
// Retrieve test data
else if ($_GET['action'] === 'get') {
    echo json_encode([
        'action' => 'get',
        'session_id' => session_id(),
        'data_found' => [
            'test_id' => $_SESSION['test_id'] ?? null,
            'test_role' => $_SESSION['test_role'] ?? null
        ],
        'has_session' => !empty($_SESSION)
    ]);
}
// Show all
else {
    echo json_encode([
        'all_session' => $_SESSION,
        'session_id' => session_id(),
        'session_status' => session_status(),
        'cookies' => $_COOKIE
    ]);
}
?>
