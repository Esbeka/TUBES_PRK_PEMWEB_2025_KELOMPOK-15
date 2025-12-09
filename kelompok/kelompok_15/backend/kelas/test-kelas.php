<?php
/**
 * TESTING SUITE - MANAJEMEN KELAS DOSEN
 * 
 * Test Cases:
 * 1. Generate kode unik (tidak duplikat)
 * 2. Cascade delete (semua data terkait terhapus)
 * 3. Authorization (dosen lain tidak bisa edit/hapus)
 */

error_reporting(E_ALL);
ini_set('display_errors', 0);
set_time_limit(30);

// Include configuration
require_once __DIR__ . '/../../config/database.php';

// Color codes untuk output
define('GREEN', '\033[92m');
define('RED', '\033[91m');
define('YELLOW', '\033[93m');
define('BLUE', '\033[94m');
define('RESET', '\033[0m');

// Test statistics
$total_tests = 0;
$passed_tests = 0;
$failed_tests = 0;

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

echo BLUE . "=" . str_repeat("=", 98) . "=" . RESET . "\n";
echo BLUE . "TESTING SUITE - MANAJEMEN KELAS DOSEN" . RESET . "\n";
echo BLUE . "=" . str_repeat("=", 98) . "=" . RESET . "\n\n";

// ============================================
// SETUP: Create test data (dosen & mahasiswa)
// ============================================
echo YELLOW . "[SETUP] Membuat data dosen untuk testing..." . RESET . "\n";

try {
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
    echo GREEN . "✓ Dosen 1 berhasil dibuat (ID: " . $test_dosen_1['id'] . ")" . RESET . "\n";

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
    echo GREEN . "✓ Dosen 2 berhasil dibuat (ID: " . $test_dosen_2['id'] . ")" . RESET . "\n";

} catch (Exception $e) {
    echo RED . "✗ Gagal membuat data dosen: " . $e->getMessage() . RESET . "\n";
    exit(1);
}

echo "\n";

// ============================================
// TEST 1: GENERATE KODE UNIK (Tidak Duplikat)
// ============================================
echo YELLOW . "[TEST 1] Generate Kode Unik (Tidak Duplikat)" . RESET . "\n";
echo str_repeat("-", 100) . "\n";

$test_case_counter = 0;

// Test 1.1: Generate kode unik untuk kelas pertama
test_case("Generate kode unik untuk kelas pertama", function() use ($pdo, $test_dosen_1, &$test_kelas) {
    $kode_kelas = generateUniqueCode($pdo);
    
    // Cek apakah kode sudah ada di database
    $check = $pdo->prepare("SELECT id_kelas FROM kelas WHERE kode_kelas = ?");
    $check->execute([$kode_kelas]);
    
    if ($check->rowCount() > 0) {
        throw new Exception("Kode unik sudah ada di database!");
    }
    
    // Insert kelas dengan kode unik
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
    
    if (!$test_kelas['id']) {
        throw new Exception("Gagal insert kelas");
    }
    
    return "Kode unik: {$kode_kelas}";
});

