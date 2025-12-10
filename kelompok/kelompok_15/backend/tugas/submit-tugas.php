<?php
/**
 * FITUR 7: SUBMIT TUGAS - SUBMIT
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Mahasiswa submit tugas
 * - Validasi deadline belum lewat
 * - Validasi file (format, size sesuai ketentuan tugas)
 * - Cek duplicate submission (allow update)
 * - Upload file ke /uploads/tugas/
 * - Rename: tugas_[id_tugas]_[npm]_[timestamp].ext
 * - Insert/update record submission_tugas
 * - Set status 'submitted' atau 'late'
 * 
 * Requirement Implementation Checklist:
 *   ✓ Cek session mahasiswa - Validasi user sudah login & role = mahasiswa
 *   ✓ Validasi input POST (id_tugas, keterangan) - Kedua parameter wajib & valid
 *   ✓ Validasi file upload - File harus ada & tidak error
 *   ✓ Query tugas untuk get deadline, allowed_formats, max_file_size
 *     - Return 404 jika tugas tidak ada
 *   ✓ Validasi deadline - Cek NOW() <= deadline
 *     - Set status: submitted jika ON TIME, late jika PAST deadline
 *   ✓ Validasi file format & size
 *     - Parse allowed_formats (misal: 'pdf,doc,docx')
 *     - Check file size <= max_file_size (dalam bytes)
 *     - Return 400 jika tidak sesuai
 *   ✓ Cek duplicate submission - Query submission_tugas untuk user & tugas
 *     - Jika sudah ada: UPDATE (increment attempt_count)
 *     - Jika belum: INSERT new record
 *   ✓ Generate filename unik - tugas_[id_tugas]_[npm]_[timestamp].[ext]
 *     - Ambil NPM dari tabel users
 *   ✓ Upload file & handle error
 *     - Move uploaded file ke /uploads/tugas/
 *     - Store relative path di DB: uploads/tugas/filename
 *     - Jika gagal: hapus file temp, return error
 *   ✓ Insert/Update submission_tugas
 *     - Field: id_tugas, id_mahasiswa, file_path, keterangan, submitted_at, status, attempt_count
 *   ✓ Return JSON success
 *     - Konfirmasi submit berhasil
 *     - Info: id_submission, status, submitted_at, is_late
 *   ✓ Error handling
 *     - 401: Unauthorized (bukan mahasiswa)
 *     - 400: Bad request (parameter/file tidak valid)
 *     - 404: Tugas tidak ditemukan
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

// 2. Validasi input POST (id_tugas, keterangan)
if (!isset($_POST['id_tugas']) || !is_numeric($_POST['id_tugas'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter id_tugas wajib diisi dan harus berupa angka.']);
    exit;
}

if (!isset($_POST['keterangan']) || empty(trim($_POST['keterangan']))) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter keterangan wajib diisi.']);
    exit;
}

$id_tugas = (int) $_POST['id_tugas'];
$keterangan = trim($_POST['keterangan']);

// 3. Validasi file upload
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'File wajib diunggah dan tidak boleh error.']);
    exit;
}

$uploaded_file = $_FILES['file'];

try {
    // 4. Query tugas untuk get deadline, allowed_formats, max_file_size
    $sql_tugas = "SELECT id_tugas, deadline, allowed_formats, max_file_size FROM tugas WHERE id_tugas = :id_tugas";
    $stmt_tugas = $pdo->prepare($sql_tugas);
    $stmt_tugas->execute(['id_tugas' => $id_tugas]);
    $tugas = $stmt_tugas->fetch(PDO::FETCH_ASSOC);
    
    if (!$tugas) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Tugas tidak ditemukan.']);
        exit;
    }
    
    // 5. Validasi deadline & tentukan status
    $now = new DateTime();
    $deadline = new DateTime($tugas['deadline']);
    $is_late = $now > $deadline;
    $status = $is_late ? 'late' : 'submitted';
    
    // 6. Validasi file format & size
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
    
    // 7. Ambil NPM mahasiswa untuk generate filename
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
    
    // 8. Upload file
    if (!move_uploaded_file($uploaded_file['tmp_name'], $full_path)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Gagal mengupload file. Silakan coba lagi.']);
        exit;
    }
    
    // 9. Cek duplicate submission & insert/update
    $sql_check = "SELECT id_submission, attempt_count FROM submission_tugas 
                  WHERE id_tugas = :id_tugas AND id_mahasiswa = :id_mahasiswa";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute(['id_tugas' => $id_tugas, 'id_mahasiswa' => $id_mahasiswa]);
    $existing = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
    if ($existing) {
        // UPDATE submission - delete old file, update new file
        $sql_get_old = "SELECT file_path FROM submission_tugas WHERE id_submission = :id_submission";
        $stmt_get_old = $pdo->prepare($sql_get_old);
        $stmt_get_old->execute(['id_submission' => $existing['id_submission']]);
        $old_file = $stmt_get_old->fetch(PDO::FETCH_ASSOC);
        
        // Delete old file if exists
        if ($old_file && !empty($old_file['file_path'])) {
            $old_full_path = __DIR__ . '/../../' . $old_file['file_path'];
            if (file_exists($old_full_path)) {
                unlink($old_full_path);
            }
        }
        
        $sql_update = "UPDATE submission_tugas 
                       SET file_path = :file_path, 
                           keterangan = :keterangan, 
                           submitted_at = NOW(),
                           status = :status,
                           attempt_count = attempt_count + 1
                       WHERE id_submission = :id_submission";
        
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([
            'file_path' => $file_path,
            'keterangan' => $keterangan,
            'status' => $status,
            'id_submission' => $existing['id_submission']
        ]);
        
        $id_submission = $existing['id_submission'];
        $attempt_count = $existing['attempt_count'] + 1;
    } else {
        // INSERT new submission
        $sql_insert = "INSERT INTO submission_tugas (id_tugas, id_mahasiswa, file_path, keterangan, submitted_at, status, attempt_count)
                       VALUES (:id_tugas, :id_mahasiswa, :file_path, :keterangan, NOW(), :status, 1)";
        
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->execute([
            'id_tugas' => $id_tugas,
            'id_mahasiswa' => $id_mahasiswa,
            'file_path' => $file_path,
            'keterangan' => $keterangan,
            'status' => $status
        ]);
        
        $id_submission = $pdo->lastInsertId();
        $attempt_count = 1;
    }
    
    // 10. Return JSON success
    echo json_encode([
        'success' => true,
        'message' => $existing ? 'Tugas berhasil diperbarui.' : 'Tugas berhasil disubmit.',
        'data' => [
            'id_submission' => (int) $id_submission,
            'id_tugas' => $id_tugas,
            'status' => $status,
            'submitted_at' => date('Y-m-d H:i:s'),
            'is_late' => $is_late,
            'attempt_count' => $attempt_count,
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
        'message' => 'Terjadi kesalahan saat submit tugas: ' . $e->getMessage()
    ]);
}
?>
