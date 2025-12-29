<?php
require_once(__DIR__ . '/../includes/config.php');

// Add Meta Tag
function addMetaTag($conn, $data) {
    $stmt = $conn->prepare("INSERT INTO meta_tags (page_name, meta_title, meta_description, meta_keywords) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $data['page_name'], $data['meta_title'], $data['meta_description'], $data['meta_keywords']);
    return $stmt->execute();
}

// Update Meta Tag
function updateMetaTag($conn, $id, $data) {
    $stmt = $conn->prepare("UPDATE meta_tags SET page_name=?, meta_title=?, meta_description=?, meta_keywords=? WHERE id=?");
    $stmt->bind_param("ssssi", $data['page_name'], $data['meta_title'], $data['meta_description'], $data['meta_keywords'], $id);
    return $stmt->execute();
}

// Delete Meta Tag
function deleteMetaTag($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM meta_tags WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Get single Meta Tag
function getMetaTag($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM meta_tags WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Get all Meta Tags
function getAllMetaTags($conn) {
    $result = $conn->query("SELECT * FROM meta_tags ORDER BY id DESC");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Get Meta Tag by page name
function getMetaTagByPage($conn, $page_name) {
    $stmt = $conn->prepare("SELECT * FROM meta_tags WHERE page_name=?");
    $stmt->bind_param("s", $page_name);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>
