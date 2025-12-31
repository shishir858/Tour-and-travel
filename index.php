<?php
require_once 'includes/config.php';
$page_title = "Home - Tourist Drivers India Private Tours";
include 'includes/header.php';
?>

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

<?php include 'includes/footer.php'; ?>
