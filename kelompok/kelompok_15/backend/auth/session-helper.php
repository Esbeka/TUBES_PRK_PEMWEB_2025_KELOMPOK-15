<?php
/**
 * SESSION HELPER - Advanced Session Management
 * Supports both cookie-based and header-based session tracking
 */

// Ensure session save path is writable
$save_path = ini_get('session.save_path');
if (empty($save_path) || !is_writable($save_path)) {
    $save_path = sys_get_temp_dir();
    ini_set('session.save_path', $save_path);
}

// Session configuration - maximum compatibility
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => false,
    'httponly' => false,
    'samesite' => 'None'
]);

// Increase session timeout
ini_set('session.gc_maxlifetime', 7200);

// Set session name
session_name('PHPID');

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// IMPORTANT: Support for explicit session ID from custom header (for fetch API compatibility)
// Client can send: X-Session-ID: <session_id_from_login>
if (!empty($_SERVER['HTTP_X_SESSION_ID'])) {
    $custom_session_id = $_SERVER['HTTP_X_SESSION_ID'];
    
    // Validate session ID format (alphanumeric, any case, 20+ chars)
    // PHP session IDs are typically alphanumeric (a-z, 0-9) and around 26 chars
    if (preg_match('/^[a-zA-Z0-9\-_]{20,}$/', $custom_session_id)) {
        // Close current session first
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }
        
        // Set the provided session ID BEFORE starting session
        session_id($custom_session_id);
        
        // Now start/resume with the provided ID
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
?>

