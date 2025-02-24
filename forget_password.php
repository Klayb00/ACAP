<?php
session_start();
include 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';



if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Check if the email exists in the database
    $select = mysqli_query($conn, "SELECT * FROM `user_accounts` WHERE email = '$email'") or die('Query failed');
    
    if (mysqli_num_rows($select) > 0) {
        $token = bin2hex(random_bytes(50)); // Generate a secure random token
        $insert_token = mysqli_query($conn, "UPDATE `user_accounts` SET reset_token = '$token' WHERE email = '$email'");
        
        if ($insert_token) {
            $mail = new PHPMailer(true);
            
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jackstone122402@gmail.com';  // Your email address
                $mail->Password = 'rwbtvxqeqkzqzgcx';    // Your Gmail app password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                
                // Recipients
                $mail->setFrom('jackstone122402@gmail.com', 'Sinag Kalinga');
                $mail->addAddress($email);  // Recipient's email address

                // Content
                $mail->isHTML(false);
                $mail->Subject = 'Password Reset Request';
                $mail->Body = "Click the link below to reset your password:\n\n";
                $mail->Body .= "http://skfilucban.com/reset_password.php?token=$token";

                $mail->send();
                echo '<script>alert("Password reset link has been sent to your email.");</script>';
            } catch (Exception $e) {
                echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '");</script>';
            }
        } else {
            echo '<script>alert("Failed to generate reset token. Try again.");</script>';
        }
    } else {
        echo '<script>alert("No account found with this email address.");</script>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/reset_pass.css">
    <title>Forget Password</title>
</head>
<body>
<div class="container">
        <form action="" method="POST" class="form-box">
            <h2>Forget Password</h2>
            <p>Enter your email address to receive a password reset link.</p>
            <input type="email" name="email" placeholder="Enter Email" required>
            <button type="submit" name="submit">Send Reset Link</button>
        </form>
    </div>
</body>
</html>
