<?php
/**
 * FITUR 2: MANAJEMEN KELAS - GET KELAS DOSEN
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Get semua kelas yang dibuat dosen
 * - Query kelas berdasarkan id_dosen
 * - Join untuk hitung jumlah mahasiswa
 * - Return JSON array kelas
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

// Cek jika user login dan adalah dosen
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if (!isDosen()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Forbidden: Hanya dosen yang dapat mengakses']);
    exit;
}

try {
    $id_dosen = $_SESSION['id_user'];

    // Query kelas dengan count mahasiswa
    $stmt = $pdo->prepare(
        "SELECT 
            k.id_kelas,
            k.nama_matakuliah,
            k.kode_matakuliah,
            k.semester,
            k.tahun_ajaran,
            k.kode_kelas,
            k.deskripsi,
            k.kapasitas,
            k.created_at,
            COUNT(km.id_mahasiswa) as jumlah_mahasiswa
        FROM kelas k
        LEFT JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
        WHERE k.id_dosen = ?
        GROUP BY k.id_kelas
        ORDER BY k.created_at DESC"
    );

    $stmt->execute([$id_dosen]);
    $kelas_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

    http_response_code(200);
    echo json_encode([
        'success' => true,
        'data' => $kelas_list
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

?>
