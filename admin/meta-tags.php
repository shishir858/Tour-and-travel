<?php
session_start();
include_once(__DIR__.'/includes/config.php');
if (!isset($_SESSION['admin_id'])) {
    header('Location: ./');
    exit;
}

if (isset($_GET['delete'])) {
    $page = $conn->real_escape_string($_GET['delete']);
    $conn->query("DELETE FROM meta_tags WHERE page = '$page'");
    header('Location: meta-tags.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_page = isset($_POST['old_page']) ? $conn->real_escape_string($_POST['old_page']) : '';
    $page = $conn->real_escape_string($_POST['page']);
    $meta_title = $conn->real_escape_string($_POST['meta_title']);
    $meta_description = $conn->real_escape_string($_POST['meta_description']);
    
    if (!empty($old_page)) {
        // Update: delete old and insert new (since page is primary key)
        $conn->query("DELETE FROM meta_tags WHERE page = '$old_page'");
        $conn->query("INSERT INTO meta_tags (page, meta_title, meta_description) VALUES ('$page', '$meta_title', '$meta_description')");
    } else {
        // Insert new
        $conn->query("INSERT INTO meta_tags (page, meta_title, meta_description) VALUES ('$page', '$meta_title', '$meta_description')");
    }
    header('Location: meta-tags.php');
    exit;
}

$meta = $conn->query("SELECT * FROM meta_tags ORDER BY page ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meta Tags</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
    <?php include_once(__DIR__.'/includes/header.php'); ?>
    <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
    
    <main id="main-content">
        <h1 class="page-title">Meta Tags</h1>
        
        <div class="dashboard-card mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#metaModal" onclick="resetForm()">Add New Meta Tag</button>
        </div>
        
        <div class="data-table-wrapper">
            <table class="data-table table table-striped">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Meta Title</th>
                        <th>Meta Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $meta->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['page']) ?></td>
                        <td><?= htmlspecialchars($row['meta_title']) ?></td>
                        <td><?= substr(htmlspecialchars($row['meta_description']), 0, 50) ?>...</td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editItem('<?= htmlspecialchars($row['page']) ?>')">Edit</button>
                            <a href="?delete=<?= urlencode($row['page']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    
    <div class="modal fade" id="metaModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Meta Tags Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="old_page" id="oldPage">
                        <div class="mb-3">
                            <label class="form-label">Page Name (Primary Key)</label>
                            <input type="text" name="page" id="itemPage" class="form-control" required placeholder="e.g., home, about, contact">
                            <small class="text-muted">This is the unique identifier for the page. Cannot be changed after creation.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" id="itemMetaTitle" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" id="itemMetaDescription" class="form-control" rows="3" required></textarea>
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
            document.getElementById('oldPage').value = '';
            document.getElementById('itemPage').value = '';
            document.getElementById('itemPage').readOnly = false;
            document.getElementById('itemMetaTitle').value = '';
            document.getElementById('itemMetaDescription').value = '';
        }
        function editItem(page) {
            fetch('?ajax=get&page=' + encodeURIComponent(page))
                .then(r => r.json())
                .then(data => {
                    document.getElementById('oldPage').value = data.page;
                    document.getElementById('itemPage').value = data.page;
                    document.getElementById('itemPage').readOnly = true; // Prevent changing primary key
                    document.getElementById('itemMetaTitle').value = data.meta_title;
                    document.getElementById('itemMetaDescription').value = data.meta_description;
                    new bootstrap.Modal(document.getElementById('metaModal')).show();
                });
        }
        
        <?php
        if(isset($_GET['ajax']) && $_GET['ajax'] == 'get' && isset($_GET['page'])) {
            $page = $conn->real_escape_string($_GET['page']);
            $result = $conn->query("SELECT * FROM meta_tags WHERE page = '$page'");
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
