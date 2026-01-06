<?php
require_once 'includes/config.php';
$page_title = "Our Fleet - Tourist Drivers India";

// Get vehicles
$vehicles_query = "SELECT * FROM vehicles_new WHERE is_active = 1 ORDER BY id DESC";
$vehicles = $conn->query($vehicles_query);

include 'includes/header.php';
?>

<style>
    .vehicles-hero {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.95) 0%, rgba(247, 147, 30, 0.95) 100%);
        padding: 120px 0 80px;
        color: white;
        text-align: center;
    }
    .vehicles-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 15px;
    }
    .vehicles-section {
        padding: 80px 0;
    }
    .vehicle-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
        margin-bottom: 30px;
    }
    .vehicle-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    .vehicle-image {
        height: 250px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    .vehicle-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #FF6B35;
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
    }
    .vehicle-content {
        padding: 30px;
    }
    .vehicle-name {
        font-size: 1.75rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }
    .vehicle-type {
        color: #FF6B35;
        font-weight: 600;
        margin-bottom: 15px;
    }
    .vehicle-specs {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin: 25px 0;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
    }
    .vehicle-spec {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .vehicle-spec i {
        color: #FF6B35;
        font-size: 1.2rem;
    }
    .vehicle-features {
        margin: 20px 0;
    }
    .vehicle-features h5 {
        font-weight: 700;
        margin-bottom: 15px;
    }
    .vehicle-features ul {
        list-style: none;
        padding: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .vehicle-features li {
        color: #666;
        padding-left: 25px;
        position: relative;
    }
    .vehicle-features li::before {
        content: "\f00c";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        color: #28a745;
    }
    .vehicle-price {
        font-size: 1.75rem;
        font-weight: 700;
        color: #FF6B35;
        margin: 20px 0;
    }
    .vehicle-price small {
        font-size: 14px;
        color: #666;
        font-weight: 400;
    }
    .btn-book-vehicle {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
        color: white;
        border: none;
        border-radius: 50px;
        font-weight: 700;
        transition: all 0.3s;
        text-decoration: none;
        display: block;
        text-align: center;
    }
    .btn-book-vehicle:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
        color: white;
    }
</style>

<!-- Hero Section -->
<section class="vehicles-hero">
    <div class="container">
        <h1>Our Fleet</h1>
        <p>Choose from our premium collection of well-maintained vehicles</p>
    </div>
</section>

<!-- Service Cards Section -->
<section class="service-cards-section py-5" style="background: #f5f5f5;">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Delhi Taxi Service -->
            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="service-card shadow-sm rounded-4 bg-white h-100 d-flex flex-column align-items-center p-3">
                    <img src="uploads/vehicles/delhi-taxi-service.jpg" alt="Delhi Taxi Service" class="img-fluid rounded-3 mb-3" style="height: 160px; object-fit: cover; width: 100%;">
                    <h5 class="fw-bold mb-1">Delhi Taxi Service</h5>
                    <div class="text-muted mb-3" style="font-size: 1rem;">City Rides</div>
                    <div class="d-flex gap-2 w-100 justify-content-center mt-auto">
                        <a href="tel:+919818249288" class="btn btn-sm btn-warning px-3"><i class="fa fa-phone"></i> Call Now</a>
                        <a href="contact.php" class="btn btn-sm btn-outline-primary px-3"><i class="fa fa-calendar-check"></i> Book Now</a>
                    </div>
                </div>
            </div>
            <!-- Delhi Airport Taxi -->
            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="service-card shadow-sm rounded-4 bg-white h-100 d-flex flex-column align-items-center p-3">
                    <img src="https://images.unsplash.com/photo-1465156799763-2c087c332922?auto=format&fit=crop&w=400&q=80" alt="Delhi Airport Taxi" class="img-fluid rounded-3 mb-3" style="height: 160px; object-fit: cover; width: 100%;">
                    <h5 class="fw-bold mb-1">Delhi Airport Taxi</h5>
                    <div class="text-muted mb-3" style="font-size: 1rem;">Airport Pickup</div>
                    <div class="d-flex gap-2 w-100 justify-content-center mt-auto">
                        <a href="tel:+919818249288" class="btn btn-sm btn-warning px-3"><i class="fa fa-phone"></i> Call Now</a>
                        <a href="contact.php" class="btn btn-sm btn-outline-primary px-3"><i class="fa fa-calendar-check"></i> Book Now</a>
                    </div>
                </div>
            </div>
            <!-- Tempo Traveler Rental -->
            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="service-card shadow-sm rounded-4 bg-white h-100 d-flex flex-column align-items-center p-3">
                    <img src="https://images.unsplash.com/photo-1511918984145-48de785d4c4e?auto=format&fit=crop&w=400&q=80" alt="Tempo Traveler Rental" class="img-fluid rounded-3 mb-3" style="height: 160px; object-fit: cover; width: 100%;">
                    <h5 class="fw-bold mb-1">Tempo Traveler Rental</h5>
                    <div class="text-muted mb-3" style="font-size: 1rem;">Group Travel</div>
                    <div class="d-flex gap-2 w-100 justify-content-center mt-auto">
                        <a href="tel:+919818249288" class="btn btn-sm btn-warning px-3"><i class="fa fa-phone"></i> Call Now</a>
                        <a href="contact.php" class="btn btn-sm btn-outline-primary px-3"><i class="fa fa-calendar-check"></i> Book Now</a>
                    </div>
                </div>
            </div>
            <!-- Outstation Taxi Service -->
            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="service-card shadow-sm rounded-4 bg-white h-100 d-flex flex-column align-items-center p-3">
                    <img src="https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=400&q=80" alt="Outstation Taxi Service" class="img-fluid rounded-3 mb-3" style="height: 160px; object-fit: cover; width: 100%;">
                    <h5 class="fw-bold mb-1">Outstation Taxi Service</h5>
                    <div class="text-muted mb-3" style="font-size: 1rem;">Long Trips</div>
                    <div class="d-flex gap-2 w-100 justify-content-center mt-auto">
                        <a href="tel:+919818249288" class="btn btn-sm btn-warning px-3"><i class="fa fa-phone"></i> Call Now</a>
                        <a href="contact.php" class="btn btn-sm btn-outline-primary px-3"><i class="fa fa-calendar-check"></i> Book Now</a>
                    </div>
                </div>
            </div>
            <!-- Rajasthan Taxi Service -->
            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="service-card shadow-sm rounded-4 bg-white h-100 d-flex flex-column align-items-center p-3">
                    <img src="https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?auto=format&fit=crop&w=400&q=80" alt="Rajasthan Taxi Service" class="img-fluid rounded-3 mb-3" style="height: 160px; object-fit: cover; width: 100%;">
                    <h5 class="fw-bold mb-1">Rajasthan Taxi Service</h5>
                    <div class="text-muted mb-3" style="font-size: 1rem;">Desert Tours</div>
                    <div class="d-flex gap-2 w-100 justify-content-center mt-auto">
                        <a href="tel:+919818249288" class="btn btn-sm btn-warning px-3"><i class="fa fa-phone"></i> Call Now</a>
                        <a href="contact.php" class="btn btn-sm btn-outline-primary px-3"><i class="fa fa-calendar-check"></i> Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vehicles Section -->
<section class="vehicles-section">
    <div class="container">
        <?php if($vehicles->num_rows > 0): ?>
            <div class="row">
                <?php while($vehicle = $vehicles->fetch_assoc()): ?>
                    <div class="col-lg-6">
                        <div class="vehicle-card">
                            <?php if($vehicle['image']): ?>
                                <div class="vehicle-image" style="background-image: url('<?php echo htmlspecialchars($vehicle['image']); ?>')">
                                    <?php if($vehicle['is_featured']): ?>
                                        <div class="vehicle-badge">Popular</div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="vehicle-image" style="background-image: url('https://via.placeholder.com/600x300?text=<?php echo urlencode($vehicle['name']); ?>')">
                                    <?php if($vehicle['is_featured']): ?>
                                        <div class="vehicle-badge">Popular</div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="vehicle-content">
                                <h3 class="vehicle-name"><?php echo htmlspecialchars($vehicle['name']); ?></h3>
                                <div class="vehicle-type"><?php echo htmlspecialchars($vehicle['vehicle_type']); ?></div>
                                
                                <?php if($vehicle['description']): ?>
                                    <p><?php echo htmlspecialchars($vehicle['description']); ?></p>
                                <?php endif; ?>
                                
                                <div class="vehicle-specs">
                                    <div class="vehicle-spec">
                                        <i class="fas fa-users"></i>
                                        <span><strong><?php echo $vehicle['seating_capacity']; ?></strong> Seats</span>
                                    </div>
                                    <div class="vehicle-spec">
                                        <i class="fas fa-suitcase"></i>
                                        <span><strong><?php echo $vehicle['luggage_capacity']; ?></strong> Luggage</span>
                                    </div>
                                    <div class="vehicle-spec">
                                        <i class="fas fa-car"></i>
                                        <span><?php echo htmlspecialchars($vehicle['vehicle_type']); ?></span>
                                    </div>
                                    <div class="vehicle-spec">
                                        <i class="fas fa-snowflake"></i>
                                        <span>AC Available</span>
                                    </div>
                                </div>
                                
                                <?php if($vehicle['features']): ?>
                                    <div class="vehicle-features">
                                        <h5>Features</h5>
                                        <ul>
                                            <?php
                                            $features = explode("\n", $vehicle['features']);
                                            foreach($features as $feature):
                                                if(trim($feature)):
                                            ?>
                                                <li><?php echo htmlspecialchars(trim($feature)); ?></li>
                                            <?php
                                                endif;
                                            endforeach;
                                            ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if($vehicle['price_per_day'] > 0): ?>
                                    <div class="vehicle-price">
                                        ₹<?php echo number_format($vehicle['price_per_day']); ?>
                                        <small>/day</small>
                                    </div>
                                <?php else: ?>
                                    <div class="vehicle-price">
                                        Contact for Price
                                    </div>
                                <?php endif; ?>
                                
                                <a href="<?php echo SITE_URL; ?>contact" class="btn-book-vehicle">
                                    <i class="fas fa-phone"></i> Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-car" style="font-size: 4rem; color: #ddd;"></i>
                <h3 class="mt-3">No vehicles available</h3>
                <p class="text-muted">Please check back later or contact us for vehicle options</p>
                <a href="<?php echo SITE_URL; ?>contact.php" class="btn-book-vehicle mt-3" style="max-width: 300px; margin: 20px auto;">
                    Contact Us
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="font-weight: 800;">Why Rent from Us?</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-size: 2rem;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h5>Well Maintained</h5>
                    <p class="text-muted">All vehicles regularly serviced and inspected</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-size: 2rem;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h5>Professional Drivers</h5>
                    <p class="text-muted">Experienced and courteous drivers</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-size: 2rem;">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>Fully Insured</h5>
                    <p class="text-muted">Comprehensive insurance coverage</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-size: 2rem;">
                        <i class="fas fa-rupee-sign"></i>
                    </div>
                    <h5>Best Rates</h5>
                    <p class="text-muted">Competitive pricing with no hidden costs</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
