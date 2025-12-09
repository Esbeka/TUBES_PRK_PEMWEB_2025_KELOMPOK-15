<?php
/**
 * TEST API with Database Check
 */

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);

$response = [
    'success' => false,
    'tests' => [],
    'message' => ''
];

// Test 1: Basic PHP
$response['tests'][] = [
    'name' => 'PHP Execution',
    'status' => 'PASS',
    'detail' => 'PHP ' . phpversion()
];

// Test 2: Database configuration
try {
    require_once __DIR__ . '/../../config/database.php';
    $response['tests'][] = [
        'name' => 'Database Configuration',
        'status' => 'PASS',
        'detail' => 'Config loaded'
    ];
} catch (Exception $e) {
    $response['tests'][] = [
        'name' => 'Database Configuration',
        'status' => 'FAIL',
        'detail' => $e->getMessage()
    ];
    echo json_encode($response);
    exit;
}

// Test 3: Database Connection
try {
    $pdo->query("SELECT 1");
    $response['tests'][] = [
        'name' => 'Database Connection',
        'status' => 'PASS',
        'detail' => 'Connected to kelasonline'
    ];
} catch (Exception $e) {
    $response['tests'][] = [
        'name' => 'Database Connection',
        'status' => 'FAIL',
        'detail' => $e->getMessage()
    ];
    echo json_encode($response);
    exit;
}

// Test 4: Check tables
$tables = ['users', 'kelas', 'kelas_mahasiswa', 'materi', 'tugas'];
foreach ($tables as $table) {
    try {
        $pdo->query("SELECT 1 FROM $table LIMIT 1");
        $response['tests'][] = [
            'name' => "Table: $table",
            'status' => 'PASS',
            'detail' => 'Table exists'
        ];
    } catch (Exception $e) {
        $response['tests'][] = [
            'name' => "Table: $table",
            'status' => 'FAIL',
            'detail' => $e->getMessage()
        ];
    }
}

$response['success'] = true;
$response['message'] = 'Database diagnostics complete';

echo json_encode($response, JSON_PRETTY_PRINT);
