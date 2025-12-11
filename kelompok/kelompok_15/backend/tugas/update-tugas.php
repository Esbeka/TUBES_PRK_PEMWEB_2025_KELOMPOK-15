<?php
/**
 * FITUR 4: MANAJEMEN TUGAS - UPDATE
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Update tugas
 * - Validasi: deadline hanya bisa diubah jika belum lewat
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
    if (empty($_POST['id_tugas']) || empty($_POST['judul'])) {
        throw new Exception('Field required tidak lengkap');
    }

    $id_tugas = intval($_POST['id_tugas']);
    $judul = trim($_POST['judul']);
    $deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';
    $deadline = isset($_POST['deadline']) ? trim($_POST['deadline']) : null;
    $max_file_size = isset($_POST['max_file_size']) ? intval($_POST['max_file_size']) : null;
    $allowed_formats = isset($_POST['allowed_formats']) ? trim($_POST['allowed_formats']) : null;
    $bobot = isset($_POST['bobot']) ? intval($_POST['bobot']) : null;
    $id_dosen = getUserId();

    // Validasi judul
    if (strlen($judul) < 3) {
        throw new Exception('Judul minimal 3 karakter');
    }

    // 3. Cek ownership & get tugas info
    $get_tugas = "SELECT t.id_tugas, t.deadline, k.id_dosen 
                  FROM tugas t 
                  JOIN kelas k ON t.id_kelas = k.id_kelas 
                  WHERE t.id_tugas = ?";
    $stmt = $pdo->prepare($get_tugas);
    $stmt->execute([$id_tugas]);
    $tugas = $stmt->fetch();
    
    if (!$tugas) {
        throw new Exception('Tugas tidak ditemukan');
    }
    
    if ($tugas['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses untuk mengubah tugas ini');
    }

    // 4. Validasi deadline (tidak boleh ubah jika sudah lewat)
    $current_deadline_timestamp = strtotime($tugas['deadline']);
    $now = time();
    
    if ($deadline !== null && $current_deadline_timestamp <= $now) {
        throw new Exception('Tidak bisa mengubah deadline tugas yang sudah lewat');
    }

    // Jika deadline baru diberikan, validasi format
    if ($deadline !== null) {
        $deadline_timestamp = strtotime($deadline);
        if ($deadline_timestamp === false) {
            throw new Exception('Format deadline tidak valid');
        }
    }

    // Validasi bobot jika ada
    if ($bobot !== null && ($bobot < 1 || $bobot > 100)) {
        throw new Exception('Bobot harus antara 1-100');
    }

    // 5. Update tugas
    $update_parts = ['judul = ?', 'deskripsi = ?'];
    $params = [$judul, $deskripsi];

    if ($deadline !== null) {
        $update_parts[] = 'deadline = ?';
        $params[] = $deadline;
    }
    if ($max_file_size !== null) {
        $update_parts[] = 'max_file_size = ?';
        $params[] = $max_file_size;
    }
    if ($allowed_formats !== null) {
        $update_parts[] = 'allowed_formats = ?';
        $params[] = $allowed_formats;
    }
    if ($bobot !== null) {
        $update_parts[] = 'bobot = ?';
        $params[] = $bobot;
    }

    $params[] = $id_tugas;
    $update = "UPDATE tugas SET " . implode(', ', $update_parts) . " WHERE id_tugas = ?";
    
    $stmt = $pdo->prepare($update);
    $stmt->execute($params);

    // 6. Return JSON success
    $response['success'] = true;
    $response['message'] = 'Tugas berhasil diupdate';

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
