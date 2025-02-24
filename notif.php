<?php
// Database connection
include 'config.php';
session_start();

// Fetch data from the database
$query = "SELECT item_name, expirations_date, begin_balance FROM medicine_data";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$notifications = []; // Array to store notifications
$currentDate = date('Y-m-d'); // Current date

// Process each item
while ($row = mysqli_fetch_assoc($result)) {
    $itemName = $row['item_name'];
    $expirationDate = $row['expirations_date'];
    $stock = $row['begin_balance'];

    // Check if the item is expired or nearing expiration (7 days before expiry)
    if (strtotime($expirationDate) < strtotime($currentDate)) {
        $notifications[] = "Item '$itemName' has expired on $expirationDate.";
    } elseif (strtotime($expirationDate) <= strtotime("+7 days")) {
        $notifications[] = "Item '$itemName' is nearing expiration on $expirationDate.";
    }
}

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Expiration Notifications</title>
</head>
<body>
    
<div class="container mt-4">
    <h2>Expiration Notifications</h2>

    <!-- Display notifications -->
    <?php if (!empty($notifications)): ?>
        <?php foreach ($notifications as $notification): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $notification; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-success" role="alert">
            No items are expired or nearing expiration.
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
