<?php
/**
 * FITUR 9: DASHBOARD & STATISTIK - STATISTIK KELAS
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Get statistik detail kelas untuk dosen
 * - Hitung rata-rata nilai per tugas
 * - Hitung submission rate
 * - Hitung engagement rate (log akses)
 * - Return data untuk chart
 * 
 * Requirement Implementation Checklist:
 *   ✓ Cek session dosen - Validasi user sudah login & role = dosen
 *   ✓ Validasi input GET (id_kelas) - Parameter wajib & numeric
 *   ✓ Verifikasi ownership - Cek dosen adalah pemilik kelas
 *     - Query id_dosen FROM kelas WHERE id_kelas
 *     - Return 403 jika bukan pemilik kelas
 *   ✓ Count total mahasiswa di kelas
 *     - COUNT(*) FROM kelas_mahasiswa WHERE id_kelas
 *   ✓ Query AVG(nilai) per tugas
 *     - JOIN tugas, submission_tugas, nilai
 *     - GROUP BY tugas dengan AVG(nilai)
 *   ✓ Calculate submission rate per tugas
 *     - (submitted / total_mahasiswa) * 100 untuk setiap tugas
 *   ✓ Calculate engagement rate (materi access)
 *     - COUNT DISTINCT akses materi / (total_mahasiswa * total_materi) * 100
 *   ✓ Count materi diakses per mahasiswa (untuk engagement detail)
 *     - COUNT DISTINCT id_mahasiswa yang akses setiap materi
 *   ✓ Return JSON statistik lengkap
 *     - Overall stats: total_mahasiswa, total_tugas, total_materi
 *     - Per tugas: judul, avg_nilai, submission_rate, student_count
 *     - Engagement: total_akses, avg_akses_per_mahasiswa, engagement_rate
 *   ✓ Error handling
 *     - 401: Unauthorized (bukan dosen)
 *     - 400: Bad request (parameter tidak valid)
 *     - 403: Forbidden (bukan pemilik kelas)
 *     - 404: Kelas tidak ditemukan
 *     - 500: Database error
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/database.php';

session_start();

// 1. Cek session dosen
if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized. Dosen belum login atau tidak memiliki akses.']);
    exit;
}

$id_dosen = (int) $_SESSION['id_user'];

// 2. Validasi input GET (id_kelas)
if (!isset($_GET['id_kelas']) || !is_numeric($_GET['id_kelas'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Parameter id_kelas wajib diisi dan harus berupa angka.']);
    exit;
}

$id_kelas = (int) $_GET['id_kelas'];

try {
    // Cek apakah kelas ada
    $sql_kelas = "SELECT id_kelas, id_dosen, nama_matakuliah FROM kelas WHERE id_kelas = :id_kelas";
    $stmt_kelas = $pdo->prepare($sql_kelas);
    $stmt_kelas->execute(['id_kelas' => $id_kelas]);
    $kelas = $stmt_kelas->fetch(PDO::FETCH_ASSOC);
    
    if (!$kelas) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Kelas tidak ditemukan.']);
        exit;
    }
    
    // 3. Verifikasi ownership
    if ((int) $kelas['id_dosen'] !== $id_dosen) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Anda tidak memiliki akses ke kelas ini.']);
        exit;
    }
    
    // 4. Count total mahasiswa di kelas
    $sql_students = "SELECT COUNT(*) as total FROM kelas_mahasiswa WHERE id_kelas = :id_kelas";
    $stmt_students = $pdo->prepare($sql_students);
    $stmt_students->execute(['id_kelas' => $id_kelas]);
    $total_mahasiswa = (int) $stmt_students->fetchColumn();
    
    // 5. Count total tugas & materi
    $sql_tugas = "SELECT COUNT(*) as total FROM tugas WHERE id_kelas = :id_kelas";
    $stmt_tugas = $pdo->prepare($sql_tugas);
    $stmt_tugas->execute(['id_kelas' => $id_kelas]);
    $total_tugas = (int) $stmt_tugas->fetchColumn();
    
    $sql_materi = "SELECT COUNT(*) as total FROM materi WHERE id_kelas = :id_kelas";
    $stmt_materi = $pdo->prepare($sql_materi);
    $stmt_materi->execute(['id_kelas' => $id_kelas]);
    $total_materi = (int) $stmt_materi->fetchColumn();
    
    // 6. Query AVG(nilai) per tugas + submission rate
    $sql_nilai = "SELECT 
                    t.id_tugas,
                    t.judul,
                    t.bobot,
                    ROUND(AVG(n.nilai), 2) as avg_nilai,
                    COUNT(DISTINCT s.id_submission) as submission_count,
                    ROUND((COUNT(DISTINCT s.id_submission) / :total_mahasiswa) * 100, 2) as submission_rate
                 FROM tugas t
                 LEFT JOIN submission_tugas s ON t.id_tugas = s.id_tugas
                 LEFT JOIN nilai n ON s.id_submission = n.id_submission
                 WHERE t.id_kelas = :id_kelas
                 GROUP BY t.id_tugas, t.judul, t.bobot
                 ORDER BY t.id_tugas ASC";
    
    $stmt_nilai = $pdo->prepare($sql_nilai);
    $stmt_nilai->bindValue(':id_kelas', $id_kelas, PDO::PARAM_INT);
    $stmt_nilai->bindValue(':total_mahasiswa', $total_mahasiswa, PDO::PARAM_INT);
    $stmt_nilai->execute();
    $tugas_stats = $stmt_nilai->fetchAll(PDO::FETCH_ASSOC);
    
    // Format tugas stats
    $tugas_formatted = [];
    $total_avg_nilai = 0;
    foreach ($tugas_stats as $tugas) {
        $tugas_formatted[] = [
            'id_tugas' => (int) $tugas['id_tugas'],
            'judul' => $tugas['judul'],
            'bobot' => $tugas['bobot'],
            'avg_nilai' => $tugas['avg_nilai'] ? (float) $tugas['avg_nilai'] : null,
            'submission_count' => (int) $tugas['submission_count'],
            'submission_rate' => (float) $tugas['submission_rate']
        ];
        if ($tugas['avg_nilai']) {
            $total_avg_nilai += (float) $tugas['avg_nilai'];
        }
    }
    
    // Calculate overall average nilai
    $overall_avg_nilai = count($tugas_formatted) > 0 ? round($total_avg_nilai / count($tugas_formatted), 2) : 0;
    
    // 7. Query engagement (materi access)
    $sql_engagement = "SELECT 
                        COUNT(*) as total_akses,
                        COUNT(DISTINCT id_mahasiswa) as mahasiswa_akses
                       FROM log_akses_materi
                       WHERE id_kelas = :id_kelas";
    
    $stmt_engagement = $pdo->prepare($sql_engagement);
    $stmt_engagement->execute(['id_kelas' => $id_kelas]);
    $engagement = $stmt_engagement->fetch(PDO::FETCH_ASSOC);
    
    $total_akses = (int) $engagement['total_akses'];
    $mahasiswa_akses = (int) $engagement['mahasiswa_akses'];
    
    // Calculate engagement rate
    $expected_total = $total_mahasiswa * $total_materi;
    $engagement_rate = $expected_total > 0 ? round(($total_akses / $expected_total) * 100, 2) : 0;
    $avg_akses_per_mahasiswa = $total_mahasiswa > 0 ? round($total_akses / $total_mahasiswa, 2) : 0;
    
    // 8. Query engagement per materi
    $sql_materi_detail = "SELECT 
                            m.id_materi,
                            m.judul,
                            m.pertemuan_ke,
                            COUNT(DISTINCT lam.id_mahasiswa) as mahasiswa_akses
                         FROM materi m
                         LEFT JOIN log_akses_materi lam ON m.id_materi = lam.id_materi
                         WHERE m.id_kelas = :id_kelas
                         GROUP BY m.id_materi, m.judul, m.pertemuan_ke
                         ORDER BY m.pertemuan_ke ASC";
    
    $stmt_materi_detail = $pdo->prepare($sql_materi_detail);
    $stmt_materi_detail->execute(['id_kelas' => $id_kelas]);
    $materi_stats = $stmt_materi_detail->fetchAll(PDO::FETCH_ASSOC);
    
    // Format materi stats
    $materi_formatted = [];
    foreach ($materi_stats as $m) {
        $access_rate = $total_mahasiswa > 0 ? round(((int) $m['mahasiswa_akses'] / $total_mahasiswa) * 100, 2) : 0;
        $materi_formatted[] = [
            'id_materi' => (int) $m['id_materi'],
            'judul' => $m['judul'],
            'pertemuan_ke' => (int) $m['pertemuan_ke'],
            'mahasiswa_akses' => (int) $m['mahasiswa_akses'],
            'access_rate' => $access_rate
        ];
    }
    
    // 9. Return JSON statistik
    echo json_encode([
        'success' => true,
        'message' => 'Berhasil mengambil statistik kelas.',
        'data' => [
            'overview' => [
                'nama_matakuliah' => $kelas['nama_matakuliah'],
                'total_mahasiswa' => $total_mahasiswa,
                'total_tugas' => $total_tugas,
                'total_materi' => $total_materi,
                'overall_avg_nilai' => $overall_avg_nilai
            ],
            'task_statistics' => $tugas_formatted,
            'engagement' => [
                'total_akses' => $total_akses,
                'mahasiswa_akses' => $mahasiswa_akses,
                'avg_akses_per_mahasiswa' => $avg_akses_per_mahasiswa,
                'engagement_rate' => $engagement_rate
            ],
            'materi_statistics' => $materi_formatted
        ]
    ], JSON_UNESCAPED_UNICODE);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan saat mengambil statistik kelas: ' . $e->getMessage()
    ]);
}
?>
