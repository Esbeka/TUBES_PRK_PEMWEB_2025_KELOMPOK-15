<?php
/**
 * FITUR 9: DASHBOARD & STATISTIK - STATS MAHASISWA
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Get statistik untuk dashboard mahasiswa
 * - Hitung total kelas diikuti
 * - Hitung tugas pending (belum submit)
 * - Hitung tugas graded
 * - Query 5 deadline terdekat
 * - Query recent activities
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
    // 2. Count kelas from kelas_mahasiswa
    $sql_count_kelas = "SELECT COUNT(*) FROM kelas_mahasiswa WHERE id_mahasiswa = :id_mahasiswa";
    $stmt_count_kelas = $pdo->prepare($sql_count_kelas);
    $stmt_count_kelas->execute(['id_mahasiswa' => $id_mahasiswa]);
    $total_kelas = (int) $stmt_count_kelas->fetchColumn();
    
    // Count total tugas dari kelas yang diikuti
    $sql_total_tugas = "SELECT COUNT(DISTINCT t.id_tugas)
                        FROM tugas t
                        JOIN kelas k ON t.id_kelas = k.id_kelas
                        JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
                        WHERE km.id_mahasiswa = :id_mahasiswa";
    $stmt_total_tugas = $pdo->prepare($sql_total_tugas);
    $stmt_total_tugas->execute(['id_mahasiswa' => $id_mahasiswa]);
    $total_tugas = (int) $stmt_total_tugas->fetchColumn();
    
    // 3. Count tugas pending (belum submit)
    $sql_tugas_pending = "SELECT COUNT(*)
                          FROM tugas t
                          JOIN kelas k ON t.id_kelas = k.id_kelas
                          JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
                          LEFT JOIN submission_tugas s ON t.id_tugas = s.id_tugas AND s.id_mahasiswa = :id_mahasiswa
                          WHERE km.id_mahasiswa = :id_mahasiswa
                          AND s.id_submission IS NULL";
    $stmt_tugas_pending = $pdo->prepare($sql_tugas_pending);
    $stmt_tugas_pending->execute(['id_mahasiswa' => $id_mahasiswa]);
    $tugas_pending = (int) $stmt_tugas_pending->fetchColumn();
    
    // Count tugas submitted
    $sql_tugas_submitted = "SELECT COUNT(DISTINCT s.id_tugas)
                           FROM submission_tugas s
                           JOIN tugas t ON s.id_tugas = t.id_tugas
                           WHERE s.id_mahasiswa = :id_mahasiswa";
    $stmt_tugas_submitted = $pdo->prepare($sql_tugas_submitted);
    $stmt_tugas_submitted->execute(['id_mahasiswa' => $id_mahasiswa]);
    $tugas_submitted = (int) $stmt_tugas_submitted->fetchColumn();
    
    // 4. Count tugas graded (submissions JOIN nilai)
    $sql_tugas_graded = "SELECT COUNT(DISTINCT s.id_submission)
                        FROM submission_tugas s
                        JOIN nilai n ON s.id_submission = n.id_submission
                        WHERE s.id_mahasiswa = :id_mahasiswa";
    $stmt_tugas_graded = $pdo->prepare($sql_tugas_graded);
    $stmt_tugas_graded->execute(['id_mahasiswa' => $id_mahasiswa]);
    $tugas_graded = (int) $stmt_tugas_graded->fetchColumn();
    
    // Count tugas ungraded (submitted tapi belum dinilai)
    $tugas_ungraded = $tugas_submitted - $tugas_graded;
    
    // Calculate average nilai
    $sql_avg_nilai = "SELECT AVG(n.nilai) as avg_nilai
                      FROM nilai n
                      JOIN submission_tugas s ON n.id_submission = s.id_submission
                      WHERE s.id_mahasiswa = :id_mahasiswa";
    $stmt_avg_nilai = $pdo->prepare($sql_avg_nilai);
    $stmt_avg_nilai->execute(['id_mahasiswa' => $id_mahasiswa]);
    $result_avg = $stmt_avg_nilai->fetch(PDO::FETCH_ASSOC);
    $avg_nilai = $result_avg['avg_nilai'] !== null ? round((float) $result_avg['avg_nilai'], 2) : null;
    
    // 5. Query 5 tugas dengan deadline terdekat (belum submit)
    $sql_upcoming_deadlines = "SELECT 
                                  t.id_tugas,
                                  t.judul,
                                  t.deadline,
                                  t.bobot,
                                  k.id_kelas,
                                  k.nama_matakuliah,
                                  k.kode_kelas,
                                  CASE 
                                      WHEN t.deadline < NOW() THEN 'overdue'
                                      WHEN t.deadline < DATE_ADD(NOW(), INTERVAL 1 DAY) THEN 'urgent'
                                      WHEN t.deadline < DATE_ADD(NOW(), INTERVAL 3 DAY) THEN 'soon'
                                      ELSE 'normal'
                                  END as urgency
                               FROM tugas t
                               JOIN kelas k ON t.id_kelas = k.id_kelas
                               JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
                               LEFT JOIN submission_tugas s ON t.id_tugas = s.id_tugas AND s.id_mahasiswa = :id_mahasiswa
                               WHERE km.id_mahasiswa = :id_mahasiswa
                               AND s.id_submission IS NULL
                               ORDER BY t.deadline ASC
                               LIMIT 5";
    $stmt_upcoming = $pdo->prepare($sql_upcoming_deadlines);
    $stmt_upcoming->execute(['id_mahasiswa' => $id_mahasiswa]);
    $upcoming_deadlines = $stmt_upcoming->fetchAll(PDO::FETCH_ASSOC);
    
    $upcoming_list = array_map(function($t) {
        return [
            'id_tugas' => (int) $t['id_tugas'],
            'judul' => $t['judul'],
            'deadline' => $t['deadline'],
            'bobot' => (int) $t['bobot'],
            'id_kelas' => (int) $t['id_kelas'],
            'nama_matakuliah' => $t['nama_matakuliah'],
            'kode_kelas' => $t['kode_kelas'],
            'urgency' => $t['urgency']
        ];
    }, $upcoming_deadlines);
    
    // Query recent activities (materi yang baru diupload)
    $sql_recent_materi = "SELECT 
                            m.id_materi,
                            m.judul,
                            m.tipe,
                            m.pertemuan_ke,
                            m.uploaded_at,
                            k.id_kelas,
                            k.nama_matakuliah,
                            k.kode_kelas
                          FROM materi m
                          JOIN kelas k ON m.id_kelas = k.id_kelas
                          JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
                          WHERE km.id_mahasiswa = :id_mahasiswa
                          ORDER BY m.uploaded_at DESC
                          LIMIT 5";
    $stmt_recent = $pdo->prepare($sql_recent_materi);
    $stmt_recent->execute(['id_mahasiswa' => $id_mahasiswa]);
    $recent_materi = $stmt_recent->fetchAll(PDO::FETCH_ASSOC);
    
    $recent_list = array_map(function($m) {
        return [
            'id_materi' => (int) $m['id_materi'],
            'judul' => $m['judul'],
            'tipe' => $m['tipe'],
            'pertemuan_ke' => (int) $m['pertemuan_ke'],
            'uploaded_at' => $m['uploaded_at'],
            'id_kelas' => (int) $m['id_kelas'],
            'nama_matakuliah' => $m['nama_matakuliah'],
            'kode_kelas' => $m['kode_kelas']
        ];
    }, $recent_materi);
    
    // Count total materi
    $sql_total_materi = "SELECT COUNT(DISTINCT m.id_materi)
                        FROM materi m
                        JOIN kelas k ON m.id_kelas = k.id_kelas
                        JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
                        WHERE km.id_mahasiswa = :id_mahasiswa";
    $stmt_total_materi = $pdo->prepare($sql_total_materi);
    $stmt_total_materi->execute(['id_mahasiswa' => $id_mahasiswa]);
    $total_materi = (int) $stmt_total_materi->fetchColumn();
    
    // Count materi accessed
    $sql_materi_accessed = "SELECT COUNT(DISTINCT lam.id_materi)
                           FROM log_akses_materi lam
                           JOIN materi m ON lam.id_materi = m.id_materi
                           JOIN kelas k ON m.id_kelas = k.id_kelas
                           JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
                           WHERE lam.id_mahasiswa = :id_mahasiswa
                           AND km.id_mahasiswa = :id_mahasiswa";
    $stmt_materi_accessed = $pdo->prepare($sql_materi_accessed);
    $stmt_materi_accessed->execute(['id_mahasiswa' => $id_mahasiswa]);
    $materi_accessed = (int) $stmt_materi_accessed->fetchColumn();
    
    // 6. Return JSON statistik
    echo json_encode([
        'success' => true,
        'message' => 'Data statistik mahasiswa berhasil diambil.',
        'data' => [
            'overview' => [
                'total_kelas' => $total_kelas,
                'total_tugas' => $total_tugas,
                'tugas_pending' => $tugas_pending,
                'tugas_submitted' => $tugas_submitted,
                'tugas_graded' => $tugas_graded,
                'tugas_ungraded' => $tugas_ungraded,
                'total_materi' => $total_materi,
                'materi_accessed' => $materi_accessed,
                'avg_nilai' => $avg_nilai
            ],
            'upcoming_deadlines' => $upcoming_list,
            'recent_materi' => $recent_list,
            'progress_summary' => [
                'tugas_completion_rate' => $total_tugas > 0 
                    ? round(($tugas_submitted / $total_tugas) * 100, 2) 
                    : 0,
                'materi_access_rate' => $total_materi > 0
                    ? round(($materi_accessed / $total_materi) * 100, 2)
                    : 0,
                'grading_completion_rate' => $tugas_submitted > 0
                    ? round(($tugas_graded / $tugas_submitted) * 100, 2)
                    : 0
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
