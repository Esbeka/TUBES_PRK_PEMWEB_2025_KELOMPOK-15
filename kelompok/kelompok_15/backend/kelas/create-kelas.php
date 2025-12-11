<?php
/**
 * FITUR 2: MANAJEMEN KELAS - CREATE
 * Handle pembuatan kelas baru untuk dosen
 */

session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session-helper.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

// Response structure
$response = [
    'success' => false,
    'message' => '',
    'data' => null
];

try {
    // 1. Cek session dosen
    requireRole('dosen');
    
    // Validasi method POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed');
    }

    // 2. Validasi input POST
    if (empty($_POST['nama_matakuliah']) || empty($_POST['kode_matakuliah']) || 
        empty($_POST['semester']) || empty($_POST['tahun_ajaran'])) {
        throw new Exception('Semua field harus diisi');
    }

    $nama_matakuliah = trim($_POST['nama_matakuliah']);
    $kode_matakuliah = trim($_POST['kode_matakuliah']);
    $semester = trim($_POST['semester']);
    $tahun_ajaran = trim($_POST['tahun_ajaran']);
    $deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';
    $kapasitas = isset($_POST['kapasitas']) ? intval($_POST['kapasitas']) : 50;
    
    // Validasi panjang
    if (strlen($nama_matakuliah) < 3) {
        throw new Exception('Nama matakuliah minimal 3 karakter');
    }
    if (strlen($kode_matakuliah) < 2) {
        throw new Exception('Kode matakuliah minimal 2 karakter');
    }
    if ($kapasitas < 1 || $kapasitas > 500) {
        throw new Exception('Kapasitas harus antara 1-500');
    }

    // 3. Generate kode_kelas unique 6 karakter
$response = ['success' => false, 'message' => '', 'data' => null];

try {
    // Validasi session & role
    requireDosen();
    validatePostMethod();

    // Get input dari JSON atau POST
    $input = $_POST;
    if (empty($_POST) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true) ?? [];
    }

    // Get & validate input
    if (empty($input['nama_matakuliah']) || empty($input['kode_matakuliah']) || 
        empty($input['semester']) || empty($input['tahun_ajaran'])) {
        throw new Exception('Semua field harus diisi', 400);
    }

    $nama_matakuliah = trim($input['nama_matakuliah']);
    $kode_matakuliah = trim($input['kode_matakuliah']);
    $semester = trim($input['semester']);
    $tahun_ajaran = trim($input['tahun_ajaran']);
    $deskripsi = isset($input['deskripsi']) ? trim($input['deskripsi']) : '';
    $kapasitas = isset($input['kapasitas']) ? intval($input['kapasitas']) : 50;
    
    // Validasi panjang
    if (strlen($nama_matakuliah) < 3) {
        throw new Exception('Nama matakuliah minimal 3 karakter', 400);
    }
    if (strlen($kode_matakuliah) < 2) {
        throw new Exception('Kode matakuliah minimal 2 karakter', 400);
    }
    if ($kapasitas < 1 || $kapasitas > 500) {
        throw new Exception('Kapasitas harus antara 1-500', 400);
    }

    // Generate kode_kelas unique 6 karakter
    $kode_kelas = '';
    $kode_valid = false;
    $attempts = 0;
    
    while (!$kode_valid && $attempts < 10) {
        // Generate random 6 character code (uppercase alphanumeric)
        $kode_kelas = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));
        
        // Check if kode_kelas already exists
        $check = "SELECT kode_kelas FROM kelas WHERE kode_kelas = ?";
        $stmt = $pdo->prepare($check);
        $stmt->execute([$kode_kelas]);
        
        if ($stmt->rowCount() == 0) {
            $kode_valid = true;
        }
        $attempts++;
    }
    
    if (!$kode_valid) {
        throw new Exception('Gagal generate kode kelas unik');
    }

    // 4. Insert ke tabel kelas
        throw new Exception('Gagal generate kode kelas unik', 500);
    }

    // Insert ke tabel kelas
    $id_dosen = getUserId();
    $insert = "INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($insert);
    $stmt->execute([
        $id_dosen,
        $nama_matakuliah,
        $kode_matakuliah,
        $semester,
        $tahun_ajaran,
        $deskripsi,
        $kode_kelas,
        $kapasitas
    ]);

    $id_kelas = $pdo->lastInsertId();

    // 5. Return JSON dengan kode_kelas & id_kelas
    // Return success response
    http_response_code(201);
    $response['success'] = true;
    $response['message'] = 'Kelas berhasil dibuat';
    $response['data'] = [
        'id_kelas' => intval($id_kelas),
        'kode_kelas' => $kode_kelas,
        'nama_matakuliah' => $nama_matakuliah,
        'kode_matakuliah' => $kode_matakuliah
    ];

} catch(Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
    $code = $e->getCode() ?: 500;
    if ($code === 0) $code = 500;
    http_response_code($code);
    
    $response['success'] = false;
    $response['message'] = $e->getMessage();
    
    // Debug info
    if ($code === 401) {
        $response['debug'] = [
            'session_id' => session_id(),
            'session_active' => session_status() === PHP_SESSION_ACTIVE,
            'has_id_user' => isset($_SESSION['id_user']),
            'has_role' => isset($_SESSION['role']),
            'session_data_keys' => array_keys($_SESSION),
            'php_session_status' => [
                0 => 'DISABLED',
                1 => 'NONE',
                2 => 'ACTIVE'
            ][session_status()]
        ];
    }
}

echo json_encode($response);
?>
