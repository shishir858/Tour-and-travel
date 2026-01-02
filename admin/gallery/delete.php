<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
check_login();

// Get image ID
if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

// Get image details
$query = "SELECT * FROM gallery_new WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) == 0) {
    mysqli_stmt_close($stmt);
    header('Location: index.php');
    exit;
}

$image = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Delete image file
if(!empty($image['image_path'])) {
    delete_image('../uploads/gallery/' . $image['image_path']);
}

// Delete from database
$delete_query = "DELETE FROM gallery_new WHERE id = ?";
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
