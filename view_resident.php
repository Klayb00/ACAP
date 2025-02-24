<?php
//Php connect
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="500; url=index.php">
    <title>Sinag Kalinga Foundation Inc.</title>
    <!-- CSS link -->
    <link rel="stylesheet" type="text/css" href="Css/view_resident.css">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/5ad3914b72.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/dashboard-values.css">
    
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


                            <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM `residents_info` WHERE id = $id LIMIT 1";
                                $resultt = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($resultt);
                                

                                        
                                
?>

<div class="container mt-4">
    <div class="card shadow-lg border-primary">
        <div class="card-header bg-primary text-white text-center">
            <div class="position-relative">
                <h5 class="mb-0">Sinag Kalinga Foundation Inc.</h5>
                <img src="images/logo new.png" alt="Logo" class="logo img-fluid mt-2" style="max-height: 50px;">
                <a href="resident.php" class="btn-close position-absolute end-0 top-0 m-2" aria-label="Close"></a>
            </div>
        </div>

        <!-- Personal Data Section -->
        <div class="card-body">
            <h6 class="text-primary text-uppercase mb-3">Personal Data</h6>
            <div class="row mb-3">
                <!-- Full Name -->
                <div class="col-md-6">
                    <label class="form-label"><strong>Full Name</strong></label>
                    <input type="text" class="form-control bg-light" value="<?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?>" disabled>
                </div>
                <!-- Resident Image -->
                <div class="col-md-6 text-center">
                    <?php
                    $select = mysqli_query($conn, "SELECT image FROM residents_info WHERE id = $id");
                    if (mysqli_num_rows($select) > 0) {
                        $fetch = mysqli_fetch_assoc($select);
                        if (!empty($fetch['image'])) {
                            echo '<img src="uploaded_img/' . $fetch['image'] . '" alt="Resident Image" class="img-fluid rounded" style="max-width: 120px;">';
                        } else {
                            echo '<img src="uploaded_img/default-avatar.png" alt="Default Avatar" class="img-fluid rounded" style="max-width: 120px;">';
                        }
                    } else {
                        echo '<img src="uploaded_img/default-avatar.png" alt="Default Avatar" class="img-fluid rounded" style="max-width: 120px;">';
                    }
                    ?>
                </div>
            </div>

            <!-- Additional Data -->
            <div class="row mb-3">
                <!-- Place of Origin -->
                <div class="col-md-6">
                    <label class="form-label"><strong>Place of Origin</strong></label>
                    <input type="text" class="form-control bg-light" value="<?php echo $row['address']; ?>" disabled>
                </div>
                <!-- Date of Birth -->
                <div class="col-md-6">
                    <label class="form-label"><strong>Date of Birth</strong></label>
                    <input type="text" class="form-control bg-light" value="<?php echo $row['birthdate']; ?>" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Date Admitted -->
                <div class="col-md-6">
                    <label class="form-label"><strong>Date Admitted</strong></label>
                    <input type="text" class="form-control bg-light" value="<?php echo $row['dateofsubmitted']; ?>" disabled>
                </div>
                <!-- Age -->
                <div class="col-md-3">
                    <label class="form-label"><strong>Age</strong></label>
                    <input type="text" class="form-control bg-light" value="<?php echo $row['age']; ?>" disabled>
                </div>
                <!-- Gender -->
                <div class="col-md-3">
                    <label class="form-label"><strong>Gender</strong></label>
                    <input type="text" class="form-control bg-light" value="<?php echo $row['gender']; ?>" disabled>
                </div>
            </div>
        </div>

        <div class="card-body">
            <h6 class="text-primary text-uppercase mb-3">Family Information</h6>
            <label class="form-label"><strong>Family/Guardian Name</strong></label>
            <input type="text" class="form-control bg-light" name="haveFam" value="<?php echo $row['fam_name']; ?>" disabled>
            <br>
            <label class="form-label"><strong>Contact Number</strong></label>
               <input type="text" class="form-control bg-light" name="contactNum" value="<?php echo $row['fam_contact']; ?>" disabled>
        </div>
        <!-- Vaccinated Section -->
        <div class="card-body">
            <h6 class="text-primary text-uppercase mb-3">Vaccinated</h6>
            <input type="text" class="form-control bg-light" name="vaccine" value="<?php echo $row['vaccine']; ?>" disabled>
        </div>

        <!-- Mobility Section -->
        <div class="card-body">
            <h6 class="text-primary text-uppercase mb-3">Mobility</h6>
            <label class="form-label"><strong>Mobility</strong></label>
            <input type="text" class="form-control bg-light" name="mobility" value="<?php echo $row['mobility']; ?>" disabled>
        </div>

        <!-- Disease Section -->
        <div class="card-body">
            <h6 class="text-primary text-uppercase mb-3">Disease</h6>
           <input type="text" class="form-control bg-light" name="disease[]" value="<?php echo $row['disease']; ?>" disabled>
        </div>

        <!-- Medications Section -->
        <div class="card-body">
            <h6 class="text-primary text-uppercase mb-3">Medications</h6>
            <label class="form-label"><strong>Highblood Medicine:</strong></label>
            <input type="text" class="form-control bg-light mb-2" value="<?php echo $row['highblood']; ?>" disabled>
            <label class="form-label"><strong>Cholesterol Medicine:</strong></label>
            <input type="text" class="form-control bg-light mb-2" value="<?php echo $row['cholesterol']; ?>" disabled>
            <label class="form-label"><strong>Alzheimer Medicine:</strong></label>
            <input type="text" class="form-control bg-light mb-2" value="<?php echo $row['alzhei']; ?>" disabled>
            <label class="form-label"><strong>Vitamins:</strong></label>
            <input type="text" class="form-control bg-light" value="<?php echo $row['vitamins']; ?>" disabled>
            <label class="form-label"><strong>Others:</strong></label>
            <input type="text" class="form-control bg-light" value="<?php echo $row['others']; ?>" disabled>
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
</body>
</html>