<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kelas - Integration Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .api-card { transition: all 0.3s; }
        .api-card:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .test-result { max-height: 300px; overflow-y: auto; }
        .success { background-color: #dcfce7; color: #166534; }
        .error { background-color: #fee2e2; color: #991b1b; }
        .pending { background-color: #fef3c7; color: #92400e; }
    </style>
</head>
<body class="bg-gray-900 text-white p-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold mb-2 text-blue-400">Kelola Kelas - Integration Test</h1>
        <p class="text-gray-400 mb-8">Test semua endpoint backend API</p>

        <!-- API Test Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <!-- Materi Tests -->
            <div class="api-card border-2 border-pink-500 rounded-lg p-6 bg-gray-800">
                <h3 class="text-xl font-bold mb-4 text-pink-400">📚 MATERI ENDPOINTS</h3>
                <div class="space-y-2">
                    <button onclick="testGetMateri()" class="w-full bg-pink-600 hover:bg-pink-700 px-4 py-2 rounded text-sm">GET Materi</button>
                    <button onclick="testUploadMateri()" class="w-full bg-pink-600 hover:bg-pink-700 px-4 py-2 rounded text-sm">POST Upload Materi</button>
                    <button onclick="testUpdateMateri()" class="w-full bg-pink-600 hover:bg-pink-700 px-4 py-2 rounded text-sm">POST Update Materi</button>
                    <button onclick="testDeleteMateri()" class="w-full bg-pink-600 hover:bg-pink-700 px-4 py-2 rounded text-sm">POST Delete Materi</button>
                </div>
                <div id="materi-result" class="test-result bg-gray-700 rounded mt-4 p-3 text-xs hidden"></div>
            </div>

            <!-- Tugas Tests -->
            <div class="api-card border-2 border-purple-500 rounded-lg p-6 bg-gray-800">
                <h3 class="text-xl font-bold mb-4 text-purple-400">📋 TUGAS ENDPOINTS</h3>
                <div class="space-y-2">
                    <button onclick="testCreateTugas()" class="w-full bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded text-sm">POST Create Tugas</button>
                    <button onclick="testGetTugas()" class="w-full bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded text-sm">GET Tugas</button>
                    <button onclick="testUpdateTugas()" class="w-full bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded text-sm">POST Update Tugas</button>
                    <button onclick="testDeleteTugas()" class="w-full bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded text-sm">POST Delete Tugas</button>
                </div>
                <div id="tugas-result" class="test-result bg-gray-700 rounded mt-4 p-3 text-xs hidden"></div>
            </div>

            <!-- Mahasiswa Tests -->
            <div class="api-card border-2 border-blue-500 rounded-lg p-6 bg-gray-800">
                <h3 class="text-xl font-bold mb-4 text-blue-400">👥 MAHASISWA ENDPOINTS</h3>
                <div class="space-y-2">
                    <button onclick="testEnrollMahasiswa()" class="w-full bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-sm">POST Enroll Mahasiswa</button>
                    <button onclick="testGetMahasiswa()" class="w-full bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-sm">GET Mahasiswa</button>
                    <button onclick="testUnenrollMahasiswa()" class="w-full bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-sm">POST Unenroll Mahasiswa</button>
                </div>
                <div id="mahasiswa-result" class="test-result bg-gray-700 rounded mt-4 p-3 text-xs hidden"></div>
            </div>

            <!-- Nilai Tests -->
            <div class="api-card border-2 border-green-500 rounded-lg p-6 bg-gray-800">
                <h3 class="text-xl font-bold mb-4 text-green-400">⭐ NILAI ENDPOINTS</h3>
                <div class="space-y-2">
                    <button onclick="testInputNilai()" class="w-full bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-sm">POST Input Nilai</button>
                    <button onclick="testGetNilai()" class="w-full bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-sm">GET Nilai</button>
                    <button onclick="testUpdateNilai()" class="w-full bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-sm">POST Update Nilai</button>
                </div>
                <div id="nilai-result" class="test-result bg-gray-700 rounded mt-4 p-3 text-xs hidden"></div>
            </div>
        </div>

        <!-- Test Summary -->
        <div class="border-2 border-gray-700 rounded-lg p-6 bg-gray-800">
            <h3 class="text-lg font-bold mb-4">📊 Test Summary</h3>
            <div class="grid grid-cols-4 gap-4">
                <div class="bg-green-900 rounded p-4 text-center">
                    <div class="text-2xl font-bold" id="passed-count">0</div>
                    <div class="text-sm text-gray-400">Passed</div>
                </div>
                <div class="bg-red-900 rounded p-4 text-center">
                    <div class="text-2xl font-bold" id="failed-count">0</div>
                    <div class="text-sm text-gray-400">Failed</div>
                </div>
                <div class="bg-yellow-900 rounded p-4 text-center">
                    <div class="text-2xl font-bold" id="pending-count">0</div>
                    <div class="text-sm text-gray-400">Pending</div>
                </div>
                <div class="bg-blue-900 rounded p-4 text-center">
                    <div class="text-2xl font-bold" id="total-count">0</div>
                    <div class="text-sm text-gray-400">Total</div>
                </div>
            </div>
        </div>

        <!-- Test Log -->
        <div class="mt-8 border-2 border-gray-700 rounded-lg p-6 bg-gray-800">
            <h3 class="text-lg font-bold mb-4">📝 Test Log</h3>
            <div id="test-log" class="bg-gray-900 rounded p-4 h-96 overflow-y-auto font-mono text-xs"></div>
        </div>
    </div>

    <script>
        let testResults = [];
        let idKelas = null;
        let idMateri = null;
        let idTugas = null;
        let idMahasiswa = 2; // Assume student ID

        // apiFetch helper
        async function apiFetch(url, options = {}) {
            const sessionId = localStorage.getItem('sessionId');
            const defaultHeaders = {
                'Content-Type': 'application/json',
                'X-Session-ID': sessionId || ''
            };
            
            return fetch(url, {
                ...options,
                headers: { ...defaultHeaders, ...options.headers },
                credentials: 'include'
            });
        }

        // Logging
        function log(message, type = 'info') {
            const logEl = document.getElementById('test-log');
            const time = new Date().toLocaleTimeString();
            logEl.innerHTML += `<div class="${type === 'success' ? 'text-green-400' : type === 'error' ? 'text-red-400' : 'text-gray-400'}">[${time}] ${message}</div>`;
            logEl.scrollTop = logEl.scrollHeight;
        }

        // Record test result
        function recordTest(name, status, details = '') {
            const result = { name, status, details };
            testResults.push(result);
            updateSummary();
            
            const type = status === 'passed' ? 'success' : status === 'failed' ? 'error' : 'info';
            log(`${name}: ${status.toUpperCase()} ${details}`, type);
        }

        // Update summary
        function updateSummary() {
            const passed = testResults.filter(r => r.status === 'passed').length;
            const failed = testResults.filter(r => r.status === 'failed').length;
            const pending = testResults.filter(r => r.status === 'pending').length;
            const total = testResults.length;

            document.getElementById('passed-count').textContent = passed;
            document.getElementById('failed-count').textContent = failed;
            document.getElementById('pending-count').textContent = pending;
            document.getElementById('total-count').textContent = total;
        }

        // Show result
        function showResult(elementId, success, data) {
            const el = document.getElementById(elementId);
            el.classList.remove('hidden');
            el.className = `test-result bg-gray-700 rounded mt-4 p-3 text-xs ${success ? 'success' : 'error'}`;
            el.textContent = JSON.stringify(data, null, 2);
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', async function() {
            const params = new URLSearchParams(window.location.search);
            idKelas = params.get('id_kelas');
            
            if (!idKelas) {
                // Try to get from dashboard
                const resp = await apiFetch('../backend/dashboard/get-statistik-kelas.php');
                const data = await resp.json();
                if (data.data && data.data.length > 0) {
                    idKelas = data.data[0].id_kelas;
                    log(`Kelas loaded: ${idKelas}`);
                }
            }
            
            if (!idKelas) {
                log('Kelas ID not found. Please provide ?id_kelas=X', 'error');
                return;
            }

            log(`Testing with id_kelas: ${idKelas}`);
        });

        // ============== MATERI TESTS ==============
        async function testGetMateri() {
            recordTest('GET Materi', 'pending');
            try {
                const response = await apiFetch(`../backend/materi/get-materi.php?id_kelas=${idKelas}`);
                const data = await response.json();
                
                if (response.ok && data.success) {
                    idMateri = data.data?.[0]?.id_materi;
                    recordTest('GET Materi', 'passed', `Found ${data.data.length} materi`);
                    showResult('materi-result', true, data.data);
                } else {
                    recordTest('GET Materi', 'failed', data.message);
                    showResult('materi-result', false, data);
                }
            } catch (e) {
                recordTest('GET Materi', 'failed', e.message);
                showResult('materi-result', false, { error: e.message });
            }
        }

        async function testUploadMateri() {
            recordTest('POST Upload Materi', 'pending');
            try {
                const response = await apiFetch('../backend/materi/upload-materi.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        id_kelas: idKelas,
                        judul: 'Test Materi ' + new Date().getTime(),
                        deskripsi: 'Test deskripsi',
                        pertemuan_ke: 1,
                        file_path: 'https://example.com/test.pdf'
                    })
                });
                
                const data = await response.json();
                if (response.ok && data.success) {
                    idMateri = data.id_materi;
                    recordTest('POST Upload Materi', 'passed', `ID: ${data.id_materi}`);
                    showResult('materi-result', true, data);
                } else {
                    recordTest('POST Upload Materi', 'failed', data.message);
                    showResult('materi-result', false, data);
                }
            } catch (e) {
                recordTest('POST Upload Materi', 'failed', e.message);
                showResult('materi-result', false, { error: e.message });
            }
        }

        async function testUpdateMateri() {
            if (!idMateri) {
                recordTest('POST Update Materi', 'failed', 'No id_materi');
                return;
            }
            
            recordTest('POST Update Materi', 'pending');
            try {
                const response = await apiFetch('../backend/materi/update-materi.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        id_materi: idMateri,
                        judul: 'Updated Materi ' + new Date().getTime(),
                        deskripsi: 'Updated deskripsi',
                        pertemuan_ke: 1
                    })
                });
                
                const data = await response.json();
                if (response.ok && data.success) {
                    recordTest('POST Update Materi', 'passed');
                    showResult('materi-result', true, data);
                } else {
                    recordTest('POST Update Materi', 'failed', data.message);
                    showResult('materi-result', false, data);
                }
            } catch (e) {
                recordTest('POST Update Materi', 'failed', e.message);
                showResult('materi-result', false, { error: e.message });
            }
        }

        async function testDeleteMateri() {
            if (!idMateri) {
                recordTest('POST Delete Materi', 'failed', 'No id_materi');
                return;
            }
            
            recordTest('POST Delete Materi', 'pending');
            try {
                const response = await apiFetch('../backend/materi/delete-materi.php', {
                    method: 'POST',
                    body: JSON.stringify({ id_materi: idMateri })
                });
                
                const data = await response.json();
                if (response.ok && data.success) {
                    idMateri = null;
                    recordTest('POST Delete Materi', 'passed');
                    showResult('materi-result', true, data);
                } else {
                    recordTest('POST Delete Materi', 'failed', data.message);
                    showResult('materi-result', false, data);
                }
            } catch (e) {
                recordTest('POST Delete Materi', 'failed', e.message);
                showResult('materi-result', false, { error: e.message });
            }
        }

        // ============== TUGAS TESTS ==============
        async function testCreateTugas() {
            recordTest('POST Create Tugas', 'pending');
            try {
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                
                const response = await apiFetch('../backend/tugas/create-tugas.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        id_kelas: idKelas,
                        judul: 'Test Tugas ' + new Date().getTime(),
                        deskripsi: 'Test deskripsi tugas',
                        deadline: tomorrow.toISOString(),
                        bobot: 10
                    })
                });
                
                const data = await response.json();
                if (response.ok && data.success) {
                    idTugas = data.id_tugas;
                    recordTest('POST Create Tugas', 'passed', `ID: ${data.id_tugas}`);
                    showResult('tugas-result', true, data);
                } else {
                    recordTest('POST Create Tugas', 'failed', data.message);
                    showResult('tugas-result', false, data);
                }
            } catch (e) {
                recordTest('POST Create Tugas', 'failed', e.message);
                showResult('tugas-result', false, { error: e.message });
            }
        }

        async function testGetTugas() {
            recordTest('GET Tugas', 'pending');
            try {
                const response = await apiFetch(`../backend/tugas/get-tugas.php?id_kelas=${idKelas}`);
                const data = await response.json();
                
                if (response.ok && data.success) {
                    if (!idTugas && data.data?.length > 0) {
                        idTugas = data.data[0].id_tugas;
                    }
                    recordTest('GET Tugas', 'passed', `Found ${data.data.length} tugas`);
                    showResult('tugas-result', true, data.data);
                } else {
                    recordTest('GET Tugas', 'failed', data.message);
                    showResult('tugas-result', false, data);
                }
            } catch (e) {
                recordTest('GET Tugas', 'failed', e.message);
                showResult('tugas-result', false, { error: e.message });
            }
        }

        async function testUpdateTugas() {
            if (!idTugas) {
                recordTest('POST Update Tugas', 'failed', 'No id_tugas');
                return;
            }
            
            recordTest('POST Update Tugas', 'pending');
            try {
                const response = await apiFetch('../backend/tugas/update-tugas.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        id_tugas: idTugas,
                        judul: 'Updated Tugas ' + new Date().getTime(),
                        bobot: 15
                    })
                });
                
                const data = await response.json();
                if (response.ok && data.success) {
                    recordTest('POST Update Tugas', 'passed');
                    showResult('tugas-result', true, data);
                } else {
                    recordTest('POST Update Tugas', 'failed', data.message);
                    showResult('tugas-result', false, data);
                }
            } catch (e) {
                recordTest('POST Update Tugas', 'failed', e.message);
                showResult('tugas-result', false, { error: e.message });
            }
        }

        async function testDeleteTugas() {
            if (!idTugas) {
                recordTest('POST Delete Tugas', 'failed', 'No id_tugas');
                return;
            }
            
            recordTest('POST Delete Tugas', 'pending');
            try {
                const response = await apiFetch('../backend/tugas/delete-tugas.php', {
                    method: 'POST',
                    body: JSON.stringify({ id_tugas: idTugas })
                });
                
                const data = await response.json();
                if (response.ok && data.success) {
                    idTugas = null;
                    recordTest('POST Delete Tugas', 'passed');
                    showResult('tugas-result', true, data);
                } else {
                    recordTest('POST Delete Tugas', 'failed', data.message);
                    showResult('tugas-result', false, data);
                }
            } catch (e) {
                recordTest('POST Delete Tugas', 'failed', e.message);
                showResult('tugas-result', false, { error: e.message });
            }
        }

        // ============== MAHASISWA TESTS ==============
        async function testEnrollMahasiswa() {
            recordTest('POST Enroll Mahasiswa', 'pending');
            try {
                const response = await apiFetch('../backend/kelas/enroll-mahasiswa.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        id_kelas: idKelas,
                        id_mahasiswa: idMahasiswa
                    })
                });
                
                const data = await response.json();
                if (response.ok && data.success) {
                    recordTest('POST Enroll Mahasiswa', 'passed');
                    showResult('mahasiswa-result', true, data);
                } else {
                    recordTest('POST Enroll Mahasiswa', 'failed', data.message);
                    showResult('mahasiswa-result', false, data);
                }
            } catch (e) {
                recordTest('POST Enroll Mahasiswa', 'failed', e.message);
                showResult('mahasiswa-result', false, { error: e.message });
            }
        }

        async function testGetMahasiswa() {
            recordTest('GET Mahasiswa', 'pending');
            try {
                const response = await apiFetch(`../backend/kelas/get-mahasiswa-kelas.php?id_kelas=${idKelas}`);
                const data = await response.json();
                
                if (response.ok && data.success) {
                    recordTest('GET Mahasiswa', 'passed', `Found ${data.data.length} students`);
                    showResult('mahasiswa-result', true, data.data);
                } else {
                    recordTest('GET Mahasiswa', 'failed', data.message);
                    showResult('mahasiswa-result', false, data);
                }
            } catch (e) {
                recordTest('GET Mahasiswa', 'failed', e.message);
                showResult('mahasiswa-result', false, { error: e.message });
            }
        }

        async function testUnenrollMahasiswa() {
            recordTest('POST Unenroll Mahasiswa', 'pending');
            try {
                const response = await apiFetch('../backend/kelas/unenroll-mahasiswa.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        id_kelas: idKelas,
                        id_mahasiswa: idMahasiswa
                    })
                });
                
                const data = await response.json();
                if (response.ok && data.success) {
                    recordTest('POST Unenroll Mahasiswa', 'passed');
                    showResult('mahasiswa-result', true, data);
                } else {
                    recordTest('POST Unenroll Mahasiswa', 'failed', data.message);
                    showResult('mahasiswa-result', false, data);
                }
            } catch (e) {
                recordTest('POST Unenroll Mahasiswa', 'failed', e.message);
                showResult('mahasiswa-result', false, { error: e.message });
            }
        }

        // ============== NILAI TESTS ==============
        async function testInputNilai() {
            recordTest('POST Input Nilai', 'pending');
            // This requires a valid submission ID - skipping for now
            recordTest('POST Input Nilai', 'pending', 'Requires valid submission ID');
        }

        async function testGetNilai() {
            recordTest('GET Nilai', 'pending');
            try {
                const response = await apiFetch(`../backend/nilai/get-nilai.php?id_kelas=${idKelas}`);
                const data = await response.json();
                
                if (response.ok && data.success) {
                    recordTest('GET Nilai', 'passed', `Found ${data.data.length} grades`);
                    showResult('nilai-result', true, data.data);
                } else {
                    recordTest('GET Nilai', 'failed', data.message);
                    showResult('nilai-result', false, data);
                }
            } catch (e) {
                recordTest('GET Nilai', 'failed', e.message);
                showResult('nilai-result', false, { error: e.message });
            }
        }

        async function testUpdateNilai() {
            recordTest('POST Update Nilai', 'pending', 'Requires valid nilai ID');
        }
    </script>
</body>
</html>
