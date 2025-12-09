<?php
/**
 * FITUR 2: MANAJEMEN KELAS - DELETE
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Hapus kelas dan semua data terkait
 * - Validasi ownership
 * - Delete cascade (kelas, materi, tugas, submissions)
 */~

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

    if (empty($_POST['id_kelas'])) {
        throw new Exception('id_kelas harus diberikan');
    }

    $id_kelas = intval($_POST['id_kelas']);
    $id_dosen = getUserId();

    $check = "SELECT id_dosen, nama_matakuliah FROM kelas WHERE id_kelas = ?";
    $stmt = $pdo->prepare($check);
    $stmt->execute([$id_kelas]);
    $kelas = $stmt->fetch();
    
    if (!$kelas) {
        throw new Exception('Kelas tidak ditemukan');
    }
    if ($kelas['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses untuk menghapus kelas ini');
    }

    // Delete cascade akan otomatis via foreign key ON DELETE CASCADE
    $delete = "DELETE FROM kelas WHERE id_kelas = ?";
    $stmt = $pdo->prepare($delete);
    $stmt->execute([$id_kelas]);

    $response['success'] = true;
    $response['message'] = 'Kelas "' . $kelas['nama_matakuliah'] . '" dan semua data terkait berhasil dihapus';

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
