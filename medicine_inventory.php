<?php
session_start();
//Php connect
include 'config.php';

$user_id = $_SESSION['user_id'];


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="500; url=index.php">
    <title>Sinag Kalinga</title>
    <!-- CSS link -->
    <link rel="stylesheet" href="Css/medicine.css">   
    <link rel="stylesheet" href="Css/formpopup.css">   
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- font awesome link -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    
    <script src="https://kit.fontawesome.com/5ad3914b72.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
    

</head>
<body>

<div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="menu-icon fa-solid fa-xmark"></i>
                    <i class="menu-icon2 fa-solid fa-bars"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="dashboard.php">
                        <img src="images/logo new.png">
                    </a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="dashboard.php" class="sidebar-link">
                    <i class="fa-solid fa-table-list"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="fa-solid fa-house-chimney-user"></i>
                        <span>Visitor</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="visitor.php" class="sidebar-link">Visitor Schedule
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="visit_data.php" class="sidebar-link">All Schedule</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="fa-solid fa-warehouse"></i>
                        <span>Inventory</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="medicine_inventory.php" class="sidebar-link">Medicine Inventory
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="medical_inventory.php" class="sidebar-link">Medical Assets</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="foods&utilities_inventory.php" class="sidebar-link">Foods & Utilities</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#dispensing" aria-expanded="false" aria-controls="multi">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Dispensing Item</span>
                    </a>
                    <ul id="dispensing" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            
                            <a href="medicine_dispense.php" class="sidebar-link">Medicine Dispense
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="medical_dispense.php" class="sidebar-link">Medical Dispense</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="foods&utilities_dispense.php" class="sidebar-link">Foods & Utilities Dispense</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#residents" aria-expanded="false" aria-controls="auth">
                        <i class="fa-solid fa-people-line"></i>
                        <span>Residents</span>
                    </a>
                    <ul id="residents" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="resident.php" class="sidebar-link">Resident Lists
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="add_resident.php" class="sidebar-link">Add Resident</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="deceased_resident.php" class="sidebar-link">Resident Deceased</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#users" aria-expanded="false" aria-controls="auth">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </a>
                    <ul id="users" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="activitylogs.php" class="sidebar-link">Activity Logs
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="usersaccount.php" class="sidebar-link">Users Account</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="qrcodeDesign.php" class="sidebar-link">
                    <i class="fa-solid fa-qrcode"></i>
                        <span>Item QR Generate</span>
                    </a>
                </li>
                <div class="sidebar-footer">
                    
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                <form action="#" class="d-none d-sm-inline-block">

                </form>

                <!--Top Navigation-->
                    <div class="navbar-collapse collapse d-flex align-items-center justify-content-between">
                    <span class="navbar-brand mb-0 h1 me-auto text-truncate">Sinag Kalinga Foundation Inc.</span>
                    <div class="d-flex align-items-center">
                    <?php
                $notif = "SELECT COUNT(*) as count from `user_accounts`";
                $notif_result = mysqli_query($conn, $notif);
    
                    while($row = mysqli_fetch_assoc($notif_result)){
    
                        $notif_output = $row['count'];
                    }
            ?>
                        <!-- First icon -->
                         
                        <span class="icon-container me-3">
                        <a href="admin_approval.php">
                            <i class="fa-solid fa-user-check">
                                <span class ="badge"><?php echo $notif_output; ?></span>
                            </i>
                        </a>
                        </span>
                        
                        <?php
                            $query = "SELECT item_name, expirations_date, begin_balance FROM medicine_data";
                            $result = mysqli_query($conn, $query);

                            if (!$result) {
                                die("Query failed: " . mysqli_error($conn));
                            }

                            $notifications = []; // Array to store notifications
                            $currentDate = date('Y-m-d'); // Current date

                            // Process each item for expired, nearing expiration, or low stock medicines
                            while ($row = mysqli_fetch_assoc($result)) {
                                $itemName = $row['item_name'];
                                $expirationDate = $row['expirations_date'];
                                $stock = $row['begin_balance'];

                                // Ensure expiration date is in the correct format
                                $expirationTimestamp = strtotime($expirationDate);
                                $currentTimestamp = strtotime($currentDate);

                                // Check if the item is expired or nearing expiration (7 days before expiry)
                                if ($expirationTimestamp <= $currentTimestamp) {
                                    // Skip expired items by not adding them to the notification
                                    continue;
                                } elseif ($expirationTimestamp <= strtotime("+7 days", $currentTimestamp)) {
                                    $notifications[] = "Item '$itemName' is nearing expiration on $expirationDate.";
                                }

                                // Check if stock is around 30 pieces
                                if ($stock <= 30) {
                                    $notifications[] = "Item '$itemName' has low stock: only $stock pieces remaining.";
                                }
                            }

                        // Query for residents' upcoming birthdays
                        $residentQuery = "SELECT fname, mname, lname, birthdate FROM residents_info";
                        $residentResult = mysqli_query($conn, $residentQuery);

                        if (!$residentResult) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        while ($row = mysqli_fetch_assoc($residentResult)) {
                            // Concatenate first, middle, and last names
                            $residentName = trim($row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']);
                            $birthdate = $row['birthdate'];

                            // Calculate next birthday
                            $nextBirthday = date('Y') . '-' . date('m-d', strtotime($birthdate));
                            if (strtotime($nextBirthday) < strtotime($currentDate)) {
                                $nextBirthday = (date('Y') + 1) . '-' . date('m-d', strtotime($birthdate));
                            }

                            // Check if the birthday is within 3 days
                            if (strtotime($nextBirthday) <= strtotime("+3 days") && strtotime($nextBirthday) >= strtotime($currentDate)) {
                                $formattedBirthday = date('F j, Y', strtotime($nextBirthday)); // Format the date
                                $notifications[] = "'$residentName' has a birthday on $formattedBirthday.";
                            }
                        }
                        ?>
                        <!-- Notification Icon and Popup -->
                        <span class="icon-container me-3">
                            <a href="notif.php">
                                <i class="fa-solid fa-bell"></i>
                                <span class="notify"><?php echo count($notifications); ?></span>
                            </a>
                            <!-- Notification Popup -->
                            <div class="notification-popup">
                                <ul>
                                    <?php if (count($notifications) > 0): ?>
                                        <?php foreach ($notifications as $index => $notification): ?>
                                            <li class="notification-item" data-id="<?php echo $index; ?>" onclick="markAsRead('<?php echo $index; ?>')">
                                                <?php echo $notification; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li>No notifications</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </span>

                        <!-- Avatar -->
                        <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item dropdown">
                            <div class="profile-dropdown">
                                <div onclick="toggleDropdown()" class="profile-dropdown-btn">
                                    <?php
                                    $select = mysqli_query($conn, "SELECT * FROM `user_accounts` WHERE id = '$user_id'") or die('query failed');
                                    if (mysqli_num_rows($select) > 0) {
                                        $fetch = mysqli_fetch_assoc($select);
                                    }
                                    // User Image
                                    if ($fetch['image'] == '') {
                                        echo '<img src="images/default-avatar.png">';
                                    } else {
                                        echo '<img src="uploaded_img/' . $fetch['image'] . '">';
                                    }
                                    ?>
                                    <i class='bx bx-chevron-down'></i>
                                </div>
            <div class="dropdown-menu">
                <a href="update_profile.php">Profile</a>
                <hr>
                <a href="dashboard.php?logout=<?php echo $user_id; ?>">Logout</a>
            </div>
        </div>
            </li>
        </ul>
                </div>
            </nav>
            
<div class="medicine-dashboard">
    <h1>Medicine Inventory</h1>
</div>
<div class="medsbg">
    <div class="meds">
        <div class="justifytext">
        <h3 class="medicine-title">
            Medicine
            <?php 
            $role = $_SESSION['user_role'];
            $allowed_roles = ['staff', 'admin'];
            if (in_array($role, $allowed_roles)) {
            ?>
            </h3>
          <a href="qrcodereader.php" class="btn btn-primary addmedsbtn"><b>Add Supply</b></a>
        
        
       
        <?php } ?>


        <div class="search d-flex align-items-center mb">
    <input type="text" id="medsSearch" class="form-control me" placeholder="Search..." autocomplete="off">
    <i class="fa-solid fa-magnifying-glass"></i>
    </div>
</div>

<div class="table-responsive">
    <div class="contain">
        <div class="topcontain">
            <div style="max-height: 400px; overflow-y: auto;"> <!-- Scrollable div -->
                <table class="table text-center">
                    <thead>
                        <tr class="table-danger">
                            <th>Medicines Category</th>
                            <th class="kahitano">Item Name</th>
                            <th>Item Size</th>
                            <th>Total Stock</th>
                            <?php
                            $role = $_SESSION['user_role'];
                            $allowed_roles = ['staff', 'admin'];
                            if (in_array($role, $allowed_roles)) {
                            ?>
                            <th>Donate</th>
                            <th>Use Item</th>
                            <?php } ?>
                            <th>Expiration Date</th>
                            <th>Price</th>
                            <th>Out Amount</th>
                            <th>Begin. Amount</th>
                            <?php
                                 $role = $_SESSION['user_role'];
                                $allowed_roles = ['staff', 'admin'];
                                if (in_array($role, $allowed_roles)) {
                                ?>
                            <th>Action</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                        
                        $query = "SELECT * FROM `medicine_data`"; 
                        $result = mysqli_query($conn, $query);
                        $count = 0;

                        foreach ($result as $row) {
                            if ($count >= 10) {
                                break;
                            }

                            $out_items = $row['out_items'];
                            $price = $row['price'];
                            $multiply_result = $out_items * $price;
                            $begin_balances = $row['begin_balance'];
                            $begin_balance_result = $begin_balances * $price;

                            $priceFormat = number_format($price, 2);
                            $outAmountFormat = number_format($multiply_result, 2);
                            $beginBalanceFormat = number_format($begin_balance_result, 2);

                            $today = date('Y-m-d');
                            $isExpired = $row['expirations_date'] < $today;
                        ?>
                        <tr class="<?= $isExpired ? 'table-danger' : '' ?>">
                            <td><?php echo $row['category']; ?></td>
                            <td class="kahitano"><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['item_size']; ?></td>
                            <td><?php echo $row['begin_balance']; ?></td>
                            <?php if (in_array($role, $allowed_roles)) { ?>
                            <td><?php echo $row['donate']; ?></td>
                            <td><?php echo $row['out_items']; ?></td>
                            <?php } ?>
                            <td><?php echo $row['expirations_date']; ?></td>
                            <td><?php echo "₱$priceFormat"; ?></td>
                            <td><?php echo "₱$outAmountFormat"; ?></td>
                            <td><?php echo "₱$beginBalanceFormat"; ?></td>
                            <?php
                                 $role = $_SESSION['user_role'];
                                $allowed_roles = ['staff', 'admin'];
                                if (in_array($role, $allowed_roles)) {
                                ?>
                            <td>
                                <i class="fa-solid fa-pen-to-square"
                                    onclick="sendForm('<?php echo $row['medicineID']; ?>', '<?php echo $row['item_name']; ?>', '<?php echo $row['begin_balance']; ?>', '<?php echo $row['expirations_date']; ?>', '<?php echo $row['donate']; ?>', '<?php echo $row['out_items']; ?>')"></i>
                                <a class="dlt_med" href="delete_meds.php?id=<?php echo $row['medicineID']; ?>" onclick="return confirm('Are you sure you want to delete this medicine?');"><i class="fa-solid fa-trash"></i></a>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php 
                            $count++; 
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
     function sendForm(id,name,beginBalance,m_expiredDatem_donate,m_outitems,){
                                document.getElementById("result").style.display = 'block';  
                                document.getElementById("CurrrentId").value =""+ id;
                                document.getElementById("ItemName").value = name;
                                document.getElementById("med_begin_balance").value = beginBalance;
                                document.getElementById("med_expired").value = m_expiredDate;
                                document.getElementById("med_donate").value = m_donate;
                                document.getElementById("med_outitems").value = m_outitems;

                            }

                            function hideForm() {
            document.querySelector('.medsform').style.display = 'none';
            document.querySelector('.overlay').style.display = 'none';
                            }
</script>

<div class="medsform hidden" id="result">
    <form action="edit_meds.php" class="edit-form" method="POST">
        <h3 class="mb-3 text-center">Edit Supply</h3>
        <input type="hidden" name="med_id" id="CurrrentId" value="<?php echo $row['medicineID']; ?>">
        <input type="hidden" name="medss" value="<?php echo $row['category']; ?>">
        <input type="hidden" name="prices" value="<?php echo $row['price']; ?>">

        <div class="mb-3">
            <label for="itemName" class="form-label"><b>Item Name</b></label>
            <input type="text" name="itemName" id="ItemName"  value="<?php echo $row['item_name']; ?>">
        </div>
        
        <div class="mb-3">
            <label for="bgnblnc" class="form-label"><b>Current Stock</b></label>
            <input type="text" name="bgnblnc" id="med_begin_balance">
        </div>

        <div class="mb-3">
            <label for="begin_balance" class="form-label"><b>Add Stock</b></label>
            <input type="text" name="addstock" id="med_addstock" value="0">
        </div>
        <div class="mb-3">
            <label for="expirations_date" class="form-label"><b>Expiration Date</b></label>
            <input type="text" name="expirations_date"  id="med_expired" value="<?php echo $row['expirations_date']; ?>">
        </div>

        <div class="mb-3">
            <label for="donate" class="form-label"><b>Donate</b></label>
            <input type="text" name="donate" id="med_donate" value="0">
        </div>

        <div class="mb-3">
            <label for="out_items" class="form-label"><b>Out Items</b></label>
            <input type="text" name="out_items" id="med_outitems" value="0">
        </div>
        <div class="mb-3">
            <input type="hidden" name="out_amount" value="<?php $row['out_amount']?>">
        </div>
        <div class="d-flex justify-content-between">
            <button name="update" class="btn btn-primary update-btn">Update</button>
            <button type="button" class="btn btn-secondary close-btn" onclick="hideForm()">Cancel</button>
        </div>
    </form>
</div>
    </div>
</div>



                
            <div class="totalamount">

            <?php 

             
        $add_out_amount = "SELECT SUM(out_amount) AS total_out FROM `medicine_data`";
        $result_out_amount = mysqli_query($conn, $add_out_amount);
        $output_out_amounts = 0; // Default to 0 in case of null result

        if ($result_out_amount) {
            $row = mysqli_fetch_assoc($result_out_amount);
            $output_out_amounts = $row['total_out'] ?? 0;
        } else {
            echo "Query Failed: " . mysqli_error($conn);
        }

        // Get Total Begin Amount
        $add = "SELECT SUM(begin_amount) AS total_begin FROM `medicine_data`";
        $add_result = mysqli_query($conn, $add);
        $output = 0;

        if ($add_result) {
            $row = mysqli_fetch_assoc($add_result);
            $output = $row['total_begin'] ?? 0;
        }

        // Get Total Used Items
        $add_use_items = "SELECT SUM(out_items) AS sum_items FROM `medicine_data`";
        $result_out_items = mysqli_query($conn, $add_use_items);
        $items_output = 0;

        if ($result_out_items) {
            $row = mysqli_fetch_assoc($result_out_items);
            $items_output = $row['sum_items'] ?? 0;
        }

        // Get Total Expired Medicines
        $current_date = date('Y-m-d');
        $expiredmeds = "SELECT COUNT(*) AS count_expired FROM `medicine_data` WHERE expirations_date <= '$current_date'";
        $result_expired = mysqli_query($conn, $expiredmeds);
        $expired_output = 0;

        if ($result_expired) {
            $row = mysqli_fetch_assoc($result_expired);
            $expired_output = $row['count_expired'] ?? 0;
        }

        $month = date('M Y'); // Example: February 2025

        $role = $_SESSION['user_role'] ?? '';
        $allowed_roles = ['staff', 'admin'];

        if (in_array($role, $allowed_roles)) {
        ?>
    <table class="table table-striped table-hover">
        <thead class="table-danger">
            <tr>
                <th>Category</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr class="fw-bold">
                <td><b>Total Out Amount (Month of <?php echo $month; ?>)</b></td>
                <td><b><?php echo number_format($output_out_amounts, 2); ?></b></td>
            </tr>
            <tr class="fw-bold">
                <td><b>Total Begin Amount (Month of <?php echo $month; ?>)</b></td>
                <td><b><?php echo number_format($output, 2); ?></b></td>
            </tr>
            <tr class="fw-bold">
                <td><b>Total Expired Medicines (Month of <?php echo $month; ?>)</b></td>
                <td><b><?php echo $expired_output; ?></b></td>
            </tr>
            <tr class="fw-bold">
                <td><b>Total Used for Elders (Month of <?php echo $month; ?>)</b></td>
                <td><b><?php echo $items_output; ?></b></td>
            </tr>
        </tbody>
    </table>
<?php
}
?>        
               </div>
            
                </div>  
            </div>
           
        <!-- End of Topbar -->
        
        <!-- JavaScript link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        
    <script src="script.js"></script>
    <script type="text/javascript">
                    $(document).ready(function(){
  $("#medsSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
                </script>
</body>
</html>