<?php
require_once 'includes/config.php';
$page_title = "About Us - Tourist Drivers India";

include 'includes/header.php';
?>

<style>
    .about-hero {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.95) 0%, rgba(247, 147, 30, 0.95) 100%);
        padding: 120px 0 80px;
        color: white;
        text-align: center;
    }
    .about-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 15px;
    }
    .about-section {
        padding: 80px 0;
    }
    .about-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }
    .about-content h2 {
        color: #333;
        font-weight: 700;
        margin: 40px 0 20px;
    }
    .stats-section {
        background: #f8f9fa;
        padding: 80px 0;
    }
    .stat-card {
        text-align: center;
        padding: 40px 20px;
    }
    .stat-number {
        font-size: 3.5rem;
        font-weight: 800;
        color: #FF6B35;
        margin-bottom: 10px;
    }
    .stat-label {
        font-size: 1.1rem;
        color: #666;
        font-weight: 600;
    }
    .features-section {
        padding: 80px 0;
    }
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
        height: 100%;
    }
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2rem;
        color: white;
    }
    .feature-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }
    .team-section {
        background: #f8f9fa;
        padding: 80px 0;
    }
    .section-title {
        text-align: center;
        margin-bottom: 60px;
    }
    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #333;
    }
    .section-title p {
        color: #666;
        font-size: 1.1rem;
    }
</style>

<!-- Hero Section -->
<section class="about-hero">
    <div class="container">
        <h1>About Us</h1>
        <p>Your trusted travel partner in India</p>
    </div>
</section>

<!-- About Content -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="<?php echo SITE_URL; ?>uploads/about-image.jpg" alt="About Us" 
                     style="width: 100%; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);"
                     onerror="this.src='https://via.placeholder.com/600x400?text=About+Tourist+Drivers+India'">
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <h2>Welcome to Tourist Drivers India</h2>
                    <p>
                        Tourist Drivers India is your premier travel partner for exploring the incredible diversity and rich heritage of India. 
                        With years of experience in the tourism industry, we specialize in providing personalized tour packages and 
                        professional driver services that ensure comfortable, safe, and memorable journeys across the country.
                    </p>
                    <p>
                        Our mission is to showcase the beauty, culture, and traditions of India through well-curated travel experiences. 
                        From the majestic Taj Mahal to the royal palaces of Rajasthan, from the spiritual sites of Varanasi to the 
                        serene landscapes of Himachal Pradesh, we cover it all.
                    </p>
                    <p>
                        What sets us apart is our commitment to quality service, experienced drivers, well-maintained vehicles, 
                        and competitive pricing. We believe in building lasting relationships with our clients by exceeding their 
                        expectations at every step of their journey.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="stat-card">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="stat-card">
                    <div class="stat-number">5000+</div>
                    <div class="stat-label">Happy Clients</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="stat-card">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Tour Packages</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Customer Satisfaction</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-title">
            <h2>Why Choose Us</h2>
            <p>What makes us the best choice for your India tour</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h4 class="feature-title">Professional Drivers</h4>
                    <p>Experienced, licensed, and courteous drivers who know India like the back of their hand.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <h4 class="feature-title">Premium Vehicles</h4>
                    <p>Well-maintained, clean, and comfortable fleet ranging from sedans to luxury coaches.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="feature-title">Safe & Secure</h4>
                    <p>Your safety is our priority. All vehicles equipped with safety features and GPS tracking.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-rupee-sign"></i>
                    </div>
                    <h4 class="feature-title">Best Pricing</h4>
                    <p>Competitive rates with no hidden charges. Get the best value for your money.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="feature-title">24/7 Support</h4>
                    <p>Round-the-clock customer support to assist you throughout your journey.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <h4 class="feature-title">Customized Tours</h4>
                    <p>Flexible itineraries tailored to your preferences, budget, and schedule.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <h4 class="feature-title">Hotel Bookings</h4>
                    <p>We assist with hotel reservations at the best properties across all destinations.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h4 class="feature-title">Excellent Reviews</h4>
                    <p>Rated highly by thousands of satisfied customers from around the world.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5" style="background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);">
    <div class="container text-center">
        <h2 class="text-white mb-4" style="font-size: 2.5rem; font-weight: 800;">Ready to Explore India?</h2>
        <p class="text-white mb-4" style="font-size: 1.2rem;">Let us plan your perfect Indian adventure</p>
        <a href="<?php echo SITE_URL; ?>contact" class="btn btn-light btn-lg" 
           style="padding: 15px 50px; border-radius: 50px; font-weight: 700;">
            Contact Us Now
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
