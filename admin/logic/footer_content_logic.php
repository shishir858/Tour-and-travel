<?php
// Footer Content CRUD Logic

function addFooterContent($conn, $data) {
    $about_us = $conn->real_escape_string($data['about_us']);
    $branch1 = $conn->real_escape_string($data['branch1']);
    $branch2 = $conn->real_escape_string($data['branch2']);
    $branch3 = $conn->real_escape_string($data['branch3']);
    $mobile1 = $conn->real_escape_string($data['mobile1']);
    $mobile2 = $conn->real_escape_string($data['mobile2']);
    
    $sql = "INSERT INTO footer_content (about_us, branch1, branch2, branch3, mobile1, mobile2) 
            VALUES ('$about_us', '$branch1', '$branch2', '$branch3', '$mobile1', '$mobile2')";
    return $conn->query($sql);
}

function updateFooterContent($conn, $id, $data) {
    $about_us = $conn->real_escape_string($data['about_us']);
    $branch1 = $conn->real_escape_string($data['branch1']);
    $branch2 = $conn->real_escape_string($data['branch2']);
    $branch3 = $conn->real_escape_string($data['branch3']);
    $mobile1 = $conn->real_escape_string($data['mobile1']);
    $mobile2 = $conn->real_escape_string($data['mobile2']);
    
    $sql = "UPDATE footer_content SET about_us='$about_us', branch1='$branch1', branch2='$branch2', 
            branch3='$branch3', mobile1='$mobile1', mobile2='$mobile2' WHERE id=$id";
    return $conn->query($sql);
}

function deleteFooterContent($conn, $id) {
    return $conn->query("DELETE FROM footer_content WHERE id = $id");
}

function getFooterContent($conn, $id) {
    $result = $conn->query("SELECT * FROM footer_content WHERE id = $id");
    return $result->fetch_assoc();
}

function getAllFooterContent($conn) {
    return $conn->query("SELECT * FROM footer_content ORDER BY id DESC");
}
?>
