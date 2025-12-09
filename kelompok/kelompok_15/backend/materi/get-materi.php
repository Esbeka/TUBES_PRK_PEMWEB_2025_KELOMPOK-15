<?php
/**
 * FITUR 3: MANAJEMEN MATERI - GET MATERI (DOSEN)
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Get semua materi untuk dosen
 * - Query materi berdasarkan id_kelas
 * - Group by pertemuan
 * - Return JSON
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => '', 'data' => []];

try {
    // 1. Cek session dosen
    requireRole('dosen');
    
    // 2. Validasi input GET
    if (empty($_GET['id_kelas'])) {
        throw new Exception('id_kelas harus diberikan');
    }

    $id_kelas = intval($_GET['id_kelas']);
    $id_dosen = getUserId();

    // 3. Cek ownership kelas
    $check_kelas = "SELECT id_dosen FROM kelas WHERE id_kelas = ?";
    $stmt = $pdo->prepare($check_kelas);
    $stmt->execute([$id_kelas]);
    $kelas = $stmt->fetch();
    
    if (!$kelas || $kelas['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses ke kelas ini');
    }

    // 4. Query materi WHERE id_kelas GROUP BY pertemuan_ke
    $query = "SELECT 
        id_materi, judul, deskripsi, tipe, file_path, 
        pertemuan_ke, uploaded_at
    FROM materi
    WHERE id_kelas = ?
    ORDER BY pertemuan_ke ASC, uploaded_at ASC";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_kelas]);
    $materi_list = $stmt->fetchAll();

    // Format response - group by pertemuan
    $grouped_data = [];
    foreach ($materi_list as $materi) {
        $pertemuan = $materi['pertemuan_ke'];
        
        if (!isset($grouped_data[$pertemuan])) {
            $grouped_data[$pertemuan] = [
                'pertemuan_ke' => intval($pertemuan),
                'materi' => []
            ];
        }
        
        $grouped_data[$pertemuan]['materi'][] = [
            'id_materi' => intval($materi['id_materi']),
            'judul' => $materi['judul'],
            'deskripsi' => $materi['deskripsi'],
            'tipe' => $materi['tipe'],
            'file_path' => $materi['file_path'],
            'uploaded_at' => $materi['uploaded_at']
        ];
    }

    // Re-index untuk array sequential
    $data = array_values($grouped_data);

    // 5. Return JSON success
    $response['success'] = true;
    $response['message'] = count($materi_list) . ' materi ditemukan';
    $response['data'] = $data;

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
