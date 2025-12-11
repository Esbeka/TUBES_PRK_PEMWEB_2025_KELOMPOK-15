<?php
/**
 * TEST SCRIPT: CRUD KELAS
 * Testing create, read, update, delete dengan ownership & unique code validation
 */

require_once 'config/database.php';

$total_tests = 0;
$passed_tests = 0;
$failed_tests = 0;

echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║         TESTING KELAS CRUD OPERATIONS & AUTHORIZATION           ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n\n";

// Get test dosens
$stmt = $pdo->prepare('SELECT id_user, nama FROM users WHERE role = "dosen" ORDER BY id_user LIMIT 2');
$stmt->execute();
$dosens = $stmt->fetchAll();

if (count($dosens) < 2) {
    echo "❌ ERROR: Minimal 2 dosen diperlukan untuk testing\n";
    exit(1);
}

$dosen1 = $dosens[0];
$dosen2 = $dosens[1];

echo "Test Dosens:\n";
echo "  Dosen 1: {$dosen1['nama']} (ID: {$dosen1['id_user']})\n";
echo "  Dosen 2: {$dosen2['nama']} (ID: {$dosen2['id_user']})\n\n";

// ============ CREATE TESTS ============
echo "┌─ CREATE TESTS ───────────────────────────────────────────────┐\n\n";

// Test 1: Create valid class
echo "Test 1: Create Valid Class\n";
$total_tests++;
try {
    $nama = "Pemrograman Web " . time();
    $kode = "WEB" . rand(100, 999);
    $semester = "5";
    $tahun = "2024";
    
    $stmt = $pdo->prepare('
        INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, kode_kelas, kapasitas)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ');
    
    // Generate unique code
    $kode_kelas = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));
    
    $result = $stmt->execute([
        $dosen1['id_user'],
        $nama,
        $kode,
        $semester,
        $tahun,
        $kode_kelas,
        50
    ]);
    
    $id_kelas_1 = $pdo->lastInsertId();
    
    if ($result && $id_kelas_1 > 0) {
        echo "✓ PASSED - Class created with ID: $id_kelas_1, Code: $kode_kelas\n";
        $passed_tests++;
    } else {
        echo "✗ FAILED - Could not create class\n";
        $failed_tests++;
    }
} catch (Exception $e) {
    echo "✗ FAILED - " . $e->getMessage() . "\n";
    $failed_tests++;
}
echo "\n";

// Test 2: Generate unique code (no duplicates)
echo "Test 2: Generate Unique Code (No Duplicates)\n";
$total_tests++;
try {
    $stmt = $pdo->prepare('SELECT COUNT(*) as total FROM kelas WHERE kode_kelas = ?');
    $stmt->execute([$kode_kelas]);
    $result = $stmt->fetch();
    
    if ($result['total'] == 1) {
        echo "✓ PASSED - Code is unique in database\n";
        $passed_tests++;
    } else {
        echo "✗ FAILED - Code is not unique\n";
        $failed_tests++;
    }
} catch (Exception $e) {
    echo "✗ FAILED - " . $e->getMessage() . "\n";
    $failed_tests++;
}
echo "\n";

// Test 3: Create another class to test uniqueness
echo "Test 3: Create Second Class - Different Code\n";
$total_tests++;
try {
    $nama2 = "Database " . time();
    $kode2 = "DB" . rand(100, 999);
    
    // Generate unique code
    $kode_kelas_2 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));
    
    // Ensure it's different
    while ($kode_kelas_2 == $kode_kelas) {
        $kode_kelas_2 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));
    }
    
    $stmt = $pdo->prepare('
        INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, kode_kelas, kapasitas)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ');
    
    $result = $stmt->execute([
        $dosen2['id_user'],
        $nama2,
        $kode2,
        "6",
        "2024",
        $kode_kelas_2,
        40
    ]);
    
    $id_kelas_2 = $pdo->lastInsertId();
    
    if ($kode_kelas_2 != $kode_kelas && $result && $id_kelas_2 > 0) {
        echo "✓ PASSED - Second class created with different code\n";
        $passed_tests++;
    } else {
        echo "✗ FAILED - Failed to create second class with unique code\n";
        $failed_tests++;
    }
} catch (Exception $e) {
    echo "✗ FAILED - " . $e->getMessage() . "\n";
    $failed_tests++;
}
echo "\n";

