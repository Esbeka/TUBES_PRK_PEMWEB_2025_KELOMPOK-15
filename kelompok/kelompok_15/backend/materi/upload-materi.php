<?php
/**
 * UPLOAD MATERI
 * Endpoint: POST /backend/materi/upload-materi.php
 * Upload PDF/File materi pembelajaran
 */

header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session-helper.php';
require_once __DIR__ . '/../config/database.php';

try {
    // Validate method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        throw new Exception('Method not allowed');
    }

    // Check authentication
    if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
        http_response_code(401);
        throw new Exception('Unauthorized - Dosen only');
    }

    $id_dosen = $_SESSION['id_user'];
    $id_kelas = $_POST['id_kelas'] ?? null;
    $judul = $_POST['judul'] ?? null;
    $deskripsi = $_POST['deskripsi'] ?? null;
    $pertemuan_ke = $_POST['pertemuan_ke'] ?? null;

    // Validate inputs
    if (!$id_kelas || !$judul) {
        http_response_code(400);
        throw new Exception('id_kelas dan judul required');
    }

    // Check ownership - kelas harus milik dosen yang login
    $checkStmt = $pdo->prepare('SELECT id_kelas FROM kelas WHERE id_kelas = ? AND id_dosen = ?');
    $checkStmt->execute([$id_kelas, $id_dosen]);
    if (!$checkStmt->fetch()) {
        http_response_code(403);
        throw new Exception('Forbidden - Class tidak ditemukan atau bukan milik Anda');
    }

    // Validate file upload
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        throw new Exception('File upload error');
    }

    $file = $_FILES['file'];
    $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $max_size = 10 * 1024 * 1024; // 10MB

    // Check file type
    if (!in_array($file['type'], $allowed_types)) {
        http_response_code(400);
        throw new Exception('File type not allowed (PDF, DOC, DOCX only)');
    }

    // Check file size
    if ($file['size'] > $max_size) {
        http_response_code(400);
        throw new Exception('File terlalu besar (max 10MB)');
    }

    // Generate filename
    $upload_dir = __DIR__ . '/../../uploads/materi/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = 'materi_' . $id_kelas . '_' . time() . '_' . uniqid() . '.' . $file_ext;
    $file_path = $upload_dir . $file_name;

    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $file_path)) {
        http_response_code(500);
        throw new Exception('Failed to upload file');
    }

    // Insert to database
    $stmt = $pdo->prepare('
        INSERT INTO materi (id_kelas, id_dosen, judul, deskripsi, file_path, pertemuan_ke, created_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())
    ');
    
    $stmt->execute([$id_kelas, $id_dosen, $judul, $deskripsi ?: null, $file_name, $pertemuan_ke ?: null]);
    $id_materi = $pdo->lastInsertId();

    http_response_code(201);
    echo json_encode([
        'success' => true,
        'message' => 'Materi berhasil diupload',
        'data' => [
            'id_materi' => $id_materi,
            'file_name' => $file_name,
            'judul' => $judul
        ]
    ]);

} catch (Exception $e) {
    http_response_code(isset($http_code) ? $http_code : 500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
