<?php
// Cars CRUD Logic

function addCar($conn, $data, $files) {
    $car_name = $conn->real_escape_string($data['car_name']);
    $car_type = $conn->real_escape_string($data['car_type']);
    $start_price = $conn->real_escape_string($data['start_price']);
    $min_running = $conn->real_escape_string($data['min_running']);
    $passengers = $conn->real_escape_string($data['passengers']);
    $whatsapp_link = $conn->real_escape_string($data['whatsapp_link']);
    
    // Handle image upload
    $image_url = '';
    if(isset($files['image_url']) && $files['image_url']['error'] == 0) {
        $upload_dir = '../assets/vehicles/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($files['image_url']['name'], PATHINFO_EXTENSION));
        $new_filename = 'car_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
        $target_file = $upload_dir . $new_filename;
        if(move_uploaded_file($files['image_url']['tmp_name'], $target_file)) {
            $image_url = 'assets/vehicles/' . $new_filename;
        }
    }
    
    $sql = "INSERT INTO cars (car_name, car_type, start_price, min_running, passengers, image_url, whatsapp_link) 
            VALUES ('$car_name', '$car_type', '$start_price', '$min_running', '$passengers', '$image_url', '$whatsapp_link')";
    return $conn->query($sql);
}

function updateCar($conn, $id, $data, $files) {
    $car_name = $conn->real_escape_string($data['car_name']);
    $car_type = $conn->real_escape_string($data['car_type']);
    $start_price = $conn->real_escape_string($data['start_price']);
    $min_running = $conn->real_escape_string($data['min_running']);
    $passengers = $conn->real_escape_string($data['passengers']);
    $whatsapp_link = $conn->real_escape_string($data['whatsapp_link']);
    
    // Handle image upload
    $image_url = '';
    if(isset($files['image_url']) && $files['image_url']['error'] == 0) {
        $upload_dir = '../assets/vehicles/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($files['image_url']['name'], PATHINFO_EXTENSION));
        $new_filename = 'car_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
        $target_file = $upload_dir . $new_filename;
        if(move_uploaded_file($files['image_url']['tmp_name'], $target_file)) {
            $image_url = 'assets/vehicles/' . $new_filename;
        }
    } else {
        $result = $conn->query("SELECT image_url FROM cars WHERE id=$id");
        if($row = $result->fetch_assoc()) {
            $image_url = $row['image_url'];
        }
    }
    
    $sql = "UPDATE cars SET car_name='$car_name', car_type='$car_type', start_price='$start_price', 
            min_running='$min_running', passengers='$passengers', image_url='$image_url', whatsapp_link='$whatsapp_link' 
            WHERE id=$id";
    return $conn->query($sql);
}

function deleteCar($conn, $id) {
    return $conn->query("DELETE FROM cars WHERE id = $id");
}

function getCar($conn, $id) {
    $result = $conn->query("SELECT * FROM cars WHERE id = $id");
    return $result->fetch_assoc();
}

function getAllCars($conn) {
    return $conn->query("SELECT * FROM cars ORDER BY id DESC");
}
?>
