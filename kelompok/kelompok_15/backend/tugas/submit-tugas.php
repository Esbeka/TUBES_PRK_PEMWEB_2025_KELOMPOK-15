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

if (!isset($_FILES['file']) || $_FILES['file']['error'] === UPLOAD_ERR_NO_FILE) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'File tugas wajib diunggah.']);
    exit;
}

$id_tugas = (int) $_POST['id_tugas'];
$keterangan = isset($_POST['keterangan']) ? trim($_POST['keterangan']) : '';

try {
    // 3. Query tugas untuk get deadline & allowed_formats & max_file_size
    $sql = "SELECT t.deadline, t.allowed_formats, t.max_file_size, t.judul, k.id_kelas
            FROM tugas t
            JOIN kelas k ON t.id_kelas = k.id_kelas
            WHERE t.id_tugas = :id_tugas";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_tugas' => $id_tugas]);
    $tugas = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$tugas) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Tugas tidak ditemukan.']);
        exit;
    }
    
    // Cek apakah mahasiswa terdaftar di kelas ini
    $sql_check = "SELECT COUNT(*) FROM kelas_mahasiswa WHERE id_kelas = :id_kelas AND id_mahasiswa = :id_mahasiswa";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute(['id_kelas' => $tugas['id_kelas'], 'id_mahasiswa' => $id_mahasiswa]);
    
    if ($stmt_check->fetchColumn() == 0) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Anda tidak terdaftar di kelas ini.']);
        exit;
    }
    
    $deadline = new DateTime($tugas['deadline']);
    $now = new DateTime();
    $allowed_formats = explode(',', strtolower($tugas['allowed_formats']));
    $max_file_size = (int) $tugas['max_file_size'] * 1024 * 1024; // Convert MB to bytes
    
    // 5. Validasi file (format & size)
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
    
    // 6. Generate filename unik: tugas_[id_tugas]_[npm]_[timestamp].ext
    $timestamp = time();
    $new_filename = "tugas_{$id_tugas}_{$npm}_{$timestamp}.{$file_ext}";
    
    // 7. Upload file
    $upload_dir = __DIR__ . '/../../uploads/tugas/';
    
    // Buat folder jika belum ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $file_path = $upload_dir . $new_filename;
    
    // Cek existing submission untuk delete file lama jika update
    $sql_existing = "SELECT id_submission, file_path FROM submission_tugas 
                     WHERE id_tugas = :id_tugas AND id_mahasiswa = :id_mahasiswa";
    $stmt_existing = $pdo->prepare($sql_existing);
    $stmt_existing->execute(['id_tugas' => $id_tugas, 'id_mahasiswa' => $id_mahasiswa]);
    $existing = $stmt_existing->fetch(PDO::FETCH_ASSOC);
    
    if (!move_uploaded_file($file_tmp, $file_path)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Gagal mengupload file.']);
        exit;
    }
    
    // 9. Set status (submitted jika <= deadline, late jika > deadline)
    $status = ($now <= $deadline) ? 'submitted' : 'late';
    
    // Relative path untuk disimpan di database
    $relative_path = 'uploads/tugas/' . $new_filename;
    
    // 8. Insert/update submission_tugas
    if ($existing) {
        // Update existing submission
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
            'id_submission' => $existing['id_submission']
        ]);
        
        // Delete file lama
        if ($existing['file_path'] && file_exists(__DIR__ . '/../../' . $existing['file_path'])) {
            unlink(__DIR__ . '/../../' . $existing['file_path']);
        }
        
        $message = 'Tugas berhasil diupdate.';
        $id_submission = $existing['id_submission'];
        
    } else {
        // Insert new submission
        $sql_insert = "INSERT INTO submission_tugas (id_tugas, id_mahasiswa, file_path, keterangan, status)
                       VALUES (:id_tugas, :id_mahasiswa, :file_path, :keterangan, :status)";
        
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->execute([
            'id_tugas' => $id_tugas,
            'id_mahasiswa' => $id_mahasiswa,
            'file_path' => $relative_path,
            'keterangan' => $keterangan,
            'status' => $status
        ]);
        
        $id_submission = $pdo->lastInsertId();
        $message = 'Tugas berhasil disubmit.';
    }
    
    // 10. Return JSON success
    echo json_encode([
        'success' => true,
        'message' => $message,
        'data' => [
            'id_submission' => (int) $id_submission,
            'id_tugas' => $id_tugas,
            'file_path' => $relative_path,
            'filename' => $new_filename,
            'status' => $status,
            'submitted_at' => date('Y-m-d H:i:s'),
            'is_late' => $status === 'late'
        ]
    ]);
    
} catch (PDOException $e) {
    // Hapus file jika ada error database
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
