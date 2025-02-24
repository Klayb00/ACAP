<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON data from the AJAX request
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['qrCodeUrl']) && isset($data['qrData'])) {
        $qrCodeUrl = $data['qrCodeUrl'];
        $qrData = $data['qrData'];

        // Specify the folder where QR codes will be saved
        $savePath = __DIR__ . '/Item QR_CODE/'; // Save in the 'qrcodes' directory within the current folder

        // Create the directory if it doesn't exist
        if (!is_dir($savePath)) {
            mkdir($savePath, 0755, true);
        }

        // Define the file name for saving (e.g., based on item name or unique ID)
        $fileName = $savePath . uniqid() . '.png';

        // Fetch the QR code image from the data URL and save it to the server
        $qrCodeImage = file_get_contents($qrCodeUrl);
        if ($qrCodeImage && file_put_contents($fileName, $qrCodeImage)) {
            echo "QR code saved successfully: $fileName";
        } else {
            echo "Error saving QR code.";
        }
    } else {
        echo "Invalid data provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
