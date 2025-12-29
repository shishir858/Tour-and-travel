<?php
/**
 * Gallery Upload Handler
 * Handles multiple image uploads for tour galleries
 */

function handleGalleryUpload($files, $table_name, $id = 0) {
    global $conn;
    
    $gallery_images = '';
    
    if(isset($files['gallery_images']) && !empty($files['gallery_images']['name'][0])) {
        $gallery_array = [];
        $upload_dir = __DIR__ . '/../../assets/img/packages/gallery/';
        
        // Create directory if it doesn't exist
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        // Process each uploaded file
        foreach($files['gallery_images']['tmp_name'] as $key => $tmp_name) {
            if($files['gallery_images']['error'][$key] == 0) {
                $file_ext = strtolower(pathinfo($files['gallery_images']['name'][$key], PATHINFO_EXTENSION));
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif'];
                
                if(in_array($file_ext, $allowed_extensions)) {
                    $new_filename = 'gallery_' . $table_name . '_' . time() . '_' . rand(1000,9999) . '.' . $file_ext;
                    $target_file = $upload_dir . $new_filename;
                    
                    if(move_uploaded_file($tmp_name, $target_file)) {
                        $gallery_array[] = 'assets/img/packages/gallery/' . $new_filename;
                    }
                }
            }
        }
        
        $gallery_images = json_encode($gallery_array);
    } elseif($id > 0) {
        // Keep existing gallery images if no new files uploaded
        $result = $conn->query("SELECT gallery_images FROM $table_name WHERE id=$id");
        if($row = $result->fetch_assoc()) {
            $gallery_images = $row['gallery_images'];
        }
    }
    
    return $gallery_images;
}

/**
 * Delete gallery images from filesystem
 */
function deleteGalleryImages($gallery_json) {
    if(!empty($gallery_json)) {
        $images = json_decode($gallery_json, true);
        if(is_array($images)) {
            foreach($images as $img_path) {
                $full_path = __DIR__ . '/../../' . $img_path;
                if(file_exists($full_path)) {
                    unlink($full_path);
                }
            }
        }
    }
}
?>
