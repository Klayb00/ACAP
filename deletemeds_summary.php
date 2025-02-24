<?php
    include "config.php";
    session_start();
    $user_id = $_SESSION['user_id'];


    $medicineID = $_GET['id'];

        $sql = "DELETE FROM `medicine_data`  WHERE out_items = out_items > 0";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: medicine_inventory.php");
        }
        else{
            header("Location: medicine_inventory.php");
        }

?>

