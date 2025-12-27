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
            <div class="container d-flex justify-content-between align-items-center">
                <!-- Left: Address & Phone -->
                <div class="small">
                    <i class="bi bi-geo-alt-fill me-2"></i>
                    <?php echo $headerrow['address']; ?>
                    <span class="mx-3">|</span>
                    <i class="bi bi-telephone-fill me-2"></i>
                    <a href="tel:<?php echo $headerrow['whatsapp']; ?>" style="color:white;"><?php echo $headerrow['phone']; ?></a>
                  <i class="bi bi-telephone-fill me-2"></i>
                    <a href="tel:919818249288" style="color:white;"><?php echo '+91 9818249288'; ?></a>
                </div>

                <!-- Right: Social Icons -->
                
            </div>
        </div>

        <header class="header">
            <div class="container">
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
                                    id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true"
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
                                <a class="nav-link" href="tour-packages.php">Tour Packages</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="vehicle.php">Vehicles</a>
                            </li>

                            

                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link book_now" href="contact.php">Book Now<i
                                        class="fa-solid fa-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
      


