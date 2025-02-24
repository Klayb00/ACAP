<?php
    include "config.php";
    session_start();
    $user_id = $_SESSION['user_id'];
    $id = $_GET['id'];

        $sql = "DELETE FROM `residents_info` WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: resident.php");
        }
        else{
            header("Location: resident.php");
        }

?>