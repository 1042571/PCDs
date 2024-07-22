<?php
if (isset($_POST['reset'])) {
    $email = $_POST['email'];
} else {
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                        // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'your_email@gmail.com';                  // SMTP username
    $mail->Password   = 'secret';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    // Recipients
    $mail->setFrom('your_email@gmail.com', 'Admin');

    // Connect to the respective databases
    include 'includes/server.php';

    // Check user database
    $verifyUser = $conn->query("SELECT * FROM `users` WHERE email = '$email'");
    $verifyAdmin = $conn->query("SELECT * FROM `admin` WHERE email = '$email'");
    $verifyManufacturer = $conn->query("SELECT * FROM `drugmanufacturer` WHERE email = '$email'");
    if ($verifyUser->num_rows) {
        // User exists in the user database
        $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10);

        // Set email recipient
        $mail->addAddress($email);

        // Email content for users
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = 'To reset your password click <a href="http://localhost/system/admin/reset_password.php?code=' . $code . '">here</a>. <br>Reset your password within a day.';

        // Send email
        $mail->send();
        echo '<div  class="success">Message has been sent. Check your email for further instructions.</div>';
    } elseif ($verifyAdmin->num_rows) {
        // User exists in the user database
        $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10);

        // Set email recipient
        $mail->addAddress($email);

        // Email content for users
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = 'To reset your password click <a href="http://localhost/system/admin/reset_password.php?code=' . $code . '">here</a>. <br>Reset your password within a day.';


        // Send email
        $mail->send();
        echo '<div  class="success">Message has been sent. Check your email for further instructions.</div>';
    } elseif ($verifyManufacturer->num_rows) {
        // User exists in the user database
        $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10);

        // Set email recipient
        $mail->addAddress($email);

        // Email content for users
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body    = 'To reset your password click <a href="http://localhost/system/manufacturer/reset_password.php?code=' . $code . '">here</a>. <br>Reset your password within a day.';

        // Send email
        $mail->send();
        echo '<div class="success">Message has been sent. Check your email for further instructions.</div>';
    } else {
        echo '<div class="error">User not in the database.</div>';
    }

    $conn->close();
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    echo '<div class="error">Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</div>';

}
