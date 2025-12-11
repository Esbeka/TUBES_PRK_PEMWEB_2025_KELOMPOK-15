<?php
/**
 * UPDATE MATERI
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session-helper.php';
require_once __DIR__ . '/../config/database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Method not allowed');
    if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'dosen') throw new Exception('Unauthorized');

    $id_materi = $_POST['id_materi'] ?? null;
    $judul = $_POST['judul'] ?? null;
    $deskripsi = $_POST['deskripsi'] ?? null;
    $pertemuan_ke = $_POST['pertemuan_ke'] ?? null;
    $id_dosen = $_SESSION['id_user'];

    if (!$id_materi || !$judul) throw new Exception('id_materi dan judul required');

    $stmt = $pdo->prepare('SELECT file_path FROM materi WHERE id_materi = ? AND id_dosen = ?');
    $stmt->execute([$id_materi, $id_dosen]);
    $materi = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$materi) throw new Exception('Forbidden');

    $file_name = $materi['file_path'];
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];
        if (!in_array($file['type'], ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])) 
            throw new Exception('File type not allowed');
        if ($file['size'] > 10 * 1024 * 1024) throw new Exception('File terlalu besar');

        $old_path = __DIR__ . '/../../uploads/materi/' . $materi['file_path'];
        if (file_exists($old_path)) unlink($old_path);

        $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_name = 'materi_' . time() . '_' . uniqid() . '.' . $file_ext;
        if (!move_uploaded_file($file['tmp_name'], __DIR__ . '/../../uploads/materi/' . $file_name)) throw new Exception('Upload failed');
    }

    $upStmt = $pdo->prepare('UPDATE materi SET judul = ?, deskripsi = ?, file_path = ?, pertemuan_ke = ? WHERE id_materi = ?');
    $upStmt->execute([$judul, $deskripsi, $file_name, $pertemuan_ke, $id_materi]);

    echo json_encode(['success' => true, 'message' => 'Materi berhasil diupdate']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
