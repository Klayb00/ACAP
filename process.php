<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qrData = $_POST['qr_data'] ?? null;

    if ($qrData) {
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>";
        echo "<title>QR Code Data</title>";
        echo "</head>";
        echo "<body class='container mt-5'>";
        echo "<h1 class='text-center'>QR Code Data</h1>";
        echo "<p class='text-center text-success'><strong>Data:</strong> " . htmlspecialchars($qrData) . "</p>";
        echo "<div class='text-center'><a href='index.html' class='btn btn-primary'>Back to Scanner</a></div>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "<h1 class='text-danger'>No QR Code Data Received</h1>";
    }
} else {
    echo "<h1 class='text-danger'>Invalid Request</h1>";
}
?>
