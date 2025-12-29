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
    $result = $conn->query("SELECT * FROM contact_info WHERE id = $id");
    if($row = $result->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($row);
        exit;
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM contact_info WHERE id = $id");
    header('Location: contact-info.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $address = $conn->real_escape_string($_POST['address']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email1 = $conn->real_escape_string($_POST['email1']);
    $email2 = $conn->real_escape_string($_POST['email2']);
    $facebook = $conn->real_escape_string($_POST['facebook']);
    $instagram = $conn->real_escape_string($_POST['instagram']);
    $pinterest = $conn->real_escape_string($_POST['pinterest']);
    $twitter = $conn->real_escape_string($_POST['twitter']);
    $whatsapp = $conn->real_escape_string($_POST['whatsapp']);
    $logo = $conn->real_escape_string($_POST['logo']);
    
    if ($id > 0) {
        $conn->query("UPDATE contact_info SET address='$address', phone='$phone', email1='$email1', email2='$email2', facebook='$facebook', instagram='$instagram', pinterest='$pinterest', twitter='$twitter', whatsapp='$whatsapp', logo='$logo' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO contact_info (address, phone, email1, email2, facebook, instagram, pinterest, twitter, whatsapp, logo) VALUES ('$address', '$phone', '$email1', '$email2', '$facebook', '$instagram', '$pinterest', '$twitter', '$whatsapp', '$logo')");
    }
    header('Location: contact-info.php');
    exit;
}

$contacts = $conn->query("SELECT * FROM contact_info ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Information</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
    <?php include_once(__DIR__.'/includes/header.php'); ?>
    <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
    
    <main id="main-content">
        <h1 class="page-title">Contact Information</h1>
        
        <div class="dashboard-card mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal" onclick="resetForm()">Add New Contact</button>
        </div>
        
        <div class="data-table-wrapper">
            <table class="data-table table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Phone</th>
                        <th>Email 1</th>
                        <th>Email 2</th>
                        <th>Address</th>
                        <th>Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $contacts->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['email1']) ?></td>
                        <td><?= htmlspecialchars($row['email2']) ?></td>
                        <td><?= substr(htmlspecialchars($row['address']), 0, 30) ?>...</td>
                        <td><?php if(!empty($row['logo'])): ?><img src="<?= htmlspecialchars($row['logo']) ?>" style="width:50px;height:30px;object-fit:contain;"><?php endif; ?></td>
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
    
    <div class="modal fade" id="contactModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Contact Information Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="itemId">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" id="itemPhone" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">WhatsApp</label>
                                <input type="text" name="whatsapp" id="itemWhatsapp" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email 1</label>
                                <input type="email" name="email1" id="itemEmail1" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email 2</label>
                                <input type="email" name="email2" id="itemEmail2" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" id="itemAddress" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Facebook URL</label>
                                <input type="text" name="facebook" id="itemFacebook" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Instagram URL</label>
                                <input type="text" name="instagram" id="itemInstagram" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pinterest URL</label>
                                <input type="text" name="pinterest" id="itemPinterest" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Twitter URL</label>
                                <input type="text" name="twitter" id="itemTwitter" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Logo (Path)</label>
                            <input type="text" name="logo" id="itemLogo" class="form-control" required placeholder="assets/img/logo/logo.png">
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
            document.getElementById('itemPhone').value = '';
            document.getElementById('itemEmail1').value = '';
            document.getElementById('itemEmail2').value = '';
            document.getElementById('itemAddress').value = '';
            document.getElementById('itemFacebook').value = '';
            document.getElementById('itemInstagram').value = '';
            document.getElementById('itemPinterest').value = '';
            document.getElementById('itemTwitter').value = '';
            document.getElementById('itemWhatsapp').value = '';
            document.getElementById('itemLogo').value = '';
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
                    document.getElementById('itemPhone').value = data.phone || '';
                    document.getElementById('itemEmail1').value = data.email1 || '';
                    document.getElementById('itemEmail2').value = data.email2 || '';
                    document.getElementById('itemAddress').value = data.address || '';
                    document.getElementById('itemFacebook').value = data.facebook || '';
                    document.getElementById('itemInstagram').value = data.instagram || '';
                    document.getElementById('itemPinterest').value = data.pinterest || '';
                    document.getElementById('itemTwitter').value = data.twitter || '';
                    document.getElementById('itemWhatsapp').value = data.whatsapp || '';
                    document.getElementById('itemLogo').value = data.logo || '';
                    new bootstrap.Modal(document.getElementById('contactModal')).show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading data. Please try again.');
                });
        }
    </script>
</body>
</html>
