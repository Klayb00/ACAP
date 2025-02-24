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


  if(isset($_POST['submit'])){
    $datetime = $_POST["date-time"];
    $name = $_POST["name"];
    $group_name = $_POST["groupname"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $purpose = $_POST["purpose"];

    $visitor_data = "INSERT INTO `visitors_data` VALUES ('','$datetime','$name','$group_name','$address','$email','$contact','$purpose')";
    mysqli_query($conn, $visitor_data);

    
  }


$selectEvents = "SELECT id, date_time, name, name_group, address, email, contact, purpose FROM visitors_data";
$resultSelectEvents = mysqli_query($conn, $selectEvents);

$events = [];
if ($resultSelectEvents) {
    while ($row = mysqli_fetch_assoc($resultSelectEvents)) {
        $events[] = [
            'id' => $row['id'],
            'title' => $row['name'], // Event title
            'start' => $row['date_time'],
            'groupname' => $row['name_group'],
            'contact' => $row['contact'],
            'description' => $row['purpose'], // Event description
            'email' => $row['email'], // Email (optional, for additional data)
        ];
    }
}
    
    // Output the events as JSON for use in FullCalendar or other purposes
    $_SESSION['events'] = $events;


    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="500; url=index.php">
    <title>Sinag Kalinga Foundation Inc.</title>
   
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/5ad3914b72.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/visitorform.css">
    <link rel="stylesheet" href="Css/dashboard-values.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        /* Modal Styling */
        .modal {
            display: hidden; /* Hidden by default */
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
        }
        .modal-content {
            background: linear-gradient(to bottom, #d1f1ff, #dee2ff);
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            max-width: 40%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .modal-content h3 {
            margin-bottom: 20px;
        }
        .modal-content p {
            margin: 10px 0;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .calendar-values{
            width: 100%;
            justify-content: center;
            height: 100%;
            align-items: center;
            display: flex;
            
        }
        .calendar-values .calendar-r1{
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            
        }
        .calendar-values .calendar-r1 .calendar-r2{  
            max-width: 100%;
            border: 50px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            top: 5%;    
        }
        .calendar-r2 .addevent{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        .calendar-r2 .addevent .btn{
            color: white;
            margin-bottom: 5%;
            font-size: 30px;
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
        <div class="calendar-values">
        
        <?php

         $querys = "SELECT COUNT(*) AS count FROM `residents_info`";
         $query_result = mysqli_query($conn, $querys);

                    while($row = mysqli_fetch_assoc($query_result)){

                            $outputs = $row['count'];
                         }

            $query = "SELECT COUNT(*) AS count FROM `medicine_data`";
            $query_result = mysqli_query($conn, $query);

                    while($row = mysqli_fetch_assoc($query_result)){

                            $output = $row['count'];
                         }

        ?>

    <div class="calendar-r1">
    
        <div class="calendar-r2">
        <div class="addevent">
            <?php 
            $role = $_SESSION['user_role'];
            $allowed_roles = ['socialworker', 'admin'];
            if (in_array($role, $allowed_roles)) {
            ?>
            <button type="button" class="btn btn-info" onclick="openVisitForm()">Schedule</button>
            <?php } ?>
            </div>
<div id="calendar"></div>
</div>
</div>
                    <?php 
            $role = $_SESSION['user_role'];
            $allowed_roles = ['socialworker', 'admin'];
            if (in_array($role, $allowed_roles)) {
            ?>
<div id="eventModal" class="modal">
                    
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Appointment Details</h3>
        <p><strong>Appointment Schedule:</strong> <span id="event-date"></span></p>
        <p><strong>Leader Name:</strong> <span id="user-name"></span></p>
        <p><strong>Group Name:</strong> <span id="event-group"></span></p>
        <p><strong>Contact #:</strong> <span id="event-contact"></span></p>
        <p><strong>Email Address:</strong> <span id="event-email"></span></p>
        <p><strong>Purpose of Visiting:</strong> <span id="event-purpose"></span></p>
    </div>
</div>

<?php } ?>


<div class="medsform hidden" id="myForm">
    <form action="" class="edit-form" method="POST">
        <h3 class="mb-3 text-center">View Resident</h3>
        <input type="hidden" name="med_id" id="CurrrentId">

        <div class="mb-3">
        <label for="date-time">Date & Time of Visit</label>
        <input type="datetime-local" id="date-time" name="date-time" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label"><b>Item Name</b></label>
            <input type="text" id="name" name="name" placeholder="Full Name" required>
        </div>

        <div class="mb-3">
            <label for="groupname" class="form-label"><b>Group Name (N/A if solo visitor)</b></label>
            <input type="text" id="group-name" name="groupname" placeholder="Group Name">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label"><b>Address</b></label>
            <input type="text" id="address" name="address" placeholder="Address">
        </div>

        <div class="mb-3">
        <label for="email" class="form-label">Email or Facebook Account</label>
        <input type="text" id="email" name="email" placeholder="Email or Facebook">
        </div>

        <div class="mb-3">
        <label for="contact" class="form-label">Contact #</label>
        <input type="tel" id="contact" name="contact" placeholder="+63**********">
        </div>
        <div class="mb-3">
        <label for="purpose" class="form-label">Purpose</label>
        <input type="text" id="purpose" name="purpose" placeholder="Purpose for visiting">
        </div>
        <div class="d-flex justify-content-between">
            <button name="submit" class="btn btn-primary update-btn">Confirm</button>
            <button type="button" class="btn btn-secondary close-btn" onclick="closeVisitForm()">Cancel</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Fetch events from PHP
        const events = <?php echo json_encode($events); ?>;

        // Initialize FullCalendar
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek'
            },
            events: events, // Pass events directly to the calendar
            selectable: true,
            select: function(start, end) {
                const selectedDate = moment(start).format('YYYY-MM-DD');
            },
            eventClick: function(event) {
                $('#event-date').text(moment(event.start).format('MMMM DD, YYYY'));
                $('#user-name').text(event.title);
                $('#event-group').text(event.groupname || 'N/A');
                $('#event-contact').text(event.contact || 'N/A');
                $('#event-email').text(event.email || 'N/A');
                $('#event-purpose').text(event.description || 'N/A');

                $('#eventModal').css('display', 'block');
            }

        });
        $('.close').on('click', function () {
            $('#eventModal').css('display', 'none');
        });

        $(window).on('click', function (event) {
            if (event.target.id === 'eventModal') {
                $('#eventModal').css('display', 'none');
            }
        });
    });
</script>
        
        <!-- End of Topbar -->
        
        <!-- JavaScript link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>