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
      <div class="container-fluid">
    <?php

    // Fetch existing contact details
    $query = "SELECT * FROM contact_info WHERE id = 1";
    $result = mysqli_query($conn, $query);
    $headerNumbers = mysqli_fetch_assoc($result);

    // Handle Contact Info Update
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_contact'])) {
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email1 = mysqli_real_escape_string($conn, $_POST['email1']);
        $email2 = mysqli_real_escape_string($conn, $_POST['email2']);
        $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
        $instagram = mysqli_real_escape_string($conn, $_POST['instagram']);
        // $pinterest = mysqli_real_escape_string($conn, $_POST['pinterest']);
        $twitter = mysqli_real_escape_string($conn, $_POST['twitter']);
        $whatsapp = mysqli_real_escape_string($conn, $_POST['whatsapp']);
        $updateQuery = "UPDATE contact_info SET 
                        address = '$address', 
                        phone = '$phone',
                        email1 = '$email1',
                        email2 =  '$email2', 
                        facebook = '$facebook', 
                        instagram = '$instagram',
                        twitter = '$twitter',
                        whatsapp = '$whatsapp'
                        WHERE id = 1";

        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('Contact details updated successfully!'); window.location.href='header-changes.php';</script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    // Handle Logo Upload
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_logo'])) {
        $targetDir = "assets/images/logo/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if not exists
        }

        if (!isset($_FILES["logo"]) || $_FILES["logo"]["error"] !== UPLOAD_ERR_OK) {
            die("<script>alert('File upload error: " . $_FILES["logo"]["error"] . "');</script>");
        }

        $fileName = basename($_FILES["logo"]["name"]);
        $targetFile = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allowed file formats
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            die("<script>alert('Only JPG, JPEG, PNG & GIF files are allowed.');</script>");
        }

        // Check if the file is a real image
        $check = getimagesize($_FILES["logo"]["tmp_name"]);
        if ($check === false) {
            die("<script>alert('File is not a valid image.');</script>");
        }

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFile)) {
            // Update logo path in database
            $updateQuery = "UPDATE contact_info SET logo = '$targetFile' WHERE id = 1";
            if (mysqli_query($conn, $updateQuery)) {
                echo "<script>alert('Logo updated successfully!'); window.location.href='header-changes.php';</script>";
            } else {
                echo "<script>alert('Database update failed!');</script>";
            }
        } else {
            echo "<script>alert('Error uploading file. Check folder permissions.');</script>";
        }
    }
    ?>

    <h2 class="mb-4">Update Contact Information</h2>
    <form method="POST" action="">
        <input type="hidden" name="update_contact" value="1">
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($headerNumbers['address']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($headerNumbers['phone']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email1</label>
            <input type="email" name="email1" class="form-control" value="<?php echo htmlspecialchars($headerNumbers['email1']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email2</label>
            <input type="text" name="email2" class="form-control" value="<?php echo htmlspecialchars($headerNumbers['email2']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Facebook URL</label>
            <input type="text" name="facebook" class="form-control" value="<?php echo htmlspecialchars($headerNumbers['facebook']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Instagram URL</label>
            <input type="text" name="instagram" class="form-control" value="<?php echo htmlspecialchars($headerNumbers['instagram']); ?>">
        </div>
        <!-- <div class="mb-3">
            <label class="form-label">Pinterest URL</label>
            <input type="text" name="pinterest" class="form-control" value="<?php echo htmlspecialchars($headerNumbers['pinterest']); ?>">
        </div> -->
        <div class="mb-3">
            <label class="form-label">Twitter URL</label>
            <input type="text" name="twitter" class="form-control" value="<?php echo htmlspecialchars($headerNumbers['twitter']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Whatsapp</label>
            <input type="text" name="whatsapp" class="form-control" value="<?php echo htmlspecialchars($headerNumbers['whatsapp']); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update Details</button>
    </form>

    <div class="container mt-5">
        <h2>Update Logo</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="update_logo" value="1">
            <div class="mb-3">
                <label class="form-label">Current Logo</label><br>
                <img src="<?php echo htmlspecialchars($headerNumbers['logo']); ?>" style="width:150px;">
            </div>
            <div class="mb-3">
                <label class="form-label">Upload New Logo</label>
                <input type="file" name="logo" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Logo</button>
        </form>
    </div>
</div>

      </div>
      <!-- Table -->




    </div>
  </div>


  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>