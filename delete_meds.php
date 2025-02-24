<?php
include 'config.php'; 

ob_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) { 
        $medicineID = intval($_REQUEST['id']);

        
        $deleteOutRecords = "DELETE FROM medicine_out_records WHERE medicineID = $medicineID";
        mysqli_query($conn, $deleteOutRecords);

        
        $deleteMedicine = "DELETE FROM medicine_data WHERE medicineID = $medicineID";
        if (mysqli_query($conn, $deleteMedicine)) {
            header("Location: medicine_inventory.php");
            exit();
        } else {
            echo "Error deleting medicine: " . mysqli_error($conn);
        }
    } else {
        echo "Error: No medicine ID provided.";
    }
} else {
    echo "Invalid request method.";
}


mysqli_close($conn);


ob_end_flush();
?>
