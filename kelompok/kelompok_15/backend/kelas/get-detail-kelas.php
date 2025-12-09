<?php
/**
 * FITUR 2: MANAJEMEN KELAS - GET DETAIL
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Get info lengkap kelas dengan statistik
 * - Get info kelas
 * - Get list mahasiswa, materi, tugas
 * - Hitung statistik
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

// Cek session
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    // Get id_kelas dari query parameter
    if (empty($_GET['id_kelas'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID kelas wajib diisi']);
        exit;
    }

    $id_kelas = (int)$_GET['id_kelas'];
    $id_user = $_SESSION['id_user'];
    $user_role = $_SESSION['role'];

    // Get kelas info
    $kelas_stmt = $pdo->prepare(
        "SELECT k.*, u.nama as nama_dosen 
         FROM kelas k 
         JOIN users u ON k.id_dosen = u.id_user 
         WHERE k.id_kelas = ?"
    );
    $kelas_stmt->execute([$id_kelas]);
    $kelas = $kelas_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$kelas) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Kelas tidak ditemukan']);
        exit;
    }

    // Check access - untuk dosen harus punya kelas ini, untuk mahasiswa cek apakah sudah join
    if ($user_role === 'dosen' && $kelas['id_dosen'] != $id_user) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Forbidden']);
        exit;
    }

    if ($user_role === 'mahasiswa') {
        $access_stmt = $pdo->prepare(
            "SELECT id FROM kelas_mahasiswa WHERE id_kelas = ? AND id_mahasiswa = ?"
        );
        $access_stmt->execute([$id_kelas, $id_user]);
        if ($access_stmt->rowCount() === 0) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Anda belum join kelas ini']);
            exit;
        }
    }

    // Get list mahasiswa
    $mahasiswa_stmt = $pdo->prepare(
        "SELECT u.id_user, u.nama, u.email, km.joined_at 
         FROM kelas_mahasiswa km 
         JOIN users u ON km.id_mahasiswa = u.id_user 
         WHERE km.id_kelas = ? 
         ORDER BY km.joined_at ASC"
    );
    $mahasiswa_stmt->execute([$id_kelas]);
    $mahasiswa_list = $mahasiswa_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get jumlah materi dan tugas
    $materi_count_stmt = $pdo->prepare("SELECT COUNT(*) as count FROM materi WHERE id_kelas = ?");
    $materi_count_stmt->execute([$id_kelas]);
    $materi_count = $materi_count_stmt->fetch(PDO::FETCH_ASSOC)['count'];

    $tugas_count_stmt = $pdo->prepare("SELECT COUNT(*) as count FROM tugas WHERE id_kelas = ?");
    $tugas_count_stmt->execute([$id_kelas]);
    $tugas_count = $tugas_count_stmt->fetch(PDO::FETCH_ASSOC)['count'];

    http_response_code(200);
    echo json_encode([
        'success' => true,
        'data' => [
            'id_kelas' => $kelas['id_kelas'],
            'id_dosen' => $kelas['id_dosen'],
            'nama_dosen' => $kelas['nama_dosen'],
            'nama_matakuliah' => $kelas['nama_matakuliah'],
            'kode_matakuliah' => $kelas['kode_matakuliah'],
            'semester' => $kelas['semester'],
            'tahun_ajaran' => $kelas['tahun_ajaran'],
            'deskripsi' => $kelas['deskripsi'],
            'kode_kelas' => $kelas['kode_kelas'],
            'kapasitas' => $kelas['kapasitas'],
            'jumlah_mahasiswa' => count($mahasiswa_list),
            'mahasiswa_list' => $mahasiswa_list,
            'jumlah_materi' => $materi_count,
            'jumlah_tugas' => $tugas_count,
            'created_at' => $kelas['created_at']
        ]
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

?>
