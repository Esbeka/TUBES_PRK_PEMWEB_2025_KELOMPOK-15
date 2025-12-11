<?php
/**
 * FITUR 2: MANAJEMEN KELAS - UPDATE
 * Update data kelas dengan validasi ownership
 */

session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session-helper.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => ''];

try {
    requireRole('dosen');
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed');
    }

    if (empty($_POST['id_kelas']) || empty($_POST['nama_matakuliah']) || empty($_POST['kode_matakuliah'])) {
        throw new Exception('Field required tidak lengkap');
    }

    $id_kelas = intval($_POST['id_kelas']);
    $nama_matakuliah = trim($_POST['nama_matakuliah']);
    $kode_matakuliah = trim($_POST['kode_matakuliah']);
    $semester = isset($_POST['semester']) ? trim($_POST['semester']) : '';
    $tahun_ajaran = isset($_POST['tahun_ajaran']) ? trim($_POST['tahun_ajaran']) : '';
    $deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';
    $kapasitas = isset($_POST['kapasitas']) ? intval($_POST['kapasitas']) : 50;
    
    if (strlen($nama_matakuliah) < 3) {
        throw new Exception('Nama matakuliah minimal 3 karakter');
    }
    if ($kapasitas < 1 || $kapasitas > 500) {
        throw new Exception('Kapasitas harus antara 1-500');
    }

    $id_dosen = getUserId();
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
        throw new Exception('Kelas tidak ditemukan');
    }
    if ($kelas['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses untuk mengubah kelas ini');
    }

    $update = "UPDATE kelas SET 
        nama_matakuliah = ?, kode_matakuliah = ?, semester = ?, 
        tahun_ajaran = ?, deskripsi = ?, kapasitas = ? WHERE id_kelas = ?";
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
