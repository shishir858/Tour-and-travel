<?php
require_once 'includes/config.php';
$page_title = "Gallery - Tourist Drivers India";

// Get gallery images
$gallery_query = "SELECT * FROM gallery_new WHERE is_active = 1 ORDER BY display_order, created_at DESC";
$gallery = $conn->query($gallery_query);

include 'includes/header.php';
?>

<style>
    .gallery-hero {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.95) 0%, rgba(247, 147, 30, 0.95) 100%);
        padding: 120px 0 80px;
        color: white;
        text-align: center;
    }
    .gallery-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 15px;
    }
    .gallery-section {
        padding: 80px 0;
    }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        cursor: pointer;
        aspect-ratio: 1;
    }
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s;
    }
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 107, 53, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s;
    }
    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }
    .gallery-overlay i {
        color: white;
        font-size: 3rem;
    }
    .gallery-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        color: white;
        padding: 20px;
        transform: translateY(100%);
        transition: all 0.3s;
    }
    .gallery-item:hover .gallery-caption {
        transform: translateY(0);
    }
</style>

<!-- Lightbox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

<!-- Hero Section -->
<section class="gallery-hero">
    <div class="container">
        <h1>Photo Gallery</h1>
        <p>Explore the beauty of India through our lens</p>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section">
    <div class="container">
        <?php if($gallery->num_rows > 0): ?>
            <div class="gallery-grid">
                <?php while($image = $gallery->fetch_assoc()): ?>
                    <a href="<?php echo htmlspecialchars($image['image_url']); ?>" 
                       data-lightbox="gallery" 
                       data-title="<?php echo htmlspecialchars($image['title'] ?? ''); ?>"
                       class="gallery-item">
                        <img src="<?php echo htmlspecialchars($image['image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($image['title'] ?? 'Gallery Image'); ?>">
                        <div class="gallery-overlay">
                            <i class="fas fa-search-plus"></i>
                        </div>
                        <?php if($image['title']): ?>
                            <div class="gallery-caption">
                                <h5 class="mb-0"><?php echo htmlspecialchars($image['title']); ?></h5>
                                <?php if($image['description']): ?>
                                    <p class="mb-0 small"><?php echo htmlspecialchars($image['description']); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-images" style="font-size: 4rem; color: #ddd;"></i>
                <h3 class="mt-3">No images yet</h3>
                <p class="text-muted">Gallery will be updated soon with amazing travel photos</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<?php include 'includes/footer.php'; ?>
