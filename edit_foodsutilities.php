<?php
    
date_default_timezone_set('Asia/Manila');
//Php connect
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

$f_ID = intval($_POST['f_id']);

if (isset($_POST["update"])) {
    try {
        // Start a transaction
        mysqli_begin_transaction($conn);

        $currentDateTime = date("Y-m-d H:i:s");
        
        // Get the values from the POST request
        $f_item_name = mysqli_real_escape_string($conn, $_POST["f_itemname"]);
        $f_expirations_date = mysqli_real_escape_string($conn, $_POST["f_expirationdates"]);
        $f_price = floatval($_POST["f_prices"]);
        $f_donate = intval($_POST["f_donate"]);
        $f_outitems = intval($_POST["f_outitems"]);
        $f_sumStock = intval($_POST["f_addstock"]);

        // Determine the category
        $f_category = isset($_POST["category"]) ? mysqli_real_escape_string($conn, $_POST["category"]) : 'Others';


        // Fetch current stock
        $selectStockQuery = "SELECT f_beginbalance, f_beginamount FROM foodsutilities_inventory WHERE foodsutilitiesID = $f_ID";
        $resultStock = mysqli_query($conn, $selectStockQuery);

        // Check if item exists
        if (!$resultStock || mysqli_num_rows($resultStock) == 0) {
            throw new Exception("Error: Item not found.");
        }

        $row = mysqli_fetch_assoc($resultStock);
        $currentStock = floatval($row['f_beginbalance']);
        $currentBeginAmount = floatval($row['f_beginamount']);

        // Check if there is enough stock for both out_items and donate
        if ($currentStock < ($f_outitems + $f_donate)) {
            throw new Exception("Insufficient stock. You cannot deduct more than the available stock.");
        }

        // Deduct items from stock
        $newStock = $currentStock + $f_sumStock - $f_outitems - $f_donate;

        // ✅ Correctly Update begin_amount
        $stocksUpdate = $f_sumStock * $f_price;
        $newBeginAmount = $currentBeginAmount + $stocksUpdate;
        $total_outamount = ($f_donate + $f_outitems) * $f_price;

        if ($newStock < 0) {
            throw new Exception("Error: Stock calculation resulted in a negative value.");
        }
        // Update stock in the database
        $updateStockQuery = "UPDATE foodsutilities_inventory 
                             SET f_beginbalance = $newStock, 
                                 f_donate = f_donate + $f_donate, 
                                 f_outitems = f_outitems + $f_outitems,
                                 f_outamount = f_outamount + $total_outamount,
                                 f_beginamount = $newBeginAmount,
                                 updated_at = '$currentDateTime' 
                             WHERE foodsutilitiesID = $f_ID";

        if (!mysqli_query($conn, $updateStockQuery)) {
            throw new Exception("Failed to update stock: " . mysqli_error($conn));
        }

            $selectSizeQuery = "SELECT f_size FROM foodsutilities_inventory WHERE foodsutilitiesID = $f_ID";
            $resultSize = mysqli_query($conn, $selectSizeQuery);
            
            if (!$resultSize || mysqli_num_rows($resultSize) == 0) {
                throw new Exception("Error: Item size not found.");
            }
            
            $rowSize = mysqli_fetch_assoc($resultSize);
            $item_size = mysqli_real_escape_string($conn, $rowSize['f_size']);
            
            // ✅ Insert the out_items into foodutilities_out_records
             if ($f_outitems > 0) {
            $total_cost = $f_outitems * $f_price;
            $insertOutItemsQuery = "INSERT INTO medical_out_records (foodsutilitiesID, user_id, item_name, out_items, donate, price, total_cost, date_out) 
                                    VALUES ($f_ID, $user_id, '$f_item_name', $f_outitems, 0, $f_price, $total_cost, NOW())";
        
            if (!mysqli_query($conn, $insertOutItemsQuery)) {
                throw new Exception("Failed to insert out items record: " . mysqli_error($conn));
            }
        }
        
        
        if ($f_donate > 0) {
            $total_donation_cost = $f_donate * $f_price;
            $insertDonateQuery = "INSERT INTO medical_out_records (foodsutilitiesID, user_id, item_name, out_items, donate, price, total_cost, date_out) 
                                  VALUES ($f_ID, $user_id, '$f_item_name', 0, $f_donate, $f_price, $total_donation_cost, NOW())";
        
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
        $target = 'Foods & Utilities';
        $description = "User $username updated stock for foods and utilities ID $f_ID. New stock: $newStock, Donation: $f_donate, Out Items: $f_outitems, Begin Amount: $newBeginAmount.";
        $description = mysqli_real_escape_string($conn, $description);
        $time = date("Y-m-d H:i:s");
        
        $logQuery = "INSERT INTO activity_log (user_id, username, action, medicine_name, target, description, time) 
                     VALUES ($user_id, '$username', '$action', '$f_item_name', '$target', '$description', '$time')";
        
        if (!mysqli_query($conn, $logQuery)) {
            throw new Exception("Failed to log activity: " . mysqli_error($conn));
        }
        // Commit changes
        mysqli_commit($conn);

        // Success message and redirect
        echo "<script>alert('Stock updated successfully. Remaining stock: $newStock.'); window.location.href='foods&utilities_inventory.php';</script>";
        exit;

    } catch (Exception $e) {
        // ❌ Rollback the transaction on error
        mysqli_rollback($conn);

        // ❌ Display the error message
        $error_message = htmlspecialchars($e->getMessage());
        echo "<script>alert('$error_message'); window.location.href='foods&utilities_inventory.php';</script>";
    }
}

?>