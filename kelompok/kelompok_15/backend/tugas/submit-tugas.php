<?php
/**
 * FITUR 7: SUBMIT TUGAS - SUBMIT
 * Tanggung Jawab: ELISA (Database Engineer & Backend)
 * 
 * Deskripsi: Mahasiswa submit tugas
 * - Validasi deadline belum lewat
 * - Validasi file (format, size sesuai ketentuan tugas)
 * - Cek duplicate submission (allow update)
 * - Upload file ke /uploads/tugas/
 * - Rename: tugas_[id_tugas]_[npm]_[timestamp].ext
 * - Insert/update record submission_tugas
 * - Set status 'submitted' atau 'late'
 */

// TODO: Implement submit tugas
// 1. Cek session mahasiswa
// 2. Validasi input POST (id_tugas, keterangan)
// 3. Query tugas untuk get deadline & allowed_formats
// 4. Validasi deadline
// 5. Validasi file (format & size)
// 6. Generate filename unik
// 7. Upload file
// 8. Insert/update submission_tugas
// 9. Set status (submitted jika <= deadline, late jika > deadline)
// 10. Return JSON success/error

?>
