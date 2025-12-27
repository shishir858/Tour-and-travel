<?php
include('connection.php'); // Database connection

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the image URL from the database
    $query = "SELECT image_url FROM gallery WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $image_url);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Delete image file from folder
    if (!empty($image_url) && file_exists($image_url)) {
        unlink($image_url); // Remove file from directory
    }

    // Delete record from the database
    $query = "DELETE FROM gallery WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $message = "Image has been deleted successfully!";
        $alertType = "success";
    } else {
        $message = "Failed to delete image. Please try again.";
        $alertType = "error";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    $message = "No image selected for deletion.";
    $alertType = "warning";
}
?>

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        title: "<?= ucfirst($alertType) ?>!",
        text: "<?= $message ?>",
        icon: "<?= $alertType ?>",
        confirmButtonText: "OK"
    }).then(() => {
        window.location.href = "gallery-section.php";
    });
});
</script>
