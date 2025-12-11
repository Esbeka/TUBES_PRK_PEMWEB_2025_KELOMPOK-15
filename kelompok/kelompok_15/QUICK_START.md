# ⚡ QUICK START GUIDE - Materi Management System

**Last Updated:** 2024-01-15
**Status:** ✅ Ready to Use

---

## 🚀 5-Minute Quick Start

### Step 1: Login (1 minute)
```
URL: http://localhost/TUGASAKHIR/kelompok/kelompok_15/pages/login.html

Dosen Account:
  Email: dosen@example.com
  Password: dosen123

Student Account:
  Email: mahasiswa@example.com
  Password: mahasiswa123
```

### Step 2: Navigate to Materi Management (1 minute)
```
1. You are now on dashboard-dosen.php
2. Click button: "Kelola Kelas"
3. Modal pops up showing your kelas
4. Click any kelas to select it
5. Auto redirects to: kelola-materi.php?id_kelas=1
```

### Step 3: Test Upload PDF (2 minutes)
```
1. Click "Tambah Materi" button (pink)
2. Tab "📄 Upload PDF" is active
3. Fill in:
   - Pertemuan Ke: 1
   - Judul Materi: "My First PDF"
   - Deskripsi: "Test PDF"
4. Select or drag PDF file
5. Click "Simpan Materi"
6. Watch progress bar 0% → 100%
7. Toast: "✅ PDF berhasil diupload"
8. Scroll down → Materi appears in list
```

### Step 4: Test Video Link (1 minute)
```
1. Click "Tambah Materi" again
2. Click tab "🎥 Link Video"
3. Fill in:
   - Pertemuan Ke: 1
   - Judul: "Tutorial Video"
   - Video URL: https://www.youtube.com/watch?v=dQw4w9WgXcQ
4. Click "Simpan Materi"
5. Video appears in list with video icon 🎥
```

---

## 🧪 Testing Checklist

Quick validation of all features:

```
UPLOAD & VALIDATION
  ☐ Upload valid PDF (2-5MB) → Success
  ☐ Try upload .txt file → "File harus berformat PDF"
  ☐ Try upload 15MB file → "Ukuran file terlalu besar"
  ☐ Progress bar shows 0% → 100%

VIDEO LINKS
  ☐ Add YouTube URL → Success, appears with 🎥 icon
  ☐ Add Google Drive URL → Success
  ☐ Try invalid URL → "URL harus dari YouTube atau Google Drive"

MATERI LIST
  ☐ All materi shown in list
  ☐ Grouped by pertemuan
  ☐ Shows PDF/Video icon
  ☐ Shows date created
  ☐ Edit & Delete buttons visible

SEARCH & FILTER
  ☐ Type in search → Filters by judul (real-time)
  ☐ Filter by pertemuan → Shows only that pertemuan
  ☐ Filter by type (PDF/Video) → Shows only that type

DELETE
  ☐ Click delete icon
  ☐ Confirm dialog appears
  ☐ After confirm → Materi disappears
  ☐ Toast: "✅ Materi berhasil dihapus"

STATISTICS
  ☐ Total Materi updates
  ☐ Total PDF count correct
  ☐ Total Video count correct
  ☐ Total Pertemuan count correct

SECURITY
  ☐ Access kelola-materi.php without id_kelas → Redirects to dashboard
  ☐ Each upload → Progress bar shows, session valid
```

---

## 📊 Feature Quick Reference

### Upload PDF
```
Button: "Tambah Materi" → Tab "📄 Upload PDF"
Validations: PDF only, max 10MB
Response: Progress bar + Success toast
```

### Add Video
```
Button: "Tambah Materi" → Tab "🎥 Link Video"
Supported: YouTube, Google Drive
Response: Instant add to list with video icon
```

### Search Materi
```
Text Input: "Cari materi..."
Real-time filtering by judul
Instant results
```

### Filter Options
```
Pertemuan: Dropdown with all pertemuan numbers
Type: PDF or Video
Combined filtering works
```

### Delete Materi
```
Click: Trash icon in each materi item
Confirm: Modal dialog required
Result: Materi removed + file deleted
```

### Edit Materi
```
Click: Pencil icon in each materi item
Note: Currently shows "Coming Soon" message
Backend: Fully implemented, frontend modal pending
```

---

## 🔧 Configuration Defaults

