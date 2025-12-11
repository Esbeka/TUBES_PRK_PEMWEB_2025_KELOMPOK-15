<?php
/**
 * Debug: Session Save Path dan Cookie
 */

header('Content-Type: application/json');

$debug = [
    'save_path' => ini_get('session.save_path'),
    'save_path_exists' => is_dir(ini_get('session.save_path')),
    'save_path_writable' => is_writable(ini_get('session.save_path')),
    'session_name' => ini_get('session.name'),
    'use_cookies' => ini_get('session.use_cookies'),
    'use_only_cookies' => ini_get('session.use_only_cookies'),
    'cookie_path' => ini_get('session.cookie_path'),
    'cookie_httponly' => ini_get('session.cookie_httponly'),
    'cookie_samesite' => ini_get('session.cookie_samesite'),
    'gc_maxlifetime' => ini_get('session.gc_maxlifetime'),
];

// Start session
session_start();

$debug['after_session_start'] = [
    'session_id' => session_id(),
    'session_status' => session_status(),
    'session_status_name' => [0=>'DISABLED', 1=>'NONE', 2=>'ACTIVE'][session_status()],
];

// Set test data
$_SESSION['test_key'] = 'test_value_' . time();
$_SESSION['user_id'] = 999;

// Try to write session
session_write_close();

// Reopen session to check if saved
session_start();

$debug['after_write'] = [
    'session_data' => $_SESSION,
    'test_key_exists' => isset($_SESSION['test_key']),
    'test_key_value' => $_SESSION['test_key'] ?? null,
];

// Check actual session file
$session_file = session_save_path() . '/sess_' . session_id();
$debug['session_file'] = [
    'path' => $session_file,
    'exists' => file_exists($session_file),
    'content' => file_exists($session_file) ? file_get_contents($session_file) : null,
];

echo json_encode($debug, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>
