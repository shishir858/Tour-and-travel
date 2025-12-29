<?php
// Gallery CRUD Logic
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../');
    exit;
}

// Handle Delete
if (isset($_GET['delete']) && isset($_GET['action']) && $_GET['action'] == 'gallery') {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM gallery WHERE id = $id");
    header('Location: ../gallery.php');
    exit;
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'gallery') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $image_url = $conn->real_escape_string($_POST['image_url']);
    
    if ($id > 0) {
        $conn->query("UPDATE gallery SET image_url='$image_url' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO gallery (image_url) VALUES ('$image_url')");
    }
    header('Location: ../gallery.php');
    exit;
}
?>
