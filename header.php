<?php  include('admin/html/connection.php')?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Best India Travel Company - Tourist Drivers India Private Tours</title>
    <!-- /SEO Ultimate -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="192x192" href="./admin/html/<?php echo $headerrow['logo']; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="./admin/html/<?php echo $headerrow['logo']; ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="./admin/html/<?php echo $headerrow['logo']; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="./admin/html/<?php echo $headerrow['logo']; ?>">
    <link rel="manifest" href="./assets/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Latest compiled and minified CSS -->
    <link href="./assets/bootstrap/bootstrap.min.css" rel="stylesheet">        
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- StyleSheet link CSS -->
    <link href="./assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="./assets/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="./assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
    <link href="./assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css">
    <link href="./assets/css/aos.css" rel="stylesheet">
    <link href="./assets/css/magnific-popup.css" rel="stylesheet" type="text/css">
  
  <meta property="og:title" content="Tourist Drivers India Private Tours">
<meta property="og:description" content="Explore tours and travel with Lucky Holidays.">
<meta property="og:image" content="./admin/html/<?php echo $headerrow['logo']; ?>"> <!-- Replace with correct logo URL -->
<meta property="og:url" content="./">
<meta property="og:type" content="website">
  
  <style>
    .dropdown-item {
      padding:15px 20px!important;
    }
    .bg-orange {
        background-color: #f37021;
    }
    .card-title {
        margin-bottom: .75rem !important;
    }
    .lead{color:#fff!important}
  </style>


<script>
// Desktop hover for dropdowns (Bootstrap 4 fix)
document.addEventListener('DOMContentLoaded', function() {
    if (window.innerWidth > 991) {
        var dropdowns = document.querySelectorAll('.navbar-nav .dropdown');
        dropdowns.forEach(function(dd) {
            dd.addEventListener('mouseenter', function() {
                this.classList.add('show');
                var menu = this.querySelector('.dropdown-menu');
                if(menu) menu.classList.add('show');
            });
            dd.addEventListener('mouseleave', function() {
                this.classList.remove('show');
                var menu = this.querySelector('.dropdown-menu');
                if(menu) menu.classList.remove('show');
            });
        });
    }
});
</script>
</head>

<body>
<?php
// db connection

$sql = "SELECT * FROM contact_info LIMIT 1";
$result = $conn->query($sql);
$headerrow = $result->fetch_assoc();
?>
    <!-- Back to top button -->
    <a id="button"></a>
    <div class="trip_banner_outer position-relative">
        <!-- Top Header Bar -->
        <div class="text-white py-2" style="background-color:#F26D52;">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- Left: Address & Phone -->
                <div class="small">
                    <i class="bi bi-geo-alt-fill me-2"></i>
                    <?php echo $headerrow['address']; ?>
                    <span class="mx-3">|</span>
                    <i class="bi bi-telephone-fill me-2"></i>
                    <a href="tel:<?php echo $headerrow['whatsapp']; ?>" style="color:white;"><?php echo $headerrow['phone']; ?></a>
                           <a href="tel:<?php echo $headerrow['whatsapp']; ?>" style="color:white;">9818249288</a>

                </div>

                <!-- Right: Social Icons -->
                
            </div>
        </div>

        <header class="header">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <a class="navbar-brand" href="index.php">
                        <figure class="logo mb-0"><img src="admin/html/<?php echo $headerrow['logo']; ?>" alt="image" class="img-fluid">
                        </figure>
                    </a>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <!-- <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle dropdown-color navbar-text-color" href="php"
                                    id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"> Home </a>
                                <div class="dropdown-menu drop-down-content">
                                    <ul class="list-unstyled drop-down-pages">
                                        <li class="nav-item active"><a class="dropdown-item nav-link"
                                                href="index.html">Enjoy Trip</a></li>
                                        <li class="nav-item"><a class="dropdown-item nav-link" href="index1.html">Travel
                                                World</a></li>
                                        <li class="nav-item"><a class="dropdown-item nav-link"
                                                href="index2.html">Explore Places</a></li>
                                    </ul>
                                </div>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">About Us</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"href="tour-packages.php">Tour Packages</a>
                            </li>

                            <!-- Golden Triangle Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="goldenDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Golden Triangle Tour</a>
                                <div class="dropdown-menu" aria-labelledby="goldenDropdown">
                                    <?php 
                                    $golden = $conn->query("SELECT id, title FROM golden_triangle ORDER BY id DESC LIMIT 10");
                                    while($row = $golden->fetch_assoc()): ?>
                                        <a class="dropdown-item" href="golden-triangle-detail-page.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a>
                                    <?php endwhile; ?>
                                </div>
                            </li>

                            <!-- Himachal Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="himachalDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Himachal Tour</a>
                                <div class="dropdown-menu" aria-labelledby="himachalDropdown">
                                    <?php 
                                    $himachal = $conn->query("SELECT id, title FROM himachal_packages ORDER BY id DESC LIMIT 10");
                                    while($row = $himachal->fetch_assoc()): ?>
                                        <a class="dropdown-item" href="himachal-detail-page.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a>
                                    <?php endwhile; ?>
                                </div>
                            </li>

                            <!-- Rajasthan Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="rajasthanDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rajasthan Tour</a>
                                <div class="dropdown-menu" aria-labelledby="rajasthanDropdown">
                                    <?php 
                                    $rajasthan = $conn->query("SELECT id, title FROM rajasthan_tour ORDER BY id DESC LIMIT 10");
                                    while($row = $rajasthan->fetch_assoc()): ?>
                                        <a class="dropdown-item" href="rajasthan-detail-page.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a>
                                    <?php endwhile; ?>
                                </div>
                            </li>

                            <!-- Tajmahal Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="tajmahalDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tajmahal Tours</a>
                                <div class="dropdown-menu" aria-labelledby="tajmahalDropdown">
                                    <?php 
                                    $tajmahal = $conn->query("SELECT id, title FROM tajmahal_tours ORDER BY id DESC LIMIT 10");
                                    while($row = $tajmahal->fetch_assoc()): ?>
                                        <a class="dropdown-item" href="tajmahal-detail-page.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a>
                                    <?php endwhile; ?>
                                </div>
                            </li>

                            <!-- Pilgrimage Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="pilgrimageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilgrimage Tour</a>
                                <div class="dropdown-menu" aria-labelledby="pilgrimageDropdown">
                                    <?php 
                                    $pilgrimage = $conn->query("SELECT id, title FROM pilgrimage_package ORDER BY id DESC LIMIT 10");
                                    while($row = $pilgrimage->fetch_assoc()): ?>
                                        <a class="dropdown-item" href="pilgrimage-detail-page.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a>
                                    <?php endwhile; ?>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="vehicle.php">Car Rental</a>
                            </li>

                            

                            <!-- <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact Us</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link book_now" href="contact.php">Contact Us<i
                                        class="fa-solid fa-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
      


