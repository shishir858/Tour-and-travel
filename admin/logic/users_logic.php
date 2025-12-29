<?php
// Users CRUD Logic
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../');
    exit;
}

// Handle Delete
if (isset($_GET['delete']) && isset($_GET['action']) && $_GET['action'] == 'users') {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM users WHERE id = $id");
    header('Location: ../users.php');
    exit;
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'users') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    
    if ($id > 0) {
        // Update
        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $conn->query("UPDATE users SET email='$email', password='$hashed' WHERE id=$id");
        } else {
            $conn->query("UPDATE users SET email='$email' WHERE id=$id");
        }
    } else {
        // Insert
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $conn->query("INSERT INTO users (email, password) VALUES ('$email', '$hashed')");
    }
    header('Location: ../users.php');
    exit;
}
?>
