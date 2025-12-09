/**
 * KELAS DOSEN - AJAX Integration
 * Mengelola CRUD kelas dan integrasi dengan backend
 */

let currentEditingKelasId = null;

// Initialize saat page load
document.addEventListener('DOMContentLoaded', async function() {
    // Check session
    const response = await fetch('../backend/auth/session-check.php');
    const data = await response.json();
    
    if (!data.success || data.role !== 'dosen') {
        window.location.href = '../pages/login.html';
        return;
    }

    // Set nama user
    document.getElementById('namaUser').textContent = data.nama || 'User';

    // Load kelas list
    loadKelasList();

    // Form submit handler
    document.getElementById('classForm').addEventListener('submit', handleFormSubmit);
});

/**
 * Load semua kelas yang dibuat dosen
 */
async function loadKelasList() {
    try {
        const response = await fetch('../backend/kelas/get-kelas-dosen.php');
        const data = await response.json();

        // Hide loading
        document.getElementById('loadingState').classList.add('hidden');

        if (data.success && data.data.length > 0) {
            renderKelasList(data.data);
            document.getElementById('kelasContainer').classList.remove('hidden');
            document.getElementById('emptyState').classList.add('hidden');
        } else {
            document.getElementById('kelasContainer').classList.add('hidden');
            document.getElementById('emptyState').classList.remove('hidden');
        }
    } catch (error) {
        console.error('Error loading kelas:', error);
        showAlert('error', 'Gagal memuat data kelas');
        document.getElementById('loadingState').classList.add('hidden');
        document.getElementById('emptyState').classList.remove('hidden');
    }
}

/**
 * Render kelas list ke HTML
 */
function renderKelasList(kelasList) {
    const container = document.getElementById('kelasContainer');
    container.innerHTML = '';

    kelasList.forEach(kelas => {
        const card = document.createElement('div');
        card.className = 'bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow';
        card.innerHTML = `
            <div class="mb-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">${escapeHtml(kelas.nama_matakuliah)}</h3>
                        <p class="text-sm text-gray-500">${escapeHtml(kelas.kode_matakuliah)}</p>
                    </div>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        ${escapeHtml(kelas.kode_kelas)}
                    </span>
                </div>
                
                <p class="text-gray-600 text-sm mb-3">${escapeHtml(kelas.deskripsi || 'Tidak ada deskripsi')}</p>
                
                <div class="grid grid-cols-3 gap-2 text-sm mb-4">
                    <div class="bg-gray-50 p-2 rounded">
                        <p class="text-gray-600">Semester</p>
                        <p class="font-semibold">${escapeHtml(kelas.semester)}</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded">
                        <p class="text-gray-600">Tahun</p>
                        <p class="font-semibold">${escapeHtml(kelas.tahun_ajaran)}</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded">
                        <p class="text-gray-600">Mahasiswa</p>
                        <p class="font-semibold">${kelas.jumlah_mahasiswa}/${kelas.kapasitas}</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-2">
                <button onclick="openEditModal(${kelas.id_kelas})" 
                    class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded flex items-center justify-center gap-2">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button onclick="openDeleteModal(${kelas.id_kelas}, '${escapeHtml(kelas.nama_matakuliah)}')" 
                    class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded flex items-center justify-center gap-2">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        `;
        container.appendChild(card);
    });
}

/**
 * Open modal untuk create kelas baru
 */
function openCreateModal() {
    currentEditingKelasId = null;
    document.getElementById('modalTitle').textContent = 'Tambah Kelas Baru';
    document.getElementById('id_kelas').value = '';
    document.getElementById('classForm').reset();
    document.getElementById('submitBtn').textContent = 'Simpan';
    document.getElementById('classModal').classList.remove('hidden');
}

/**
 * Open modal untuk edit kelas
 */
async function openEditModal(kelasId) {
    try {
        const response = await fetch('../backend/kelas/get-detail-kelas.php?id_kelas=' + kelasId);
        const data = await response.json();

        if (data.success) {
            const kelas = data.data;
            currentEditingKelasId = kelasId;
            
            document.getElementById('modalTitle').textContent = 'Edit Kelas';
            document.getElementById('id_kelas').value = kelas.id_kelas;
            document.getElementById('nama_matakuliah').value = kelas.nama_matakuliah;
            document.getElementById('kode_matakuliah').value = kelas.kode_matakuliah;
            document.getElementById('semester').value = kelas.semester;
            document.getElementById('tahun_ajaran').value = kelas.tahun_ajaran;
            document.getElementById('deskripsi').value = kelas.deskripsi || '';
            document.getElementById('kapasitas').value = kelas.kapasitas;
            document.getElementById('submitBtn').textContent = 'Update';
            
            document.getElementById('classModal').classList.remove('hidden');
        } else {
            showAlert('error', data.message || 'Gagal memuat detail kelas');
        }
    } catch (error) {
        console.error('Error loading kelas detail:', error);
        showAlert('error', 'Gagal memuat detail kelas');
    }
}

