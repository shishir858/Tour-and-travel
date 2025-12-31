<?php
// Use the correct path to the connection/config file
include(__DIR__ . '/admin/includes/config.php');

// Get current page name
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Check if it's a detail page with ID parameter
$is_detail_page = isset($_GET['id']) && in_array($current_page, ['golden-triangle-detail-page', 'himachal-detail-page', 'rajasthan-detail-page', 'tajmahal-detail-page', 'pilgrimage-detail-page']);

if ($is_detail_page) {
    // Fetch tour data for meta tags
    $tour_id = intval($_GET['id']);
    $table_map = [
        'golden-triangle-detail-page' => 'golden_triangle',
        'himachal-detail-page' => 'himachal_packages',
        'rajasthan-detail-page' => 'rajasthan_tour',
        'tajmahal-detail-page' => 'tajmahal_tours',
        'pilgrimage-detail-page' => 'pilgrimage_package'
    ];
    
    $table = $table_map[$current_page];
    $tour_query = $conn->prepare("SELECT title, description, meta_title, meta_description, meta_keywords FROM $table WHERE id = ?");
    $tour_query->bind_param("i", $tour_id);
    $tour_query->execute();
    $tour_result = $tour_query->get_result();
    $tour_data = $tour_result->fetch_assoc();
    
    if ($tour_data) {
        // Use custom meta tags if provided, otherwise generate from tour data
        $meta_title = !empty($tour_data['meta_title']) ? htmlspecialchars($tour_data['meta_title']) : htmlspecialchars($tour_data['title']) . ' - Tourist Drivers India';
        $meta_description = !empty($tour_data['meta_description']) ? htmlspecialchars($tour_data['meta_description']) : substr(strip_tags($tour_data['description']), 0, 160);
        $meta_keywords = !empty($tour_data['meta_keywords']) ? htmlspecialchars($tour_data['meta_keywords']) : htmlspecialchars($tour_data['title']) . ', India tour, private tour India, ' . str_replace('-', ' ', $current_page);
    } else {
        // Fallback if tour not found
        $meta_title = 'Tour Details - Tourist Drivers India';
        $meta_description = 'Explore our exclusive India tour packages with professional drivers.';
        $meta_keywords = 'India tours, private tours India';
    }
} else {
    // Fetch meta tags for static pages from database
    $meta_query = $conn->prepare("SELECT * FROM meta_tags WHERE page = ?");
    $meta_query->bind_param("s", $current_page);
    $meta_query->execute();
    $meta_result = $meta_query->get_result();
    $meta_data = $meta_result->fetch_assoc();

    // Default meta tags if page not found in database
    $meta_title = $meta_data['meta_title'] ?? 'Best India Travel Company - Tourist Drivers India Private Tours';
    $meta_description = $meta_data['meta_description'] ?? 'Explore India with our exclusive private tour packages. Golden Triangle Tours, Rajasthan Tours, Taj Mahal Tours, Himachal Packages and more with professional drivers.';
    $meta_keywords = $meta_data['meta_keywords'] ?? 'India tours, private tours India, Golden Triangle tour, Taj Mahal tour, Rajasthan tour, Himachal tour, India travel packages';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    
    <!-- Dynamic Meta Tags -->
    <title><?php echo htmlspecialchars($meta_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($meta_keywords); ?>">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($meta_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($meta_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($meta_description); ?>">
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
                        <figure class="logo mb-0"><img src="admin/<?php echo $headerrow['logo']; ?>" alt="image" class="img-fluid">
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

                            <!-- <li class="nav-item">
                                <a class="nav-link" href="about.php">About Us</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"href="tour-packages.php">Tour Packages</a>
                            </li> -->

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
      


