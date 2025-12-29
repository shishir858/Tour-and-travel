<?php
session_start();
include_once(__DIR__.'/includes/config.php');
include_once(__DIR__.'/logic/gallery-upload.php');
if (!isset($_SESSION['admin_id'])) {
    header('Location: ./');
    exit;
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM pilgrimage_package WHERE id = $id");
    header('Location: pilgrimage-package.php');
    exit;
}

// Handle AJAX request for getting item data
if(isset($_GET['ajax']) && $_GET['ajax'] == 'get' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM pilgrimage_package WHERE id = $id");
    if($row = $result->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($row);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $duration = $conn->real_escape_string($_POST['duration']);
    $persons = $conn->real_escape_string($_POST['persons']);
    $places_covered = $conn->real_escape_string($_POST['places_covered']);
    $old_image = isset($_POST['old_image']) ? $_POST['old_image'] : '';
    
    // Handle image upload
    $image = $old_image; // Keep existing image by default
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = '../assets/img/pilgrimage-photos/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $new_filename = 'pilgrimage_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
        $target_file = $upload_dir . $new_filename;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image = 'assets/img/pilgrimage-photos/' . $new_filename;
            // Delete old image
            if($id > 0 && !empty($old_image) && file_exists(__DIR__ . '/../' . $old_image)) {
                unlink(__DIR__ . '/../' . $old_image);
            }
        }
    } elseif($id > 0) {
        $result = $conn->query("SELECT image FROM pilgrimage_package WHERE id=$id");
        if($row = $result->fetch_assoc()) {
            $image = $row['image'];
        }
    }
    
    // Handle gallery images upload using helper function
    $gallery_images = handleGalleryUpload($_FILES, 'pilgrimage_package', $id);
    
    // Build itinerary fields (17 sets)
    $itinerary_fields = [];
    for($i = 1; $i <= 17; $i++) {
        $itinerary_fields["itinery_heading_$i"] = isset($_POST["itinery_heading_$i"]) ? $conn->real_escape_string($_POST["itinery_heading_$i"]) : '';
        $itinerary_fields["itinery_description_$i"] = isset($_POST["itinery_description_$i"]) ? $conn->real_escape_string($_POST["itinery_description_$i"]) : '';
    }
    
    // Build highlights
    $highlights = [];
    for($i = 1; $i <= 5; $i++) {
        $highlights["highlight_$i"] = isset($_POST["highlight_$i"]) ? $conn->real_escape_string($_POST["highlight_$i"]) : '';
    }
    
    if ($id > 0) {
        $sql = "UPDATE pilgrimage_package SET 
                title='$title', image='$image', gallery_images='$gallery_images', description='$description', 
                duration='$duration', persons='$persons', places_covered='$places_covered'";
        
        foreach($itinerary_fields as $key => $val) {
            $sql .= ", $key='$val'";
        }
        foreach($highlights as $key => $val) {
            $sql .= ", $key='$val'";
        }
        $sql .= " WHERE id=$id";
        $conn->query($sql);
    } else {
        $cols = "title, image, gallery_images, description, duration, persons, places_covered";
        $vals = "'$title', '$image', '$gallery_images', '$description', '$duration', '$persons', '$places_covered'";
        
        foreach($itinerary_fields as $key => $val) {
            $cols .= ", $key";
            $vals .= ", '$val'";
        }
        foreach($highlights as $key => $val) {
            $cols .= ", $key";
            $vals .= ", '$val'";
        }
        
        $conn->query("INSERT INTO pilgrimage_package ($cols) VALUES ($vals)");
    }
    header('Location: pilgrimage-package.php');
    exit;
}

