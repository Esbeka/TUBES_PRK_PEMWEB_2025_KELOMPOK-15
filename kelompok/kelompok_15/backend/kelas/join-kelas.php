<?php
/**
 * FITUR 5: JOIN KELAS - JOIN
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Mahasiswa join kelas dengan kode
 * - Validasi kode kelas exists
 * - Cek mahasiswa belum join (check duplicate)
 * - Cek kapasitas kelas belum penuh
 * - Insert ke tabel kelas_mahasiswa
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/database.php';

session_start();

// 1. Cek session mahasiswa
if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized. Mahasiswa belum login atau tidak memiliki akses.']);
    exit;
}

$id_mahasiswa = (int) $_SESSION['id_user'];

// 2. Validasi input POST (kode_kelas)
if (!isset($_POST['kode_kelas']) || empty(trim($_POST['kode_kelas']))) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Kode kelas wajib diisi.']);
    exit;
}

$kode_kelas = strtoupper(trim($_POST['kode_kelas'])); // Normalize to uppercase

try {
    // 3 & 4. Query kelas by kode_kelas dan cek kelas exists
    $sql = "SELECT k.id_kelas, k.nama_matakuliah, k.kode_matakuliah, k.semester, 
                   k.tahun_ajaran, k.kapasitas, u.nama AS nama_dosen,
                   COUNT(km.id_mahasiswa) AS jumlah_mahasiswa
            FROM kelas k
            LEFT JOIN users u ON k.id_dosen = u.id_user
            LEFT JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
            WHERE k.kode_kelas = :kode_kelas
            GROUP BY k.id_kelas, k.nama_matakuliah, k.kode_matakuliah, k.semester, 
                     k.tahun_ajaran, k.kapasitas, u.nama";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['kode_kelas' => $kode_kelas]);
    $kelas = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$kelas) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Kode kelas tidak ditemukan. Periksa kembali kode kelas Anda.']);
        exit;
    }
    
    $id_kelas = (int) $kelas['id_kelas'];
    $kapasitas = (int) $kelas['kapasitas'];
    $jumlah_mahasiswa = (int) $kelas['jumlah_mahasiswa'];
    
    // 5. Cek duplicate (mahasiswa sudah join atau belum)
    $sql_check = "SELECT COUNT(*) FROM kelas_mahasiswa 
                  WHERE id_kelas = :id_kelas AND id_mahasiswa = :id_mahasiswa";
    
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([
        'id_kelas' => $id_kelas,
        'id_mahasiswa' => $id_mahasiswa
    ]);
    
    if ($stmt_check->fetchColumn() > 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Anda sudah terdaftar di kelas ini.']);
        exit;
    }
    
    // 6. Cek kapasitas kelas
    if ($jumlah_mahasiswa >= $kapasitas) {
        http_response_code(400);
        echo json_encode([
            'success' => false, 
            'message' => 'Kelas sudah penuh. Kapasitas maksimal: ' . $kapasitas . ' mahasiswa.'
        ]);
        exit;
    }
    
    // 7. Insert ke kelas_mahasiswa
    $sql_insert = "INSERT INTO kelas_mahasiswa (id_kelas, id_mahasiswa) 
                   VALUES (:id_kelas, :id_mahasiswa)";
    
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->execute([
        'id_kelas' => $id_kelas,
        'id_mahasiswa' => $id_mahasiswa
    ]);
    
    // 8. Return JSON success
    echo json_encode([
        'success' => true,
        'message' => 'Berhasil join kelas!',
        'data' => [
            'id_kelas' => $id_kelas,
            'nama_matakuliah' => $kelas['nama_matakuliah'],
            'kode_matakuliah' => $kelas['kode_matakuliah'],
            'semester' => $kelas['semester'],
            'tahun_ajaran' => $kelas['tahun_ajaran'],
            'nama_dosen' => $kelas['nama_dosen'],
            'kode_kelas' => $kode_kelas,
            'jumlah_mahasiswa' => $jumlah_mahasiswa + 1,
            'kapasitas' => $kapasitas,
            'joined_at' => date('Y-m-d H:i:s')
        ]
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
