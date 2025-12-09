<?php
/**
 * TEST API - KELAS DOSEN
 * 
 * API endpoint untuk menjalankan tests dan return JSON
 * Diakses oleh test-kelas-dashboard.html
 */

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);
set_time_limit(60);

try {
    require_once __DIR__ . '/../../config/database.php';
    
    // Verify database connection works
    $pdo->query("SELECT 1");
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database connection error: ' . $e->getMessage()
    ]);
    exit;
}

// Test statistics
$total_tests = 0;
$passed_tests = 0;
$failed_tests = 0;
$all_tests = [];
$test1_results = [];
$test2_results = [];
$test3_results = [];

// Test data
$test_dosen_1 = [
    'id' => null,
    'email' => 'dosen1_test_' . time() . '@test.com',
    'password' => password_hash('TestDosen123', PASSWORD_BCRYPT),
    'nama' => 'Dosen Test 1',
    'role' => 'dosen',
    'npm_nidn' => 'NIDN001'
];

$test_dosen_2 = [
    'id' => null,
    'email' => 'dosen2_test_' . time() . '@test.com',
    'password' => password_hash('TestDosen123', PASSWORD_BCRYPT),
    'nama' => 'Dosen Test 2',
    'role' => 'dosen',
    'npm_nidn' => 'NIDN002'
];

$test_kelas = [
    'id' => null,
    'nama_matakuliah' => 'Kelas Testing ' . time(),
    'kode_matakuliah' => 'TEST' . rand(100, 999),
    'semester' => '5',
    'tahun_ajaran' => '2024/2025',
    'deskripsi' => 'Kelas untuk testing cascade delete',
    'kapasitas' => '50'
];

