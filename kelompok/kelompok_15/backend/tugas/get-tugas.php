<?php
/**
 * FITUR 4: MANAJEMEN TUGAS - GET TUGAS (DOSEN)
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Get semua tugas kelas untuk dosen
 * - Query tugas per kelas
 * - Hitung jumlah submission
 * - Check status (active jika deadline > now)
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

    // Cek ownership kelas
    $check_kelas = "SELECT id_dosen FROM kelas WHERE id_kelas = ?";
    $stmt = $pdo->prepare($check_kelas);
    $stmt->execute([$id_kelas]);
    $kelas = $stmt->fetch();
    
    if (!$kelas || $kelas['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses ke kelas ini');
    }

    // 3. Query tugas WHERE id_kelas dengan count submissions
    $query = "SELECT 
        t.id_tugas, t.judul, t.deskripsi, t.deadline, 
        t.max_file_size, t.bobot, t.created_at,
        COUNT(DISTINCT st.id_submission) as jumlah_submission,
        COUNT(DISTINCT CASE WHEN st.status = 'graded' THEN st.id_submission END) as jumlah_dinilai
    FROM tugas t
    LEFT JOIN submission_tugas st ON t.id_tugas = st.id_tugas
    WHERE t.id_kelas = ?
    GROUP BY t.id_tugas
    ORDER BY t.deadline ASC";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_kelas]);
    $tugas_list = $stmt->fetchAll();

    // 4. Format response dengan check status active/expired
    $now = time();
    $data = [];
    foreach ($tugas_list as $tugas) {
        $deadline_timestamp = strtotime($tugas['deadline']);
        $status = ($deadline_timestamp > $now) ? 'active' : 'expired';
        
        $data[] = [
            'id_tugas' => intval($tugas['id_tugas']),
            'judul' => $tugas['judul'],
            'deskripsi' => $tugas['deskripsi'],
            'deadline' => $tugas['deadline'],
            'bobot' => intval($tugas['bobot']),
            'status' => $status,
            'jumlah_submission' => intval($tugas['jumlah_submission']),
            'jumlah_dinilai' => intval($tugas['jumlah_dinilai']),
            'created_at' => $tugas['created_at']
        ];
    }

    // 5. Return JSON success
    $response['success'] = true;
    $response['message'] = count($data) . ' tugas ditemukan';
    $response['data'] = $data;

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
