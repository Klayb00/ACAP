<?php
include 'config.php';
require_once 'phpqrcode/qrlib.php';

// Define path where QR code images will be saved
$path = 'QR_CODE/';

// Ensure the folder exists and is writable by the web server
if (!file_exists($path)) {
    mkdir($path, 0777, true);
}

$qrcode = $path . time() . ".png"; // Full path for saving the QR code image
$qrimage = time() . ".png"; // Filename for the QR code image

if (isset($_REQUEST['sbt-btn'])) {
 
    $qrtext = $_REQUEST['qrtext'];

    $query = mysqli_query($conn, "INSERT INTO qrcode (item_name, qrcode_images) VALUES ('$qrtext', '$qrimage')");

    if ($query) {
        echo "<script>alert('Item saved successfully');</script>";
    } else {
        echo "<script>alert('Error saving item.');</script>";
    }

    // Generate the QR code and save it to the file path
    QRcode::png($qrtext, $qrcode, 'H', 4, 4); // 'H' is the error correction level, 4 is the size

    // Display the generated QR code image
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="500; url=index.php">
    <title>Items QR Generator</title>
<!-- HTML Form for QR code generation -->
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f4f4f9;
        }

        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }

        h1 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: calc(100% - 40px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        input[type="submit"] {
            background: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        .qr-code {
            margin-top: 20px;
            padding: 10px;
            border: 1px dashed #ccc;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f9f9f9;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.2rem;
            }

            button {
                padding: 8px 10px;
                font-size: 0.9rem;
            }
        }
    </style>
<form method="POST">
    <input type="text" name="qrtext" id="textInput" placeholder="Enter text for QR code" required>
    <input type="submit" name="sbt-btn" value="Generate QR Code">
    <div class="qr-code" id="qrCodeContainer">
            <!-- QR code will appear here -->
             <?php echo "<img src='" . $qrcode . "' alt='QR Code'>";?>
        </div>
</form>
</body>
</html>
