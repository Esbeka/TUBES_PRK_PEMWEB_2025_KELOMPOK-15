<?php
/**
 * FITUR 5: JOIN KELAS - LEAVE (OPSIONAL)
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Mahasiswa keluar dari kelas
 * - Delete dari tabel kelas_mahasiswa
 * - Konfirmasi dan warning
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

// 2. Validasi input POST (id_kelas)
if (!isset($_POST['id_kelas']) || !is_numeric($_POST['id_kelas'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter id_kelas wajib diisi dan harus berupa angka.']);
    exit;
}

$id_kelas = (int) $_POST['id_kelas'];

try {
    // Cek apakah mahasiswa terdaftar di kelas ini
    $sql_check = "SELECT km.id, k.nama_matakuliah, k.kode_kelas
                  FROM kelas_mahasiswa km
                  JOIN kelas k ON km.id_kelas = k.id_kelas
                  WHERE km.id_kelas = :id_kelas AND km.id_mahasiswa = :id_mahasiswa";
    
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([
        'id_kelas' => $id_kelas,
        'id_mahasiswa' => $id_mahasiswa
    ]);
    
    $enrollment = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
    if (!$enrollment) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Anda tidak terdaftar di kelas ini.']);
        exit;
    }
    
    // 3. Delete dari kelas_mahasiswa
    $sql_delete = "DELETE FROM kelas_mahasiswa 
                   WHERE id_kelas = :id_kelas AND id_mahasiswa = :id_mahasiswa";
    
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->execute([
        'id_kelas' => $id_kelas,
        'id_mahasiswa' => $id_mahasiswa
    ]);
    
    // 4. Return JSON success
    echo json_encode([
        'success' => true,
        'message' => 'Berhasil keluar dari kelas.',
        'data' => [
            'id_kelas' => $id_kelas,
            'nama_matakuliah' => $enrollment['nama_matakuliah'],
            'kode_kelas' => $enrollment['kode_kelas']
        ]
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
