<?php
/**
 * FITUR 3: MANAJEMEN MATERI - DELETE
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Hapus materi
 * - Delete record database
 * - Hapus file fisik dari server
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
    if (empty($_POST['id_materi'])) {
        throw new Exception('id_materi harus diberikan');
    }

    $id_materi = intval($_POST['id_materi']);
    $id_dosen = getUserId();

    // 3. Query materi untuk get file_path
    $get_materi = "SELECT m.id_materi, m.tipe, m.file_path, k.id_dosen 
                   FROM materi m 
                   JOIN kelas k ON m.id_kelas = k.id_kelas 
                   WHERE m.id_materi = ?";
    $stmt = $pdo->prepare($get_materi);
    $stmt->execute([$id_materi]);
    $materi = $stmt->fetch();
    
    if (!$materi) {
        throw new Exception('Materi tidak ditemukan');
    }

    // 4. Cek ownership
    if ($materi['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses untuk menghapus materi ini');
    }

    // 5. Delete record database
    $delete = "DELETE FROM materi WHERE id_materi = ?";
    $stmt = $pdo->prepare($delete);
    $stmt->execute([$id_materi]);

    // 6. Hapus file fisik jika tipe = pdf
    if ($materi['tipe'] === 'pdf' && !empty($materi['file_path'])) {
        $upload_dir = __DIR__ . '/../../uploads/materi/';
        $file_path = $upload_dir . $materi['file_path'];
        
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // 7. Return JSON success
    $response['success'] = true;
    $response['message'] = 'Materi berhasil dihapus';

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
