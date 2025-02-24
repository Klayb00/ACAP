<?php
    include "config.php";
    session_start();
    $user_id = $_SESSION['user_id'];


    $foodsID = $_GET['id'];

        $sql = "DELETE FROM `foodsutilities_inventory` WHERE foodsutilitiesID = $foodsID";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: foods&utilities_inventory.php");
        }
        else{
            header("Location: foods&utilities_inventory.php");
        }

?>

<?php
include 'config.php'; 

ob_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) { 
        $foodsID = intval($_REQUEST['id']);

        
        $deleteOutRecords = "DELETE FROM foodutilities_out_records WHERE foodsutilitiesID = $foodsID";
        mysqli_query($conn, $deleteOutRecords);

        
        $deletefoodsutilities = "DELETE FROM foodsutilities_inventory WHERE foodsutilitiesID = $foodsID";
        if (mysqli_query($conn, $deletefoodsutilities)) {
            header("Location: foods&utilities_inventory.php");
            exit();
        } else {
            echo "Error deleting Foods & Utilities: " . mysqli_error($conn);
        }
    } else {
        echo "Error: No Foods & Utilities ID provided.";
    }
} else {
    echo "Invalid request method.";
}


mysqli_close($conn);


ob_end_flush();
?>

