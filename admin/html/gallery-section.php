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
      <div class="container-fluid">
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Handle File Upload
          $target_dir = "assets/img/gallery/";


          $target_file = $target_dir . basename($_FILES["image"]["name"]);
          $uploadOk = 1;

          // Check if file is an image
          $check = getimagesize($_FILES["image"]["tmp_name"]);
          if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
          }

          // Check file size (limit: 2MB)
          if ($_FILES["image"]["size"] > 2097152) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }

          // Allow only JPG, JPEG, PNG, GIF
          $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
          if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
          }

          // If all checks pass, upload file
          if ($uploadOk) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
              // Insert into database
              $query = "INSERT INTO gallery (image_url) VALUES (?)";
              $stmt = mysqli_prepare($conn, $query);
              mysqli_stmt_bind_param($stmt, "s", $target_file);
              if (mysqli_stmt_execute($stmt)) {
                echo "Image uploaded successfully!";
              } else {
                echo "Error uploading image.";
              }
              mysqli_stmt_close($stmt);
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
          }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="image" class="form-label">Select Image:</label>
            <input type="file" name="image" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Upload</button>
        </form>

      </div>
      <!-- Table -->
      <div class="container mt-5">
        <?php
        include('connection.php'); // Ensure connection is included
        
        // Fetch gallery images
        $query = "SELECT * FROM gallery ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        ?>

        <h2 class="text-center mb-4">Gallery Images</h2>

        <table class="table table-bordered text-center">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <td>
                  <img src="<?= htmlspecialchars($row['image_url']) ?>" width="100" height="100" alt="Gallery Image">
                </td>
                <td>
                  <a href="edit-gallery-image.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-gallery-image.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure?')">Delete</a>
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