/**
 * Authentication Module
 * Menangani komunikasi dengan backend untuk login, register, logout
 */

const Auth = {
    /**
     * Login user
     * @param {string} email - Email user
     * @param {string} password - Password user
     * @returns {Promise} Response dari backend
     */
    login: async function(email, password) {
        try {
            const formData = new FormData();
            formData.append('email', email);
            formData.append('password', password);

            const response = await fetch('../backend/auth/login.php', {
                method: 'POST',
                body: formData
            });

            // Check if response is ok
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            // Get response text first
            const text = await response.text();
            
            // Check if text is empty
            if (!text) {
                throw new Error('Backend tidak mengembalikan response. Pastikan database terkoneksi.');
            }

            // Try to parse as JSON
            try {
                const data = JSON.parse(text);
                return data;
            } catch (e) {
                console.error('Response text:', text);
                throw new Error('Response bukan JSON valid. Error di backend: ' + text.substring(0, 200));
            }
        } catch (error) {
            console.error('Login error:', error);
            throw error;
        }
    },

    /**
     * Register user baru
     * @param {object} userData - Data user (nama, email, password, role, npm_nidn)
     * @returns {Promise} Response dari backend
     */
    register: async function(userData) {
        try {
            const formData = new FormData();
            formData.append('nama', userData.nama);
            formData.append('email', userData.email);
            formData.append('password', userData.password);
            formData.append('password_confirm', userData.password_confirm);
            formData.append('role', userData.role);
            formData.append('npm_nidn', userData.npm_nidn);

            const response = await fetch('../backend/auth/register.php', {
                method: 'POST',
                body: formData
            });

            // Check if response is ok
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            // Get response text first
            const text = await response.text();
            
            // Check if text is empty
            if (!text) {
                throw new Error('Backend tidak mengembalikan response. Pastikan database terkoneksi.');
            }

            // Try to parse as JSON
            try {
                const data = JSON.parse(text);
                return data;
            } catch (e) {
                console.error('Response text:', text);
                throw new Error('Response bukan JSON valid. Error di backend: ' + text.substring(0, 200));
            }
        } catch (error) {
            console.error('Register error:', error);
            throw error;
        }
    },

    /**
     * Logout user
     */
    logout: function() {
        try {
            window.location.href = '../backend/auth/logout.php';
        } catch (error) {
            console.error('Logout error:', error);
            throw error;
        }
    },

    /**
     * Check apakah user sudah login
     * @returns {Promise} Status login user
     */
    checkSession: async function() {
        try {
            const response = await fetch('../backend/auth/session-check.php', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const text = await response.text();
            if (!text) {
                return { success: false };
            }

            try {
                const data = JSON.parse(text);
                return data;
            } catch (e) {
                return { success: false };
            }
        } catch (error) {
            console.error('Session check error:', error);
            return { success: false };
        }
    },

    /**
     * Show alert message
     * @param {string} type - Type of alert (success, error, warning, info)
     * @param {string} message - Alert message
     * @param {HTMLElement} container - Container to show alert
     */
    showAlert: function(type, message, container = null) {
        if (!container) {
            container = document.getElementById('alertContainer') || document.body;
        }

        const alertClass = {
            success: 'alert-success',
            error: 'alert-error',
            warning: 'alert-warning',
            info: 'alert-info'
        }[type] || 'alert-info';

        const icon = {
            success: '✓',
            error: '✕',
            warning: '⚠',
            info: 'ℹ'
        }[type] || 'ℹ';

        const alertHTML = `
            <div class="alert ${alertClass}">
                ${icon} ${message}
            </div>
        `;

        container.innerHTML = alertHTML;
    },

    /**
     * Clear alerts
     */
    clearAlerts: function(container = null) {
        if (!container) {
            container = document.getElementById('alertContainer');
        }
        if (container) {
            container.innerHTML = '';
        }
    },

    /**
     * Show loading overlay
     */
    showLoading: function(message = 'Memproses...') {
        let overlay = document.getElementById('loadingOverlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.id = 'loadingOverlay';
            overlay.className = 'loading-overlay';
            overlay.innerHTML = `
                <div class="spinner"></div>
                <p>${message}</p>
            `;
            document.body.appendChild(overlay);
        }
        overlay.classList.add('show');
    },

    /**
     * Hide loading overlay
     */
    hideLoading: function() {
        const overlay = document.getElementById('loadingOverlay');
        if (overlay) {
            overlay.classList.remove('show');
        }
    }
};

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = Auth;
}
