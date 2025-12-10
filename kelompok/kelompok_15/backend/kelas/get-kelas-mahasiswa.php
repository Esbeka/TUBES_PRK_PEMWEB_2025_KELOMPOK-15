<?php
/**
 * FITUR 5: JOIN KELAS - GET KELAS MAHASISWA
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Get semua kelas yang diikuti mahasiswa
 * - Query kelas yang diikuti mahasiswa
 * - Join untuk info dosen
 * - Hitung progress (materi diakses, tugas submitted)
 * 
 * Requirement Implementation Checklist:
 *   ✓ Query kelas yang diikuti mahasiswa
 *     - JOIN kelas_mahasiswa WHERE id_mahasiswa
 *     - Get semua kelas detail (nama, kode, semester, tahun ajaran, deskripsi)
 *   ✓ Join untuk info dosen
 *     - LEFT JOIN users untuk nama_dosen & email_dosen
 *     - Include id_dosen relationship
 *   ✓ Hitung progress per kelas
 *     - Total materi vs materi yang diakses (dari log_akses_materi)
 *     - Persentase progress materi: (accessed / total) * 100
 *     - Total tugas vs tugas submitted (dari submission_tugas)
 *     - Persentase progress tugas: (submitted / total) * 100
 *   ✓ Hitung jumlah mahasiswa per kelas
 *     - COUNT(DISTINCT km.id_mahasiswa) per kelas
 *   ✓ Order by created_at DESC
 *     - Kelas terbaru di atas untuk UX lebih baik
 *   ✓ Return JSON array kelas
 *     - Format lengkap dengan progress tracking
 *     - Total count kelas yang diikuti
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

try {
    // 2 & 3. Query kelas yang diikuti mahasiswa + info dosen + hitung jumlah mahasiswa
    $sql = "SELECT 
                k.id_kelas,
                k.nama_matakuliah,
                k.kode_matakuliah,
                k.semester,
                k.tahun_ajaran,
                k.deskripsi,
                k.kode_kelas,
                k.kapasitas,
                k.created_at,
                u.nama AS nama_dosen,
                u.email AS email_dosen,
                km.joined_at,
                COUNT(DISTINCT km_all.id_mahasiswa) AS jumlah_mahasiswa
            FROM kelas k
            JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
            LEFT JOIN users u ON k.id_dosen = u.id_user
            LEFT JOIN kelas_mahasiswa km_all ON k.id_kelas = km_all.id_kelas
            WHERE km.id_mahasiswa = :id_mahasiswa
            GROUP BY k.id_kelas, k.nama_matakuliah, k.kode_matakuliah, k.semester, 
                     k.tahun_ajaran, k.deskripsi, k.kode_kelas, k.kapasitas, k.created_at,
                     u.nama, u.email, km.joined_at
            ORDER BY k.created_at DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_mahasiswa' => $id_mahasiswa]);
    $kelas_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $result = [];
    
    // 4. Hitung progress tugas dan materi per kelas
    $sql_total_materi = $pdo->prepare("SELECT COUNT(*) FROM materi WHERE id_kelas = :id_kelas");
    $sql_accessed_materi = $pdo->prepare(
        "SELECT COUNT(DISTINCT lam.id_materi) 
         FROM log_akses_materi lam 
         JOIN materi m ON lam.id_materi = m.id_materi 
         WHERE lam.id_mahasiswa = :id_mahasiswa AND m.id_kelas = :id_kelas"
    );
    $sql_total_tugas = $pdo->prepare("SELECT COUNT(*) FROM tugas WHERE id_kelas = :id_kelas");
    $sql_submitted_tugas = $pdo->prepare(
        "SELECT COUNT(DISTINCT s.id_tugas) 
         FROM submission_tugas s 
         JOIN tugas t ON s.id_tugas = t.id_tugas 
         WHERE s.id_mahasiswa = :id_mahasiswa AND t.id_kelas = :id_kelas"
    );
    
    foreach ($kelas_rows as $k) {
        $id_kelas = (int) $k['id_kelas'];
        
        // Hitung total materi
        $sql_total_materi->execute(['id_kelas' => $id_kelas]);
        $total_materi = (int) $sql_total_materi->fetchColumn();
        
        // Hitung materi yang sudah diakses
        $sql_accessed_materi->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
        $accessed_materi = (int) $sql_accessed_materi->fetchColumn();
        
        // Hitung total tugas
        $sql_total_tugas->execute(['id_kelas' => $id_kelas]);
        $total_tugas = (int) $sql_total_tugas->fetchColumn();
        
        // Hitung tugas yang sudah disubmit
        $sql_submitted_tugas->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
        $submitted_tugas = (int) $sql_submitted_tugas->fetchColumn();
        
        // Hitung persentase progress
        $progress_materi = $total_materi > 0 ? round(($accessed_materi / $total_materi) * 100, 2) : 0;
        $progress_tugas = $total_tugas > 0 ? round(($submitted_tugas / $total_tugas) * 100, 2) : 0;
        
        $result[] = [
            'id_kelas' => $id_kelas,
            'nama_matakuliah' => $k['nama_matakuliah'],
            'kode_matakuliah' => $k['kode_matakuliah'],
            'semester' => $k['semester'],
            'tahun_ajaran' => $k['tahun_ajaran'],
            'deskripsi' => $k['deskripsi'],
            'kode_kelas' => $k['kode_kelas'],
            'kapasitas' => (int) $k['kapasitas'],
            'nama_dosen' => $k['nama_dosen'] ?? null,
            'email_dosen' => $k['email_dosen'] ?? null,
            'jumlah_mahasiswa' => (int) $k['jumlah_mahasiswa'],
            'joined_at' => $k['joined_at'],
            'created_at' => $k['created_at'],
            'progress' => [
                'total_materi' => $total_materi,
                'materi_diakses' => $accessed_materi,
                'progress_materi_percent' => $progress_materi,
                'total_tugas' => $total_tugas,
                'tugas_submitted' => $submitted_tugas,
                'progress_tugas_percent' => $progress_tugas
            ]
        ];
    }
    
    // 5. Return JSON array kelas
    echo json_encode([
        'success' => true,
        'message' => 'Data kelas berhasil diambil.',
        'data' => [
            'total_kelas' => count($result),
            'kelas' => $result
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
