<?php
/**
 * TEST: Check session after login
 */

require_once __DIR__ . '/session-helper.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');

$response = [
    'success' => true,
    'session_id' => session_id(),
    'session_status' => session_status(),
    'session_status_text' => [
        0 => 'PHP_SESSION_DISABLED',
        1 => 'PHP_SESSION_NONE',
        2 => 'PHP_SESSION_ACTIVE'
    ][session_status()],
    'session_data' => $_SESSION,
    'cookies_list' => array_keys($_COOKIE),
    'phpversion' => phpversion(),
];

echo json_encode($response, JSON_PRETTY_PRINT);
?>
