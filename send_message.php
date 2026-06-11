<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $messageContent = strip_tags(trim($_POST["message"]));

    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";  
        $mail->SMTPAuth = true;
        $mail->Username = "idowufiyinfoluwa15@gmail.com";  // <-- change this
        $mail->Password = "your_app_password";    // <-- add app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // RECEIVER
        $mail->setFrom($email, $name);
        $mail->addAddress("idowufiyinfoluwa15@gmail.com");  // receives the message

        // EMAIL CONTENT
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
            <h3>New Message from Contact Form</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong></p>
            <p>$messageContent</p>
        ";

        $mail->send();
        echo "Message sent successfully!";

    } catch (Exception $e) {
        echo "Error sending message: {$mail->ErrorInfo}";
    }

} else {
    echo "Error: Invalid Request.";
}
?>