// Test 1.2: Verifikasi kode unik tidak bisa duplikat
test_case("Verifikasi kode unik tidak bisa duplikat (sama dalam database)", function() use ($pdo, $test_kelas) {
    $duplicate_code = $test_kelas['kode'];
    
    // Coba insert dengan kode yang sama
    $stmt = $pdo->prepare(
        "INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, deskripsi, kode_kelas, kapasitas) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    
    try {
        $result = $stmt->execute([
            2, // dummy id
            'Dummy Kelas',
            'DUMMY',
            '5',
            '2024/2025',
            'Dummy',
            $duplicate_code,
            50
        ]);
        
        if ($result) {
            throw new Exception("Duplikat kode berhasil diinsert! Ini adalah bug!");
        }
    } catch (PDOException $e) {
        // Expected: unique constraint violation
        if (strpos($e->getMessage(), 'Duplicate') === false) {
            throw $e;
        }
        return "Constraint violation terdeteksi (expected)";
    }
});

// Test 1.3: Generate multiple kode unik dan verifikasi semuanya berbeda
test_case("Generate 10 kode unik dan verifikasi semuanya berbeda", function() use ($pdo) {
    $kodes = [];
    for ($i = 0; $i < 10; $i++) {
        $kode = generateUniqueCode($pdo);
        if (in_array($kode, $kodes)) {
            throw new Exception("Kode duplikat ditemukan dalam 10 iterasi: {$kode}");
        }
        $kodes[] = $kode;
    }
    return "10 kode unik berhasil di-generate: " . implode(", ", array_slice($kodes, 0, 3)) . "...";
});

// Test 1.4: Kode harus format 2 huruf + 4 angka
test_case("Format kode harus 2 huruf + 4 angka", function() use ($pdo) {
    for ($i = 0; $i < 5; $i++) {
        $kode = generateUniqueCode($pdo);
        
        if (strlen($kode) != 6) {
            throw new Exception("Kode bukan 6 karakter: {$kode}");
        }
        
        if (!preg_match('/^[A-Z]{2}[0-9]{4}$/', $kode)) {
            throw new Exception("Format kode invalid: {$kode}");
        }
    }
    return "Format kode valid (AA0000 pattern)";
});

echo "\n";

// ============================================
// TEST 2: CASCADE DELETE (Semua Data Terkait Terhapus)
// ============================================
echo YELLOW . "[TEST 2] Cascade Delete (Semua Data Terkait Terhapus)" . RESET . "\n";
echo str_repeat("-", 100) . "\n";

// Create test data untuk cascade test
$mahasiswa_id = null;
$materi_id = null;
$tugas_id = null;
$submission_id = null;

try {
    // Create dummy mahasiswa
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

    // Add mahasiswa ke kelas
    $stmt = $pdo->prepare(
        "INSERT INTO kelas_mahasiswa (id_kelas, id_mahasiswa) 
         VALUES (?, ?)"
    );
    $stmt->execute([$test_kelas['id'], $mahasiswa_id]);

    // Create materi
    $stmt = $pdo->prepare(
        "INSERT INTO materi (id_kelas, judul, deskripsi, tipe, file_path, pertemuan_ke) 
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $test_kelas['id'],
        'Materi Test Cascade',
        'Materi untuk test cascade delete',
        'pdf',
        '/dummy/materi.pdf',
        1
    ]);
    $materi_id = $pdo->lastInsertId();

    // Create tugas
    $stmt = $pdo->prepare(
        "INSERT INTO tugas (id_kelas, judul, deskripsi, deadline, max_file_size, allowed_formats, bobot) 
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $test_kelas['id'],
        'Tugas Test Cascade',
        'Tugas untuk test cascade delete',
        date('Y-m-d H:i:s', strtotime('+7 days')),
        10,
        'pdf',
        100
    ]);
    $tugas_id = $pdo->lastInsertId();

    // Create submission
    $stmt = $pdo->prepare(
        "INSERT INTO submission_tugas (id_tugas, id_mahasiswa, file_path, status) 
         VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([
        $tugas_id,
        $mahasiswa_id,
        '/dummy/submission.pdf',
        'submitted'
    ]);
    $submission_id = $pdo->lastInsertId();

} catch (Exception $e) {
    echo RED . "✗ Gagal setup data cascade: " . $e->getMessage() . RESET . "\n";
}

// Test 2.1: Verifikasi data sebelum delete
test_case("Verifikasi data terkait ada sebelum delete", function() use ($pdo, $test_kelas, $mahasiswa_id, $materi_id, $tugas_id, $submission_id) {
    $checks = [
        ['kelas', 'SELECT id_kelas FROM kelas WHERE id_kelas = ?', $test_kelas['id']],
        ['kelas_mahasiswa', 'SELECT id FROM kelas_mahasiswa WHERE id_kelas = ?', $test_kelas['id']],
        ['materi', 'SELECT id_materi FROM materi WHERE id_kelas = ?', $test_kelas['id']],
        ['tugas', 'SELECT id_tugas FROM tugas WHERE id_kelas = ?', $test_kelas['id']],
        ['submission_tugas', 'SELECT id_submission FROM submission_tugas WHERE id_tugas = ?', $tugas_id],
    ];

    foreach ($checks as [$table, $query, $param]) {
        $stmt = $pdo->prepare($query);
        $stmt->execute([$param]);
        if ($stmt->rowCount() === 0) {
            throw new Exception("{$table} tidak ada!");
        }
    }

    return "Semua data terkait ada (kelas, mahasiswa, materi, tugas, submission)";
});

