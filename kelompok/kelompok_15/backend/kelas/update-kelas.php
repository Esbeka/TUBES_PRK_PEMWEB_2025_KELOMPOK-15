<?php
/**
 * FITUR 2: MANAJEMEN KELAS - UPDATE
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Update data kelas
 * - Validasi ownership (hanya dosen pembuat yang bisa edit)
 * - Update data kelas
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

// Cek jika user login dan adalah dosen
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if (!isDosen()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Forbidden']);
    exit;
}

try {
    // Get input data
    $input = [];
    $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
    
    if (strpos($content_type, 'application/json') !== false) {
        $input = json_decode(file_get_contents('php://input'), true);
    } else {
        $input = $_POST;
    }

    // Validasi id_kelas
    if (empty($input['id_kelas'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID kelas wajib diisi']);
        exit;
    }

    $id_kelas = (int)$input['id_kelas'];
    $id_dosen = $_SESSION['id_user'];

    // Cek ownership - kelas harus milik dosen yang login
    $ownership_stmt = $pdo->prepare("SELECT id_dosen FROM kelas WHERE id_kelas = ?");
    $ownership_stmt->execute([$id_kelas]);
    $kelas = $ownership_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$kelas) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Kelas tidak ditemukan']);
        exit;
    }

    if ($kelas['id_dosen'] != $id_dosen) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Forbidden: Anda tidak memiliki izin untuk mengubah kelas ini']);
        exit;
    }

    // Validasi input yang akan diupdate
    $update_fields = [];
    $update_values = [];

    if (isset($input['nama_matakuliah']) && !empty($input['nama_matakuliah'])) {
        $update_fields[] = 'nama_matakuliah = ?';
        $update_values[] = trim($input['nama_matakuliah']);
    }

    if (isset($input['kode_matakuliah']) && !empty($input['kode_matakuliah'])) {
        $update_fields[] = 'kode_matakuliah = ?';
        $update_values[] = trim($input['kode_matakuliah']);
    }

    if (isset($input['semester']) && !empty($input['semester'])) {
        $update_fields[] = 'semester = ?';
        $update_values[] = trim($input['semester']);
    }

    if (isset($input['tahun_ajaran']) && !empty($input['tahun_ajaran'])) {
        $update_fields[] = 'tahun_ajaran = ?';
        $update_values[] = trim($input['tahun_ajaran']);
    }

    if (isset($input['deskripsi'])) {
        $update_fields[] = 'deskripsi = ?';
        $update_values[] = trim($input['deskripsi']);
    }

    if (isset($input['kapasitas']) && !empty($input['kapasitas'])) {
        $kapasitas = (int)$input['kapasitas'];
        if ($kapasitas > 0 && $kapasitas <= 500) {
            $update_fields[] = 'kapasitas = ?';
            $update_values[] = $kapasitas;
        }
    }

    if (empty($update_fields)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Tidak ada field yang akan diupdate']);
        exit;
    }

    // Tambahkan id_kelas ke values untuk WHERE clause
    $update_values[] = $id_kelas;

    // Build query
    $query = "UPDATE kelas SET " . implode(', ', $update_fields) . " WHERE id_kelas = ?";

    $stmt = $pdo->prepare($query);
    $result = $stmt->execute($update_values);

    if ($result) {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Kelas berhasil diupdate'
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Gagal update kelas']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

?>
