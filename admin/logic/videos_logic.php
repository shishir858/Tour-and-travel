<?php
// Videos CRUD Logic

function addVideo($conn, $data) {
    $video_url = $conn->real_escape_string($data['video_url']);
    $video_type = $conn->real_escape_string($data['video_type']);
    
    $sql = "INSERT INTO videos (video_url, video_type) VALUES ('$video_url', '$video_type')";
    return $conn->query($sql);
}

function updateVideo($conn, $id, $data) {
    $video_url = $conn->real_escape_string($data['video_url']);
    $video_type = $conn->real_escape_string($data['video_type']);
    
    $sql = "UPDATE videos SET video_url='$video_url', video_type='$video_type' WHERE id=$id";
    return $conn->query($sql);
}

function deleteVideo($conn, $id) {
    return $conn->query("DELETE FROM videos WHERE id = $id");
}

function getVideo($conn, $id) {
    $result = $conn->query("SELECT * FROM videos WHERE id = $id");
    return $result->fetch_assoc();
}

function getAllVideos($conn) {
    return $conn->query("SELECT * FROM videos ORDER BY id DESC");
}
?>
