/**
 * KelasOnline - Notification System
 * Real-time notification handler with AJAX polling
 */

class NotificationSystem {
    constructor() {
        this.notificationContainer = null;
        this.notificationBadge = null;
        this.notificationDropdown = null;
        this.unreadCount = 0;
        this.pollingInterval = null;
        this.isDropdownOpen = false;
        
        this.init();
    }

    init() {
        // Create notification HTML structure
        this.createNotificationHTML();
        
        // Bind event listeners
        this.bindEvents();
        
        // Load initial notifications
        this.loadNotifications();
        
        // Start polling for new notifications (every 30 seconds)
        this.startPolling(30000);
    }

    createNotificationHTML() {
        const bellButton = document.getElementById('notificationBell');
        if (!bellButton) return;

        this.notificationContainer = bellButton.parentElement;
        this.notificationBadge = bellButton.querySelector('.notification-badge');
        
        // Create dropdown if not exists
        if (!document.getElementById('notificationDropdown')) {
            const dropdown = document.createElement('div');
            dropdown.id = 'notificationDropdown';
            dropdown.className = 'notification-dropdown hidden';
            dropdown.innerHTML = `
                <div class="notification-header">
                    <h3 class="notification-title">Notifikasi</h3>
                    <button id="markAllRead" class="mark-all-read">Tandai Semua Dibaca</button>
                </div>
                <div id="notificationList" class="notification-list">
                    <div class="notification-loading">
                        <div class="spinner"></div>
                        <p>Memuat notifikasi...</p>
                    </div>
                </div>
                <div class="notification-footer">
                    <a href="notifikasi.php" class="view-all-link">Lihat Semua Notifikasi →</a>
                </div>
            `;
            this.notificationContainer.appendChild(dropdown);
            this.notificationDropdown = dropdown;
        }
    }

