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
    // Cek kelas milik dosen
    $sql_check = "SELECT k.id_kelas, k.nama_matakuliah, k.kode_kelas, k.semester, k.tahun_ajaran
                  FROM kelas k
                  WHERE k.id_kelas = :id_kelas AND k.id_dosen = :id_dosen";
    
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([
        'id_kelas' => $id_kelas,
        'id_dosen' => $id_dosen
    ]);
    
    $kelas = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
    if (!$kelas) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Kelas tidak ditemukan atau bukan milik Anda.']);
        exit;
    }
    
    // Get total mahasiswa di kelas
    $sql_total_mhs = "SELECT COUNT(*) FROM kelas_mahasiswa WHERE id_kelas = :id_kelas";
    $stmt_total_mhs = $pdo->prepare($sql_total_mhs);
    $stmt_total_mhs->execute(['id_kelas' => $id_kelas]);
    $total_mahasiswa = (int) $stmt_total_mhs->fetchColumn();
    
    // 3. Query AVG(nilai) per tugas
    $sql_avg_nilai_per_tugas = "SELECT 
                                    t.id_tugas,
                                    t.judul,
                                    t.deadline,
                                    t.bobot,
                                    COUNT(DISTINCT s.id_submission) as total_submissions,
                                    COUNT(DISTINCT n.id_nilai) as total_graded,
                                    AVG(n.nilai) as avg_nilai,
                                    MAX(n.nilai) as max_nilai,
                                    MIN(n.nilai) as min_nilai
                                FROM tugas t
                                LEFT JOIN submission_tugas s ON t.id_tugas = s.id_tugas
                                LEFT JOIN nilai n ON s.id_submission = n.id_submission
                                WHERE t.id_kelas = :id_kelas
                                GROUP BY t.id_tugas, t.judul, t.deadline, t.bobot
                                ORDER BY t.deadline ASC";
    
    $stmt_avg_nilai = $pdo->prepare($sql_avg_nilai_per_tugas);
    $stmt_avg_nilai->execute(['id_kelas' => $id_kelas]);
    $tugas_stats = $stmt_avg_nilai->fetchAll(PDO::FETCH_ASSOC);
    
    // 4. Calculate submission rate per tugas
    $tugas_list = [];
    foreach ($tugas_stats as $tugas) {
        $submission_rate = $total_mahasiswa > 0 
            ? round(((int)$tugas['total_submissions'] / $total_mahasiswa) * 100, 2) 
            : 0;
        $grading_rate = (int)$tugas['total_submissions'] > 0
            ? round(((int)$tugas['total_graded'] / (int)$tugas['total_submissions']) * 100, 2)
            : 0;
        
        $tugas_list[] = [
            'id_tugas' => (int) $tugas['id_tugas'],
            'judul' => $tugas['judul'],
            'deadline' => $tugas['deadline'],
            'bobot' => (int) $tugas['bobot'],
            'total_submissions' => (int) $tugas['total_submissions'],
            'total_graded' => (int) $tugas['total_graded'],
            'submission_rate' => $submission_rate,
            'grading_rate' => $grading_rate,
            'avg_nilai' => $tugas['avg_nilai'] !== null ? round((float) $tugas['avg_nilai'], 2) : null,
            'max_nilai' => $tugas['max_nilai'] !== null ? (float) $tugas['max_nilai'] : null,
            'min_nilai' => $tugas['min_nilai'] !== null ? (float) $tugas['min_nilai'] : null
        ];
    }
    
    // 5. Count akses materi (dari log_akses_materi)
    $sql_materi_engagement = "SELECT 
                                m.id_materi,
                                m.judul,
                                m.tipe,
                                m.pertemuan_ke,
                                COUNT(DISTINCT lam.id_mahasiswa) as total_accessed,
                                COUNT(lam.id_log) as total_access_count
                              FROM materi m
                              LEFT JOIN log_akses_materi lam ON m.id_materi = lam.id_materi
                              WHERE m.id_kelas = :id_kelas
                              GROUP BY m.id_materi, m.judul, m.tipe, m.pertemuan_ke
                              ORDER BY m.pertemuan_ke ASC";
    
    $stmt_materi = $pdo->prepare($sql_materi_engagement);
    $stmt_materi->execute(['id_kelas' => $id_kelas]);
    $materi_stats = $stmt_materi->fetchAll(PDO::FETCH_ASSOC);
    
    $materi_list = [];
    foreach ($materi_stats as $materi) {
        $access_rate = $total_mahasiswa > 0
            ? round(((int)$materi['total_accessed'] / $total_mahasiswa) * 100, 2)
            : 0;
        
        $materi_list[] = [
            'id_materi' => (int) $materi['id_materi'],
            'judul' => $materi['judul'],
            'tipe' => $materi['tipe'],
            'pertemuan_ke' => (int) $materi['pertemuan_ke'],
            'total_accessed' => (int) $materi['total_accessed'],
            'total_access_count' => (int) $materi['total_access_count'],
            'access_rate' => $access_rate
        ];
    }
    
    // Calculate overall statistics
    $total_tugas = count($tugas_list);
    $total_materi = count($materi_list);
    
    $overall_avg_nilai = 0;
    $total_nilai_count = 0;
    foreach ($tugas_list as $t) {
        if ($t['avg_nilai'] !== null && $t['total_graded'] > 0) {
            $overall_avg_nilai += $t['avg_nilai'];
            $total_nilai_count++;
        }
    }
    $overall_avg_nilai = $total_nilai_count > 0 ? round($overall_avg_nilai / $total_nilai_count, 2) : null;
    
    $overall_submission_rate = 0;
    if ($total_tugas > 0 && $total_mahasiswa > 0) {
        $total_submissions = array_sum(array_column($tugas_list, 'total_submissions'));
        $overall_submission_rate = round(($total_submissions / ($total_tugas * $total_mahasiswa)) * 100, 2);
    }
    
    $overall_access_rate = 0;
    if ($total_materi > 0 && $total_mahasiswa > 0) {
        $total_accesses = array_sum(array_column($materi_list, 'total_accessed'));
        $overall_access_rate = round(($total_accesses / ($total_materi * $total_mahasiswa)) * 100, 2);
    }
    
    // 6. Return JSON statistik untuk chart
    echo json_encode([
        'success' => true,
        'message' => 'Data statistik kelas berhasil diambil.',
        'data' => [
            'kelas' => [
                'id_kelas' => $id_kelas,
                'nama_matakuliah' => $kelas['nama_matakuliah'],
                'kode_kelas' => $kelas['kode_kelas'],
                'semester' => $kelas['semester'],
                'tahun_ajaran' => $kelas['tahun_ajaran'],
                'total_mahasiswa' => $total_mahasiswa
            ],
            'overview' => [
                'total_tugas' => $total_tugas,
                'total_materi' => $total_materi,
                'overall_avg_nilai' => $overall_avg_nilai,
                'overall_submission_rate' => $overall_submission_rate,
                'overall_access_rate' => $overall_access_rate
            ],
            'tugas_statistics' => $tugas_list,
            'materi_engagement' => $materi_list,
            'chart_data' => [
                'tugas_labels' => array_column($tugas_list, 'judul'),
                'tugas_avg_nilai' => array_column($tugas_list, 'avg_nilai'),
                'tugas_submission_rate' => array_column($tugas_list, 'submission_rate'),
                'materi_labels' => array_column($materi_list, 'judul'),
                'materi_access_rate' => array_column($materi_list, 'access_rate')
            ]
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
