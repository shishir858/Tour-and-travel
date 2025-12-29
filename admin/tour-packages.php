<?php
session_start();
include_once(__DIR__.'/includes/config.php');
if (!isset($_SESSION['admin_id'])) {
    header('Location: ./');
    exit;
}

// Handle AJAX request
if(isset($_GET['ajax']) && $_GET['ajax'] == 'get' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM tour_packages WHERE id = $id");
    if($row = $result->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($row);
        exit;
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM tour_packages WHERE id = $id");
    header('Location: tour-packages.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $package_name = $conn->real_escape_string($_POST['package_name']);
    $description = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['category']);
    $rating = intval($_POST['rating']);
    $booking_link = $conn->real_escape_string($_POST['booking_link']);
    
    // Handle image upload
    $package_image = '';
    if(isset($_FILES['package_image']) && $_FILES['package_image']['error'] == 0) {
        $upload_dir = '../assets/img/packages/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($_FILES['package_image']['name'], PATHINFO_EXTENSION));
        $new_filename = 'package_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
        $target_file = $upload_dir . $new_filename;
        if(move_uploaded_file($_FILES['package_image']['tmp_name'], $target_file)) {
            $package_image = 'assets/img/packages/' . $new_filename;
        }
    } elseif($id > 0) {
        $result = $conn->query("SELECT package_image FROM tour_packages WHERE id=$id");
        if($row = $result->fetch_assoc()) {
            $package_image = $row['package_image'];
        }
    }
    
    if ($id > 0) {
        $conn->query("UPDATE tour_packages SET package_name='$package_name', description='$description', category='$category', package_image='$package_image', rating=$rating, booking_link='$booking_link' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO tour_packages (package_name, description, category, package_image, rating, booking_link) VALUES ('$package_name', '$description', '$category', '$package_image', $rating, '$booking_link')");
    }
    header('Location: tour-packages.php');
    exit;
}

$packages = $conn->query("SELECT * FROM tour_packages ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tour Packages</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
    <?php include_once(__DIR__.'/includes/header.php'); ?>
    <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
    
    <main id="main-content">
        <h1 class="page-title">Manage Tour Packages</h1>
        
        <div class="dashboard-card mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packageModal" onclick="resetForm()">Add New Package</button>
        </div>
        
        <div class="data-table-wrapper">
            <table class="data-table table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Package Name</th>
                        <th>Category</th>
                        <th>Rating</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $packages->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['package_name']) ?></td>
                        <td><?= htmlspecialchars($row['category']) ?></td>
                        <td><?= $row['rating'] ?> ⭐</td>
                        <td>
                            <img src="<?= htmlspecialchars($row['package_image']) ?>" style="width:60px;height:40px;object-fit:cover;border:1px solid #ddd;" alt="<?= htmlspecialchars($row['package_name']) ?>">
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editItem(<?= $row['id'] ?>)">Edit</button>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    
    <div class="modal fade" id="packageModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Package Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="itemId">
                        <div class="mb-3">
                            <label class="form-label">Package Name</label>
                            <input type="text" name="package_name" id="itemPackageName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Package Image</label>
                            <input type="file" name="package_image" id="itemPackageImage" class="form-control" accept="image/*">
                            <input type="hidden" name="old_image" id="itemOldImage">
                            <small class="text-muted">Leave empty to keep existing image</small>
                            <div id="currentImageName" class="mt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" id="itemCategory" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="itemDescription" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <input type="number" name="rating" id="itemRating" class="form-control" min="1" max="5" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Package Image Filename</label>
                            <input type="text" name="package_image" id="itemPackageImage" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Booking Link</label>
                            <input type="text" name="booking_link" id="itemBookingLink" class="form-control" required>
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
            document.getElementById('itemPackageName').value = '';
            document.getElementById('itemCategory').value = '';
            document.getElementById('itemDescription').value = '';
            document.getElementById('itemRating').value = '5';
            document.getElementById('itemPackageImage').value = '';
            document.getElementById('itemBookingLink').value = '';
        }
        function editItem(id) {
            fetch('?ajax=get&id=' + id)
                .then(r => {
                    if(!r.ok) throw new Error('Network response was not ok');
                    return r.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    document.getElementById('itemId').value = data.id;
                    document.getElementById('itemPackageName').value = data.package_name || '';
                    document.getElementById('itemCategory').value = data.category || '';
                    document.getElementById('itemDescription').value = data.description || '';
                    document.getElementById('itemRating').value = data.rating || '5';
                    document.getElementById('itemBookingLink').value = data.booking_link || '';
                    new bootstrap.Modal(document.getElementById('packageModal')).show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading data. Please try again.');
                });
        }
    </script>
</body>
</html>
