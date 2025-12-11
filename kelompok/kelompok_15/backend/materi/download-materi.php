<?php
/**
 * FITUR 6: AKSES MATERI - DOWNLOAD
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Download materi PDF dengan security
 * - Validasi akses mahasiswa
 * - Stream file PDF untuk download
 * - Set proper headers (Content-Type, Content-Disposition)
 * - Prevent direct URL access
 */

session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

try {
    // 1. Cek session mahasiswa atau dosen
    requireLogin();
    
    // 2. Validasi input GET
    if (empty($_GET['id_materi'])) {
        throw new Exception('id_materi harus diberikan');
    }

    $id_materi = intval($_GET['id_materi']);
    $user_id = getUserId();
    $user_role = getUserRole();

    // 3. Query materi by id
    $get_materi = "SELECT m.id_materi, m.id_kelas, m.judul, m.tipe, m.file_path, 
                          k.id_dosen
                   FROM materi m
                   JOIN kelas k ON m.id_kelas = k.id_kelas
                   WHERE m.id_materi = ?";
    $stmt = $pdo->prepare($get_materi);
    $stmt->execute([$id_materi]);
    $materi = $stmt->fetch();
    
    if (!$materi) {
        throw new Exception('Materi tidak ditemukan');
    }

    // 4. Cek akses (mahasiswa harus join kelas atau dosen owner)
    $has_access = false;
    
    if ($user_role === 'dosen' && $materi['id_dosen'] == $user_id) {
        // Dosen owner bisa download
        $has_access = true;
    } else if ($user_role === 'mahasiswa') {
        // Check apakah mahasiswa sudah join kelas
        $check_join = "SELECT id FROM kelas_mahasiswa WHERE id_kelas = ? AND id_mahasiswa = ?";
        $stmt = $pdo->prepare($check_join);
        $stmt->execute([$materi['id_kelas'], $user_id]);
        if ($stmt->rowCount() > 0) {
            $has_access = true;
        }
    }
    
    if (!$has_access) {
        throw new Exception('Anda tidak memiliki akses ke materi ini');
    }

    // Hanya PDF yang bisa di-download via endpoint ini
    if ($materi['tipe'] !== 'pdf') {
        throw new Exception('Hanya file PDF yang bisa didownload');
    }

    // 5. Setup file path dan validasi file exists
    $upload_dir = __DIR__ . '/../../uploads/materi/';
    $file_path = $upload_dir . $materi['file_path'];
    
    // Security: prevent path traversal
    $real_path = realpath($file_path);
    $real_upload_dir = realpath($upload_dir);
    
    if ($real_path === false || strpos($real_path, $real_upload_dir) !== 0) {
        throw new Exception('Invalid file path');
    }
    
    if (!file_exists($file_path)) {
        throw new Exception('File tidak ditemukan di server');
    }

    // 6. Set headers untuk download dan stream file
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($materi['file_path']) . '"');
    header('Content-Length: ' . filesize($file_path));
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Stream file
    readfile($file_path);
    exit;

} catch(Exception $e) {
    // Jika error, return JSON
    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => $e->getMessage()];
    echo json_encode($response);
    exit;
}
?>
