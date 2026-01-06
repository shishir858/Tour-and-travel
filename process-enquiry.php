<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/config.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $phone = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');
        $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
        $package_id = intval($_POST['package_id'] ?? 0);
        $travel_date = mysqli_real_escape_string($conn, $_POST['travel_date'] ?? '');
        $people = mysqli_real_escape_string($conn, $_POST['people'] ?? '1');
        
        // Validation - name and phone both required
        if(empty($name)) {
            echo json_encode(['success' => false, 'message' => 'Please enter your name.']);
            exit;
        }
        
        if(empty($phone)) {
            echo json_encode(['success' => false, 'message' => 'Please enter your phone number.']);
            exit;
        }
        
        // Use provided name
        $customer_name = $name;
        
        // If package not selected, use default message
        $package_title = 'General Enquiry';
        if($package_id > 0) {
            $package_result = $conn->query("SELECT title FROM tour_packages WHERE id = $package_id");
            if($package_result && $package_result->num_rows > 0) {
                $package = $package_result->fetch_assoc();
                $package_title = $package['title'];
            }
        }
        
        // Use default date if not provided
        if(empty($travel_date)) {
            $travel_date = date('Y-m-d', strtotime('+7 days')); // Default to 7 days from now
        }
        
        // Check if customer exists with phone number
        $check_customer = $conn->query("SELECT id, name, email FROM customers WHERE phone = '$phone' LIMIT 1");
        
        if($check_customer && $check_customer->num_rows > 0) {
            // Customer exists - update name if provided
            $customer = $check_customer->fetch_assoc();
            $customer_id = $customer['id'];
            
            // Update name if new name is provided and current is 'Guest'
            if(!empty($name) && $customer['name'] == 'Guest') {
                $conn->query("UPDATE customers SET name = '$customer_name' WHERE id = $customer_id");
            }
        } else {
            // Create new customer with unique email based on phone
            $guest_email = 'guest_' . $phone . '@example.com';
            $insert_customer = "INSERT INTO customers (name, email, phone, created_at) 
                               VALUES ('$customer_name', '$guest_email', '$phone', NOW())";
            if(!$conn->query($insert_customer)) {
                echo json_encode(['success' => false, 'message' => 'Database Error: Unable to save customer details.']);
                exit;
            }
            $customer_id = $conn->insert_id;
        }
        
        // Generate unique booking number
        $booking_number = 'ENQ' . date('Ymd') . str_pad($customer_id, 4, '0', STR_PAD_LEFT) . rand(100, 999);
        
        // Create message
        $message = "Quick Enquiry - Name: $customer_name | Phone: $phone";
        if(!empty($people)) {
            $message .= " | Guests: $people";
        }
        if($package_id > 0) {
            $message .= " | Package: $package_title";
        }
        
        // Insert into bookings table (use package_id = 1 if not selected)
        $final_package_id = $package_id > 0 ? $package_id : 1;
        
        $insert_query = "INSERT INTO bookings (
            booking_number,
            customer_id, 
            package_id, 
            travel_date,
            number_of_persons,
            number_of_days,
            total_price,
            final_price,
            booking_status,
            special_requests,
            created_at
        ) VALUES (
            '$booking_number',
            $customer_id, 
            $final_package_id, 
            '$travel_date',
            " . intval($people) . ",
            1,
            0.00,
            0.00,
            'pending',
            '$message', 
            NOW()
        )";
        
        if(!$conn->query($insert_query)) {
            echo json_encode(['success' => false, 'message' => 'Database Error: Unable to save enquiry.']);
            exit;
        }
        
        // Enquiry saved successfully
        $enquiry_id = $conn->insert_id;
        
        // Send email notification
        require_once 'send-mail.php';
        sendEnquiryEmail([
            'booking_number' => $booking_number,
            'name' => $customer_name,
            'phone' => $phone,
            'package_title' => $package_title,
            'travel_date' => $travel_date,
            'people' => $people
        ]);
        
        // Return JSON
        echo json_encode([
            'success' => true,
            'message' => 'Thank you! Your enquiry has been submitted successfully.',
            'booking_number' => $booking_number
        ]);
        exit;
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        exit;
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}
?>
