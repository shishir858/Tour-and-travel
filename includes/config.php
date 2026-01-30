<?php
// Main Configuration File
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Detect environment (CLI defaults to local)
$is_local = true; // Default to local
if (isset($_SERVER['HTTP_HOST'])) {
    $is_local = (
        $_SERVER['HTTP_HOST'] === 'localhost' || 
        $_SERVER['HTTP_HOST'] === '127.0.0.1' || 
        strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0
    );
}

// Database Configuration
if ($is_local) {
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "sspsof5_tdspt2";
    define('SITE_URL', 'http://localhost/touristdriversindiaprivatetours/');
} else {
    $db_host = "localhost";
    $db_user = "sspsof5_tdip";
    $db_pass = "c3BLiUFay6bU";
    $db_name = "sspsof5_tdip";
    define('SITE_URL', 'https://touristdriversindiaprivatetours.com/');
}

// Create database connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Helper function to get settings
function getSetting($key) {
    global $conn;
    $stmt = $conn->prepare("SELECT setting_value FROM site_settings WHERE setting_key = ?");
    $stmt->bind_param("s", $key);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['setting_value'];
    }
    return null;
}

// SMTP Configuration
define('SMTP_HOST', 'smtp.touristdriversindiaprivatetours.com');
define('SMTP_USER', 'info@touristdriversindiaprivatetours.com');
define('SMTP_PASS', 'SJZpFgA5K27w');
define('SMTP_PORT', 465);
define('SMTP_FROM_EMAIL', 'info@touristdriversindiaprivatetours.com');
define('SMTP_FROM_NAME', 'Tourist Drivers India');
define('SMTP_ADMIN_EMAIL', 'touristdriversindiapvttours@gmail.com');
?>
