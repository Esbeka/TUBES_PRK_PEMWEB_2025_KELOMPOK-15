<?php
/**
 * FITUR 2: MANAJEMEN KELAS - CREATE
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Buat kelas baru untuk dosen
 * - Generate kode unik 6 karakter
 * - Insert kelas ke database dengan id_dosen dari session
 * - Return kode kelas ke frontend
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

// Response structure
$response = [
    'success' => false,
    'message' => '',
    'data' => null
];

try {
    // 1. Cek session dosen
    requireRole('dosen');
    
    // Validasi method POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed');
    }

    // 2. Validasi input POST
    if (empty($_POST['nama_matakuliah']) || empty($_POST['kode_matakuliah']) || 
        empty($_POST['semester']) || empty($_POST['tahun_ajaran'])) {
        throw new Exception('Semua field harus diisi');
    }

    $nama_matakuliah = trim($_POST['nama_matakuliah']);
    $kode_matakuliah = trim($_POST['kode_matakuliah']);
    $semester = trim($_POST['semester']);
    $tahun_ajaran = trim($_POST['tahun_ajaran']);
    $deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';
    $kapasitas = isset($_POST['kapasitas']) ? intval($_POST['kapasitas']) : 50;
    
    // Validasi panjang
    if (strlen($nama_matakuliah) < 3) {
        throw new Exception('Nama matakuliah minimal 3 karakter');
    }
    if (strlen($kode_matakuliah) < 2) {
        throw new Exception('Kode matakuliah minimal 2 karakter');
    }
    if ($kapasitas < 1 || $kapasitas > 500) {
        throw new Exception('Kapasitas harus antara 1-500');
    }

    // 3. Generate kode_kelas unique 6 karakter
    $kode_kelas = '';
    $kode_valid = false;
    $attempts = 0;
    
    while (!$kode_valid && $attempts < 10) {
        // Generate random 6 character code (uppercase alphanumeric)
        $kode_kelas = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));
        
        // Check if kode_kelas already exists
        $check = "SELECT kode_kelas FROM kelas WHERE kode_kelas = ?";
        $stmt = $pdo->prepare($check);
        $stmt->execute([$kode_kelas]);
        
        if ($stmt->rowCount() == 0) {
            $kode_valid = true;
        }
        $attempts++;
    }
    
    if (!$kode_valid) {
        throw new Exception('Gagal generate kode kelas unik');
    }

    // 4. Insert ke tabel kelas
    $id_dosen = getUserId();
    $insert = "INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($insert);
    $stmt->execute([
        $id_dosen,
        $nama_matakuliah,
        $kode_matakuliah,
        $semester,
        $tahun_ajaran,
        $deskripsi,
        $kode_kelas,
        $kapasitas
    ]);

    $id_kelas = $pdo->lastInsertId();

    // 5. Return JSON dengan kode_kelas & id_kelas
    $response['success'] = true;
    $response['message'] = 'Kelas berhasil dibuat';
    $response['data'] = [
        'id_kelas' => intval($id_kelas),
        'kode_kelas' => $kode_kelas,
        'nama_matakuliah' => $nama_matakuliah,
        'kode_matakuliah' => $kode_matakuliah
    ];

} catch(Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
