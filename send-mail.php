<?php
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendBookingEmail($bookingData) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.touristdriversindiaprivatetours.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@touristdriversindiaprivatetours.com';
        $mail->Password = 'SJZpFgA5K27w';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Recipients
        $mail->setFrom('info@touristdriversindiaprivatetours.com', 'Tourist Drivers India');
        $mail->addAddress('touristdriversindiapvttours@gmail.com', 'Tourist Drivers India');
        $mail->addReplyTo($bookingData['email'], $bookingData['name']);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Booking Request - ' . $bookingData['booking_number'];
        
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .header { background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); padding: 20px; text-align: center; color: white; }
                .content { padding: 30px; background: #f9f9fa; }
                .info-table { width: 100%; background: white; border-collapse: collapse; margin: 20px 0; }
                .info-table td { padding: 12px; border: 1px solid #ddd; }
                .info-table td:first-child { background: #f5f5f5; font-weight: bold; width: 40%; }
                .footer { padding: 20px; text-align: center; background: #333; color: white; }
            </style>
        </head>
        <body>
            <div class='header'>
                <h2>🎉 New Booking Request</h2>
            </div>
            <div class='content'>
                <h3>Booking Details</h3>
                <table class='info-table'>
                    <tr>
                        <td>Booking Number</td>
                        <td><strong>{$bookingData['booking_number']}</strong></td>
                    </tr>
                    <tr>
                        <td>Package</td>
                        <td><strong>{$bookingData['package_title']}</strong></td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td>{$bookingData['name']}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><a href='mailto:{$bookingData['email']}'>{$bookingData['email']}</a></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><a href='tel:{$bookingData['phone']}'>{$bookingData['phone']}</a></td>
                    </tr>
                    <tr>
                        <td>Travel Date</td>
                        <td>" . date('d M, Y', strtotime($bookingData['travel_date'])) . "</td>
                    </tr>
                    <tr>
                        <td>Number of Guests</td>
                        <td>{$bookingData['guests']}</td>
                    </tr>
                    <tr>
                        <td>Special Requirements</td>
                        <td>" . nl2br(htmlspecialchars($bookingData['message'])) . "</td>
                    </tr>
                </table>
            </div>
            <div class='footer'>
                <p>Tourist Drivers India Private Tours<br>
                This is an automated notification</p>
            </div>
        </body>
        </html>
        ";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email Error: " . $mail->ErrorInfo);
        return false;
    }
}

function sendEnquiryEmail($enquiryData) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.touristdriversindiaprivatetours.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@touristdriversindiaprivatetours.com';
        $mail->Password = 'SJZpFgA5K27w';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Recipients
        $mail->setFrom('info@touristdriversindiaprivatetours.com', 'Tourist Drivers India');
        $mail->addAddress('touristdriversindiapvttours@gmail.com', 'Tourist Drivers India');
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Quick Enquiry - ' . $enquiryData['booking_number'];
        
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .header { background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); padding: 20px; text-align: center; color: white; }
                .content { padding: 30px; background: #f9f9fa; }
                .info-table { width: 100%; background: white; border-collapse: collapse; margin: 20px 0; }
                .info-table td { padding: 12px; border: 1px solid #ddd; }
                .info-table td:first-child { background: #f5f5f5; font-weight: bold; width: 40%; }
                .footer { padding: 20px; text-align: center; background: #333; color: white; }
            </style>
        </head>
        <body>
            <div class='header'>
                <h2>🎉 New Quick Enquiry</h2>
            </div>
            <div class='content'>
                <h3>Enquiry Details</h3>
                <table class='info-table'>
                    <tr>
                        <td>Reference Number</td>
                        <td><strong>{$enquiryData['booking_number']}</strong></td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td>{$enquiryData['name']}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><a href='tel:{$enquiryData['phone']}'>{$enquiryData['phone']}</a></td>
                    </tr>
                    <tr>
                        <td>Package Interest</td>
                        <td>{$enquiryData['package_title']}</td>
                    </tr>
                    <tr>
                        <td>Travel Date</td>
                        <td>" . date('d M, Y', strtotime($enquiryData['travel_date'])) . "</td>
                    </tr>
                    <tr>
                        <td>Number of People</td>
                        <td>{$enquiryData['people']}</td>
                    </tr>
                </table>
            </div>
            <div class='footer'>
                <p>Tourist Drivers India Private Tours<br>
                This is an automated notification</p>
            </div>
        </body>
        </html>
        ";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email Error: " . $mail->ErrorInfo);
        return false;
    }
}

function sendContactEmail($contactData) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.touristdriversindiaprivatetours.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@touristdriversindiaprivatetours.com';
        $mail->Password = 'SJZpFgA5K27w';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Recipients
        $mail->setFrom('info@touristdriversindiaprivatetours.com', 'Tourist Drivers India');
        $mail->addAddress('touristdriversindiapvttours@gmail.com', 'Tourist Drivers India');
        $mail->addReplyTo($contactData['email'], $contactData['name']);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Message - ' . $contactData['contact_number'];
        
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .header { background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); padding: 20px; text-align: center; color: white; }
                .content { padding: 30px; background: #f9f9fa; }
                .info-table { width: 100%; background: white; border-collapse: collapse; margin: 20px 0; }
                .info-table td { padding: 12px; border: 1px solid #ddd; }
                .info-table td:first-child { background: #f5f5f5; font-weight: bold; width: 40%; }
                .footer { padding: 20px; text-align: center; background: #333; color: white; }
            </style>
        </head>
        <body>
            <div class='header'>
                <h2>📧 New Contact Form Message</h2>
            </div>
            <div class='content'>
                <h3>Contact Details</h3>
                <table class='info-table'>
                    <tr>
                        <td>Reference Number</td>
                        <td><strong>{$contactData['contact_number']}</strong></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{$contactData['name']}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><a href='mailto:{$contactData['email']}'>{$contactData['email']}</a></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><a href='tel:{$contactData['phone']}'>{$contactData['phone']}</a></td>
                    </tr>
                    <tr>
                        <td>Package Interest</td>
                        <td>{$contactData['package_title']}</td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>" . nl2br(htmlspecialchars($contactData['message'])) . "</td>
                    </tr>
                    <tr>
                        <td>Submitted On</td>
                        <td>" . date('d M, Y h:i A') . "</td>
                    </tr>
                </table>
            </div>
            <div class='footer'>
                <p>Tourist Drivers India Private Tours<br>
                This is an automated notification</p>
            </div>
        </body>
        </html>
        ";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email Error: " . $mail->ErrorInfo);
        return false;
    }
}
?>