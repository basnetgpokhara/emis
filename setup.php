<?php
/**
 * EMIS Setup Checker
 * ==================
 * Open this file in your browser to verify your installation:
 *   http://localhost/emis/setup.php
 *
 * It checks: PHP version, vendor folder, .env file, database connection,
 * storage permissions, and more. Then DELETE this file for security.
 */

header('Content-Type: text/html; charset=utf-8');

function check($label, $pass, $detail = '')
{
    $color = $pass ? '#16a34a' : '#dc2626';
    $icon  = $pass ? '✔' : '✘';
    echo "<div style='padding:10px 16px;margin:6px 0;border-radius:8px;background:"
        . ($pass ? '#f0fdf4' : '#fef2f2') . ";border:1px solid " . $color . "33;'>"
        . "<strong style='color:$color;'>$icon $label</strong>"
        . ($detail ? " <span style='color:#64748b;font-size:13px;'>– $detail</span>" : '')
        . "</div>";
}

echo "<!DOCTYPE html><html><head><title>EMIS Setup Checker</title>"
   . "<style>body{font-family:Arial,sans-serif;max-width:700px;margin:40px auto;padding:0 20px;color:#1e293b;}"
   . "h1{color:#667eea;margin-bottom:4px;}h2{font-size:16px;color:#475569;font-weight:normal;margin-top:0;}</style>"
   . "</head><body>";
echo "<h1>📚 EMIS Setup Checker</h1><h2>Check your installation status below:</h2>";

// 1. PHP version
$phpOk = version_compare(PHP_VERSION, '8.0.0', '>=');
check('PHP Version: ' . PHP_VERSION, $phpOk, $phpOk ? 'PHP 8.0+ required' : 'You need PHP 8.0 or higher (update XAMPP)');

// 2. Vendor folder
$vendorOk = is_dir(__DIR__ . '/vendor');
check('Composer vendor folder', $vendorOk, $vendorOk ? '' : 'Double-click install.bat (or run: composer install)');

// 3. .env file
$envOk = file_exists(__DIR__ . '/.env');
check('.env file', $envOk, $envOk ? '' : 'Copy .env.example to .env');

// 4. APP_KEY
$keyOk = false;
if ($envOk) {
    $env = file_get_contents(__DIR__ . '/.env');
    preg_match('/^APP_KEY=(.+)$/m', $env, $m);
    $keyOk = isset($m[1]) && strlen(trim($m[1])) > 10;
}
check('APP_KEY set', $keyOk, $keyOk ? '' : 'APP_KEY missing in .env');

// 5. Database connection
$dbOk = false;
$dbDetail = '';
if ($envOk) {
    $env = file_get_contents(__DIR__ . '/.env');
    preg_match('/^DB_DATABASE=(.+)$/m', $env, $m1);
    preg_match('/^DB_USERNAME=(.+)$/m', $env, $m2);
    preg_match('/^DB_PASSWORD=(.*)$/m', $env, $m3);
    $db = trim($m1[1] ?? 'emis');
    $user = trim($m2[1] ?? 'root');
    $pass = trim($m3[1] ?? '');
    try {
        $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=$db;charset=utf8mb4", $user, $pass);
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        $dbOk = true;
        $dbDetail = "Database '$db' connected — " . count($tables) . ' tables found';
        if (count($tables) == 0) {
            $dbDetail = "Database '$db' connected but has 0 tables — import database/emis.sql";
            $dbOk = false;
        }
    } catch (Exception $e) {
        $dbDetail = 'Connection failed: ' . $e->getMessage();
    }
}
check('Database connection', $dbOk, $dbDetail);

// 6. Storage writable (with auto-fix)
$storageDirs = [
    __DIR__ . '/storage',
    __DIR__ . '/storage/framework',
    __DIR__ . '/storage/framework/cache',
    __DIR__ . '/storage/framework/cache/data',
    __DIR__ . '/storage/framework/sessions',
    __DIR__ . '/storage/framework/views',
    __DIR__ . '/storage/logs',
    __DIR__ . '/storage/app',
    __DIR__ . '/storage/app/public',
    __DIR__ . '/public/uploads',
    __DIR__ . '/public/uploads/students',
    __DIR__ . '/public/uploads/teachers',
];
$storageOk = true;
$storageDetail = '';
foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
    // Try to actually write a test file (most accurate check)
    $testFile = $dir . '/.write-test-' . uniqid() . '.tmp';
    $canWrite = @file_put_contents($testFile, 'ok') !== false;
    if ($canWrite) {
        @unlink($testFile);
    } else {
        $storageOk = false;
        $storageDetail .= basename($dir) . ' not writable. ';
    }
}
check('Storage writable (auto-fixed if possible)', $storageOk, $storageOk ? 'All storage folders writable' : $storageDetail . 'Run install.bat or chmod -R 775 storage');

// 7. Tables needed
$neededTables = ['users', 'students', 'teachers', 'classes', 'subjects', 'attendance', 'exams', 'results', 'fees', 'fee_types', 'exam_types', 'enrollments'];
$missingTables = [];
if (isset($tables)) {
    foreach ($neededTables as $t) {
        if (!in_array($t, $tables)) $missingTables[] = $t;
    }
    check('All 12 tables present', count($missingTables) == 0, count($missingTables) ? 'Missing: ' . implode(', ', $missingTables) : '');
}

echo "<div style='margin-top:24px;padding:16px;border-radius:8px;background:#eff6ff;border:1px solid #93c5fd;'>"
   . "<strong>✅ If everything is green above, open your site:</strong><br><br>"
   . "<a href='/' style='font-size:18px;color:#2563eb;font-weight:bold;'>🌐 http://localhost/emis</a><br><br>"
   . "Login: <strong>admin@emis.local</strong> / <strong>password</strong>"
   . "</div>";

echo "<div style='margin-top:16px;padding:12px;border-radius:8px;background:#fefce8;border:1px solid #fde047;'>"
   . "<strong>⚠️ SECURITY:</strong> After everything works, <strong>DELETE this setup.php file</strong> from your server."
   . "</div></body></html>";