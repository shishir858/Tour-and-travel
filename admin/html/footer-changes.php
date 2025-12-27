<?php
include('auth.php');
include('connection.php');
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
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include('aside.php') ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php include('header.php') ?>
      <!--  Header End -->
      <div class="container-fluid mt-5">

<?php
// Fetch existing data
$query = "SELECT * FROM footer_content WHERE id = 1";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $about_us = mysqli_real_escape_string($conn, trim($_POST['about_us']));
    $branch = mysqli_real_escape_string($conn, trim($_POST['branch1']));

    // Correct update query
    $updateQuery = "UPDATE footer_content SET 
        about_us = ?, 
        branch1 = ?
        WHERE id = 1";

    $stmt = mysqli_prepare($conn, $updateQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $about_us, $branch);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Content Updated Successfully!'); window.location.href='footer-changes.php';</script>";
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error updating content. Please try again.</div>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<div class='alert alert-danger'>Error preparing the statement.</div>";
    }
}
?>

    <h2 class="mb-4">Update Website Content</h2>

    <form action="" method="post">
        <!-- About Us -->
        <div class="mb-3">
            <label class="form-label">About Us</label>
            <textarea class="form-control" name="about_us" rows="3" required><?= htmlspecialchars($data['about_us']) ?></textarea>
        </div>

        <!-- Branch Address -->
        <div class="mb-3">
            <label class="form-label">Branch 1 Address</label>
            <input type="text" class="form-control" name="branch1" value="<?= htmlspecialchars($data['branch1']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Content</button>
    </form>

    </div> <!-- container-fluid -->
    </div> <!-- body-wrapper -->
  </div> <!-- page-wrapper -->

  <!-- Scripts -->
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>
