<?php
/**
 * FITUR 2: MANAJEMEN KELAS - GET DETAIL
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Get info lengkap kelas dengan statistik
 * - Get info kelas
 * - Get list mahasiswa, materi, tugas
 * - Hitung statistik
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => '', 'data' => null];

try {
    requireLogin();
    if (empty($_GET['id_kelas'])) {
        throw new Exception('id_kelas harus diberikan');
    }

    $id_kelas = intval($_GET['id_kelas']);
    $user_id = getUserId();
    $user_role = getUserRole();

    // Query info kelas lengkap dengan nama dosen
    $kelas_query = "SELECT k.id_kelas, k.id_dosen, k.nama_matakuliah, k.kode_matakuliah, 
        k.kode_kelas, k.semester, k.tahun_ajaran, k.deskripsi, k.kapasitas, k.created_at,
        u.nama as nama_dosen, u.email as email_dosen FROM kelas k
        JOIN users u ON k.id_dosen = u.id_user WHERE k.id_kelas = ?";
    
    $stmt = $pdo->prepare($kelas_query);
    $stmt->execute([$id_kelas]);
    $kelas = $stmt->fetch();
    
    if (!$kelas) {
        throw new Exception('Kelas tidak ditemukan');
    }

    // Validasi akses: hanya dosen pembuat atau mahasiswa yang sudah join
    $has_access = false;
    if ($user_role === 'dosen' && $kelas['id_dosen'] == $user_id) {
        $has_access = true;
    } else if ($user_role === 'mahasiswa') {
        $check_join = "SELECT id FROM kelas_mahasiswa WHERE id_kelas = ? AND id_mahasiswa = ?";
        $stmt = $pdo->prepare($check_join);
        $stmt->execute([$id_kelas, $user_id]);
        if ($stmt->rowCount() > 0) {
            $has_access = true;
        }
    }
    
    if (!$has_access) {
        throw new Exception('Anda tidak memiliki akses ke kelas ini');
    }

    // Query list mahasiswa yang join
    $mahasiswa_query = "SELECT u.id_user, u.nama, u.email, u.npm_nidn, km.joined_at
        FROM kelas_mahasiswa km JOIN users u ON km.id_mahasiswa = u.id_user
        WHERE km.id_kelas = ? ORDER BY km.joined_at DESC";
    $stmt = $pdo->prepare($mahasiswa_query);
    $stmt->execute([$id_kelas]);
    $mahasiswa_list = $stmt->fetchAll();

    // Query list materi
    $materi_query = "SELECT id_materi, judul, tipe, pertemuan_ke, uploaded_at
        FROM materi WHERE id_kelas = ? ORDER BY pertemuan_ke ASC";
    $stmt = $pdo->prepare($materi_query);
    $stmt->execute([$id_kelas]);
    $materi_list = $stmt->fetchAll();

    // Query list tugas
    $tugas_query = "SELECT id_tugas, judul, deadline, created_at FROM tugas
        WHERE id_kelas = ? ORDER BY deadline ASC";
    $stmt = $pdo->prepare($tugas_query);
    $stmt->execute([$id_kelas]);
    $tugas_list = $stmt->fetchAll();

    // Build response
    $response['success'] = true;
    $response['message'] = 'Detail kelas berhasil diambil';
    $response['data'] = [
        'kelas' => [
            'id_kelas' => intval($kelas['id_kelas']),
            'nama_matakuliah' => $kelas['nama_matakuliah'],
            'kode_matakuliah' => $kelas['kode_matakuliah'],
            'kode_kelas' => $kelas['kode_kelas'],
            'semester' => $kelas['semester'],
            'tahun_ajaran' => $kelas['tahun_ajaran'],
            'deskripsi' => $kelas['deskripsi'],
            'kapasitas' => intval($kelas['kapasitas']),
            'dosen' => [
                'id_dosen' => intval($kelas['id_dosen']),
                'nama' => $kelas['nama_dosen'],
                'email' => $kelas['email_dosen']
            ],
            'created_at' => $kelas['created_at']
        ],
        'statistik' => [
            'jumlah_mahasiswa' => count($mahasiswa_list),
            'jumlah_materi' => count($materi_list),
            'jumlah_tugas' => count($tugas_list)
        ],
        'mahasiswa' => $mahasiswa_list,
        'materi' => $materi_list,
        'tugas' => $tugas_list
    ];

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
