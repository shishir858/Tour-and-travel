<?php
require_once 'config.php';
$page_title = "Home - Tourist Drivers India Private Tours";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    
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
            padding: 10px 18px !important;
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
        
        /* Footer */
        .main-footer {
            background: #1F2937;
            color: white;
            padding: 60px 0 30px;
        }
        .main-footer h5 {
            color: white;
            margin-bottom: 25px;
            font-weight: 700;
        }
        .main-footer a {
            color: #D1D5DB;
            text-decoration: none;
            transition: all 0.3s;
        }
        .main-footer a:hover {
            color: #FF6B35;
            padding-left: 5px;
        }
        .footer-social-links a {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 12px;
            transition: all 0.3s;
        }
        .footer-social-links a:hover {
            background: #FF6B35;
            transform: translateY(-4px);
        }
        
        /* WhatsApp Float */
        .whatsapp-float-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 65px;
            height: 65px;
            background: #25D366;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.5);
            z-index: 9999;
            transition: all 0.3s;
            animation: pulse 2s infinite;
        }
        .whatsapp-float-btn:hover {
            background: #128C7E;
            transform: scale(1.1);
            color: white;
        }
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 4px 15px rgba(37, 211, 102, 0.5);
            }
            50% {
                box-shadow: 0 4px 25px rgba(37, 211, 102, 0.7);
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

    <!-- Hero Banner -->
    <section class="hero-banner-wrapper">
        <div class="hero-banner-content">
            <h1 class="hero-main-title">Discover the Magic of India</h1>
            <p class="hero-subtitle-text">Experience Unforgettable Journeys with Professional Drivers & Premium Tours</p>
            <div class="hero-cta-buttons">
                <a href="#tour-destinations" class="btn-primary-action">Explore Tours</a>
                <a href="<?php echo SITE_URL; ?>contact.php" class="btn-secondary-action">Contact Us</a>
            </div>
        </div>
        <div class="hero-scroll-down">
            <a href="#tour-destinations"><i class="fas fa-chevron-down"></i></a>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="category-showcase-section" id="tour-destinations">
        <div class="container">
            <div class="section-heading-wrapper">
                <p class="section-label">Popular Destinations</p>
                <h2 class="section-main-heading">Explore Our Tour Categories</h2>
                <p class="section-description-text">Choose from our carefully curated tour packages across incredible India</p>
            </div>
            <div class="category-cards-grid">
                <?php
                $categories = $conn->query("SELECT * FROM categories WHERE is_active = 1 ORDER BY display_order LIMIT 6");
                while($category = $categories->fetch_assoc()):
                ?>
                <div class="category-single-card">
                    <div class="category-icon-wrapper">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3 class="category-card-title"><?php echo htmlspecialchars($category['name']); ?></h3>
                    <p class="category-card-description">
                        <?php echo htmlspecialchars(substr($category['description'], 0, 120)); ?>...
                    </p>
                    <a href="<?php echo SITE_URL; ?>tour-packages.php?category=<?php echo $category['id']; ?>" class="category-view-link">
                        Explore Tours <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Featured Tours -->
    <section class="tour-packages-showcase">
        <div class="container">
            <div class="section-heading-wrapper">
                <p class="section-label">Trending Now</p>
                <h2 class="section-main-heading">Featured Tour Packages</h2>
                <p class="section-description-text">Handpicked tours showcasing the best of India</p>
            </div>
            <div class="tour-package-items-grid">
                <?php
                $featured_tours = $conn->query("SELECT * FROM tour_packages WHERE is_active = 1 ORDER BY created_at DESC LIMIT 6");
                while($tour = $featured_tours->fetch_assoc()):
                ?>
                <div class="tour-package-card">
                    <div class="tour-package-image-wrapper">
                        <img src="<?php echo htmlspecialchars($tour['image']); ?>" 
                             alt="<?php echo htmlspecialchars($tour['title']); ?>" 
                             class="tour-package-image">
                        <div class="tour-rating-badge">
                            <i class="fas fa-star"></i> 4.9
                        </div>
                    </div>
                    <div class="tour-package-details">
                        <div class="tour-meta-info">
                            <span><i class="far fa-clock"></i> <?php echo htmlspecialchars($tour['duration']); ?></span>
                            <span><i class="fas fa-users"></i> <?php echo htmlspecialchars($tour['persons']); ?></span>
                        </div>
                        <h3 class="tour-package-title"><?php echo htmlspecialchars($tour['title']); ?></h3>
                        <p class="tour-package-excerpt">
                            <?php echo htmlspecialchars(substr(strip_tags($tour['description']), 0, 110)); ?>...
                        </p>
                        <div class="tour-package-footer">
                            <div class="tour-price-display">
                                <?php if($tour['price']): ?>
                                ₹<?php echo number_format($tour['price']); ?>
                                <span class="tour-price-label">per person</span>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo SITE_URL; ?>package-detail.php?id=<?php echo $tour['id']; ?>" class="btn-view-details">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features-highlight-section">
        <div class="container">
            <div class="section-heading-wrapper">
                <p class="section-label">Why Choose Us</p>
                <h2 class="section-main-heading">Your Trusted Travel Partner</h2>
                <p class="section-description-text">We provide exceptional service with attention to every detail</p>
            </div>
            <div class="features-grid-wrapper">
                <div class="feature-item-box">
                    <div class="feature-icon-circle">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h4 class="feature-item-title">Professional Drivers</h4>
                    <p class="feature-item-text">Experienced and licensed drivers ensuring safe journeys</p>
                </div>
                <div class="feature-item-box">
                    <div class="feature-icon-circle">
                        <i class="fas fa-car"></i>
                    </div>
                    <h4 class="feature-item-title">Premium Vehicles</h4>
                    <p class="feature-item-text">Well-maintained fleet of comfortable vehicles</p>
                </div>
                <div class="feature-item-box">
                    <div class="feature-icon-circle">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="feature-item-title">Safe & Secure</h4>
                    <p class="feature-item-text">Your safety is our top priority always</p>
                </div>
                <div class="feature-item-box">
                    <div class="feature-icon-circle">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="feature-item-title">24/7 Support</h4>
                    <p class="feature-item-text">Round the clock customer assistance</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-banner-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 cta-content-wrapper">
                    <h2>Ready to Explore India?</h2>
                    <p>Start your unforgettable journey with us today. Book now and get special offers!</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="<?php echo SITE_URL; ?>contact.php" class="btn-cta-large">
                        <i class="fas fa-phone"></i> Contact Us Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>Tourist Drivers India</h5>
                    <p class="text-white-50">Your trusted partner for exploring the wonders of India with professional drivers.</p>
                    <div class="footer-social-links mt-3">
                        <?php if(getSetting('facebook_url')): ?>
                        <a href="<?php echo getSetting('facebook_url'); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <?php endif; ?>
                        <?php if(getSetting('instagram_url')): ?>
                        <a href="<?php echo getSetting('instagram_url'); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if(getSetting('twitter_url')): ?>
                        <a href="<?php echo getSetting('twitter_url'); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo SITE_URL; ?>">Home</a></li>
                        <li class="mb-2"><a href="<?php echo SITE_URL; ?>about.php">About</a></li>
                        <li class="mb-2"><a href="<?php echo SITE_URL; ?>contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Categories</h5>
                    <ul class="list-unstyled">
                        <?php
                        $footer_cats = $conn->query("SELECT * FROM categories WHERE is_active = 1 ORDER BY display_order LIMIT 5");
                        while($fcat = $footer_cats->fetch_assoc()):
                        ?>
                        <li class="mb-2">
                            <a href="<?php echo SITE_URL; ?>tour-packages.php?category=<?php echo $fcat['id']; ?>">
                                <?php echo htmlspecialchars($fcat['name']); ?>
                            </a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact</h5>
                    <p class="text-white-50">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <?php echo getSetting('site_address') ?: 'New Delhi, India'; ?>
                    </p>
                    <p class="text-white-50">
                        <i class="fas fa-phone me-2"></i>
                        <?php echo getSetting('site_phone'); ?>
                    </p>
                </div>
            </div>
            <div class="row mt-4 pt-4 border-top border-secondary">
                <div class="col-12 text-center">
                    <p class="text-white-50 mb-0">© <?php echo date('Y'); ?> Tourist Drivers India. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <?php if(getSetting('whatsapp_number')): ?>
    <a href="https://wa.me/<?php echo getSetting('whatsapp_number'); ?>" 
       class="whatsapp-float-btn" 
       target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
    <?php endif; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL; ?>assets/js/main-script.js"></script>

</body>
</html>
