<?php
include('auth.php');
include('connection.php');

if (isset($_GET['edit_id']) && is_numeric($_GET['edit_id'])) {
    $package_id = intval($_GET['edit_id']);

    // Fetch package details
    $query = "SELECT * FROM tour_packages_row2 WHERE id = $package_id";
    $result = mysqli_query($conn, $query);
    $package = mysqli_fetch_assoc($result);

    if (!$package) {
        echo "<script>window.location.href='add-packages2.php';</script>";
        exit;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $rating = intval($_POST['rating']);
    $booking_link = mysqli_real_escape_string($conn, $_POST['booking_link']);
    $image_path = $package['package_image'];

    // Handle image upload
    if (!empty($_FILES['package_image']['name'])) {
        $image_name = time() . '_' . $_FILES['package_image']['name'];
        $image_tmp = $_FILES['package_image']['tmp_name'];
        $target_dir = "assets/img/packages/" . $image_name;

        // Delete old image
        if (file_exists($package['package_image'])) {
            unlink($package['package_image']);
        }

        move_uploaded_file($image_tmp, $target_dir);
        $image_path = $target_dir;
    }

    $updateQuery = "UPDATE tour_packages_row2 SET package_name='$package_name', package_image='$image_path', description='$description', rating='$rating', booking_link='$booking_link' WHERE id=$package_id";

    $success = mysqli_query($conn, $updateQuery);
    $status = $success ? "success" : "error";
    $message = $success ? "Package updated successfully!" : "Failed to update package.";
    echo "<script>window.location.href='edit-package2.php?edit_id=$package_id&status=$status&message=$message';</script>";
    exit;
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar -->
        <?php include('aside.php') ?>

        <!--  Main Content -->
        <div class="body-wrapper">

            <!--  Header -->
            <?php include('header.php') ?>

            <div class="container-fluid">
            <div class="container-fluid">
        <h2>Edit Package</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="package_name" class="form-label">Package Name</label>
                <input type="text" class="form-control" id="package_name" name="package_name"
                    value="<?= htmlspecialchars($package['package_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="package_image" class="form-label">Upload Package Image</label>
                <input type="file" class="form-control" id="package_image" name="package_image" accept="image/*">
                <?php if (!empty($package['package_image'])): ?>
                    <img src="<?= $package['package_image'] ?>" width="100" alt="Current Image">
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Package Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    required><?= htmlspecialchars($package['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating (out of 5)</label>
                <select class="form-control" id="rating" name="rating">
                    <option value="5" <?= $package['rating'] == 5 ? 'selected' : '' ?>>⭐⭐⭐⭐⭐</option>
                    <option value="4" <?= $package['rating'] == 4 ? 'selected' : '' ?>>⭐⭐⭐⭐</option>
                    <option value="3" <?= $package['rating'] == 3 ? 'selected' : '' ?>>⭐⭐⭐</option>
                    <option value="2" <?= $package['rating'] == 2 ? 'selected' : '' ?>>⭐⭐</option>
                    <option value="1" <?= $package['rating'] == 1 ? 'selected' : '' ?>>⭐</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="booking_link" class="form-label">Booking Link</label>
                <input type="text" class="form-control" id="booking_link" name="booking_link"
                    value="<?= htmlspecialchars($package['booking_link']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Package</button>
        </form>
    </div>
            </div>

            <script>
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const message = urlParams.get('message');

        if (status && message) {
            Swal.fire({
                title: status === 'success' ? 'Updated!' : 'Error!',
                text: decodeURIComponent(message),
                icon: status,
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'add-packages2.php';
            });
        }
    };
</script>


        </div>

        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/sidebarmenu.js"></script>
        <script src="../assets/js/app.min.js"></script>
        <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>