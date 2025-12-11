<?php
// Get nilai (grades) for class/assignment
require_once '../config/database.php';
require_once '../auth/session-helper.php';

// Check authentication & role
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'dosen') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Get query parameters
    $id_tugas = $_GET['id_tugas'] ?? null;
    $id_kelas = $_GET['id_kelas'] ?? null;
    $id_dosen = $_SESSION['id_user'];

    if (!$id_tugas && !$id_kelas) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'id_tugas or id_kelas required']);
        exit;
    }

    if ($id_tugas) {
        // Get grades for specific assignment
        $stmt = $db->prepare("
            SELECT n.*, s.id_mahasiswa, u.nama, t.judul as judul_tugas
            FROM nilai n
            JOIN submission_tugas s ON n.id_submission = s.id_submission
            JOIN tugas t ON s.id_tugas = t.id_tugas
            JOIN kelas k ON t.id_kelas = k.id_kelas
            JOIN users u ON s.id_mahasiswa = u.id_user
            WHERE s.id_tugas = ? AND k.id_dosen = ?
            ORDER BY n.tanggal_penilaian DESC
        ");
        $stmt->execute([$id_tugas, $id_dosen]);
    } else {
        // Get grades for all assignments in class
        $stmt = $db->prepare("
            SELECT n.*, s.id_mahasiswa, u.nama, t.judul as judul_tugas, t.bobot
            FROM nilai n
            JOIN submission_tugas s ON n.id_submission = s.id_submission
            JOIN tugas t ON s.id_tugas = t.id_tugas
            JOIN kelas k ON t.id_kelas = k.id_kelas
            JOIN users u ON s.id_mahasiswa = u.id_user
            WHERE k.id_kelas = ? AND k.id_dosen = ?
            ORDER BY t.id_tugas ASC, u.nama ASC, n.tanggal_penilaian DESC
        ");
        $stmt->execute([$id_kelas, $id_dosen]);
    }

    $nilai_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => $nilai_list ?: []
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;
}
?>
