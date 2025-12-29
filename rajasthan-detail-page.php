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
?>

<style>
.tour-hero {
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), <?php echo !empty($tour['image']) ? "url('admin/" . htmlspecialchars($tour['image']) . "')" : "linear-gradient(135deg, #667eea 0%, #764ba2 100%)"; ?>;
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
    padding: 20px;
    background: white;
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
.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    transition: transform 0.3s ease;
}
.gallery-item:hover {
    transform: scale(1.05);
}
.gallery-item img:hover {
    opacity: 0.9;
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
                    <div class="row g-2">
                        <?php foreach($gallery as $index => $img): ?>
                        <div class="col-md-3 col-6">
                            <div class="gallery-item">
                                <img src="<?= htmlspecialchars($img) ?>" alt="Gallery Image" class="img-fluid rounded" style="width: 100%; height: 150px; object-fit: cover; cursor: pointer;" onclick="openGalleryModal(<?= $index ?>)">
                            </div>
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
                                <i class="fas fa-angle-right me-2 text-primary"></i><?= htmlspecialchars($gt['title']) ?>
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
                                <i class="fas fa-angle-right me-2 text-primary"></i><?= htmlspecialchars($hm['title']) ?>
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
                                <i class="fas fa-angle-right me-2 text-primary"></i><?= htmlspecialchars($rj['title']) ?>
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
                                <i class="fas fa-angle-right me-2 text-primary"></i><?= htmlspecialchars($tj['title']) ?>
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
                                <i class="fas fa-angle-right me-2 text-primary"></i><?= htmlspecialchars($pl['title']) ?>
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
function openGalleryModal(index) {
    if(galleryImages[index]) {
        document.getElementById('modalGalleryImg').src = galleryImages[index];
        const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
        modal.show();
    }
}
</script>

<?php include('footer.php'); ?>
