<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sanitize_line($s) {
    $s = isset($s) ? $s : '';
    $s = trim($s);
    $s = strip_tags($s);
    return preg_replace('/[\r\n]+/', ' ', $s);
}

function sendInquiryEmail(array $post) {
    $type = (isset($post['fname']) || isset($post['email']) || isset($post['msg'])) ? 'contact' : 'booking';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'mail.touristdriversindiaprivatetours.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contact@touristdriversindiaprivatetours.com';
    $mail->Password = 'Pm74LQh0yemj';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('contact@touristdriversindiaprivatetours.com', $type === 'contact' ? 'Website Contact Form' : 'Website Booking Form');
     $mail->addAddress('touristdriversindiapvttours@gmail.com', 'Admin');
    // $mail->addAddress('gourav.ssp@gmail.com', 'Admin');
    $mail->isHTML(true);

    if ($type === 'contact') {
        $name = sanitize_line($post['fname'] ?? '');
        $phone = sanitize_line($post['phone'] ?? '');
        $email = trim($post['email'] ?? '');
        $subject = sanitize_line($post['subject'] ?? '');
        $message = htmlspecialchars(trim($post['msg'] ?? ''), ENT_QUOTES, 'UTF-8');

        if ($name === '' || $email === '' || $message === '') {
            return [false, 'Please fill in all required fields.'];
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [false, 'Invalid email address.'];
        }
        if (preg_match('/[\r\n]/', $email)) {
            return [false, 'Invalid email address.'];
        }

        $mail->addReplyTo($email, $name);
        $mail->Subject = $subject !== '' ? ('New Contact Inquiry: ' . $subject) : 'New Contact Inquiry';
        $mail->Body = "
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Email:</strong> " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "</p>
            <p><strong>Subject:</strong> {$subject}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        ";
    } else {
        $destination = sanitize_line($post['destination'] ?? '');
        $date = sanitize_line($post['date'] ?? '');
        $people = sanitize_line($post['people'] ?? '');
        $number = sanitize_line($post['number'] ?? '');
        $remark = htmlspecialchars(trim($post['remark'] ?? ''), ENT_QUOTES, 'UTF-8');

        if ($destination === '' || $number === '') {
            return [false, 'Please provide destination and phone number.'];
        }

        $mail->Subject = 'New Booking Request';
        $mail->Body = "
            <h2>Booking Details</h2>
            <p><strong>Destination:</strong> {$destination}</p>
            <p><strong>Date:</strong> {$date}</p>
            <p><strong>No. of People:</strong> {$people}</p>
            <p><strong>Phone Number:</strong> {$number}</p>
            <p><strong>Remark:</strong> {$remark}</p>
        ";
    }

    try {
        $mail->send();
        return [true, ''];
    } catch (Exception $e) {
        error_log('Email send failed: ' . $mail->ErrorInfo);
        return [false, 'Failed to send email. Please try again later.'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    [$ok, $msg] = sendInquiryEmail($_POST);
    if ($ok) {
        echo "<script>alert('Thank you! Your request has been submitted.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('" . addslashes($msg) . "'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.history.back();</script>";
}
?>
