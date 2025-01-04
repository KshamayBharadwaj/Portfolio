<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Your Gmail
        $mail->Password = 'your-app-password';    // App password (see note below)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom($email, $name);
        $mail->addAddress('kshamaypbharadwaj@gmail.com'); // Your receiving email
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "You have received a new message.\n\nName: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        echo "Message submitted successfully! Thank you, $name.";
    } catch (Exception $e) {
        echo "Failed to send the message. Error: {$mail->ErrorInfo}";
    }
}
?>
