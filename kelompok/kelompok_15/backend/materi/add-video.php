<?php
/**
 * FITUR 3: MANAJEMEN MATERI - ADD VIDEO
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Tambah materi video (YouTube/Google Drive)
 * - Validasi URL format
 * - Insert link video ke database
 */

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
    if (empty($_POST['id_kelas']) || empty($_POST['judul']) || empty($_POST['video_url']) || empty($_POST['pertemuan_ke'])) {
        throw new Exception('Field required tidak lengkap');
    }

    $id_kelas = intval($_POST['id_kelas']);
    $judul = trim($_POST['judul']);
    $deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';
    $video_url = trim($_POST['video_url']);
    $pertemuan_ke = intval($_POST['pertemuan_ke']);
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

    // 3. Validasi URL format (YouTube atau Google Drive)
    $youtube_pattern = '/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+/i';
    $gdrive_pattern = '/^(https?:\/\/)?(drive\.google\.com)\/.+/i';
    
    if (!preg_match($youtube_pattern, $video_url) && !preg_match($gdrive_pattern, $video_url)) {
        throw new Exception('URL harus dari YouTube atau Google Drive');
    }

    // 4. Insert ke tabel materi
    $insert = "INSERT INTO materi (id_kelas, judul, deskripsi, tipe, file_path, pertemuan_ke) 
               VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($insert);
    $stmt->execute([
        $id_kelas,
        $judul,
        $deskripsi,
        'video',
        $video_url,
        $pertemuan_ke
    ]);

    $id_materi = $pdo->lastInsertId();

    // 5. Return JSON success
    $response['success'] = true;
    $response['message'] = 'Video link berhasil ditambahkan';
    $response['data'] = [
        'id_materi' => intval($id_materi),
        'judul' => $judul,
        'video_url' => $video_url
    ];

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
