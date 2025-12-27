<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    function clean($v) {
        return htmlspecialchars(trim($v ?? ''), ENT_QUOTES, 'UTF-8');
    }

    $name    = clean($_POST['fname']);
    $email   = clean($_POST['email']);
    $phone   = clean($_POST['phone']);
    $subject = clean($_POST['subject']);
    $msg     = clean($_POST['msg']);

    if ($name === '' || $email === '' || $msg === '') {
        echo "<script>alert('Please fill all required fields'); history.back();</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address'); history.back();</script>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // ✅ Hosting SMTP (WORKING CONFIG)
        $mail->isSMTP();
        $mail->Host       = 'mail.touristdriversindiaprivatetours.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contact@touristdriversindiaprivatetours.com';
        $mail->Password   = 'Pm74LQh0yemj'; // change password after testing
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Headers
        $mail->setFrom('contact@touristdriversindiaprivatetours.com', 'Website Enquiry');
        $mail->addAddress('touristdriversindiapvttours@gmail.com', 'Admin');
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject !== '' ? $subject : 'New Website Enquiry';
        $mail->Body = "
            <h2>New Enquiry</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Message:</strong><br>{$msg}</p>
        ";

        $mail->send();

        echo "<script>
            alert('Thank you! Your enquiry has been sent successfully.');
            window.location.href='index.php';
        </script>";

    } catch (Exception $e) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        echo "<script>alert('Failed to send enquiry. Please try again later.'); history.back();</script>";
    }

} else {
    echo "<script>alert('Invalid request'); history.back();</script>";
}
?>
