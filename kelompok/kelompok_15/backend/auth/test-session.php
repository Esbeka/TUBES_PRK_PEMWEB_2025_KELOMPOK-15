<?php
/**
 * TEST SESSION - Debug endpoint
 */

session_start();
header('Content-Type: application/json');

$response = [
    'session_status' => session_status(),
    'session_id' => session_id(),
    'session_data' => $_SESSION,
    'session_status_name' => [
        0 => 'PHP_SESSION_DISABLED',
        1 => 'PHP_SESSION_NONE',
        2 => 'PHP_SESSION_ACTIVE'
    ][session_status()],
    'cookies' => $_COOKIE,
    'headers_sent' => headers_sent(),
];

echo json_encode($response, JSON_PRETTY_PRINT);
?>
