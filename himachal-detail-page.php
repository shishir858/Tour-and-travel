<?php include('header.php'); ?>
<?php
// Get tour data - adjust table name based on page
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Map pages to tables
$table_map = [
    'golden-triangle-detail-page' => 'golden_triangle',
    'himachal-detail-page' => 'himachal_packages',
    'rajasthan-detail-page' => 'rajasthan_tour',
    'tajmahal-detail-page' => 'tajmahal_tours',
    'pilgrimage-detail-page' => 'pilgrimage_package'
];

$table = $table_map[$current_page] ?? 'golden_triangle';
$itinerary_count = ($table == 'rajasthan_tour') ? 18 : 17;

$sql = "SELECT * FROM $table WHERE id = $id";
$result = $conn->query($sql);
$tour = $result->fetch_assoc();

if (!$tour) {
    header('Location: index.php');
    exit;
}

// Fetch related tours (excluding current)
$related_sql = "SELECT id, title, image, duration, persons, description FROM $table WHERE id != $id ORDER BY RAND() LIMIT 4";
$related_result = $conn->query($related_sql);

// Debug output
echo "<!-- Debug: Table=$table, Current ID=$id, Query Result=".($related_result ? 'Success' : 'Failed')." -->";
if($related_result) {
    echo "<!-- Debug: Found ".$related_result->num_rows." related tours -->";
}
?>

<style>
.tour-hero {
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), <?php echo !empty($tour['image']) ? "url('" . htmlspecialchars($tour['image']) . "')" : "linear-gradient(135deg, #667eea 0%, #764ba2 100%)"; ?>;
    background-size: cover;
    background-position: center;
    min-height: 450px;
    display: flex;
    align-items: center;
    position: relative;
}
.breadcrumb {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    padding: 8px 20px;
    display: inline-flex;
}
.breadcrumb-item a {
    color: #fff;
    text-decoration: none;
}
.breadcrumb-item.active {
    color: #ffd700;
}
.info-badge {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin: -60px 0 30px;
    position: relative;
    z-index: 10;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}
