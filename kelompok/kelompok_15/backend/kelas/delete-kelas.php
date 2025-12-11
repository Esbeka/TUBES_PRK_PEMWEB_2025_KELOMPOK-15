<?php
/**
 * FITUR 2: MANAJEMEN KELAS - DELETE
 * Delete kelas dan cascade delete semua data terkait
 */

require_once __DIR__ . '/../auth/session-helper.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => ''];

try {
    requireDosen();
    validatePostMethod();

    // Get input dari JSON atau POST
    $input = $_POST;
    if (empty($_POST) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true) ?? [];
    }

    if (empty($input['id_kelas'])) {
        throw new Exception('id_kelas harus diberikan', 400);
    }

    $id_kelas = intval($input['id_kelas']);
    $id_dosen = getUserId();

    // Get kelas info
    $check = "SELECT id_dosen, nama_matakuliah FROM kelas WHERE id_kelas = ?";
    $stmt = $pdo->prepare($check);
    $stmt->execute([$id_kelas]);
    $kelas = $stmt->fetch();
    
    if (!$kelas) {
        throw new Exception('Kelas tidak ditemukan', 404);
    }
    
    // Authorization check
    if ($kelas['id_dosen'] != $id_dosen) {
        throw new Exception('Anda tidak memiliki akses untuk menghapus kelas ini', 403);
    }

    // Delete cascade akan otomatis via foreign key ON DELETE CASCADE
    // Urutan: submission_tugas (references tugas) -> tugas -> materi -> kelas_mahasiswa -> kelas
    $delete = "DELETE FROM kelas WHERE id_kelas = ?";
    $stmt = $pdo->prepare($delete);
    $stmt->execute([$id_kelas]);

    http_response_code(200);
    $response['success'] = true;
    $response['message'] = 'Kelas "' . $kelas['nama_matakuliah'] . '" dan semua data terkait berhasil dihapus';

} catch(Exception $e) {
    $code = $e->getCode() ?: 500;
    if ($code === 0) $code = 500;
    http_response_code($code);
    
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>


} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
