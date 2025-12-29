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
    $result = $conn->query("SELECT * FROM videos WHERE id = $id");
    if($row = $result->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($row);
        exit;
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM videos WHERE id = $id");
    header('Location: videos.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    // Handle video upload
    if(isset($_FILES['video_file']) && $_FILES['video_file']['error'] == 0) {
        $upload_dir = __DIR__ . '/../assets/img/videos/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $file_ext = strtolower(pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION));
        $new_filename = time() . '_' . rand(1000,9999) . '.' . $file_ext;
        
        if(move_uploaded_file($_FILES['video_file']['tmp_name'], $upload_dir . $new_filename)) {
            $video_url = 'assets/img/videos/' . $new_filename;
            $video_type = $file_ext;
            
            if ($id > 0) {
                $stmt = $conn->prepare("UPDATE videos SET video_url=?, video_type=? WHERE id=?");
                $stmt->bind_param("ssi", $video_url, $video_type, $id);
                $stmt->execute();
            } else {
                $stmt = $conn->prepare("INSERT INTO videos (video_url, video_type) VALUES (?, ?)");
                $stmt->bind_param("ss", $video_url, $video_type);
                $stmt->execute();
            }
            header('Location: videos.php');
            exit;
        }
    } else {
        // Manual URL entry (YouTube or existing path)
        $video_url = $conn->real_escape_string($_POST['video_url']);
        $video_type = $conn->real_escape_string($_POST['video_type']);
        
        if ($id > 0) {
            $conn->query("UPDATE videos SET video_url='$video_url', video_type='$video_type' WHERE id=$id");
        } else {
            $conn->query("INSERT INTO videos (video_url, video_type) VALUES ('$video_url', '$video_type')");
        }
    }
    header('Location: videos.php');
    exit;
}

$videos = $conn->query("SELECT * FROM videos ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Videos</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin-dashboard.css">
</head>
<body>
    <?php include_once(__DIR__.'/includes/header.php'); ?>
    <?php include_once(__DIR__.'/includes/sidebar.php'); ?>
    
    <main id="main-content">
        <h1 class="page-title">Manage Videos</h1>
        
        <div class="dashboard-card mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="resetForm()">Add New Video</button>
        </div>
        
        <div class="data-table-wrapper">
            <table class="data-table table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th style="width: 280px;">Video Preview</th>
                        <th>Video Type</th>
                        <th>Uploaded At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $videos->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td>
                            <?php 
                            $video_url = $row['video_url'];
                            // Check if YouTube URL
                            if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
                                // Extract YouTube video ID
                                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video_url, $matches);
                                $video_id = $matches[1] ?? '';
                                if ($video_id) {
                                    echo '<iframe width="100%" height="140" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
                                } else {
                                    echo '<small class="text-muted">' . htmlspecialchars($video_url) . '</small>';
                                }
                            } else {
                                // Local video - check multiple possible paths
                                $video_src = '';
                                
                                // Try with current stored path
                                if (file_exists(__DIR__ . '/../' . $video_url)) {
                                    $video_src = '/touristdriversindiaprivatetours/' . htmlspecialchars($video_url);
                                }
                                // Try in assets/video folder (old location)
                                else if (strpos($video_url, 'assets/img/videos/') !== false) {
                                    $filename = basename($video_url);
                                    $alt_path = 'assets/video/' . $filename;
                                    if (file_exists(__DIR__ . '/../' . $alt_path)) {
                                        $video_src = '/touristdriversindiaprivatetours/' . htmlspecialchars($alt_path);
                                    }
                                }
                                
                                if ($video_src) {
                                    echo '<video width="100%" height="140" controls style="background: #000;">
                                            <source src="' . $video_src . '" type="video/mp4">
                                            Video not supported
                                          </video>';
                                } else {
                                    echo '<div class="alert alert-warning p-2 m-0"><small>⚠️ Video file not found</small></div>';
                                    echo '<small class="text-muted">' . htmlspecialchars($video_url) . '</small>';
                                }
                            }
                            ?>
                            <div class="mt-1">
                                <small class="text-muted">📁 <?= htmlspecialchars($video_url) ?></small>
                            </div>
                        </td>
                        <td><?= htmlspecialchars($row['video_type']) ?></td>
                        <td><?= $row['uploaded_at'] ?></td>
                        <td>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this video?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    
    <div class="modal fade" id="videoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Video Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="itemId">
                        <div class="mb-3">
                            <label class="form-label">Upload Video File</label>
                            <input type="file" name="video_file" class="form-control" accept="video/*">
                            <small class="text-muted">Upload MP4, WebM, or other video formats</small>
                        </div>
                        <div class="mb-3 text-center">
                            <strong>OR</strong>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Video URL (YouTube or Manual Path)</label>
                            <input type="text" name="video_url" id="itemVideoUrl" class="form-control" placeholder="https://youtube.com/... or assets/video/file.mp4">
                            <small class="text-muted">Enter YouTube URL or existing file path</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Video Type</label>
                            <input type="text" name="video_type" id="itemVideoType" class="form-control" placeholder="mp4, youtube, webm, etc.">
                            <small class="text-muted">Optional: Specify video type</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Video</button>
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
            document.getElementById('itemVideoUrl').value = '';
            document.getElementById('itemVideoType').value = '';
        }
    </script>
</body>
</html>