### File Upload
```
Max Size: 10 MB
Format: PDF only
Storage: /uploads/materi/
Naming: materi_[id_kelas]_[timestamp].pdf
```

### Session
```
Header: X-Session-ID
Storage: localStorage
Lifetime: Browser session
```

### Video Support
```
YouTube: youtube.com/watch?v=... or youtu.be/...
Google Drive: drive.google.com/file/d/.../view
Validation: Regex pattern matching
```

---

## 🆘 Quick Troubleshooting

### Problem: "Error memuat data kelas"
```
Solution:
  1. Check browser console (F12)
  2. Verify session still active
  3. Refresh page and try again
  4. Check network tab for failed requests
```

### Problem: Upload shows no progress
```
Solution:
  1. Check network connection
  2. File size < 10MB?
  3. File is PDF format?
  4. Try different file
  5. Clear browser cache
```

### Problem: Video link not appearing
```
Solution:
  1. Check URL is correct
  2. For YouTube: Use full watch URL
  3. For Google Drive: Ensure "Anyone with link" sharing
  4. Check file is publicly accessible
```

### Problem: Direct URL access blank
```
Solution:
  1. Check URL has id_kelas parameter
  2. Example: ?id_kelas=1
  3. id_kelas must be numeric
  4. Should auto-redirect if invalid
  5. Try accessing via "Kelola Kelas"
```

---

## 📚 Documentation Index

| Document | Purpose | Time |
|----------|---------|------|
| `MATERI_INTEGRATION_GUIDE.md` | Complete API reference | 30 min |
| `VERIFICATION_CHECKLIST.md` | Feature status & testing | 20 min |
| `README_MATERI_SYSTEM.md` | Project overview & setup | 20 min |
| `COMPLETION_SUMMARY.md` | What's been done | 15 min |
| `FILES_MODIFIED_CREATED.md` | Technical change log | 10 min |
| Quick Start (this file) | 5-minute setup | 5 min |

---

## 🎯 Common Tasks

### Task: Upload a PDF Lecture
```
1. Login as dosen
2. Kelola Kelas → Select class
3. Tambah Materi → Keep "📄 Upload PDF"
4. Fill: Pertemuan=2, Judul="Lecture 2", File=lecture.pdf
5. Simpan → Watch progress → Success!
```

### Task: Add YouTube Tutorial
```
1. Tambah Materi → Switch to "🎥 Link Video"
2. Paste: https://www.youtube.com/watch?v=xyz
3. Fill: Pertemuan, Judul
4. Simpan → Done!
```

### Task: Remove Old Material
```
1. Find materi in list
2. Click trash icon
3. Confirm delete
4. Done - file and DB record removed
```

### Task: Search for Specific Material
```
1. Type in "Cari materi..." box
2. Real-time filter shows matching
3. Click filter dropdowns for more options
```

---

## ⚡ Performance Tips

1. **Large Files:** Use 5-10MB files for testing
2. **Browser:** Chrome/Firefox recommended
3. **Connection:** Good internet for progress bar
4. **Cache:** Clear if issues arise (Ctrl+Shift+R)
5. **Session:** Logout/login if experiencing issues

---

## 📱 Browser Compatibility

✅ **Fully Supported:**
- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

---

## 🔑 API Keys & Headers

### For API Testing (Postman/curl):
```
Header: X-Session-ID
Value: [Get from localStorage after login]

Content-Type: application/json
```

### Example API Call:
```bash
curl -X GET \
  'http://localhost/TUGASAKHIR/kelompok/kelompok_15/backend/kelas/get-kelas-dosen.php' \
  -H 'X-Session-ID: [your-session-id]'
```

---

## 📞 Contact & Support

**For Issues:**
1. Check browser console (F12 → Console tab)
2. Read error messages carefully
3. Check network tab (F12 → Network)
4. Verify all prerequisites installed
5. Review documentation files

**Error Codes:**
- 401: Session invalid or expired → Re-login
- 403: Access denied → Check role
- 404: Endpoint not found → Check URL
- 500: Server error → Check logs

---

## ✅ You're All Set!

You now have:
- ✅ Working materi management system
- ✅ PDF upload with progress
- ✅ Video link support
- ✅ Search & filter functionality
- ✅ Complete documentation
- ✅ Test suite ready

### Next Steps:
1. Test all features from checklist
2. Read documentation for details
3. Review API endpoints if needed
4. Customize as needed for production

---

**Ready to go! 🚀**

*For detailed information, see other documentation files.*
