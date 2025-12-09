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
    // Cek mahasiswa terdaftar di kelas
    $sql_check = "SELECT k.id_kelas, k.nama_matakuliah, k.kode_kelas, k.semester, k.tahun_ajaran
                  FROM kelas_mahasiswa km
                  JOIN kelas k ON km.id_kelas = k.id_kelas
                  WHERE km.id_kelas = :id_kelas AND km.id_mahasiswa = :id_mahasiswa";
    
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([
        'id_kelas' => $id_kelas,
        'id_mahasiswa' => $id_mahasiswa
    ]);
    
    $kelas = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
    if (!$kelas) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Anda tidak terdaftar di kelas ini.']);
        exit;
    }
    
    // 3. Count total materi vs materi accessed
    $sql_total_materi = "SELECT COUNT(*) FROM materi WHERE id_kelas = :id_kelas";
    $stmt_total_materi = $pdo->prepare($sql_total_materi);
    $stmt_total_materi->execute(['id_kelas' => $id_kelas]);
    $total_materi = (int) $stmt_total_materi->fetchColumn();
    
    $sql_materi_accessed = "SELECT COUNT(DISTINCT lam.id_materi)
                            FROM log_akses_materi lam
                            JOIN materi m ON lam.id_materi = m.id_materi
                            WHERE lam.id_mahasiswa = :id_mahasiswa AND m.id_kelas = :id_kelas";
    $stmt_materi_accessed = $pdo->prepare($sql_materi_accessed);
    $stmt_materi_accessed->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
    $materi_accessed = (int) $stmt_materi_accessed->fetchColumn();
    
    $progress_materi = $total_materi > 0 ? round(($materi_accessed / $total_materi) * 100, 2) : 0;
    
    // 4. Count total tugas vs tugas submitted
    $sql_total_tugas = "SELECT COUNT(*) FROM tugas WHERE id_kelas = :id_kelas";
    $stmt_total_tugas = $pdo->prepare($sql_total_tugas);
    $stmt_total_tugas->execute(['id_kelas' => $id_kelas]);
    $total_tugas = (int) $stmt_total_tugas->fetchColumn();
    
    $sql_tugas_submitted = "SELECT COUNT(DISTINCT s.id_tugas)
                            FROM submission_tugas s
                            JOIN tugas t ON s.id_tugas = t.id_tugas
                            WHERE s.id_mahasiswa = :id_mahasiswa AND t.id_kelas = :id_kelas";
    $stmt_tugas_submitted = $pdo->prepare($sql_tugas_submitted);
    $stmt_tugas_submitted->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
    $tugas_submitted = (int) $stmt_tugas_submitted->fetchColumn();
    
    $progress_tugas = $total_tugas > 0 ? round(($tugas_submitted / $total_tugas) * 100, 2) : 0;
    
    // Count tugas graded
    $sql_tugas_graded = "SELECT COUNT(DISTINCT s.id_tugas)
                         FROM submission_tugas s
                         JOIN tugas t ON s.id_tugas = t.id_tugas
                         JOIN nilai n ON s.id_submission = n.id_submission
                         WHERE s.id_mahasiswa = :id_mahasiswa AND t.id_kelas = :id_kelas";
    $stmt_tugas_graded = $pdo->prepare($sql_tugas_graded);
    $stmt_tugas_graded->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
    $tugas_graded = (int) $stmt_tugas_graded->fetchColumn();
    
    // 5. Calculate AVG nilai
    $sql_avg_nilai = "SELECT AVG(n.nilai) as avg_nilai
                      FROM nilai n
                      JOIN submission_tugas s ON n.id_submission = s.id_submission
                      JOIN tugas t ON s.id_tugas = t.id_tugas
                      WHERE s.id_mahasiswa = :id_mahasiswa AND t.id_kelas = :id_kelas";
    $stmt_avg_nilai = $pdo->prepare($sql_avg_nilai);
    $stmt_avg_nilai->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
    $result_avg = $stmt_avg_nilai->fetch(PDO::FETCH_ASSOC);
    $avg_nilai = $result_avg['avg_nilai'] !== null ? round((float) $result_avg['avg_nilai'], 2) : null;
    
    // Get detail tugas
    $sql_tugas_detail = "SELECT 
                            t.id_tugas,
                            t.judul,
                            t.deadline,
                            t.bobot,
                            s.id_submission,
                            s.status,
                            s.submitted_at,
                            n.nilai,
                            n.feedback,
                            n.graded_at
                         FROM tugas t
                         LEFT JOIN submission_tugas s ON t.id_tugas = s.id_tugas AND s.id_mahasiswa = :id_mahasiswa
                         LEFT JOIN nilai n ON s.id_submission = n.id_submission
                         WHERE t.id_kelas = :id_kelas
                         ORDER BY t.deadline ASC";
    $stmt_tugas_detail = $pdo->prepare($sql_tugas_detail);
    $stmt_tugas_detail->execute(['id_mahasiswa' => $id_mahasiswa, 'id_kelas' => $id_kelas]);
    $tugas_detail = $stmt_tugas_detail->fetchAll(PDO::FETCH_ASSOC);
    
    $tugas_list = array_map(function($t) {
        return [
            'id_tugas' => (int) $t['id_tugas'],
            'judul' => $t['judul'],
            'deadline' => $t['deadline'],
            'bobot' => (int) $t['bobot'],
            'is_submitted' => $t['id_submission'] !== null,
            'status' => $t['status'],
            'submitted_at' => $t['submitted_at'],
            'is_graded' => $t['nilai'] !== null,
            'nilai' => $t['nilai'] !== null ? (float) $t['nilai'] : null,
            'feedback' => $t['feedback'],
            'graded_at' => $t['graded_at']
        ];
    }, $tugas_detail);
    
    // 6. Return JSON progress
    echo json_encode([
        'success' => true,
        'message' => 'Data progress berhasil diambil.',
        'data' => [
            'kelas' => [
                'id_kelas' => $id_kelas,
                'nama_matakuliah' => $kelas['nama_matakuliah'],
                'kode_kelas' => $kelas['kode_kelas'],
                'semester' => $kelas['semester'],
                'tahun_ajaran' => $kelas['tahun_ajaran']
            ],
            'progress_materi' => [
                'total' => $total_materi,
                'accessed' => $materi_accessed,
                'percentage' => $progress_materi
            ],
            'progress_tugas' => [
                'total' => $total_tugas,
                'submitted' => $tugas_submitted,
                'graded' => $tugas_graded,
                'percentage' => $progress_tugas
            ],
            'nilai' => [
                'average' => $avg_nilai,
                'total_graded' => $tugas_graded
            ],
            'tugas_list' => $tugas_list
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
