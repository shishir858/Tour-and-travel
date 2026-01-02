<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
check_login();

// Get vehicle ID
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$vehicle_id = intval($_GET['id']);

// Fetch vehicle details
$query = "SELECT * FROM vehicles_new WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $vehicle_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) == 0) {
    mysqli_stmt_close($stmt);
    header('Location: index.php');
    exit;
}

$vehicle = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Delete image file if exists
if(!empty($vehicle['image'])) {
    delete_image('../uploads/vehicles/' . $vehicle['image']);
}

// Delete vehicle from database
$delete_query = "DELETE FROM vehicles_new WHERE id = ?";
$stmt = mysqli_prepare($conn, $delete_query);
mysqli_stmt_bind_param($stmt, "i", $vehicle_id);

if(mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header('Location: index.php?msg=deleted');
} else {
    mysqli_stmt_close($stmt);
    header('Location: index.php?error=delete_failed');
}
exit;
?>
