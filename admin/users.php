<?php
session_start();
include_once(__DIR__.'/includes/config.php');
if (!isset($_SESSION['admin_id'])) {
    header('Location: ./');
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM users WHERE id = $id");
    header('Location: users.php');
    exit;
}

// Include logic handler
include_once(__DIR__.'/logic/users_logic.php');

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    if ($id > 0) {
        // Update
        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $conn->query("UPDATE users SET email='$email', password='$hashed' WHERE id=$id");
        } else {
            $conn->query("UPDATE users SET email='$email' WHERE id=$id");
        }
    } else {
        // Insert
        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $conn->query("INSERT INTO users (email, password) VALUES ('$email', '$hashed')");
        }
    }
    header('Location: users.php');
    exit;
}

$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
    <?php include_once(__DIR__.'/includes/header.php'); ?>
    <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
    
    <main id="main-content">
        <h1 class="page-title">Manage Users</h1>
        
        <div class="dashboard-card mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" onclick="resetForm()">Add New User</button>
        </div>
        
        <div class="data-table-wrapper">
            <table class="data-table table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $users->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editUser(<?= $row['id'] ?>, '<?= htmlspecialchars($row['email']) ?>')">Edit</button>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    
    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">User Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="userId">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="userEmail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" id="userPassword" class="form-control">
                            <small class="text-muted">Leave empty to keep existing password (when editing)</small>
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
    <script src="assets/bootstrap/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function resetForm() {
            document.getElementById('userId').value = '';
            document.getElementById('userEmail').value = '';
            document.getElementById('userPassword').value = '';
        }
        function editUser(id, email) {
            document.getElementById('userId').value = id;
            document.getElementById('userEmail').value = email;
            new bootstrap.Modal(document.getElementById('userModal')).show();
        }
    </script>
</body>
</html>
