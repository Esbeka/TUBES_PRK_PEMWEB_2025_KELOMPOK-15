<?php
/**
 * SIMPLE TEST API - for debugging
 */

header('Content-Type: application/json');

// Test 1: Return simple JSON
echo json_encode([
    'success' => true,
    'message' => 'Simple API works',
    'timestamp' => date('Y-m-d H:i:s'),
    'php_version' => phpversion(),
    'document_root' => $_SERVER['DOCUMENT_ROOT'],
    'current_file' => __FILE__
]);
