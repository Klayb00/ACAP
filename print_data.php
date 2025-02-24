<?php

// PHP connection
include 'config.php';
session_start();

// Ensure the session variable is set
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

$user_id = $_SESSION['user_id'];

// Fetch all the records from the database
$sql = "SELECT * FROM medicine_data";  // Fetch all records
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $medicines = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "No records found.";
    exit();
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Product List</title>
    <style>
        /* Basic styling for the print page */
        .print-container {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="print-container">
    <h1>Product List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Item Name</th>
                <th>Item Size</th>
                <th>Remaining Balance</th>
                <th>Donate</th>
                <th>Out Item</th>
                <th>Expiration Date</th>
                <th>Price</th>
                <th>Out Amount</th>
                <th>Remaining Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through each record and display in table rows
            foreach ($medicines as $medicine) {
                echo "<tr>";
                echo "<td>" . $medicine['medicineID'] . "</td>";
                echo "<td>" . $medicine['category'] . "</td>";
                echo "<td>" . $medicine['item_name'] . "</td>";
                echo "<td>" . $medicine['item_size'] . "</td>";
                echo "<td>" . $medicine['begin_balance'] . "</td>";
                echo "<td>" . $medicine['donate'] . "</td>";
                 echo "<td>" . $medicine['out_items'] . "</td>";
                echo "<td>" . $medicine['expirations_date'] . "</td>";
                echo "<td>" . $medicine['price'] . "</td>";
                echo "<td>" . $medicine['out_amount'] . "</td>";
                echo "<td>" . $medicine['begin_amount'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

<br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Total Out Items</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through each record and display in table rows
            foreach ($medicines as $medicine) {
                echo "<tr>";
                echo "<td>" . $medicine['medicineID'] . "</td>";
                echo "<td>" . $medicine['item_name'] . "</td>";
                echo "<td>" . $medicine['price'] . "</td>";
                echo "<td>" . $medicine['out_items'] . "</td>";
                echo "<td>" . $medicine['out_amount'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <!-- JavaScript to trigger print -->
   <script type="text/javascript">
    window.onload = function() {
        window.print();  // Automatically opens the print dialog
    };

    window.onafterprint = function() {
        window.location.href = 'medicine_inventory.php'; // Redirect after printing
    };
</script>

</div>

</body>
</html>
