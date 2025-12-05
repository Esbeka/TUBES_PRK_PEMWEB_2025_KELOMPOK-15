// ==========================================
// VALIDATION.JS
// Form Validation Functions
// ==========================================

// Email Validation
function validateEmail(email, errorId) {
    const emailInput = document.getElementById(errorId)?.previousElementSibling;
    const errorElement = document.getElementById(errorId);
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!email) {
        showError(emailInput, errorElement, 'Email harus diisi');
        return false;
    }
    
    if (!emailRegex.test(email)) {
        showError(emailInput, errorElement, 'Format email tidak valid');
        return false;
    }
    
    hideError(emailInput, errorElement);
    return true;
}

// Password Validation
function validatePassword(password, errorId) {
    const passwordInput = document.getElementById(errorId)?.previousElementSibling?.previousElementSibling;
    const errorElement = document.getElementById(errorId);
    
    if (!password) {
        showError(passwordInput, errorElement, 'Password harus diisi');
        return false;
    }
    
    if (password.length < 8) {
        showError(passwordInput, errorElement, 'Password minimal 8 karakter');
        return false;
    }
    
    hideError(passwordInput, errorElement);
    return true;
}

// Password Match Validation
function validatePasswordMatch(password, confirmPassword, errorId) {
    const confirmInput = document.getElementById(errorId)?.previousElementSibling?.previousElementSibling;
    const errorElement = document.getElementById(errorId);
    
    if (!confirmPassword) {
        showError(confirmInput, errorElement, 'Konfirmasi password harus diisi');
        return false;
    }
    
    if (password !== confirmPassword) {
        showError(confirmInput, errorElement, 'Password tidak cocok');
        return false;
    }
    
    hideError(confirmInput, errorElement);
    return true;
}

// Required Field Validation
function validateRequired(value, errorId, message = 'Field ini harus diisi') {
    const input = document.getElementById(errorId)?.previousElementSibling;
    const errorElement = document.getElementById(errorId);
    
    if (!value || value.trim() === '') {
        showError(input, errorElement, message);
        return false;
    }
    
    hideError(input, errorElement);
    return true;
}

// File Validation
function validateFile(file, errorId, options = {}) {
    const errorElement = document.getElementById(errorId);
    const allowedTypes = options.allowedTypes || ['pdf', 'doc', 'docx', 'zip'];
    const maxSize = options.maxSize || 5 * 1024 * 1024; // 5MB default
    
    if (!file) {
        if (errorElement) {
            errorElement.textContent = 'File harus dipilih';
            errorElement.classList.add('show');
        }
        return false;
    }
    
    // Check file extension
    const fileName = file.name;
    const fileExt = fileName.split('.').pop().toLowerCase();
    
    if (!allowedTypes.includes(fileExt)) {
        if (errorElement) {
            errorElement.textContent = `Format file harus: ${allowedTypes.join(', ')}`;
            errorElement.classList.add('show');
        }
        return false;
    }
    
    // Check file size
    if (file.size > maxSize) {
        const maxSizeMB = (maxSize / (1024 * 1024)).toFixed(1);
        if (errorElement) {
            errorElement.textContent = `Ukuran file maksimal ${maxSizeMB}MB`;
            errorElement.classList.add('show');
        }
        return false;
    }
    
    if (errorElement) {
        errorElement.classList.remove('show');
    }
    return true;
}

// Show Error
function showError(inputElement, errorElement, message) {
    if (inputElement) {
        inputElement.classList.add('error');
        inputElement.classList.remove('valid');
    }
    if (errorElement) {
        errorElement.textContent = message;
        errorElement.classList.add('show');
    }
}

// Hide Error
function hideError(inputElement, errorElement) {
    if (inputElement) {
        inputElement.classList.remove('error');
        inputElement.classList.add('valid');
    }
    if (errorElement) {
        errorElement.classList.remove('show');
    }
}

// Format File Size
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

// Check Password Strength
function checkPasswordStrength(password) {
    let strength = 0;
    
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]+/)) strength++;
    if (password.match(/[A-Z]+/)) strength++;
    if (password.match(/[0-9]+/)) strength++;
    if (password.match(/[$@#&!]+/)) strength++;

    if (strength <= 2) {
        return { level: 'weak', text: 'Password Lemah', score: strength };
    } else if (strength <= 4) {
        return { level: 'medium', text: 'Password Sedang', score: strength };
    } else {
        return { level: 'strong', text: 'Password Kuat', score: strength };
    }
}

// Validate Join Class Code
function validateClassCode(code, errorId) {
    const input = document.getElementById(errorId)?.previousElementSibling;
    const errorElement = document.getElementById(errorId);
    
    if (!code || code.trim() === '') {
        showError(input, errorElement, 'Kode kelas harus diisi');
        return false;
    }
    
    // Assuming class code format: XXXX2025 (4 letters + 4 digits)
    const codeRegex = /^[A-Z]{2,6}\d{4}$/;
    if (!codeRegex.test(code.toUpperCase())) {
        showError(input, errorElement, 'Format kode kelas tidak valid');
        return false;
    }
    
    hideError(input, errorElement);
    return true;
}

// Validate Deadline (must be future date)
function validateDeadline(dateString, errorId) {
    const input = document.getElementById(errorId)?.previousElementSibling;
    const errorElement = document.getElementById(errorId);
    
    if (!dateString) {
        showError(input, errorElement, 'Deadline harus diisi');
        return false;
    }
    
    const selectedDate = new Date(dateString);
    const today = new Date();
    today.setHours(0, 0, 0, 0); // Reset time to start of day
    
    if (selectedDate < today) {
        showError(input, errorElement, 'Deadline tidak boleh di masa lalu');
        return false;
    }
    
    hideError(input, errorElement);
    return true;
}

// Sanitize Input (prevent XSS)
function sanitizeInput(input) {
    const div = document.createElement('div');
    div.textContent = input;
    return div.innerHTML;
}

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        validateEmail,
        validatePassword,
        validatePasswordMatch,
        validateRequired,
        validateFile,
        validateClassCode,
        validateDeadline,
        formatFileSize,
        checkPasswordStrength,
        sanitizeInput
    };
}
