<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Tugas Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        // Drag & Drop
        function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }
        function highlight(e) { document.getElementById('drop-area').classList.add('border-blue-500'); }
        function unhighlight(e) { document.getElementById('drop-area').classList.remove('border-blue-500'); }
        function handleDrop(e) {
            let dt = e.dataTransfer;
            let files = dt.files;
            handleFiles(files);
        }
        function handleFiles(files) {
            if(files.length > 0) {
                const file = files[0];
                previewFile(file);
            }
        }
        function previewFile(file) {
            const allowed = ['pdf','doc','docx','ppt','pptx','zip','rar','jpg','jpeg','png','mp4'];
            const maxSize = 50 * 1024 * 1024;
            const ext = file.name.split('.').pop().toLowerCase();
            let preview = document.getElementById('file-preview');
            let warning = document.getElementById('warning');
            preview.innerHTML = '';
            warning.textContent = '';
            if(!allowed.includes(ext)) {
                warning.textContent = 'Format file tidak didukung!';
                return;
            }
            if(file.size > maxSize) {
                warning.textContent = 'Ukuran file melebihi 50MB!';
                return;
            }
            preview.innerHTML = `<div class='p-4 bg-gray-50 rounded-lg border mb-2'><b>${file.name}</b> <span class='text-xs text-gray-500'>(${(file.size/1024/1024).toFixed(2)} MB)</span></div>`;
            document.getElementById('progress-bar').style.width = '0%';
        }
        function uploadFile() {
            let input = document.getElementById('file-input');
            if(input.files.length === 0) {
                document.getElementById('warning').textContent = 'Pilih file terlebih dahulu!';
                return;
            }
            let file = input.files[0];
            previewFile(file);
            // Simulasi upload
            let progress = 0;
            let bar = document.getElementById('progress-bar');
            let interval = setInterval(() => {
                progress += 10;
                bar.style.width = progress + '%';
                if(progress >= 100) {
                    clearInterval(interval);
                    document.getElementById('warning').textContent = 'Upload berhasil!';
                }
            }, 200);
        }
        document.addEventListener('DOMContentLoaded', function() {
            let dropArea = document.getElementById('drop-area');
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });
            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });
            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });
            dropArea.addEventListener('drop', handleDrop, false);
        });
    </script>
</head>
<body class="bg-gradient-to-br from-purple-100 to-blue-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-xl">
        <h2 class="text-2xl font-bold text-purple-700 mb-4">Upload Tugas Mahasiswa</h2>
        <div class="mb-4">
            <div class="flex items-center gap-2 mb-2">
                <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded">DEADLINE: Hari Ini, 23:59</span>
                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded">Sisa waktu: <span id="countdown">2 Jam 15 Menit</span></span>
            </div>
            <div class="bg-red-50 border-l-4 border-red-600 p-3 rounded-r-lg mb-2">
                <span class="text-sm text-red-700 font-semibold">⚠️ Deadline sangat dekat! Segera upload tugas Anda.</span>
            </div>
        </div>
        <div id="drop-area" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer transition-all mb-4">
            <p class="text-gray-600 mb-2">Drag & drop file tugas di sini atau klik untuk memilih file</p>
            <input type="file" id="file-input" class="hidden" onchange="handleFiles(this.files)">
            <button onclick="document.getElementById('file-input').click()" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold shadow">Pilih File</button>
        </div>
        <div id="file-preview"></div>
        <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
            <div id="progress-bar" class="bg-gradient-to-r from-blue-600 to-purple-600 h-3 rounded-full" style="width:0%"></div>
        </div>
        <div id="warning" class="text-sm text-red-600 font-semibold mb-2"></div>
        <button onclick="uploadFile()" class="w-full py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white font-bold rounded-lg shadow-lg transition-all">Upload Tugas</button>
    </div>
</body>
</html>
