<?php
// Reviews CRUD Logic
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../');
    exit;
}

// Handle Delete
if (isset($_GET['delete']) && isset($_GET['action']) && $_GET['action'] == 'reviews') {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM client_reviews WHERE id = $id");
    header('Location: ../reviews.php');
    exit;
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'reviews') {
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
    header('Location: ../reviews.php');
    exit;
}
?>
