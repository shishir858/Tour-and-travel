<?php
include('auth.php');
include('connection.php');

$msg = "";
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_name = $conn->real_escape_string($_POST['clientName']);
    $profession = $conn->real_escape_string($_POST['profession']);
    $client_location = $conn->real_escape_string($_POST['clientLocation']);
    $client_rating = intval($_POST['clientRating']);
    $client_review = $conn->real_escape_string($_POST['clientReview']);

    // Insert query
    $sql = "INSERT INTO client_reviews (client_name,profession,client_location, client_rating, client_review) 
            VALUES ('$client_name', '$profession','$client_location', '$client_rating', '$client_review')";

    if ($conn->query($sql) === TRUE) {
        $msg = "<span id='successMsg' class='btn btn-success'>Review submitted successfully!</span>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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

        <!-- Sidebar -->
        <?php include('aside.php') ?>

        <!--  Main Content -->
        <div class="body-wrapper">

            <!--  Header -->
            <?php include('header.php') ?>

            <div class="container-fluid">
                <?php
                // Fetch Reviews from Database
                $sql = "SELECT * FROM client_reviews ORDER BY created_at DESC";
                $result = $conn->query($sql);
                ?>
                <div class="container-fluid mt-5">

                    <h1 class="mb-2">Add Testimonials</h1>
                    <div id="msgContainer"><?php echo $msg; ?></div>

                    <form id="clientReviewForm " action="" method="post">
                        <div class="form-group">
                            <label for="clientName">Name:</label>
                            <input type="text" id="clientName" name="clientName" class="form-control" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="clientName">Profession:</label>
                            <input type="text" id="clientName" name="profession" class="form-control" required>
                        </div> -->
                        <div class="form-group">
                            <label for="clientLocation">Location:</label>
                            <input type="text" id="clientLocation" name="clientLocation" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="clientRating">Rating:</label>
                            <select id="clientRating" name="clientRating" class="form-control" required>
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★☆</option>
                                <option value="3">★★★☆☆</option>
                                <option value="2">★★☆☆☆</option>
                                <option value="1">★☆☆☆☆</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="clientReview">Review:</label>
                            <textarea id="clientReview" name="clientReview" class="form-control" rows="4"
                                required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Submit Review</button>
                    </form>
                </div>
            </div>

            <div class="container-fluid pt-5">
                <h2 class="mb-3">Client Reviews</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <!-- <th>Created At</th> -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['client_location']); ?></td>
                                <td><?php echo str_repeat("★", $row['client_rating']) . str_repeat("☆", 5 - $row['client_rating']); ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['client_review']); ?></td>
                                <td>
                                    <a href="edit-review.php?id=<?php echo $row['id']; ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete-review.php?delete_id=<?php echo $row['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>

        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/sidebarmenu.js"></script>
        <script src="../assets/js/app.min.js"></script>
        <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

        <script>
            // Hide success message after 2.5 seconds
            setTimeout(function () {
                var msgElement = document.getElementById("successMsg");
                if (msgElement) {
                    msgElement.style.display = "none";
                }
            }, 2000);
        </script>

</body>

</html>