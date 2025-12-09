<?php
/**
 * FITUR 2: MANAJEMEN KELAS - DELETE
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Hapus kelas dan semua data terkait
 * - Validasi ownership
 * - Delete cascade (kelas, materi, tugas, submissions)
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

// Cek jika user login dan adalah dosen
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if (!isDosen()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Forbidden']);
    exit;
}

try {
    // Get input data
    $input = [];
    $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
    
    if (strpos($content_type, 'application/json') !== false) {
        $input = json_decode(file_get_contents('php://input'), true);
    } else {
        $input = $_POST;
    }

    // Validasi id_kelas
    if (empty($input['id_kelas'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID kelas wajib diisi']);
        exit;
    }

    $id_kelas = (int)$input['id_kelas'];
    $id_dosen = $_SESSION['id_user'];

    // Cek ownership - kelas harus milik dosen yang login
    $ownership_stmt = $pdo->prepare("SELECT id_dosen FROM kelas WHERE id_kelas = ?");
    $ownership_stmt->execute([$id_kelas]);
    $kelas = $ownership_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$kelas) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Kelas tidak ditemukan']);
        exit;
    }

    if ($kelas['id_dosen'] != $id_dosen) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Forbidden: Anda tidak memiliki izin untuk menghapus kelas ini']);
        exit;
    }

    // Delete cascade akan otomatis terjadi karena sudah di-set di database schema
    // Foreign key: kelas_mahasiswa -> kelas ON DELETE CASCADE
    // Foreign key: materi -> kelas ON DELETE CASCADE
    // Foreign key: tugas -> kelas ON DELETE CASCADE
    // Foreign key: submission_tugas -> tugas ON DELETE CASCADE
    // Foreign key: nilai -> submission_tugas ON DELETE CASCADE

    $delete_stmt = $pdo->prepare("DELETE FROM kelas WHERE id_kelas = ? AND id_dosen = ?");
    $result = $delete_stmt->execute([$id_kelas, $id_dosen]);

    if ($delete_stmt->rowCount() > 0) {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Kelas dan semua data terkait berhasil dihapus'
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Kelas tidak ditemukan atau sudah dihapus']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

?>
