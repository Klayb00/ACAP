<?php
// Include database configuration
include 'config.php';

// Get the selected time period
$time_period = isset($_GET['period']) ? $_GET['period'] : 'daily';

if ($time_period == 'daily') {
    $query = "SELECT item_name, DATE(date_out) AS period, SUM(out_items) AS total_out
              FROM foodutilities_out_records 
              GROUP BY item_name, DATE(date_out) 
              ORDER BY date_out";
} elseif ($time_period == 'weekly') {
    $query = "SELECT item_name, CONCAT(YEAR(date_out), '-', WEEK(date_out)) AS period, SUM(out_items) AS total_out
              FROM foodutilities_out_records 
              GROUP BY item_name, YEAR(date_out), WEEK(date_out) 
              ORDER BY date_out";
} elseif ($time_period == 'monthly') {
    $query = "SELECT item_name, DATE_FORMAT(date_out, '%M/%Y') AS period, SUM(out_items) AS total_out
              FROM foodutilities_out_records 
              GROUP BY item_name, YEAR(date_out), MONTH(date_out) 
              ORDER BY date_out";
} else {
    // Default to daily if an invalid period is provided
    $query = "SELECT item_name, DATE(date_out) AS period, SUM(out_items) AS total_out
              FROM foodutilities_out_records 
              GROUP BY item_name, DATE(date_out) 
              ORDER BY date_out";
}

// Fetch data from database
$result = mysqli_query($conn, $query);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['item_name']][] = [
        'label' => $row['period'],
        'total_out' => $row['total_out']
    ];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($data);

// Close connection
mysqli_close($conn);
?>
