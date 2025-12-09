<?php
/**
 * FITUR 2: MANAJEMEN KELAS - CREATE
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Buat kelas baru untuk dosen
 * - Generate kode unik 6 karakter
 * - Insert kelas ke database dengan id_dosen dari session
 * - Return kode kelas ke frontend
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

// Cek jika user login dan adalah dosen
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized: Silakan login terlebih dahulu']);
    exit;
}

if (!isDosen()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Forbidden: Hanya dosen yang dapat membuat kelas']);
    exit;
}

try {
    // Get input data - support both JSON dan form data
    $input = [];
    $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
    
    if (strpos($content_type, 'application/json') !== false) {
        $input = json_decode(file_get_contents('php://input'), true);
    } else {
        $input = $_POST;
    }

    // Validasi input
    $required_fields = ['nama_matakuliah', 'kode_matakuliah', 'semester', 'tahun_ajaran', 'kapasitas'];
    foreach ($required_fields as $field) {
        if (empty($input[$field])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => "Field '{$field}' wajib diisi"]);
            exit;
        }
    }

    $nama_matakuliah = trim($input['nama_matakuliah']);
    $kode_matakuliah = trim($input['kode_matakuliah']);
    $semester = trim($input['semester']);
    $tahun_ajaran = trim($input['tahun_ajaran']);
    $deskripsi = isset($input['deskripsi']) ? trim($input['deskripsi']) : '';
    $kapasitas = (int)$input['kapasitas'];

    // Validasi kapasitas
    if ($kapasitas <= 0 || $kapasitas > 500) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Kapasitas harus antara 1-500']);
        exit;
    }

    // Generate kode_kelas unik (6 karakter)
    $max_attempts = 10;
    $kode_kelas = '';
    $generated = false;

    for ($i = 0; $i < $max_attempts; $i++) {
        $kode_kelas = generateUniqueCode($pdo);
        
        // Cek duplikat di database
        $check_stmt = $pdo->prepare("SELECT id_kelas FROM kelas WHERE kode_kelas = ?");
        $check_stmt->execute([$kode_kelas]);
        
        if ($check_stmt->rowCount() === 0) {
            $generated = true;
            break;
        }
    }

    if (!$generated) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Gagal generate kode kelas unik. Silakan coba lagi']);
        exit;
    }

    // Insert ke database
    $stmt = $pdo->prepare(
        "INSERT INTO kelas 
        (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $result = $stmt->execute([
        $_SESSION['id_user'],
        $nama_matakuliah,
        $kode_matakuliah,
        $semester,
        $tahun_ajaran,
        $deskripsi,
        $kode_kelas,
        $kapasitas
    ]);

    if ($result) {
        $id_kelas = $pdo->lastInsertId();
        http_response_code(201);
        echo json_encode([
            'success' => true,
            'message' => 'Kelas berhasil dibuat',
            'data' => [
                'id_kelas' => $id_kelas,
                'kode_kelas' => $kode_kelas,
                'nama_matakuliah' => $nama_matakuliah
            ]
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Gagal membuat kelas']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

/**
 * Generate kode kelas unik 6 karakter
 * Format: 2 huruf + 4 angka
 */
function generateUniqueCode($pdo) {
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $kode = '';
    
    // 2 huruf random
    for ($i = 0; $i < 2; $i++) {
        $kode .= $letters[rand(0, 25)];
    }
    
    // 4 angka random
    for ($i = 0; $i < 4; $i++) {
        $kode .= rand(0, 9);
    }
    
    return $kode;
}

?>
