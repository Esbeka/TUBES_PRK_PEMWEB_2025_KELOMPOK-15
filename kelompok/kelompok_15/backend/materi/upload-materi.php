<?php
/**
 * FITUR 3: MANAJEMEN MATERI - UPLOAD PDF
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Upload materi PDF
 * - Validasi file PDF (type & size max 10MB)
 * - Sanitize filename
 * - Upload ke /uploads/materi/
 * - Rename: materi_[id_kelas]_[timestamp].pdf
 * - Insert record ke database
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => '', 'data' => null];

try {
    // 1. Cek session dosen
    requireRole('dosen');
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed');
    }

    // 2. Validasi input POST
    if (empty($_POST['id_kelas']) || empty($_POST['judul']) || empty($_POST['pertemuan_ke']) || empty($_FILES['file'])) {
        throw new Exception('Field required tidak lengkap');
    }

    $id_kelas = intval($_POST['id_kelas']);
    $judul = trim($_POST['judul']);
    $deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';
    $pertemuan_ke = intval($_POST['pertemuan_ke']);
    $id_dosen = getUserId();

    // Validasi judul
    if (strlen($judul) < 3) {
        throw new Exception('Judul minimal 3 karakter');
    }

    // Cek ownership kelas
    $check_kelas = "SELECT id_dosen FROM kelas WHERE id_kelas = ?";
    $stmt = $pdo->prepare($check_kelas);
    $stmt->execute([$id_kelas]);
    $kelas = $stmt->fetch();
    
    if (!$kelas || $kelas['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses ke kelas ini');
    }

    // 3. Validasi file
    $file = $_FILES['file'];
    $max_size = 10 * 1024 * 1024; // 10MB
    $allowed_types = ['application/pdf'];
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Gagal upload file');
    }
    
    if ($file['size'] > $max_size) {
        throw new Exception('Ukuran file maksimal 10MB');
    }
    
    if (!in_array($file['type'], $allowed_types)) {
        throw new Exception('File harus berformat PDF');
    }

    // 4. Generate filename unik
    $timestamp = time();
    $filename = 'materi_' . $id_kelas . '_' . $timestamp . '.pdf';
    $upload_dir = __DIR__ . '/../../uploads/materi/';
    
    // Buat folder jika belum ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $file_path = $upload_dir . $filename;

    // 5. Upload file
    if (!move_uploaded_file($file['tmp_name'], $file_path)) {
        throw new Exception('Gagal menyimpan file');
    }

    // 6. Insert ke tabel materi
    $insert = "INSERT INTO materi (id_kelas, judul, deskripsi, tipe, file_path, pertemuan_ke) 
               VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($insert);
    $stmt->execute([
        $id_kelas,
        $judul,
        $deskripsi,
        'pdf',
        $filename,
        $pertemuan_ke
    ]);

    $id_materi = $pdo->lastInsertId();

    // 7. Return JSON success
    $response['success'] = true;
    $response['message'] = 'Materi PDF berhasil diupload';
    $response['data'] = [
        'id_materi' => intval($id_materi),
        'filename' => $filename,
        'judul' => $judul
    ];

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
