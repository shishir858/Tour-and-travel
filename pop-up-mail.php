<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitize inputs
    function clean($v) {
        return htmlspecialchars(trim($v ?? ''), ENT_QUOTES, 'UTF-8');
    }

    $fname       = clean($_POST['fullName']);
    $email       = clean($_POST['email']);
    $phone       = clean($_POST['phone']);
    $traveldate  = clean($_POST['travelDate']);
    $count       = clean($_POST['count']);
    $message     = clean($_POST['message']);

    if ($fname === '' || $email === '' || $phone === '') {
        echo "<script>alert('Please fill all required fields'); history.back();</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address'); history.back();</script>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // ✅ HOSTING SMTP (same as working form)
        $mail->isSMTP();
        $mail->Host       = 'mail.touristdriversindiaprivatetours.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contact@touristdriversindiaprivatetours.com';
        $mail->Password   = 'Pm74LQh0yemj'; // hosting email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Headers
        $mail->setFrom('contact@touristdriversindiaprivatetours.com', 'Website Enquiry');
        $mail->addAddress('touristdriversindiapvttours@gmail.com', 'Admin');
        $mail->addReplyTo($email, $fname);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Pop-up Enquiry';
        $mail->Body = "
            <h2>Pop-up Form Submission</h2>
            <p><strong>Name:</strong> {$fname}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Travel Date:</strong> {$traveldate}</p>
            <p><strong>No. of People:</strong> {$count}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        ";

        $mail->send();

        echo "<script>
            alert('Thank you! Your inquiry has been submitted.');
            window.location.href='index.php';
        </script>";

    } catch (Exception $e) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        echo "<script>alert('Failed to send email. Please try again later.'); history.back();</script>";
    }

} else {
    echo "<script>alert('Invalid request'); history.back();</script>";
}
?>
