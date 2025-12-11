<?php
session_start();
require_once '../config/database.php';
require_once '../backend/auth/session-helper.php';

// Security check - hanya dosen yang bisa akses
requireDosen();

$dosenId = getUserId();
$stats = [];
$testResults = [];

// Get all kelas milik dosen ini
$stmt = $pdo->prepare("
    SELECT k.id_kelas, k.nama_matakuliah, k.kode_matakuliah,
           COUNT(DISTINCT m.id_materi) as total_materi,
           COUNT(DISTINCT CASE WHEN m.tipe='pdf' THEN m.id_materi END) as total_pdf,
           COUNT(DISTINCT CASE WHEN m.tipe='video' THEN m.id_materi END) as total_video
    FROM kelas k
    LEFT JOIN materi m ON k.id_kelas = m.id_kelas
    WHERE k.id_dosen = ?
    GROUP BY k.id_kelas, k.nama_matakuliah, k.kode_matakuliah
    ORDER BY k.created_at DESC
");
$stmt->execute([$dosenId]);
$kelas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Materi Integration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .test-item { transition: all 0.3s ease; }
        .test-item:hover { transform: translateX(5px); }
        .status-pass { color: #10b981; }
        .status-fail { color: #ef4444; }
        .status-pending { color: #f59e0b; }
        
        .code-block {
            background: #1f2937;
            color: #e5e7eb;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow-x: auto;
            font-family: 'Monaco', 'Courier New', monospace;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .test-console {
            background: #111827;
            color: #10b981;
            padding: 1.5rem;
            border-radius: 0.5rem;
            font-family: 'Monaco', monospace;
            font-size: 0.75rem;
            max-height: 300px;
            overflow-y: auto;
            border: 2px solid #374151;
        }

        .console-log { color: #9ca3af; }
        .console-error { color: #ef4444; }
        .console-success { color: #10b981; }
        .console-warn { color: #f59e0b; }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-200 via-purple-200 to-pink-300 min-h-screen">

    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-lg border-b border-pink-200 sticky top-0 z-40 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">Test Suite: Materi Integration</h1>
                </div>
                <a href="dashboard-dosen.php" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">← Kembali</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">

        <!-- Overview Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">📋 Daftar Tes Integrasi Materi</h2>
            <p class="text-gray-600 mb-6">Halaman ini membantu menguji semua fitur upload materi, validasi, dan keamanan</p>

            <!-- Test Checklist -->
            <div class="space-y-3">
                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg test-item">
                    <input type="checkbox" id="test-1" class="w-5 h-5 rounded">
                    <label for="test-1" class="flex-1 font-semibold text-gray-700">✅ File PDF Upload (Valid File)</label>
                    <span class="text-sm text-gray-500">Status: <span class="status-pending">Pending</span></span>
                </div>

                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg test-item">
                    <input type="checkbox" id="test-2" class="w-5 h-5 rounded">
                    <label for="test-2" class="flex-1 font-semibold text-gray-700">❌ File Non-PDF Rejection (Validation)</label>
                    <span class="text-sm text-gray-500">Status: <span class="status-pending">Pending</span></span>
                </div>

                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg test-item">
                    <input type="checkbox" id="test-3" class="w-5 h-5 rounded">
                    <label for="test-3" class="flex-1 font-semibold text-gray-700">📏 File Size Validation (>10MB Reject)</label>
                    <span class="text-sm text-gray-500">Status: <span class="status-pending">Pending</span></span>
                </div>

                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg test-item">
                    <input type="checkbox" id="test-4" class="w-5 h-5 rounded">
                    <label for="test-4" class="flex-1 font-semibold text-gray-700">🎬 YouTube Video Link (Add Video)</label>
                    <span class="text-sm text-gray-500">Status: <span class="status-pending">Pending</span></span>
                </div>

                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg test-item">
                    <input type="checkbox" id="test-5" class="w-5 h-5 rounded">
                    <label for="test-5" class="flex-1 font-semibold text-gray-700">🚗 Google Drive Video Link</label>
                    <span class="text-sm text-gray-500">Status: <span class="status-pending">Pending</span></span>
                </div>

                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg test-item">
                    <input type="checkbox" id="test-6" class="w-5 h-5 rounded">
                    <label for="test-6" class="flex-1 font-semibold text-gray-700">🔗 Invalid URL Rejection</label>
                    <span class="text-sm text-gray-500">Status: <span class="status-pending">Pending</span></span>
                </div>

                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg test-item">
                    <input type="checkbox" id="test-7" class="w-5 h-5 rounded">
                    <label for="test-7" class="flex-1 font-semibold text-gray-700">✏️ Edit Materi (Metadata)</label>
                    <span class="text-sm text-gray-500">Status: <span class="status-pending">Pending</span></span>
                </div>

                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg test-item">
                    <input type="checkbox" id="test-8" class="w-5 h-5 rounded">
                    <label for="test-8" class="flex-1 font-semibold text-gray-700">🗑️ Delete Materi (Remove File + DB)</label>
                    <span class="text-sm text-gray-500">Status: <span class="status-pending">Pending</span></span>
                </div>

                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg test-item">
                    <input type="checkbox" id="test-9" class="w-5 h-5 rounded">
                    <label for="test-9" class="flex-1 font-semibold text-gray-700">🔐 Security: Direct URL Access (id_kelas missing)</label>
                    <span class="text-sm text-gray-500">Status: <span class="status-pending">Pending</span></span>
                </div>

                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg test-item">
                    <input type="checkbox" id="test-10" class="w-5 h-5 rounded">
                    <label for="test-10" class="flex-1 font-semibold text-gray-700">📊 Progress Bar Display (Upload Indicator)</label>
                    <span class="text-sm text-gray-500">Status: <span class="status-pending">Pending</span></span>
                </div>
            </div>
        </div>

        <!-- Select Kelas untuk Testing -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">🎯 Pilih Kelas untuk Test</h3>
            <p class="text-gray-600 mb-4">Gunakan kelas ini untuk menjalankan test upload materi</p>

            <?php if (empty($kelas)): ?>
                <div class="p-4 bg-yellow-50 border-2 border-yellow-200 rounded-lg">
                    <p class="text-yellow-700">⚠️ Anda belum memiliki kelas. Silakan buat kelas terlebih dahulu di Dashboard</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($kelas as $k): ?>
                        <div class="p-6 bg-gradient-to-br from-pink-50 to-purple-50 border-2 border-pink-200 rounded-xl hover:border-purple-400 transition-all cursor-pointer group" onclick="selectKelas(<?php echo $k['id_kelas']; ?>, '<?php echo htmlspecialchars($k['nama_matakuliah']); ?>')">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 group-hover:text-purple-600 transition-colors"><?php echo htmlspecialchars($k['nama_matakuliah']); ?></h4>
                                    <p class="text-sm text-gray-600"><?php echo htmlspecialchars($k['kode_matakuliah']); ?></p>
                                </div>
                                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold shadow-md group-hover:shadow-lg transition-shadow">
                                    →
                                </div>
                            </div>
                            <div class="flex gap-3 text-xs font-semibold text-gray-700 pt-3 border-t border-pink-200">
                                <span>📄 <?php echo $k['total_pdf']; ?> PDF</span>
                                <span>🎥 <?php echo $k['total_video']; ?> Video</span>
                                <span>📦 <?php echo $k['total_materi']; ?> Total</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Test Console -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">🖥️ Test Console</h3>
            <div class="test-console" id="testConsole">
                <div class="console-log">$ Waiting for tests to run...</div>
            </div>
            <button onclick="clearConsole()" class="mt-4 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">Clear Console</button>
        </div>

        <!-- Backend Validation Information -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">⚙️ Backend Validation Rules</h3>

            <div class="space-y-4">
                <!-- PDF Validation -->
                <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                    <h4 class="font-bold text-red-900 mb-2">📄 PDF Validation (upload-materi.php)</h4>
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        <li>File type: <code class="bg-red-100 px-2 py-1 rounded">application/pdf</code></li>
                        <li>Max size: <code class="bg-red-100 px-2 py-1 rounded">10 MB</code></li>
                        <li>File extension check: Must be <code class="bg-red-100 px-2 py-1 rounded">.pdf</code></li>
                        <li>Storage: <code class="bg-red-100 px-2 py-1 rounded">/uploads/materi/materi_[id_kelas]_[timestamp].pdf</code></li>
                    </ul>
                </div>

                <!-- Video Validation -->
                <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                    <h4 class="font-bold text-blue-900 mb-2">🎥 Video Link Validation (add-video.php)</h4>
                    <ul class="list-disc list-inside text-sm text-blue-700 space-y-1">
                        <li>YouTube: <code class="bg-blue-100 px-2 py-1 rounded">youtube.com/watch?v=... or youtu.be/...</code></li>
                        <li>Google Drive: <code class="bg-blue-100 px-2 py-1 rounded">drive.google.com/file/d/.../view</code></li>
                        <li>URL validation: Regex pattern matching</li>
                        <li>Public access: Required for embeds to work</li>
                    </ul>
                </div>

                <!-- Security -->
                <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                    <h4 class="font-bold text-green-900 mb-2">🔐 Security Checks</h4>
                    <ul class="list-disc list-inside text-sm text-green-700 space-y-1">
                        <li><code class="bg-green-100 px-2 py-1 rounded">session-check.php</code>: Validates X-Session-ID header</li>
                        <li><code class="bg-green-100 px-2 py-1 rounded">requireDosen()</code>: Ensures only dosen can access</li>
                        <li>Ownership verification: Dosen can only edit own kelas</li>
                        <li>URL parameter validation: id_kelas must be numeric</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- API Endpoints Documentation -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">🔌 API Endpoints</h3>

            <div class="space-y-4">
                <div class="border-l-4 border-pink-500 p-4 bg-pink-50 rounded-lg">
                    <h4 class="font-bold text-gray-900 mb-2">POST /backend/materi/upload-materi.php</h4>
                    <p class="text-sm text-gray-600 mb-2">Upload file PDF</p>
                    <div class="code-block">
<pre>Request:
  - Form Data:
    - file: File (application/pdf, max 10MB)
    - id_kelas: number
    - judul: string
    - deskripsi: string (optional)
    - pertemuan_ke: number

Response:
  {
    "success": true|false,
    "message": "string",
    "data": {
      "id_materi": number,
      "file_path": "string"
    }
  }</pre>
                    </div>
                </div>

                <div class="border-l-4 border-blue-500 p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-bold text-gray-900 mb-2">POST /backend/materi/add-video.php</h4>
                    <p class="text-sm text-gray-600 mb-2">Add video link (YouTube/Google Drive)</p>
                    <div class="code-block">
<pre>Request:
  - Form Data:
    - video_url: string (YouTube or Google Drive URL)
    - id_kelas: number
    - judul: string
    - deskripsi: string (optional)
    - pertemuan_ke: number

Response:
  {
    "success": true|false,
    "message": "string",
    "data": {
      "id_materi": number,
      "video_url": "string"
    }
  }</pre>
                    </div>
                </div>

                <div class="border-l-4 border-red-500 p-4 bg-red-50 rounded-lg">
                    <h4 class="font-bold text-gray-900 mb-2">POST /backend/materi/delete-materi.php</h4>
                    <p class="text-sm text-gray-600 mb-2">Delete materi (remove file + DB record)</p>
                    <div class="code-block">
<pre>Request:
  {
    "id_materi": number
  }

Response:
  {
    "success": true|false,
    "message": "string"
  }</pre>
                    </div>
                </div>

                <div class="border-l-4 border-purple-500 p-4 bg-purple-50 rounded-lg">
                    <h4 class="font-bold text-gray-900 mb-2">PATCH /backend/materi/update-materi.php</h4>
                    <p class="text-sm text-gray-600 mb-2">Update materi metadata</p>
                    <div class="code-block">
<pre>Request:
  {
    "id_materi": number,
    "judul": string (optional),
    "deskripsi": string (optional),
    "pertemuan_ke": number (optional),
    "file": File (optional - for PDF replacement)
  }

Response:
  {
    "success": true|false,
    "message": "string"
  }</pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- Important Notes -->
        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-2xl p-8 mb-8">
            <h3 class="text-2xl font-bold text-yellow-900 mb-4">⚠️ Important Testing Notes</h3>
            <ul class="list-disc list-inside text-yellow-700 space-y-2">
                <li><strong>Session Required:</strong> All tests require valid authentication. Must be logged in as Dosen.</li>
                <li><strong>X-Session-ID Header:</strong> All API calls include <code class="bg-yellow-100 px-2 py-1 rounded">X-Session-ID</code> from localStorage</li>
                <li><strong>Progress Bar:</strong> During PDF upload, progress bar shows upload percentage 0-100%</li>
                <li><strong>File Validation:</strong> Frontend validates before upload, backend validates on receive</li>
                <li><strong>URL Security:</strong> Direct access to kelola-materi.php without id_kelas parameter redirects to dashboard</li>
                <li><strong>Video Links:</strong> Must be publicly accessible for embeds to work</li>
                <li><strong>Storage:</strong> Uploaded files stored in <code class="bg-yellow-100 px-2 py-1 rounded">/uploads/materi/</code></li>
            </ul>
        </div>

    </main>

    <script>
        // ===== CONSOLE LOGGING =====
        const testConsole = document.getElementById('testConsole');
        
        function log(message, type = 'log') {
            const timestamp = new Date().toLocaleTimeString();
            const className = {
                'log': 'console-log',
                'error': 'console-error',
                'success': 'console-success',
                'warn': 'console-warn'
            }[type] || 'console-log';
            
            const line = document.createElement('div');
            line.className = className;
            line.textContent = `[${timestamp}] ${message}`;
            testConsole.appendChild(line);
            testConsole.scrollTop = testConsole.scrollHeight;
        }

        function clearConsole() {
            testConsole.innerHTML = '<div class="console-log">$ Console cleared</div>';
        }

        // ===== SELECT KELAS =====
        function selectKelas(id_kelas, nama) {
            log(`Selected kelas: ${nama} (ID: ${id_kelas})`, 'success');
            window.location.href = `kelola-materi.php?id_kelas=${id_kelas}`;
        }

        // ===== INITIAL MESSAGE =====
        window.addEventListener('load', () => {
            log('Test Suite Loaded ✓', 'success');
            log('Select a kelas to begin testing', 'log');
        });
    </script>

</body>
</html>
