<?php
include "config.php";
session_start();

if (isset($_GET['id']) && !empty($_GET['id'])) { 
    $medicaliD = intval($_GET['id']);

    // Delete from related table first
    $deleteOutRecords = "DELETE FROM medical_out_records WHERE medicaliD = $medicaliD";
    mysqli_query($conn, $deleteOutRecords);

    // Now delete from medical_inventory
    $deleteMedicine = "DELETE FROM medical_inventory WHERE medicaliD = $medicaliD";

    if (mysqli_query($conn, $deleteMedicine)) {
        header("Location: medical_inventory.php");
        exit();
    } else {
        echo "Error deleting medical assets: " . mysqli_error($conn);
    }
} else {
    echo "Error: No medical ID provided.";
}

mysqli_close($conn);
?>
