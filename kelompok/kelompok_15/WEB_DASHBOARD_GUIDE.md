# Web Testing Dashboard - User Guide

## Quick Start

1. **Open Dashboard**: http://localhost/TUGASAKHIR/kelompok/kelompok_15/pages/test-kelas-dashboard.html
2. **Click "Run Tests"** button
3. **View Results** - See all test results in real-time

## Dashboard Features

### 📊 Summary Cards
- **Total Tests**: Number of tests executed
- **Passed**: Number of successful tests
- **Failed**: Number of failed tests  
- **Success Rate**: Percentage of passing tests

### 🧪 Test Categories

#### 1. Generate Kode Unik
Tests that validate unique code generation:
- Generate first unique code
- Verify duplicate constraint
- Batch generate 10 codes
- Format validation (AA0000)

#### 2. Cascade Delete
Tests that validate cascade delete functionality:
- Data exists before delete
- All related data deleted after cascade

#### 3. Authorization
Tests that validate permission controls:
- Non-owner cannot edit
- Non-owner cannot delete
- Owner can edit own class
- Data isolation per dosen

### 📋 Detailed Results Table
Shows every test with:
- Test number
- Test name
- Pass/Fail status
- Detailed message

## How It Works

```
Dashboard (HTML/JS)
    ↓
Fetch test-api.php
    ↓
[Success] → Display results
    ↓
[Error] → Fallback to test-db-check.php
    ↓
[Success] → Display results
    ↓
[Error] → Show error message
```

## Smart Fallback System

The dashboard uses a two-tier testing approach:

### Tier 1: Comprehensive Tests (test-api.php)
- Runs all 10 tests
- Tests unique code generation
- Tests cascade delete
- Tests authorization
- Returns detailed results with messages

### Tier 2: Database Diagnostics (test-db-check.php)
- Verifies PHP execution
- Checks database configuration
- Tests database connection
- Lists all table availability
- Useful for troubleshooting

## Error Handling

### Common Errors

#### "Error: Unexpected token '<'"
- Database connection failed
- Check if `kelasonline` database exists
- Verify tables are created

**Solution**:
```bash
mysql -u root < database/schema.sql
```

#### "Error fetching endpoint"
- Network issue or server down
- Check if server is running (Apache + MySQL)
- Verify file paths are correct

#### No tests run
- Check browser console (F12)
- Look for JavaScript errors
- Verify JSON response format

## Troubleshooting

### Step 1: Check Console Logs
Press `F12` → Console tab → Look for errors

### Step 2: Test Each Endpoint
- test-simple-api.php → Should return simple JSON
- test-db-check.php → Should show database status
- test-api.php → Should run full test suite

### Step 3: Verify Database
```bash
mysql -u root
mysql> SHOW DATABASES;           # Should include 'kelasonline'
mysql> USE kelasonline;
mysql> SHOW TABLES;              # Should list all required tables
```

### Step 4: Check Server Status
- Open http://localhost/TUGASAKHIR/kelompok/kelompok_15/
- If 404 → Server/path issue
- If loads → Server is working

## API Response Format

### Success Response
```json
{
  "success": true,
  "stats": {
    "total": 10,
    "passed": 10,
    "failed": 0,
    "success_rate": 100
  },
  "test1": [
    {
      "name": "Test name",
      "passed": true,
      "message": "Success message"
    }
  ],
  "test2": [...],
  "test3": [...],
  "tests": [...]
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error description"
}
```

## Testing Methods

### Method 1: Web Dashboard (Recommended for Visual Testing)
- **File**: `pages/test-kelas-dashboard.html`
- **Browser**: Any modern browser
- **Time**: ~10-30 seconds
- **Best for**: Quick verification, debugging

### Method 2: CLI (Recommended for CI/CD)
- **File**: `backend/kelas/test-kelas.php`
- **Command**: `php test-kelas.php`
- **Time**: ~5-15 seconds
- **Best for**: Automated testing, integration

### Method 3: Direct API Endpoint
- **URL**: `backend/kelas/test-api.php`
- **Method**: GET/POST
- **Response**: JSON
- **Best for**: Integration, programmatic access

## Performance

- Test execution time: ~10-30 seconds
- Dashboard loading: Instant
- Network latency: Depends on server
- Database operations: ~5-10 seconds

## Security Notes

- Tests create temporary test users
- Tests clean up after execution
- No sensitive data exposed
- Uses same authentication as production

## Related Files

- `test-kelas-dashboard.html` - Dashboard UI
- `test-api.php` - Main test API
- `test-db-check.php` - Database diagnostics
- `test-simple-api.php` - Simple validation
- `test-diagnostics.html` - Diagnostic tools
- `test-kelas.php` - CLI test suite

## Support

For issues with the testing dashboard:

1. Check `COMPLETION_SUMMARY.txt` for overview
2. Review `TEST_METHODS_GUIDE.md` for detailed guide
3. Check `KELAS_TESTING_GUIDE.md` for API details
4. Review console logs with F12 in browser
5. Test each endpoint individually

---

**Last Updated**: Current Session  
**Status**: Production Ready ✅
