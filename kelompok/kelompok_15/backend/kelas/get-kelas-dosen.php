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

$response = ['success' => false, 'message' => '', 'data' => []];

try {
    requireRole('dosen');
    $id_dosen = getUserId();

    $query = "SELECT 
        k.id_kelas, k.nama_matakuliah, k.kode_matakuliah, k.kode_kelas,
        k.semester, k.tahun_ajaran, k.deskripsi, k.kapasitas, k.created_at,
        COUNT(DISTINCT km.id_mahasiswa) as jumlah_mahasiswa,
        COUNT(DISTINCT m.id_materi) as jumlah_materi,
        COUNT(DISTINCT t.id_tugas) as jumlah_tugas
    FROM kelas k
    LEFT JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
    LEFT JOIN materi m ON k.id_kelas = m.id_kelas
    LEFT JOIN tugas t ON k.id_kelas = t.id_kelas
    WHERE k.id_dosen = ?
    GROUP BY k.id_kelas
    ORDER BY k.created_at DESC";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_dosen]);
    $kelas_list = $stmt->fetchAll();

    $data = [];
    foreach ($kelas_list as $kelas) {
        $data[] = [
            'id_kelas' => intval($kelas['id_kelas']),
            'nama_matakuliah' => $kelas['nama_matakuliah'],
            'kode_matakuliah' => $kelas['kode_matakuliah'],
            'kode_kelas' => $kelas['kode_kelas'],
            'semester' => $kelas['semester'],
            'tahun_ajaran' => $kelas['tahun_ajaran'],
            'deskripsi' => $kelas['deskripsi'],
            'kapasitas' => intval($kelas['kapasitas']),
            'jumlah_mahasiswa' => intval($kelas['jumlah_mahasiswa']),
            'jumlah_materi' => intval($kelas['jumlah_materi']),
            'jumlah_tugas' => intval($kelas['jumlah_tugas']),
            'created_at' => $kelas['created_at']
        ];
    }

    $response['success'] = true;
    $response['message'] = count($data) . ' kelas ditemukan';
    $response['data'] = $data;

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
