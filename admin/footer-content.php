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
    $result = $conn->query("SELECT * FROM footer_content WHERE id = $id");
    if($row = $result->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($row);
        exit;
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM footer_content WHERE id = $id");
    header('Location: footer-content.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $about_us = $conn->real_escape_string($_POST['about_us']);
    $branch1 = $conn->real_escape_string($_POST['branch1']);
    $branch2 = $conn->real_escape_string($_POST['branch2']);
    $branch3 = $conn->real_escape_string($_POST['branch3']);
    $mobile1 = $conn->real_escape_string($_POST['mobile1']);
    $mobile2 = $conn->real_escape_string($_POST['mobile2']);
    
    if ($id > 0) {
        $conn->query("UPDATE footer_content SET about_us='$about_us', branch1='$branch1', branch2='$branch2', branch3='$branch3', mobile1='$mobile1', mobile2='$mobile2' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO footer_content (about_us, branch1, branch2, branch3, mobile1, mobile2) VALUES ('$about_us', '$branch1', '$branch2', '$branch3', '$mobile1', '$mobile2')");
    }
    header('Location: footer-content.php');
    exit;
}

$contents = $conn->query("SELECT * FROM footer_content ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Content</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
    <?php include_once(__DIR__.'/includes/header.php'); ?>
    <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
    
    <main id="main-content">
        <h1 class="page-title">Footer Content</h1>
        
        <div class="dashboard-card mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#footerModal" onclick="resetForm()">Add New Content</button>
        </div>
        
        <div class="data-table-wrapper">
            <table class="data-table table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>About Us</th>
                        <th>Branch 1</th>
                        <th>Branch 2</th>
                        <th>Mobile 1</th>
                        <th>Mobile 2</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $contents->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= substr(htmlspecialchars($row['about_us']), 0, 40) ?>...</td>
                        <td><?= substr(htmlspecialchars($row['branch1']), 0, 30) ?>...</td>
                        <td><?= substr(htmlspecialchars($row['branch2']), 0, 30) ?>...</td>
                        <td><?= htmlspecialchars($row['mobile1']) ?></td>
                        <td><?= htmlspecialchars($row['mobile2']) ?></td>
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
    
    <div class="modal fade" id="footerModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Footer Content Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="itemId">
                        <div class="mb-3">
                            <label class="form-label">About Us</label>
                            <textarea name="about_us" id="itemAboutUs" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Branch 1</label>
                            <textarea name="branch1" id="itemBranch1" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Branch 2</label>
                            <textarea name="branch2" id="itemBranch2" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Branch 3</label>
                            <textarea name="branch3" id="itemBranch3" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mobile 1</label>
                                <input type="text" name="mobile1" id="itemMobile1" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mobile 2</label>
                                <input type="text" name="mobile2" id="itemMobile2" class="form-control" required>
                            </div>
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
            document.getElementById('itemAboutUs').value = '';
            document.getElementById('itemBranch1').value = '';
            document.getElementById('itemBranch2').value = '';
            document.getElementById('itemBranch3').value = '';
            document.getElementById('itemMobile1').value = '';
            document.getElementById('itemMobile2').value = '';
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
                    document.getElementById('itemAboutUs').value = data.about_us || '';
                    document.getElementById('itemBranch1').value = data.branch1 || '';
                    document.getElementById('itemBranch2').value = data.branch2 || '';
                    document.getElementById('itemBranch3').value = data.branch3 || '';
                    document.getElementById('itemMobile1').value = data.mobile1 || '';
                    document.getElementById('itemMobile2').value = data.mobile2 || '';
                    new bootstrap.Modal(document.getElementById('footerModal')).show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading data. Please try again.');
                });
        }
    </script>
</body>
</html>
