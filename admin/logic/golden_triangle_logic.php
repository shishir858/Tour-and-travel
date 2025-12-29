<?php
// Golden Triangle Tours CRUD Logic

function addGoldenTriangleTour($conn, $data, $files) {
    $title = $conn->real_escape_string($data['title']);
    $description = $conn->real_escape_string($data['description']);
    $duration = $conn->real_escape_string($data['duration']);
    $persons = $conn->real_escape_string($data['persons']);
    $places_covered = $conn->real_escape_string($data['places_covered']);
    
    // Handle image upload
    $image = '';
    if(isset($files['image']) && $files['image']['error'] == 0) {
        $upload_dir = '../assets/img/packages/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($files['image']['name'], PATHINFO_EXTENSION));
        $new_filename = 'golden_triangle_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
        $target_file = $upload_dir . $new_filename;
        if(move_uploaded_file($files['image']['tmp_name'], $target_file)) {
            $image = 'assets/img/packages/' . $new_filename;
        }
    }
    
    // Build itinerary fields and highlights
    $cols = "title, image, description, duration, persons, places_covered";
    $vals = "'$title', '$image', '$description', '$duration', '$persons', '$places_covered'";
    
    for($i = 1; $i <= 17; $i++) {
        $heading = isset($data["itinery_heading_$i"]) ? $conn->real_escape_string($data["itinery_heading_$i"]) : '';
        $desc = isset($data["itinery_description_$i"]) ? $conn->real_escape_string($data["itinery_description_$i"]) : '';
        $cols .= ", itinery_heading_$i, itinery_description_$i";
        $vals .= ", '$heading', '$desc'";
    }
    
    for($i = 1; $i <= 5; $i++) {
        $highlight = isset($data["highlight_$i"]) ? $conn->real_escape_string($data["highlight_$i"]) : '';
        $cols .= ", highlight_$i";
        $vals .= ", '$highlight'";
    }
    
    $sql = "INSERT INTO golden_triangle ($cols) VALUES ($vals)";
    return $conn->query($sql);
}

function updateGoldenTriangleTour($conn, $id, $data, $files) {
    $title = $conn->real_escape_string($data['title']);
    $description = $conn->real_escape_string($data['description']);
    $duration = $conn->real_escape_string($data['duration']);
    $persons = $conn->real_escape_string($data['persons']);
    $places_covered = $conn->real_escape_string($data['places_covered']);
    
    // Handle image upload
    $image = '';
    if(isset($files['image']) && $files['image']['error'] == 0) {
        $upload_dir = '../assets/img/packages/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($files['image']['name'], PATHINFO_EXTENSION));
        $new_filename = 'golden_triangle_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
        $target_file = $upload_dir . $new_filename;
        if(move_uploaded_file($files['image']['tmp_name'], $target_file)) {
            $image = 'assets/img/packages/' . $new_filename;
        }
    } else {
        $result = $conn->query("SELECT image FROM golden_triangle WHERE id=$id");
        if($row = $result->fetch_assoc()) {
            $image = $row['image'];
        }
    }
    
    $sql = "UPDATE golden_triangle SET title='$title', image='$image', description='$description', 
            duration='$duration', persons='$persons', places_covered='$places_covered'";
    
    for($i = 1; $i <= 17; $i++) {
        $heading = isset($data["itinery_heading_$i"]) ? $conn->real_escape_string($data["itinery_heading_$i"]) : '';
        $desc = isset($data["itinery_description_$i"]) ? $conn->real_escape_string($data["itinery_description_$i"]) : '';
        $sql .= ", itinery_heading_$i='$heading', itinery_description_$i='$desc'";
    }
    
    for($i = 1; $i <= 5; $i++) {
        $highlight = isset($data["highlight_$i"]) ? $conn->real_escape_string($data["highlight_$i"]) : '';
        $sql .= ", highlight_$i='$highlight'";
    }
    
    $sql .= " WHERE id=$id";
    return $conn->query($sql);
}

function deleteGoldenTriangleTour($conn, $id) {
    return $conn->query("DELETE FROM golden_triangle WHERE id = $id");
}

function getGoldenTriangleTour($conn, $id) {
    $result = $conn->query("SELECT * FROM golden_triangle WHERE id = $id");
    return $result->fetch_assoc();
}

function getAllGoldenTriangleTours($conn) {
    return $conn->query("SELECT * FROM golden_triangle ORDER BY id DESC");
}
?>
