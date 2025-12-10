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
 * 
 * Requirement Implementation Checklist:
 *   ✓ Cek session mahasiswa - Validasi user sudah login & role = mahasiswa
 *   ✓ Validasi input POST (id_submission, keterangan) - Parameter wajib & valid
 *   ✓ Validasi file upload - File harus ada & tidak error
 *   ✓ Query submission untuk get file_path lama & id_tugas
 *     - Verifikasi submission milik mahasiswa yang login
 *     - Return 404 jika submission tidak ada/bukan milik user
 *   ✓ Query tugas untuk get deadline, allowed_formats, max_file_size
 *     - Return 404 jika tugas tidak ada
 *   ✓ Validasi deadline - Cek NOW() <= deadline
 *     - Return 400 jika deadline sudah lewat
 *   ✓ Validasi file format & size - Sesuai ketentuan di tugas
 *     - Return 400 jika tidak sesuai
 *   ✓ Generate filename baru - tugas_[id_tugas]_[npm]_[timestamp].[ext]
 *     - Ambil NPM dari tabel users
 *   ✓ Upload file baru & handle error
 *     - Move uploaded file ke /uploads/tugas/
 *     - Jika gagal: hapus file temp, return error
 *   ✓ Hapus file lama - Dari path lama sebelum update DB
 *     - Jika file tidak ada, skip (don't error)
 *   ✓ Update submission_tugas
 *     - Field: file_path, keterangan, submitted_at (NOW()), status
 *     - Increment attempt_count
 *   ✓ Return JSON success
 *     - Konfirmasi update berhasil
 *     - Info: id_submission, updated_at, attempt_count
 *   ✓ Error handling
 *     - 401: Unauthorized (bukan mahasiswa)
 *     - 400: Bad request (parameter/file tidak valid atau deadline lewat)
 *     - 404: Submission atau tugas tidak ditemukan
 *     - 500: Database/file error
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

// 2. Validasi input POST (id_submission, keterangan)
if (!isset($_POST['id_submission']) || !is_numeric($_POST['id_submission'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter id_submission wajib diisi dan harus berupa angka.']);
    exit;
}

if (!isset($_POST['keterangan']) || empty(trim($_POST['keterangan']))) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter keterangan wajib diisi.']);
    exit;
}

$id_submission = (int) $_POST['id_submission'];
$keterangan = trim($_POST['keterangan']);

// 3. Validasi file upload
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'File wajib diunggah dan tidak boleh error.']);
    exit;
}

$uploaded_file = $_FILES['file'];

try {
    // 4. Query submission untuk get file_path lama & id_tugas
    $sql_submission = "SELECT id_submission, id_tugas, file_path, attempt_count FROM submission_tugas 
                       WHERE id_submission = :id_submission AND id_mahasiswa = :id_mahasiswa";
    $stmt_submission = $pdo->prepare($sql_submission);
    $stmt_submission->execute(['id_submission' => $id_submission, 'id_mahasiswa' => $id_mahasiswa]);
    $submission = $stmt_submission->fetch(PDO::FETCH_ASSOC);
    
    if (!$submission) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Submission tidak ditemukan atau bukan milik Anda.']);
        exit;
    }
    
    $id_tugas = (int) $submission['id_tugas'];
    $old_file_path = $submission['file_path'];
    $attempt_count = (int) $submission['attempt_count'];
    
    // 5. Query tugas untuk get deadline, allowed_formats, max_file_size
    $sql_tugas = "SELECT id_tugas, deadline, allowed_formats, max_file_size FROM tugas WHERE id_tugas = :id_tugas";
    $stmt_tugas = $pdo->prepare($sql_tugas);
    $stmt_tugas->execute(['id_tugas' => $id_tugas]);
    $tugas = $stmt_tugas->fetch(PDO::FETCH_ASSOC);
    
    if (!$tugas) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Tugas tidak ditemukan.']);
        exit;
    }
    
    // 6. Validasi deadline
    $now = new DateTime();
    $deadline = new DateTime($tugas['deadline']);
    
    if ($now > $deadline) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Deadline tugas sudah lewat. Anda tidak bisa update submission.']);
        exit;
    }
    
    // 7. Validasi file format & size
    $file_ext = strtolower(pathinfo($uploaded_file['name'], PATHINFO_EXTENSION));
    $allowed_formats_array = array_map('trim', explode(',', $tugas['allowed_formats']));
    $max_file_size = (int) $tugas['max_file_size'];
    
    if (!in_array($file_ext, $allowed_formats_array)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => "Format file tidak diizinkan. Format yang diizinkan: " . $tugas['allowed_formats']
        ]);
        exit;
    }
    
    if ($uploaded_file['size'] > $max_file_size) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => "Ukuran file melebihi batas. Maksimal: " . ($max_file_size / 1024 / 1024) . " MB"
        ]);
        exit;
    }
    
    // 8. Generate filename baru
    $sql_user = "SELECT npm_nidn FROM users WHERE id_user = :id_user";
    $stmt_user = $pdo->prepare($sql_user);
    $stmt_user->execute(['id_user' => $id_mahasiswa]);
    $user = $stmt_user->fetch(PDO::FETCH_ASSOC);
    
    if (!$user || empty($user['npm_nidn'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'NPM mahasiswa tidak ditemukan.']);
        exit;
    }
    
    $npm = $user['npm_nidn'];
    $timestamp = time();
    $filename = "tugas_{$id_tugas}_{$npm}_{$timestamp}.{$file_ext}";
    $upload_dir = __DIR__ . '/../../uploads/tugas/';
    $file_path = 'uploads/tugas/' . $filename;
    $full_path = $upload_dir . $filename;
    
    // Buat directory jika belum ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    // 9. Upload file baru
    if (!move_uploaded_file($uploaded_file['tmp_name'], $full_path)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Gagal mengupload file. Silakan coba lagi.']);
        exit;
    }
    
    // 10. Hapus file lama
    if (!empty($old_file_path)) {
        $old_full_path = __DIR__ . '/../../' . $old_file_path;
        if (file_exists($old_full_path)) {
            unlink($old_full_path);
        }
    }
    
    // 11. Update submission_tugas
    $sql_update = "UPDATE submission_tugas 
                   SET file_path = :file_path, 
                       keterangan = :keterangan, 
                       submitted_at = NOW(),
                       status = 'submitted',
                       attempt_count = attempt_count + 1
                   WHERE id_submission = :id_submission";
    
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([
        'file_path' => $file_path,
        'keterangan' => $keterangan,
        'id_submission' => $id_submission
    ]);
    
    // 12. Return JSON success
    echo json_encode([
        'success' => true,
        'message' => 'Submission berhasil diperbarui.',
        'data' => [
            'id_submission' => (int) $id_submission,
            'id_tugas' => $id_tugas,
            'status' => 'submitted',
            'updated_at' => date('Y-m-d H:i:s'),
            'attempt_count' => $attempt_count + 1,
            'file_path' => $file_path
        ]
    ]);
    
} catch (PDOException $e) {
    // Hapus file yang sudah diupload jika terjadi error
    if (isset($full_path) && file_exists($full_path)) {
        unlink($full_path);
    }
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan saat update submission: ' . $e->getMessage()
    ]);
}
?>
