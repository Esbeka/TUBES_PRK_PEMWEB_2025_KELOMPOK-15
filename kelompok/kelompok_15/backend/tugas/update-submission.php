<?php
/**
 * FITUR 7: SUBMIT TUGAS - UPDATE SUBMISSION
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Update submission (replace file)
 * - Validasi deadline belum lewat
 * - Hapus file lama
 * - Upload file baru
 * - Update record
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/database.php';

session_start();

// 1. Cek session mahasiswa
if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized. Mahasiswa belum login atau tidak memiliki akses.']);
    exit;
}

$id_mahasiswa = (int) $_SESSION['id_user'];

// 2. Validasi input POST (id_submission)
if (!isset($_POST['id_submission']) || !is_numeric($_POST['id_submission'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter id_submission wajib diisi dan harus berupa angka.']);
    exit;
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] === UPLOAD_ERR_NO_FILE) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'File tugas wajib diunggah.']);
    exit;
}

$id_submission = (int) $_POST['id_submission'];
$keterangan = isset($_POST['keterangan']) ? trim($_POST['keterangan']) : '';

try {
    // 3. Query submission untuk get file_path lama dan validasi ownership
    $sql = "SELECT st.id_submission, st.id_tugas, st.id_mahasiswa, st.file_path, st.keterangan
            FROM submission_tugas st
            WHERE st.id_submission = :id_submission";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_submission' => $id_submission]);
    $submission = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$submission) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Submission tidak ditemukan.']);
        exit;
    }
    
    // Validasi bahwa submission milik mahasiswa yang sedang login
    if ((int) $submission['id_mahasiswa'] !== $id_mahasiswa) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Anda tidak memiliki akses untuk mengupdate submission ini.']);
        exit;
    }
    
    // 4. Query tugas untuk validasi deadline dan ketentuan file
    $sql_tugas = "SELECT t.deadline, t.allowed_formats, t.max_file_size, t.judul
                  FROM tugas t
                  WHERE t.id_tugas = :id_tugas";
    
    $stmt_tugas = $pdo->prepare($sql_tugas);
    $stmt_tugas->execute(['id_tugas' => $submission['id_tugas']]);
    $tugas = $stmt_tugas->fetch(PDO::FETCH_ASSOC);
    
    if (!$tugas) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Tugas tidak ditemukan.']);
        exit;
    }
    
    // 5. Validasi deadline
    $deadline = new DateTime($tugas['deadline']);
    $now = new DateTime();
    
    if ($now > $deadline) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Deadline sudah lewat. Tidak dapat mengupdate submission.']);
        exit;
    }
    
    $allowed_formats = explode(',', strtolower($tugas['allowed_formats']));
    $max_file_size = (int) $tugas['max_file_size'] * 1024 * 1024; // Convert MB to bytes
    
    // Validasi file baru
    $file = $_FILES['file'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    
    if ($file_error !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Error saat upload file. Kode error: ' . $file_error]);
        exit;
    }
    
    // Validasi ukuran file
    if ($file_size > $max_file_size) {
        http_response_code(400);
        echo json_encode([
            'success' => false, 
            'message' => 'Ukuran file melebihi batas maksimal ' . $tugas['max_file_size'] . ' MB.'
        ]);
        exit;
    }
    
    // Validasi format file
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($file_ext, $allowed_formats)) {
        http_response_code(400);
        echo json_encode([
            'success' => false, 
            'message' => 'Format file tidak diizinkan. Format yang diizinkan: ' . implode(', ', $allowed_formats)
        ]);
        exit;
    }
    
    // Get NPM mahasiswa
    $sql_npm = "SELECT npm_nidn FROM users WHERE id_user = :id_user";
    $stmt_npm = $pdo->prepare($sql_npm);
    $stmt_npm->execute(['id_user' => $id_mahasiswa]);
    $npm = $stmt_npm->fetchColumn();
    
    // Generate filename unik: tugas_[id_tugas]_[npm]_[timestamp].ext
    $timestamp = time();
    $new_filename = "tugas_{$submission['id_tugas']}_{$npm}_{$timestamp}.{$file_ext}";
    
    // 7. Upload file baru
    $upload_dir = __DIR__ . '/../../uploads/tugas/';
    
    // Buat folder jika belum ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $file_path = $upload_dir . $new_filename;
    
    if (!move_uploaded_file($file_tmp, $file_path)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Gagal mengupload file baru.']);
        exit;
    }
    
    // Set status (submitted karena sudah divalidasi deadline belum lewat)
    $status = 'submitted';
    
    // Relative path untuk disimpan di database
    $relative_path = 'uploads/tugas/' . $new_filename;
    
    // 8. Update submission
    $sql_update = "UPDATE submission_tugas 
                   SET file_path = :file_path, 
                       keterangan = :keterangan, 
                       submitted_at = NOW(), 
                       status = :status
                   WHERE id_submission = :id_submission";
    
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([
        'file_path' => $relative_path,
        'keterangan' => $keterangan,
        'status' => $status,
        'id_submission' => $id_submission
    ]);
    
    // 6. Hapus file lama setelah update berhasil
    if ($submission['file_path'] && file_exists(__DIR__ . '/../../' . $submission['file_path'])) {
        unlink(__DIR__ . '/../../' . $submission['file_path']);
    }
    
    // 9. Return JSON success
    echo json_encode([
        'success' => true,
        'message' => 'Submission berhasil diupdate.',
        'data' => [
            'id_submission' => $id_submission,
            'id_tugas' => (int) $submission['id_tugas'],
            'file_path' => $relative_path,
            'filename' => $new_filename,
            'status' => $status,
            'submitted_at' => date('Y-m-d H:i:s')
        ]
    ]);
    
} catch (PDOException $e) {
    // Hapus file baru jika ada error database
    if (isset($file_path) && file_exists($file_path)) {
        unlink($file_path);
    }
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
