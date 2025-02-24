<?php
session_start();
include 'config.php';

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    // Check if the token is valid
    $select = mysqli_query($conn, "SELECT * FROM `user_accounts` WHERE reset_token = '$token'");
    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);

        if (isset($_POST['reset'])) {
            $new_password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));

            if ($new_password === $confirm_password) {
                $update = mysqli_query($conn, "UPDATE `user_accounts` SET password = '$new_password', reset_token = '' WHERE reset_token = '$token'");
                if ($update) {
                    echo '<script>alert("Password has been reset successfully!"); window.location.href="index.php";</script>';
                } else {
                    echo '<script>alert("Failed to reset password. Try again.");</script>';
                }
            } else {
                echo '<script>alert("Passwords do not match.");</script>';
            }
        }
    } else {
        echo '<script>alert("Invalid or expired token."); window.location.href="index.php";</script>';
    }
} else {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/reset_pass.css">
    <title>Reset Password</title>
</head>
<body>
<div class="container">
        <form action="" method="POST" class="form-box">
            <h2>Reset Password</h2>
            <input type="password" name="password" placeholder="Enter New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
            <button type="submit" name="reset">Reset Password</button>
        </form>
    </div>
</body>
</html>
