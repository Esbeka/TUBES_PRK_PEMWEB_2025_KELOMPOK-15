<?php
/**
 * FITUR 5: JOIN KELAS - PREVIEW
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Preview info kelas sebelum join
 * - Get info kelas by kode untuk preview sebelum join
 * - Cek status enrollment mahasiswa (jika sudah login)
 * - Informasi kapasitas dan slot tersedia
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';

$response = ['success' => false, 'message' => '', 'data' => null];

try {
    // 1. Validasi input GET
    if (empty($_GET['kode_kelas'])) {
        throw new Exception('Kode kelas harus diberikan');
    }

    $kode_kelas = strtoupper(trim($_GET['kode_kelas']));

    // Validasi format kode kelas (4-10 karakter alphanumeric)
    if (!preg_match('/^[A-Z0-9]{4,10}$/', $kode_kelas)) {
        throw new Exception('Format kode kelas tidak valid');
    }

    // 2. Query kelas by kode_kelas
    // 3. Join dengan users untuk nama dosen
    $query = "SELECT 
        k.id_kelas, k.nama_matakuliah, k.kode_matakuliah, k.kode_kelas,
        k.semester, k.tahun_ajaran, k.deskripsi, k.kapasitas, k.created_at,
        u.id_user as id_dosen, u.nama as nama_dosen, u.email as email_dosen
    FROM kelas k
    JOIN users u ON k.id_dosen = u.id_user
    WHERE k.kode_kelas = ?";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([$kode_kelas]);
    $kelas = $stmt->fetch();
    
    if (!$kelas) {
        throw new Exception('Kelas tidak ditemukan');
    }

    // 4. Hitung jumlah mahasiswa saat ini
    $count_query = "SELECT COUNT(id_mahasiswa) as jumlah_mahasiswa FROM kelas_mahasiswa WHERE id_kelas = ?";
    $stmt = $pdo->prepare($count_query);
    $stmt->execute([$kelas['id_kelas']]);
    $count_result = $stmt->fetch();
    $jumlah_mahasiswa = $count_result['jumlah_mahasiswa'];

    // 5. Cek apakah mahasiswa sudah terdaftar (jika sudah login)
    $sudah_terdaftar = false;
    if (isset($_SESSION['id_user']) && isset($_SESSION['role']) && $_SESSION['role'] === 'mahasiswa') {
        $check_query = "SELECT COUNT(*) as enrolled FROM kelas_mahasiswa WHERE id_kelas = ? AND id_mahasiswa = ?";
        $stmt = $pdo->prepare($check_query);
        $stmt->execute([$kelas['id_kelas'], $_SESSION['id_user']]);
        $check_result = $stmt->fetch();
        $sudah_terdaftar = $check_result['enrolled'] > 0;
    }

    // 6. Return JSON info kelas
    $response['success'] = true;
    $response['message'] = 'Preview kelas berhasil diambil';
    $response['data'] = [
        'id_kelas' => intval($kelas['id_kelas']),
        'nama_matakuliah' => $kelas['nama_matakuliah'],
        'kode_matakuliah' => $kelas['kode_matakuliah'],
        'kode_kelas' => $kelas['kode_kelas'],
        'semester' => $kelas['semester'],
        'tahun_ajaran' => $kelas['tahun_ajaran'],
        'deskripsi' => $kelas['deskripsi'],
        'kapasitas' => intval($kelas['kapasitas']),
        'jumlah_mahasiswa' => intval($jumlah_mahasiswa),
        'sisa_slot' => intval($kelas['kapasitas']) - intval($jumlah_mahasiswa),
        'is_full' => intval($jumlah_mahasiswa) >= intval($kelas['kapasitas']),
        'sudah_terdaftar' => $sudah_terdaftar,
        'dosen' => [
            'id_dosen' => intval($kelas['id_dosen']),
            'nama' => $kelas['nama_dosen'],
            'email' => $kelas['email_dosen']
        ],
        'created_at' => $kelas['created_at']
    ];

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
