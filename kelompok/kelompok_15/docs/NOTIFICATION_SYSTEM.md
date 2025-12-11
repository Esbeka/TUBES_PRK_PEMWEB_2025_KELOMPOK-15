# 🔔 Sistem Notifikasi KelasOnline
## Dokumentasi Integrasi & Penggunaan

### 📁 File yang Dibuat

1. **`assets/js/notifications.js`** - JavaScript notification handler dengan AJAX polling
2. **`assets/css/notifications.css`** - Styling untuk dropdown dan notification items
3. **`pages/notifikasi.php`** - Halaman full notification list

---

## 🚀 Cara Integrasi ke Halaman Lain

### Step 1: Tambahkan CSS & JS ke `<head>`

```html
<!-- Di bagian head halaman Anda -->
<link rel="stylesheet" href="../assets/css/notifications.css">
<script src="../assets/js/notifications.js" defer></script>
```

### Step 2: Tambahkan HTML Notification Bell di Navbar

Ganti placeholder notification bell di navbar Anda dengan kode ini:

```html
<!-- Di dalam navbar, sebelum profile -->
<div class="notification-container">
    <button id="notificationBell" class="relative text-white hover:text-blue-200 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        <span class="notification-badge" style="display: none;">0</span>
    </button>
    <!-- Dropdown akan di-inject otomatis oleh JavaScript -->
</div>
```

### Step 3: Sistem Akan Auto-Initialize

File `notifications.js` akan otomatis:
- ✅ Membuat dropdown HTML
- ✅ Load notifikasi dari server (demo data saat ini)
- ✅ Update badge counter
- ✅ Start AJAX polling setiap 30 detik
- ✅ Handle mark as read
- ✅ Handle navigation ke detail

**Tidak perlu kode JavaScript tambahan!** Sistem akan berjalan otomatis setelah DOM loaded.

---

## 🔧 Konfigurasi

### Ubah Interval Polling

Default: 30 detik. Untuk mengubah, edit di `notifications.js`:

```javascript
// Line ~45 di notifications.js
this.startPolling(30000); // 30000ms = 30 detik

// Ubah menjadi (contoh: 60 detik):
this.startPolling(60000);
```

### Stop/Start Polling Secara Manual

```javascript
// Stop polling
notificationSystem.stopPolling();

// Start dengan interval custom
notificationSystem.startPolling(45000); // 45 detik
```

---

## 🔌 Integrasi dengan Backend

### 1. Endpoint yang Perlu Dibuat (Backend Team)

**a. Get Notifications** - `backend/notifications/get-notifications.php`

Response format:
```json
{
    "unreadCount": 3,
    "notifications": [
        {
            "id": 1,
            "title": "Tugas Baru",
            "message": "Tugas REST API telah ditambahkan",
            "link": "detail-kelas-mahasiswa.php?id=1&tab=tugas",
            "icon": "task",
            "isRead": false,
            "createdAt": "2 menit yang lalu",
            "color": "blue"
        }
    ]
}
```

**Icon types**: `task`, `grade`, `warning`, `book`, `success`  
**Color types**: `blue`, `green`, `orange`, `purple`, `red`

**b. Mark as Read** - `backend/notifications/mark-read.php`

Request:
```json
{
    "id": 1
}
```

Response:
```json
{
    "success": true,
    "message": "Notification marked as read"
}
```

**c. Mark All as Read** - `backend/notifications/mark-all-read.php`

Request: POST (no body)

Response:
```json
{
    "success": true,
    "message": "All notifications marked as read"
}
```

### 2. Update JavaScript untuk Backend Integration

Edit file `notifications.js`, ganti function `fetchNotifications()`:

```javascript
async fetchNotifications() {
    // PRODUCTION - Replace demo data dengan API call
    const response = await fetch('/backend/notifications/get-notifications.php');
    if (!response.ok) throw new Error('Failed to fetch notifications');
    return await response.json();
}
```

Edit function `markAsRead()`:

```javascript
async markAsRead(notifId) {
    try {
        // PRODUCTION - API call
        const response = await fetch('/backend/notifications/mark-read.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: notifId })
        });
        
        if (!response.ok) throw new Error('Failed to mark as read');
        
        // Update UI (existing code remains)
        // ...
    } catch (error) {
        console.error('Error:', error);
    }
}
```

Edit function `markAllAsRead()`:

```javascript
async markAllAsRead() {
    try {
        // PRODUCTION - API call
        const response = await fetch('/backend/notifications/mark-all-read.php', {
            method: 'POST'
        });
        
        if (!response.ok) throw new Error('Failed to mark all as read');
        
        // Update UI (existing code remains)
        // ...
    } catch (error) {
        console.error('Error:', error);
    }
}
```

---

## 🎨 Customization

### Mengubah Warna Badge

Edit `notifications.css`:

```css
.notification-badge {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    /* Ubah warna sesuai tema Anda */
}
```

