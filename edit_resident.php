<?php
//Php connect
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$id = $_GET['id'];
if (isset($_POST["submit"])) {

    // Get form input values
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $mname = mysqli_real_escape_string($conn, $_POST["mname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $age = mysqli_real_escape_string($conn, $_POST["age"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $birthdate = mysqli_real_escape_string($conn, $_POST["bdate"]);
    $dateofsubmitted = mysqli_real_escape_string($conn, $_POST["dateadd"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $f_status = mysqli_real_escape_string($conn, $_POST["status"]); // Resident status

    $mobilityy = mysqli_real_escape_string($conn, $_POST["mobility"]);
    $vaccine = $_POST["vaccine"];
    $vaccines = implode(",", $vaccine); // Using implode to join array elements into a string

    // Check if the 'disease' array is set and if it has any selected values
    $disease = isset($_POST['disease']) ? $_POST['disease'] : array();  // If not set, use an empty array
    $diseases = implode(",", $disease); // Using implode for diseases

    // Set health conditions
    $highblood = isset($_POST["highblood"]) ? mysqli_real_escape_string($conn, $_POST["highblood"]) : 'false';
    $cholesterol = isset($_POST["cholesterols"]) ? mysqli_real_escape_string($conn, $_POST["cholesterols"]) : 'false';
    $alzhei = isset($_POST["alzheimer"]) ? mysqli_real_escape_string($conn, $_POST["alzheimer"]) : 'false';

    $vitamins = mysqli_real_escape_string($conn, $_POST["vitamins"]);
    $others = mysqli_real_escape_string($conn, $_POST["others"]);

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = $_FILES['image']['type'];

        // Define the upload directory
        $uploadDir = '';
        $imagePath = $uploadDir . basename($imageName);

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            // File uploaded successfully
        } else {
            // Handle error during upload
            echo '<div class="alert alert-danger" role="alert">
                    Failed to upload image.
                  </div>';
            exit();
        }
    } else {
        // If no image is uploaded, use a default image
        $imagePath = 'uploaded_img/default-image.png'; // Path to your default image
    }

    // Update resident information in the database
    $query = "UPDATE `residents_info` SET 
                `fname`='$fname', `mname`='$mname', `lname`='$lname', `age`='$age', `gender`='$gender', 
                `birthdate`='$birthdate', `dateofsubmitted`='$dateofsubmitted', `address`='$address', 
                `image`='$imagePath', `mobility`='$mobilityy', `vaccine`='$vaccines', `disease`='$diseases', 
                `highblood`='$highblood', `cholesterol`='$cholesterol', `alzhei`='$alzhei', `vitamins`='$vitamins', 
                `others`='$others', `status`='$f_status' WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        // Success message
        echo '<div class="alert alert-success" role="alert">
                Resident information updated successfully!
              </div>';
        
        // Redirect to the residents page after a short delay
        sleep(2); // 2-second delay
        header('location: resident.php');
        exit();
    } else {
        // Error message
        echo '<div class="alert alert-danger" role="alert">
                Failed to update resident information. Please try again.
              </div>';
    }

    // Check if the resident exists and update status to "Deceased" if necessary
    $checkResident = mysqli_query($conn, "SELECT * FROM residents_info WHERE id = $id");
    if (mysqli_num_rows($checkResident) > 0) {
        if ($f_status == 'Deceased') {
            $updateQuery = "UPDATE residents_info SET status = 'Deceased' WHERE id = $id";
            if (mysqli_query($conn, $updateQuery)) {
                echo "Resident's status updated to 'Deceased'! Condolences!!";
            } else {
                echo "Error updating status: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Resident not found in the database.";
    }
}


if(isset($_POST["cancel"])){
    header('location:resident.php');
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="500; url=index.php">
    <title>Sinag Kalinga Foundation Inc.</title>

    <script src="https://kit.fontawesome.com/5ad3914b72.js" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/visitorform.css">
    <link rel="stylesheet" href="Css/addresidents.css">
</head>
<body>
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
                                
                                $sql = "SELECT * FROM `residents_info` WHERE id = $id";
                                $resultt = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($resultt);
                            ?>

            <div class="container mt-4">
        <div class="add">
            <form method="POST" enctype="multipart/form-data">
                <!-- Personal Data Section -->
                <h3>Personal Data</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <label>First Name:</label>
                        <input type="text" name="fname" class="form-control" value="<?php echo $row['fname']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Middle Name:</label>
                        <input type="text" name="mname" class="form-control" value="<?php echo $row['mname']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Last Name:</label>
                        <input type="text" name="lname" class="form-control" value="<?php echo $row['lname']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Birthdate:</label>
                        <input type="text" name="bdate" class="form-control" value="<?php echo $row['birthdate']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Age:</label>
                        <input type="number" name="age"  class="form-control" value="<?php echo $row['age']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Gender:</label><br>
                        <input type="text" name="gender" class="form-control" value="<?php echo $row['gender']; ?>">
                        
                    </div>
                    <div class="col-md-4">
                        <label>Date Admitted:</label>
                        <input type="date" name="dateadd" class="form-control" value="<?php echo $row['dateofsubmitted']; ?>">
                    </div>
                    <div class="col-md-4">
                    <label>Resident Status:</label><br>
                    <input type="radio" name="status" value="Deceased" <?php echo ($row['status'] == 'Deceased') ? 'checked' : ''; ?>> Deceased
                    <input type="radio" name="status" value="Alive" <?php echo ($row['status'] == 'Alive' || $row['status'] == '') ? 'checked' : ''; ?>> Alive
                </div>

                </div>

                <!-- Place of Origin Section -->
                <h3>Place of Origin</h3>
                <hr>
                <div class="mb-3">
                    <label>Complete Address:</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
                </div>

                <!-- Upload Photo Section -->
                <h3>Upload Resident Photo</h3>
                <hr>
                <div class="mb-3">
                    <label>Image:</label>
                    <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png" value="<?php echo $row['image']; ?>">
                </div>

                <!-- Vaccination Section -->
                <h3>Vaccinated</h3>
                <hr>
                <div class="mb-3">
                    <input type="checkbox" name="vaccine[]" value="Covid 19"> COVID 19
                    <br>
                    <input type="checkbox" name="vaccine[]" value="Pneumococcal"> Pneumococcal
                    <br>
                    <input type="checkbox" name="vaccine[]" value="Influenza"> Influenza
                    <br>
                    <input type="text" class="form-control" name="vaccine[]">
                </div>

                <!-- Mobility Section -->
                <h3>Mobility</h3>
                <hr>
                <div class="mb-3">
                <input type="text" name="mobility" class="form-control" value="<?php echo $row['mobility']; ?>">   
                </div>

                <!-- Diseases Section -->
                <h3>Diseases</h3>
                <hr>
                <div class="mb-3">
                    <input type="checkbox" name="disease[]" value="Highblood" onclick="Enabledd2(this)"> Highblood
                    <br>
                    <input type="checkbox" name="disease[]" value="Cholesterol" onclick="Enabledd3(this)"> Cholesterol
                    <br>
                    <input type="checkbox" name="disease[]" value="Alzheimer Disease" onclick="Enabledd4(this)"> Alzheimer Disease
                    <br>
                    <input type="checkbox" id="chckdisease" onclick="Enabledd1(this)"> Others
                    <br>
                    <input type="text" id="DISEASES" name="disease[]" placeholder="Please Specify" class="form-control" disabled>
                </div>

                <!-- Medications Section -->
                <h3>Medications</h3>
                <hr>
                <div class="mb-3">
                    <label>Highblood Medicine:</label>
                    <input type="text" id="HIGH" name="highblood" placeholder="Medicine for HPN" class="form-control" disabled>
                        <!-- Populate from database -->
                    <label>Cholesterol Medicine:</label>
                    <input type="text" id="CHOLES" name="cholesterols" placeholder="Medicine for Cholesterol" class="form-control" disabled>
                        <!-- Populate from database -->
                    <label>Alzheimer Medicine:</label>
                    <input type="text" id="ALZHEI" name="alzheimer" placeholder="Medicine for Alzheimer" class="form-control" disabled>
                        <!-- Populate from database -->
                    <label>Vitamins:</label>
                    <input type="text" name="vitamins" placeholder="Vitamins" class="form-control">
                </div>

                <!-- Submit Buttons -->
                <div class="btn-container mt-3">
                    <button type="submit" name="submit" class="btn add_btn">Update</button>
                    <button type="reset" name="cancel" class="btn cancel_btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>