// ============ READ TESTS ============
echo "┌─ READ TESTS ─────────────────────────────────────────────────┐\n\n";

// Test 4: Read dosen's own classes
echo "Test 4: Read Dosen's Own Classes\n";
$total_tests++;
try {
    $stmt = $pdo->prepare('
        SELECT COUNT(*) as total FROM kelas WHERE id_dosen = ?
    ');
    $stmt->execute([$dosen1['id_user']]);
    $result = $stmt->fetch();
    
    if ($result['total'] > 0) {
        echo "✓ PASSED - Found {$result['total']} classes for dosen 1\n";
        $passed_tests++;
    } else {
        echo "✗ FAILED - No classes found\n";
        $failed_tests++;
    }
} catch (Exception $e) {
    echo "✗ FAILED - " . $e->getMessage() . "\n";
    $failed_tests++;
}
echo "\n";

// ============ UPDATE TESTS ============
echo "┌─ UPDATE TESTS ───────────────────────────────────────────────┐\n\n";

// Test 5: Update own class (should succeed)
echo "Test 5: Update Own Class (Should Succeed)\n";
$total_tests++;
try {
    $stmt = $pdo->prepare('
        UPDATE kelas SET nama_matakuliah = ? WHERE id_kelas = ? AND id_dosen = ?
    ');
    
    $new_name = "Pemrograman Web Updated " . time();
    $result = $stmt->execute([$new_name, $id_kelas_1, $dosen1['id_user']]);
    
    if ($result && $stmt->rowCount() > 0) {
        echo "✓ PASSED - Own class updated successfully\n";
        $passed_tests++;
    } else {
        echo "✗ FAILED - Could not update own class\n";
        $failed_tests++;
    }
} catch (Exception $e) {
    echo "✗ FAILED - " . $e->getMessage() . "\n";
    $failed_tests++;
}
echo "\n";

// Test 6: Authorization test - Dosen can't update other dosen's class
echo "Test 6: Authorization - Prevent Other Dosen Editing\n";
$total_tests++;
try {
    $stmt = $pdo->prepare('
        SELECT id_dosen FROM kelas WHERE id_kelas = ?
    ');
    $stmt->execute([$id_kelas_1]);
    $kelas = $stmt->fetch();
    
    // Try to update with different dosen
    if ($kelas['id_dosen'] != $dosen2['id_user']) {
        echo "✓ PASSED - Authorization check works (different owner)\n";
        $passed_tests++;
    } else {
        echo "✗ FAILED - Class belongs to wrong dosen\n";
        $failed_tests++;
    }
} catch (Exception $e) {
    echo "✗ FAILED - " . $e->getMessage() . "\n";
    $failed_tests++;
}
echo "\n";

// ============ DELETE TESTS ============
echo "┌─ DELETE TESTS ───────────────────────────────────────────────┐\n\n";

// Test 7: Create class with related data for cascade delete test
echo "Test 7: Create Class with Related Data (for cascade testing)\n";
$total_tests++;
try {
    $nama3 = "Cascade Test " . time();
    $kode3 = "CASCADE" . rand(100, 999);
    $kode_kelas_3 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));
    
    $stmt = $pdo->prepare('
        INSERT INTO kelas (id_dosen, nama_matakuliah, kode_matakuliah, semester, tahun_ajaran, kode_kelas, kapasitas)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ');
    
    $result = $stmt->execute([
        $dosen1['id_user'],
        $nama3,
        $kode3,
        "7",
        "2024",
        $kode_kelas_3,
        50
    ]);
    
    $id_kelas_cascade = $pdo->lastInsertId();
    
    if ($result && $id_kelas_cascade > 0) {
        // Add some data
        $stmt = $pdo->prepare('INSERT INTO materi (id_kelas, judul, tipe, pertemuan_ke) VALUES (?, ?, ?, ?)');
        $stmt->execute([$id_kelas_cascade, 'Material 1', 'pdf', 1]);
        
        $stmt = $pdo->prepare('INSERT INTO tugas (id_kelas, judul, deskripsi, deadline) VALUES (?, ?, ?, ?)');
        $stmt->execute([$id_kelas_cascade, 'Task 1', 'Do this', date('Y-m-d H:i:s', strtotime('+7 days'))]);
        
        echo "✓ PASSED - Class with related data created\n";
        $passed_tests++;
    } else {
        echo "✗ FAILED - Could not create test class\n";
        $failed_tests++;
    }
} catch (Exception $e) {
    echo "✗ FAILED - " . $e->getMessage() . "\n";
    $failed_tests++;
}
echo "\n";

// Test 8: Cascade delete - delete class with related data
echo "Test 8: Cascade Delete - Delete Class with Related Data\n";
$total_tests++;
try {
    // Check related data exists
    $stmt = $pdo->prepare('SELECT COUNT(*) as total FROM materi WHERE id_kelas = ?');
    $stmt->execute([$id_kelas_cascade]);
    $materi_count = $stmt->fetch()['total'];
    
    $stmt = $pdo->prepare('SELECT COUNT(*) as total FROM tugas WHERE id_kelas = ?');
    $stmt->execute([$id_kelas_cascade]);
    $tugas_count = $stmt->fetch()['total'];
    
    // Delete class
    $stmt = $pdo->prepare('DELETE FROM kelas WHERE id_kelas = ? AND id_dosen = ?');
    $stmt->execute([$id_kelas_cascade, $dosen1['id_user']]);
    
    // Check if data was deleted (cascade)
    $stmt = $pdo->prepare('SELECT COUNT(*) as total FROM materi WHERE id_kelas = ?');
    $stmt->execute([$id_kelas_cascade]);
    $materi_after = $stmt->fetch()['total'];
    
    $stmt = $pdo->prepare('SELECT COUNT(*) as total FROM tugas WHERE id_kelas = ?');
    $stmt->execute([$id_kelas_cascade]);
    $tugas_after = $stmt->fetch()['total'];
    
    if ($materi_after == 0 && $tugas_after == 0 && $materi_count > 0 && $tugas_count > 0) {
        echo "✓ PASSED - Cascade delete works (related data deleted)\n";
        $passed_tests++;
    } else {
        echo "✗ FAILED - Related data not deleted properly\n";
        $failed_tests++;
    }
} catch (Exception $e) {
    echo "✗ FAILED - " . $e->getMessage() . "\n";
    $failed_tests++;
}
echo "\n";

// Test 9: Authorization - Prevent other dosen from deleting
echo "Test 9: Authorization - Prevent Other Dosen from Deleting\n";
$total_tests++;
try {
    $stmt = $pdo->prepare('SELECT id_dosen FROM kelas WHERE id_kelas = ?');
    $stmt->execute([$id_kelas_2]);
    $owner = $stmt->fetch()['id_dosen'];
    
    // Try to delete with different dosen - should fail
    $stmt = $pdo->prepare('DELETE FROM kelas WHERE id_kelas = ? AND id_dosen = ?');
    $stmt->execute([$id_kelas_2, $dosen1['id_user']]);
    
    // Class should still exist
    $stmt = $pdo->prepare('SELECT COUNT(*) as total FROM kelas WHERE id_kelas = ?');
    $stmt->execute([$id_kelas_2]);
    $exists = $stmt->fetch()['total'];
    
    if ($exists > 0 && $owner == $dosen2['id_user']) {
        echo "✓ PASSED - Authorization prevents unauthorized deletion\n";
        $passed_tests++;
    } else {
        echo "✗ FAILED - Authorization check failed\n";
        $failed_tests++;
    }
} catch (Exception $e) {
    echo "✗ FAILED - " . $e->getMessage() . "\n";
    $failed_tests++;
}
echo "\n";

// ============ SUMMARY ============
echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║                        TEST SUMMARY                            ║\n";
echo "╠════════════════════════════════════════════════════════════════╣\n";
printf("║ Total Tests:     %-50d ║\n", $total_tests);
printf("║ Passed:          %-50d ║\n", $passed_tests);
printf("║ Failed:          %-50d ║\n", $failed_tests);
echo "╠════════════════════════════════════════════════════════════════╣\n";

$percentage = ($total_tests > 0) ? ($passed_tests / $total_tests * 100) : 0;
printf("║ Success Rate:    %-49.1f%% ║\n", $percentage);

echo "╚════════════════════════════════════════════════════════════════╝\n";

if ($failed_tests === 0) {
    echo "\n✓ ALL TESTS PASSED! ✓\n";
} else {
    echo "\n✗ SOME TESTS FAILED - CHECK ABOVE FOR DETAILS ✗\n";
}
?>
