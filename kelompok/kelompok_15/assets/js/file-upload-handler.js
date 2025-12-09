// ==========================================
// FILE-UPLOAD-HANDLER.JS
// Handle file uploads with preview and validation
// ==========================================

document.addEventListener('DOMContentLoaded', function() {
    
    // ========== FILE UPLOAD HANDLERS ==========
    const fileInputs = document.querySelectorAll('.file-upload-input');
    
    fileInputs.forEach(input => {
        const container = input.closest('.file-upload');
        const label = container.querySelector('.file-upload-label');
        const preview = container.querySelector('.file-upload-preview');
        
        // Click on label to trigger file input
        if (label) {
            label.addEventListener('click', function() {
                input.click();
            });
        }
        
        // Handle file selection
        input.addEventListener('change', function() {
            handleFileSelect(this, preview);
        });
        
        // Drag and drop functionality
        if (label) {
            label.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });
            
            label.addEventListener('dragleave', function() {
                this.classList.remove('dragover');
            });
            
            label.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    input.files = files;
                    handleFileSelect(input, preview);
                }
            });
        }
    });
    
    // ========== HANDLE FILE SELECTION ==========
    function handleFileSelect(input, preview) {
        const file = input.files[0];
        
        if (!file) {
            if (preview) {
                preview.classList.remove('show');
                preview.innerHTML = '';
            }
            return;
        }
        
        // Validate file (you can customize validation options)
        const validationOptions = {
            allowedTypes: ['pdf', 'doc', 'docx', 'zip', 'jpg', 'jpeg', 'png'],
            maxSize: 5 * 1024 * 1024 // 5MB
        };
        
        const errorId = input.id + 'Error';
        const isValid = validateFile(file, errorId, validationOptions);
        
        if (!isValid) {
            input.value = '';
            if (preview) {
                preview.classList.remove('show');
                preview.innerHTML = '';
            }
            return;
        }
        
        // Show preview
        if (preview) {
            displayFilePreview(file, preview, input);
        }
    }
    
    // ========== DISPLAY FILE PREVIEW ==========
    function displayFilePreview(file, preview, input) {
        const fileName = file.name;
        const fileSize = formatFileSize(file.size);
        const fileExt = fileName.split('.').pop().toLowerCase();
        
        // Get icon based on file type
        let icon = '📄';
        if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
            icon = '🖼️';
        } else if (['pdf'].includes(fileExt)) {
            icon = '📕';
        } else if (['doc', 'docx'].includes(fileExt)) {
            icon = '📘';
        } else if (['zip', 'rar'].includes(fileExt)) {
            icon = '📦';
        }
        
        preview.innerHTML = `
            <div class="file-preview-item">
                <div class="file-preview-icon">${icon}</div>
                <div class="file-preview-info">
                    <div class="file-preview-name">${fileName}</div>
                    <div class="file-preview-size">${fileSize}</div>
                </div>
                <button type="button" class="file-preview-remove" onclick="removeFile('${input.id}')">
                    ✕
                </button>
            </div>
        `;
        
        preview.classList.add('show');
        
        // If it's an image, show thumbnail
        if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const iconElement = preview.querySelector('.file-preview-icon');
                if (iconElement) {
                    iconElement.innerHTML = `<img src="${e.target.result}" alt="Preview" style="width: 40px; height: 40px; object-fit: cover; border-radius: 0.5rem;">`;
                }
            };
            reader.readAsDataURL(file);
        }
    }
    
    // ========== REMOVE FILE ==========
    window.removeFile = function(inputId) {
        const input = document.getElementById(inputId);
        const container = input.closest('.file-upload');
        const preview = container.querySelector('.file-upload-preview');
        
        input.value = '';
        
        if (preview) {
            preview.classList.remove('show');
            preview.innerHTML = '';
        }
        
        // Clear any error messages
        const errorElement = document.getElementById(inputId + 'Error');
        if (errorElement) {
            errorElement.classList.remove('show');
        }
    };
    
    // ========== UPLOAD PROGRESS SIMULATION ==========
    window.uploadFileWithProgress = function(file, progressBarId, onComplete) {
        const progressBar = document.getElementById(progressBarId);
        if (!progressBar) return;
        
        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 20;
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval);
                if (onComplete) onComplete();
            }
            progressBar.style.width = progress + '%';
        }, 200);
    };
    
    // ========== VALIDATE FILE TYPE ==========
    window.getFileExtension = function(filename) {
        return filename.split('.').pop().toLowerCase();
    };
    
    window.isValidFileType = function(filename, allowedTypes) {
        const ext = getFileExtension(filename);
        return allowedTypes.includes(ext);
    };
    
    // ========== COMPRESS IMAGE BEFORE UPLOAD (Optional) ==========
    window.compressImage = function(file, maxWidth, maxHeight, quality, callback) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                const canvas = document.createElement('canvas');
                let width = img.width;
                let height = img.height;
                
                // Calculate new dimensions
                if (width > height) {
                    if (width > maxWidth) {
                        height *= maxWidth / width;
                        width = maxWidth;
                    }
                } else {
                    if (height > maxHeight) {
                        width *= maxHeight / height;
                        height = maxHeight;
                    }
                }
                
                canvas.width = width;
                canvas.height = height;
                
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);
                
                canvas.toBlob(callback, file.type, quality);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    };
    
    // ========== MULTIPLE FILE UPLOAD ==========
    const multiFileInputs = document.querySelectorAll('.multi-file-input');
    
    multiFileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const files = Array.from(this.files);
            const container = this.closest('.file-upload-container');
            const preview = container.querySelector('.multi-file-preview');
            
            if (!preview) return;
            
            preview.innerHTML = '';
            
            files.forEach((file, index) => {
                const fileItem = createFilePreviewItem(file, index);
                preview.appendChild(fileItem);
            });
            
            if (files.length > 0) {
                preview.classList.add('show');
            }
        });
    });
    
    function createFilePreviewItem(file, index) {
        const fileName = file.name;
        const fileSize = formatFileSize(file.size);
        const fileExt = fileName.split('.').pop().toLowerCase();
        
        let icon = '📄';
        if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
            icon = '🖼️';
        } else if (['pdf'].includes(fileExt)) {
            icon = '📕';
        }
        
        const item = document.createElement('div');
        item.className = 'file-preview-item';
        item.innerHTML = `
            <div class="file-preview-icon">${icon}</div>
            <div class="file-preview-info">
                <div class="file-preview-name">${fileName}</div>
                <div class="file-preview-size">${fileSize}</div>
            </div>
            <button type="button" class="file-preview-remove" onclick="removeMultiFile(${index})">
                ✕
            </button>
        `;
        
        return item;
    }
    
    window.removeMultiFile = function(index) {
        // Implementation for removing specific file from multiple files
        console.log('Remove file at index:', index);
    };
});

// ========== AJAX FILE UPLOAD ==========
window.uploadFile = function(file, url, onProgress, onSuccess, onError) {
    const formData = new FormData();
    formData.append('file', file);
    
    const xhr = new XMLHttpRequest();
    
    // Progress tracking
    xhr.upload.addEventListener('progress', function(e) {
        if (e.lengthComputable) {
            const percentComplete = (e.loaded / e.total) * 100;
            if (onProgress) onProgress(percentComplete);
        }
    });
    
    // Success
    xhr.addEventListener('load', function() {
        if (xhr.status === 200) {
            if (onSuccess) onSuccess(JSON.parse(xhr.responseText));
        } else {
            if (onError) onError(xhr.statusText);
        }
    });
    
    // Error
    xhr.addEventListener('error', function() {
        if (onError) onError('Upload failed');
    });
    
    xhr.open('POST', url);
    xhr.send(formData);
};

// ========== FORMAT FILE SIZE ==========
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}
