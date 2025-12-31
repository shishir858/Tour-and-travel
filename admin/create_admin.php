<?php
require_once 'includes/config.php';

// Generate password hash
$password = 'admin123';
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insert admin user
$username = 'admin';
$email = 'admin@touristdriversindia.com';
$full_name = 'Admin User';
$role = 'super_admin';
$is_active = 1;

$query = "INSERT INTO admin_users (username, email, password, full_name, role, is_active, created_at, updated_at) 
          VALUES ('$username', '$email', '$password_hash', '$full_name', '$role', $is_active, NOW(), NOW())";

if(mysqli_query($conn, $query)) {
    echo "<h2>✅ Admin User Created Successfully!</h2>";
    echo "<p><strong>Username:</strong> admin</p>";
    echo "<p><strong>Password:</strong> admin123</p>";
    echo "<p><strong>Email:</strong> admin@touristdriversindia.com</p>";
    echo "<p><strong>Role:</strong> super_admin</p>";
    echo "<br><a href='index.php'>Go to Login Page</a>";
} else {
    echo "<h2>❌ Error:</h2>";
    echo "<p>" . mysqli_error($conn) . "</p>";
}

mysqli_close($conn);
?>
