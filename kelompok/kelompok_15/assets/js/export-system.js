/**
 * ExportSystem - Advanced Export & Reporting Module
 * 
 * Features:
 * - Export to Excel/PDF
 * - Format selection modal
 * - Loading indicator with progress
 * - Download management
 * - Error handling
 * - Export history tracking
 * 
 * @version 1.0.0
 * @author Cindy - Frontend Developer
 */

class ExportSystem {
    constructor(options = {}) {
        // Configuration
        this.config = {
            exportEndpoint: '/backend/export/',
            maxRetries: 3,
            timeout: 30000, // 30 seconds
            showProgress: true,
            ...options
        };

        // DOM Elements
        this.modal = null;
        this.exportButtons = [];
        this.loadingOverlay = null;

        // State
        this.currentExport = {
            type: null,
            format: null,
            data: null,
            filename: null
        };

        this.isExporting = false;
        this.exportHistory = [];

        // Bind methods
        this.handleExportClick = this.handleExportClick.bind(this);
        this.handleFormatSelect = this.handleFormatSelect.bind(this);
        this.handleModalClose = this.handleModalClose.bind(this);
    }

    /**
     * Initialize the export system
     */
    init() {
        this.createModal();
        this.createLoadingOverlay();
        this.bindExportButtons();
        this.loadExportHistory();
        console.log('ExportSystem initialized');
    }

    /**
     * Create export modal HTML
     */
    createModal() {
        const modalHTML = `
            <div id="exportModal" class="export-modal">
                <div class="export-modal-overlay"></div>
                <div class="export-modal-content">
                    <div class="export-modal-header">
                        <h3 class="export-modal-title">
                            <svg class="export-modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Pilih Format Export
                        </h3>
                        <button class="export-modal-close" id="closeExportModal">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="export-modal-body">
                        <p class="export-description">
                            Pilih format file untuk mengekspor data. File akan otomatis terunduh setelah proses selesai.
                        </p>

                        <div class="export-format-grid">
                            <!-- Excel Format -->
                            <div class="export-format-card" data-format="excel">
                                <div class="export-format-icon excel-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h4 class="export-format-title">Excel</h4>
                                <p class="export-format-desc">Format spreadsheet (.xlsx)</p>
                                <ul class="export-format-features">
                                    <li>✓ Mudah diedit</li>
                                    <li>✓ Support formula</li>
                                    <li>✓ Kompatibel MS Excel</li>
                                </ul>
                                <button class="export-format-btn" data-format="excel">
                                    Pilih Excel
                                </button>
                            </div>

                            <!-- PDF Format -->
                            <div class="export-format-card" data-format="pdf">
                                <div class="export-format-icon pdf-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h4 class="export-format-title">PDF</h4>
                                <p class="export-format-desc">Format dokumen (.pdf)</p>
                                <ul class="export-format-features">
                                    <li>✓ Tampilan konsisten</li>
                                    <li>✓ Siap cetak</li>
                                    <li>✓ Universal format</li>
                                </ul>
                                <button class="export-format-btn" data-format="pdf">
                                    Pilih PDF
                                </button>
                            </div>

                            <!-- CSV Format -->
                            <div class="export-format-card" data-format="csv">
                                <div class="export-format-icon csv-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                                    </svg>
                                </div>
                                <h4 class="export-format-title">CSV</h4>
                                <p class="export-format-desc">Format teks (.csv)</p>
                                <ul class="export-format-features">
                                    <li>✓ File ringan</li>
                                    <li>✓ Import mudah</li>
                                    <li>✓ Universal compatible</li>
                                </ul>
                                <button class="export-format-btn" data-format="csv">
                                    Pilih CSV
                                </button>
                            </div>
                        </div>

                        <!-- Export Options -->
                        <div class="export-options">
                            <h4 class="export-options-title">Opsi Export</h4>
                            
                            <label class="export-checkbox">
                                <input type="checkbox" id="exportIncludeStats" checked>
                                <span>Sertakan statistik</span>
                            </label>

                            <label class="export-checkbox">
                                <input type="checkbox" id="exportIncludeTimestamp" checked>
                                <span>Tambahkan timestamp</span>
                            </label>

                            <label class="export-checkbox">
                                <input type="checkbox" id="exportOpenAfterDownload">
                                <span>Buka file setelah download</span>
                            </label>
                        </div>
                    </div>

                    <div class="export-modal-footer">
                        <button class="export-btn-cancel" id="cancelExport">
                            Batal
                        </button>
                        <div class="export-info">
                            <svg class="export-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Pilih format untuk melanjutkan</span>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHTML);
        this.modal = document.getElementById('exportModal');

        // Bind modal events
        this.bindModalEvents();
    }

    /**
     * Create loading overlay
     */
    createLoadingOverlay() {
        const loadingHTML = `
            <div id="exportLoadingOverlay" class="export-loading-overlay">
                <div class="export-loading-content">
                    <div class="export-loading-spinner">
                        <svg class="spinner" viewBox="0 0 50 50">
                            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="4"></circle>
                        </svg>
                    </div>
                    <h3 class="export-loading-title">Menyiapkan Export...</h3>
                    <p class="export-loading-message">Mohon tunggu sebentar</p>
                    
                    <div class="export-progress-bar">
                        <div class="export-progress-fill" id="exportProgressFill"></div>
                    </div>
                    <div class="export-progress-text">
                        <span id="exportProgressPercent">0%</span>
                        <span id="exportProgressStatus">Memulai...</span>
                    </div>

                    <button class="export-cancel-btn" id="cancelExportProgress">
                        Batalkan
                    </button>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', loadingHTML);
        this.loadingOverlay = document.getElementById('exportLoadingOverlay');

        // Bind cancel button
        document.getElementById('cancelExportProgress')?.addEventListener('click', () => {
            this.cancelExport();
        });
    }

