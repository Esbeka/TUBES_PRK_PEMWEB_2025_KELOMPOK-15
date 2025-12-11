<?php
/**
 * Check PHP Session Configuration
 */

header('Content-Type: application/json');

$config = [
    'session.save_path' => ini_get('session.save_path'),
    'session.use_cookies' => ini_get('session.use_cookies'),
    'session.use_only_cookies' => ini_get('session.use_only_cookies'),
    'session.cookie_path' => ini_get('session.cookie_path'),
    'session.cookie_httponly' => ini_get('session.cookie_httponly'),
    'session.auto_start' => ini_get('session.auto_start'),
    'session.gc_maxlifetime' => ini_get('session.gc_maxlifetime'),
];

// Test writable
$save_path = ini_get('session.save_path');
$is_writable = is_writable($save_path) ? 'YES' : 'NO';
$path_exists = is_dir($save_path) ? 'YES' : 'NO';

// Test session
session_start();
$_SESSION['test_time'] = time();

$response = [
    'php_version' => phpversion(),
    'session_config' => $config,
    'save_path_info' => [
        'path' => $save_path,
        'exists' => $path_exists,
        'writable' => $is_writable
    ],
    'session_test' => [
        'id' => session_id(),
        'status' => session_status(),
        'test_data_set' => isset($_SESSION['test_time']),
        'all_session' => $_SESSION
    ]
];

echo json_encode($response, JSON_PRETTY_PRINT);
?>
