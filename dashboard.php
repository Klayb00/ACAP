<?php
//Php connect
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
};

//Php User Sign out
if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="500; url=index.php">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/5ad3914b72.js" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/dashboard-values.css">

<style>
    .values{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    min-height: 100px;
    
}
.values .values-box{
    border: 2px solid #23d369;
    width: 250px;
    display: flex;
    height: 100px;
    flex: start;
    max-width: 280px;
    flex-grow: 1;
    border-left: 8px solid #23d369;
    border-radius: 10px;

}
.values .values-box .values-logo{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    
}
.values .values-box .values-logo i{
    background-color: #23d369;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
}
.values .values-box .values-dashboard-info{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 10px;
}
.values .values-box .values-dashboard-info span{
    color: #23d369;
    font-size: 20px;
    
}
.values-box .values-dashboard-info h3{
    font-size: 30px;
}


    /*border nth child*/
    .values .values-box:nth-child(1){
        border: 2px solid #23d369;
        border-left: 5px solid #23d369;
        border-radius: 10px;
    }
    
    .values .values-box:nth-child(2){
        border: 2px solid #E79A27;
        border-left: 5px solid #E79A27;
        border-radius: 10px;
    }
    
    .values .values-box:nth-child(3){
        border: 2px solid #148DFC;
        border-left: 5px solid #148DFC;
        border-radius: 10px;
    }
    
    .values .values-box:nth-child(4){
        border: 2px solid #D323C2;
        border-left: 5px solid #D323C2;
        border-radius: 10px;
    }
    
    .values .values-box:nth-child(5){
        border: 2px solid #D3CC23;
        border-left: 5px solid #D3CC23;
        border-radius: 10px;
    }

    .values .values-box:nth-child(1) i{
        background: #23d369;
     }
     
     .values .values-box:nth-child(2) i{
         background: #E79A27;
      }
     
      .values .values-box:nth-child(3) i{
         background: #148DFC;
      }
     
      .values .values-box:nth-child(4) i{
         background: #D323C2;
      }
     
      .values .values-box:nth-child(5) i{
         background: #D3CC23;
      }
      .values .values-box:nth-child(1) span{
        color: #23d369;
    }
    .values .values-box:nth-child(2) span{
        color: #E79A27
    }
    .values .values-box:nth-child(3) span{
        color:  #148DFC;
    }
    .values .values-box:nth-child(4) span{
        color: #D323C2;
    }
    .values .values-box:nth-child(5) span{
        color: #D3CC23;
    }

    .graph-container{
        box-shadow: 0 2px 5px rgba(255, 0, 0, 0.3);
        border-radius: 10px;
    }
    canvas{
       
    }
    .chart-controls{
        padding-left: 10px;
    }

    </style>
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
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">Dashboard</h3>
                        <!--Dashboard Values-->
                        <div class="values">
                        <?php

                            $querys = "SELECT COUNT(*) AS count FROM `residents_info`";
                            $query_result = mysqli_query($conn, $querys);

                                    while($row = mysqli_fetch_assoc($query_result))
                                    {
                                        $outputs = $row['count'];
                                    }

                            $query = "SELECT COUNT(*) AS count FROM `medicine_data`";
                            $query_result = mysqli_query($conn, $query);

                                    while($row = mysqli_fetch_assoc($query_result))
                                    {
                                       $output = $row['count'];
                                    }
                            $medical_query = "SELECT COUNT(*) AS count FROM `medical_inventory`";
                            $medical_query_result = mysqli_query($conn, $medical_query);

                                    while($row = mysqli_fetch_assoc($medical_query_result))
                                    {
                                       $medical_output = $row['count'];
                                    }

                            $visitors_query = "SELECT COUNT(*) AS count FROM `visitors_data`";
                            $visitors_query_result = mysqli_query($conn, $visitors_query);

                                    while($row = mysqli_fetch_assoc($visitors_query_result))
                                    {
                                       $visitors_output = $row['count'];
                                    }
                            $foods_query = "SELECT COUNT(*) AS count FROM `foodsutilities_inventory`";
                            $foods_query_result = mysqli_query($conn, $foods_query);

                                    while($row = mysqli_fetch_assoc($foods_query_result))
                                    {
                                       $foods_output = $row['count'];
                                    }
                        ?>
                <div class="values-box">
                    <div class="values-logo">
                        <i class="fa-solid fa-people-roof"></i>
                    </div>
                    <div class="values-dashboard-info">
                        <span>Residents</span>
                        <h3><?php echo $outputs; ?></h3>
                    </div>
                </div>
                <div class="values-box">
                    <div class="values-logo">
                        <i class="fa-solid fa-people-carry-box"></i>
                    </div>
                    <div class="values-dashboard-info">
                        <span>Visitors</span>
                        <h3><?php echo $visitors_output ?></h3>
                    </div>
                </div>
                <div class="values-box">
                    <div class="values-logo">
                        <i class="fa-solid fa-suitcase-medical"></i>
                    </div>
                    <div class="values-dashboard-info">
                        <span>Medical</span>
                        <h3><?php echo $medical_output ?></h3>
                    </div>
                </div>
                <div class="values-box">
                    <div class="values-logo">
                        <i class="fa-solid fa-pills"></i>
                    </div>
                    <div class="values-dashboard-info">
                        <span>Medicine</span>
                        <h3><?php echo $output; ?></h3>
                    </div>
                </div>
                <div class="values-box">
                    <div class="values-logo">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <div class="values-dashboard-info">
                        <span>Foods & Utilities</span>
                        <h3><?php echo $foods_output ?></h3>
                    </div>
                </div>
            </div>

            
        
           <br>
           <br>
           <div class="graph-container">
    <div class="chart-controls">
        <br>
        <label for="time-period-1">Select Time Period for Medicine Data:</label>
        <select id="time-period-1">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
        </select>
    </div>
    <hr>
    <canvas id="medicineChart" width="700" height="100"></canvas>
