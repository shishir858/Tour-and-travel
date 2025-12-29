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
    $result = $conn->query("SELECT * FROM cars WHERE id = $id");
    if($row = $result->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($row);
        exit;
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM cars WHERE id = $id");
    header('Location: cars.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $car_name = $conn->real_escape_string($_POST['car_name']);
    $car_type = $conn->real_escape_string($_POST['car_type']);
    $start_price = $conn->real_escape_string($_POST['start_price']);
    $min_running = $conn->real_escape_string($_POST['min_running']);
    $passengers = $conn->real_escape_string($_POST['passengers']);
    $whatsapp_link = $conn->real_escape_string($_POST['whatsapp_link']);
    
    // Handle image upload
    $image_url = '';
    if(isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $upload_dir = '../assets/vehicles/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($_FILES['image_url']['name'], PATHINFO_EXTENSION));
        $new_filename = 'car_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
        $target_file = $upload_dir . $new_filename;
        if(move_uploaded_file($_FILES['image_url']['tmp_name'], $target_file)) {
            $image_url = 'assets/vehicles/' . $new_filename;
        }
    } elseif($id > 0) {
        // Keep existing image if editing and no new upload
        $result = $conn->query("SELECT image_url FROM cars WHERE id=$id");
        if($row = $result->fetch_assoc()) {
            $image_url = $row['image_url'];
        }
    }
    
    if ($id > 0) {
        $conn->query("UPDATE cars SET car_name='$car_name', car_type='$car_type', start_price='$start_price', min_running='$min_running', passengers='$passengers', image_url='$image_url', whatsapp_link='$whatsapp_link' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO cars (car_name, car_type, start_price, min_running, passengers, image_url, whatsapp_link) VALUES ('$car_name', '$car_type', '$start_price', '$min_running', '$passengers', '$image_url', '$whatsapp_link')");
    }
    header('Location: cars.php');
    exit;
}

$cars = $conn->query("SELECT * FROM cars ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
    <?php include_once(__DIR__.'/includes/header.php'); ?>
    <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
    
    <main id="main-content">
        <h1 class="page-title">Manage Cars</h1>
        
        <div class="dashboard-card mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carModal" onclick="resetForm()">Add New Car</button>
        </div>
        
        <div class="data-table-wrapper">
            <table class="data-table table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Car Name</th>
                        <th>Type</th>
                        <th>Passengers</th>
                        <th>Start Price</th>
                        <th>Min Running</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $cars->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['car_name']) ?></td>
                        <td><?= htmlspecialchars($row['car_type']) ?></td>
                        <td><?= htmlspecialchars($row['passengers']) ?></td>
                        <td><?= htmlspecialchars($row['start_price']) ?></td>
                        <td><?= htmlspecialchars($row['min_running']) ?></td>
                        <td><?php if(!empty($row['image_url'])): ?><img src="<?= htmlspecialchars($row['image_url']) ?>" style="width:60px;height:40px;object-fit:cover;"><?php endif; ?></td>
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
    
    <div class="modal fade" id="carModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Car Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="itemId">
                        <div class="mb-3">
                            <label class="form-label">Car Name</label>
                            <input type="text" name="car_name" id="itemCarName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Car Type</label>
                            <input type="text" name="car_type" id="itemCarType" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Start Price</label>
                            <input type="text" name="start_price" id="itemStartPrice" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Min Running</label>
                            <input type="text" name="min_running" id="itemMinRunning" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Passengers</label>
                            <input type="text" name="passengers" id="itemPassengers" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Car Image</label>
                            <input type="file" name="image_url" id="itemImageUrl" class="form-control" accept="image/*">
                            <input type="hidden" name="old_image" id="itemOldImage">
                            <small class="text-muted">Leave empty to keep existing image</small>
                            <div id="currentImageName" class="mt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">WhatsApp Link</label>
                            <input type="text" name="whatsapp_link" id="itemWhatsappLink" class="form-control" placeholder="https://wa.me/...">
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
            document.getElementById('itemCarName').value = '';
            document.getElementById('itemCarType').value = '';
            document.getElementById('itemStartPrice').value = '';
            document.getElementById('itemMinRunning').value = '';
            document.getElementById('itemPassengers').value = '';
            document.getElementById('itemImageUrl').value = '';
            document.getElementById('itemWhatsappLink').value = '';
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
                    document.getElementById('itemCarName').value = data.car_name || '';
                    document.getElementById('itemCarType').value = data.car_type || '';
                    document.getElementById('itemStartPrice').value = data.start_price || '';
                    document.getElementById('itemMinRunning').value = data.min_running || '';
                    document.getElementById('itemPassengers').value = data.passengers || '';
                    document.getElementById('itemWhatsappLink').value = data.whatsapp_link || '';
                    new bootstrap.Modal(document.getElementById('carModal')).show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading data. Please try again.');
                });
        }
    </script>
</body>
</html>
