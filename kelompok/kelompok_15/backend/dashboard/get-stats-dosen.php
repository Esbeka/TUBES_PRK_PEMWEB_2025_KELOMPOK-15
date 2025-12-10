<?php
/**
 * FITUR 9: DASHBOARD & STATISTIK - STATS DOSEN
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Get statistik untuk dashboard dosen
 * - Hitung total kelas dibuat
 * - Hitung total mahasiswa (unique)
 * - Hitung tugas belum dinilai
 * - Query recent submissions
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => '', 'data' => null];

try {
    // 1. Cek session dosen
    requireRole('dosen');
    
    $id_dosen = getUserId();

    // 2. Count kelas WHERE id_dosen
    $count_kelas = "SELECT COUNT(id_kelas) as total_kelas FROM kelas WHERE id_dosen = ?";
    $stmt = $pdo->prepare($count_kelas);
    $stmt->execute([$id_dosen]);
    $result = $stmt->fetch();
    $total_kelas = intval($result['total_kelas']);

    // 3. Count DISTINCT mahasiswa from kelas_mahasiswa JOIN kelas
    $count_mahasiswa = "SELECT COUNT(DISTINCT km.id_mahasiswa) as total_mahasiswa 
                        FROM kelas_mahasiswa km
                        JOIN kelas k ON km.id_kelas = k.id_kelas
                        WHERE k.id_dosen = ?";
    $stmt = $pdo->prepare($count_mahasiswa);
    $stmt->execute([$id_dosen]);
    $result = $stmt->fetch();
    $total_mahasiswa = intval($result['total_mahasiswa']);

    // 4. Count submissions belum dinilai (NOT IN nilai)
    $count_ungraded = "SELECT COUNT(st.id_submission) as tugas_belum_dinilai
                       FROM submission_tugas st
                       JOIN tugas t ON st.id_tugas = t.id_tugas
                       JOIN kelas k ON t.id_kelas = k.id_kelas
                       WHERE k.id_dosen = ? AND st.status != 'graded'";
    $stmt = $pdo->prepare($count_ungraded);
    $stmt->execute([$id_dosen]);
    $result = $stmt->fetch();
    $tugas_belum_dinilai = intval($result['tugas_belum_dinilai']);

    // 5. Query recent submissions (5 terbaru)
    $recent_submissions = "SELECT 
        st.id_submission, st.submitted_at, st.status,
        t.judul as judul_tugas, k.nama_matakuliah,
        u.nama as nama_mahasiswa, u.npm_nidn
    FROM submission_tugas st
    JOIN tugas t ON st.id_tugas = t.id_tugas
    JOIN kelas k ON t.id_kelas = k.id_kelas
    JOIN users u ON st.id_mahasiswa = u.id_user
    WHERE k.id_dosen = ?
    ORDER BY st.submitted_at DESC
    LIMIT 5";
    
    $stmt = $pdo->prepare($recent_submissions);
    $stmt->execute([$id_dosen]);
    $submissions = $stmt->fetchAll();

    // Format recent submissions
    $recent_data = [];
    foreach ($submissions as $submission) {
        $recent_data[] = [
            'id_submission' => intval($submission['id_submission']),
            'nama_mahasiswa' => $submission['nama_mahasiswa'],
            'npm_nidn' => $submission['npm_nidn'],
            'judul_tugas' => $submission['judul_tugas'],
            'nama_matakuliah' => $submission['nama_matakuliah'],
            'submitted_at' => $submission['submitted_at'],
            'status' => $submission['status']
        ];
    }

    // 6. Return JSON statistik
    $response['success'] = true;
    $response['message'] = 'Statistik dosen berhasil diambil';
    $response['data'] = [
        'statistik' => [
            'total_kelas' => $total_kelas,
            'total_mahasiswa' => $total_mahasiswa,
            'tugas_belum_dinilai' => $tugas_belum_dinilai
        ],
        'recent_submissions' => $recent_data
    ];

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
