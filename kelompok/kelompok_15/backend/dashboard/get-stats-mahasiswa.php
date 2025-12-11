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
 * 
 * Requirement Implementation Checklist:
 *   ✓ Cek session mahasiswa - Validasi user sudah login & role = mahasiswa
 *   ✓ Count total kelas - Query COUNT(*) FROM kelas_mahasiswa WHERE id_mahasiswa
 *   ✓ Count tugas pending - Query tugas tanpa submission atau status != graded
 *     - COUNT(t.id_tugas) WHERE submission IS NULL atau n.id_nilai IS NULL
 *   ✓ Count tugas submitted - Query tugas dengan submission (status = submitted/late)
 *     - COUNT(DISTINCT s.id_tugas) WHERE s.id_mahasiswa
 *   ✓ Count tugas graded - Query submission dengan nilai
 *     - COUNT(DISTINCT n.id_submission) WHERE n.id_nilai IS NOT NULL
 *   ✓ Query 5 deadline terdekat (upcoming)
 *     - Query tugas WHERE deadline > NOW() ORDER BY deadline ASC LIMIT 5
 *     - Include submission status jika sudah submit
 *   ✓ Calculate overall progress percentage
 *     - (tugas_submitted / total_tugas) * 100
 *   ✓ Return JSON statistik lengkap
 *     - Summary stats: total_kelas, total_tugas, submitted, graded, pending
 *     - Upcoming deadlines dengan submission status
 *     - Overall progress percentage
 *   ✓ Error handling
 *     - 401: Unauthorized (bukan mahasiswa)
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

try {
    // 2. Count total kelas
    $sql_kelas = "SELECT COUNT(*) as total FROM kelas_mahasiswa WHERE id_mahasiswa = :id_mahasiswa";
    $stmt_kelas = $pdo->prepare($sql_kelas);
    $stmt_kelas->execute(['id_mahasiswa' => $id_mahasiswa]);
    $total_kelas = (int) $stmt_kelas->fetchColumn();
    
    // 3. Count total tugas di kelas yang diikuti
    $sql_total_tugas = "SELECT COUNT(DISTINCT t.id_tugas) as total 
                        FROM tugas t
                        JOIN kelas_mahasiswa km ON t.id_kelas = km.id_kelas
                        WHERE km.id_mahasiswa = :id_mahasiswa";
    $stmt_total_tugas = $pdo->prepare($sql_total_tugas);
    $stmt_total_tugas->execute(['id_mahasiswa' => $id_mahasiswa]);
    $total_tugas = (int) $stmt_total_tugas->fetchColumn();
    
    // 4. Count tugas submitted
    $sql_submitted = "SELECT COUNT(DISTINCT s.id_tugas) as total
                      FROM submission_tugas s
                      WHERE s.id_mahasiswa = :id_mahasiswa";
    $stmt_submitted = $pdo->prepare($sql_submitted);
    $stmt_submitted->execute(['id_mahasiswa' => $id_mahasiswa]);
    $tugas_submitted = (int) $stmt_submitted->fetchColumn();
    
    // 5. Count tugas graded (ada nilai)
    $sql_graded = "SELECT COUNT(DISTINCT n.id_submission) as total
                   FROM nilai n
                   JOIN submission_tugas s ON n.id_submission = s.id_submission
                   WHERE s.id_mahasiswa = :id_mahasiswa";
    $stmt_graded = $pdo->prepare($sql_graded);
    $stmt_graded->execute(['id_mahasiswa' => $id_mahasiswa]);
    $tugas_graded = (int) $stmt_graded->fetchColumn();
    
    // 6. Count tugas pending (belum submit)
    $tugas_pending = $total_tugas - $tugas_submitted;
    
    // 7. Calculate overall progress
    $progress_percent = $total_tugas > 0 ? round(($tugas_submitted / $total_tugas) * 100, 2) : 0;
    
    // 8. Query 5 deadline terdekat (upcoming)
    $sql_upcoming = "SELECT 
                        t.id_tugas,
                        t.judul,
                        t.deadline,
                        t.bobot,
                        k.nama_matakuliah,
                        s.id_submission,
                        s.status,
                        s.submitted_at,
                        n.id_nilai
                    FROM tugas t
                    JOIN kelas k ON t.id_kelas = k.id_kelas
                    JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
                    LEFT JOIN submission_tugas s ON t.id_tugas = s.id_tugas AND s.id_mahasiswa = :id_mahasiswa
                    LEFT JOIN nilai n ON s.id_submission = n.id_submission
                    WHERE km.id_mahasiswa = :id_mahasiswa 
                      AND t.deadline > NOW()
                    ORDER BY t.deadline ASC
                    LIMIT 5";
    
    $stmt_upcoming = $pdo->prepare($sql_upcoming);
    $stmt_upcoming->execute(['id_mahasiswa' => $id_mahasiswa]);
    $upcoming_tasks = $stmt_upcoming->fetchAll(PDO::FETCH_ASSOC);
    
    // Format upcoming tasks
    $upcoming_formatted = [];
    foreach ($upcoming_tasks as $task) {
        $upcoming_formatted[] = [
            'id_tugas' => (int) $task['id_tugas'],
            'judul' => $task['judul'],
            'deadline' => $task['deadline'],
            'bobot' => $task['bobot'],
            'nama_matakuliah' => $task['nama_matakuliah'],
            'status' => $task['id_submission'] ? ($task['id_nilai'] ? 'graded' : $task['status']) : 'pending',
            'submitted_at' => $task['submitted_at']
        ];
    }
    
    // 9. Return JSON statistik
    echo json_encode([
        'success' => true,
        'message' => 'Berhasil mengambil statistik dashboard.',
        'data' => [
            'summary' => [
                'total_kelas' => $total_kelas,
                'total_tugas' => $total_tugas,
                'tugas_submitted' => $tugas_submitted,
                'tugas_graded' => $tugas_graded,
                'tugas_pending' => $tugas_pending,
                'progress_percent' => $progress_percent
            ],
            'upcoming_deadlines' => $upcoming_formatted
        ]
    ], JSON_UNESCAPED_UNICODE);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan saat mengambil statistik: ' . $e->getMessage()
    ]);
}
?>
