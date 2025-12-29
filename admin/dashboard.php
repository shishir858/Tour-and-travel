
<?php
// Dashboard page
include_once(__DIR__.'/includes/config.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
  header('Location: ./');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
  <?php include_once(__DIR__.'/includes/header.php'); ?>
  <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
  
  <main id="main-content">
    <h1 class="page-title">Dashboard Overview</h1>
    
    <div class="row g-4 mb-4">
<?php
// --- Dynamic Dashboard Summary ---
$tables = [
  ['name' => 'users', 'label' => 'Total Users', 'icon' => '👥'],
  ['name' => 'client_reviews', 'label' => 'Client Reviews', 'icon' => '⭐'],
  ['name' => 'gallery', 'label' => 'Gallery Items', 'icon' => '🖼️'],
  ['name' => 'tour_packages', 'label' => 'Tour Packages', 'icon' => '📦'],
];
foreach ($tables as $tbl) {
  $count = 0;
  $result = $conn->query("SELECT COUNT(*) as cnt FROM `{$tbl['name']}`");
  if ($result && $row = $result->fetch_assoc()) {
    $count = $row['cnt'];
  }
  echo '<div class="col-lg-3 col-md-6 mb-4">';
  echo '  <div class="dashboard-card">';
  echo "    <div class='card-icon'>{$tbl['icon']}</div>";
  echo "    <div class='card-value'>{$count}</div>";
  echo "    <div class='card-title'>{$tbl['label']}</div>";
  echo "    <div class='card-description'>Total records</div>";
  echo '  </div>';
  echo '</div>';
}
?>
    </div>
    
    <div class="data-table-wrapper">
      <h2 class="h5 mb-4">Recent Activity</h2>
      <table class="data-table table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Activity</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025-12-29</td>
            <td>Admin logged in</td>
            <td><span class="badge bg-success">Success</span></td>
          </tr>
          <tr>
            <td>2025-12-28</td>
            <td>User added</td>
            <td><span class="badge bg-primary">Completed</span></td>
          </tr>
          <tr>
            <td>2025-12-27</td>
            <td>Gallery updated</td>
            <td><span class="badge bg-info">Info</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
  
  <?php include_once(__DIR__.'/includes/footer.php'); ?>
</body>
</html>
