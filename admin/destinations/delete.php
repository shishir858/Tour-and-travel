<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
check_login();

// Get destination ID
if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

// Check if destination has packages
$package_count_query = "SELECT COUNT(*) as count FROM package_destinations WHERE destination_id = ?";
$stmt = mysqli_prepare($conn, $package_count_query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$package_count_result = mysqli_stmt_get_result($stmt);
$package_count = mysqli_fetch_assoc($package_count_result)['count'];
mysqli_stmt_close($stmt);

if($package_count > 0) {
    // Cannot delete destination with packages
    header('Location: index.php?msg=cannot_delete');
    exit;
}

// Get destination image to delete
$image_query = "SELECT image FROM destinations WHERE id = ?";
$stmt = mysqli_prepare($conn, $image_query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$image_result = mysqli_stmt_get_result($stmt);
$destination = mysqli_fetch_assoc($image_result);
mysqli_stmt_close($stmt);

// Delete destination
$delete_query = "DELETE FROM destinations WHERE id = ?";
$stmt = mysqli_prepare($conn, $delete_query);
mysqli_stmt_bind_param($stmt, "i", $id);

if(mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    // Delete image file if exists
    if(!empty($destination['image'])) {
        delete_image('../uploads/destinations/' . $destination['image']);
    }
    header('Location: index.php?msg=deleted');
} else {
    mysqli_stmt_close($stmt);
    header('Location: index.php?msg=error');
}
exit;
?>
