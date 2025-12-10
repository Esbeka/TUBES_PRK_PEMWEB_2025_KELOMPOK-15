<?php
/**
 * FITUR 3: MANAJEMEN MATERI - UPDATE
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Update materi
 * - Edit info materi (judul, deskripsi)
 * - Ganti file jika ada upload baru
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
    if (empty($_POST['id_materi']) || empty($_POST['judul'])) {
        throw new Exception('Field required tidak lengkap');
    }

    $id_materi = intval($_POST['id_materi']);
    $judul = trim($_POST['judul']);
    $deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';
    $id_dosen = getUserId();

    // Validasi judul
    if (strlen($judul) < 3) {
        throw new Exception('Judul minimal 3 karakter');
    }

    // 3. Cek ownership & get materi info
    $get_materi = "SELECT m.id_materi, m.id_kelas, m.tipe, m.file_path, k.id_dosen 
                   FROM materi m 
                   JOIN kelas k ON m.id_kelas = k.id_kelas 
                   WHERE m.id_materi = ?";
    $stmt = $pdo->prepare($get_materi);
    $stmt->execute([$id_materi]);
    $materi = $stmt->fetch();
    
    if (!$materi) {
        throw new Exception('Materi tidak ditemukan');
    }
    
    if ($materi['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses untuk mengubah materi ini');
    }

    $old_file_path = $materi['file_path'];
    $id_kelas = $materi['id_kelas'];
    $tipe = $materi['tipe'];

    // 4. Update data materi
    $update = "UPDATE materi SET judul = ?, deskripsi = ? WHERE id_materi = ?";
    $stmt = $pdo->prepare($update);
    $stmt->execute([$judul, $deskripsi, $id_materi]);

    // 5. Jika ada file baru, hapus file lama & upload file baru
    if (!empty($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];
        $max_size = 10 * 1024 * 1024; // 10MB
        $allowed_types = ['application/pdf'];
        
        // Validasi file baru
        if ($file['size'] > $max_size) {
            throw new Exception('Ukuran file maksimal 10MB');
        }
        
        if (!in_array($file['type'], $allowed_types)) {
            throw new Exception('File harus berformat PDF');
        }

        // Generate filename unik
        $timestamp = time();
        $new_filename = 'materi_' . $id_kelas . '_' . $timestamp . '.pdf';
        $upload_dir = __DIR__ . '/../../uploads/materi/';
        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $new_file_path = $upload_dir . $new_filename;

        // Upload file baru
        if (!move_uploaded_file($file['tmp_name'], $new_file_path)) {
            throw new Exception('Gagal menyimpan file');
        }

        // Hapus file lama jika tipe PDF
        if ($tipe === 'pdf' && !empty($old_file_path)) {
            $old_full_path = $upload_dir . $old_file_path;
            if (file_exists($old_full_path)) {
                unlink($old_full_path);
            }
        }

        // Update file_path di database
        $update_file = "UPDATE materi SET file_path = ?, tipe = 'pdf' WHERE id_materi = ?";
        $stmt = $pdo->prepare($update_file);
        $stmt->execute([$new_filename, $id_materi]);
    }

    // Return JSON success
    $response['success'] = true;
    $response['message'] = 'Materi berhasil diupdate';

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
