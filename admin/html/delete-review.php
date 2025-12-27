<?php
include('auth.php'); // Ensure authentication
include('connection.php'); // Database connection

if (isset($_GET['delete_id'])) { // Check 'delete_id' instead
    $review_id = intval($_GET['delete_id']);


    // Delete query
    $sql = "DELETE FROM client_reviews WHERE id = $review_id";

    if ($conn->query($sql) === TRUE) {
        $message = "Review has been deleted.";
        $status = "success";
    } else {
        $message = "Failed to delete review.";
        $status = "error";
    }
} else {
    $message = "Invalid request.";
    $status = "error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Review</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
    Swal.fire({
        title: "<?php echo ($status == 'success') ? 'Deleted!' : 'Error!'; ?>",
        text: "<?php echo $message; ?>",
        icon: "<?php echo $status; ?>",
        showConfirmButton: false,
        timer: 2500
    }).then(() => {
        window.location.href = 'add-testimonial.php';
    });
</script>
</body>
</html>
