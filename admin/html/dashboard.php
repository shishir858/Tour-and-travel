<?php
include('auth.php');
include('connection.php');

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
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
      <?php
include('connection.php'); // Include database connection

// Fetch counts from the database
$query = "
    SELECT 
        (SELECT COUNT(*) FROM golden_triangle) AS gallery_count,
        (SELECT COUNT(*) FROM himachal_packages) AS videos_count,
        (SELECT COUNT(*) FROM pilgrimage_package) AS reviews_count,
        (SELECT COUNT(*) FROM rajasthan_tour) AS packages_count,
        (SELECT COUNT(*) FROM tajmahal_tours) AS other_services
";

$result = $conn->query($query);
$row = $result->fetch_assoc();
?>

<div class="container-fluid">
    <div class="container-fluid">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                
                <div class="row g-4">

                    <!-- Gallery -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="rounded-3 bg-danger d-flex justify-content-center flex-column p-5 align-items-center shadow-lg">
                            <h2 class="text-white fw-bold text-center display-3"><?php echo $row['gallery_count']; ?></h2>
                            <h4 class="text-white fw-bold text-center">Golden Triangle</h4>
                        </div>
                    </div>

                    <!-- Videos -->
                

                    <!-- Client Reviews -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="rounded-3 bg-warning d-flex justify-content-center flex-column p-5 align-items-center shadow-lg">
                            <h2 class="text-white fw-bold text-center display-3"><?php echo $row['reviews_count']; ?></h2>
                            <h4 class="text-white fw-bold text-center">Pilgrimage Package</h4>
                        </div>
                    </div>

                    <!-- Tour Packages -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="rounded-3 bg-primary d-flex justify-content-center flex-column p-5 align-items-center shadow-lg">
                            <h2 class="text-white fw-bold text-center display-3"><?php echo $row['packages_count']; ?></h2>
                            <h4 class="text-white fw-bold text-center">Rajasthan Tour</h4>
                        </div>
                    </div>

                    <!-- Tour Packages Row 2 -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="rounded-3 bg-dark d-flex justify-content-center flex-column p-5 align-items-center shadow-lg">
                            <h2 class="text-white fw-bold text-center display-3"><?php echo $row['other_services']; ?></h2>
                            <h4 class="text-white fw-bold text-center">Tajmahal Tours</h4>
                        </div>
                    </div>

                </div>
            </div>
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