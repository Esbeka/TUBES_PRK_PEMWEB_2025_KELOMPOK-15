<?php
/**
 * FITUR 4: MANAJEMEN TUGAS - GET SUBMISSIONS
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Get semua submission untuk tugas tertentu
 * - Query submission tugas dengan join ke users
 * - Calculate status (on time / late)
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
    if (empty($_GET['id_tugas'])) {
        throw new Exception('id_tugas harus diberikan');
    }

    $id_tugas = intval($_GET['id_tugas']);
    $id_dosen = getUserId();

    // 3. Cek ownership tugas
    $check_tugas = "SELECT t.id_tugas, t.deadline, k.id_dosen 
                    FROM tugas t 
                    JOIN kelas k ON t.id_kelas = k.id_kelas 
                    WHERE t.id_tugas = ?";
    $stmt = $pdo->prepare($check_tugas);
    $stmt->execute([$id_tugas]);
    $tugas = $stmt->fetch();
    
    if (!$tugas) {
        throw new Exception('Tugas tidak ditemukan');
    }
    
    if ($tugas['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses ke tugas ini');
    }

    // 4. Query submission JOIN users
    // 5. LEFT JOIN nilai untuk get nilai jika sudah dinilai
    $query = "SELECT 
        st.id_submission, st.id_mahasiswa, st.submitted_at, st.file_path, st.status,
        u.nama as nama_mahasiswa, u.email as email_mahasiswa, u.npm_nidn,
        n.id_nilai, n.nilai, n.feedback
    FROM submission_tugas st
    JOIN users u ON st.id_mahasiswa = u.id_user
    LEFT JOIN nilai n ON st.id_submission = n.id_submission
    WHERE st.id_tugas = ?
    ORDER BY st.submitted_at DESC";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_tugas]);
    $submissions = $stmt->fetchAll();

    // Format response dengan calculate status on time / late
    $deadline_timestamp = strtotime($tugas['deadline']);
    $data = [];
    
    foreach ($submissions as $submission) {
        $submitted_timestamp = strtotime($submission['submitted_at']);
        $submission_status = ($submitted_timestamp <= $deadline_timestamp) ? 'on_time' : 'late';
        
        $data[] = [
            'id_submission' => intval($submission['id_submission']),
            'id_mahasiswa' => intval($submission['id_mahasiswa']),
            'nama_mahasiswa' => $submission['nama_mahasiswa'],
            'email_mahasiswa' => $submission['email_mahasiswa'],
            'npm_nidn' => $submission['npm_nidn'],
            'file_path' => $submission['file_path'],
            'submitted_at' => $submission['submitted_at'],
            'submission_status' => $submission_status,
            'grading_status' => $submission['status'],
            'nilai' => $submission['nilai'] !== null ? intval($submission['nilai']) : null,
            'feedback' => $submission['feedback']
        ];
    }

    // Return JSON success
    $response['success'] = true;
    $response['message'] = count($data) . ' submission ditemukan';
    $response['data'] = $data;

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