### Mengubah Max Height Dropdown

```css
.notification-list {
    max-height: 460px; /* Ubah sesuai kebutuhan */
}
```

### Disable Polling (Manual Refresh Only)

Di `notifications.js`, comment line polling:

```javascript
init() {
    this.createNotificationHTML();
    this.bindEvents();
    this.loadNotifications();
    // this.startPolling(30000); // DISABLED
}
```

---

## 📱 Responsive Design

Sistem notification sudah fully responsive:

- **Desktop**: Dropdown width 420px, positioned right
- **Mobile**: Full width dengan adjustment, scrollable
- **Tablet**: Auto-adjust dengan breakpoint di 640px

---

## 🎯 Event Handlers

### Custom Event Listeners

Tambahkan listener untuk notification events:

```javascript
// Setelah notification system diinisialisasi
notificationSystem.addEventListener('notificationClick', (notif) => {
    console.log('Notification clicked:', notif);
    // Custom handling
});

notificationSystem.addEventListener('badgeUpdate', (count) => {
    console.log('Unread count:', count);
    // Custom handling (e.g., update document title)
});
```

---

## 🧪 Testing

### Test dengan Demo Data

Demo data sudah tersedia di `fetchNotifications()` function untuk testing UI tanpa backend.

### Test Manual Trigger

Buka browser console:

```javascript
// Load notifications
notificationSystem.loadNotifications();

// Update badge
notificationSystem.updateBadge(5);

// Mark notification as read
notificationSystem.markAsRead(1);

// Mark all as read
notificationSystem.markAllAsRead();

// Toggle dropdown
notificationSystem.toggleDropdown();
```

---

## 📊 Database Schema (untuk Backend Team)

### Table: `notifications`

```sql
CREATE TABLE notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    link VARCHAR(500),
    icon ENUM('task', 'grade', 'warning', 'book', 'success') DEFAULT 'task',
    color ENUM('blue', 'green', 'orange', 'purple', 'red') DEFAULT 'blue',
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_read (id_user, is_read),
    INDEX idx_created (created_at DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Query Examples

**Get unread count:**
```sql
SELECT COUNT(*) as unread_count 
FROM notifications 
WHERE id_user = ? AND is_read = FALSE;
```

**Get latest 5 notifications:**
```sql
SELECT * FROM notifications 
WHERE id_user = ? 
ORDER BY is_read ASC, created_at DESC 
LIMIT 5;
```

**Mark as read:**
```sql
UPDATE notifications 
SET is_read = TRUE 
WHERE id = ? AND id_user = ?;
```

---

## 🔥 Advanced Features (Optional)

### 1. Real-time dengan WebSocket

Untuk notifikasi real-time tanpa polling, gunakan WebSocket:

```javascript
// Di notifications.js, tambahkan:
connectWebSocket() {
    const ws = new WebSocket('ws://your-server/notifications');
    
    ws.onmessage = (event) => {
        const notification = JSON.parse(event.data);
        this.showToastNotification(notification);
        this.loadNotifications(); // Refresh list
    };
}
```

### 2. Toast Notification

Sudah ada styling di CSS. Untuk trigger toast:

```javascript
showToastNotification(notif) {
    const toast = document.createElement('div');
    toast.className = 'notification-toast';
    toast.innerHTML = `
        <div class="toast-icon bg-gradient-to-br from-${notif.color}-600 to-${notif.color}-500">
            <!-- icon svg -->
        </div>
        <div class="toast-content">
            <h4 class="toast-title">${notif.title}</h4>
            <p class="toast-message">${notif.message}</p>
        </div>
        <button class="toast-close" onclick="this.parentElement.remove()">✕</button>
    `;
    
    document.body.appendChild(toast);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        toast.classList.add('hide');
        setTimeout(() => toast.remove(), 300);
    }, 5000);
}
```

---

## 📝 Changelog

### Version 1.0.0 (December 6, 2025)
- ✅ Initial release
- ✅ Bell icon with badge counter
- ✅ Dropdown with 5 latest notifications
- ✅ Mark as read functionality
- ✅ AJAX polling (30s interval)
- ✅ Responsive design
- ✅ Demo data for testing
- ✅ Full notification page (notifikasi.php)

---

## 👥 Support

**Frontend Developer**: Cindy  
**Backend Integration**: Surya & Elisa  
**Testing**: Juan

**Issues?** Check:
1. CSS & JS files loaded correctly
2. HTML structure matches documentation
3. Browser console for errors
4. Backend endpoints returning correct format

---

## 🎓 Next Steps

1. **Backend Team**: Buat 3 endpoints sesuai format di atas
2. **Integration Team**: Test dengan real data
3. **Frontend Team**: Add notification triggers di fitur lain (tugas baru, nilai baru, dll)
4. **Testing Team**: Load testing untuk polling performance

**Good luck! 🚀**
