<?php
include('auth.php');
include('connection.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch existing video details
    $query = "SELECT * FROM videos WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $video = mysqli_fetch_assoc($result);
    } else {
        echo "<script>
                alert('Video not found!');
                window.location.href = 'video-gallery.php';
              </script>";
        exit;
    }
}

$updateSuccess = false; // Variable to track success

// Update video
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newVideo = $_FILES['video']['name'];
    $targetDir = "assets/img/videos/";
    $targetFile = $targetDir . time() . "_" . basename($newVideo);

    if (!empty($newVideo)) {
        // Delete old video file
        if (file_exists($video['video_url'])) {
            unlink($video['video_url']);
        }

        // Upload new video
        if (move_uploaded_file($_FILES['video']['tmp_name'], $targetFile)) {
            // Update database with new video URL
            $updateQuery = "UPDATE videos SET video_url = '$targetFile' WHERE id = $id";
            if (mysqli_query($conn, $updateQuery)) {
                $updateSuccess = true; // Mark update success
            } else {
                echo "<script>alert('Error updating video!');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload video!');</script>";
        }
    } else {
        echo "<script>alert('Please select a video to upload!');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <?php include('aside.php') ?>

        <div class="body-wrapper">
            <?php include('header.php'); ?>

            <div class="container-fluid mt-5">
                <h2 class="mb-4">Edit Video</h2>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Current Video:</label><br>
                        <video width="300" height="180" controls>
                            <source src="<?php echo $video['video_url']; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload New Video:</label>
                        <input type="file" name="video" class="form-control" accept="video/mp4">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Video</button>
                    <a href="video-gallery.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>

        </div>
    </div>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

    <!-- SweetAlert Success Notification -->
    <?php if ($updateSuccess) : ?>
        <script>
            Swal.fire({
                title: 'Video updated successfully!',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = 'video-gallery.php';
            });
        </script>
    <?php endif; ?>

</body>
</html>
