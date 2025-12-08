<?php
/**
 * FITUR 1: AUTENTIKASI - LOGOUT
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Handle logout user
 * - Destroy session
 * - Redirect ke landing page
 */

session_start();

// Destroy session
session_destroy();

// Delete session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect ke index page
header('Location: /pages/index.html');
exit;

?>
