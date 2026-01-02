<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
check_login();

// Get category ID
if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

// Check if category has packages
$package_count_query = "SELECT COUNT(*) as count FROM tour_packages WHERE category_id = ?";
$stmt = mysqli_prepare($conn, $package_count_query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$package_count_result = mysqli_stmt_get_result($stmt);
$package_count = mysqli_fetch_assoc($package_count_result)['count'];
mysqli_stmt_close($stmt);

if($package_count > 0) {
    // Cannot delete category with packages
    header('Location: index.php?msg=cannot_delete');
    exit;
}

// Delete category
$delete_query = "DELETE FROM categories WHERE id = ?";
$stmt = mysqli_prepare($conn, $delete_query);
mysqli_stmt_bind_param($stmt, "i", $id);

if(mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header('Location: index.php?msg=deleted');
} else {
    mysqli_stmt_close($stmt);
    header('Location: index.php?msg=error');
}
exit;
?>
