<?php
// Other Services CRUD Logic

function addOtherService($conn, $data, $files) {
    $category = $conn->real_escape_string($data['category']);
    $package_name = $conn->real_escape_string($data['package_name']);
    $description = $conn->real_escape_string($data['description']);
    
    // Handle image upload
    $package_image = '';
    if(isset($files['package_image']) && $files['package_image']['error'] == 0) {
        $upload_dir = '../assets/img/packages/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($files['package_image']['name'], PATHINFO_EXTENSION));
        $new_filename = 'service_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
        $target_file = $upload_dir . $new_filename;
        if(move_uploaded_file($files['package_image']['tmp_name'], $target_file)) {
            $package_image = 'assets/img/packages/' . $new_filename;
        }
    }
    
    $sql = "INSERT INTO other_services (category, package_name, package_image, description) 
            VALUES ('$category', '$package_name', '$package_image', '$description')";
    return $conn->query($sql);
}

function updateOtherService($conn, $id, $data, $files) {
    $category = $conn->real_escape_string($data['category']);
    $package_name = $conn->real_escape_string($data['package_name']);
    $description = $conn->real_escape_string($data['description']);
    
    // Handle image upload
    $package_image = '';
    if(isset($files['package_image']) && $files['package_image']['error'] == 0) {
        $upload_dir = '../assets/img/packages/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($files['package_image']['name'], PATHINFO_EXTENSION));
        $new_filename = 'service_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
        $target_file = $upload_dir . $new_filename;
        if(move_uploaded_file($files['package_image']['tmp_name'], $target_file)) {
            $package_image = 'assets/img/packages/' . $new_filename;
        }
    } else {
        $result = $conn->query("SELECT package_image FROM other_services WHERE id=$id");
        if($row = $result->fetch_assoc()) {
            $package_image = $row['package_image'];
        }
    }
    
    $sql = "UPDATE other_services SET category='$category', package_name='$package_name', 
            package_image='$package_image', description='$description' WHERE id=$id";
    return $conn->query($sql);
}

function deleteOtherService($conn, $id) {
    return $conn->query("DELETE FROM other_services WHERE id = $id");
}

function getOtherService($conn, $id) {
    $result = $conn->query("SELECT * FROM other_services WHERE id = $id");
    return $result->fetch_assoc();
}

function getAllOtherServices($conn) {
    return $conn->query("SELECT * FROM other_services ORDER BY id DESC");
}
?>
