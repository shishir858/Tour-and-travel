

<?php
// Always include all PHP includes at the very top to avoid headers already sent/session errors
include('connection.php');
include('auth.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $meta_title = trim($_POST['meta_title']);
    $meta_description = trim($_POST['meta_description']);
    $page = trim($_POST['page']);
    if ($meta_title && $meta_description && $page) {
        // Insert or update meta tags for the page
        $stmt = $conn->prepare("REPLACE INTO meta_tags (page, meta_title, meta_description) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $page, $meta_title, $meta_description);
        $stmt->execute();
        $success = true;
    } else {
        $error = 'All fields are required.';
    }
}
// Fetch all meta tags for display
$meta_tags = $conn->query("SELECT * FROM meta_tags ORDER BY page ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Meta Tags</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>
<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php include('aside.php'); ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <!-- You can include a header here if needed -->
            <!--  Header End -->
            <div class="container-fluid mt-4">
    <h2>Add/Edit Meta Title & Description</h2>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success">Meta tags saved successfully!</div>
    <?php elseif (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" class="mb-4">
        <div class="mb-3">
            <label for="page" class="form-label">Page Slug (e.g. about.php)</label>
            <input type="text" name="page" id="page" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Title</label>
            <input type="text" name="meta_title" id="meta_title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <textarea name="meta_description" id="meta_description" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Meta Tags</button>
    </form>
    <h4>Existing Meta Tags</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Page</th>
                <th>Meta Title</th>
                <th>Meta Description</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $meta_tags->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['page']) ?></td>
                <td><?= htmlspecialchars($row['meta_title']) ?></td>
                <td><?= htmlspecialchars($row['meta_description']) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</html>
