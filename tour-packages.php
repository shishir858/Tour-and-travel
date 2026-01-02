<?php
require_once 'includes/config.php';
$page_title = "Tour Packages - Tourist Drivers India";

// Get category filter
$category_id = 0;
$category_slug = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';

if(!empty($category_slug)) {
    // Check if it's numeric (old ID format) or slug
    if(is_numeric($category_slug)) {
        $category_id = intval($category_slug);
    } else {
        // Get category ID from slug
        $cat_result = $conn->query("SELECT id FROM categories WHERE slug = '$category_slug' AND is_active = 1");
        if($cat_result && $cat_result->num_rows > 0) {
            $cat_data = $cat_result->fetch_assoc();
            $category_id = $cat_data['id'];
        }
    }
}

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Build query
$where = "WHERE p.is_active = 1";
if($category_id > 0) {
    $where .= " AND p.category_id = $category_id";
}
if(!empty($search)) {
    $where .= " AND (p.title LIKE '%$search%' OR p.short_description LIKE '%$search%')";
}

// Get packages
$packages_query = "SELECT p.*, c.name as category_name 
                   FROM tour_packages p 
                   LEFT JOIN categories c ON p.category_id = c.id 
                   $where 
                   ORDER BY p.is_featured DESC, p.display_order ASC, p.created_at DESC";
$packages_result = $conn->query($packages_query);

// Get categories for filter
$categories = $conn->query("SELECT * FROM categories WHERE is_active = 1 ORDER BY display_order");

include 'includes/header.php';
?>

<style>
    .page-banner {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.9) 0%, rgba(247, 147, 30, 0.9) 100%);
        padding: 120px 0 80px;
        color: white;
        text-align: center;
    }
    .page-banner h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 15px;
    }
    .filter-section {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin: -50px auto 50px;
        max-width: 1200px;
        position: relative;
        z-index: 10;
    }
    .filter-buttons-wrapper {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        overflow-y: hidden;
        padding: 10px 0;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }
    .filter-buttons-wrapper::-webkit-scrollbar {
        height: 6px;
    }
    .filter-buttons-wrapper::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .filter-buttons-wrapper::-webkit-scrollbar-thumb {
        background: #FF6B35;
        border-radius: 10px;
    }
    .filter-buttons-wrapper::-webkit-scrollbar-thumb:hover {
        background: #F7931E;
    }
    .filter-btn {
        padding: 4px 10px;
        border: 2px solid #FF6B35;
        background: white;
        color: #FF6B35;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        font-size: 13px;
        text-decoration: none;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .filter-btn:hover, .filter-btn.active {
        background: #FF6B35;
        color: white;
    }
    .packages-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        margin: 50px 0;
    }
    
    @media (max-width: 1399px) {
        .packages-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    @media (max-width: 991px) {
        .packages-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 575px) {
        .packages-grid {
            grid-template-columns: 1fr;
        }
    }
    .package-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }
    .package-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    .package-image {
        height: 250px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    .package-badge {
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
    .package-content {
        padding: 25px;
    }
    .package-category {
        color: #FF6B35;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 10px;
    }
    .package-title {
        font-size: 1rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }
    .package-description {
        display: none;
    }
    .package-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    .package-meta span {
        color: #666;
        font-size: 12px;
    }
    .package-meta i {
        color: #FF6B35;
        margin-right: 5px;
    }
    .package-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .package-price {
        font-size: 1.75rem;
        font-weight: 700;
        color: #FF6B35;
    }
    .package-price small {
        font-size: 14px;
        color: #666;
        font-weight: 400;
    }
    .btn-view-package {
        padding: 12px 30px;
        background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
        color: white;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-view-package:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
        color: white;
    }
    .search-box {
        margin-bottom: 30px;
    }
    .search-box input {
        padding: 15px 25px;
        border: 2px solid #eee;
        border-radius: 50px;
        width: 100%;
        font-size: 16px;
    }
    .search-box input:focus {
        outline: none;
        border-color: #FF6B35;
    }
</style>

<!-- Page Banner -->
<section class="page-banner">
    <div class="container">
        <h1>Tour Packages</h1>
        <p>Discover amazing destinations across India</p>
    </div>
</section>

<!-- Filter Section -->
<div class="container">
    <div class="filter-section">
        <div class="row align-items-center">
            <div class="col-lg-3 mb-3 mb-lg-0">
                <h5 class="mb-0">Filter by Category:</h5>
            </div>
            <div class="col-lg-9">
                <div class="filter-buttons-wrapper">
                    <a href="<?php echo SITE_URL; ?>tour-packages" class="filter-btn <?php echo $category_id == 0 ? 'active' : ''; ?>">All Packages</a>
                    <?php while($cat = $categories->fetch_assoc()): ?>
                        <a href="<?php echo SITE_URL; ?>tour-packages?category=<?php echo $cat['slug']; ?>" 
                           class="filter-btn <?php echo $category_slug == $cat['slug'] ? 'active' : ''; ?>">
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12">
                <form method="GET" class="search-box">
                    <?php if(!empty($category_slug)): ?>
                        <input type="hidden" name="category" value="<?php echo htmlspecialchars($category_slug); ?>">
                    <?php endif; ?>
                    <input type="text" name="search" placeholder="Search packages..." value="<?php echo htmlspecialchars($search); ?>">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Packages Grid -->
<section class="py-5">
    <div class="container">
        <?php if($packages_result->num_rows > 0): ?>
            <div class="packages-grid">
                <?php while($package = $packages_result->fetch_assoc()): ?>
                    <div class="package-card">
                        <div class="package-image" style="background-image: url('<?php echo SITE_URL . 'uploads/packages/' . ($package['featured_image'] ?? 'default.jpg'); ?>')">
                            <?php if($package['is_featured']): ?>
                                <div class="package-badge">Featured</div>
                            <?php endif; ?>
                        </div>
                        <div class="package-content">
                            <div class="package-category"><?php echo htmlspecialchars($package['category_name']); ?></div>
                            <h3 class="package-title">
                                <?php 
                                $title = $package['title'];
                                $words = explode(' ', $title);
                                echo htmlspecialchars(implode(' ', array_slice($words, 0, 4)));
                                if(count($words) > 4) echo '...';
                                ?>
                            </h3>
                            <p class="package-description">
                                <?php echo substr(strip_tags($package['short_description'] ?? $package['description']), 0, 120); ?>...
                            </p>
                            <div class="package-meta">
                                <span><i class="far fa-clock"></i> <?php echo $package['duration_days']; ?> Days / <?php echo $package['duration_nights']; ?> Nights</span>
                                <?php if($package['max_group_size']): ?>
                                    <span><i class="fas fa-users"></i> Max <?php echo $package['max_group_size']; ?> People</span>
                                <?php endif; ?>
                            </div>
                            <div class="package-footer">
                                <?php if($package['base_price'] > 0): ?>
                                    <div class="package-price">
                                        ₹<?php echo number_format($package['discounted_price'] ?? $package['base_price']); ?>
                                        <small>/person</small>
                                    </div>
                                <?php else: ?>
                                    <!-- <div class="package-price" style="font-size: 1.2rem;">Contact for Price</div> -->
                                <?php endif; ?>
                                <a href="<?php echo SITE_URL; ?>package/<?php echo $package['slug'] ?: $package['id']; ?>" class="btn-view-package">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-search" style="font-size: 4rem; color: #ddd;"></i>
                <h3 class="mt-3">No packages found</h3>
                <p class="text-muted">Try adjusting your search or filter criteria</p>
                <a href="<?php echo SITE_URL; ?>tour-packages" class="btn-view-package mt-3">View All Packages</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
