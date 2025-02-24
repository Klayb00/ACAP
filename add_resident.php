<?php
//Php connect
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST["submit"])){

    $fname = $_POST["fname"];
    $mname = $_POST["mname"];
    $lname = $_POST["lname"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $birthdate = $_POST["bdate"];
    $dateofsubmitted = $_POST["dateadd"];
    $address = $_POST["address"];
    $fam = $_POST["family"];
    $f_status = $_POST["status"];
    
    // Handle the image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = $_FILES['image']['type'];
        
        // Define the upload directory
        $uploadDir = '';
        $imagePath = $uploadDir . basename($imageName);
        
        // Move the uploaded file to the upload directory
        if(move_uploaded_file($imageTmpName, $imagePath)){
            // File uploaded successfully
        } else {
            // Handle the error
            echo '<div class="alert alert-danger" role="alert">
                    Failed to upload image.
                  </div>';
            exit();
        }
    } else {
        // If no image is uploaded, use a default image
        $imagePath = 'images/default-avatar.png'; // Path to your default image
    }

    $mobilityy = $_POST["mobility"];
    $vaccine = $_POST["vaccine"];
    $vaccines = "";
    foreach($vaccine as $row){
        $vaccines .= $row . ",";
    }

    $disease = $_POST["disease"];
    $diseases = "";
    foreach($disease as $row){
        $diseases .= $row . ",";
    }

    if(isset($_POST["highblood"])){
        $highblood = $_POST["highblood"];
    } else {
        $highblood = 'false';
    }

    if(isset($_POST["cholesterols"])){
        $cholesterol = $_POST["cholesterols"];
    } else {
        $cholesterol = 'false';
    }

    if(isset($_POST["alzheimer"])){
        $alzhei = $_POST["alzheimer"];
    } else {
        $alzhei = 'false';
    }

    $vitamins = $_POST["vitamins"];
    $others = $_POST["others"];
    $fam_name = $_POST["haveFam"];
    $fam_contact = $_POST["contactNum"];

    $combineMeds = $highblood . ' ' . $cholesterol . ' ' . $alzhei . ' ' . $others;

    // Insert data into database
    $query = "INSERT INTO residents_info (fname, mname, lname, age, gender, birthdate, dateofsubmitted, family, fam_name, fam_contact, address, image, mobility, vaccine, disease, highblood, cholesterol, alzhei, vitamins, others, status)
              VALUES ('$fname', '$mname', '$lname', '$age', '$gender', '$birthdate', '$dateofsubmitted', '$fam', '$fam_name', '$fam_contact', '$address', '$imagePath', '$mobilityy', '$vaccines', '$diseases', '$highblood', '$cholesterol', '$alzhei', '$vitamins', '$others', '$f_status')";

    if (mysqli_query($conn, $query)) {
        // Success message with Bootstrap alert
        echo '<div class="alert alert-success" role="alert">
                Resident successfully added!
              </div>';
        
        // Pause to display the alert before redirection
        sleep(2); // 2-second delay
        header('Location: resident.php');
        exit();
    } else {
        // Error message with Bootstrap alert
        echo '<div class="alert alert-danger" role="alert">
                Failed to add resident. Please try again.
              </div>';
    }
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="500; url=index.php">
    <title>Document</title>

    <script src="https://kit.fontawesome.com/5ad3914b72.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
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
            <div class="container mt-4">
        <div class="add">
            <form method="POST" enctype="multipart/form-data">
                <!-- Personal Data Section -->
                <h3>Personal Data</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <label>First Name:</label>
                        <input type="text" name="fname" placeholder="First Name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Middle Name:</label>
                        <input type="text" name="mname" placeholder="Middle Name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Last Name:</label>
                        <input type="text" name="lname" placeholder="Last Name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Birthdate:</label>
                        <input type="date" name="bdate" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Age:</label>
                        <input type="number" name="age" placeholder="Age" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Gender:</label><br>
                        <input type="radio" name="gender" value="Male" required> Male
                        <input type="radio" name="gender" value="Female" required> Female
                    </div>
                    <div class="col-md-4">
                        <label>Date Admitted:</label>
                        <input type="date" name="dateadd" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Have Family?</label><br>
                        <input type="radio" name="family" value="Have" onclick="categoryDropdown('haveFam')" required> Have
                        <input type="radio" name="family" value="None" onclick="categoryDropdown('')" required> None
                    </div>
                    <div class="col-md-4">
                        <label>Resident Status:</label><br>
                        <input type="radio" name="status" value="Active"> Active
                        <input type="radio" name="status" value="Deceased"> Deceased
                    </div>
                </div>
                    <br>
                    <div id="haveFam" class="dropdowns mb-3">
                        <h3>Family Contact Information</h3>
                        <hr>
                        <label>Family Name:</label>
                        <input type="text" name="haveFam" placeholder="Family Name" class="form-control">
                        <label>Contact Number:</label>
                        <input type="text" name="contactNum" placeholder="Contact Number" class="form-control">
                    </div>
                <!-- Place of Origin Section -->
                <h3>Place of Origin</h3>
                <hr>
                <div class="mb-3">
                    <label>Complete Address:</label>
                    <input type="text" name="address" placeholder="Barangay/City" class="form-control" required>
                </div>

                <!-- Upload Photo Section -->
                <h3>Upload Resident Photo</h3>
                <hr>
                <div class="mb-3">
                    <label>Image:</label>
                    <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png">
                </div>

                <!-- Vaccination Section -->
                <h3>Vaccinated</h3>
                <hr>
                <div class="mb-3" onclick="isChecked()">
                    <input type="checkbox" name="vaccine[]" value="Covid 19"> COVID 19
                    <input type="checkbox" name="vaccine[]" value="Pneumococcal"> Pneumococcal
                    <input type="checkbox" name="vaccine[]" value="Influenza"> Influenza
                </div>

                <!-- Mobility Section -->
                <h3>Mobility</h3>
                <hr>
                <div class="mb-3">
                    <input type="radio" name="mobility" value="Bedridden" required> Bedridden
                    <input type="radio" name="mobility" value="Able but w/ minimal assistance" required> Able but w/ minimal assistance
                    <input type="radio" name="mobility" value="Able / independent" required> Able / independent
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
                     <label>Others:</label>
                    <input type="text" name="disease[]" placeholder="Please Specify" class="form-control">
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
                    <label>Others:</label>
                    <input type="text" name="others" placeholder="Specify Others Medicine" class="form-control">
                </div>

                <!-- Submit Buttons -->
                <div class="btn-container mt-3">
                    <button type="submit" name="submit" class="btn add_btn">Add</button>
                    <button type="reset" name="cancel" class="btn cancel_btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script>
        function categoryDropdown(id) {
      // Hide all dropdowns first
      const dropdowns = document.querySelectorAll('.dropdowns');
      dropdowns.forEach(dropdown => dropdown.style.display = 'none');

      // Show the selected dropdown if a radio button is clicked
      const selectedDropdown = document.getElementById(id);
      if (selectedDropdown) {
        selectedDropdown.style.display = 'block';
      }
    }
    window.onload = function() {
      const selectedRadio = document.querySelector('input[name="perspective"]:checked');
      if (selectedRadio) {
        toggleDropdown(selectedRadio.value);
      } else {
        // Ensure all dropdowns are hidden if no radio is selected initially
        const dropdowns = document.querySelectorAll('.dropdowns');
        dropdowns.forEach(dropdown => dropdown.style.display = 'none');
      }
    }
    </script>
</body>
</html>