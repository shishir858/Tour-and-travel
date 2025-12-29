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
    $result = $conn->query("SELECT * FROM other_services WHERE id = $id");
    if($row = $result->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($row);
        exit;
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM other_services WHERE id = $id");
    header('Location: other-services.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $category = $conn->real_escape_string($_POST['category']);
    $package_name = $conn->real_escape_string($_POST['package_name']);
    $description = $conn->real_escape_string($_POST['description']);
    $old_package_image = isset($_POST['old_package_image']) ? $_POST['old_package_image'] : '';
    
    // Handle image upload
    $package_image = '';
    if(isset($_FILES['package_image']) && $_FILES['package_image']['error'] == 0) {
        $upload_dir = '../assets/img/packages/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($_FILES['package_image']['name'], PATHINFO_EXTENSION));
        $new_filename = 'service_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
        $target_file = $upload_dir . $new_filename;
        if(move_uploaded_file($_FILES['package_image']['tmp_name'], $target_file)) {
            $package_image = 'assets/img/packages/' . $new_filename;
            // Delete old image
            if($id > 0 && !empty($old_package_image) && file_exists(__DIR__ . '/../' . $old_package_image)) {
                unlink(__DIR__ . '/../' . $old_package_image);
            }
        }
    } elseif($id > 0) {
        $result = $conn->query("SELECT package_image FROM other_services WHERE id=$id");
        if($row = $result->fetch_assoc()) {
            $package_image = $row['package_image'];
        }
    }
    
    if ($id > 0) {
        $conn->query("UPDATE other_services SET category='$category', package_name='$package_name', package_image='$package_image', description='$description' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO other_services (category, package_name, package_image, description) VALUES ('$category', '$package_name', '$package_image', '$description')");
    }
    header('Location: other-services.php');
    exit;
}

$services = $conn->query("SELECT * FROM other_services ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other Services</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
    <?php include_once(__DIR__.'/includes/header.php'); ?>
    <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
    
    <main id="main-content">
        <h1 class="page-title">Other Services</h1>
        
        <div class="dashboard-card mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal" onclick="resetForm()">Add New Service</button>
        </div>
        
        <div class="data-table-wrapper">
            <table class="data-table table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Package Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $services->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['category']) ?></td>
                        <td><?= htmlspecialchars($row['package_name']) ?></td>
                        <td><?php if(!empty($row['package_image'])): ?><img src="<?= htmlspecialchars($row['package_image']) ?>" style="width:60px;height:40px;object-fit:cover;"><?php endif; ?></td>
                        <td><?= htmlspecialchars(substr($row['description'], 0, 50)) ?>...</td>
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
    
    <!-- Modal -->
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Service Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="serviceId">
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" name="category" id="category" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Package Name</label>
                            <input type="text" class="form-control" name="package_name" id="package_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Service Image</label>
                            <input type="file" class="form-control" name="package_image" id="package_image" accept="image/*">
                            <small class="text-muted">Leave empty to keep existing image</small>
                            <input type="hidden" name="old_package_image" id="old_package_image">
                            <div id="currentImageName"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
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
            document.getElementById('serviceId').value = '';
            document.getElementById('category').value = '';
            document.getElementById('package_name').value = '';
            document.getElementById('package_image').value = '';
            document.getElementById('description').value = '';
            document.getElementById('old_package_image').value = '';
            document.getElementById('currentImageName').innerHTML = '';
        }
        
        function editItem(id) {
            fetch('?ajax=get&id=' + id)
                .then(r => {
                    if(!r.ok) throw new Error('Network response was not ok');
                    return r.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    document.getElementById('serviceId').value = data.id;
                    document.getElementById('category').value = data.category || '';
                    document.getElementById('package_name').value = data.package_name || '';
                    document.getElementById('description').value = data.description || '';
                    document.getElementById('old_package_image').value = data.package_image || '';
                    const imgDiv = document.getElementById('currentImageName');
                    if(data.package_image) imgDiv.innerHTML = '<small class="text-info">📸 Current: <strong>' + data.package_image + '</strong></small>';
                    else imgDiv.innerHTML = '';
                    new bootstrap.Modal(document.getElementById('serviceModal')).show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading data. Please try again.');
                });
        }
    </script>
</body>
</html>
            if($row = $result->fetch_assoc()) {
                header('Content-Type: application/json');
                echo json_encode($row);
                exit;
            }
        }
        ?>
    </script>
</body>
</html>