.info-item {
    text-align: center;
    padding: 15px;
}
.info-item i {
    font-size: 28px;
    color: #f26d52;
    margin-bottom: 10px;
}
.nav-tabs .nav-link {
    color: #666;
    font-weight: 600;
    border: none;
    border-bottom: 3px solid transparent;
    padding: 15px 25px;
}
.nav-tabs .nav-link.active {
    color: #f26d52;
    border-bottom-color: #f26d52;
    background: transparent;
}
.day-item {
    border: 1px solid #e5e5e5;
    border-radius: 12px;
    margin-bottom: 15px;
    overflow: hidden;
    transition: all 0.3s;
}
.day-item:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}
.day-header {
    background: #f8f9fa;
    padding: 18px 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    transition: all 0.3s;
}
.day-header:hover {
    background: #fff5f2;
}
.day-header .fa-chevron-down {
    transition: transform 0.3s ease;
}
.day-header[aria-expanded="true"] .fa-chevron-down {
    transform: rotate(180deg);
}
.day-number {
    background: linear-gradient(135deg, #f26d52 0%, #ff8a73 100%);
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 18px;
    margin-right: 15px;
}
.day-body {
    padding: 0 20px;
    background: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, padding 0.3s ease;
}
.day-body p {
    font-size: 15px;
}
.day-body.show {
    max-height: 1000px;
    padding: 20px;
}
.highlight-card {
    border-left: 3px solid #f26d52;
    padding: 15px 20px;
    background: #fff5f2;
    border-radius: 8px;
    margin-bottom: 12px;
}
.booking-widget {
    position: sticky;
    top: 100px;
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}
.price-tag {
    font-size: 32px;
    font-weight: bold;
    color: #f26d52;
}
.sidebar-section {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}
.related-tours li a {
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}
.related-tours li a:hover {
    background: #f8f9fa !important;
    border-left-color: #f26d52;
    transform: translateX(5px);
}
.related-tours li a i {
    color: #f26d52;
    margin-right: 10px;
}
.sidebar-section h5 i {
    margin-right: 10px;
}
.btn i {
    margin-right: 8px;
}
h3 i {
    margin-right: 10px;
}
.highlight-card h6 i {
    margin-right: 8px;
}
.tab-content .lead {
    color: #000 !important;
    font-size: 1.15rem !important;
}
.hover-bg-light:hover {
    background: #f8f9fa !important;
}
.gallery-main-image {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    margin-bottom: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.gallery-main-image img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.gallery-thumbnails {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding: 5px 0;
}
.gallery-thumbnail {
    flex-shrink: 0;
    width: 120px;
    height: 90px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
}
.gallery-thumbnail.active {
    border-color: #ff6b35;
    transform: scale(1.05);
}
.gallery-thumbnail:hover {
    border-color: #ff8c5a;
    transform: scale(1.05);
}
.gallery-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>

<!-- Hero Section -->
<section class="tour-hero">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="tour-packages.php">Tours</a></li>
                        <li class="breadcrumb-item active"><?= htmlspecialchars($tour['title']) ?></li>
                    </ol>
                </nav>
                <h1 class="text-white display-4 fw-bold mb-3"><?= htmlspecialchars($tour['title']) ?></h1>
                <p class="text-white lead mb-0"><i class="fas fa-map-marker-alt me-2"></i><?= htmlspecialchars($tour['places_covered']) ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Info Badges -->
<div class="container">
    <div class="info-badge">
        <div class="row g-3">
            <div class="col-md-3 col-6">
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <h6 class="mb-0 text-muted small">Duration</h6>
                    <p class="mb-0 fw-bold"><?= htmlspecialchars($tour['duration']) ?></p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="info-item">
                    <i class="fas fa-users"></i>
                    <h6 class="mb-0 text-muted small">Group Size</h6>
                    <p class="mb-0 fw-bold"><?= htmlspecialchars($tour['persons']) ?></p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="info-item">
                    <i class="fas fa-globe"></i>
                    <h6 class="mb-0 text-muted small">Tour Type</h6>
                    <p class="mb-0 fw-bold">Private Tour</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="info-item">
                    <i class="fas fa-car"></i>
                    <h6 class="mb-0 text-muted small">Transport</h6>
                    <p class="mb-0 fw-bold">Private Vehicle</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Left Content -->
            <div class="col-lg-8">
                <!-- Tour Title -->
                <h2 class="mb-4" style="font-size: 35px; font-weight: 600; color: #333;"><?= htmlspecialchars($tour['title']) ?></h2>
                
                <!-- Gallery Section -->
                <?php if(!empty($tour['gallery_images'])): 
                    $gallery = json_decode($tour['gallery_images'], true);
                    if(is_array($gallery) && count($gallery) > 0):
                ?>
                <div class="gallery-section mb-4">
                    <!-- Main Large Image -->
                    <div class="gallery-main-image">
                        <img id="mainGalleryImage" src="<?= htmlspecialchars($gallery[0]) ?>" alt="Main Gallery Image" class="img-fluid">
                    </div>
                    
                    <!-- Thumbnail Row -->
                    <div class="gallery-thumbnails">
                        <?php foreach($gallery as $index => $img): ?>
                        <div class="gallery-thumbnail <?= $index === 0 ? 'active' : '' ?>" onclick="changeMainImage('<?= htmlspecialchars($img) ?>', this)">
                            <img src="<?= htmlspecialchars($img) ?>" alt="Thumbnail <?= $index + 1 ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; endif; ?>
                
                <!-- Overview Block -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="mb-4"><i class="fas fa-info-circle me-2"></i>Tour Overview</h3>
                        <p class="lead" style="line-height: 1.8; color: #000 !important; font-size: 1.15rem;">
                            <?= nl2br(htmlspecialchars($tour['description'])) ?>
                        </p>
                    </div>
                </div>

                <!-- Itinerary Block -->
                <div class="mb-4">
                    <h3 class="mb-4"><i class="fas fa-route me-2"></i>Day-by-Day Itinerary</h3>
                    <div class="accordion" id="itineraryAccordion">
                        <?php
                        for ($i = 1; $i <= $itinerary_count; $i++) {
                            $headingKey = "itinery_heading_" . $i;
                            $descKey = "itinery_description_" . $i;
                            if (!empty($tour[$headingKey])):
                        ?>
                        <div class="day-item">
                            <div class="day-header" data-bs-toggle="collapse" data-bs-target="#day<?= $i ?>" aria-expanded="false" aria-controls="day<?= $i ?>">
                                <div class="day-number"><?= $i ?></div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-0"><?= htmlspecialchars($tour[$headingKey]) ?></h5>
                                </div>
                                <i class="fas fa-chevron-down text-muted"></i>
                            </div>
                            <div class="collapse day-body" id="day<?= $i ?>" data-bs-parent="#itineraryAccordion">
                                <p class="mb-0 text-muted"><?= nl2br(htmlspecialchars($tour[$descKey])) ?></p>
                            </div>
                        </div>
                        <?php
                            endif;
                        }
                        ?>
                    </div>
                </div>

                <!-- Highlights Block -->
                <div class="mb-4">
                    <h3 class="mb-4"><i class="fas fa-star me-2"></i>Tour Highlights</h3>
                        <div class="row">
                            <?php
                            $highlight_num = 1;
                            for ($i = 1; $i <= 5; $i++) {
                                $highlightKey = "highlight_" . $i;
                                if (!empty($tour[$highlightKey])):
                            ?>
                            <div class="col-md-6 mb-3">
                                <div class="highlight-card">
                                    <h6 class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><?= htmlspecialchars($tour[$highlightKey]) ?></h6>
                                </div>
                            </div>
                            <?php
                                endif;
                            }
                            ?>
                        </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <!-- Golden Triangle Tours -->
                <div class="sidebar-section">
                    <h5 class="mb-3"><i class="fas fa-compass me-2"></i>Special Golden Triangle Tours</h5>
                    <ul class="list-unstyled related-tours">
                        <?php 
                        $gt_sql = "SELECT id, title FROM golden_triangle ORDER BY id DESC LIMIT 10";
                        $gt_result = $conn->query($gt_sql);
                        while($gt = $gt_result->fetch_assoc()): 
                        ?>
                        <li class="mb-2">
                            <a href="golden-triangle-detail-page.php?id=<?= $gt['id'] ?>" class="text-decoration-none text-dark d-block py-2 px-3 rounded hover-bg-light">
                                <i class="fas fa-angle-right"></i><?= htmlspecialchars($gt['title']) ?>
                            </a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <!-- Himachal Tours -->
                <div class="sidebar-section">
                    <h5 class="mb-3"><i class="fas fa-compass me-2"></i>Special Himachal Tours</h5>
                    <ul class="list-unstyled related-tours">
                        <?php 
                        $hm_sql = "SELECT id, title FROM himachal_packages ORDER BY id DESC LIMIT 10";
                        $hm_result = $conn->query($hm_sql);
                        while($hm = $hm_result->fetch_assoc()): 
                        ?>
                        <li class="mb-2">
                            <a href="himachal-detail-page.php?id=<?= $hm['id'] ?>" class="text-decoration-none text-dark d-block py-2 px-3 rounded hover-bg-light">
                                <i class="fas fa-angle-right"></i><?= htmlspecialchars($hm['title']) ?>
                            </a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <!-- Rajasthan Tours -->
                <div class="sidebar-section">
                    <h5 class="mb-3"><i class="fas fa-compass me-2"></i>Special Rajasthan Tours</h5>
                    <ul class="list-unstyled related-tours">
                        <?php 
                        $rj_sql = "SELECT id, title FROM rajasthan_tour ORDER BY id DESC LIMIT 10";
                        $rj_result = $conn->query($rj_sql);
                        while($rj = $rj_result->fetch_assoc()): 
                        ?>
                        <li class="mb-2">
                            <a href="rajasthan-detail-page.php?id=<?= $rj['id'] ?>" class="text-decoration-none text-dark d-block py-2 px-3 rounded hover-bg-light">
                                <i class="fas fa-angle-right"></i><?= htmlspecialchars($rj['title']) ?>
                            </a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <!-- Taj Mahal Tours -->
                <div class="sidebar-section">
                    <h5 class="mb-3"><i class="fas fa-compass me-2"></i>Special Taj Tours</h5>
                    <ul class="list-unstyled related-tours">
                        <?php 
                        $tj_sql = "SELECT id, title FROM tajmahal_tours ORDER BY id DESC LIMIT 10";
                        $tj_result = $conn->query($tj_sql);
                        while($tj = $tj_result->fetch_assoc()): 
                        ?>
                        <li class="mb-2">
                            <a href="tajmahal-detail-page.php?id=<?= $tj['id'] ?>" class="text-decoration-none text-dark d-block py-2 px-3 rounded hover-bg-light">
                                <i class="fas fa-angle-right"></i><?= htmlspecialchars($tj['title']) ?>
                            </a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <!-- Pilgrimage Tours -->
                <div class="sidebar-section">
                    <h5 class="mb-3"><i class="fas fa-compass me-2"></i>Special Pilgrimage Tours</h5>
                    <ul class="list-unstyled related-tours">
                        <?php 
                        $pl_sql = "SELECT id, title FROM pilgrimage_package ORDER BY id DESC LIMIT 10";
                        $pl_result = $conn->query($pl_sql);
                        while($pl = $pl_result->fetch_assoc()): 
                        ?>
                        <li class="mb-2">
                            <a href="pilgrimage-detail-page.php?id=<?= $pl['id'] ?>" class="text-decoration-none text-dark d-block py-2 px-3 rounded hover-bg-light">
                                <i class="fas fa-angle-right"></i><?= htmlspecialchars($pl['title']) ?>
                            </a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <!-- Need Help -->
                <div class="sidebar-section bg-primary text-white">
                    <h5 class="mb-3 text-white">Need Help?</h5>
                    <p class="mb-3 text-white">Contact our travel experts for personalized assistance</p>
                    <a href="contact.php" class="btn btn-light w-100"><i class="fas fa-phone me-2"></i>Contact Us</a>
                </div>

                <!-- Booking Widget -->
                <div class="booking-widget">
                    <h4 class="mb-3">Book This Tour</h4>
                    <form action="inner-page-mail.php" method="POST">
                        <input type="hidden" name="tour_name" value="<?= htmlspecialchars($tour['title']) ?>">
                        <div class="mb-3">
                            <input type="text" name="fname" class="form-control" placeholder="Your Name *" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Your Email *" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control" placeholder="Your Phone *" required>
                        </div>
                        <div class="mb-3">
                            <input type="date" name="travel_date" class="form-control" placeholder="Travel Date">
                        </div>
                        <div class="mb-3">
                            <textarea name="msg" class="form-control" rows="3" placeholder="Special Requirements"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3">
                            <i class="fas fa-paper-plane me-2"></i>Send Enquiry
                        </button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="https://wa.me/<?= htmlspecialchars($headerrow['whatsapp'] ?? '') ?>" target="_blank" class="btn btn-success w-100 py-2">
                            <i class="fab fa-whatsapp me-2"></i>Chat on WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Similar Tours Section -->
<section class="similar-packages-section" id="similarToursSection">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Similar Tour Packages</h2>
            <div class="title-underline"></div>
            <p class="section-subtitle">Discover more amazing destinations</p>
        </div>
        
        <?php 
        if($related_result && $related_result->num_rows > 0): 
        ?>
        <div class="tours-grid-container">
        <?php 
            while($related = $related_result->fetch_assoc()): 
                $rel_img = !empty($related['image']) ? htmlspecialchars($related['image']) : 'assets/images/placeholder.jpg';
                $rel_desc = htmlspecialchars(substr(strip_tags($related['description']), 0, 100));
        ?>
            <div class="tour-grid-item">
                <div class="tour-package-card">
                    <div class="tour-image-wrapper">
                        <img src="<?= $rel_img ?>" alt="<?= htmlspecialchars($related['title']) ?>" class="tour-package-image" onerror="this.src='assets/images/placeholder.jpg';">
                        <div class="tour-overlay"></div>
                    </div>
                    <div class="tour-content-area">
                        <h3 class="tour-package-title"><?= htmlspecialchars($related['title']) ?></h3>
                        <p class="tour-description"><?= $rel_desc ?>...</p>
                        <div class="tour-meta-info">
                            <span class="meta-badge duration-badge">
                                <i class="fas fa-clock"></i> <?= htmlspecialchars($related['duration']) ?>
                            </span>
                            <span class="meta-badge group-badge">
                                <i class="fas fa-users"></i> <?= htmlspecialchars($related['persons']) ?>
                            </span>
                        </div>
                        <a href="?id=<?= $related['id'] ?>" class="tour-details-btn">
                            View Details <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php 
            endwhile;
        ?>
        </div>
        <?php 
        else: 
        ?>
            <div class="no-tours-message">
                <p>No similar tours available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Similar Tours Section Styles */
.similar-packages-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
    position: relative;
}
.section-header {
    margin-bottom: 50px;
}
.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 15px;
}
.title-underline {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #007bff, #0056b3);
    margin: 0 auto 15px;
    border-radius: 2px;
}
.section-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
}
.tours-grid-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    margin-top: 40px;
}
.tour-grid-item {
    width: 100%;
}
.tour-package-card {
    background: #ffffff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
}
.tour-package-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}
.tour-image-wrapper {
    position: relative;
    width: 100%;
    height: 260px;
    overflow: hidden;
}
.tour-package-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.tour-package-card:hover .tour-package-image {
    transform: scale(1.15);
}
.tour-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}
.tour-package-card:hover .tour-overlay {
    opacity: 1;
}
.tour-content-area {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.tour-package-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 12px;
    line-height: 1.4;
    min-height: 2.8rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.tour-description {
    font-size: 0.95rem;
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 20px;
    min-height: 3.2rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.tour-meta-info {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.meta-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 600;
}
.duration-badge {
    background: #e3f2fd;
    color: #1976d2;
}
.group-badge {
    background: #e8f5e9;
    color: #388e3c;
}
.tour-details-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 12px 24px;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-top: auto;
}
.tour-details-btn:hover {
    background: linear-gradient(135deg, #0056b3 0%, #003d82 100%);
    color: #ffffff;
    transform: translateX(5px);
}
.no-tours-message {
    text-align: center;
    padding: 40px;
    color: #6c757d;
    font-size: 1.1rem;
}

@media (max-width: 1199px) {
    .tours-grid-container {
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }
}
@media (max-width: 991px) {
    .section-title {
        font-size: 2rem;
    }
    .tours-grid-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
}
@media (max-width: 767px) {
    .similar-packages-section {
        padding: 60px 0;
    }
    .section-title {
        font-size: 1.75rem;
    }
    .tour-image-wrapper {
        height: 220px;
    }
    .tours-grid-container {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}
</style>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalGalleryImg" src="" class="img-fluid" alt="Gallery Image">
            </div>
        </div>
    </div>
</div>

<script>
const galleryImages = <?= !empty($tour['gallery_images']) ? $tour['gallery_images'] : '[]' ?>;

function changeMainImage(imageSrc, thumbnailElement) {
    // Update main image
    document.getElementById('mainGalleryImage').src = imageSrc;
    
    // Remove active class from all thumbnails
    document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });
    
    // Add active class to clicked thumbnail
    thumbnailElement.classList.add('active');
}

function openGalleryModal(index) {
    if(galleryImages[index]) {
        document.getElementById('modalGalleryImg').src = galleryImages[index];
        const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
        modal.show();
    }
}

// Itinerary Accordion functionality
document.addEventListener('DOMContentLoaded', function() {
    const dayHeaders = document.querySelectorAll('.day-header');
    
    dayHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const targetId = this.getAttribute('data-bs-target');
            const targetElement = document.querySelector(targetId);
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            // Close all other accordions
            document.querySelectorAll('.day-header').forEach(h => {
                if (h !== this) {
                    h.setAttribute('aria-expanded', 'false');
                }
            });
            document.querySelectorAll('.day-body').forEach(body => {
                if (body !== targetElement) {
                    body.classList.remove('show');
                }
            });
            
            // Toggle current accordion
            if (isExpanded) {
                this.setAttribute('aria-expanded', 'false');
                targetElement.classList.remove('show');
            } else {
                this.setAttribute('aria-expanded', 'true');
                targetElement.classList.add('show');
            }
        });
    });
});
</script>

<?php include('footer.php'); ?>
