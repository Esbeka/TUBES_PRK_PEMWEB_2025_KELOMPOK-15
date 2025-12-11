<?php
/**
 * FITUR 2: MANAJEMEN KELAS - UPDATE
 * Update data kelas dengan validasi ownership
 */

require_once __DIR__ . '/../auth/session-helper.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => ''];

try {
    requireDosen();
    validatePostMethod();

    // Get input dari JSON atau POST
    $input = $_POST;
    if (empty($_POST) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true) ?? [];
    }

    if (empty($input['id_kelas']) || empty($input['nama_matakuliah']) || empty($input['kode_matakuliah'])) {
        throw new Exception('Field required tidak lengkap', 400);
    }

    $id_kelas = intval($input['id_kelas']);
    $nama_matakuliah = trim($input['nama_matakuliah']);
    $kode_matakuliah = trim($input['kode_matakuliah']);
    $semester = isset($input['semester']) ? trim($input['semester']) : '';
    $tahun_ajaran = isset($input['tahun_ajaran']) ? trim($input['tahun_ajaran']) : '';
    $deskripsi = isset($input['deskripsi']) ? trim($input['deskripsi']) : '';
    $kapasitas = isset($input['kapasitas']) ? intval($input['kapasitas']) : 50;
    
    // Validasi
    if (strlen($nama_matakuliah) < 3) {
        throw new Exception('Nama matakuliah minimal 3 karakter', 400);
    }
    if ($kapasitas < 1 || $kapasitas > 500) {
        throw new Exception('Kapasitas harus antara 1-500', 400);
    }

    $id_dosen = getUserId();
    
    // Ownership validation
    $check = "SELECT id_dosen FROM kelas WHERE id_kelas = ?";
    $stmt = $pdo->prepare($check);
    $stmt->execute([$id_kelas]);
    $kelas = $stmt->fetch();
    
    if (!$kelas) {
        throw new Exception('Kelas tidak ditemukan', 404);
    }
    if ($kelas['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses untuk mengubah kelas ini', 403);
    }

    // Update kelas
    $update = "UPDATE kelas SET 
        nama_matakuliah = ?, kode_matakuliah = ?, semester = ?, 
        tahun_ajaran = ?, deskripsi = ?, kapasitas = ?, updated_at = NOW() 
        WHERE id_kelas = ?";
    
    $stmt = $pdo->prepare($update);
    $stmt->execute([
        $nama_matakuliah, $kode_matakuliah, $semester, 
        $tahun_ajaran, $deskripsi, $kapasitas, $id_kelas
    ]);

    http_response_code(200);
    $response['success'] = true;
    $response['message'] = 'Kelas berhasil diupdate';

} catch(Exception $e) {
    $code = $e->getCode() ?: 500;
    if ($code === 0) $code = 500;
    http_response_code($code);
    
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
