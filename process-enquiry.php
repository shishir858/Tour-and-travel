<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/config.php';

// Check if PHPMailer exists
$phpmailer_exists = file_exists('vendor/autoload.php');
if($phpmailer_exists) {
    require_once 'vendor/autoload.php';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $phone = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');
        $package_id = intval($_POST['package_id'] ?? 0);
        $travel_date = mysqli_real_escape_string($conn, $_POST['travel_date'] ?? '');
        $people = mysqli_real_escape_string($conn, $_POST['people'] ?? '1');
        
        // Validation
        if(empty($phone) || $package_id == 0 || empty($travel_date)) {
            echo json_encode([
                'success' => false,
                'message' => 'Please fill all required fields.'
            ]);
            exit;
        }
        
        // Get package details
        $package_result = $conn->query("SELECT title FROM tour_packages WHERE id = $package_id");
        if($package_result->num_rows == 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid package selected.'
            ]);
            exit;
        }
        $package = $package_result->fetch_assoc();
        $package_title = $package['title'];
        
        // Check if customer exists with phone number
        $check_customer = $conn->query("SELECT id, name, email FROM customers WHERE phone = '$phone' LIMIT 1");
        
        if($check_customer && $check_customer->num_rows > 0) {
            // Customer exists
            $customer = $check_customer->fetch_assoc();
            $customer_id = $customer['id'];
            $customer_name = $customer['name'];
            $customer_email = $customer['email'];
        } else {
            // Create new customer with minimal info
            $insert_customer = "INSERT INTO customers (name, email, phone, created_at) 
                               VALUES ('Guest', 'guest@example.com', '$phone', NOW())";
            if(!$conn->query($insert_customer)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Database Error: Unable to save customer details.',
                    'error' => $conn->error
                ]);
                exit;
            }
            $customer_id = $conn->insert_id;
            $customer_name = 'Guest';
            $customer_email = 'guest@example.com';
        }
        
        // Generate unique booking number
        $booking_number = 'ENQ' . date('Ymd') . str_pad($customer_id, 4, '0', STR_PAD_LEFT) . rand(100, 999);
        
        // Create message
        $message = "Quick Enquiry from Hero Form - Guests: $people";
        
        // Insert into bookings table
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
            $package_id, 
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
            echo json_encode([
                'success' => false,
                'message' => 'Database Error: Unable to save enquiry.',
                'error' => $conn->error
            ]);
            exit;
        }
        
        // Enquiry saved successfully
        $enquiry_id = $conn->insert_id;
        $email_sent = false;
        
        // Send email notification
        if($phpmailer_exists) {
            try {
                $mail = new PHPMailer(true);
                
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'touristdriversindiapvttours@gmail.com';
                $mail->Password = 'your-app-password-here';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->SMTPDebug = 0;
                
                $mail->setFrom('touristdriversindiapvttours@gmail.com', 'Tourist Drivers India');
                $mail->addAddress('touristdriversindiapvttours@gmail.com');
                $mail->addReplyTo('noreply@touristdriversindia.com', 'Tourist Drivers India');
                
                $mail->isHTML(true);
                $mail->Subject = "New Quick Enquiry - $package_title (Enquiry #$enquiry_id)";
                
                $mail->Body = "
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                        .header { background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); padding: 20px; text-align: center; color: white; }
                        .content { padding: 30px; background: #f9f9f9; }
                        .info-table { width: 100%; background: white; border-collapse: collapse; margin: 20px 0; }
                        .info-table td { padding: 12px; border: 1px solid #ddd; }
                        .info-table td:first-child { background: #f5f5f5; font-weight: bold; width: 40%; }
                    </style>
                </head>
                <body>
                    <div class='header'>
                        <h2>🎉 New Quick Enquiry from Hero Form!</h2>
                    </div>
                    <div class='content'>
                        <h3>Enquiry Details</h3>
                        <table class='info-table'>
                            <tr>
                                <td>Enquiry ID</td>
                                <td>#$enquiry_id</td>
                            </tr>
                            <tr>
                                <td>Booking Number</td>
                                <td><strong>$booking_number</strong></td>
                            </tr>
                            <tr>
                                <td>Package</td>
                                <td><strong>$package_title</strong></td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td><a href='tel:$phone'>$phone</a></td>
                            </tr>
                            <tr>
                                <td>Travel Date</td>
                                <td>" . date('d M, Y', strtotime($travel_date)) . "</td>
                            </tr>
                            <tr>
                                <td>Number of People</td>
                                <td>$people</td>
                            </tr>
                            <tr>
                                <td>Enquiry Type</td>
                                <td>Quick Enquiry (Hero Form)</td>
                            </tr>
                            <tr>
                                <td>Enquiry Date</td>
                                <td>" . date('d M, Y h:i A') . "</td>
                            </tr>
                        </table>
                        
                        <p style='margin-top: 30px;'>
                            <a href='" . SITE_URL . "admin/bookings/' style='display: inline-block; padding: 12px 30px; background: #FF6B35; color: white; text-decoration: none; border-radius: 5px;'>
                                View in Admin Panel
                            </a>
                        </p>
                        
                        <p style='margin-top: 20px; color: #666; font-size: 0.9rem;'>
                            <strong>Note:</strong> This is a quick enquiry. Please contact the customer to get their name and email details.
                        </p>
                    </div>
                </body>
                </html>
                ";
                
                $mail->send();
                $email_sent = true;
                
            } catch (Exception $e) {
                $email_sent = false;
            }
        }
        
        // Return success response
        if($email_sent) {
            echo json_encode([
                'success' => true,
                'message' => '✅ Thank you! Your enquiry has been submitted successfully. We will contact you shortly.',
                'enquiry_id' => $enquiry_id,
                'database' => 'saved',
                'email' => 'sent'
            ]);
        } else {
            echo json_encode([
                'success' => true,
                'message' => '✅ Thank you! Your enquiry has been submitted successfully. We will contact you shortly.',
                'enquiry_id' => $enquiry_id,
                'database' => 'saved',
                'email' => 'failed'
            ]);
        }
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => '❌ Error: ' . $e->getMessage()
        ]);
    }
    
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
}
?>
