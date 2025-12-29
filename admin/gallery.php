<?php
session_start();
include_once(__DIR__.'/includes/config.php');
if (!isset($_SESSION['admin_id'])) {
    header('Location: ./');
    exit;
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM gallery WHERE id = $id");
    header('Location: gallery.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    // Handle image upload
    $image_url = '';
    if(isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $upload_dir = '../assets/img/gallery/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($_FILES['image_url']['name'], PATHINFO_EXTENSION));
        $new_filename = 'gallery_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
        $target_file = $upload_dir . $new_filename;
        if(move_uploaded_file($_FILES['image_url']['tmp_name'], $target_file)) {
            $image_url = 'assets/img/gallery/' . $new_filename;
        }
    } elseif($id > 0) {
        $result = $conn->query("SELECT image_url FROM gallery WHERE id=$id");
        if($row = $result->fetch_assoc()) {
            $image_url = $row['image_url'];
        }
    }
    
    if ($id > 0) {
        $conn->query("UPDATE gallery SET image_url='$image_url' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO gallery (image_url) VALUES ('$image_url')");
    }
    header('Location: gallery.php');
    exit;
}

$gallery = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
    <?php include_once(__DIR__.'/includes/header.php'); ?>
    <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
    
    <main id="main-content">
        <h1 class="page-title">Manage Gallery</h1>
        
        <div class="dashboard-card mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#galleryModal" onclick="resetForm()">Add New Image</button>
        </div>
        
        <div class="row g-4">
            <?php while($row = $gallery->fetch_assoc()): ?>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <?php if(!empty($row['image_url'])): ?>
                    <img src="<?= htmlspecialchars($row['image_url']) ?>" class="img-fluid mb-2" style="height:200px;object-fit:cover;width:100%;" alt="Gallery Image">
                    <?php else: ?>
                    <div style="height:200px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;">No Image</div>
                    <?php endif; ?>
                    <small class="text-muted">ID: <?= $row['id'] ?></small>
                    <div class="mt-2">
                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">Delete</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </main>
    
    <div class="modal fade" id="galleryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Gallery Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="itemId">
                        <div class="mb-3">
                            <label class="form-label">Gallery Image</label>
                            <input type="file" name="image_url" id="itemImageUrl" class="form-control" accept="image/*">
                            <small class="text-muted">Select an image to upload</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php include_once(__DIR__.'/includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function resetForm() {
            document.getElementById('itemId').value = '';
            document.getElementById('itemImageUrl').value = '';
        }
    </script>
</body>
</html>
