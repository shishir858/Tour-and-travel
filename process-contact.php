<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/config.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
        $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
        $phone = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');
        $package_id = intval($_POST['package_id'] ?? 0);
        $message = mysqli_real_escape_string($conn, $_POST['message'] ?? '');
        
        // Validation
        if(empty($name)) {
            echo json_encode(['success' => false, 'message' => 'Please enter your name.']);
            exit;
        }
        
        if(empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Please enter your email.']);
            exit;
        }
        
        if(empty($phone)) {
            echo json_encode(['success' => false, 'message' => 'Please enter your phone number.']);
            exit;
        }
        
        if(empty($message)) {
            echo json_encode(['success' => false, 'message' => 'Please enter your message.']);
            exit;
        }
        
        // Get package title if selected
        $package_title = 'General Inquiry';
        if($package_id > 0) {
            $package_result = $conn->query("SELECT title FROM tour_packages WHERE id = $package_id");
            if($package_result && $package_result->num_rows > 0) {
                $package = $package_result->fetch_assoc();
                $package_title = $package['title'];
            }
        }
        
        // Check if customer exists or create new
        $check_customer = $conn->query("SELECT id FROM customers WHERE email = '$email' LIMIT 1");
        
        if($check_customer && $check_customer->num_rows > 0) {
            $customer = $check_customer->fetch_assoc();
            $customer_id = $customer['id'];
        } else {
            // Create new customer
            $insert_customer = "INSERT INTO customers (name, email, phone, created_at) 
                               VALUES ('$name', '$email', '$phone', NOW())";
            if(!$conn->query($insert_customer)) {
                echo json_encode(['success' => false, 'message' => 'Database Error: Unable to save customer details.']);
                exit;
            }
            $customer_id = $conn->insert_id;
        }
        
        // Generate unique contact reference number
        $contact_number = 'CNT' . date('Ymd') . str_pad($customer_id, 4, '0', STR_PAD_LEFT) . rand(100, 999);
        
        // Create full message with package info
        $full_message = "Contact Form Message";
        if($package_id > 0) {
            $full_message .= " | Package Interest: $package_title";
        }
        $full_message .= " | Message: " . $message;
        
        // Insert into bookings table (using it as contact inquiries)
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
            '$contact_number',
            $customer_id, 
            $final_package_id, 
            CURDATE(),
            1,
            1,
            0.00,
            0.00,
            'pending',
            '$full_message', 
            NOW()
        )";
        
        if(!$conn->query($insert_query)) {
            echo json_encode(['success' => false, 'message' => 'Database Error: Unable to save your message.']);
            exit;
        }
        
        // Contact saved successfully
        $contact_id = $conn->insert_id;
        
        // Send email notification
        require_once 'send-mail.php';
        sendContactEmail([
            'contact_number' => $contact_number,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'package_title' => $package_title,
            'message' => $message
        ]);
        
        // Return JSON
        echo json_encode([
            'success' => true,
            'message' => 'Thank you! Your message has been sent successfully. We will contact you soon.',
            'contact_number' => $contact_number
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
