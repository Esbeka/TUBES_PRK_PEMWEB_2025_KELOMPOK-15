<?php
/**
 * FITUR 7: SUBMIT TUGAS - GET NILAI
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Mahasiswa lihat nilai & feedback
 * - Query nilai dan feedback untuk mahasiswa
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

// 2. Validasi input GET (id_tugas)
if (!isset($_GET['id_tugas']) || !is_numeric($_GET['id_tugas'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter id_tugas wajib diisi dan harus berupa angka.']);
    exit;
}

$id_tugas = (int) $_GET['id_tugas'];

try {
    // 3. Query submission JOIN nilai WHERE id_mahasiswa
    $sql = "SELECT 
                st.id_submission,
                st.id_tugas,
                st.file_path,
                st.keterangan,
                st.submitted_at,
                st.status,
                n.id_nilai,
                n.nilai,
                n.feedback,
                n.graded_at,
                t.judul AS judul_tugas,
                t.bobot,
                t.deadline
            FROM submission_tugas st
            LEFT JOIN nilai n ON st.id_submission = n.id_submission
            JOIN tugas t ON st.id_tugas = t.id_tugas
            WHERE st.id_tugas = :id_tugas 
            AND st.id_mahasiswa = :id_mahasiswa";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id_tugas' => $id_tugas,
        'id_mahasiswa' => $id_mahasiswa
    ]);
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Jika tidak ada submission
    if (!$result) {
        echo json_encode([
            'success' => true,
            'message' => 'Belum ada submission untuk tugas ini.',
            'data' => null
        ]);
        exit;
    }
    
    // 4. Return JSON nilai & feedback
    $response = [
        'id_submission' => (int) $result['id_submission'],
        'id_tugas' => (int) $result['id_tugas'],
        'judul_tugas' => $result['judul_tugas'],
        'file_path' => $result['file_path'],
        'keterangan' => $result['keterangan'],
        'submitted_at' => $result['submitted_at'],
        'deadline' => $result['deadline'],
        'status' => $result['status'],
        'bobot' => (int) $result['bobot'],
        'is_graded' => $result['id_nilai'] !== null,
        'nilai' => $result['nilai'] !== null ? (float) $result['nilai'] : null,
        'feedback' => $result['feedback'],
        'graded_at' => $result['graded_at']
    ];
    
    echo json_encode([
        'success' => true,
        'message' => 'Data nilai berhasil diambil.',
        'data' => $response
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
