<?php
/**
 * FITUR 9: DASHBOARD & STATISTIK - PROGRESS MAHASISWA
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Get progress mahasiswa per kelas
 * - Hitung progress per kelas
 * - Materi accessed / total
 * - Tugas completed / total
 * - Rata-rata nilai
 * 
 * Requirement Implementation Checklist:
 *   ✓ Cek session mahasiswa - Validasi user sudah login & role = mahasiswa
 *   ✓ Validasi input GET (id_kelas) - Parameter wajib & numeric
 *   ✓ Cek mahasiswa sudah join kelas - Query kelas_mahasiswa untuk verifikasi enrollment
 *     - Return 403 jika belum join kelas
 *   ✓ Count total materi vs materi accessed
 *     - Total: COUNT(*) FROM materi WHERE id_kelas
 *     - Accessed: COUNT(DISTINCT id_materi) FROM log_akses_materi WHERE id_mahasiswa & id_kelas
 *     - Calculate progress_materi_percent: (accessed / total) * 100
 *   ✓ Count total tugas vs tugas submitted
 *     - Total: COUNT(*) FROM tugas WHERE id_kelas
 *     - Submitted: COUNT(DISTINCT id_tugas) FROM submission_tugas WHERE id_mahasiswa
 *     - Calculate progress_tugas_percent: (submitted / total) * 100
 *   ✓ Count tugas graded vs belum graded
 *     - Graded: COUNT(*) FROM nilai JOIN submission_tugas WHERE id_mahasiswa
 *     - Pending: submitted - graded
 *   ✓ Calculate AVG nilai di kelas ini
 *     - AVG(nilai) FROM nilai JOIN submission_tugas WHERE id_mahasiswa & id_kelas
 *   ✓ Query detail tugas dengan submission status
 *     - List tugas + status (submitted/not submitted) + nilai jika ada
 *   ✓ Query detail materi dengan access status
 *     - List materi + akses terakhir (accessed_at)
 *   ✓ Return JSON progress lengkap
 *     - Overview: progress_percent, materi_stats, tugas_stats, avg_nilai
 *     - Detail tugas & materi dengan status
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
    $sql_kelas = "SELECT id_kelas, nama_matakuliah, kode_kelas FROM kelas WHERE id_kelas = :id_kelas";
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
    
    // 4. Count total materi vs materi accessed
    $sql_total_materi = "SELECT COUNT(*) as total FROM materi WHERE id_kelas = :id_kelas";
    $stmt_total_materi = $pdo->prepare($sql_total_materi);
    $stmt_total_materi->execute(['id_kelas' => $id_kelas]);
    $total_materi = (int) $stmt_total_materi->fetchColumn();
    
    $sql_accessed_materi = "SELECT COUNT(DISTINCT lam.id_materi) as total
                            FROM log_akses_materi lam
                            JOIN materi m ON lam.id_materi = m.id_materi
                            WHERE lam.id_mahasiswa = :id_mahasiswa AND m.id_kelas = :id_kelas";
    $stmt_accessed_materi = $pdo->prepare($sql_accessed_materi);
    $stmt_accessed_materi->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
    $materi_accessed = (int) $stmt_accessed_materi->fetchColumn();
    
    $progress_materi_percent = $total_materi > 0 ? round(($materi_accessed / $total_materi) * 100, 2) : 0;
    
    // 5. Count total tugas vs tugas submitted
    $sql_total_tugas = "SELECT COUNT(*) as total FROM tugas WHERE id_kelas = :id_kelas";
    $stmt_total_tugas = $pdo->prepare($sql_total_tugas);
    $stmt_total_tugas->execute(['id_kelas' => $id_kelas]);
    $total_tugas = (int) $stmt_total_tugas->fetchColumn();
    
    $sql_submitted_tugas = "SELECT COUNT(DISTINCT s.id_tugas) as total
                            FROM submission_tugas s
                            JOIN tugas t ON s.id_tugas = t.id_tugas
                            WHERE s.id_mahasiswa = :id_mahasiswa AND t.id_kelas = :id_kelas";
    $stmt_submitted_tugas = $pdo->prepare($sql_submitted_tugas);
    $stmt_submitted_tugas->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
    $tugas_submitted = (int) $stmt_submitted_tugas->fetchColumn();
    
    $progress_tugas_percent = $total_tugas > 0 ? round(($tugas_submitted / $total_tugas) * 100, 2) : 0;
    
    // 6. Count tugas graded
    $sql_graded = "SELECT COUNT(DISTINCT n.id_submission) as total
                   FROM nilai n
                   JOIN submission_tugas s ON n.id_submission = s.id_submission
                   JOIN tugas t ON s.id_tugas = t.id_tugas
                   WHERE s.id_mahasiswa = :id_mahasiswa AND t.id_kelas = :id_kelas";
    $stmt_graded = $pdo->prepare($sql_graded);
    $stmt_graded->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
    $tugas_graded = (int) $stmt_graded->fetchColumn();
    
    $tugas_pending_grade = $tugas_submitted - $tugas_graded;
    
    // 7. Calculate AVG nilai di kelas ini
    $sql_avg_nilai = "SELECT ROUND(AVG(n.nilai), 2) as avg_nilai
                      FROM nilai n
                      JOIN submission_tugas s ON n.id_submission = s.id_submission
                      JOIN tugas t ON s.id_tugas = t.id_tugas
                      WHERE s.id_mahasiswa = :id_mahasiswa AND t.id_kelas = :id_kelas";
    $stmt_avg_nilai = $pdo->prepare($sql_avg_nilai);
    $stmt_avg_nilai->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
    $avg_nilai = $stmt_avg_nilai->fetchColumn();
    $avg_nilai = $avg_nilai ? (float) $avg_nilai : null;
    
    // 8. Query detail tugas dengan submission status
    $sql_tugas_detail = "SELECT 
                            t.id_tugas,
                            t.judul,
                            t.deadline,
                            t.bobot,
                            s.id_submission,
                            s.status,
                            s.submitted_at,
                            n.id_nilai,
                            n.nilai,
                            n.graded_at
                        FROM tugas t
                        LEFT JOIN submission_tugas s ON t.id_tugas = s.id_tugas AND s.id_mahasiswa = :id_mahasiswa
                        LEFT JOIN nilai n ON s.id_submission = n.id_submission
                        WHERE t.id_kelas = :id_kelas
                        ORDER BY t.deadline ASC";
    
    $stmt_tugas_detail = $pdo->prepare($sql_tugas_detail);
    $stmt_tugas_detail->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
    $tugas_detail = $stmt_tugas_detail->fetchAll(PDO::FETCH_ASSOC);
    
    // Format tugas detail
    $tugas_formatted = [];
    foreach ($tugas_detail as $t) {
        $now_time = time();
        $deadline_time = strtotime($t['deadline']);
        $deadline_status = $now_time > $deadline_time ? 'overdue' : 'active';
        
        $tugas_formatted[] = [
            'id_tugas' => (int) $t['id_tugas'],
            'judul' => $t['judul'],
            'deadline' => $t['deadline'],
            'deadline_status' => $deadline_status,
            'bobot' => $t['bobot'],
            'submission_status' => $t['id_submission'] ? $t['status'] : 'not_submitted',
            'submitted_at' => $t['submitted_at'],
            'has_grade' => !empty($t['id_nilai']),
            'nilai' => $t['nilai'] ? (float) $t['nilai'] : null,
            'graded_at' => $t['graded_at']
        ];
    }
    
    // 9. Query detail materi dengan access status
    $sql_materi_detail = "SELECT 
                            m.id_materi,
                            m.judul,
                            m.tipe,
                            m.pertemuan_ke,
                            m.uploaded_at,
                            lam.accessed_at,
                            CASE WHEN lam.id_log IS NOT NULL THEN 1 ELSE 0 END as is_accessed
                        FROM materi m
                        LEFT JOIN (
                            SELECT id_materi, id_mahasiswa, MAX(accessed_at) as accessed_at, MAX(id_log) as id_log
                            FROM log_akses_materi
                            WHERE id_mahasiswa = :id_mahasiswa
                            GROUP BY id_materi, id_mahasiswa
                        ) lam ON m.id_materi = lam.id_materi
                        WHERE m.id_kelas = :id_kelas
                        ORDER BY m.pertemuan_ke ASC, m.uploaded_at ASC";
    
    $stmt_materi_detail = $pdo->prepare($sql_materi_detail);
    $stmt_materi_detail->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
    $materi_detail = $stmt_materi_detail->fetchAll(PDO::FETCH_ASSOC);
    
    // Format materi detail
    $materi_formatted = [];
    foreach ($materi_detail as $m) {
        $materi_formatted[] = [
            'id_materi' => (int) $m['id_materi'],
            'judul' => $m['judul'],
            'tipe' => $m['tipe'],
            'pertemuan_ke' => (int) $m['pertemuan_ke'],
            'uploaded_at' => $m['uploaded_at'],
            'is_accessed' => (bool) $m['is_accessed'],
            'accessed_at' => $m['accessed_at']
        ];
    }
    
    // 10. Calculate overall progress
    $overall_progress = 0;
    if ($total_materi > 0 && $total_tugas > 0) {
        $overall_progress = round((($materi_accessed + $tugas_submitted) / ($total_materi + $total_tugas)) * 100, 2);
    }
    
    // 11. Return JSON progress
    echo json_encode([
        'success' => true,
        'message' => 'Berhasil mengambil progress mahasiswa.',
        'data' => [
            'kelas_info' => [
                'id_kelas' => $id_kelas,
                'nama_matakuliah' => $kelas['nama_matakuliah'],
                'kode_kelas' => $kelas['kode_kelas']
            ],
            'overview' => [
                'overall_progress_percent' => $overall_progress,
                'avg_nilai' => $avg_nilai
            ],
            'materi_progress' => [
                'total_materi' => $total_materi,
                'materi_accessed' => $materi_accessed,
                'progress_percent' => $progress_materi_percent
            ],
            'tugas_progress' => [
                'total_tugas' => $total_tugas,
                'tugas_submitted' => $tugas_submitted,
                'tugas_graded' => $tugas_graded,
                'tugas_pending_grade' => $tugas_pending_grade,
                'progress_percent' => $progress_tugas_percent
            ],
            'tugas_detail' => $tugas_formatted,
            'materi_detail' => $materi_formatted
        ]
    ], JSON_UNESCAPED_UNICODE);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan saat mengambil progress mahasiswa: ' . $e->getMessage()
    ]);
}
?>
