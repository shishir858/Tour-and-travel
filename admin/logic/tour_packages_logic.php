<?php
// Tour Packages CRUD Logic
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../');
    exit;
}

// Handle Delete
if (isset($_GET['delete']) && isset($_GET['action']) && $_GET['action'] == 'tour-packages') {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM tour_packages WHERE id = $id");
    header('Location: ../tour-packages.php');
    exit;
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'tour-packages') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $package_name = $conn->real_escape_string($_POST['package_name']);
    $package_image = $conn->real_escape_string($_POST['package_image']);
    $description = $conn->real_escape_string($_POST['description']);
    $rating = $conn->real_escape_string($_POST['rating']);
    $category = $conn->real_escape_string($_POST['category']);
    $booking_link = $conn->real_escape_string($_POST['booking_link']);
    
    if ($id > 0) {
        $conn->query("UPDATE tour_packages SET package_name='$package_name', package_image='$package_image', description='$description', rating='$rating', category='$category', booking_link='$booking_link' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO tour_packages (package_name, package_image, description, rating, category, booking_link) VALUES ('$package_name', '$package_image', '$description', '$rating', '$category', '$booking_link')");
    }
    header('Location: ../tour-packages.php');
    exit;
}
?>
