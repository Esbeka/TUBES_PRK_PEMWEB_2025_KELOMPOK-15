# 📄 Export System Documentation

## Overview

The Export System is a comprehensive JavaScript-based solution for exporting data in multiple formats (Excel, PDF, CSV) with a beautiful modal UI, progress tracking, and loading indicators. Perfect for exporting student lists, grades, and statistical reports.

## ✨ Features

### 🎯 Core Features
- **Multiple Export Formats**: Excel (.xlsx), PDF (.pdf), and CSV (.csv)
- **Beautiful Modal UI**: Elegant format selection with visual cards
- **Progress Tracking**: Real-time progress bar with percentage and status messages
- **Loading Indicators**: Smooth loading overlay during export process
- **Export History**: Tracks last 50 exports with localStorage
- **Toast Notifications**: Success, error, warning, and info messages
- **Cancel Functionality**: Ability to cancel ongoing export operations
- **Export Options**: 
  - Include statistics in export
  - Add timestamp to filename
  - Auto-open file after download

### 🎨 UI/UX Features
- **Responsive Design**: Works perfectly on mobile, tablet, and desktop
- **Smooth Animations**: Fade-in, slide-up, and scale animations
- **Glassmorphism Effect**: Modern blur backdrop for modal
- **Color-Coded Formats**: Green (Excel), Red (PDF), Blue (CSV)
- **Hover Effects**: Interactive cards with 3D transforms
- **Dark Mode Support**: Adapts to system color scheme preferences

### 🔧 Technical Features
- **OOP Architecture**: Clean class-based JavaScript
- **Event Delegation**: Efficient event handling
- **Blob API**: Client-side file generation
- **MIME Type Support**: Proper file type handling
- **Error Handling**: Comprehensive try-catch with retry logic
- **State Management**: Tracks current export operation
- **Auto-initialization**: Starts automatically on DOM load

## 🚀 Quick Start

### 1. Include Required Files

Add the CSS and JavaScript files to your HTML:

```html
<!-- In <head> section -->
<link rel="stylesheet" href="../assets/css/export-system.css">

<!-- Before closing </body> tag -->
<script src="../assets/js/export-system.js" defer></script>
```

### 2. Add Export Button

Add a button with the `data-export-type` attribute:

```html
<button 
    class="export-button" 
    data-export-type="mahasiswa"
    data-export-data='{"kelas_id": 1, "semester": "5"}'>
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
    </svg>
    Export Data Mahasiswa
</button>
```

### 3. That's It!

The system auto-initializes and handles everything:
- Modal creation and display
- Format selection
- Progress tracking
- File download
- Notifications

## 📋 Data Attributes

### Required Attributes

#### `data-export-type`
Specifies the type of data to export.

**Values**:
- `mahasiswa` - Export student list
- `nilai` - Export grades
- `statistik` - Export statistics
- Custom values as needed

**Example**:
```html
<button data-export-type="mahasiswa">Export Mahasiswa</button>
<button data-export-type="nilai">Export Nilai</button>
<button data-export-type="statistik">Export Statistik</button>
```

### Optional Attributes

#### `data-export-data`
JSON string containing additional export parameters.

**Example**:
```html
<button 
    data-export-type="nilai"
    data-export-data='{"kelas_id": 1, "semester": "5", "tugas": "all"}'>
    Export Nilai
</button>
```

## ⚙️ Configuration

The system can be configured by modifying the constructor options:

```javascript
// In export-system.js
constructor(options = {}) {
    this.config = {
        exportEndpoint: '/backend/export/',  // Backend API endpoint
        maxRetries: 3,                       // Retry attempts on failure
        timeout: 30000,                      // Request timeout (30 seconds)
        showProgress: true,                  // Show progress bar
        ...options
    };
}
```

### Configuration Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `exportEndpoint` | string | `/backend/export/` | Base URL for export API |
| `maxRetries` | number | 3 | Number of retry attempts |
| `timeout` | number | 30000 | Request timeout in ms |
| `showProgress` | boolean | true | Show progress bar |

