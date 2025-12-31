<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Tourist Drivers India Private Tours'; ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/main-style.css">
    
    <style>
        /* Top Bar Orange */
        .top-info-bar {
            background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
            padding: 12px 0;
            color: white;
            font-size: 14px;
        }
        .top-info-bar a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        .top-info-bar i {
            margin-right: 6px;
        }
        
        /* Main Navbar */
        .main-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
            transition: all 0.3s;
        }
        .main-navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .navbar-brand-logo {
            height: 60px;
        }
        .main-navbar .nav-link {
            color: #333;
            font-weight: 600;
            font-size: 14px;
            padding: 8px 12px !important;
            transition: all 0.3s;
        }
        .main-navbar .nav-link:hover {
            color: #FF6B35;
        }
        .navbar-dropdown-menu {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            border-radius: 10px;
            padding: 15px 0;
            min-width: 300px;
        }
        .navbar-dropdown-item {
            padding: 14px 28px;
            transition: all 0.3s;
            color: #555;
            font-weight: 500;
        }
        .navbar-dropdown-item:hover {
            background: #FF6B35;
            color: white !important;
            padding-left: 35px;
        }
        .navbar-contact-btn {
            background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
            color: white !important;
            padding: 12px 35px !important;
            border-radius: 50px;
            font-weight: 700;
            margin-left: 15px;
            transition: all 0.3s;
        }
        .navbar-contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
        }
        @media (min-width: 992px) {
            .navbar-nav .dropdown:hover .dropdown-menu {
                display: block;
            }
        }
    </style>
</head>
<body>

    <!-- Top Info Bar -->
    <div class="top-info-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-6">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><?php echo getSetting('site_address') ?: 'Plot No C 50 Ganesh Nagar Complex - New Delhi 110092'; ?></span>
                </div>
                <div class="col-lg-4 col-md-6 text-end">
                    <i class="fas fa-phone"></i>
                    <a href="tel:<?php echo getSetting('site_phone'); ?>"><?php echo getSetting('site_phone') ?: '+91 9310042916'; ?></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg main-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo SITE_URL; ?>">
                <img src="<?php echo SITE_URL; ?>assets/img/logo.png" alt="Tourist Drivers India" class="navbar-brand-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>">Home</a>
                    </li>
                    
                    <?php
                    $nav_categories = $conn->query("SELECT * FROM categories WHERE is_active = 1 AND show_in_header = 1 ORDER BY display_order");
                    while($nav_cat = $nav_categories->fetch_assoc()):
                        $nav_packages = $conn->query("SELECT id, title FROM tour_packages WHERE category_id = {$nav_cat['id']} AND is_active = 1 ORDER BY display_order LIMIT 10");
                        $has_nav_packages = $nav_packages->num_rows > 0;
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?php echo SITE_URL; ?>tour-packages.php?category=<?php echo $nav_cat['id']; ?>" 
                           <?php if($has_nav_packages): ?>data-bs-toggle="dropdown"<?php endif; ?>>
                            <?php echo htmlspecialchars($nav_cat['name']); ?>
                        </a>
                        <?php if($has_nav_packages): ?>
                        <ul class="dropdown-menu navbar-dropdown-menu">
                            <?php while($nav_pkg = $nav_packages->fetch_assoc()): ?>
                            <li>
                                <a class="dropdown-item navbar-dropdown-item" href="<?php echo SITE_URL; ?>package-detail.php?id=<?php echo $nav_pkg['id']; ?>">
                                    <?php echo htmlspecialchars($nav_pkg['title']); ?>
                                </a>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <?php endwhile; ?>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>vehicles.php">Car Rental</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-contact-btn" href="<?php echo SITE_URL; ?>contact.php">
                            <i class="fas fa-phone me-2"></i>Contact Us
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
