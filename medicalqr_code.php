<?php
include 'config.php';
require_once 'phpqrcode/qrlib.php';

// Path kung saan isasave ang mga QR code
$path = 'QR_images/Medical/';
if (!is_dir($path)) {
    mkdir($path); // Gumawa ng folder kung hindi pa ito umiiral
}

$month = date('M Y'); // Full month name (e.g., January)

$qr_url = "https://skfilucban.com/show_items.php"; 

// Pangalan ng QR code image file
$qrcode_filename = $path . $month . "_medical_out_summarize.png";

// Generate QR code
QRcode::png($qr_url, $qrcode_filename, QR_ECLEVEL_H, 4, 4);



    if(isset($_POST["saveQR"])){

        $qrname = $_POST["qrName"];
        $monthUse = $_POST["month"];


        $checkQR = "SELECT * FROM medicalqr WHERE month = '$monthUse'";
        $showCheckQR = mysqli_query($conn, $checkQR);

            if(mysqli_num_rows($showCheckQR) > 0){

                echo '<script type = "text/javascript">';
                echo 'alert("This Month is Already save..!");';
                echo 'window.location.href = "medical_inventory.php"';
                echo '</script>';
            }else{

                $insertQR = "INSERT INTO medicalqr VALUES ('', '$qrname', '$month', '$qrcode_filename')";
                mysqli_query($conn, $insertQR);

                echo '<script type = "text/javascript">';
                echo 'alert("Save Successfully!");';
                echo 'window.location.href = "medical_inventory.php"';
                echo '</script>';
            }

           
       
    }

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Css/qrcode.css">
</head>
<body>
    <div class="qr-form">
        <div class="form-qrcode">
            <form action="#" method="POST">
                <label for="qrName"><b>QR Name</b></label>
                <br>
                <input type="text" name="qrName" value="<?php echo $qrcode_filename;?>">
                <br>
                <label for="month"><b>Month</b></label>
                <br>
                <input type="text" name="month" value="<?php echo $month;?>">
                <br>
                <input type="submit" name="saveQR" value="Save">
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