$packages = $conn->query("SELECT * FROM pilgrimage_package ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilgrimage Packages</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
    <?php include_once(__DIR__.'/includes/header.php'); ?>
    <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
    
    <main id="main-content">
        <h1 class="page-title">Pilgrimage Packages</h1>
        
        <div class="dashboard-card mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packageModal" onclick="resetForm()">Add New Package</button>
        </div>
        
        <div class="data-table-wrapper">
            <table class="data-table table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Duration</th>
                        <th>Persons</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $packages->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['duration']) ?></td>
                        <td><?= htmlspecialchars($row['persons']) ?></td>
                        <td>
                            <?php if(!empty($row['image'])): ?>
                                <img src="../<?= htmlspecialchars($row['image']) ?>" style="width:60px;height:40px;object-fit:cover;" onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2260%22 height=%2240%22%3E%3Crect fill=%22%23ddd%22 width=%2260%22 height=%2240%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 fill=%22%23999%22 font-size=%228%22%3ENo Image%3C/text%3E%3C/svg%3E';">
                            <?php else: ?>
                                <span class="text-muted small">No image</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="viewItem(<?= $row['id'] ?>)">Edit</button>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    
    <!-- Add/Edit Modal -->
    <div class="modal fade" id="packageModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilgrimage Package Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <input type="hidden" name="id" id="itemId">
                        
                        <!-- Basic Info -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" id="itemTitle" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Package Banner</label>
                                <input type="file" name="image" id="itemImage" class="form-control" accept="image/*">
                                <small class="text-muted">Leave empty to keep existing image</small>
                                <input type="hidden" name="old_image" id="old_image">
                                <div id="currentImageName"></div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Gallery Images (Multiple)</label>
                                <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                                <small class="text-muted">Select multiple images for gallery. Leave empty to keep existing images.</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="itemDescription" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Duration</label>
                                <input type="text" name="duration" id="itemDuration" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Persons</label>
                                <input type="text" name="persons" id="itemPersons" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Places Covered</label>
                                <input type="text" name="places_covered" id="itemPlacesCovered" class="form-control">
                            </div>
                        </div>
                        
                        <!-- Itineraries Accordion -->
                        <div class="mt-4 mb-3">
                            <h5 class="fw-bold text-primary mb-3">📅 Day-by-Day Itinerary</h5>
                            <p class="text-muted small mb-3">Add detailed itinerary for each day of the tour</p>
                        </div>
                        <div class="accordion accordion-flush" id="itineraryAccordion" style="border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;">
                            <?php for($i = 1; $i <= 17; $i++): ?>
                            <div class="accordion-item" style="border: none; border-bottom: 1px solid #e0e0e0;">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$i?>" style="background: #f8f9fa; font-weight: 500; padding: 12px 20px;">
                                        <span class="badge bg-primary rounded-circle me-3" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;"><?=$i?></span>
                                        <span>Day <?=$i?> Itinerary</span>
                                    </button>
                                </h2>
                                <div id="collapse<?=$i?>" class="accordion-collapse collapse" data-bs-parent="#itineraryAccordion">
                                    <div class="accordion-body" style="background: #ffffff; padding: 20px;">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">📍 Day Title / Heading</label>
                                            <input type="text" name="itinery_heading_<?=$i?>" id="itemHeading<?=$i?>" class="form-control" placeholder="e.g., Arrival in Delhi - Explore the Capital">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label fw-semibold">📝 Day Description</label>
                                            <textarea name="itinery_description_<?=$i?>" id="itemDesc<?=$i?>" class="form-control" rows="3" placeholder="Describe the activities, places to visit, and highlights for this day..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                        
                        <!-- Highlights -->
                        <div class="mt-4 mb-3">
                            <h5 class="fw-bold text-success mb-3">✨ Tour Highlights</h5>
                            <p class="text-muted small mb-3">Add key attractions and special features of this tour</p>
                        </div>
                        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #e0e0e0;">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">⭐ Highlight <?=$i?></label>
                                <input type="text" name="highlight_<?=$i?>" id="itemHighlight<?=$i?>" class="form-control" placeholder="e.g., Visit Taj Mahal at sunrise">
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Package</button>
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
            document.getElementById('itemTitle').value = '';
            document.getElementById('itemImage').value = '';
            document.getElementById('itemDescription').value = '';
            document.getElementById('itemDuration').value = '';
            document.getElementById('itemPersons').value = '';
            document.getElementById('itemPlacesCovered').value = '';
            document.getElementById('old_image').value = '';
            document.getElementById('currentImageName').innerHTML = '';
            for(let i = 1; i <= 17; i++) {
                document.getElementById('itemHeading' + i).value = '';
                document.getElementById('itemDesc' + i).value = '';
            }
            for(let i = 1; i <= 5; i++) {
                document.getElementById('itemHighlight' + i).value = '';
            }
        }
        
        function viewItem(id) {
            fetch('?ajax=get&id=' + id)
                .then(r => {
                    if(!r.ok) throw new Error('Network response was not ok');
                    return r.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    document.getElementById('itemId').value = data.id;
                    document.getElementById('itemTitle').value = data.title || '';
                    document.getElementById('itemDescription').value = data.description || '';
                    document.getElementById('itemDuration').value = data.duration || '';
                    document.getElementById('itemPersons').value = data.persons || '';
                    document.getElementById('itemPlacesCovered').value = data.places_covered || '';
                    document.getElementById('old_image').value = data.image || '';
                    const imgDiv = document.getElementById('currentImageName');
                    if(data.image) imgDiv.innerHTML = '<small class="text-info">📸 Current: <strong>' + data.image + '</strong></small>';
                    else imgDiv.innerHTML = '';
                    for(let i = 1; i <= 17; i++) {
                        document.getElementById('itemHeading' + i).value = data['itinery_heading_' + i] || '';
                        document.getElementById('itemDesc' + i).value = data['itinery_description_' + i] || '';
                    }
                    for(let i = 1; i <= 5; i++) {
                        document.getElementById('itemHighlight' + i).value = data['highlight_' + i] || '';
                    }
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
