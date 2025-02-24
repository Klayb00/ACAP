<?php
//Php connect
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

//Php User Sign out
if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
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
    <style>

        .container {
            background:rgba(255, 255, 255, 0.03);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            margin-top: 5%;
            max-width: 400px;
        }

        h1 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .form-control{
            width: calc(100% - 40px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
       
        .btn{
            background: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }


        .qr-code {
            margin-top: 20px;
            padding: 10px;
            border: 1px dashed #ccc;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f9f9f9;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .dropdowns{
            display: none;
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.2rem;
            }

            button {
                padding: 8px 10px;
                font-size: 0.9rem;
            }
        }
    </style>
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
            <div class="container">
    <h1>QR Code Item Generator</h1>
        <label>Inventory Category</label>
        <br>
        <input type="radio" name="inventorycategory" value="Medicine" onclick="categoryDropdown('categoryInput')"> Medicine
        <br>
        <input type="radio" name="inventorycategory" value="Medical" onclick="categoryDropdown('medicaldropdown')"> Medical Assets
        <br>
        <input type="radio" name="inventorycategory" value="Foods & Utilities" onclick="categoryDropdown('foodsdropdown')"> Foods and Utilities
        <br>
        <br>
        <div  id="categoryInput" class="dropdowns">
    <select id="categoryInput" class="form-control" required>
        <option disabled selected>Select Category For Medicine</option>
        <option value="Vitamins">Vitamins</option>
        <option value="Alzheimer">Alzheimer</option>
        <option value="ANTI-HPN">ANTI-HPN</option>
        <option value="Antibiotic">Antibiotic</option>
        <option value="Anti-Estrogens">Anti-Estrogens</option>
        <option value="Anti-Fibrinolytic">ANTI-FIBRINOLYTIC</option>
        <option value="Pain-Reliever">Pain Reliever</option>
        <option value="Cough">For Cough</option>
        <option value="Anti-Ischemic">Anti-Ischemic</option>
        <option value="Flu">For Flu</option>
        <option value="Inflammatory">Anti-Inflammatory</option>
        <option value="Histamine">Anti-Histamine</option>
        <option value="OHA/Anti-Hyperlipidemic">Hyperlipidemic</option>
        <option value="Bronchodilators">Bronchodilators</option>
        <option value="Antacid">Antacid</option>
        <option value="Diarrheal">Anti-Diarrheal</option>
        <option value="Others">Others</option>
    </select>
    </div>
    <div id="foodsdropdown" class="dropdowns">
      <select name="foodsdropdown" class="form-control" required>
        <option disabled selected>Select Foods & Utilities Category</option>
        <option value="Powered Drinks">Powered Drinks</option>
        <option value="Drinks">Drinks</option>
        <option value="Assorted Bread">Assorted Bread</option>
        <option value="Cerial/OAT Meal">Cerial/OAT Meal</option>
        <option value="Canned Goods">Canned Goods</option>
        <option value="Pasta/Noodles/Canton">Pasta/Noodles/Canton</option>
        <option value="Seasonings">Seasonings</option>
        <option value="Rice">Rice</option>
        <option value="Liquid">Liquid</option>
        <option value="Utensils/Plates/Trays">Utensils/Plates/Trays</option>
        <option value="Others">Others</option>
      </select>
    </div>
    <input type="text" id="textInput" class="form-control" placeholder="Enter text to generate QR code" required>
    <input type="text" id="sizeInput" class="form-control" placeholder="Enter item size (mg/grams/etc.)">

    <div id="medicaldropdown" class="dropdowns">
      <select name="medicaldropdown" class="form-control">
        <option>Select Medical Assets Status</option>
        <option value="Good">Good</option>
        <option value="Repair">Repair</option>
        <option value="Trash">Trash</option>
      </select>
    </div>

<br>    
    <button class="btn" onclick="generateQRCode()">Generate QR Code</button>
    <div class="qr-code" id="qrCodeContainer"></div>

    <a id="downloadLink" style="display:none;" download="qrcode.png">Download QR Code</a>

    <!-- Include QRCode.js Library -->
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script>
    function generateQRCode() {
        const textInput = document.getElementById('textInput').value.trim();
        const sizeInput = document.getElementById('sizeInput').value.trim();
        const qrCodeContainer = document.getElementById('qrCodeContainer');
        const downloadLink = document.getElementById('downloadLink');

        // Get selected inventory category (radio button)
        const selectedCategory = document.querySelector('input[name="inventorycategory"]:checked');
        if (!selectedCategory) {
            qrCodeContainer.innerHTML = '<p style="color: red;">Please select an inventory category!</p>';
            return;
        }

        let category = selectedCategory.value; // Default category is from the radio button

        // Update the category based on the dropdown value for specific categories
        let dropdownValue = null;
        if (category === "Medicine") {
            dropdownValue = document.querySelector('#categoryInput select').value; // Select from Medicine dropdown
        } else if (category === "Medical") {
            dropdownValue = document.querySelector('#medicaldropdown select').value; // Select from Medical dropdown
        } else if (category === "Foods & Utilities") {
            dropdownValue = document.querySelector('#foodsdropdown select').value; // Select from Foods dropdown
        }

        // Validate dropdown selection if dropdownValue is being used
        if (dropdownValue && dropdownValue.includes("Select")) {
            qrCodeContainer.innerHTML = `<p style="color: red;">Please select a valid category for ${category}!</p>`;
            return;
        }

        // Assign the dropdown value to the category if applicable
        if (dropdownValue) {
            category = dropdownValue; // Override the radio button value with the dropdown value
        }

        // Validate the text input
        if (!textInput) {
            qrCodeContainer.innerHTML = '<p style="color: red;">Please enter text to generate the QR code!</p>';
            return;
        }

        // Create JSON data for the QR code
        const qrData = {
            text: textInput,
            category: category,
            size: sizeInput || "N/A"
        };

        // Convert data to a JSON string
        const jsonData = JSON.stringify(qrData);

        // Clear previous QR code
        qrCodeContainer.innerHTML = "";

        // Generate QR code using QRCode.js
        QRCode.toCanvas(jsonData, { width: 150, margin: 2 }, (error, canvas) => {
            if (error) {
                qrCodeContainer.innerHTML = `<p style="color: red;">Failed to generate QR code!</p>`;
                return;
            }

            // Add QR code to the container
            qrCodeContainer.appendChild(canvas);

            // Convert canvas to a data URL for downloading
            const qrCodeUrl = canvas.toDataURL("image/png");
            downloadLink.href = qrCodeUrl;

            // Set the file name dynamically based on the text input
            const fileName = textInput.replace(/[^a-zA-Z0-9]/g, '_'); // Replace invalid characters
            downloadLink.download = `${fileName}_QRCode.png`;

            downloadLink.style.display = 'inline'; // Show the download link
        });
    }
</script>

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

    // Optionally, make sure dropdowns are hidden if no radio button is selected
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
