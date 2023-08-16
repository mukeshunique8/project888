




const burgerIcon = document.querySelector('.burgerIcon');
const navListItems = document.querySelectorAll('.navUl li');

burgerIcon.addEventListener('click', function() {
  navListItems.forEach(item => {
    item.classList.toggle('active');
  });
});

// -----------------------------------------------

// Track user activity
let lastActivityTime = new Date().getTime();

function updateActivityTime() {
    lastActivityTime = new Date().getTime();
}

// Periodically check for session timeout
function checkSessionTimeout() {
    const currentTime = new Date().getTime();
    const sessionTimeout = 1 * 60 * 1000; // 15 minutes in milliseconds

    if (currentTime - lastActivityTime >= sessionTimeout) {
        // Perform logout action
        logoutUser();
    } else {
        // Continue checking
        setTimeout(checkSessionTimeout, 1000); // Check every second
    }
}

function logoutUser() {
    // Clear session variables
    // Redirect to the login page
    // Display logout message
    // ...
    window.location.href = "index.html?logout=1";
}

// Initialize activity tracking and session timeout check
document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("mousemove", updateActivityTime);
    document.addEventListener("click", updateActivityTime);
    document.addEventListener("keypress", updateActivityTime);
    setTimeout(checkSessionTimeout, 1000); // Start session timeout check
});



// *********************************************************
// Function to toggle the user profile dashboard


function toggleUserProfile() {
    var userDashboard = document.getElementById("userDashboard");
    userDashboard.classList.toggle("active");
}

   
