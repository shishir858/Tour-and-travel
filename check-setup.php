<?php
/**
 * Server Setup Diagnostic Tool
 * Upload this file to check if everything is working
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Server Setup Diagnostic</h1>";
echo "<style>body{font-family:Arial;margin:20px;}h1{color:#333;}h2{color:#666;margin-top:30px;}.success{color:green;}.error{color:red;}.info{color:blue;}</style>";

// 1. PHP Version
echo "<h2>1. PHP Version</h2>";
echo "<p class='info'>PHP Version: " . phpversion() . "</p>";
if (version_compare(phpversion(), '7.4.0', '>=')) {
    echo "<p class='success'>✓ PHP version is compatible</p>";
} else {
    echo "<p class='error'>✗ PHP version should be 7.4 or higher</p>";
}

// 2. Required Extensions
echo "<h2>2. Required PHP Extensions</h2>";
$required_extensions = ['mysqli', 'json', 'mbstring', 'gd'];
foreach ($required_extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "<p class='success'>✓ $ext extension is loaded</p>";
    } else {
        echo "<p class='error'>✗ $ext extension is NOT loaded</p>";
    }
}

// 3. Database Connection
echo "<h2>3. Database Connection Test</h2>";
$is_local = (
    $_SERVER['HTTP_HOST'] === 'localhost' || 
    $_SERVER['HTTP_HOST'] === '127.0.0.1' || 
    strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0
);

if ($is_local) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sspsof5_tdspt";
    echo "<p class='info'>Environment: LOCAL</p>";
} else {
    $servername = "localhost";
    $username = "sspsof5_tdspt";
    $password = "SYlVv16qX459";
    $database = "sspsof5_tdspt";
    echo "<p class='info'>Environment: LIVE</p>";
}

$conn = @mysqli_connect($servername, $username, $password, $database);

if ($conn) {
    echo "<p class='success'>✓ Database connection successful</p>";
    echo "<p class='info'>Database: $database</p>";
    
    // Test query
    $result = mysqli_query($conn, "SHOW TABLES");
    if ($result) {
        $table_count = mysqli_num_rows($result);
        echo "<p class='success'>✓ Found $table_count tables in database</p>";
        
        // Check for required tables
        $required_tables = ['golden_triangle', 'himachal_packages', 'rajasthan_tour', 'tajmahal_tours', 'pilgrimage_package', 'cars', 'gallery', 'videos'];
        echo "<h3>Required Tables:</h3>";
        foreach ($required_tables as $table) {
            $check = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
            if (mysqli_num_rows($check) > 0) {
                echo "<p class='success'>✓ Table '$table' exists</p>";
            } else {
                echo "<p class='error'>✗ Table '$table' is missing</p>";
            }
        }
    }
    mysqli_close($conn);
} else {
    echo "<p class='error'>✗ Database connection failed: " . mysqli_connect_error() . "</p>";
}

// 4. File Permissions
echo "<h2>4. File/Folder Permissions</h2>";
$paths_to_check = [
    'admin/includes/config.php',
    'assets/img',
    'assets/vehicles'
];

foreach ($paths_to_check as $path) {
    if (file_exists($path)) {
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        echo "<p class='info'>$path - Permissions: $perms";
        if (is_writable($path)) {
            echo " <span class='success'>✓ Writable</span></p>";
        } else {
            echo " <span class='error'>✗ Not Writable</span></p>";
        }
    } else {
        echo "<p class='error'>✗ $path does not exist</p>";
    }
}

// 5. Current Directory
echo "<h2>5. Current Directory</h2>";
echo "<p class='info'>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p class='info'>Current File: " . __FILE__ . "</p>";
echo "<p class='info'>Current Dir: " . __DIR__ . "</p>";

// 6. Server Info
echo "<h2>6. Server Information</h2>";
echo "<p class='info'>Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p class='info'>HTTP Host: " . $_SERVER['HTTP_HOST'] . "</p>";
echo "<p class='info'>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";

// 7. Error Log Check
echo "<h2>7. Error Logging</h2>";
echo "<p class='info'>Display Errors: " . ini_get('display_errors') . "</p>";
echo "<p class='info'>Log Errors: " . ini_get('log_errors') . "</p>";
echo "<p class='info'>Error Log File: " . ini_get('error_log') . "</p>";

echo "<hr>";
echo "<p><strong>Note:</strong> Delete this file after checking! It contains sensitive information.</p>";
echo "<p><strong>If everything shows green checkmarks, your server is ready!</strong></p>";
?>
