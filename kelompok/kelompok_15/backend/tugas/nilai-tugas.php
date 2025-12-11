<?php
/**
 * FITUR 4: MANAJEMEN TUGAS - BERI NILAI
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Dosen beri nilai tugas
 * - Insert/update nilai mahasiswa
 * - Insert feedback (opsional)
 * - Set status submission menjadi 'graded'
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => ''];

try {
    // 1. Cek session dosen
    requireRole('dosen');
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed');
    }

    // 2. Validasi input POST
    if (empty($_POST['id_submission']) || !isset($_POST['nilai'])) {
        throw new Exception('Field required tidak lengkap');
    }

    $id_submission = intval($_POST['id_submission']);
    $nilai = intval($_POST['nilai']);
    $feedback = isset($_POST['feedback']) ? trim($_POST['feedback']) : '';
    $id_dosen = getUserId();

    // 3. Validasi nilai (0-100)
    if ($nilai < 0 || $nilai > 100) {
        throw new Exception('Nilai harus antara 0-100');
    }

    // Get submission info & verify ownership
    $get_submission = "SELECT st.id_submission, st.id_tugas, st.id_mahasiswa, 
                              t.id_kelas, k.id_dosen
                       FROM submission_tugas st
                       JOIN tugas t ON st.id_tugas = t.id_tugas
                       JOIN kelas k ON t.id_kelas = k.id_kelas
                       WHERE st.id_submission = ?";
    $stmt = $pdo->prepare($get_submission);
    $stmt->execute([$id_submission]);
    $submission = $stmt->fetch();
    
    if (!$submission) {
        throw new Exception('Submission tidak ditemukan');
    }
    
    if ($submission['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses untuk memberi nilai submission ini');
    }

    // 4. Insert/update tabel nilai
    // Check apakah nilai sudah ada
    $check_nilai = "SELECT id_nilai FROM nilai WHERE id_submission = ?";
    $stmt = $pdo->prepare($check_nilai);
    $stmt->execute([$id_submission]);
    $existing_nilai = $stmt->fetch();

    if ($existing_nilai) {
        // Update nilai
        $update_nilai = "UPDATE nilai SET nilai = ?, feedback = ?, updated_at = NOW() 
                        WHERE id_submission = ?";
        $stmt = $pdo->prepare($update_nilai);
        $stmt->execute([$nilai, $feedback, $id_submission]);
    } else {
        // Insert nilai baru
        $insert_nilai = "INSERT INTO nilai (id_submission, nilai, feedback, created_at, updated_at) 
                        VALUES (?, ?, ?, NOW(), NOW())";
        $stmt = $pdo->prepare($insert_nilai);
        $stmt->execute([$id_submission, $nilai, $feedback]);
    }

    // 5. Update status submission = 'graded'
    $update_submission = "UPDATE submission_tugas SET status = 'graded' WHERE id_submission = ?";
    $stmt = $pdo->prepare($update_submission);
    $stmt->execute([$id_submission]);

    // Return JSON success
    $response['success'] = true;
    $response['message'] = 'Nilai berhasil disimpan';

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