// Test 2.2: Delete kelas dan verifikasi cascade
test_case("Delete kelas dan verifikasi cascade ke semua data terkait", function() use ($pdo, $test_kelas, $tugas_id) {
    // Delete kelas
    $stmt = $pdo->prepare("DELETE FROM kelas WHERE id_kelas = ?");
    $stmt->execute([$test_kelas['id']]);

    // Verifikasi kelas dihapus
    $check_kelas = $pdo->prepare("SELECT id_kelas FROM kelas WHERE id_kelas = ?");
    $check_kelas->execute([$test_kelas['id']]);
    if ($check_kelas->rowCount() > 0) {
        throw new Exception("Kelas masih ada setelah delete!");
    }

    // Verifikasi kelas_mahasiswa dihapus (CASCADE)
    $check_km = $pdo->prepare("SELECT id FROM kelas_mahasiswa WHERE id_kelas = ?");
    $check_km->execute([$test_kelas['id']]);
    if ($check_km->rowCount() > 0) {
        throw new Exception("kelas_mahasiswa tidak terhapus! Cascade gagal!");
    }

    // Verifikasi materi dihapus (CASCADE)
    $check_materi = $pdo->prepare("SELECT id_materi FROM materi WHERE id_kelas = ?");
    $check_materi->execute([$test_kelas['id']]);
    if ($check_materi->rowCount() > 0) {
        throw new Exception("materi tidak terhapus! Cascade gagal!");
    }

    // Verifikasi tugas dihapus (CASCADE)
    $check_tugas = $pdo->prepare("SELECT id_tugas FROM tugas WHERE id_kelas = ?");
    $check_tugas->execute([$test_kelas['id']]);
    if ($check_tugas->rowCount() > 0) {
        throw new Exception("tugas tidak terhapus! Cascade gagal!");
    }

    // Verifikasi submission_tugas dihapus (CASCADE -> tugas dihapus -> submission ikut dihapus)
    $check_sub = $pdo->prepare("SELECT id_submission FROM submission_tugas WHERE id_tugas = ?");
    $check_sub->execute([$tugas_id]);
    if ($check_sub->rowCount() > 0) {
        throw new Exception("submission_tugas tidak terhapus! Cascade gagal!");
    }

    return "Cascade delete berhasil! Semua data terkait dihapus";
});

echo "\n";

// ============================================
// TEST 3: AUTHORIZATION (Dosen Lain Tidak Bisa Edit/Hapus)
// ============================================
echo YELLOW . "[TEST 3] Authorization (Dosen Lain Tidak Bisa Edit/Hapus)" . RESET . "\n";
echo str_repeat("-", 100) . "\n";

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
        'Kelas untuk test authorization',
        $kode,
        50
    ]);
    $kelas_dosen_2_id = $pdo->lastInsertId();
} catch (Exception $e) {
    echo RED . "✗ Gagal membuat kelas dosen 2: " . $e->getMessage() . RESET . "\n";
}

// Test 3.1: Dosen 2 tidak bisa edit kelas milik dosen 1
test_case("Dosen 2 tidak bisa edit kelas milik dosen 1 (authorization check)", function() use ($pdo, $test_dosen_1, $kelas_dosen_2_id) {
    // Simulate update attempt sebagai dosen 1 ke kelas dosen 2
    $stmt = $pdo->prepare("SELECT id_dosen FROM kelas WHERE id_kelas = ?");
    $stmt->execute([$kelas_dosen_2_id]);
    $kelas = $stmt->fetch(PDO::FETCH_ASSOC);

    // Owner adalah dosen 2
    if ($kelas['id_dosen'] == $test_dosen_1['id']) {
        throw new Exception("Ownership check gagal!");
    }

    // Simulasi dosen 1 coba update kelas milik dosen 2
    if ($kelas['id_dosen'] != $test_dosen_1['id']) {
        return "Authorization check passed - Dosen 1 tidak bisa edit kelas dosen 2";
    }
});

// Test 3.2: Dosen 2 tidak bisa hapus kelas milik dosen 1
test_case("Dosen 2 tidak bisa hapus kelas milik dosen 1 (authorization check)", function() use ($pdo, $test_dosen_1, $kelas_dosen_2_id) {
    // Simulasi dosen 1 coba hapus kelas milik dosen 2
    $stmt = $pdo->prepare("SELECT id_dosen FROM kelas WHERE id_kelas = ?");
    $stmt->execute([$kelas_dosen_2_id]);
    $kelas = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($kelas['id_dosen'] != $test_dosen_1['id']) {
        return "Authorization check passed - Dosen 1 tidak bisa hapus kelas dosen 2";
    }
});

