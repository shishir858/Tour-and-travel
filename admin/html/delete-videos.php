<?php
include('connection.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the video ID and ensure it's an integer

    // Fetch the video file path from the database
    $query = "SELECT video_url FROM videos WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $videoPath = $row['video_url'];

        // Delete the video file from the server
        if (file_exists($videoPath)) {
            unlink($videoPath); // Delete the file
        }

        // Delete the video entry from the database
        $deleteQuery = "DELETE FROM videos WHERE id = $id";
        if (mysqli_query($conn, $deleteQuery)) {
            $message = "Video deleted successfully!";
            $status = "success";
        } else {
            $message = "Error deleting video!";
            $status = "error";
        }
    } else {
        $message = "Video not found!";
        $status = "error";
    }
} else {
    $message = "Invalid request!";
    $status = "error";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Video</title>
    <!-- SweetAlert CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<script>
    Swal.fire({
        title: "<?php echo $message; ?>",
        icon: "<?php echo $status; ?>",
        showConfirmButton: false,
        timer: 2000
    }).then(() => {
        window.location.href = "video-gallery.php";
    });
</script>

</body>
</html>
