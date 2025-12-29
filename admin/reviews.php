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
    $result = $conn->query("SELECT * FROM client_reviews WHERE id = $id");
    if($row = $result->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($row);
        exit;
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM client_reviews WHERE id = $id");
    header('Location: reviews.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $client_name = $conn->real_escape_string($_POST['client_name']);
    $profession = $conn->real_escape_string($_POST['profession']);
    $client_location = $conn->real_escape_string($_POST['client_location']);
    $client_rating = isset($_POST['client_rating']) ? intval($_POST['client_rating']) : NULL;
    $client_review = $conn->real_escape_string($_POST['client_review']);
    
    if ($id > 0) {
        $conn->query("UPDATE client_reviews SET client_name='$client_name', profession='$profession', client_location='$client_location', client_rating=$client_rating, client_review='$client_review' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO client_reviews (client_name, profession, client_location, client_rating, client_review) VALUES ('$client_name', '$profession', '$client_location', $client_rating, '$client_review')");
    }
    header('Location: reviews.php');
    exit;
}

$reviews = $conn->query("SELECT * FROM client_reviews ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
    <?php include_once(__DIR__.'/includes/header.php'); ?>
    <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
    
    <main id="main-content">
        <h1 class="page-title">Manage Client Reviews</h1>
        
        <div class="dashboard-card mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" onclick="resetForm()">Add New Review</button>
        </div>
        
        <div class="data-table-wrapper">
            <table class="data-table table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Profession</th>
                        <th>Location</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $reviews->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['client_name']) ?></td>
                        <td><?= htmlspecialchars($row['profession']) ?></td>
                        <td><?= htmlspecialchars($row['client_location']) ?></td>
                        <td><?= $row['client_rating'] ?> ⭐</td>
                        <td><?= substr(htmlspecialchars($row['client_review']), 0, 50) ?>...</td>
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
    
    <div class="modal fade" id="reviewModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Review Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="itemId">
                        <div class="mb-3">
                            <label class="form-label">Client Name</label>
                            <input type="text" name="client_name" id="itemClientName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profession</label>
                            <input type="text" name="profession" id="itemProfession" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="client_location" id="itemClientLocation" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select name="client_rating" id="itemClientRating" class="form-control">
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Review</label>
                            <textarea name="client_review" id="itemClientReview" class="form-control" rows="4" required></textarea>
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
            document.getElementById('itemClientName').value = '';
            document.getElementById('itemProfession').value = '';
            document.getElementById('itemClientLocation').value = '';
            document.getElementById('itemClientRating').value = '5';
            document.getElementById('itemClientReview').value = '';
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
                    document.getElementById('itemClientName').value = data.client_name || '';
                    document.getElementById('itemProfession').value = data.profession || '';
                    document.getElementById('itemClientLocation').value = data.client_location || '';
                    document.getElementById('itemClientRating').value = data.client_rating || '5';
                    document.getElementById('itemClientReview').value = data.client_review || '';
                    new bootstrap.Modal(document.getElementById('reviewModal')).show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading data. Please try again.');
                });
        }
    </script>
</body>
</html>
