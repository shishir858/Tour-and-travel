<?php
include('auth.php');
include('connection.php');


$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "assets/img/videos/";
    $videoFileType = strtolower(pathinfo($_FILES["video"]["name"], PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = array("mp4", "mov", "avi", "wmv");

    if (!in_array($videoFileType, $allowedTypes)) {
        $msg = '<div class="alert alert-danger">Only MP4, MOV, AVI, and WMV files are allowed.</div>';
    } else {
        // Rename video to avoid conflicts
        $videoName = time() . "_" . basename($_FILES["video"]["name"]);
        $target_file = $target_dir . $videoName;

        if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
            $video_url = $target_file;

            // Insert into database
            $sql = "INSERT INTO videos (video_url) VALUES ('$video_url')";
            if (mysqli_query($conn, $sql)) {
                $msg = '<div class="alert alert-success">Video uploaded successfully!</div>';
            } else {
                $msg = '<div class="alert alert-danger">Database error: ' . mysqli_error($conn) . '</div>';
            }
        } else {
            $msg = '<div class="alert alert-danger">Error uploading video.</div>';
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php include('aside.php') ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php include('header.php') ?>
            <!--  Header End -->
            <div class="container-fluid mt-5">
                <h2 class="mb-4 text-center">Upload Video</h2>

                <?= $msg ?>

                <form action="" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow bg-white">
                    <div class="mb-3">
                        <label class="form-label">Select Video:</label>
                        <input type="file" name="video" accept="video/*" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Upload</button>
                </form>

            </div>

            <!-- Table -->
            <?php
            // Fetch videos from database
            $sql = "SELECT * FROM videos ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            ?>
            <div class="container mt-4">
                <h2 class="mb-3 text-center">Uploaded Videos</h2>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Video</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>
                        <video width='200' height='120' controls>
                            <source src='" . $row['video_url'] . "' type='video/mp4'>
                            Your browser does not support the video tag.
                        </video>
                      </td>";
                                echo "<td>
                        <a href='edit-video.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete-videos.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center'>No videos uploaded yet.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>



        </div>
    </div>


    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>