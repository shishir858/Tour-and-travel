<?php
session_start();
require_once 'includes/config.php';
$page_title = "Home - Tourist Drivers India Private Tours";
include 'includes/header.php';
?>

    <!-- Hero Banner -->
    <section class="hero-banner-wrapper">
        <div class="hero-banner-content">
            <h1 class="hero-main-title">Discover the Magic of India</h1>
            <p class="hero-subtitle-text">Experience Unforgettable Journeys with Professional Drivers & Premium Tours</p>
            
            <?php if(isset($_SESSION['error'])): ?>
            <div style="background:#ff4444;color:white;padding:15px;border-radius:10px;margin-bottom:20px;text-align:center;">
                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
            <?php endif; ?>
            
            <!-- Enquiry Form -->
            <div class="hero-enquiry-form">
                <form id="heroEnquiryForm" method="POST" action="<?php echo SITE_URL; ?>process-enquiry.php" class="enquiry-form-container">
                    <!-- Name Field - First & Required -->
                    <div class="form-input-group">
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="input-field-wrapper">
                            <label>Your Name <span style="color:#FF6B35;font-weight:600;">*</span></label>
                            <input type="text" name="name" class="form-input-field" placeholder="Enter your name" required>
                        </div>
                    </div>
                    
                    <!-- Phone Number Field - Second & Required -->
                    <div class="form-input-group">
                        <div class="input-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="input-field-wrapper">
                            <label>Phone No. <span style="color:#FF6B35;font-weight:600;">*</span></label>
                            <input type="tel" name="phone" class="form-input-field" placeholder="Enter your phone number" required>
                        </div>
                    </div>
                    
                    <!-- Destination - Optional -->
                    <div class="form-input-group">
                        <div class="input-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="input-field-wrapper">
                            <label>Destination </label>
                            <select name="package_id" class="form-input-field">
                                <option value="">Select Destination</option>
                                <?php
                                $packages = $conn->query("SELECT id, title FROM tour_packages WHERE is_active = 1 ORDER BY title LIMIT 20");
                                while($pkg = $packages->fetch_assoc()):
                                ?>
                                <option value="<?php echo $pkg['id']; ?>"><?php echo htmlspecialchars($pkg['title']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Date - Optional -->
                    <div class="form-input-group">
                        <div class="input-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="input-field-wrapper">
                            <label>Date</label>
                            <input type="date" name="travel_date" class="form-input-field" placeholder="dd-mm-yyyy" min="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    
                    <!-- People - Optional -->
                    <div class="form-input-group">
                        <div class="input-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="input-field-wrapper">
                            <label>People </label>
                            <select name="people" class="form-input-field">
                                <option value="1">1 Person</option>
                                <option value="2">2 People</option>
                                <option value="3">3 People</option>
                                <option value="4" selected>4 People</option>
                                <option value="5">5 People</option>
                                <option value="6">6 People</option>
                                <option value="7">7 People</option>
                                <option value="8">8 People</option>
                                <option value="9">9 People</option>
                                <option value="10+">10+ People</option>
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="enquiry-submit-btn">
                        <i class="fas fa-paper-plane"></i>Enquire
                    </button>
                </form>
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
                <a href="<?php echo SITE_URL; ?>tour-packages?category=<?php echo $category['slug']; ?>" class="category-single-card">
                    <div class="category-icon-wrapper">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3 class="category-card-title"><?php echo htmlspecialchars($category['name']); ?></h3>
                    <div class="category-view-link">
                        Explore Tours <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
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
            <div class="tour-package-items-grid owl-carousel owl-theme">
                <?php
                $featured_tours = $conn->query("SELECT * FROM tour_packages WHERE is_active = 1 ORDER BY created_at DESC LIMIT 12");
                while($tour = $featured_tours->fetch_assoc()):
                ?>
                <div class="tour-package-card">
                    <div class="tour-package-image-wrapper">
                        <img src="<?php echo SITE_URL . 'uploads/packages/' . ($tour['featured_image'] ?? 'default.jpg'); ?>" 
                             alt="<?php echo htmlspecialchars($tour['title'] ?? ''); ?>" 
                             class="tour-package-image">
                        <div class="tour-rating-badge">
                            <i class="fas fa-star"></i> 4.9
                        </div>
                    </div>
                    <div class="tour-package-details">
                        <div class="tour-meta-info">
                            <span><i class="far fa-clock"></i> <?php echo htmlspecialchars($tour['duration_days'] ?? '0'); ?> Days / <?php echo htmlspecialchars($tour['duration_nights'] ?? '0'); ?> Nights</span>
                        </div>
                        <h3 class="tour-package-title"><?php echo htmlspecialchars($tour['title'] ?? ''); ?></h3>
                        <!-- <p class="tour-package-excerpt">
                            <?php echo htmlspecialchars(substr(strip_tags($tour['description'] ?? ''), 0, 110)); ?>...
                        </p> -->
                        <div class="tour-package-footer">
                            <!-- <div class="tour-price-display">
                                <?php if(isset($tour['base_price']) && $tour['base_price']): ?>
                                ₹<?php echo number_format($tour['base_price']); ?>
                                <span class="tour-price-label">per person</span>
                                <?php endif; ?>
                            </div> -->
                            <a href="<?php echo SITE_URL; ?>package/<?php echo $tour['slug'] ?: $tour['id']; ?>" class="btn-view-details">
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

    <!-- About Us Section -->
    <section class="about-us-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1587474260584-136574528ed5?w=800" alt="Indian Temple" class="about-main-image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content-wrapper">
                        <p class="section-label">About Us</p>
                        <h2 class="about-main-heading">Your Gateway to Indian Adventures</h2>
                        <p class="about-description-text">
                            We specialize in personalized private tours across India – from the royal palaces of Rajasthan and the iconic Taj Mahal to the spiritual serenity of Chardham and Amarnath Yatra. With decades of experience, we ensure each journey is comfortable, memorable, and truly unforgettable.
                        </p>
                        <div class="about-stats-grid">
                            <div class="about-stat-box">
                                <h3 class="stat-number">15k</h3>
                                <p class="stat-label">Happy<br>Travelers</p>
                            </div>
                            <div class="about-stat-box">
                                <h3 class="stat-number">5+</h3>
                                <p class="stat-label">Awards &<br>Recognitions</p>
                            </div>
                            <div class="about-stat-box">
                                <h3 class="stat-number">14+</h3>
                                <p class="stat-label">Years of<br>Experience</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Wise Tour Packages -->
    <?php
    $categories = $conn->query("SELECT * FROM categories WHERE is_active = 1 ORDER BY display_order");
    while($category = $categories->fetch_assoc()):
        $cat_id = $category['id'];
        $packages = $conn->query("SELECT * FROM tour_packages WHERE category_id = $cat_id AND is_active = 1 ORDER BY created_at DESC LIMIT 10");
        
        if($packages->num_rows > 0):
    ?>
    <section class="category-packages-section">
        <div class="container">
            <div class="section-heading-wrapper">
                <p class="section-label">Best Places</p>
                <h2 class="section-main-heading"><?php echo htmlspecialchars($category['name']); ?></h2>
            </div>
            <div class="category-packages-carousel owl-carousel owl-theme">
                <?php while($package = $packages->fetch_assoc()): ?>
                <div class="category-package-card">
                    <div class="category-package-image-wrapper">
                        <img src="<?php echo SITE_URL . 'uploads/packages/' . ($package['featured_image'] ?? 'default.jpg'); ?>" 
                             alt="<?php echo htmlspecialchars($package['title'] ?? ''); ?>" 
                             class="category-package-image">
                    </div>
                    <div class="category-package-details">
                        <div class="category-package-meta">
                            <span><i class="far fa-calendar"></i> <?php echo htmlspecialchars($package['duration_days'] ?? '0'); ?> Nights/ <?php echo htmlspecialchars($package['duration_nights'] ?? '0'); ?> Days</span>
                            <span><i class="fas fa-users"></i> 4 Persons</span>
                        </div>
                        <h3 class="category-package-location">
                            <?php 
                            // Extract location from title or use first 50 chars
                            echo htmlspecialchars(substr($package['title'] ?? '', 0, 50)); 
                            ?>
                        </h3>
                        <h4 class="category-package-title">
                            <?php 
                            $title = $package['title'] ?? '';
                            $words = explode(' ', $title);
                            echo htmlspecialchars(implode(' ', array_slice($words, 0, 4)));
                            if(count($words) > 4) echo '...';
                            ?>
                        </h4>
                        <div class="category-package-actions">
                            <a href="tel:+919876543210" class="btn-call-now">
                                Call <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="<?php echo SITE_URL; ?>package/<?php echo $package['slug'] ?: $package['id']; ?>" class="btn-book-now">
                                Book <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php 
        endif;
    endwhile; 
    ?>

    <!-- Adventure Banner -->
    <section class="adventure-banner-section">
        <div class="container">
            <div class="adventure-banner-content">
                <p class="adventure-banner-label">Come & Join Us</p>
                <h2 class="adventure-banner-heading">Making Adventure Tours and Activities Accessible and Affordable for Everyone.</h2>
                <a href="<?php echo SITE_URL; ?>contact" class="btn-adventure-book">
                    Book Now <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Car Rental Section -->
    <section class="car-rental-section">
        <div class="container">
            <div class="section-heading-wrapper">
                <p class="section-label">Our Vehicles</p>
                <h2 class="section-main-heading">Car Rental</h2>
            </div>
            <div class="car-rental-carousel owl-carousel owl-theme">
                <?php
                $vehicles = $conn->query("SELECT * FROM vehicles_new WHERE is_active = 1 ORDER BY id DESC LIMIT 8");
                while($vehicle = $vehicles->fetch_assoc()):
                ?>
                <div class="car-rental-card">
                    <div class="car-rental-image-wrapper">
                        <img src="<?php echo htmlspecialchars($vehicle['image'] ?? ''); ?>" 
                             alt="<?php echo htmlspecialchars($vehicle['name'] ?? ''); ?>" 
                             class="car-rental-image">
                    </div>
                    <div class="car-rental-details">
                        <h3 class="car-rental-title"><?php echo htmlspecialchars($vehicle['name'] ?? ''); ?></h3>
                        <p class="car-rental-capacity">Seating Capacity - <?php echo htmlspecialchars($vehicle['seating_capacity'] ?? '0'); ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="car-rental-actions">
                <a href="<?php echo SITE_URL; ?>vehicles" class="btn-see-all">See All</a>
                <a href="<?php echo SITE_URL; ?>contact" class="btn-contact-customized">Contact for Customized Tour</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="testimonials-images">
                        <div class="testimonial-avatar testimonial-avatar-1">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Customer">
                        </div>
                        <div class="testimonial-avatar testimonial-avatar-2">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Customer">
                        </div>
                        <div class="testimonial-avatar testimonial-avatar-3">
                            <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Customer">
                        </div>
                        <div class="testimonial-avatar testimonial-avatar-4">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Customer">
                        </div>
                        <div class="testimonial-avatar testimonial-avatar-5">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Customer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="testimonials-content">
                        <p class="section-label">Testimonials</p>
                        <h2 class="testimonials-heading">What Our Customer Say About Us</h2>
                        <div class="testimonials-carousel owl-carousel owl-theme">
                            <div class="testimonial-item">
                                <p class="testimonial-text">"Tourist Drivers India made our Golden Triangle trip unforgettable. Everything from hotel bookings to local sightseeing was perfectly arranged. Highly recommend their tour packages!"</p>
                                <div class="testimonial-author">
                                    <div class="testimonial-quote-icon">
                                        <i class="fas fa-quote-left"></i>
                                    </div>
                                    <div class="testimonial-author-info">
                                        <h4 class="testimonial-author-name">Sunita Mehra</h4>
                                        <p class="testimonial-author-location">Gurgaon</p>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <p class="testimonial-text">"Excellent service! Our driver was very professional and knowledgeable. The Rajasthan tour was comfortable and well-organized. Will definitely book again."</p>
                                <div class="testimonial-author">
                                    <div class="testimonial-quote-icon">
                                        <i class="fas fa-quote-left"></i>
                                    </div>
                                    <div class="testimonial-author-info">
                                        <h4 class="testimonial-author-name">Rajesh Kumar</h4>
                                        <p class="testimonial-author-location">Mumbai</p>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <p class="testimonial-text">"Amazing experience with Tourist Drivers India! The vehicle was clean and comfortable. Our guide was very friendly and showed us all the best spots. Highly satisfied!"</p>
                                <div class="testimonial-author">
                                    <div class="testimonial-quote-icon">
                                        <i class="fas fa-quote-left"></i>
                                    </div>
                                    <div class="testimonial-author-info">
                                        <h4 class="testimonial-author-name">Priya Sharma</h4>
                                        <p class="testimonial-author-location">Delhi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Gallery Section -->
    <section class="video-gallery-section">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="service_content text-center pb-4" data-aos="fade-up">
                        <h6>Our Videos</h6>
                        <h2>Our Videos Gallery</h2>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="ratio ratio-9x16">
                        <blockquote class="instagram-media"
                            data-instgrm-permalink="https://www.instagram.com/reel/C7-r4Y0S1Ju/?utm_source=ig_embed&amp;utm_campaign=loading"
                            data-instgrm-version="14"></blockquote>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="ratio ratio-9x16">
                        <blockquote class="instagram-media"
                            data-instgrm-permalink="https://www.instagram.com/reel/C7HCyn7ShlO/?utm_source=ig_embed&amp;utm_campaign=loading"
                            data-instgrm-version="14"></blockquote>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="ratio ratio-9x16">
                        <blockquote class="instagram-media"
                            data-instgrm-permalink="https://www.instagram.com/reel/C_K207Kyuom/"
                            data-instgrm-version="14"></blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TripAdvisor Section -->
    <section class="tripadvisor-section">
        <div class="d-flex justify-content-center align-items-center bg-light py-3">
            <div id="TA_selfserveprop126" class="TA_selfserveprop">
                <ul id="iKJiU8UHX" class="TA_links jXc79ZG">
                    <li id="hz9l8JkBRjv" class="KqQqqFQkNOX7"><a target="_blank" href="https://www.tripadvisor.in/Attraction_Review-g304551-d2350110-Reviews-Tourist_Drivers_India_Private_Tours-New_Delhi_National_Capital_Territory_of_Delhi.html"><img src="https://www.tripadvisor.in/img/cdsi/img2/branding/v2/Tripadvisor_lockup_horizontal_secondary_registered-11900-2.svg" alt="TripAdvisor" /></a></li>
                </ul>
            </div>
            <script async src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=126&amp;locationId=2350110&amp;lang=en_IN&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=true&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>

            <div id="TA_certificateOfExcellence480" class="TA_certificateOfExcellence">
                <ul id="Jh3XixJWr" class="TA_links 5SV6Lnt23">
                    <li id="RLAw2pKd5H" class="kx7hY3"><a target="_blank" href="https://www.tripadvisor.in/Attraction_Review-g304551-d2350110-Reviews-Tourist_Drivers_India_Private_Tours-New_Delhi_National_Capital_Territory_of_Delhi.html"><img src="https://static.tacdn.com/img2/travelers_choice/widgets/tchotel_2024_LL.png" alt="TripAdvisor" height="100" class="widCOEImg" id="CDSWIDCOELOGO" /></a></li>
                </ul>
            </div>
            <script async src="https://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=480&amp;locationId=2350110&amp;lang=en_IN&amp;year=2024&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>
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
                    <a href="<?php echo SITE_URL; ?>contact" class="btn-cta-large">
                        <i class="fas fa-phone"></i> Contact Us Now
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>

<script>
// Wait for everything to load
window.addEventListener('load', function() {
    if (typeof jQuery !== 'undefined' && typeof $.fn.owlCarousel !== 'undefined') {
        // Initialize all category carousels
        $('.category-packages-carousel').each(function(index){
            var $carousel = $(this);
            
            // Destroy if already initialized
            if ($carousel.hasClass('owl-loaded')) {
                $carousel.owlCarousel('destroy');
            }
            
            // Initialize carousel
            $carousel.owlCarousel({
                loop: true,
                margin: 25,
                nav: true,
                dots: false,
                autoplay: false,
                navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1400: {
                        items: 4
                    }
                }
            });
        });
        
        // Initialize featured tour packages carousel
        $('.tour-package-items-grid').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: false,
            autoplay: false,
            navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1400: {
                    items: 4
                }
            }
        });
        
        // Initialize car rental carousel
        $('.car-rental-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1400: {
                    items: 4
                }
            }
        });
        
        // Initialize testimonials carousel
        $('.testimonials-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            dots: false,
            items: 1,
            autoplay: false,
            navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>']
        });
    }
});
</script>
