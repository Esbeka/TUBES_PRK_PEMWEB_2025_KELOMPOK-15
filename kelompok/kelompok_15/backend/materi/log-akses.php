<?php
/**
 * FITUR 6: AKSES MATERI - LOG TRACKING (OPSIONAL)
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Log tracking ketika mahasiswa akses materi
 * - Catat setiap kali mahasiswa membuka/download materi
 * - Untuk tracking engagement dan progress monitoring
 * - Data digunakan dashboard untuk hitung progress pertemuan
 * - Log akses via AJAX POST dari frontend saat buka materi
 * 
 * Requirement Implementation Checklist:
 *   ✓ Cek session mahasiswa - Validasi user sudah login & role = mahasiswa
 *   ✓ Validasi input POST (id_materi, id_kelas) - Parameter wajib & numeric
 *   ✓ Verifikasi akses mahasiswa - Cek mahasiswa join kelas & materi ada di kelas
 *     - Query JOIN materi & kelas_mahasiswa
 *     - Return 403 jika tidak memiliki akses
 *   ✓ Check log duplikasi - Cek apakah sudah logged hari ini
 *     - Gunakan DATE(accessed_at) untuk filter hari yang sama
 *     - Jika sudah ada, skip atau update waktu akses
 *   ✓ Insert/Update log akses ke tabel log_akses_materi
 *     - Field: id_materi, id_mahasiswa, id_kelas, accessed_at (NOW())
 *     - Jika sudah ada hari ini: UPDATE accessed_at = NOW()
 *     - Jika belum: INSERT new record
 *   ✓ Return JSON success
 *     - Konfirmasi log berhasil direkam
 *     - Info: id_materi, accessed_at, is_new_log
 *   ✓ Error handling
 *     - 401: Unauthorized (bukan mahasiswa)
 *     - 400: Bad request (parameter tidak valid)
 *     - 403: Forbidden (tidak punya akses ke materi)
 *     - 404: Materi tidak ditemukan
 *     - 500: Database error
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

// 2. Validasi input POST (id_materi, id_kelas)
if (!isset($_POST['id_materi']) || !is_numeric($_POST['id_materi'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter id_materi wajib diisi dan harus berupa angka.']);
    exit;
}

if (!isset($_POST['id_kelas']) || !is_numeric($_POST['id_kelas'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter id_kelas wajib diisi dan harus berupa angka.']);
    exit;
}

$id_materi = (int) $_POST['id_materi'];
$id_kelas = (int) $_POST['id_kelas'];

try {
    // 3. Verifikasi akses mahasiswa - Cek materi ada di kelas dan mahasiswa join kelas
    $sql_verify = "SELECT m.id_materi, m.judul
                   FROM materi m
                   JOIN kelas_mahasiswa km ON m.id_kelas = km.id_kelas
                   WHERE m.id_materi = :id_materi 
                     AND m.id_kelas = :id_kelas
                     AND km.id_mahasiswa = :id_mahasiswa";
    
    $stmt_verify = $pdo->prepare($sql_verify);
    $stmt_verify->execute([
        'id_materi' => $id_materi,
        'id_kelas' => $id_kelas,
        'id_mahasiswa' => $id_mahasiswa
    ]);
    
    $materi = $stmt_verify->fetch(PDO::FETCH_ASSOC);
    
    if (!$materi) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Anda tidak memiliki akses ke materi ini.']);
        exit;
    }
    
    // 4. Check log duplikasi - Cek apakah sudah logged hari ini
    $sql_check_log = "SELECT id_log, accessed_at FROM log_akses_materi
                      WHERE id_materi = :id_materi 
                        AND id_mahasiswa = :id_mahasiswa
                        AND DATE(accessed_at) = DATE(NOW())";
    
    $stmt_check_log = $pdo->prepare($sql_check_log);
    $stmt_check_log->execute([
        'id_materi' => $id_materi,
        'id_mahasiswa' => $id_mahasiswa
    ]);
    
    $existing_log = $stmt_check_log->fetch(PDO::FETCH_ASSOC);
    
    $is_new_log = false;
    $accessed_at = date('Y-m-d H:i:s');
    
    // 5. Insert/Update log akses ke tabel log_akses_materi
    if ($existing_log) {
        // Update waktu akses jika sudah logged hari ini
        $sql_update = "UPDATE log_akses_materi
                       SET accessed_at = NOW()
                       WHERE id_log = :id_log";
        
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute(['id_log' => $existing_log['id_log']]);
    } else {
        // Insert new log record
        $sql_insert = "INSERT INTO log_akses_materi (id_materi, id_mahasiswa, id_kelas, accessed_at)
                       VALUES (:id_materi, :id_mahasiswa, :id_kelas, NOW())";
        
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->execute([
            'id_materi' => $id_materi,
            'id_mahasiswa' => $id_mahasiswa,
            'id_kelas' => $id_kelas
        ]);
        
        $is_new_log = true;
    }
    
    // 6. Return JSON success
    echo json_encode([
        'success' => true,
        'message' => $is_new_log ? 'Log akses materi berhasil direkam.' : 'Log akses materi diperbarui.',
        'data' => [
            'id_materi' => $id_materi,
            'judul_materi' => $materi['judul'],
            'accessed_at' => $accessed_at,
            'is_new_log' => $is_new_log
        ]
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan saat merekam log akses: ' . $e->getMessage()
    ]);
}
?>
