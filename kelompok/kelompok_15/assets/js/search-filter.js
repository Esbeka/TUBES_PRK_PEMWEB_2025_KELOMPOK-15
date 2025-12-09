/**
 * SearchFilterSystem - Advanced Search & Filter Module
 * 
 * Features:
 * - Live search with debouncing
 * - Multiple filter options (semester, tahun, status)
 * - Sort functionality (nama, tanggal, deadline)
 * - Clear filters button
 * - URL state management
 * - Result count display
 * 
 * @version 1.0.0
 * @author Cindy - Frontend Developer
 */

class SearchFilterSystem {
    constructor(options = {}) {
        // Configuration
        this.config = {
            searchDebounce: 300, // ms
            minSearchLength: 2,
            animationDuration: 300,
            ...options
        };

        // DOM Elements
        this.searchInput = null;
        this.filterSelects = {};
        this.sortSelect = null;
        this.clearButton = null;
        this.resultContainer = null;
        this.resultCount = null;
        this.noResultsEl = null;

        // State
        this.filters = {
            search: '',
            semester: 'all',
            tahun: 'all',
            status: 'all',
            sort: 'nama-asc'
        };

        this.allItems = [];
        this.filteredItems = [];
        this.searchTimeout = null;
        this.isInitialized = false;

        // Bind methods
        this.handleSearch = this.handleSearch.bind(this);
        this.handleFilterChange = this.handleFilterChange.bind(this);
        this.handleSortChange = this.handleSortChange.bind(this);
        this.handleClearFilters = this.handleClearFilters.bind(this);
    }

    /**
     * Initialize the search & filter system
     */
    init() {
        if (this.isInitialized) {
            console.warn('SearchFilterSystem already initialized');
            return;
        }

        try {
            this.bindElements();
            this.collectItems();
            this.bindEvents();
            this.loadStateFromURL();
            this.updateUI();
            this.isInitialized = true;
            console.log('SearchFilterSystem initialized successfully');
        } catch (error) {
            console.error('Failed to initialize SearchFilterSystem:', error);
        }
    }

    /**
     * Bind DOM elements
     */
    bindElements() {
        // Search input
        this.searchInput = document.getElementById('searchInput');
        if (!this.searchInput) {
            console.warn('Search input not found');
        }

        // Filter selects
        this.filterSelects.semester = document.getElementById('filterSemester');
        this.filterSelects.tahun = document.getElementById('filterTahun');
        this.filterSelects.status = document.getElementById('filterStatus');

        // Sort select
        this.sortSelect = document.getElementById('sortSelect');

        // Clear button
        this.clearButton = document.getElementById('clearFiltersBtn');

        // Result container & count
        this.resultContainer = document.getElementById('kelasGrid') || 
                              document.getElementById('tugasGrid') ||
                              document.querySelector('.grid');
        
        this.resultCount = document.getElementById('resultCount');
        this.noResultsEl = document.getElementById('noResults');
    }

    /**
     * Collect all items from DOM
     */
    collectItems() {
        if (!this.resultContainer) {
            console.warn('Result container not found');
            return;
        }

        const items = this.resultContainer.querySelectorAll('[data-item]');
        
        this.allItems = Array.from(items).map(item => ({
            element: item,
            nama: item.dataset.nama || '',
            semester: item.dataset.semester || '',
            tahun: item.dataset.tahun || '',
            status: item.dataset.status || '',
            tanggal: item.dataset.tanggal || '',
            deadline: item.dataset.deadline || '',
            searchText: this.buildSearchText(item)
        }));

        this.filteredItems = [...this.allItems];
        console.log(`Collected ${this.allItems.length} items`);
    }

    /**
     * Build searchable text from item
     */
    buildSearchText(item) {
        const texts = [
            item.dataset.nama,
            item.dataset.semester,
            item.dataset.tahun,
            item.dataset.status,
            item.dataset.kode,
            item.dataset.deskripsi,
            item.textContent
        ];

        return texts
            .filter(Boolean)
            .join(' ')
            .toLowerCase()
            .replace(/\s+/g, ' ')
            .trim();
    }