## 🔌 Backend API Integration

### API Endpoint Structure

The system expects backend endpoints in this format:

```
POST /backend/export/export-{type}.php
```

Where `{type}` is the value from `data-export-type`.

**Examples**:
- `POST /backend/export/export-mahasiswa.php`
- `POST /backend/export/export-nilai.php`
- `POST /backend/export/export-statistik.php`

### Request Format

**Method**: `POST`

**Content-Type**: `application/json`

**Body**:
```json
{
    "format": "excel",
    "data": {
        "kelas_id": 1,
        "semester": "5"
    },
    "options": {
        "includeStats": true,
        "includeTimestamp": true,
        "openAfterDownload": false
    }
}
```

### Response Format

#### Success Response

**Status**: 200 OK

**Content-Type**: `application/vnd.openxmlformats-officedocument.spreadsheetml.sheet` (Excel)
or `application/pdf` (PDF)
or `text/csv` (CSV)

**Body**: Binary file content

**Headers**:
```
Content-Disposition: attachment; filename="mahasiswa_2024_12_01.xlsx"
Content-Length: <file_size>
```

#### Error Response

**Status**: 400 Bad Request or 500 Internal Server Error

**Content-Type**: `application/json`

**Body**:
```json
{
    "success": false,
    "error": "Gagal mengekspor data",
    "message": "Database connection failed"
}
```

## 📊 Export Formats

### Excel (.xlsx)

**MIME Type**: `application/vnd.openxmlformats-officedocument.spreadsheetml.sheet`

**Features**:
- ✓ Multiple sheets support
- ✓ Cell formatting (bold headers, colors)
- ✓ Auto-fit column width
- ✓ Formulas and calculations
- ✓ Charts and graphs (optional)

**Recommended Library**: [PHPSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet)

**Sample Backend Code**:
```php
<?php
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create new spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Add headers
$sheet->setCellValue('A1', 'NPM');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Email');

// Style headers
$sheet->getStyle('A1:C1')->getFont()->setBold(true);
$sheet->getStyle('A1:C1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FF3B82F6');

// Add data
$row = 2;
foreach ($students as $student) {
    $sheet->setCellValue('A' . $row, $student['npm']);
    $sheet->setCellValue('B' . $row, $student['nama']);
    $sheet->setCellValue('C' . $row, $student['email']);
    $row++;
}

// Auto-size columns
foreach(range('A','C') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Output file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="mahasiswa.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
```

### PDF (.pdf)

**MIME Type**: `application/pdf`

**Features**:
- ✓ Professional formatting
- ✓ Headers and footers
- ✓ Page numbers
- ✓ Logos and branding
- ✓ Tables with borders