/**
 * Close modal
 */
function closeModal() {
    document.getElementById('classModal').classList.add('hidden');
    currentEditingKelasId = null;
}

/**
 * Handle form submit (Create/Update)
 */
async function handleFormSubmit(e) {
    e.preventDefault();

    const formData = {
        nama_matakuliah: document.getElementById('nama_matakuliah').value,
        kode_matakuliah: document.getElementById('kode_matakuliah').value,
        semester: document.getElementById('semester').value,
        tahun_ajaran: document.getElementById('tahun_ajaran').value,
        deskripsi: document.getElementById('deskripsi').value,
        kapasitas: document.getElementById('kapasitas').value
    };

    if (currentEditingKelasId) {
        formData.id_kelas = currentEditingKelasId;
        await updateKelas(formData);
    } else {
        await createKelas(formData);
    }
}

/**
 * Create kelas baru
 */
async function createKelas(formData) {
    try {
        const response = await fetch('../backend/kelas/create-kelas.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (data.success) {
            showAlert('success', 'Kelas berhasil dibuat! Kode kelas: ' + data.data.kode_kelas);
            closeModal();
            loadKelasList();
        } else {
            showAlert('error', data.message || 'Gagal membuat kelas');
        }
    } catch (error) {
        console.error('Error creating kelas:', error);
        showAlert('error', 'Gagal membuat kelas');
    }
}

/**
 * Update kelas
 */
async function updateKelas(formData) {
    try {
        const response = await fetch('../backend/kelas/update-kelas.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (data.success) {
            showAlert('success', 'Kelas berhasil diupdate');
            closeModal();
            loadKelasList();
        } else {
            showAlert('error', data.message || 'Gagal update kelas');
        }
    } catch (error) {
        console.error('Error updating kelas:', error);
        showAlert('error', 'Gagal update kelas');
    }
}

/**
 * Open delete confirmation modal
 */
function openDeleteModal(kelasId, kelasName) {
    currentEditingKelasId = kelasId;
    document.getElementById('deleteClassName').textContent = kelasName;
    document.getElementById('deleteModal').classList.remove('hidden');
}

/**
 * Close delete modal
 */
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    currentEditingKelasId = null;
}

/**
 * Confirm delete
 */
async function confirmDelete() {
    if (!currentEditingKelasId) return;

    try {
        const response = await fetch('../backend/kelas/delete-kelas.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id_kelas: currentEditingKelasId
            })
        });

        const data = await response.json();

        if (data.success) {
            showAlert('success', 'Kelas dan semua data terkait berhasil dihapus');
            closeDeleteModal();
            loadKelasList();
        } else {
            showAlert('error', data.message || 'Gagal menghapus kelas');
        }
    } catch (error) {
        console.error('Error deleting kelas:', error);
        showAlert('error', 'Gagal menghapus kelas');
    }
}

/**
 * Logout user
 */
function logoutUser() {
    window.location.href = '../backend/auth/logout.php';
}

/**
 * Show alert message
 */
function showAlert(type, message) {
    const container = document.getElementById('alertContainer');
    const alert = document.createElement('div');
    
    const bgColor = {
        'success': 'bg-green-500',
        'error': 'bg-red-500',
        'warning': 'bg-yellow-500',
        'info': 'bg-blue-500'
    }[type] || 'bg-gray-500';

    alert.className = `${bgColor} text-white px-6 py-4 rounded-lg shadow-lg mb-2 flex justify-between items-center`;
    alert.innerHTML = `
        <span>${message}</span>
        <button onclick="this.parentElement.remove()" class="text-white hover:text-gray-200">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    container.appendChild(alert);

    // Auto remove after 5 seconds
    setTimeout(() => alert.remove(), 5000);
}

/**
 * Escape HTML special characters
 */
function escapeHtml(text) {
    if (!text) return '';
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}
