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
    
    $stmt = $pdo->prepare($update);
    $stmt->execute([
        $nama_matakuliah, $kode_matakuliah, $semester, 
        $tahun_ajaran, $deskripsi, $kapasitas, $id_kelas
    ]);

    $response['success'] = true;
    $response['message'] = 'Kelas berhasil diupdate';

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