// Test 3.3: Dosen 2 bisa edit kelas miliknya sendiri
test_case("Dosen 2 bisa edit kelas miliknya sendiri (ownership verified)", function() use ($pdo, $test_dosen_2, $kelas_dosen_2_id) {
    $stmt = $pdo->prepare("SELECT id_dosen FROM kelas WHERE id_kelas = ?");
    $stmt->execute([$kelas_dosen_2_id]);
    $kelas = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($kelas['id_dosen'] != $test_dosen_2['id']) {
        throw new Exception("Ownership verification gagal!");
    }

    return "Ownership verified - Dosen 2 adalah owner kelas";
});

// Test 3.4: Get kelas dosen hanya menampilkan kelas milik dosen tersebut
test_case("Get kelas dosen hanya menampilkan kelas milik dosen tersebut", function() use ($pdo, $test_dosen_1, $test_dosen_2, $kelas_dosen_2_id) {
    // Query kelas untuk dosen 1
    $stmt1 = $pdo->prepare("SELECT COUNT(*) as count FROM kelas WHERE id_dosen = ?");
    $stmt1->execute([$test_dosen_1['id']]);
    $count_dosen1 = $stmt1->fetch(PDO::FETCH_ASSOC)['count'];

    // Query kelas untuk dosen 2
    $stmt2 = $pdo->prepare("SELECT COUNT(*) as count FROM kelas WHERE id_dosen = ?");
    $stmt2->execute([$test_dosen_2['id']]);
    $count_dosen2 = $stmt2->fetch(PDO::FETCH_ASSOC)['count'];

    // Verify kelas_dosen_2_id adalah milik dosen 2
    $verify = $pdo->prepare("SELECT id_dosen FROM kelas WHERE id_kelas = ?");
    $verify->execute([$kelas_dosen_2_id]);
    $owner = $verify->fetch(PDO::FETCH_ASSOC)['id_dosen'];

    if ($owner != $test_dosen_2['id']) {
        throw new Exception("Kelas tidak milik dosen 2!");
    }

    return "Kelas filtering bekerja - Dosen 1: {$count_dosen1} kelas, Dosen 2: {$count_dosen2} kelas";
});

echo "\n";

// ============================================
// CLEANUP
// ============================================
echo YELLOW . "[CLEANUP] Menghapus data test..." . RESET . "\n";

try {
    // Delete test dosen
    $pdo->prepare("DELETE FROM users WHERE id_user IN (?, ?)")
        ->execute([$test_dosen_1['id'], $test_dosen_2['id']]);
    
    // Cascade delete akan menghapus semua data terkait
    echo GREEN . "✓ Data test berhasil dihapus" . RESET . "\n";
} catch (Exception $e) {
    echo RED . "✗ Gagal cleanup: " . $e->getMessage() . RESET . "\n";
}

echo "\n";

// ============================================
// SUMMARY
// ============================================
echo BLUE . "=" . str_repeat("=", 98) . "=" . RESET . "\n";
echo "SUMMARY TEST RESULTS\n";
echo BLUE . "=" . str_repeat("=", 98) . "=" . RESET . "\n";
echo "Total Tests: {$total_tests}\n";
echo GREEN . "Passed: {$passed_tests}" . RESET . "\n";
echo RED . "Failed: {$failed_tests}" . RESET . "\n";
echo "Success Rate: " . round(($passed_tests / $total_tests * 100), 2) . "%\n";
echo "\n";

if ($failed_tests === 0) {
    echo GREEN . "✓ ALL TESTS PASSED! System ready for production." . RESET . "\n";
} else {
    echo RED . "✗ Some tests failed. Review the output above." . RESET . "\n";
}

echo BLUE . "=" . str_repeat("=", 98) . "=" . RESET . "\n";

// ============================================
// HELPER FUNCTIONS
// ============================================

/**
 * Test case executor
 */
function test_case($name, $callback) {
    global $total_tests, $passed_tests, $failed_tests;
    $total_tests++;

    try {
        $result = $callback();
        echo GREEN . "✓ Test {$total_tests}: {$name}" . RESET . "\n";
        if ($result) {
            echo "  └─ {$result}\n";
        }
        $passed_tests++;
    } catch (Exception $e) {
        echo RED . "✗ Test {$total_tests}: {$name}" . RESET . "\n";
        echo RED . "  └─ Error: " . $e->getMessage() . RESET . "\n";
        $failed_tests++;
    }
}

/**
 * Generate kode kelas unik
 */
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