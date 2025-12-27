<?php
include('connection.php'); // Include database connection

if (isset($_GET['delete_id'])) {
    $package_id = intval($_GET['delete_id']);

    // Get package image path to delete from server
    $query = "SELECT package_image FROM tour_packages_row2 WHERE id = $package_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        $image_path = $row['package_image'];
        if (file_exists($image_path)) {
            unlink($image_path); // Delete image file
        }
    }

    // Delete package from database
    $deleteQuery = "DELETE FROM tour_packages WHERE id = $package_id";
    $success = mysqli_query($conn, $deleteQuery);
    
    // Redirect with message
    $status = $success ? "success" : "error";
    $message = $success ? "Package has been deleted successfully." : "Failed to delete package.";

    echo "<script>window.location.href='delete-package.php?status=$status&message=$message';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Package</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<script>
    // Get status and message from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const message = urlParams.get('message');

    if (status && message) {
        Swal.fire({
            title: status === 'success' ? 'Deleted!' : 'Error!',
            text: message,
            icon: status,
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'add-packages2.php';
        });
    } else {
        window.location.href = 'add-packages2.php'; // Redirect if no status/message found
    }
</script>

</body>
</html>
