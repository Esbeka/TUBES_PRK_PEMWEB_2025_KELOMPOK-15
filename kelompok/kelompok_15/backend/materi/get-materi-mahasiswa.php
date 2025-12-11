<?php
/**
 * FITUR 6: AKSES MATERI - GET MATERI (MAHASISWA)
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Get materi untuk mahasiswa
 * - Cek akses: mahasiswa harus join kelas
 * - Query semua materi kelas
 * - Group by pertemuan
 * 
 * Requirement Implementation Checklist:
 *   ✓ Cek session mahasiswa - Validasi user sudah login & role = mahasiswa
 *   ✓ Validasi input GET (id_kelas) - Parameter wajib & numeric
 *   ✓ Cek mahasiswa sudah join kelas - Query kelas_mahasiswa untuk verifikasi enrollment
 *     - Return 403 jika belum join kelas
 *   ✓ Query materi WHERE id_kelas ORDER BY pertemuan_ke
 *     - Ambil semua field: id_materi, judul, deskripsi, tipe, file_path, video_url, pertemuan_ke
 *     - Group by pertemuan untuk organisasi data
 *   ✓ Return JSON array materi
 *     - Format: { pertemuan_ke: [...materi items] }
 *     - Include metadata: total_pertemuan, total_materi
 *   ✓ Error handling
 *     - 401: Unauthorized (bukan mahasiswa)
 *     - 400: Bad request (parameter tidak valid)
 *     - 403: Forbidden (mahasiswa belum join kelas)
 *     - 404: Kelas tidak ditemukan
 *     - 500: Database error
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

// 2. Validasi input GET (id_kelas)
if (!isset($_GET['id_kelas']) || !is_numeric($_GET['id_kelas'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter id_kelas wajib diisi dan harus berupa angka.']);
    exit;
}

$id_kelas = (int) $_GET['id_kelas'];

try {
    // Cek apakah kelas ada
    $sql_kelas = "SELECT id_kelas, nama_matakuliah FROM kelas WHERE id_kelas = :id_kelas";
    $stmt_kelas = $pdo->prepare($sql_kelas);
    $stmt_kelas->execute(['id_kelas' => $id_kelas]);
    $kelas = $stmt_kelas->fetch(PDO::FETCH_ASSOC);
    
    if (!$kelas) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Kelas tidak ditemukan.']);
        exit;
    }
    
    // 3. Cek mahasiswa sudah join kelas
    $sql_check = "SELECT id FROM kelas_mahasiswa WHERE id_kelas = :id_kelas AND id_mahasiswa = :id_mahasiswa";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([
        'id_kelas' => $id_kelas,
        'id_mahasiswa' => $id_mahasiswa
    ]);
    
    if (!$stmt_check->fetch(PDO::FETCH_ASSOC)) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Anda belum join kelas ini.']);
        exit;
    }
    
    // 4. Query materi WHERE id_kelas ORDER BY pertemuan_ke
    $sql_materi = "SELECT id_materi, judul, deskripsi, tipe, file_path, video_url, pertemuan_ke, uploaded_at
                   FROM materi
                   WHERE id_kelas = :id_kelas
                   ORDER BY pertemuan_ke ASC, uploaded_at DESC";
    
    $stmt_materi = $pdo->prepare($sql_materi);
    $stmt_materi->execute(['id_kelas' => $id_kelas]);
    $materi_list = $stmt_materi->fetchAll(PDO::FETCH_ASSOC);
    
    // 5. Return JSON array materi - Group by pertemuan
    $materi_grouped = [];
    $pertemuan_list = [];
    
    foreach ($materi_list as $m) {
        $pertemuan = $m['pertemuan_ke'];
        if (!isset($materi_grouped[$pertemuan])) {
            $materi_grouped[$pertemuan] = [];
            $pertemuan_list[] = $pertemuan;
        }
        
        $materi_grouped[$pertemuan][] = [
            'id_materi' => (int) $m['id_materi'],
            'judul' => $m['judul'],
            'deskripsi' => $m['deskripsi'],
            'tipe' => $m['tipe'],
            'file_path' => $m['file_path'],
            'video_url' => $m['video_url'],
            'uploaded_at' => $m['uploaded_at']
        ];
    }
    
    // Format output
    $result = [
        'success' => true,
        'message' => 'Berhasil mengambil materi kelas.',
        'data' => [
            'id_kelas' => (int) $id_kelas,
            'nama_matakuliah' => $kelas['nama_matakuliah'],
            'total_pertemuan' => count($pertemuan_list),
            'total_materi' => count($materi_list),
            'materi_by_pertemuan' => $materi_grouped,
            'materi_list' => $materi_list
        ]
    ];
    
    echo json_encode($result);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan saat mengambil data materi: ' . $e->getMessage()
    ]);
}
?>
