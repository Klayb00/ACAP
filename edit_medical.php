<?php

date_default_timezone_set('Asia/Manila');

// Include database configuration and start session
include 'config.php';
session_start();

// Validate session
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Error: User not authenticated.'); window.location.href='index.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST["update"])) {
    
    $medical_id = $_POST["medical_id"];
    $item_name = mysqli_real_escape_string($conn, $_POST["itemName"]);
    $add_stock = intval($_POST["addstock"]);
    $expirations_date = mysqli_real_escape_string($conn, $_POST["expirations_date"]);
    $donate = intval($_POST["donate"]);
    $price = floatval($_POST["prices"]);
    $out_items = intval($_POST["out_items"]);
    $bgnblnc = intval($_POST["bgnblnc"]); 


    try {
        mysqli_begin_transaction($conn);
        
         $currentDateTime = date("Y-m-d H:i:s");

        // Fetch the current balance
        $selectStockQuery = "SELECT * FROM medical_inventory WHERE medicaliD = $medical_id";
        $resultStock = mysqli_query($conn, $selectStockQuery);

        if (!$resultStock || mysqli_num_rows($resultStock) == 0) {
            throw new Exception("Error: Item not found.");
        }

        $row = mysqli_fetch_assoc($resultStock);
        $currentStock = floatval($row['begin_balance']);
        $currentBeginAmount = floatval($row['begin_amount']);

        // Ensure stock is sufficient before deducting
        if ($currentStock < ($out_items + $donate)) {
            throw new Exception("Insufficient stock. You cannot deduct more than the available stock.");
        }

        // ✅ Correctly Calculate New Stock
        $newStock = $currentStock + $add_stock - $out_items - $donate;

        // ✅ Correctly Update `begin_amount`
        $stocksUpdate = $add_stock * $price;
        $newBeginAmount = $currentBeginAmount + $stocksUpdate;
        $total_outamount = ($donate + $out_items) * $price;
        // Update the stock
        $updateQuery = "UPDATE medical_inventory SET 
                         begin_balance = $newStock,
                         donate = donate + $donate,
                         out_items = out_items + $out_items,
                         out_amount = out_amount + $total_outamount,
                         begin_amount = $newBeginAmount,
                         updated_at = '$currentDateTime'
                         WHERE medicaliD = $medical_id";

        if (!mysqli_query($conn, $updateQuery)) {
            throw new Exception("Failed to update stock.");
        }

        $selectSizeQuery = "SELECT item_size FROM medical_inventory WHERE medicaliD = $medical_id";
        $resultSize = mysqli_query($conn, $selectSizeQuery);
        
        if (!$resultSize || mysqli_num_rows($resultSize) == 0) {
            throw new Exception("Error: Item size not found.");
        }
        
        $rowSize = mysqli_fetch_assoc($resultSize);
        $item_size = mysqli_real_escape_string($conn, $rowSize['size']);
        

        if ($out_items > 0) {
            $total_cost = $out_items * $price;
            $insertOutItemsQuery = "INSERT INTO medical_out_records (medicaliD, user_id, item_name, out_items, donate, price, total_cost, date_out) 
                                    VALUES ($medical_id, $user_id, '$item_name', $out_items, 0, $price, $total_cost, NOW())";
        
            if (!mysqli_query($conn, $insertOutItemsQuery)) {
                throw new Exception("Failed to insert out items record: " . mysqli_error($conn));
            }
        }
        
        
        if ($donate > 0) {
            $total_donation_cost = $donate * $price;
            $insertDonateQuery = "INSERT INTO medical_out_records (medicaliD, user_id, item_name, out_items, donate, price, total_cost, date_out) 
                                  VALUES ($medical_id, $user_id, '$item_name', 0, $donate, $price, $total_donation_cost, NOW())";
        
            if (!mysqli_query($conn, $insertDonateQuery)) {
                throw new Exception("Failed to insert donation record: " . mysqli_error($conn));
            }
        }
        
        $userQuery = "SELECT uname FROM user_accounts WHERE id = $user_id";
        $resultUser = mysqli_query($conn, $userQuery);
        
        if ($resultUser && mysqli_num_rows($resultUser) > 0) {
            $rowUser = mysqli_fetch_assoc($resultUser);
            $username = mysqli_real_escape_string($conn, $rowUser['uname']);
        } else {
            $username = "Unknown"; // Default if no username is found
        }


        // ✅ Log the activity
        $action = 'Update';
        $target = 'Medical Asset';
        $description = "User $username updated stock for medical ID $medical_id. New stock: $newStock, Donation: $donate, Out Items: $out_items, Begin Amount: $newBeginAmount.";
        $description = mysqli_real_escape_string($conn, $description);
        $time = date("Y-m-d H:i:s");
        
        $logQuery = "INSERT INTO activity_log (user_id, username, action, medicine_name, target, description, time) 
                     VALUES ($user_id, '$username', '$action', '$item_name', '$target', '$description', '$time')";
        
        if (!mysqli_query($conn, $logQuery)) {
            throw new Exception("Failed to log activity: " . mysqli_error($conn));
        }
        // Commit changes
        mysqli_commit($conn);

        echo "<script>alert('Stock updated successfully. Remaining stock: $newStock.'); window.location.href='medical_inventory.php';</script>";
        exit;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href='medical_inventory.php';</script>";
    }
}
?>
