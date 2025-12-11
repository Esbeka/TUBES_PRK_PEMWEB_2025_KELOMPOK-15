<?php
/**
 * CREATE TUGAS
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session-helper.php';
require_once __DIR__ . '/../config/database.php';

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => '', 'data' => null];

try {
    // 1. Cek session dosen
    requireRole('dosen');
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed');
    }

    // 2. Validasi input POST
    if (empty($_POST['id_kelas']) || empty($_POST['judul']) || empty($_POST['deadline'])) {
        throw new Exception('Field required tidak lengkap');
    }

    $id_kelas = intval($_POST['id_kelas']);
    $judul = trim($_POST['judul']);
    $deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';
    $deadline = trim($_POST['deadline']);
    $max_file_size = isset($_POST['max_file_size']) ? intval($_POST['max_file_size']) : 5;
    $allowed_formats = isset($_POST['allowed_formats']) ? trim($_POST['allowed_formats']) : 'pdf,doc,docx,xls,xlsx,ppt,pptx';
    $bobot = isset($_POST['bobot']) ? intval($_POST['bobot']) : 10;
    $id_dosen = getUserId();

    // Validasi judul
    if (strlen($judul) < 3) {
        throw new Exception('Judul minimal 3 karakter');
    }

    // Cek ownership kelas
    $check_kelas = "SELECT id_dosen FROM kelas WHERE id_kelas = ?";
    $stmt = $pdo->prepare($check_kelas);
    $stmt->execute([$id_kelas]);
    $kelas = $stmt->fetch();
    
    if (!$kelas || $kelas['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses ke kelas ini');
    }

    // 3. Validasi deadline (harus di masa depan)
    $deadline_timestamp = strtotime($deadline);
    if ($deadline_timestamp === false || $deadline_timestamp <= time()) {
        throw new Exception('Deadline harus di masa depan');
    }

    // Validasi bobot
    if ($bobot < 1 || $bobot > 100) {
        throw new Exception('Bobot harus antara 1-100');
    }

    // 4. Insert ke tabel tugas
    $insert = "INSERT INTO tugas (id_kelas, judul, deskripsi, deadline, max_file_size, allowed_formats, bobot, status) 
               VALUES (?, ?, ?, ?, ?, ?, ?, 'active')";
    
    $stmt = $pdo->prepare($insert);
    $stmt->execute([
        $id_kelas,
        $judul,
        $deskripsi,
        $deadline,
        $max_file_size,
        $allowed_formats,
        $bobot
    ]);

    $id_tugas = $pdo->lastInsertId();

    // 5. Return JSON success
    $response['success'] = true;
    $response['message'] = 'Tugas berhasil dibuat';
    $response['data'] = [
        'id_tugas' => intval($id_tugas),
        'judul' => $judul,
        'deadline' => $deadline,
        'status' => 'active'
    ];

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
