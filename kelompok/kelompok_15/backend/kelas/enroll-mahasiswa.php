<?php
/**
 * ENROLL MAHASISWA KE KELAS
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session-helper.php';
require_once __DIR__ . '/../config/database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Method not allowed');
    if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'dosen') throw new Exception('Unauthorized');

    $data = json_decode(file_get_contents('php://input'), true);
    $id_kelas = $data['id_kelas'] ?? null;
    $id_mahasiswa = $data['id_mahasiswa'] ?? null;
    $id_dosen = $_SESSION['id_user'];

    if (!$id_kelas || !$id_mahasiswa) throw new Exception('id_kelas dan id_mahasiswa required');

    // Check kelas ownership
    $checkStmt = $pdo->prepare('SELECT id_kelas FROM kelas WHERE id_kelas = ? AND id_dosen = ?');
    $checkStmt->execute([$id_kelas, $id_dosen]);
    if (!$checkStmt->fetch()) throw new Exception('Forbidden');

    // Check if already enrolled
    $enrollStmt = $pdo->prepare('SELECT id_kelas_mahasiswa FROM kelas_mahasiswa WHERE id_kelas = ? AND id_mahasiswa = ?');
    $enrollStmt->execute([$id_kelas, $id_mahasiswa]);
    if ($enrollStmt->fetch()) throw new Exception('Mahasiswa sudah terdaftar di kelas ini');

    // Enroll
    $stmt = $pdo->prepare('INSERT INTO kelas_mahasiswa (id_kelas, id_mahasiswa) VALUES (?, ?)');
    $stmt->execute([$id_kelas, $id_mahasiswa]);
    
    http_response_code(201);
    echo json_encode(['success' => true, 'message' => 'Mahasiswa berhasil ditambahkan ke kelas']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>