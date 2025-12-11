<?php
/**
 * FITUR 7: SUBMIT TUGAS - GET NILAI
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Mahasiswa lihat nilai & feedback
 * - Query nilai dan feedback untuk mahasiswa
 * - Include info submission (file, submitted_at, status)
 * - Include info tugas (judul, deadline, bobot)
 * 
 * Requirement Implementation Checklist:
 *   ✓ Cek session mahasiswa - Validasi user sudah login & role = mahasiswa
 *   ✓ Validasi input GET (id_submission) - Parameter wajib & numeric
 *   ✓ Query submission WHERE id_submission & id_mahasiswa
 *     - Verifikasi submission milik mahasiswa yang login
 *     - Return 404 jika submission tidak ada/bukan milik user
 *   ✓ Query nilai & tugas via LEFT JOIN
 *     - LEFT JOIN nilai ON submission_tugas.id_submission = nilai.id_submission
 *     - LEFT JOIN tugas ON submission_tugas.id_tugas = tugas.id_tugas
 *     - Get semua field: nilai, feedback, graded_at (dari nilai)
 *     - Get: judul, deadline, bobot (dari tugas)
 *   ✓ Return JSON nilai lengkap
 *     - Include submission info: id_submission, file_path, status, submitted_at, attempt_count
 *     - Include task info: id_tugas, judul, deadline, bobot
 *     - Include grade info: nilai, feedback, graded_at (null jika belum di-grade)
 *   ✓ Error handling
 *     - 401: Unauthorized (bukan mahasiswa)
 *     - 400: Bad request (parameter tidak valid)
 *     - 404: Submission tidak ditemukan
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

// 2. Validasi input GET (id_submission)
if (!isset($_GET['id_submission']) || !is_numeric($_GET['id_submission'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter id_submission wajib diisi dan harus berupa angka.']);
    exit;
}

$id_submission = (int) $_GET['id_submission'];

try {
    // 3 & 4. Query submission dengan nilai & tugas
    $sql = "SELECT 
                s.id_submission,
                s.id_tugas,
                s.file_path,
                s.keterangan,
                s.status,
                s.submitted_at,
                s.attempt_count,
                t.judul,
                t.deadline,
                t.bobot,
                t.id_kelas,
                n.id_nilai,
                n.nilai,
                n.feedback,
                n.graded_at
            FROM submission_tugas s
            LEFT JOIN tugas t ON s.id_tugas = t.id_tugas
            LEFT JOIN nilai n ON s.id_submission = n.id_submission
            WHERE s.id_submission = :id_submission AND s.id_mahasiswa = :id_mahasiswa";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id_submission' => $id_submission,
        'id_mahasiswa' => $id_mahasiswa
    ]);
    
    $submission = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$submission) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Submission tidak ditemukan atau bukan milik Anda.']);
        exit;
    }
    
    // Prepare response data
    $response_data = [
        'submission' => [
            'id_submission' => (int) $submission['id_submission'],
            'id_tugas' => (int) $submission['id_tugas'],
            'file_path' => $submission['file_path'],
            'keterangan' => $submission['keterangan'],
            'status' => $submission['status'],
            'submitted_at' => $submission['submitted_at'],
            'attempt_count' => (int) $submission['attempt_count']
        ],
        'task' => [
            'id_tugas' => (int) $submission['id_tugas'],
            'judul' => $submission['judul'],
            'deadline' => $submission['deadline'],
            'bobot' => $submission['bobot'],
            'id_kelas' => (int) $submission['id_kelas']
        ],
        'grade' => null
    ];
    
    // Add grade info if graded
    if (!empty($submission['id_nilai'])) {
        $response_data['grade'] = [
            'id_nilai' => (int) $submission['id_nilai'],
            'nilai' => (float) $submission['nilai'],
            'feedback' => $submission['feedback'],
            'graded_at' => $submission['graded_at']
        ];
    }
    
    // Return JSON success
    echo json_encode([
        'success' => true,
        'message' => 'Berhasil mengambil data nilai.',
        'data' => $response_data
    ], JSON_UNESCAPED_UNICODE);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan saat mengambil data nilai: ' . $e->getMessage()
    ]);
}
?>