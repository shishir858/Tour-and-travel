<?php
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
        $package_title = mysqli_real_escape_string($conn, $_POST['package_title'] ?? '');
        $travel_date = mysqli_real_escape_string($conn, $_POST['travel_date'] ?? '');
        $guests = intval($_POST['guests'] ?? 1);
        $message = mysqli_real_escape_string($conn, $_POST['message'] ?? '');
        
        // Create full message with travel details
        $full_message = "Travel Date: $travel_date | Guests: $guests";
        if(!empty($message)) {
            $full_message .= " | Message: " . $message;
        }
    
        // First, check if customer exists or create new
        $check_customer = $conn->query("SELECT id FROM customers WHERE email = '$email' LIMIT 1");
        
        if($check_customer && $check_customer->num_rows > 0) {
            // Customer exists
            $customer = $check_customer->fetch_assoc();
            $customer_id = $customer['id'];
        } else {
            // Create new customer
            $insert_customer = "INSERT INTO customers (name, email, phone, created_at) 
                               VALUES ('$name', '$email', '$phone', NOW())";
            if(!$conn->query($insert_customer)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Database Error: Unable to save customer details.',
                    'error' => $conn->error
                ]);
                exit;
            }
            $customer_id = $conn->insert_id;
        }
        
        // Generate unique booking number
        $booking_number = 'BK' . date('Ymd') . str_pad($customer_id, 4, '0', STR_PAD_LEFT) . rand(100, 999);
        
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
            $guests,
            1,
            0.00,
            0.00,
            'pending',
            '$full_message', 
            NOW()
        )";
        
        if(!$conn->query($insert_query)) {
            // Database insert FAILED
            echo json_encode([
                'success' => false,
                'message' => 'Database Error: Unable to save your booking. Please try again.',
                'error' => $conn->error
            ]);
            exit;
        }
        
        // Database insert SUCCESSFUL
        $booking_id = $conn->insert_id;
        
        // Send email notification
        require_once 'send-mail.php';
        sendBookingEmail([
            'booking_number' => $booking_number,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'package_title' => $package_title,
            'travel_date' => $travel_date,
            'guests' => $guests,
            'message' => !empty($message) ? $message : 'No special requirements'
        ]);
        
        // Return success response with booking number
        echo json_encode([
            'success' => true,
            'message' => 'Thank you! Your booking request has been submitted successfully.',
            'booking_id' => $booking_id,
            'booking_number' => $booking_number
        ]);
        exit;
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => '❌ Error: ' . $e->getMessage()
        ]);
        exit;
    }
    
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit;
}
?>
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
        
        // Now try to send email
        if($phpmailer_exists) {
            try {
                $mail = new PHPMailer(true);
                
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'touristdriversindiapvttours@gmail.com';
                $mail->Password = 'your-app-password-here'; // Replace with App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->SMTPDebug = 0;
                
                // Recipients
                $mail->setFrom('touristdriversindiapvttours@gmail.com', 'Tourist Drivers India');
                $mail->addAddress('touristdriversindiapvttours@gmail.com');
                $mail->addReplyTo($email, $name);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = "New Booking Request - $package_title (Booking #$booking_id)";
            
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
                    .footer { padding: 20px; text-align: center; background: #333; color: white; font-size: 0.9rem; }
                </style>
            </head>
            <body>
                <div class='header'>
                    <h2>🎉 New Booking Request Received!</h2>
                </div>
                <div class='content'>
                    <h3>Booking Details</h3>
                    <table class='info-table'>
                        <tr>
                            <td>Booking ID</td>
                            <td>#$booking_id</td>
                        </tr>
                        <tr>
                            <td>Package</td>
                            <td><strong>$package_title</strong></td>
                        </tr>
                        <tr>
                            <td>Customer Name</td>
                            <td>$name</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><a href='mailto:$email'>$email</a></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><a href='tel:$phone'>$phone</a></td>
                        </tr>
                        <tr>
                            <td>Travel Date</td>
                            <td>" . date('d M, Y', strtotime($travel_date)) . "</td>
                        </tr>
                        <tr>
                            <td>Number of Guests</td>
                            <td>$guests</td>
                        </tr>
                        <tr>
                            <td>Special Requirements</td>
                            <td>" . nl2br(htmlspecialchars($message)) . "</td>
                        </tr>
                        <tr>
                            <td>Booking Date</td>
                            <td>" . date('d M, Y h:i A') . "</td>
                        </tr>
                    </table>
                    
                    <p style='margin-top: 30px;'>
                        <a href='" . SITE_URL . "admin/dashboard.php' style='display: inline-block; padding: 12px 30px; background: #FF6B35; color: white; text-decoration: none; border-radius: 5px;'>
                            View in Admin Panel
                        </a>
                    </p>
                </div>
                <div class='footer'>
                    <p>Tourist Drivers India Private Tours<br>
                    This is an automated email. Please do not reply directly to this message.</p>
                </div>
            </body>
            </html>
            ";
            
            $mail->AltBody = "New Booking Request\n\nBooking ID: #$booking_id\nPackage: $package_title\nName: $name\nEmail: $email\nPhone: $phone\nTravel Date: $travel_date\nGuests: $guests\nMessage: $message";
            
            $mail->send();
            
            // Send confirmation email to customer
            $customerMail = new PHPMailer(true);
            $customerMail->isSMTP();
            $customerMail->Host = 'smtp.gmail.com';
            $customerMail->SMTPAuth = true;
            $customerMail->Username = 'touristdriversindiapvttours@gmail.com';
            $customerMail->Password = 'your-app-password-here';
            $customerMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $customerMail->Port = 587;
            
            $customerMail->setFrom('touristdriversindiapvttours@gmail.com', 'Tourist Drivers India');
            $customerMail->addAddress($email, $name);
            
            $customerMail->isHTML(true);
            $customerMail->Subject = "Booking Confirmation - $package_title";
            
            $customerMail->Body = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .header { background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); padding: 20px; text-align: center; color: white; }
                    .content { padding: 30px; }
                    .footer { padding: 20px; text-align: center; background: #f5f5f5; }
                </style>
            </head>
            <body>
                <div class='header'>
                    <h2>✅ Booking Request Received!</h2>
                </div>
                <div class='content'>
                    <p>Dear $name,</p>
                    
                    <p>Thank you for your interest in <strong>$package_title</strong>!</p>
                    
                    <p>We have received your booking request (Booking ID: <strong>#$booking_id</strong>) and our team will get back to you within 24 hours with detailed information and pricing.</p>
                    
                    <h3>Your Booking Details:</h3>
                    <ul>
                        <li><strong>Package:</strong> $package_title</li>
                        <li><strong>Travel Date:</strong> " . date('d M, Y', strtotime($travel_date)) . "</li>
                        <li><strong>Number of Guests:</strong> $guests</li>
                    </ul>
                    
                    <p>If you have any urgent queries, please feel free to contact us:</p>
                    <p>
                        📞 Phone: <a href='tel:" . getSetting('site_phone') . "'>" . getSetting('site_phone') . "</a><br>
                        📧 Email: <a href='mailto:touristdriversindiapvttours@gmail.com'>touristdriversindiapvttours@gmail.com</a>
                    </p>
                    
                    <p>We look forward to making your journey memorable!</p>
                    
                    <p>Best regards,<br>
                    <strong>Tourist Drivers India Team</strong></p>
                </div>
                <div class='footer'>
                    <p>Tourist Drivers India Private Tours</p>
                </div>
            </body>
            </html>
            ";
            
            $customerMail->send();
            $email_sent = true;
            
            } catch (Exception $e) {
                // Email sending failed
                $email_sent = false;
                $email_error = $e->getMessage();
            }
        }
        
        // Return success response (database saved successfully)
        if($email_sent) {
            echo json_encode([
                'success' => true,
                'message' => '✅ Booking saved successfully! Email notification sent to admin and confirmation sent to you.',
                'booking_id' => $booking_id,
                'database' => 'saved',
                'email' => 'sent'
            ]);
        } else {
            echo json_encode([
                'success' => true,
                'message' => '✅ Booking saved successfully in database! (Email notification could not be sent, but we have your details)',
                'booking_id' => $booking_id,
                'database' => 'saved',
                'email' => 'failed',
                'email_error' => $email_error
            ]);
        }
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => '❌ Error: ' . $e->getMessage(),
            'database' => 'failed'
        ]);
    }
    
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
}
?>
