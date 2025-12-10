<?php
/**
 * FITUR 8: MANAJEMEN PROFIL - UPLOAD FOTO
 * Tanggung Jawab: SURYA (Backend Developer)
 * 
 * Deskripsi: Upload foto profil
 * - Validasi image (JPG, PNG, max 2MB)
 * - Resize image (max 500x500)
 * - Upload ke /uploads/profil/
 * - Delete foto lama jika ada
 * - Update path di database
 */

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth/session-check.php';

$response = ['success' => false, 'message' => '', 'data' => null];

try {
    // 1. Cek session
    requireLogin();
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed');
    }

    if (empty($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('File foto harus diunggah');
    }

    $user_id = getUserId();
    $file = $_FILES['foto'];

    // 2. Validasi file (image, max 2MB)
    $max_size = 2 * 1024 * 1024; // 2MB
    $allowed_types = ['image/jpeg', 'image/png'];
    
    if ($file['size'] > $max_size) {
        throw new Exception('Ukuran foto maksimal 2MB');
    }
    
    if (!in_array($file['type'], $allowed_types)) {
        throw new Exception('Format foto hanya JPG atau PNG');
    }

    // 3. Validasi dengan getimagesize
    $image_info = getimagesize($file['tmp_name']);
    if ($image_info === false) {
        throw new Exception('File bukan merupakan gambar yang valid');
    }

    // 4. Get user data untuk delete foto lama
    $get_user = "SELECT foto_profil FROM users WHERE id_user = ?";
    $stmt = $pdo->prepare($get_user);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    
    $old_foto = $user['foto_profil'];

    // 5. Resize image (GD library)
    $upload_dir = __DIR__ . '/../../uploads/profil/';
    
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Load image sesuai type
    $image = null;
    if ($file['type'] === 'image/jpeg') {
        $image = imagecreatefromjpeg($file['tmp_name']);
    } elseif ($file['type'] === 'image/png') {
        $image = imagecreatefrompng($file['tmp_name']);
    }

    if ($image === false) {
        throw new Exception('Gagal memproses gambar');
    }

    // Resize ke 500x500
    $new_image = imagecreatetruecolor(500, 500);
    
    // Jika PNG, preserve transparency
    if ($file['type'] === 'image/png') {
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
        $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
        imagefilledrectangle($new_image, 0, 0, 500, 500, $transparent);
    }

    imagecopyresampled($new_image, $image, 0, 0, 0, 0, 500, 500, imagesx($image), imagesy($image));
    imagedestroy($image);

    // 6. Generate filename unik
    $timestamp = time();
    $ext = ($file['type'] === 'image/jpeg') ? 'jpg' : 'png';
    $filename = 'profil_' . $user_id . '_' . $timestamp . '.' . $ext;
    $file_path = $upload_dir . $filename;

    // Save resized image
    if ($ext === 'jpg') {
        imagejpeg($new_image, $file_path, 90);
    } else {
        imagepng($new_image, $file_path);
    }
    imagedestroy($new_image);

    // 7. Delete foto lama jika ada
    if (!empty($old_foto)) {
        $old_path = $upload_dir . $old_foto;
        if (file_exists($old_path)) {
            unlink($old_path);
        }
    }

    // 8. Update foto_profil di users
    $update = "UPDATE users SET foto_profil = ? WHERE id_user = ?";
    $stmt = $pdo->prepare($update);
    $stmt->execute([$filename, $user_id]);

    // Return JSON success dengan URL foto
    $response['success'] = true;
    $response['message'] = 'Foto profil berhasil diupload';
    $response['data'] = [
        'filename' => $filename,
        'foto_url' => '/uploads/profil/' . $filename
    ];

} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
