<?php
/**
 * ENDPOINT: SEARCH & FILTER KELAS
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Search dan filter kelas dengan pagination
 * - Query dengan LIKE untuk pencarian nama matakuliah
 * - Filter by semester dan tahun ajaran
 * - Sort by column (nama, id_dosen, kapasitas, created_at)
 * - Return: array kelas dengan pagination info
 * 
 * TODO:
 * [✓] Session validation - pastikan user login
 * [✓] Query preparation - gunakan prepared statement
 * [✓] Search by nama_matakuliah dengan LIKE
 * [✓] Filter by semester (1-8) dan tahun_ajaran (YYYY)
 * [✓] Sort by column - nama_matakuliah, id_dosen, kapasitas, created_at
 * [✓] Pagination - limit dan offset
 * [✓] Count total hasil - untuk pagination info
 * [✓] Return response JSON dengan data dan pagination
 */

session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => '', 'data' => null, 'pagination' => null];

try {
    // 1. Session validation
    requireLogin();
    $id_user = $_SESSION['id_user'];
    $role = $_SESSION['role'];

    // 2. Get parameters dari request
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $semester = isset($_GET['semester']) ? intval($_GET['semester']) : null;
    $tahun_ajaran = isset($_GET['tahun_ajaran']) ? trim($_GET['tahun_ajaran']) : null;
    $sort_by = isset($_GET['sort_by']) ? trim($_GET['sort_by']) : 'created_at';
    $sort_order = isset($_GET['sort_order']) ? strtoupper(trim($_GET['sort_order'])) : 'DESC';
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

    // Validasi pagination
    $page = max(1, $page);
    $limit = max(1, min(100, $limit)); // Max 100 items per page
    $offset = ($page - 1) * $limit;

    // Validasi sort_by (whitelist)
    $allowed_sort = ['nama_matakuliah', 'id_dosen', 'kapasitas', 'created_at'];
    if (!in_array($sort_by, $allowed_sort)) {
        $sort_by = 'created_at';
    }

    // Validasi sort_order (ASC atau DESC)
    if (!in_array($sort_order, ['ASC', 'DESC'])) {
        $sort_order = 'DESC';
    }

    // 3. Build query dengan kondisi
    $where_conditions = [];
    $bind_params = [];

    // Search by nama_matakuliah
    if (!empty($search)) {
        $where_conditions[] = "k.nama_matakuliah LIKE ?";
        $bind_params[] = '%' . $search . '%';
    }

    // Filter by semester
    if ($semester !== null && $semester >= 1 && $semester <= 8) {
        $where_conditions[] = "k.semester = ?";
        $bind_params[] = $semester;
    }

    // Filter by tahun_ajaran
    if (!empty($tahun_ajaran) && preg_match('/^\d{4}$/', $tahun_ajaran)) {
        $where_conditions[] = "k.tahun_ajaran = ?";
        $bind_params[] = $tahun_ajaran;
    }

    // Base query
    $where_clause = empty($where_conditions) ? "1=1" : implode(" AND ", $where_conditions);

    // Query untuk count total
    $count_query = "SELECT COUNT(k.id_kelas) as total FROM kelas k WHERE " . $where_clause;
    $stmt_count = $pdo->prepare($count_query);
    $stmt_count->execute($bind_params);
    $total_records = intval($stmt_count->fetch()['total']);
    $total_pages = ceil($total_records / $limit);

    // 4. Query data dengan pagination dan sort
    $query = "SELECT 
                k.id_kelas,
                k.id_dosen,
                k.nama_matakuliah,
                k.kode_kelas,
                k.kapasitas,
                k.semester,
                k.tahun_ajaran,
                k.created_at,
                u.nama as nama_dosen,
                COUNT(DISTINCT km.id_mahasiswa) as jumlah_mahasiswa,
                COUNT(DISTINCT m.id_materi) as jumlah_materi,
                COUNT(DISTINCT t.id_tugas) as jumlah_tugas
              FROM kelas k
              LEFT JOIN users u ON k.id_dosen = u.id_user
              LEFT JOIN kelas_mahasiswa km ON k.id_kelas = km.id_kelas
              LEFT JOIN materi m ON k.id_kelas = m.id_kelas
              LEFT JOIN tugas t ON k.id_kelas = t.id_kelas
              WHERE " . $where_clause . "
              GROUP BY k.id_kelas
              ORDER BY k." . $sort_by . " " . $sort_order . "
              LIMIT ? OFFSET ?";

    $stmt = $pdo->prepare($query);
    
    // Bind search/filter params
    foreach ($bind_params as $key => $value) {
        $stmt->bindValue($key + 1, $value);
    }
    
    // Bind pagination params
    $stmt->bindValue(count($bind_params) + 1, $limit, PDO::PARAM_INT);
    $stmt->bindValue(count($bind_params) + 2, $offset, PDO::PARAM_INT);
    
    $stmt->execute();
    $kelas_list = $stmt->fetchAll();

    // 5. Format response
    $response['success'] = true;
    $response['message'] = 'Search kelas berhasil';
    $response['data'] = [
        'search_params' => [
            'search' => $search,
            'semester' => $semester,
            'tahun_ajaran' => $tahun_ajaran,
            'sort_by' => $sort_by,
            'sort_order' => $sort_order
        ],
        'kelas' => $kelas_list
    ];
    $response['pagination'] = [
        'page' => $page,
        'limit' => $limit,
        'total_records' => $total_records,
        'total_pages' => $total_pages,
        'has_next' => $page < $total_pages,
        'has_prev' => $page > 1
    ];

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
