<?php
session_start();
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    // Sanitize inputs
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
    $image_size = isset($_FILES['image']['size']) ? $_FILES['image']['size'] : 0;
    $image_tmp_name = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
    $image_folder = 'uploaded_img/' . $image;

    // Validate inputs
    $errors = [];
    if (empty($lname) || empty($fname) || empty($uname) || empty($email) || empty($pass) || empty($cpass) || empty($role)) {
        $errors[] = 'All fields are required.';
    } elseif ($pass !== $cpass) {
        $errors[] = 'Passwords do not match.';
    } elseif (!in_array($role, ['admin', 'staff', 'socialworker'])) {
        $errors[] = 'Invalid role selected.';
    } elseif ($image_size > 2000000) {
        $errors[] = 'Image size is too large.';
    } elseif (!empty($image) && !in_array(mime_content_type($image_tmp_name), ['image/jpeg', 'image/png', 'image/jpg'])) {
        $errors[] = 'Invalid image type. Only JPG, JPEG, and PNG are allowed.';
    }

    if (empty($errors)) {
        // Check if the email already exists
        $select = mysqli_query($conn, "SELECT * FROM `user_accounts` WHERE email = '$email'") or die('Query failed');
        if (mysqli_num_rows($select) > 0) {
            $errors[] = 'Email already exists.';
        } else {
            // Generate OTP and activation code
            $otp = substr(str_shuffle("0123456789"), 0, 5);
            $activation_code = str_shuffle("abcdefghijklmno" . rand(100000, 10000000));

            // Insert user into database
            $insert = mysqli_query($conn, "INSERT INTO `user_accounts`(fname, lname, uname, email, otp, password, image, role, status, activation_code) 
                VALUES('$fname', '$lname', '$uname', '$email', '$otp', '$pass', '$image', '$role', 'pending', '$activation_code')") or die('Query failed');

            if ($insert) {
                if (!empty($image)) {
                    move_uploaded_file($image_tmp_name, $image_folder);
                }

                // Send verification email
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'jackstone122402@gmail.com'; // Your email
                    $mail->Password = 'rwbtvxqeqkzqzgcx'; // Your email password
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('jackstone122402@gmail.com');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Verify your email address';
                    $mail->Body = "For verification, please enter the following OTP: <strong>$otp</strong>";

                    $mail->send();

                    // Redirect to email verification page
                    header('location:email_verify.php?code=' . $activation_code);
                    exit;

                } catch (Exception $e) {
                    $errors[] = "Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $errors[] = 'Registration failed.';
            }
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Now</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="logcss.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: linear-gradient(to top, #0d68f0, #00D2FF);">
                <img src="images/logo new.png" class="img-fluid" style="width: 550px;">
            </div> 
            <div class="col-md-6 right-box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <h2>Register Now!</h2>
                    <p>We are happy to serve you!</p>
                    
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="input-group mb-3">
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="uname" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/jpg">
                    </div>
                    <div class="input-group mb-3">
                        <select name="role" class="form-control" required>
                            <option value="" selected disabled>Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="socialworker">Social Worker</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" name="submit" class="btn btn-primary w-100">Register Now</button>
                    </div>
                    <p class="text-center">Have an account? <a href="index.php">Sign In</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