**Recommended Library**: [TCPDF](https://github.com/tecnickcom/TCPDF)

**Sample Backend Code**:
```php
<?php
require_once 'vendor/autoload.php';

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('KelasOnline');
$pdf->SetAuthor('Universitas Lampung');
$pdf->SetTitle('Daftar Mahasiswa');

// Set margins
$pdf->SetMargins(15, 15, 15);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);

// Add page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Daftar Mahasiswa', 0, 1, 'C');

// Table header
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(40, 7, 'NPM', 1, 0, 'C');
$pdf->Cell(70, 7, 'Nama', 1, 0, 'C');
$pdf->Cell(70, 7, 'Email', 1, 1, 'C');

// Table data
$pdf->SetFont('helvetica', '', 10);
foreach ($students as $student) {
    $pdf->Cell(40, 6, $student['npm'], 1, 0, 'L');
    $pdf->Cell(70, 6, $student['nama'], 1, 0, 'L');
    $pdf->Cell(70, 6, $student['email'], 1, 1, 'L');
}

// Output file
$pdf->Output('mahasiswa.pdf', 'D');
exit;
?>
```

### CSV (.csv)

**MIME Type**: `text/csv`

**Features**:
- ✓ Universal compatibility
- ✓ Small file size
- ✓ Easy to parse
- ✓ Opens in Excel/Sheets

**Sample Backend Code**:
```php
<?php
// Set headers
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="mahasiswa.csv"');

// Create file pointer
$output = fopen('php://output', 'w');

// Add UTF-8 BOM for Excel compatibility
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Add headers
fputcsv($output, ['NPM', 'Nama', 'Email', 'Tanggal Daftar', 'Status']);

// Add data
foreach ($students as $student) {
    fputcsv($output, [
        $student['npm'],
        $student['nama'],
        $student['email'],
        $student['tanggal_daftar'],
        $student['status']
    ]);
}

fclose($output);
exit;
?>
```

## 🎯 Export Options

The modal includes three checkboxes for export customization:

### 1. Include Statistics
```javascript
includeStats: true/false
```
Adds summary statistics to the export:
- Total count
- Average values
- Min/Max values
- Distribution charts

### 2. Include Timestamp
```javascript
includeTimestamp: true/false
```
Appends timestamp to filename:
- `mahasiswa.xlsx` → `mahasiswa_2024_12_01_14_30.xlsx`

### 3. Open After Download
```javascript
openAfterDownload: true/false
```
Automatically opens the file after download (if browser allows).

## 📱 Responsive Design

The system includes responsive breakpoints:

### Desktop (> 768px)
- 3-column format grid
- Full modal width (900px max)
- Large icons (64x64px)

### Tablet (768px)
- Single-column format grid
- Reduced padding
- Medium icons

### Mobile (< 480px)
- Full-width modal
- Stacked layout
- Touch-friendly buttons
- Large touch targets (44x44px min)

## 🎨 CSS Classes

### Modal Classes

| Class | Description |
|-------|-------------|
| `.export-modal` | Modal container overlay |
| `.export-modal-overlay` | Backdrop with blur |
| `.export-modal-content` | White modal card |
| `.export-modal-header` | Blue gradient header |
| `.export-modal-title` | Modal title with icon |
| `.export-modal-close` | Close button (X) |
| `.export-format-grid` | 3-column format grid |
| `.export-format-card` | Format option card |
| `.export-format-icon` | Format icon container |
| `.excel-icon` | Excel format icon (green) |
| `.pdf-icon` | PDF format icon (red) |
| `.csv-icon` | CSV format icon (blue) |
| `.export-format-btn` | Format selection button |
| `.export-options` | Checkbox options section |
| `.export-checkbox` | Checkbox container |

### Loading Classes

| Class | Description |
|-------|-------------|
| `.export-loading-overlay` | Loading screen overlay |
| `.export-loading-content` | Loading card content |
| `.export-loading-spinner` | Rotating spinner |
| `.export-progress-bar` | Progress bar container |
| `.export-progress-fill` | Progress bar fill |
| `.export-cancel-btn` | Cancel button |

### Button Classes

| Class | Description |
|-------|-------------|
| `.export-button` | Primary export button (green) |
| `.export-button.secondary` | Secondary button (blue) |

### Notification Classes

| Class | Description |
|-------|-------------|
| `.export-notification` | Toast notification |
| `.export-notification.success` | Success (green) |
| `.export-notification.error` | Error (red) |
| `.export-notification.warning` | Warning (orange) |
| `.export-notification.info` | Info (blue) |

## 🔧 JavaScript API

### Methods

#### `init()`
Initialize the export system.

```javascript
const exportSystem = new ExportSystem();
exportSystem.init();
```

#### `openModal()`
Programmatically open the export modal.

```javascript
exportSystem.openModal();
```

#### `closeModal()`
Close the export modal.

```javascript
exportSystem.closeModal();
```

#### `startExport(type, format, data, options)`
Start an export operation.

```javascript
exportSystem.startExport(
    'mahasiswa',           // type
    'excel',               // format
    { kelas_id: 1 },      // data
    { includeStats: true } // options
);
```

#### `cancelExport()`
Cancel the current export operation.

```javascript
exportSystem.cancelExport();
```

#### `showNotification(message, type)`
Display a toast notification.

```javascript
exportSystem.showNotification('Export berhasil!', 'success');
exportSystem.showNotification('Terjadi kesalahan', 'error');
exportSystem.showNotification('Peringatan!', 'warning');
exportSystem.showNotification('Informasi', 'info');
```

#### `destroy()`
Clean up and remove the export system.

```javascript
exportSystem.destroy();
```

### Events

The system fires custom events during export:

```javascript
// Listen for export start
document.addEventListener('export:start', (e) => {
    console.log('Export started:', e.detail);
});

// Listen for export progress
document.addEventListener('export:progress', (e) => {
    console.log('Progress:', e.detail.percent + '%');
});

// Listen for export complete
document.addEventListener('export:complete', (e) => {
    console.log('Export complete:', e.detail);
});

// Listen for export error
document.addEventListener('export:error', (e) => {
    console.error('Export error:', e.detail);
});
```

## 🧪 Testing

### Test Scenarios

#### 1. Modal Opening
```javascript
// Click export button
document.querySelector('[data-export-type="mahasiswa"]').click();

// Expected: Modal appears with 3 format cards
```

#### 2. Format Selection
```javascript
// Click Excel format button
document.querySelector('.export-format-btn[data-format="excel"]').click();

// Expected: Modal closes, loading overlay appears
```

#### 3. Progress Tracking
```javascript
// Monitor progress updates
document.addEventListener('export:progress', (e) => {
    console.log(e.detail.percent + '%'); // 20%, 40%, 60%, 80%, 95%, 100%
});
```

#### 4. File Download
```javascript
// After export completes
// Expected: File downloads automatically with correct filename and type
```

#### 5. Error Handling
```javascript
// Simulate API error
// Expected: Error notification appears, loading overlay closes
```

#### 6. Cancel Operation
```javascript
// Click cancel during export
document.querySelector('.export-cancel-btn').click();

// Expected: Confirmation dialog, export stops if confirmed
```

### Manual Testing Checklist

- [ ] Modal opens on button click
- [ ] All three format cards are visible
- [ ] Format icons have correct colors (green/red/blue)
- [ ] Export options checkboxes work
- [ ] Close button (X) closes modal
- [ ] Clicking overlay closes modal
- [ ] ESC key closes modal
- [ ] Loading overlay appears during export
- [ ] Progress bar animates smoothly
- [ ] Progress percentage updates (0-100%)
- [ ] Status messages change during export
- [ ] Cancel button works during export
- [ ] File downloads with correct name and type
- [ ] Success notification appears
- [ ] Error notification appears on failure
- [ ] Export history saves to localStorage
- [ ] Responsive design works on mobile
- [ ] Dark mode adapts correctly

## 🌐 Browser Compatibility

### Supported Browsers

| Browser | Version | Status |
|---------|---------|--------|
| Chrome | 90+ | ✅ Full Support |
| Firefox | 88+ | ✅ Full Support |
| Safari | 14+ | ✅ Full Support |
| Edge | 90+ | ✅ Full Support |
| Opera | 76+ | ✅ Full Support |

### Required Features

- **ES6+ JavaScript**: Classes, async/await, arrow functions
- **CSS3**: Flexbox, Grid, transforms, animations
- **HTML5**: data attributes, template literals
- **Web APIs**: Blob, URL.createObjectURL, localStorage

### Fallbacks

For older browsers, consider using:
- [Babel](https://babeljs.io/) for JavaScript transpilation
- [Autoprefixer](https://github.com/postcss/autoprefixer) for CSS vendor prefixes
- [Polyfill.io](https://polyfill.io/) for missing APIs

## 🚨 Troubleshooting

### Modal Not Opening

**Problem**: Button click doesn't open modal

**Solutions**:
1. Check if `export-system.js` is loaded:
   ```javascript
   console.log(window.ExportSystem); // Should show class
   ```

2. Check data attribute:
   ```html
   <!-- Correct -->
   <button data-export-type="mahasiswa">Export</button>
   
   <!-- Wrong -->
   <button data-export="mahasiswa">Export</button>
   ```

3. Check browser console for errors

### Download Not Starting

**Problem**: Export completes but file doesn't download

**Solutions**:
1. Check backend response headers:
   ```
   Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
   Content-Disposition: attachment; filename="file.xlsx"
   ```

2. Check CORS settings if API is on different domain

3. Check browser popup blocker

### Progress Bar Not Updating

**Problem**: Progress bar stuck at 0%

**Solutions**:
1. Check `showProgress` config is `true`
2. Ensure `updateProgress()` is called in export flow
3. Check browser console for JavaScript errors

### Styling Issues

**Problem**: Modal looks broken or unstyled

**Solutions**:
1. Ensure `export-system.css` is loaded before `export-system.js`
2. Check for CSS conflicts with existing styles
3. Use browser DevTools to inspect element styles
4. Clear browser cache

### Backend Integration Issues

**Problem**: API returns errors

**Solutions**:
1. Check endpoint URL matches config:
   ```javascript
   exportEndpoint: '/backend/export/' // Should match your setup
   ```

2. Check request payload format matches backend expectations

3. Enable backend error logging:
   ```php
   error_log(print_r($_POST, true));
   ```

4. Test endpoint with tools like Postman

## 📚 Examples

### Example 1: Export Student List

```html
<button 
    class="export-button"
    data-export-type="mahasiswa"
    data-export-data='{"kelas_id": 1, "semester": "5"}'>
    <svg>...</svg>
    Export Mahasiswa
</button>
```

### Example 2: Export Grades with Statistics

```html
<button 
    class="export-button"
    data-export-type="nilai"
    data-export-data='{"tugas": "all", "include_stats": true}'>
    <svg>...</svg>
    Export Nilai
</button>
```

### Example 3: Custom Configuration

```javascript
// In your JavaScript file
document.addEventListener('DOMContentLoaded', () => {
    const exportSystem = new ExportSystem({
        exportEndpoint: '/api/export/',
        maxRetries: 5,
        timeout: 60000,
        showProgress: true
    });
    
    exportSystem.init();
});
```

### Example 4: Programmatic Export

```javascript
// Trigger export programmatically
const exportBtn = document.querySelector('[data-export-type="mahasiswa"]');
exportBtn.click();

// Or use the API directly
exportSystem.startExport(
    'mahasiswa',
    'excel',
    { kelas_id: 1 },
    { includeStats: true, includeTimestamp: true }
);
```

## 📦 Files Structure

```
project/
├── assets/
│   ├── css/
│   │   └── export-system.css       # Export system styles (800 lines)
│   └── js/
│       └── export-system.js        # Export system logic (650 lines)
├── pages/
│   └── export-demo.php             # Demo page with examples
├── backend/
│   └── export/
│       ├── export-mahasiswa.php    # Student export endpoint
│       ├── export-nilai.php        # Grades export endpoint
│       └── export-statistik.php    # Statistics export endpoint
└── EXPORT_SYSTEM.md                # This documentation
```

## 🎓 Best Practices

### 1. Security
- Validate all input data on backend
- Use prepared statements for database queries
- Implement rate limiting on export endpoints
- Check user permissions before exporting data
- Sanitize filenames to prevent path traversal

### 2. Performance
- Use pagination for large datasets
- Implement caching for frequently exported data
- Use background jobs for large exports
- Compress files before sending
- Use CDN for static assets

### 3. User Experience
- Show clear progress indicators
- Provide estimated time remaining
- Allow cancellation of long exports
- Save export preferences
- Auto-download on mobile

### 4. Accessibility
- Use semantic HTML
- Provide keyboard navigation
- Include ARIA labels
- Ensure sufficient color contrast
- Test with screen readers

## 📄 License

This export system is part of the KelasOnline project by Kelompok 15.

---

## 🤝 Support

For issues or questions:
1. Check this documentation
2. Review the demo page (`export-demo.php`)
3. Check browser console for errors
4. Contact the development team

**Happy Exporting! 🎉**
