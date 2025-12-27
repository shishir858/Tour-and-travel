<?php
include('connection.php'); // Database connection

// Check if ID is set
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']); // Sanitize ID

// Fetch the image details
$query = "SELECT * FROM gallery WHERE id = $id";
$result = mysqli_query($conn, $query);
$image = mysqli_fetch_assoc($result);

if (!$image) {
    die("Image not found.");
}

// Initialize a variable for JavaScript alert
$updateSuccess = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_dir = "assets/img/gallery/"; // Ensure the folder exists
    $imageFile = $_FILES['image']['name'];
    $target_file = $target_dir . basename($imageFile);

    // If a new file is uploaded
    if (!empty($imageFile)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Update database with new image
            $updateQuery = "UPDATE gallery SET image_url = '$target_file' WHERE id = $id";
            if (mysqli_query($conn, $updateQuery)) {
                $updateSuccess = true; // Set flag to true
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to update image.',
                    });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed!',
                    text: 'Error uploading the image.',
                });
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery Image</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Edit Gallery Image</h2>

    <form method="POST" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3 text-center">
            <img src="<?= htmlspecialchars($image['image_url']) ?>" width="200" alt="Current Image">
        </div>

        <div class="mb-3">
            <label class="form-label">Select New Image</label>
            <input type="file" class="form-control" name="image" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Image</button>
        <a href="gallery-section.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- SweetAlert script for success message -->
<?php if ($updateSuccess) : ?>
<script>
    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Image updated successfully!',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'gallery-section.php';
        });
    }, 300);
</script>
<?php endif; ?>

</body>
</html>