    /**
     * Bind export buttons
     */
    bindExportButtons() {
        this.exportButtons = document.querySelectorAll('[data-export-type]');
        
        this.exportButtons.forEach(button => {
            button.addEventListener('click', this.handleExportClick);
        });
    }

    /**
     * Bind modal events
     */
    bindModalEvents() {
        // Close buttons
        const closeBtn = document.getElementById('closeExportModal');
        const cancelBtn = document.getElementById('cancelExport');
        const overlay = this.modal?.querySelector('.export-modal-overlay');

        closeBtn?.addEventListener('click', this.handleModalClose);
        cancelBtn?.addEventListener('click', this.handleModalClose);
        overlay?.addEventListener('click', this.handleModalClose);

        // Format selection buttons
        const formatButtons = this.modal?.querySelectorAll('.export-format-btn');
        formatButtons?.forEach(btn => {
            btn.addEventListener('click', this.handleFormatSelect);
        });

        // ESC key to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.modal?.classList.contains('show')) {
                this.handleModalClose();
            }
        });
    }

    /**
     * Handle export button click
     */
    handleExportClick(e) {
        const button = e.currentTarget;
        const exportType = button.dataset.exportType;
        const exportData = button.dataset.exportData;

        this.currentExport.type = exportType;
        this.currentExport.data = exportData ? JSON.parse(exportData) : null;

        this.openModal();
    }

    /**
     * Handle format selection
     */
    async handleFormatSelect(e) {
        const format = e.currentTarget.dataset.format;
        this.currentExport.format = format;

        // Get export options
        const options = {
            includeStats: document.getElementById('exportIncludeStats')?.checked,
            includeTimestamp: document.getElementById('exportIncludeTimestamp')?.checked,
            openAfterDownload: document.getElementById('exportOpenAfterDownload')?.checked
        };

        this.closeModal();
        await this.startExport(format, options);
    }

    /**
     * Start export process
     */
    async startExport(format, options) {
        if (this.isExporting) {
            this.showNotification('Export sedang berlangsung', 'warning');
            return;
        }

        this.isExporting = true;
        this.showLoading();

        try {
            // Update progress
            this.updateProgress(10, 'Memvalidasi data...');

            // Simulate export process (replace with actual API call)
            await this.simulateExport(format, options);

            // Success
            this.showNotification(`File ${format.toUpperCase()} berhasil diunduh!`, 'success');
            
            // Add to history
            this.addToHistory({
                type: this.currentExport.type,
                format: format,
                timestamp: new Date(),
                status: 'success'
            });

        } catch (error) {
            console.error('Export failed:', error);
            this.showNotification('Export gagal: ' + error.message, 'error');
            
            // Add to history
            this.addToHistory({
                type: this.currentExport.type,
                format: format,
                timestamp: new Date(),
                status: 'failed',
                error: error.message
            });

        } finally {
            this.isExporting = false;
            this.hideLoading();
        }
    }

    /**
     * Simulate export process (for demo)
     * Replace with actual API call in production
     */
    async simulateExport(format, options) {
        // Progress steps
        const steps = [
            { progress: 20, message: 'Mengumpulkan data...' },
            { progress: 40, message: 'Memproses data...' },
            { progress: 60, message: `Membuat file ${format.toUpperCase()}...` },
            { progress: 80, message: 'Memformat dokumen...' },
            { progress: 95, message: 'Menyelesaikan...' },
            { progress: 100, message: 'Selesai!' }
        ];

        for (const step of steps) {
            await this.delay(800);
            this.updateProgress(step.progress, step.message);
        }

        // Simulate download
        await this.delay(500);
        this.downloadFile(format);
    }

    /**
     * Actual export function (call backend API)
     */
    async performExport(format, options) {
        const endpoint = `${this.config.exportEndpoint}export-${this.currentExport.type}.php`;
        
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                format: format,
                options: options,
                data: this.currentExport.data
            })
        });

        if (!response.ok) {
            throw new Error('Export request failed');
        }

        const blob = await response.blob();
        return blob;
    }

    /**
     * Download file
     */
    downloadFile(format) {
        // Generate filename
        const timestamp = new Date().toISOString().slice(0, 10);
        const filename = `${this.currentExport.type}_${timestamp}.${format}`;

        // For demo: Create dummy download
        // In production, this would be replaced with actual file from backend
        const dummyContent = this.generateDummyContent(format);
        const blob = new Blob([dummyContent], { 
            type: this.getMimeType(format) 
        });

        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);

        this.currentExport.filename = filename;
    }

    /**
     * Generate dummy content for demo
     */
    generateDummyContent(format) {
        const type = this.currentExport.type;
        
        if (format === 'csv') {
            return `Nama,NPM,Email,Nilai\nJohn Doe,2011234567,john@example.com,85\nJane Smith,2011234568,jane@example.com,90`;
        }
        
        if (format === 'excel') {
            return `This would be Excel binary data in production`;
        }
        
        if (format === 'pdf') {
            return `This would be PDF binary data in production`;
        }

        return `Export ${type} - ${format}`;
    }

    /**
     * Get MIME type for format
     */
    getMimeType(format) {
        const mimeTypes = {
            'excel': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'pdf': 'application/pdf',
            'csv': 'text/csv'
        };
        return mimeTypes[format] || 'application/octet-stream';
    }

    /**
     * Update export progress
     */
    updateProgress(percent, message) {
        const progressFill = document.getElementById('exportProgressFill');
        const progressPercent = document.getElementById('exportProgressPercent');
        const progressStatus = document.getElementById('exportProgressStatus');

        if (progressFill) progressFill.style.width = `${percent}%`;
        if (progressPercent) progressPercent.textContent = `${percent}%`;
        if (progressStatus) progressStatus.textContent = message;
    }

    /**
     * Show loading overlay
     */
    showLoading() {
        this.loadingOverlay?.classList.add('show');
        this.updateProgress(0, 'Memulai...');
    }

    /**
     * Hide loading overlay
     */
    hideLoading() {
        setTimeout(() => {
            this.loadingOverlay?.classList.remove('show');
        }, 500);
    }

    /**
     * Cancel export
     */
    cancelExport() {
        if (!this.isExporting) return;

        if (confirm('Batalkan proses export?')) {
            this.isExporting = false;
            this.hideLoading();
            this.showNotification('Export dibatalkan', 'info');
        }
    }

    /**
     * Open modal
     */
    openModal() {
        this.modal?.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    /**
     * Close modal
     */
    closeModal() {
        this.modal?.classList.remove('show');
        document.body.style.overflow = '';
    }

    /**
     * Handle modal close
     */
    handleModalClose() {
        this.closeModal();
    }

    /**
     * Add to export history
     */
    addToHistory(exportRecord) {
        this.exportHistory.unshift(exportRecord);
        
        // Keep only last 50 records
        if (this.exportHistory.length > 50) {
            this.exportHistory = this.exportHistory.slice(0, 50);
        }

        this.saveExportHistory();
    }

    /**
     * Save export history to localStorage
     */
    saveExportHistory() {
        try {
            localStorage.setItem('exportHistory', JSON.stringify(this.exportHistory));
        } catch (error) {
            console.error('Failed to save export history:', error);
        }
    }

    /**
     * Load export history from localStorage
     */
    loadExportHistory() {
        try {
            const saved = localStorage.getItem('exportHistory');
            if (saved) {
                this.exportHistory = JSON.parse(saved);
            }
        } catch (error) {
            console.error('Failed to load export history:', error);
        }
    }

    /**
     * Show notification
     */
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `export-notification ${type}`;
        
        const icons = {
            success: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>',
            error: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>',
            warning: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>',
            info: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
        };

        notification.innerHTML = `
            <svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${icons[type]}
            </svg>
            <span>${message}</span>
        `;

        document.body.appendChild(notification);

        setTimeout(() => notification.classList.add('show'), 10);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    /**
     * Utility: Delay
     */
    delay(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    /**
     * Destroy instance
     */
    destroy() {
        this.exportButtons.forEach(button => {
            button.removeEventListener('click', this.handleExportClick);
        });

        this.modal?.remove();
        this.loadingOverlay?.remove();
        
        console.log('ExportSystem destroyed');
    }
}

// Auto-initialize
let exportSystem = null;

document.addEventListener('DOMContentLoaded', () => {
    exportSystem = new ExportSystem();
    exportSystem.init();
});

// Export for external use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ExportSystem;
}
