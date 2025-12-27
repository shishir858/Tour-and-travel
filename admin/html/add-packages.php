<?php
include('auth.php');
include('connection.php');

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape special characters to prevent SQL injection
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $rating = intval($_POST['rating']);
    $booking_link = mysqli_real_escape_string($conn, $_POST['booking_link']);

    // Image upload handling
    $target_dir = "assets/img/packages/"; // Ensure folder exists

    $target_file = $target_dir . basename($_FILES["package_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image
    $check = getimagesize($_FILES["package_image"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['error'] = "Error: File is not an image.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Allow certain file formats
    $allowed_types = ["jpg", "jpeg", "png", "gif", "avif", "webp", "svg"];
    if (!in_array($imageFileType, $allowed_types)) {
        $_SESSION['error'] = "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Move uploaded file
    if (!move_uploaded_file($_FILES["package_image"]["tmp_name"], $target_file)) {
        $_SESSION['error'] = "Error uploading image.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Insert into database
    $query = "INSERT INTO tour_packages (category,package_name, package_image, description, rating, booking_link)
              VALUES ('$category','$package_name', '$target_file', '$description', '$rating', '$booking_link')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "✅ Package added successfully!";
    } else {
        $_SESSION['error'] = "❌ Database Error: " . mysqli_error($conn);
    }

    // Redirect to the same page to show the message
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
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

        <!-- Sidebar -->
        <?php include('aside.php') ?>

        <!--  Main Content -->
        <div class="body-wrapper">

            <!--  Header -->
            <?php include('header.php') ?>

            <div class="container-fluid">
                <!-- Display Success or Error Messages -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success'];
                        unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                <div class="container-fluid">
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                        <div class="mb-3">
                            <label for="package_name" class="form-label">Package Name</label>
                            <input type="text" class="form-control" id="package_name" name="package_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="package_image" class="form-label">Upload Package Image</label>
                            <input type="file" class="form-control" id="package_image" name="package_image"
                                accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Package Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating (out of 5)</label>
                            <select class="form-control" id="rating" name="rating">
                                <option value="5">⭐⭐⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="1">⭐</option>
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Add Package</button>
                    </form>
                </div>
            </div>

            <div class="container-fluid">
                <h3 class="mt-5">Existing Packages</h3>
                <div class="table-responsive">
                    <table class="table table-bordered w-100">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Package Name</th>
                                <th>Description</th>
                                <th>Rating</th>
                                <!-- <th>Booking Link</th> -->
                                <th style="white-space: nowrap;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM tour_packages ORDER BY id DESC");
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><img style="height:150px;width:100px;object-fit:cover;" src="<?= $row['package_image']; ?>" width="100"></td>
                                    <td><?= htmlspecialchars($row['category']); ?></td>
                                    <td><?= htmlspecialchars($row['package_name']); ?></td>
                                    <td><?= htmlspecialchars($row['description']); ?></td>
                                    <td><?= str_repeat("⭐", $row['rating']); ?></td>
                                    </td>
                                    <td class="text-center" style="white-space: nowrap;">
                                        <a href="edit-package.php?edit_id=<?= $row['id']; ?>"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete-package.php?delete_id=<?= $row['id']; ?>"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
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