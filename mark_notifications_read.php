<?php
// Include the database connection
include 'config.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit();
}

// Get the notification ID from the POST request
$notificationId = isset($_POST['id']) ? $_POST['id'] : null;

if ($notificationId !== null) {
    // Use prepared statements to prevent SQL injection
    $updateQuery = "UPDATE notifications SET is_read = 1 WHERE user_id = ? AND notification_id = ?";

    // Prepare the query
    if ($stmt = mysqli_prepare($conn, $updateQuery)) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ii", $_SESSION['user_id'], $notificationId);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            echo "Notification marked as read.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the query: " . mysqli_error($conn);
    }
} else {
    echo "Invalid notification ID.";
}

// Close the database connection
mysqli_close($conn);
?>
