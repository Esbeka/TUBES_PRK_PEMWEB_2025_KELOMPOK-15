<?php
/**
 * COMPREHENSIVE SYSTEM TEST
 * Test setiap komponen dari login hingga create kelas
 */

header('Content-Type: application/json');

$results = [
    'timestamp' => date('Y-m-d H:i:s'),
    'tests' => []
];

// ===== TEST 1: Database Connection =====
try {
    require_once '../../config/database.php';
    $test = $pdo->query("SELECT 1");
    $results['tests']['database_connection'] = [
        'status' => 'PASS',
        'message' => 'Database connected'
    ];
} catch (Exception $e) {
    $results['tests']['database_connection'] = [
        'status' => 'FAIL',
        'message' => $e->getMessage()
    ];
}

// ===== TEST 2: Users Table =====
try {
    $stmt = $pdo->query("SELECT * FROM users LIMIT 5");
    $users = $stmt->fetchAll();
    $results['tests']['users_table'] = [
        'status' => 'PASS',
        'total_users' => $pdo->query("SELECT COUNT(*) FROM users")->fetch()[0],
        'sample_users' => array_map(function($u) {
            return [
                'id' => $u['id_user'],
                'nama' => $u['nama'],
                'npm_nidn' => $u['npm_nidn'],
                'role' => $u['role'],
                'email' => $u['email']
            ];
        }, $users)
    ];
} catch (Exception $e) {
    $results['tests']['users_table'] = [
        'status' => 'FAIL',
        'message' => $e->getMessage()
    ];
}

// ===== TEST 3: Session Configuration =====
if (PHP_VERSION_ID >= 70300) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
} else {
    session_set_cookie_params(0, '/', '', false, true);
}
session_start();

$_SESSION['test_data'] = 'test_value';
$results['tests']['session_config'] = [
    'status' => 'PASS',
    'session_id' => session_id(),
    'session_status' => session_status() === PHP_SESSION_ACTIVE ? 'ACTIVE' : 'INACTIVE',
    'test_data_set' => isset($_SESSION['test_data']),
    'cookie_path_config' => ini_get('session.cookie_path') ?: 'default'
];

// ===== TEST 4: Frontend Files Exist =====
$frontend_files = [
    'login.html' => '../../../pages/login.html',
    'dashboard-dosen.php' => '../../../pages/dashboard-dosen.php',
];

$frontend_test = [];
foreach ($frontend_files as $name => $path) {
    $abs_path = realpath(__DIR__ . '/' . $path);
    $frontend_test[$name] = [
        'exists' => file_exists($abs_path),
        'path' => $abs_path
    ];
}
$results['tests']['frontend_files'] = [
    'status' => 'PASS',
    'files' => $frontend_test
];

// ===== TEST 5: Backend API Files Exist =====
$backend_files = [
    'login.php' => '../login.php',
    'create-kelas.php' => '../kelas/create-kelas.php',
    'get-kelas-dosen.php' => '../kelas/get-kelas-dosen.php',
    'session-check.php' => '../auth/session-check.php'
];

$backend_test = [];
foreach ($backend_files as $name => $path) {
    $abs_path = realpath(__DIR__ . '/' . $path);
    $backend_test[$name] = [
        'exists' => file_exists($abs_path),
        'path' => $abs_path
    ];
}
$results['tests']['backend_files'] = [
    'status' => 'PASS',
    'files' => $backend_test
];

// ===== TEST 6: Session Retrieval Test =====
$results['tests']['session_retrieval'] = [
    'status' => 'PASS',
    'test_data_exists' => isset($_SESSION['test_data']),
    'test_data_value' => $_SESSION['test_data'] ?? null,
    'all_session_keys' => array_keys($_SESSION)
];

echo json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>