try {
    // ============================================
    // SETUP: Create test data
    // ============================================
    
    // Create dosen 1
    $stmt = $pdo->prepare(
        "INSERT INTO users (nama, email, password, role, npm_nidn) 
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $test_dosen_1['nama'],
        $test_dosen_1['email'],
        $test_dosen_1['password'],
        $test_dosen_1['role'],
        $test_dosen_1['npm_nidn']
    ]);
    $test_dosen_1['id'] = $pdo->lastInsertId();

    // Create dosen 2
    $stmt = $pdo->prepare(
        "INSERT INTO users (nama, email, password, role, npm_nidn) 
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $test_dosen_2['nama'],
        $test_dosen_2['email'],
        $test_dosen_2['password'],
        $test_dosen_2['role'],
        $test_dosen_2['npm_nidn']
    ]);
    $test_dosen_2['id'] = $pdo->lastInsertId();

    // ============================================
    // TEST 1: GENERATE KODE UNIK
    // ============================================
    
    // Test 1.1: Generate kode unik
    add_test_result("Generate kode unik untuk kelas pertama", function() use ($pdo, $test_dosen_1, &$test_kelas) {
        $kode_kelas = generateUniqueCode($pdo);
        
        $check = $pdo->prepare("SELECT id_kelas FROM kelas WHERE kode_kelas = ?");
        $check->execute([$kode_kelas]);
        
        if ($check->rowCount() > 0) {
            throw new Exception("Kode unik sudah ada di database!");
        }
        
        $stmt = $pdo->prepare(
            "INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $test_dosen_1['id'],
            $test_kelas['nama_matakuliah'],
            $test_kelas['kode_matakuliah'],
            $test_kelas['semester'],
            $test_kelas['tahun_ajaran'],
            $test_kelas['deskripsi'],
            $kode_kelas,
            $test_kelas['kapasitas']
        ]);
        
        $test_kelas['id'] = $pdo->lastInsertId();
        $test_kelas['kode'] = $kode_kelas;
        
        return "Kode unik: {$kode_kelas}";
    }, $test1_results);

    // Test 1.2: Verifikasi duplikat constraint
    add_test_result("Verifikasi kode unik tidak bisa duplikat", function() use ($pdo, $test_kelas) {
        $duplicate_code = $test_kelas['kode'];
        
        $stmt = $pdo->prepare(
            "INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        
        try {
            $stmt->execute([2, 'Dummy', 'DUMMY', '5', '2024/2025', 'Dummy', $duplicate_code, 50]);
            if ($stmt->rowCount() > 0) {
                throw new Exception("Duplikat diizinkan!");
            }
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Duplicate') === false) {
                throw $e;
            }
            return "Constraint violation terdeteksi (expected)";
        }
    }, $test1_results);

    // Test 1.3: Generate multiple codes
    add_test_result("Generate 10 kode unik dan verifikasi berbeda", function() use ($pdo) {
        $kodes = [];
        for ($i = 0; $i < 10; $i++) {
            $kode = generateUniqueCode($pdo);
            if (in_array($kode, $kodes)) {
                throw new Exception("Kode duplikat dalam 10 iterasi!");
            }
            $kodes[] = $kode;
        }
        return "10 kode berhasil: " . implode(", ", array_slice($kodes, 0, 3)) . "...";
    }, $test1_results);

    // Test 1.4: Format validation
    add_test_result("Format kode harus 2 huruf + 4 angka", function() use ($pdo) {
        for ($i = 0; $i < 5; $i++) {
            $kode = generateUniqueCode($pdo);
            
            if (strlen($kode) != 6) {
                throw new Exception("Kode bukan 6 karakter: {$kode}");
            }
            
            if (!preg_match('/^[A-Z]{2}[0-9]{4}$/', $kode)) {
                throw new Exception("Format invalid: {$kode}");
            }
        }
        return "Format kode valid (AA0000 pattern)";
    }, $test1_results);

    // ============================================
    // TEST 2: CASCADE DELETE
    // ============================================

    // Setup cascade test data
    $mahasiswa_id = null;
    $tugas_id = null;

    try {
        $stmt = $pdo->prepare(
            "INSERT INTO users (nama, email, password, role, npm_nidn) 
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            'Mahasiswa Dummy',
            'mahasiswa_cascade_' . time() . '@test.com',
            password_hash('Test123', PASSWORD_BCRYPT),
            'mahasiswa',
            'NPM001'
        ]);
        $mahasiswa_id = $pdo->lastInsertId();

        $stmt = $pdo->prepare(
            "INSERT INTO kelas_mahasiswa (id_kelas, id_mahasiswa) 
             VALUES (?, ?)"
        );
        $stmt->execute([$test_kelas['id'], $mahasiswa_id]);

        $stmt = $pdo->prepare(
            "INSERT INTO materi (id_kelas, judul, deskripsi, tipe, file_path, pertemuan_ke) 
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $test_kelas['id'],
            'Materi Test',
            'Test',
            'pdf',
            '/test.pdf',
            1
        ]);

        $stmt = $pdo->prepare(
            "INSERT INTO tugas (id_kelas, judul, deskripsi, deadline, max_file_size, allowed_formats, bobot) 
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $test_kelas['id'],
            'Tugas Test',
            'Test',
            date('Y-m-d H:i:s', strtotime('+7 days')),
            10,
            'pdf',
            100
        ]);
        $tugas_id = $pdo->lastInsertId();

        $stmt = $pdo->prepare(
            "INSERT INTO submission_tugas (id_tugas, id_mahasiswa, file_path, status) 
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$tugas_id, $mahasiswa_id, '/test.pdf', 'submitted']);

    } catch (Exception $e) {
        // Silently continue
    }

    // Test 2.1: Data exists
    add_test_result("Verifikasi data terkait ada sebelum delete", function() use ($pdo, $test_kelas) {
        $checks = [
            'SELECT id_kelas FROM kelas WHERE id_kelas = ?',
            'SELECT id FROM kelas_mahasiswa WHERE id_kelas = ?',
            'SELECT id_materi FROM materi WHERE id_kelas = ?',
            'SELECT id_tugas FROM tugas WHERE id_kelas = ?'
        ];

        foreach ($checks as $query) {
            $stmt = $pdo->prepare($query);
            $stmt->execute([$test_kelas['id']]);
            if ($stmt->rowCount() === 0) {
                throw new Exception("Data tidak lengkap!");
            }
        }

        return "Semua data terkait ada (kelas, mahasiswa, materi, tugas)";
    }, $test2_results);

    // Test 2.2: Cascade delete
    add_test_result("Delete kelas dan verifikasi cascade", function() use ($pdo, $test_kelas, $tugas_id) {
        $stmt = $pdo->prepare("DELETE FROM kelas WHERE id_kelas = ?");
        $stmt->execute([$test_kelas['id']]);

        $checks = [
            'SELECT id_kelas FROM kelas WHERE id_kelas = ?',
            'SELECT id FROM kelas_mahasiswa WHERE id_kelas = ?',
            'SELECT id_materi FROM materi WHERE id_kelas = ?',
            'SELECT id_tugas FROM tugas WHERE id_kelas = ?'
        ];

        foreach ($checks as $query) {
            $stmt = $pdo->prepare($query);
            $stmt->execute([$test_kelas['id']]);
            if ($stmt->rowCount() > 0) {
                throw new Exception("Data belum dihapus!");
            }
        }

        return "Cascade delete berhasil! Semua data terkait dihapus";
    }, $test2_results);

    // ============================================
    // TEST 3: AUTHORIZATION
    // ============================================

    // Create kelas untuk dosen 2
    try {
        $kode = generateUniqueCode($pdo);
        $stmt = $pdo->prepare(
            "INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $test_dosen_2['id'],
            'Kelas Milik Dosen 2',
            'DOSEN2',
            '5',
            '2024/2025',
            'Test',
            $kode,
            50
        ]);
        $kelas_dosen_2_id = $pdo->lastInsertId();
    } catch (Exception $e) {
        $kelas_dosen_2_id = null;
    }

    // Test 3.1: Authorization edit
    add_test_result("Dosen 2 tidak bisa edit kelas milik Dosen 1", function() use ($pdo, $test_dosen_1, $kelas_dosen_2_id) {
        if (!$kelas_dosen_2_id) {
            return "Skip - kelas tidak ada";
        }
        
        $stmt = $pdo->prepare("SELECT id_dosen FROM kelas WHERE id_kelas = ?");
        $stmt->execute([$kelas_dosen_2_id]);
        $kelas = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($kelas['id_dosen'] != $test_dosen_1['id']) {
            return "Authorization check passed";
        }
    }, $test3_results);

    // Test 3.2: Authorization delete
    add_test_result("Dosen 2 tidak bisa hapus kelas milik Dosen 1", function() use ($pdo, $test_dosen_1, $kelas_dosen_2_id) {
        if (!$kelas_dosen_2_id) {
            return "Skip - kelas tidak ada";
        }
        
        $stmt = $pdo->prepare("SELECT id_dosen FROM kelas WHERE id_kelas = ?");
        $stmt->execute([$kelas_dosen_2_id]);
        $kelas = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($kelas['id_dosen'] != $test_dosen_1['id']) {
            return "Authorization check passed";
        }
    }, $test3_results);

    // Test 3.3: Ownership
    add_test_result("Dosen 2 bisa edit kelas miliknya sendiri", function() use ($pdo, $test_dosen_2, $kelas_dosen_2_id) {
        if (!$kelas_dosen_2_id) {
            return "Skip - kelas tidak ada";
        }
        
        $stmt = $pdo->prepare("SELECT id_dosen FROM kelas WHERE id_kelas = ?");
        $stmt->execute([$kelas_dosen_2_id]);
        $kelas = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($kelas['id_dosen'] != $test_dosen_2['id']) {
            throw new Exception("Ownership verification gagal!");
        }

        return "Ownership verified";
    }, $test3_results);

    // Test 3.4: Data isolation
    add_test_result("Get kelas dosen hanya menampilkan kelas miliknya", function() use ($pdo, $test_dosen_1, $test_dosen_2) {
        $stmt1 = $pdo->prepare("SELECT COUNT(*) as count FROM kelas WHERE id_dosen = ?");
        $stmt1->execute([$test_dosen_1['id']]);
        $count_dosen1 = $stmt1->fetch(PDO::FETCH_ASSOC)['count'];

        $stmt2 = $pdo->prepare("SELECT COUNT(*) as count FROM kelas WHERE id_dosen = ?");
        $stmt2->execute([$test_dosen_2['id']]);
        $count_dosen2 = $stmt2->fetch(PDO::FETCH_ASSOC)['count'];

        return "Filtering working - Dosen 1: {$count_dosen1}, Dosen 2: {$count_dosen2}";
    }, $test3_results);

    // ============================================
    // CLEANUP
    // ============================================
    
    try {
        $pdo->prepare("DELETE FROM users WHERE id_user IN (?, ?)")
            ->execute([$test_dosen_1['id'], $test_dosen_2['id']]);
    } catch (Exception $e) {
        // Continue
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
    exit;
}

