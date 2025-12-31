<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
check_login();

// Get package ID
if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

// Check if package has bookings
$booking_count_query = "SELECT COUNT(*) as count FROM bookings WHERE package_id = $id";
$booking_count_result = mysqli_query($conn, $booking_count_query);
$booking_count = mysqli_fetch_assoc($booking_count_result)['count'];

if($booking_count > 0) {
    // Cannot delete package with bookings
    header('Location: index.php?msg=cannot_delete');
    exit;
}

// Get package image to delete
$image_query = "SELECT featured_image FROM tour_packages WHERE id = $id";
$image_result = mysqli_query($conn, $image_query);
$package = mysqli_fetch_assoc($image_result);

// Delete related data first
mysqli_query($conn, "DELETE FROM package_destinations WHERE package_id = $id");
mysqli_query($conn, "DELETE FROM package_itinerary WHERE package_id = $id");
mysqli_query($conn, "DELETE FROM package_inclusions WHERE package_id = $id");
mysqli_query($conn, "DELETE FROM package_exclusions WHERE package_id = $id");
mysqli_query($conn, "DELETE FROM package_pricing WHERE package_id = $id");

// Delete package
$delete_query = "DELETE FROM tour_packages WHERE id = $id";

if(mysqli_query($conn, $delete_query)) {
    // Delete image file if exists
    if(!empty($package['featured_image'])) {
        delete_image('../uploads/packages/' . $package['featured_image']);
    }
    header('Location: index.php?msg=deleted');
} else {
    header('Location: index.php?msg=error');
}
exit;
?>
