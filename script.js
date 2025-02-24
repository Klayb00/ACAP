const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

//document.getElementById("dash").style.display="none";
var dropdown = document.getElementsByClassName("sub-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

let profileDropdownList = document.querySelector(".profile-dropdown-list");
let btn = document.querySelector(".profile-dropdown-btn");

let classList = profileDropdownList.classList;

const toggle = () => classList.toggle("active");

window.addEventListener("click", function (e) {
  if (!btn.contains(e.target)) classList.remove("active");
});

var log_out_msg = document.getElementById("profile_dropdown_list");
        function logout_msg(){
            if(log_out_msg.style.display === "none"){
                log_out_msg.style.display = "block";
            }else{
                log_out_msg.style.display = "none";
            }
            
        }
//disabled and unabled checkbox

//for highblood
function Enabledd1(chckdisease){

    var high=document.getElementById("DISEASES");
    high.disabled=chckdisease.checked ? false : true;

    if(!high.disabled){
      high.focus();
    }
}

function Enabledd2(chckhighblood){

  var highss=document.getElementById("HIGH");
  highss.disabled=chckhighblood.checked ? false : true;

  if(!highss.disabled){
    highss.focus();
  }
}

//for cholesterol medicine
function Enabledd3(chckcholesterol){

  var choles=document.getElementById("CHOLES");
  choles.disabled=chckcholesterol.checked ? false : true;

  if(!choles.disabled){
    choles.focus();
  }
}

//for alzheimers medecine
function Enabledd4(chckalzheimer){

  var alzhei=document.getElementById("ALZHEI");
  alzhei.disabled=chckalzheimer.checked ? false : true;

  if(!alzhei.disabled){
    alzhei.focus();
  }
}

function toggleDropdown() {
  const dropdownMenu = document.querySelector('.dropdown-menu');
  const dropdownBtn = document.querySelector('.profile-dropdown-btn i');

  // Toggle dropdown visibility
  dropdownMenu.classList.toggle('show');

  // Rotate the chevron icon
  dropdownBtn.classList.toggle('active');
}

// Close dropdown when clicking outside
document.addEventListener('click', function (event) {
  const dropdown = document.querySelector('.profile-dropdown');
  if (!dropdown.contains(event.target)) {
      const dropdownMenu = document.querySelector('.dropdown-menu');
      const dropdownBtn = document.querySelector('.profile-dropdown-btn i');

      dropdownMenu.classList.remove('show');
      dropdownBtn.classList.remove('active');
  }
});

function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}


function openVisitForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeVisitForm() {
  document.getElementById("myForm").style.display = "none";
}
//windows refresh
  if(window.history.replaceState){

    window.history.replaceState(null, null, window.location.href)
  }

//notification JS
// Function to update the notification count
function updateNotificationCount(count) {
  const notificationCountElement = document.getElementById('notification-count');
  if (count > 0) {
    notificationCountElement.textContent = count;
    notificationCountElement.style.display = 'inline';
  } else {
    notificationCountElement.style.display = 'none'; // Hide badge when no unread notifications
  }
}

// Function to mark all notifications as seen (AJAX request to PHP)
function markNotificationsAsSeen() {
  fetch('home.php', {
    method: 'POST',
  })
  .then(response => response.json())
  .then(data => {
    // Update the notification count on the bell
    updateNotificationCount(data.unread_count);
  })
  .catch(error => console.error('Error:', error));
}

// Call the PHP script to get the current unread notifications count on page load
window.onload = function() {
  fetch('get_unread_notifications.php')
    .then(response => response.json())
    .then(data => {
      updateNotificationCount(data.unread_count);
    })
    .catch(error => console.error('Error:', error));
};


function isChecked() {
    const checkboxes = document.querySelectorAll('input[name="vaccine[]"]');
    let isAnyChecked = false;

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            isAnyChecked = true;
        }
    });

    if (isAnyChecked) {
        console.log("At least one checkbox is checked.");
    } else {
        console.log("No checkboxes are selected.");
    }
}

// Notification Delete Function using AJAX

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



  