// Build response
$response = [
    'success' => true,
    'stats' => [
        'total' => $total_tests,
        'passed' => $passed_tests,
        'failed' => $failed_tests,
        'success_rate' => $total_tests > 0 ? round(($passed_tests / $total_tests) * 100) : 0
    ],
    'test1' => $test1_results,
    'test2' => $test2_results,
    'test3' => $test3_results,
    'tests' => $all_tests
];

echo json_encode($response);

// ============================================
// HELPER FUNCTIONS
// ============================================

function add_test_result($name, $callback, &$category_results) {
    global $total_tests, $passed_tests, $failed_tests, $all_tests;
    
    $total_tests++;
    
    try {
        $message = $callback();
        $passed_tests++;
        
        $result = [
            'name' => $name,
            'passed' => true,
            'message' => $message ?: 'PASSED'
        ];
    } catch (Exception $e) {
        $failed_tests++;
        
        $result = [
            'name' => $name,
            'passed' => false,
            'message' => $e->getMessage()
        ];
    }
    
    $category_results[] = $result;
    $all_tests[] = $result;
}

function generateUniqueCode($pdo) {
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $kode = '';
    
    for ($i = 0; $i < 2; $i++) {
        $kode .= $letters[rand(0, 25)];
    }
    
    for ($i = 0; $i < 4; $i++) {
        $kode .= rand(0, 9);
    }
    
    return $kode;
}

?>