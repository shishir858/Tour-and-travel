<?php
include('auth.php'); // Ensure only authenticated admins can delete
include('connection.php');

// Validate and sanitize ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("❌ Invalid ID.");
}

$id = (int)$_GET['id'];

// Optionally delete image file (if needed)
$result = mysqli_query($conn, "SELECT image FROM rajasthan_tour WHERE id = $id");
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $image_path = $row['image'];
    if (file_exists($image_path)) {
        unlink($image_path); // delete image from server
    }
}

// Delete the package
$query = "DELETE FROM rajasthan_tour WHERE id = $id";
if (mysqli_query($conn, $query)) {
    echo "<script>alert('✅ Package deleted successfully.'); window.location.href='add-rajasthan-tour.php';</script>";
} else {
    echo "<p class='alert alert-danger'>❌ Error deleting package: " . mysqli_error($conn) . "</p>";
}
?>
