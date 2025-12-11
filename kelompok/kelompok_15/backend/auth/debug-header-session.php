<?php
/**
 * DEBUG: Check if X-Session-ID header is received and session loads correctly
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: ' . ($_SERVER['HTTP_ORIGIN'] ?? '*'));

// Require session helper
require_once __DIR__ . '/session-helper.php';

// Get header info
$headers_received = getallheaders();
$x_session_id = $_SERVER['HTTP_X_SESSION_ID'] ?? null;

// Check what session ID was loaded
$current_session_id = session_id();
$session_status = session_status();
$session_status_text = match($session_status) {
    PHP_SESSION_DISABLED => 'PHP_SESSION_DISABLED',
    PHP_SESSION_NONE => 'PHP_SESSION_NONE',
    PHP_SESSION_ACTIVE => 'PHP_SESSION_ACTIVE',
    default => 'UNKNOWN'
};

// Output debug info
http_response_code(200);
echo json_encode([
    'success' => true,
    'debug' => [
        'x_session_id_header' => $x_session_id,
        'current_session_id' => $current_session_id,
        'session_status' => $session_status_text,
        'session_data' => $_SESSION,
        'has_id_user' => isset($_SESSION['id_user']),
        'session_started' => session_status() === PHP_SESSION_ACTIVE,
        'all_headers' => array_filter($headers_received, fn($k) => stripos($k, 'X-') === 0 || stripos($k, 'Session') === 0, ARRAY_FILTER_USE_KEY)
    ]
], JSON_PRETTY_PRINT);
?>