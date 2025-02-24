<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `user_accounts` WHERE email = '$email' AND password = '$pass'") or die('Query failed');
    $row = mysqli_fetch_assoc($select);

    if ($row) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['status'] = $row['status'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_role'] = $row['role'];
        $status = $row['status'];

        if ($status === "approved") {
            header('Location: dashboard.php');
            exit;
        } elseif ($status === "pending") {
            echo "<script>alert('Your account is still pending approval!'); window.location.href = 'index.php';</script>";
        }
    } else {
        $message = 'Invalid email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="logcss.css">
    <title>Login</title>
</head>
<body>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: linear-gradient(to top, #0d68f0, #00D2FF);">
                <div class="featured-image mb-3">
                    <img src="images/logo new.png" class="img-fluid" style="width: 350px;" alt="Logo">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;"></p>
            </div>

            <!--------------------------- Right Box ----------------------------->

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Welcome Back</h2>
                        <p>We are happy to have you back.</p>
                    </div>
                    <?php if (isset($message)): ?>
                        <div class="alert alert-danger text-center"><?php echo $message; ?></div>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email Address" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" required>
                        </div>
                        <div class="input-group mb-4 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                            </div>
                            <div class="forgot">
                                <small><a href="forget_password.php">Forgot Password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="submit" name="login" class="btn btn-lg btn-primary w-100 fs-6" value="Login">
                        </div>
                    </form>
                    <div class="row">
                        <small>Don't have an account? <a href="register.php">Sign Up</a></small>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
