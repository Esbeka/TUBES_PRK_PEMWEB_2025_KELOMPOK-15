<?php
/**
 * FITUR 7: SUBMIT TUGAS - GET TUGAS (MAHASISWA)
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 *
 * Deskripsi: Get semua tugas di kelas yang diikuti mahasiswa
 * - Query tugas berdasarkan id_kelas
 * - Join info submission mahasiswa (jika ada)
 * - Hitung status deadline (active, coming_soon, overdue)
 * - Include nilai jika sudah di-grade
 * 
 * Requirement Implementation Checklist:
 *   ✓ Cek session mahasiswa - Validasi user sudah login & role = mahasiswa
 *   ✓ Validasi input GET (id_kelas) - Parameter wajib & numeric
 *   ✓ Cek mahasiswa sudah join kelas - Query kelas_mahasiswa untuk verifikasi enrollment
 *     - Return 403 jika belum join kelas
 *   ✓ Query tugas WHERE id_kelas ORDER BY deadline ASC
 *     - Ambil: id_tugas, judul, deskripsi, deadline, max_file_size, allowed_formats, bobot, created_at
 *   ✓ Per tugas, query submission mahasiswa & nilai
 *     - LEFT JOIN submission_tugas & nilai
 *     - Get file_path, status, submitted_at, attempt_count, keterangan (dari submission)
 *     - Get nilai & feedback (dari nilai, jika ada)
 *   ✓ Hitung status deadline
 *     - 'overdue': NOW() > deadline
 *     - 'active': NOW() <= deadline
 *   ✓ Return JSON array tugas
 *     - Include semua info tugas + submission status + nilai (jika ada)
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
	$sql_kelas = "SELECT id_kelas, nama_matakuliah FROM kelas WHERE id_kelas = :id_kelas";
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
	
	// 4. Query tugas WHERE id_kelas ORDER BY deadline ASC (yang urgent dulu)
	$sql_tugas = "SELECT id_tugas, judul, deskripsi, deadline, max_file_size, allowed_formats, bobot, created_at
				  FROM tugas
				  WHERE id_kelas = :id_kelas
				  ORDER BY deadline ASC";
	
	$stmt_tugas = $pdo->prepare($sql_tugas);
	$stmt_tugas->execute(['id_kelas' => $id_kelas]);
	$tugas_list = $stmt_tugas->fetchAll(PDO::FETCH_ASSOC);
	
	$result = [];
	$now_time = time();
	
	// 5. Per tugas, query submission & nilai + hitung status deadline
	foreach ($tugas_list as $t) {
		$id_tugas = (int) $t['id_tugas'];
		
		// Query submission & nilai
		$sql_submission = "SELECT 
							s.id_submission, 
							s.file_path, 
							s.status, 
							s.submitted_at, 
							s.attempt_count,
							s.keterangan,
							n.id_nilai,
							n.nilai,
							n.feedback,
							n.graded_at
						   FROM submission_tugas s
						   LEFT JOIN nilai n ON s.id_submission = n.id_submission
						   WHERE s.id_tugas = :id_tugas AND s.id_mahasiswa = :id_mahasiswa
						   LIMIT 1";
		
		$stmt_submission = $pdo->prepare($sql_submission);
		$stmt_submission->execute(['id_tugas' => $id_tugas, 'id_mahasiswa' => $id_mahasiswa]);
		$submission = $stmt_submission->fetch(PDO::FETCH_ASSOC);
		
		// Hitung status deadline dengan strtotime
		$deadline_time = strtotime($t['deadline']);
		if ($now_time > $deadline_time) {
			$deadline_status = 'overdue';
		} else {
			$deadline_status = 'active';
		}
		
		// Format data tugas
		$tugas_data = [
			'id_tugas' => $id_tugas,
			'judul' => $t['judul'],
			'deskripsi' => $t['deskripsi'],
			'deadline' => $t['deadline'],
			'max_file_size' => (int) $t['max_file_size'],
			'allowed_formats' => $t['allowed_formats'],
			'bobot' => $t['bobot'],
			'deadline_status' => $deadline_status,
			'created_at' => $t['created_at'],
			'submission' => null,
			'nilai' => null
		];
		
		// Add submission data if exists
		if ($submission && !empty($submission['id_submission'])) {
			$tugas_data['submission'] = [
				'id_submission' => (int) $submission['id_submission'],
				'file_path' => $submission['file_path'],
				'status' => $submission['status'],
				'submitted_at' => $submission['submitted_at'],
				'attempt_count' => (int) $submission['attempt_count'],
				'keterangan' => $submission['keterangan']
			];
			
			// Add nilai if exists
			if (!empty($submission['id_nilai'])) {
				$tugas_data['nilai'] = [
					'id_nilai' => (int) $submission['id_nilai'],
					'nilai' => (float) $submission['nilai'],
					'feedback' => $submission['feedback'],
					'graded_at' => $submission['graded_at']
				];
			}
		}
		
		$result[] = $tugas_data;
	}
	
	// 6. Return JSON array tugas
	echo json_encode([
		'success' => true,
		'message' => 'Berhasil mengambil daftar tugas.',
		'data' => [
			'id_kelas' => $id_kelas,
			'nama_matakuliah' => $kelas['nama_matakuliah'],
			'total_tugas' => count($result),
			'tugas_list' => $result
		]
	], JSON_UNESCAPED_UNICODE);
	
} catch (PDOException $e) {
	http_response_code(500);
	echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data tugas: ' . $e->getMessage()]);
}

?>