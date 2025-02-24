<?php
    include "config.php";
    session_start();
    $user_id = $_SESSION['user_id'];


    $visitID = $_GET['id'];

        $sql = "DELETE FROM `visitors_data` WHERE id = $visitID";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: visit_data.php");
        }
        else{
            header("Location: visit_data.php");
        }

?>