</div>
<br>
<div class="graph-container">
    <div class="chart-controls">
        <br>
        <label for="time-period-2">Select Time Period for Medical Data:</label>
        <select id="time-period-2">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
        </select>
    </div>
    <hr>
    <canvas id="anotherChart" width="700" height="100"></canvas>
</div>
<br>
<div class="graph-container">
    <div class="chart-controls">
        <br>
        <label for="time-period-3">Select Time Period for Medicine Data:</label>
        <select id="time-period-3">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
        </select>
    </div>
    <hr>
    <canvas id="foodsChart" width="700" height="100"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        document.addEventListener('DOMContentLoaded', () => {
            setupChart("medicineChart", "time-period-1", "fetch_data.php");
            setupChart("anotherChart", "time-period-2", "fetch_data_medical.php");
            setupChart("foodsChart", "time-period-3", "fetch_data_foodsandutilities.php");
        });

        function setupChart(canvasId, selectId, fetchUrl) {
            const timePeriodSelect = document.getElementById(selectId);
            const ctx = document.getElementById(canvasId).getContext('2d');
            let chart;

            const fetchAndRenderChart = (period = 'daily') => {
                fetch(`${fetchUrl}?period=${period}`)
            .then(response => response.json())
            .then(data => {
                const labelsSet = new Set();
                const datasets = [];

                for (const itemName in data) {
                    data[itemName].forEach(item => labelsSet.add(item.label));
                }

                const labels = [...labelsSet].sort((a, b) => customSort(a, b, period));

                for (const itemName in data) {
                    const itemData = data[itemName];
                    const itemMap = new Map(itemData.map(item => [item.label, item.total_out]));
                    const totalOutValues = labels.map(label => itemMap.get(label) || 0);

                    const color = getRandomColor(itemName);

                    datasets.push({
                        label: itemName,
                        data: totalOutValues,
                        backgroundColor: color,
                        borderColor: color,
                        borderWidth: 1
                    });
                }

                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            })
            .catch(error => console.error(`Error fetching data for ${canvasId}:`, error));
    };

    function customSort(a, b, period) {
        if (period === "daily") {
            return new Date(a) - new Date(b);
        } else if (period === "weekly") {
            const [yearA, weekA] = a.split('-').map(Number);
            const [yearB, weekB] = b.split('-').map(Number);
            return yearA !== yearB ? yearA - yearB : (weekA || 0) - (weekB || 0);
        } else if (period === "monthly") {
            const [yearA, monthA] = a.split('-').map(Number);
            const [yearB, monthB] = b.split('-').map(Number);
            return yearA !== yearB ? yearA - yearB : (monthA || 0) - (monthB || 0);
        }
        return 0;
    }

    function getRandomColor(name) {
        let hash = 0;
        for (let i = 0; i < name.length; i++) {
            hash = name.charCodeAt(i) + ((hash << 5) - hash);
        }
        const r = (hash >> 16) & 255;
        const g = (hash >> 8) & 255;
        const b = hash & 255;
        return `rgba(${r}, ${g}, ${b}, 0.7)`;
    }

    fetchAndRenderChart();
    timePeriodSelect.addEventListener('change', (e) => {
        fetchAndRenderChart(e.target.value);
    });
}
</script>


<br>
            <br>
                  <!--column 2 - row 4--> 
            <div class="inventory-table">
                <div class="visitor-data">
                    <h3>Visitors this weekend</h3>
                    <table class="table table-striped">
                        <thead class="table-secondary">
                            <tr>
                                <th>Leader name</th>
                                <th>Contact #</th>
                                <th>Email Address</th>
                                <th>Purpose</th>
                                <th>Date/Time</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $selectVisitorData = ("SELECT * FROM `visitors_data` ORDER BY rand() LIMIT 14");
                            $resultVisitorData = mysqli_query($conn, $selectVisitorData);
                            
                            while($row = mysqli_fetch_assoc($resultVisitorData))
                            {
                        ?>
                                <tr>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['contact'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['purpose'];?></td>
                                    <td><?php echo $row['date_time'];?></td>
                                </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                
                
          
        </div>   
        
</main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script>
// AJAX to mark notification as read and remove it from the list
function markAsRead(notificationId) {
    // Prevent the default action (e.g., page reload or link navigation)

    
    // Create a new XMLHttpRequest
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "mark_notifications_read.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Data to send
    const data = "id=" + notificationId;

    // On successful response, remove the clicked notification from the UI
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Successfully marked as read, remove the clicked notification from the UI
            const notificationElement = document.querySelector(`.notification-item[data-id="${notificationId}"]`);
            if (notificationElement) {
                // Remove the notification element from the list
                notificationElement.remove();
            }
        }
    };

    // Send the request
    xhr.send(data);
}
</script>

</body>

</html>