    bindEvents() {
        // Toggle dropdown on bell click
        const bellButton = document.getElementById('notificationBell');
        if (bellButton) {
            bellButton.addEventListener('click', (e) => {
                e.stopPropagation();
                this.toggleDropdown();
            });
        }

        // Mark all as read
        const markAllBtn = document.getElementById('markAllRead');
        if (markAllBtn) {
            markAllBtn.addEventListener('click', () => {
                this.markAllAsRead();
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (this.isDropdownOpen && !this.notificationContainer.contains(e.target)) {
                this.closeDropdown();
            }
        });

        // Prevent dropdown close when clicking inside
        if (this.notificationDropdown) {
            this.notificationDropdown.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        }
    }

    toggleDropdown() {
        if (this.isDropdownOpen) {
            this.closeDropdown();
        } else {
            this.openDropdown();
        }
    }

    openDropdown() {
        if (this.notificationDropdown) {
            this.notificationDropdown.classList.remove('hidden');
            this.notificationDropdown.classList.add('show');
            this.isDropdownOpen = true;
            
            // Reload notifications when opening
            this.loadNotifications();
        }
    }

    closeDropdown() {
        if (this.notificationDropdown) {
            this.notificationDropdown.classList.remove('show');
            this.notificationDropdown.classList.add('hidden');
            this.isDropdownOpen = false;
        }
    }

    async loadNotifications() {
        try {
            // Simulate API call - Replace with actual backend endpoint
            const response = await this.fetchNotifications();
            this.renderNotifications(response.notifications);
            this.updateBadge(response.unreadCount);
        } catch (error) {
            console.error('Error loading notifications:', error);
            this.showError();
        }
    }

    async fetchNotifications() {
        // TODO: Replace with actual API endpoint
        // return await fetch('/backend/notifications/get-notifications.php').then(r => r.json());
        
        // DEMO DATA - Remove this when backend is ready
        return new Promise((resolve) => {
            setTimeout(() => {
                resolve({
                    unreadCount: 3,
                    notifications: [
                        {
                            id: 1,
                            title: 'Tugas Baru',
                            message: 'Tugas "REST API" telah ditambahkan di Pemrograman Web',
                            link: 'detail-kelas-mahasiswa.php?id=1&tab=tugas',
                            icon: 'task',
                            isRead: false,
                            createdAt: '2 menit yang lalu',
                            color: 'blue'
                        },
                        {
                            id: 2,
                            title: 'Tugas Dinilai',
                            message: 'Tugas "Binary Tree" telah dinilai. Nilai: 92',
                            link: 'detail-kelas-mahasiswa.php?id=2&tab=nilai',
                            icon: 'grade',
                            isRead: false,
                            createdAt: '1 jam yang lalu',
                            color: 'green'
                        },
                        {
                            id: 3,
                            title: 'Deadline Reminder',
                            message: 'Tugas "Normalisasi DB" akan berakhir dalam 6 jam',
                            link: 'detail-kelas-mahasiswa.php?id=3&tab=tugas',
                            icon: 'warning',
                            isRead: false,
                            createdAt: '3 jam yang lalu',
                            color: 'orange'
                        },
                        {
                            id: 4,
                            title: 'Materi Baru',
                            message: 'Materi "Pertemuan 12" telah ditambahkan',
                            link: 'detail-kelas-mahasiswa.php?id=1&tab=materi',
                            icon: 'book',
                            isRead: true,
                            createdAt: '5 jam yang lalu',
                            color: 'purple'
                        },
                        {
                            id: 5,
                            title: 'Join Kelas Berhasil',
                            message: 'Anda telah bergabung ke kelas Pemrograman Web',
                            link: 'detail-kelas-mahasiswa.php?id=1',
                            icon: 'success',
                            isRead: true,
                            createdAt: '2 hari yang lalu',
                            color: 'green'
                        }
                    ]
                });
            }, 500);
        });
    }

    renderNotifications(notifications) {
        const listContainer = document.getElementById('notificationList');
        if (!listContainer) return;

        if (!notifications || notifications.length === 0) {
            listContainer.innerHTML = `
                <div class="notification-empty">
                    <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <p>Tidak ada notifikasi</p>
                </div>
            `;
            return;
        }

        const html = notifications.map(notif => this.createNotificationItem(notif)).join('');
        listContainer.innerHTML = html;

        // Bind click events for each notification
        notifications.forEach(notif => {
            const element = document.getElementById(`notif-${notif.id}`);
            if (element) {
                element.addEventListener('click', () => {
                    this.handleNotificationClick(notif);
                });
            }
        });
    }

    createNotificationItem(notif) {
        const iconMap = {
            task: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>`,
            grade: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>`,
            warning: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>`,
            book: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>`,
            success: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>`
        };

        const colorMap = {
            blue: 'from-blue-600 to-blue-500',
            green: 'from-green-600 to-green-500',
            orange: 'from-orange-600 to-orange-500',
            purple: 'from-purple-600 to-purple-500',
            red: 'from-red-600 to-red-500'
        };

        return `
            <div id="notif-${notif.id}" class="notification-item ${notif.isRead ? 'read' : 'unread'}" data-id="${notif.id}">
                <div class="notification-icon bg-gradient-to-br ${colorMap[notif.color] || colorMap.blue}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        ${iconMap[notif.icon] || iconMap.task}
                    </svg>
                </div>
                <div class="notification-content">
                    <h4 class="notification-item-title">${notif.title}</h4>
                    <p class="notification-item-message">${notif.message}</p>
                    <span class="notification-time">${notif.createdAt}</span>
                </div>
                ${!notif.isRead ? '<span class="unread-indicator"></span>' : ''}
            </div>
        `;
    }

    async handleNotificationClick(notif) {
        // Mark as read
        if (!notif.isRead) {
            await this.markAsRead(notif.id);
        }

        // Navigate to link
        if (notif.link) {
            window.location.href = notif.link;
        }

        this.closeDropdown();
    }

    async markAsRead(notifId) {
        try {
            // TODO: Replace with actual API call
            // await fetch('/backend/notifications/mark-read.php', {
            //     method: 'POST',
            //     headers: { 'Content-Type': 'application/json' },
            //     body: JSON.stringify({ id: notifId })
            // });

            // Update UI
            const notifElement = document.getElementById(`notif-${notifId}`);
            if (notifElement) {
                notifElement.classList.remove('unread');
                notifElement.classList.add('read');
                const indicator = notifElement.querySelector('.unread-indicator');
                if (indicator) indicator.remove();
            }

            // Update badge
            this.unreadCount = Math.max(0, this.unreadCount - 1);
            this.updateBadge(this.unreadCount);

            console.log(`Notification ${notifId} marked as read`);
        } catch (error) {
            console.error('Error marking notification as read:', error);
        }
    }

    async markAllAsRead() {
        try {
            // TODO: Replace with actual API call
            // await fetch('/backend/notifications/mark-all-read.php', { method: 'POST' });

            // Update UI
            const unreadItems = document.querySelectorAll('.notification-item.unread');
            unreadItems.forEach(item => {
                item.classList.remove('unread');
                item.classList.add('read');
                const indicator = item.querySelector('.unread-indicator');
                if (indicator) indicator.remove();
            });

            // Update badge
            this.unreadCount = 0;
            this.updateBadge(0);

            console.log('All notifications marked as read');
        } catch (error) {
            console.error('Error marking all notifications as read:', error);
        }
    }

    updateBadge(count) {
        this.unreadCount = count;
        
        if (this.notificationBadge) {
            if (count > 0) {
                this.notificationBadge.textContent = count > 9 ? '9+' : count;
                this.notificationBadge.style.display = 'flex';
                this.notificationBadge.classList.add('pulse');
            } else {
                this.notificationBadge.style.display = 'none';
                this.notificationBadge.classList.remove('pulse');
            }
        }
    }

    showError() {
        const listContainer = document.getElementById('notificationList');
        if (!listContainer) return;

        listContainer.innerHTML = `
            <div class="notification-error">
                <svg class="error-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p>Gagal memuat notifikasi</p>
                <button onclick="notificationSystem.loadNotifications()" class="retry-btn">Coba Lagi</button>
            </div>
        `;
    }

    startPolling(interval = 30000) {
        // Clear existing interval
        if (this.pollingInterval) {
            clearInterval(this.pollingInterval);
        }

        // Start new polling
        this.pollingInterval = setInterval(() => {
            // Only poll if dropdown is closed to avoid interrupting user interaction
            if (!this.isDropdownOpen) {
                this.loadNotifications();
            }
        }, interval);

        console.log(`Notification polling started (${interval / 1000}s interval)`);
    }

    stopPolling() {
        if (this.pollingInterval) {
            clearInterval(this.pollingInterval);
            this.pollingInterval = null;
            console.log('Notification polling stopped');
        }
    }

    destroy() {
        this.stopPolling();
        // Remove event listeners if needed
    }
}

// Initialize notification system when DOM is ready
let notificationSystem;

document.addEventListener('DOMContentLoaded', () => {
    notificationSystem = new NotificationSystem();
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = NotificationSystem;
}