    /**
     * Bind event listeners
     */
    bindEvents() {
        // Search input
        if (this.searchInput) {
            this.searchInput.addEventListener('input', this.handleSearch);
            this.searchInput.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    this.searchInput.value = '';
                    this.handleSearch();
                }
            });
        }

        // Filter selects
        Object.values(this.filterSelects).forEach(select => {
            if (select) {
                select.addEventListener('change', this.handleFilterChange);
            }
        });

        // Sort select
        if (this.sortSelect) {
            this.sortSelect.addEventListener('change', this.handleSortChange);
        }

        // Clear button
        if (this.clearButton) {
            this.clearButton.addEventListener('click', this.handleClearFilters);
        }

        // Outside click to close dropdowns
        document.addEventListener('click', (e) => {
            const isFilterClick = e.target.closest('.filter-dropdown');
            if (!isFilterClick) {
                this.closeAllDropdowns();
            }
        });
    }

    /**
     * Handle search input with debouncing
     */
    handleSearch(e) {
        clearTimeout(this.searchTimeout);

        const value = e ? e.target.value : '';
        
        // Show loading state
        if (this.searchInput) {
            this.searchInput.classList.add('searching');
        }

        this.searchTimeout = setTimeout(() => {
            this.filters.search = value.toLowerCase().trim();
            this.applyFilters();
            
            if (this.searchInput) {
                this.searchInput.classList.remove('searching');
            }
        }, this.config.searchDebounce);
    }

    /**
     * Handle filter change
     */
    handleFilterChange(e) {
        const filterType = e.target.id.replace('filter', '').toLowerCase();
        this.filters[filterType] = e.target.value;
        this.applyFilters();
    }

    /**
     * Handle sort change
     */
    handleSortChange(e) {
        this.filters.sort = e.target.value;
        this.applySort();
        this.renderResults();
    }

    /**
     * Apply all filters
     */
    applyFilters() {
        this.filteredItems = this.allItems.filter(item => {
            // Search filter
            if (this.filters.search && this.filters.search.length >= this.config.minSearchLength) {
                if (!item.searchText.includes(this.filters.search)) {
                    return false;
                }
            }

            // Semester filter
            if (this.filters.semester !== 'all' && item.semester !== this.filters.semester) {
                return false;
            }

            // Tahun filter
            if (this.filters.tahun !== 'all' && item.tahun !== this.filters.tahun) {
                return false;
            }

            // Status filter
            if (this.filters.status !== 'all' && item.status !== this.filters.status) {
                return false;
            }

            return true;
        });

        this.applySort();
        this.renderResults();
        this.updateResultCount();
        this.updateClearButton();
        this.updateURLState();
    }

    /**
     * Apply sort to filtered items
     */
    applySort() {
        const [sortBy, direction] = this.filters.sort.split('-');
        const multiplier = direction === 'asc' ? 1 : -1;

        this.filteredItems.sort((a, b) => {
            let aVal, bVal;

            switch (sortBy) {
                case 'nama':
                    aVal = a.nama.toLowerCase();
                    bVal = b.nama.toLowerCase();
                    return aVal.localeCompare(bVal) * multiplier;

                case 'tanggal':
                    aVal = new Date(a.tanggal || 0);
                    bVal = new Date(b.tanggal || 0);
                    return (aVal - bVal) * multiplier;

                case 'deadline':
                    aVal = new Date(a.deadline || '9999-12-31');
                    bVal = new Date(b.deadline || '9999-12-31');
                    return (aVal - bVal) * multiplier;

                case 'semester':
                    aVal = parseInt(a.semester) || 0;
                    bVal = parseInt(b.semester) || 0;
                    return (aVal - bVal) * multiplier;

                default:
                    return 0;
            }
        });
    }

    /**
     * Render filtered results
     */
    renderResults() {
        if (!this.resultContainer) return;

        // Fade out animation
        this.resultContainer.style.opacity = '0';
        this.resultContainer.style.transform = 'translateY(10px)';

        setTimeout(() => {
            // Hide all items first
            this.allItems.forEach(item => {
                item.element.style.display = 'none';
            });

            // Show filtered items in order
            if (this.filteredItems.length > 0) {
                this.filteredItems.forEach((item, index) => {
                    item.element.style.display = '';
                    item.element.style.order = index;
                });

                if (this.noResultsEl) {
                    this.noResultsEl.style.display = 'none';
                }
            } else {
                // Show no results message
                if (this.noResultsEl) {
                    this.noResultsEl.style.display = 'flex';
                } else {
                    this.showNoResultsMessage();
                }
            }

            // Fade in animation
            this.resultContainer.style.opacity = '1';
            this.resultContainer.style.transform = 'translateY(0)';

        }, this.config.animationDuration);
    }

    /**
     * Show no results message
     */
    showNoResultsMessage() {
        if (!this.resultContainer) return;

        const existingMsg = this.resultContainer.querySelector('.no-results-message');
        if (existingMsg) {
            existingMsg.remove();
        }

        const noResultsHTML = `
            <div class="no-results-message" style="grid-column: 1 / -1;">
                <div class="no-results-card">
                    <svg class="no-results-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <h3>Tidak Ada Hasil</h3>
                    <p>Tidak ada data yang cocok dengan filter Anda.</p>
                    <button onclick="searchFilterSystem.clearFilters()" class="btn-clear-inline">
                        Reset Filter
                    </button>
                </div>
            </div>
        `;

        this.resultContainer.insertAdjacentHTML('afterbegin', noResultsHTML);
    }

    /**
     * Update result count display
     */
    updateResultCount() {
        if (!this.resultCount) return;

        const total = this.allItems.length;
        const filtered = this.filteredItems.length;

        if (filtered === total) {
            this.resultCount.innerHTML = `
                Menampilkan <strong>${total}</strong> item
            `;
        } else {
            this.resultCount.innerHTML = `
                Menampilkan <strong>${filtered}</strong> dari <strong>${total}</strong> item
            `;
        }
    }

    /**
     * Update clear button state
     */
    updateClearButton() {
        if (!this.clearButton) return;

        const hasActiveFilters = this.hasActiveFilters();

        if (hasActiveFilters) {
            this.clearButton.disabled = false;
            this.clearButton.classList.add('active');
        } else {
            this.clearButton.disabled = true;
            this.clearButton.classList.remove('active');
        }
    }

    /**
     * Check if any filters are active
     */
    hasActiveFilters() {
        return (
            this.filters.search !== '' ||
            this.filters.semester !== 'all' ||
            this.filters.tahun !== 'all' ||
            this.filters.status !== 'all' ||
            this.filters.sort !== 'nama-asc'
        );
    }

    /**
     * Clear all filters
     */
    handleClearFilters() {
        // Reset filters
        this.filters = {
            search: '',
            semester: 'all',
            tahun: 'all',
            status: 'all',
            sort: 'nama-asc'
        };

        // Reset UI
        if (this.searchInput) {
            this.searchInput.value = '';
        }

        Object.values(this.filterSelects).forEach(select => {
            if (select) {
                select.value = 'all';
            }
        });

        if (this.sortSelect) {
            this.sortSelect.value = 'nama-asc';
        }

        // Apply
        this.applyFilters();

        // Show notification
        this.showNotification('Filter berhasil direset', 'success');
    }

    /**
     * Public method to clear filters (for external calls)
     */
    clearFilters() {
        this.handleClearFilters();
    }

    /**
     * Update URL state (for bookmarking)
     */
    updateURLState() {
        const params = new URLSearchParams();

        if (this.filters.search) params.set('search', this.filters.search);
        if (this.filters.semester !== 'all') params.set('semester', this.filters.semester);
        if (this.filters.tahun !== 'all') params.set('tahun', this.filters.tahun);
        if (this.filters.status !== 'all') params.set('status', this.filters.status);
        if (this.filters.sort !== 'nama-asc') params.set('sort', this.filters.sort);

        const newURL = params.toString() ? `?${params.toString()}` : window.location.pathname;
        window.history.replaceState({}, '', newURL);
    }

    /**
     * Load state from URL parameters
     */
    loadStateFromURL() {
        const params = new URLSearchParams(window.location.search);

        if (params.has('search')) {
            this.filters.search = params.get('search');
            if (this.searchInput) {
                this.searchInput.value = this.filters.search;
            }
        }

        if (params.has('semester')) {
            this.filters.semester = params.get('semester');
            if (this.filterSelects.semester) {
                this.filterSelects.semester.value = this.filters.semester;
            }
        }

        if (params.has('tahun')) {
            this.filters.tahun = params.get('tahun');
            if (this.filterSelects.tahun) {
                this.filterSelects.tahun.value = this.filters.tahun;
            }
        }

        if (params.has('status')) {
            this.filters.status = params.get('status');
            if (this.filterSelects.status) {
                this.filterSelects.status.value = this.filters.status;
            }
        }

        if (params.has('sort')) {
            this.filters.sort = params.get('sort');
            if (this.sortSelect) {
                this.sortSelect.value = this.filters.sort;
            }
        }

        // Apply loaded filters
        if (this.hasActiveFilters()) {
            this.applyFilters();
        }
    }

    /**
     * Close all dropdowns
     */
    closeAllDropdowns() {
        document.querySelectorAll('.filter-dropdown.open').forEach(dropdown => {
            dropdown.classList.remove('open');
        });
    }

    /**
     * Update UI state
     */
    updateUI() {
        this.updateResultCount();
        this.updateClearButton();
    }

    /**
     * Show notification
     */
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `filter-notification ${type}`;
        notification.innerHTML = `
            <svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>${message}</span>
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => notification.classList.add('show'), 10);

        // Remove after 3 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    /**
     * Refresh items (call after dynamic content load)
     */
    refresh() {
        this.collectItems();
        this.applyFilters();
    }

    /**
     * Destroy instance
     */
    destroy() {
        // Remove event listeners
        if (this.searchInput) {
            this.searchInput.removeEventListener('input', this.handleSearch);
        }

        Object.values(this.filterSelects).forEach(select => {
            if (select) {
                select.removeEventListener('change', this.handleFilterChange);
            }
        });

        if (this.sortSelect) {
            this.sortSelect.removeEventListener('change', this.handleSortChange);
        }

        if (this.clearButton) {
            this.clearButton.removeEventListener('click', this.handleClearFilters);
        }

        // Clear timeouts
        clearTimeout(this.searchTimeout);

        // Reset state
        this.isInitialized = false;
        console.log('SearchFilterSystem destroyed');
    }
}

// Auto-initialize on DOM ready
let searchFilterSystem = null;

document.addEventListener('DOMContentLoaded', () => {
    const hasSearchFilter = document.querySelector('[data-search-filter]');
    
    if (hasSearchFilter) {
        searchFilterSystem = new SearchFilterSystem();
        searchFilterSystem.init();
    }
});

// Export for external use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = SearchFilterSystem;
}
