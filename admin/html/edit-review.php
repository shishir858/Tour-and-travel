<?php
include('auth.php'); // Ensure authentication
include('connection.php'); // Database connection

// Initialize variables
$client_name = $client_location = $client_rating = $client_review = "";
$updateSuccess = false;

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $review_id = intval($_GET['id']); // Sanitize input

    // Fetch review details
    $sql = "SELECT * FROM client_reviews WHERE id = $review_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $client_name = $row['client_name'];
        $client_location = $row['client_location'];
        $client_rating = $row['client_rating'];
        $client_review = $row['client_review'];
    } else {
        echo "<script>
                alert('Review not found!');
                window.location.href = 'testimonial.php';
              </script>";
        exit;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_name = $conn->real_escape_string($_POST['clientName']);
    $client_location = $conn->real_escape_string($_POST['clientLocation']);
    $client_rating = intval($_POST['clientRating']);
    $client_review = $conn->real_escape_string($_POST['clientReview']);

    // Update query
    $update_sql = "UPDATE client_reviews SET 
                   client_name = '$client_name', 
                   client_location = '$client_location', 
                   client_rating = '$client_rating', 
                   client_review = '$client_review' 
                   WHERE id = $review_id";

    if ($conn->query($update_sql) === TRUE) {
        $updateSuccess = true;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Review</title>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert CDN -->
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar -->
        <?php include('aside.php') ?>

        <!-- Main Content -->
        <div class="body-wrapper">

            <!-- Header -->
            <?php include('header.php') ?>

            <div class="container mt-4">
                <h1>Edit Review</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="clientName">Name:</label>
                        <input type="text" id="clientName" name="clientName" class="form-control"
                            value="<?php echo $client_name; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="clientLocation">Location:</label>
                        <input type="text" id="clientLocation" name="clientLocation" class="form-control"
                            value="<?php echo $client_location; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="clientRating">Rating:</label>
                        <select id="clientRating" name="clientRating" class="form-control" required>
                            <option value="5" <?php if ($client_rating == 5) echo 'selected'; ?>>★★★★★</option>
                            <option value="4" <?php if ($client_rating == 4) echo 'selected'; ?>>★★★★☆</option>
                            <option value="3" <?php if ($client_rating == 3) echo 'selected'; ?>>★★★☆☆</option>
                            <option value="2" <?php if ($client_rating == 2) echo 'selected'; ?>>★★☆☆☆</option>
                            <option value="1" <?php if ($client_rating == 1) echo 'selected'; ?>>★☆☆☆☆</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="clientReview">Review:</label>
                        <textarea id="clientReview" name="clientReview" class="form-control" rows="4"
                            required><?php echo $client_review; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Update Review</button>
                    <a href="testimonial.php" class="btn btn-secondary mt-2">Cancel</a>

                    <!-- Hidden Input to Track Update Success -->
                    <input type="hidden" id="updateSuccess" value="<?php echo $updateSuccess ? 'true' : 'false'; ?>">
                </form>
            </div>
        </div>

        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/sidebarmenu.js"></script>
        <script src="../assets/js/app.min.js"></script>
        <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

        <!-- SweetAlert Script -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let updateSuccess = document.getElementById("updateSuccess").value;
                if (updateSuccess === "true") {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Review updated successfully!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500
                    }).then(() => {
                        window.location.href = 'add-testimonial.php';
                    });
                }
            });
        </script>

</body>

</html>
