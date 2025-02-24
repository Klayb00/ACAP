<?php
include 'config.php';

// Kunin ang lahat ng "out items" mula sa database
$query = "SELECT * FROM medicine_out_records"; // Palitan ng iyong table name at column names
$result = mysqli_query($conn, $query);

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Out Items List</title>
    <style>
       /* Global Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: auto;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.title {
    text-align: center;
    margin-bottom: 20px;
    font-size: 28px;
    color: #333;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #00abff;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e9e9e9;
}

/* Media Query for Tablets and Smaller Devices */
@media (max-width: 768px) {
    .title {
        font-size: 24px;
    }

    table, th, td {
        font-size: 14px;
    }

    th, td {
        padding: 10px;
    }

    .container {
        width: 95%;
        padding: 15px;
    }

    table {
        margin-top: 10px;
    }
}

/* Media Query for Mobile Devices */
@media (max-width: 480px) {
    .title {
        font-size: 20px;
    }

    table, th, td {
        font-size: 12px;
    }

    th, td {
        padding: 8px;
    }

    .container {
        width: 100%;
        padding: 10px;
    }

    table {
        margin-top: 5px;
    }
}

    </style>
</head>
<body>

<div class="container">
<?php

// Query to select the month from the database
$selectMonth = "SELECT * FROM qrcode";
$monthSelect = mysqli_query($conn, $selectMonth);

// Fetch the result
if ($monthSelect && mysqli_num_rows($monthSelect) > 0) {
    $row = mysqli_fetch_array($monthSelect);
?>
    <h2 class="title">Out Items List For the Month of <?php echo $row['month']; ?></h2>
<?php
} else {
    // If no result is found for the selected month
    echo "<h2 class='title'>No data found for the selected month.</h2>";
}
?>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Item Size</th>
                    <th>Price</th>
                    <th>Out Items</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): 
                    
                    $donate = $row['donate'];
                                  $out_items = $row['out_items'];
                                  $price = $row['price'];
                          
                                  // Calculate total use and total out amount
                                  $totalUse = $donate + $out_items;
                                  $totalout = $totalUse * $price;
                    ?>
                    <tr>
                        <td><?php echo $row['medicineID']; ?></td>
                        <td><?php echo $row['item_name']; ?></td>
                        <td><?php echo $row['item_size']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $totalUse; ?></td>
                        <td><?php echo $totalout;?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No out items available.</p>
    <?php endif; ?>
</div>

</body>
</html>
