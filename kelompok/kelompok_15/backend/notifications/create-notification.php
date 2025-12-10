<?php
/**
 * HELPER: NOTIFICATION SYSTEM
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Helper function untuk create notification
 * - Function helper dipanggil saat event terjadi
 * - Event: tugas baru, dinilai, submission, join kelas
 * - Insert ke tabel notifications
 */

require_once __DIR__ . '/../../config/database.php';

/**
 * Create notification helper function
 * 
 * @param object $pdo PDO database connection
 * @param int $id_user User ID yang menerima notifikasi
 * @param string $tipe Tipe notifikasi (tugas_baru, dinilai, submission, join_kelas)
 * @param string $judul Judul notifikasi
 * @param string $pesan Pesan notifikasi
 * @param int|null $id_kelas ID kelas (optional)
 * @param int|null $id_tugas ID tugas (optional)
 * @param int|null $id_submission ID submission (optional)
 * 
 * @return bool true jika berhasil, false jika gagal
 */
function createNotification($pdo, $id_user, $tipe, $judul, $pesan, $id_kelas = null, $id_tugas = null, $id_submission = null) {
    try {
        $insert = "INSERT INTO notifications (id_user, tipe, judul, pesan, id_kelas, id_tugas, id_submission, read_at) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, NULL)";
        
        $stmt = $pdo->prepare($insert);
        $result = $stmt->execute([
            $id_user,
            $tipe,
            $judul,
            $pesan,
            $id_kelas,
            $id_tugas,
            $id_submission
        ]);

        return $result;
    } catch(Exception $e) {
        error_log('Error creating notification: ' . $e->getMessage());
        return false;
    }
}

/**
 * Notify tugas baru ke semua mahasiswa di kelas
 * 
 * @param object $pdo PDO database connection
 * @param int $id_kelas ID kelas
 * @param int $id_tugas ID tugas
 * @param string $judul_tugas Judul tugas
 */
function notifyTugasBaru($pdo, $id_kelas, $id_tugas, $judul_tugas) {
    try {
        // Get semua mahasiswa yang join kelas
        $get_mahasiswa = "SELECT id_mahasiswa FROM kelas_mahasiswa WHERE id_kelas = ?";
        $stmt = $pdo->prepare($get_mahasiswa);
        $stmt->execute([$id_kelas]);
        $mahasiswa_list = $stmt->fetchAll();

        // Create notification untuk setiap mahasiswa
        foreach ($mahasiswa_list as $mahasiswa) {
            createNotification(
                $pdo,
                $mahasiswa['id_mahasiswa'],
                'tugas_baru',
                'Tugas Baru: ' . $judul_tugas,
                'Ada tugas baru yang harus dikerjakan',
                $id_kelas,
                $id_tugas
            );
        }
        return true;
    } catch(Exception $e) {
        error_log('Error notifying tugas baru: ' . $e->getMessage());
        return false;
    }
}

/**
 * Notify mahasiswa saat submission dinilai
 * 
 * @param object $pdo PDO database connection
 * @param int $id_submission ID submission
 * @param int $id_mahasiswa ID mahasiswa
 * @param string $judul_tugas Judul tugas
 * @param int $nilai Nilai yang diberikan
 */
function notifySubmissionGraded($pdo, $id_submission, $id_mahasiswa, $judul_tugas, $nilai) {
    try {
        createNotification(
            $pdo,
            $id_mahasiswa,
            'dinilai',
            'Tugas Dinilai: ' . $judul_tugas,
            'Tugas Anda telah dinilai dengan nilai ' . $nilai,
            null,
            null,
            $id_submission
        );
        return true;
    } catch(Exception $e) {
        error_log('Error notifying submission graded: ' . $e->getMessage());
        return false;
    }
}

/**
 * Notify dosen saat ada submission baru
 * 
 * @param object $pdo PDO database connection
 * @param int $id_dosen ID dosen
 * @param int $id_submission ID submission
 * @param string $nama_mahasiswa Nama mahasiswa
 * @param string $judul_tugas Judul tugas
 */
function notifyNewSubmission($pdo, $id_dosen, $id_submission, $nama_mahasiswa, $judul_tugas) {
    try {
        createNotification(
            $pdo,
            $id_dosen,
            'submission',
            'Submission Baru: ' . $judul_tugas,
            'Mahasiswa ' . $nama_mahasiswa . ' telah submit tugas',
            null,
            null,
            $id_submission
        );
        return true;
    } catch(Exception $e) {
        error_log('Error notifying new submission: ' . $e->getMessage());
        return false;
    }
}

/**
 * Notify dosen saat mahasiswa join kelas
 * 
 * @param object $pdo PDO database connection
 * @param int $id_dosen ID dosen
 * @param int $id_kelas ID kelas
 * @param string $nama_mahasiswa Nama mahasiswa
 * @param string $nama_matakuliah Nama matakuliah
 */
function notifyMahasiswaJoin($pdo, $id_dosen, $id_kelas, $nama_mahasiswa, $nama_matakuliah) {
    try {
        createNotification(
            $pdo,
            $id_dosen,
            'join_kelas',
            'Mahasiswa Bergabung: ' . $nama_matakuliah,
            'Mahasiswa ' . $nama_mahasiswa . ' telah bergabung dengan kelas',
            $id_kelas
        );
        return true;
    } catch(Exception $e) {
        error_log('Error notifying mahasiswa join: ' . $e->getMessage());
        return false;
    }
}

/**
 * Mark notification as read
 * 
 * @param object $pdo PDO database connection
 * @param int $id_notification ID notification
 * 
 * @return bool true jika berhasil, false jika gagal
 */
function markNotificationAsRead($pdo, $id_notification) {
    try {
        $update = "UPDATE notifications SET read_at = NOW() WHERE id_notification = ?";
        $stmt = $pdo->prepare($update);
        return $stmt->execute([$id_notification]);
    } catch(Exception $e) {
        error_log('Error marking notification as read: ' . $e->getMessage());
        return false;
    }
}

/**
 * Get unread notifications count untuk user
 * 
 * @param object $pdo PDO database connection
 * @param int $id_user User ID
 * 
 * @return int Jumlah unread notifications
 */
function getUnreadNotificationsCount($pdo, $id_user) {
    try {
        $query = "SELECT COUNT(id_notification) as count FROM notifications WHERE id_user = ? AND read_at IS NULL";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_user]);
        $result = $stmt->fetch();
        return intval($result['count']);
    } catch(Exception $e) {
        error_log('Error getting unread notifications count: ' . $e->getMessage());
        return 0;
    }
}

?>