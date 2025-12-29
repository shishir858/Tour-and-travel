<?php
require_once(__DIR__ . '/../includes/config.php');

// Add Rajasthan Tour
function addRajasthanTour($conn, $data, $image) {
    // Insert main tour data
    $stmt = $conn->prepare("INSERT INTO rajasthan_tour (title, image, description, duration, persons, places_covered) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $data['title'], $image, $data['description'], $data['duration'], $data['persons'], $data['places_covered']);
    
    if ($stmt->execute()) {
        $tour_id = $conn->insert_id;
        
        // Insert itineraries (18 days)
        for ($i = 1; $i <= 18; $i++) {
            $heading = $data['itinery_heading_' . $i] ?? '';
            $description = $data['itinery_description_' . $i] ?? '';
            if (!empty($heading) || !empty($description)) {
                $stmt = $conn->prepare("INSERT INTO rajasthan_tour_itineraries (tour_id, day_number, heading, description) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiss", $tour_id, $i, $heading, $description);
                $stmt->execute();
            }
        }
        
        // Insert highlights
        for ($i = 1; $i <= 5; $i++) {
            $highlight = $data['highlight_' . $i] ?? '';
            if (!empty($highlight)) {
                $stmt = $conn->prepare("INSERT INTO rajasthan_tour_highlights (tour_id, highlight_number, text) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $tour_id, $i, $highlight);
                $stmt->execute();
            }
        }
        
        return true;
    }
    return false;
}

// Update Rajasthan Tour
function updateRajasthanTour($conn, $id, $data, $image = null) {
    // Update main tour data
    if ($image) {
        $stmt = $conn->prepare("UPDATE rajasthan_tour SET title=?, image=?, description=?, duration=?, persons=?, places_covered=? WHERE id=?");
        $stmt->bind_param("ssssssi", $data['title'], $image, $data['description'], $data['duration'], $data['persons'], $data['places_covered'], $id);
    } else {
        $stmt = $conn->prepare("UPDATE rajasthan_tour SET title=?, description=?, duration=?, persons=?, places_covered=? WHERE id=?");
        $stmt->bind_param("sssssi", $data['title'], $data['description'], $data['duration'], $data['persons'], $data['places_covered'], $id);
    }
    
    if ($stmt->execute()) {
        // Update or insert itineraries
        for ($i = 1; $i <= 18; $i++) {
            $heading = $data['itinery_heading_' . $i] ?? '';
            $description = $data['itinery_description_' . $i] ?? '';
            
            // Check if exists
            $check = $conn->prepare("SELECT id FROM rajasthan_tour_itineraries WHERE tour_id=? AND day_number=?");
            $check->bind_param("ii", $id, $i);
            $check->execute();
            $result = $check->get_result();
            
            if ($result->num_rows > 0) {
                // Update
                $stmt = $conn->prepare("UPDATE rajasthan_tour_itineraries SET heading=?, description=? WHERE tour_id=? AND day_number=?");
                $stmt->bind_param("ssii", $heading, $description, $id, $i);
                $stmt->execute();
            } else if (!empty($heading) || !empty($description)) {
                // Insert
                $stmt = $conn->prepare("INSERT INTO rajasthan_tour_itineraries (tour_id, day_number, heading, description) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiss", $id, $i, $heading, $description);
                $stmt->execute();
            }
        }
        
        // Update or insert highlights
        for ($i = 1; $i <= 5; $i++) {
            $highlight = $data['highlight_' . $i] ?? '';
            
            // Check if exists
            $check = $conn->prepare("SELECT id FROM rajasthan_tour_highlights WHERE tour_id=? AND highlight_number=?");
            $check->bind_param("ii", $id, $i);
            $check->execute();
            $result = $check->get_result();
            
            if ($result->num_rows > 0) {
                // Update
                $stmt = $conn->prepare("UPDATE rajasthan_tour_highlights SET text=? WHERE tour_id=? AND highlight_number=?");
                $stmt->bind_param("sii", $highlight, $id, $i);
                $stmt->execute();
            } else if (!empty($highlight)) {
                // Insert
                $stmt = $conn->prepare("INSERT INTO rajasthan_tour_highlights (tour_id, highlight_number, text) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $id, $i, $highlight);
                $stmt->execute();
            }
        }
        
        return true;
    }
    return false;
}

// Delete Rajasthan Tour
function deleteRajasthanTour($conn, $id) {
    // Delete itineraries
    $stmt = $conn->prepare("DELETE FROM rajasthan_tour_itineraries WHERE tour_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // Delete highlights
    $stmt = $conn->prepare("DELETE FROM rajasthan_tour_highlights WHERE tour_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // Delete tour
    $stmt = $conn->prepare("DELETE FROM rajasthan_tour WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Get single tour
function getRajasthanTour($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM rajasthan_tour WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $tour = $result->fetch_assoc();
    
    if ($tour) {
        // Get itineraries
        $stmt = $conn->prepare("SELECT * FROM rajasthan_tour_itineraries WHERE tour_id=? ORDER BY day_number");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tour['itineraries'] = $result->fetch_all(MYSQLI_ASSOC);
        
        // Get highlights
        $stmt = $conn->prepare("SELECT * FROM rajasthan_tour_highlights WHERE tour_id=? ORDER BY highlight_number");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tour['highlights'] = $result->fetch_all(MYSQLI_ASSOC);
    }
    
    return $tour;
}

// Get all tours
function getAllRajasthanTours($conn) {
    $result = $conn->query("SELECT * FROM rajasthan_tour ORDER BY id DESC");
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
