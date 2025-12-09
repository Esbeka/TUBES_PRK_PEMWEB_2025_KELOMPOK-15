<?php
/**
 * FITUR 4: MANAJEMEN TUGAS - DELETE
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Hapus tugas dan semua submission
 * - Delete cascade (tugas + submission + file)
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => ''];

try {
    // 1. Cek session dosen
    requireRole('dosen');
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed');
    }

    // 2. Validasi input POST
    if (empty($_POST['id_tugas'])) {
        throw new Exception('id_tugas harus diberikan');
    }

    $id_tugas = intval($_POST['id_tugas']);
    $id_dosen = getUserId();

    // 3. Cek ownership
    $get_tugas = "SELECT t.id_tugas, t.judul, k.id_dosen 
                  FROM tugas t 
                  JOIN kelas k ON t.id_kelas = k.id_kelas 
                  WHERE t.id_tugas = ?";
    $stmt = $pdo->prepare($get_tugas);
    $stmt->execute([$id_tugas]);
    $tugas = $stmt->fetch();
    
    if (!$tugas) {
        throw new Exception('Tugas tidak ditemukan');
    }
    
    if ($tugas['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses untuk menghapus tugas ini');
    }

    // 4. Query submissions untuk get file paths
    $get_submissions = "SELECT id_submission, file_path FROM submission_tugas WHERE id_tugas = ?";
    $stmt = $pdo->prepare($get_submissions);
    $stmt->execute([$id_tugas]);
    $submissions = $stmt->fetchAll();

    // 5. Delete files fisik
    $upload_dir = __DIR__ . '/../../uploads/tugas/';
    foreach ($submissions as $submission) {
        if (!empty($submission['file_path'])) {
            $file_path = $upload_dir . $submission['file_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    // 6. Delete tugas (cascade akan delete submissions & nilai via foreign key)
    $delete = "DELETE FROM tugas WHERE id_tugas = ?";
    $stmt = $pdo->prepare($delete);
    $stmt->execute([$id_tugas]);

    // 7. Return JSON success
    $response['success'] = true;
    $response['message'] = 'Tugas "' . $tugas['judul'] . '" dan semua submission berhasil dihapus';

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
