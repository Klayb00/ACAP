<?php
session_start();
//Php connect
include 'config.php';

date_default_timezone_set('Asia/Manila');

$user_id = $_SESSION['user_id'];


if (isset($_POST["submit"])) {
    // Retrieve form data safely
    $item_name = mysqli_real_escape_string($conn, $_POST["itemName"]);
    $item_size = mysqli_real_escape_string($conn, $_POST["size"]);
    $begin_balance = (int) $_POST["bgnblnc"];
    $expiration_date = $_POST["expirations_date"];
    $price = (float) $_POST["prices"]; // Ensure price is a valid decimal

    // Format price correctly for SQL storage
    $priceFormat = number_format($price, 2, '.', '');
    $totaloutamount = $begin_balance * $price;

    // Get the current date and time
    $current_time = date("Y-m-d H:i:s");

    // Insert into the `medicine_data` table
    $query_general = "INSERT INTO medical_inventory 
        (item_name, item_size, begin_balance, expirations_date, price, out_amount, begin_amount, created_at) 
        VALUES 
        ('$item_name', '$item_size', '$begin_balance', '$expiration_date', '$priceFormat', '0', '$totaloutamount', '$current_time')";

    if (mysqli_query($conn, $query_general)) {
        echo "<script>alert('Item added successfully!');</script>";
        header('Location: medical_inventory.php');
        exit(); // Ensure script stops execution after redirect
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    // Logging action
    $action = 'Add';
    $target = 'Medical Assets';
    $description = "Added new stock. Medical: $item_name, Begin Balance: $begin_balance";

    // Insert log entry with correct time
    $logQuery = "INSERT INTO activity_log (action, target, description, time) 
                 VALUES ('$action', '$target', '$description', '$current_time')";

    if (!mysqli_query($conn, $logQuery)) {
        echo "<script>alert('Failed to log activity');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner with Popup Form</title>
    <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
            background-size: cover; /* Ensures the image covers the entire page */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            background-position: center; /* Centers the image on the page */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333; /* Optional: Adjust text color for better readability */
        }
         #scanner {
            width: 70%;
            height: 50%;
            display: flex;
            align-items: center;
            border-radius: 10px;
            border: 10px solid #00C0CC;
        }

        /* Modal (Popup) Styles */
        .modal {
            display: none;
            position: absolute;
            min-width: 50%;
            transition: cubic-bezier(0.075, 0.82, 0.165, 1);
        }

        .modal-content {
            flex-direction: column;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Center the form */
            background-image: linear-gradient(150deg, #00F0FF, #00D8E5, #00C0CC, #148DFC);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            max-width: 400px; /* Increased max width */
            width: 95%; /* Make it fill most of the screen on smaller devices */
            padding: 30px; 
            color: #fff;
            border-radius: 8px;
        }
        .modal-content input{
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            gap: 10px;
            border-radius: 5px;
            width: 100%; /* Full width for better responsiveness */
            box-sizing: border-box;
        }
        .modal-content select{
            border: none;
            background: #f1f1f1;
            padding-right: 40%;
            padding-top: 10px;
            padding-bottom: 10px;
            margin-bottom: 15px;
  }
  .modal-content label{
    color: black;
    font-size: 15px;
  }
  .modal-content .btn:hover, .open-button:hover {
    opacity: 1;
  }
    .modal-content button{
        display: flex;
        justify-content: center;
        width: 100%;
        padding: 10px;
        background-color:rgb(123, 194, 252);
        border: none;
    }
        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<br>
    <br>
    <br>
    <br>
    <br>
    <br>
<center>
<h1>QR Code Scanner</h1>
<button onclick="goBack()" style="margin-bottom: 20px; padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
            Back
        </button>
<!-- QR Code Scanner Video -->
<video id="scanner" width="600" height="400" autoplay></video>
</center>
   
<!-- Hidden Modal Form -->
<div id="qrModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>

        <h2>Add Supply</h2>
       
        <form id="qrForm" method="POST">
        <p>QR Code Data: <span id="itemName">No QR code detected</span></p>
                <label for="itemName">Item Name</label>
            <br>
                <input type="text" id="qrCodeDataInput" name="itemName" value="">
            <br>
            <label for="bgnblnc">Beginning Balances</label>
            <br>
                <input type="text" name="bgnblnc" required>
            <br>
                 <label for="sizeInput">Size</label>
            <br>
            <input type="text" id="sizeInput" name="size">
            
            <br>
            <label for="expirations_date">Expiration Date</label>
            <br>
                <input type="date" name="expirations_date">
            <br>
            <label for="prices">Price</label>
            <br>
                <input type="text" name="prices" required>
            <br>
            <label for="itemStatus">Status:</label>
                <input type="text" id="qrCodeCategoryInput" name="itemStatus" class="form-control" placeholder="Category" required>
            <button type="submit" name="submit">Add Supply</button>
        </form>
    </div>
</div>

<script>
     function goBack() {
            window.history.back();
        }
        const videoElement = document.getElementById("scanner");
        const qrModal = document.getElementById("qrModal");
        const closeModal = document.getElementById("closeModal");
        const qrCodeDataInput = document.getElementById("qrCodeDataInput");
        const qrCodeCategoryInput = document.getElementById("qrCodeCategoryInput");
        const sizeInput = document.getElementById("sizeInput"); // Added reference to size input

        navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        .then(stream => {
            videoElement.srcObject = stream;
            videoElement.play();
            scanQRCode();
        })
        .catch(err => console.error("Webcam access error:", err));

    function scanQRCode() {
        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");

        (function processFrame() {
            if (videoElement.readyState === videoElement.HAVE_ENOUGH_DATA) {
                canvas.width = videoElement.videoWidth;
                canvas.height = videoElement.videoHeight;
                context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

                const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, canvas.width, canvas.height);

                if (code) {
                    populateFormFields(code.data);
                    qrModal.style.display = "block";
                }
            }
            requestAnimationFrame(processFrame);
        })();
    }

    function populateFormFields(qrData) {
        try {
            // Check if QR data is JSON or simple text
            let parsedData;
            try {
                parsedData = JSON.parse(qrData);
            } catch (error) {
                parsedData = { text: qrData }; // treat as plain text if JSON parse fails
            }

            qrCodeDataInput.value = parsedData.text || "";
            qrCodeCategoryInput.value = parsedData.category || "";
            sizeInput.value = parsedData.size || ""; // Populate size if available in QR data
        } catch (error) {
            console.error("Error parsing QR data:", error);
            alert("Invalid QR Code format. Make sure it contains valid JSON data.");
        }
    }

    closeModal.onclick = () => qrModal.style.display = "none";
    window.onclick = event => {
        if (event.target == qrModal) qrModal.style.display = "none";
    };
</script>

</body>
</html>
