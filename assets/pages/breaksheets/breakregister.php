<?php
// Include the authentication logic
include('../../dashboard/auth.php');

// Start a session to access session data
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_authenticated'])) {
    // Redirect to the login page if not authenticated
    header("Location: ../../../index.html");
    exit();
}

// Set session timeout period (in seconds)
$sessionTimeout = 10; // 30 minutes

// Check if the last activity time is set in the session
if (isset($_SESSION['last_activity'])) {
    // Calculate the time difference
    $currentTime = time();
    $lastActivityTime = $_SESSION['last_activity'];
    $timeDifference = $currentTime - $lastActivityTime;

    // Check if the session has timed out
    if ($timeDifference > $sessionTimeout) {
        // Session has timed out, destroy the session and redirect to the login page
        session_destroy();
        header("Location: ../../../index.html");
        exit();
    }
}

// Update the last activity time in the session
$_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Break Register</title>
    <link rel="stylesheet" href="style.css">

    <style>

        /* Add this to your style.css */
@media (max-width: 600px) {
    .hide-on-mobile {
        display: none;
    }
}

    </style>
   

    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous">
        </script>
            <script src="script.js"></script>
             <script>
    // JavaScript to detect mobile device and set session variable
    var userAgent = navigator.userAgent;
    var isMobileDevice = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(userAgent);

    if (isMobileDevice) {
        // Set session variable to block mobile submission
        fetch('set_session_variable.php') // Replace with the actual URL to your PHP file
            .catch(error => console.error('Error setting session variable:', error));
    }
</script>



</head>

<body>

    <div class="container hide-on-mobile">
      
            <img src="focusLogo.png" alt="Image" class="top-image">

            <h3>Break Register</h3>

            <form id="breakRegisterForm" method="post" action="submit.php">
                <div class="form-group hide-on-mobile">
                    <select class="options" id="employeeName" name="employeeName" required>
                        <!-- Options here -->
                        <option value=''>-</option>
                        <option value='B Ayyappan (31135)'>B Ayyappan (31135)</option>
                        <option value='Ramanathan Thiyagarajan (31106)'>Ramanathan Thiyagarajan (31106)</option>
                        <option value='Muthu Kumaran (31085)'>Muthu Kumaran (31085)</option>
                        <option value='Arun T (31364)'>Arun T (31364)</option>
                        <option value='Christina Emalda (31353)'>Christina Emalda (31353)</option>
                        <option value='Murugan M (31360)'>Murugan M (31360)</option>
                        <option value='Farin Begam S (31348)'>Farin Begam S (31348)</option>
                        <option value='Silambarasan Dass (31359)'>Silambarasan Dass (31359)</option>
                        <option value='Mohit Reddy D (31651)'>Mohit Reddy D (31651)</option>
                        <option value='Subashini (31665)'>Subashini (31665)</option>
                        <option value='Aakash J (32326)'>Aakash J (32326)</option>
                        <option value='L Jayalakshmi (32371)'>L Jayalakshmi (32371)</option>
                        <option value='Sathish (32356)'>Sathish (32356)</option>
                        <option value='N Aravindan (32322)'>N Aravindan (32322)</option>
                        <option value='R Eujin (32349)'>R Eujin (32349)</option>
                        <option value='Jenifer Tiffany Sahayaraj (32483)'>Jenifer Tiffany Sahayaraj (32483)</option>
                        <option value='Saravanan N (32503)'>Saravanan N (32503)</option>
                        <option value='Suruthi Bl (32480)'>Suruthi Bl (32480)</option>
                        <option value='Suruthi S (32496)'>Suruthi S (32496)</option>
                        <option value='Alagu Sundaram K (32479)'>Alagu Sundaram K (32479)</option>
                        <option value='Abul Kalam Asath J (32441)'>Abul Kalam Asath J (32441)</option>
                        <option value='Janaki Raman V (31350)'>Janaki Raman V (31350)</option>
                        <option value='Alaguraja P (31639)'>Alaguraja P (31639)</option>
                        <option value='Magesh M (31638)'>Magesh M (31638)</option>
                        <option value='Rajesh E (31092)'>Rajesh E (31092)</option>
                        <option value='Sathya Priya S (31099)'>Sathya Priya S (31099)</option>
                        <option value='Jayaraj K (31338)'>Jayaraj K (31338)</option>
                        <option value='Ajeem Yasir (31349)'>Ajeem Yasir (31349)</option>
                        <option value='Mohandass S (31358)'>Mohandass S (31358)</option>
                        <option value='Munishwary (31363)'>Munishwary (31363)</option>
                        <option value='Mohan Kumar S (31354)'>Mohan Kumar S (31354)</option>
                        <option value='Chithirai Selvam K (31357)'>Chithirai Selvam K (31357)</option>
                        <option value='Harish K (31355)'>Harish K (31355)</option>
                        <option value='Kalirajan Muthu (31659)'>Kalirajan Muthu (31659)</option>
                        <option value='Poovendra Prakash P (31674)'>Poovendra Prakash P (31674)</option>
                        <option value='Predipa S (32132)'>Predipa S (32132)</option>
                        <option value='Balaji V (32425)'>Balaji V (32425)</option>
                        <option value='R Maheswari (32460)'>R Maheswari (32460)</option>
                        <option value='S Loganathan (32417)'>S Loganathan (32417)</option>
                        <option value='Selvarani (32451)'>Selvarani (32451)</option>
                        <option value='V Vinson Kumar (32464)'>V Vinson Kumar (32464)</option>
                        <option value='E Karthik (32434)'>E Karthik (32434)</option>
                        <option value='Dinesh A (32329)'>Dinesh A (32329)</option>
                        <option value='Farjana J (32350)'>Farjana J (32350)</option>
                        <option value='Palayathan D (32363)'>Palayathan D (32363)</option>
                        <option value='Prabhu J (32347)'>Prabhu J (32347)</option>
                        <option value='Surendhar S (32332)'>Surendhar S (32332)</option>
                        <option value='Thavuth A J (32353)'>Thavuth A J (32353)</option>
                        <option value='Praveen M (32391)'>Praveen M (32391)</option>
                    </select>
                </div>
                
                <div class="form-radio">
                    <input type="radio" id="BreakOut" name="checkType" value="Break Out" required onclick="fillCurrentDateTime()">
                    <label for="BreakOut">BreakOut</label>
                </div>


                <div class="form-radio">

                    <input type="radio" id="BreakIn" name="checkType" value="Break In" required onclick="fillCurrentDateTime()">
                    <label for="Break In">Break In</label>
                </div>

                  <!-- Add the input field for storing the last check type -->
            <input type="hidden" id="lastCheckType" name="lastCheckType">

                  

                <div class="form-group hide-on-mobile">
                    <input type="datetime-local" id="timestamp" name="timestamp" required>
                </div>



                <div class="form-group hide-on-mobile">
                    <button id="submitForm" onclick="submitForm()" type="submit">Submit</button>
                </div>
              
            </form>
                <!-- Element to display the submit message -->

        
    </div>

    
    <div id="messageContainer">
        <div id="successMessage" style="display: none;"></div>
        <div id="errorMessage" style="display: none;"></div>

    </div>
    <div class="liveMonitor">

        <a href="../breakmonitor/breakmonitor.html">Break <span>Monitor</span></a>

    </div>

</body>

<script>
    // Set session timeout period (in seconds)
    var sessionTimeout = 10; // 30 minutes

    // Function to check and update session activity
    function checkAndUpdateSession() {
        var currentTime = Math.floor(Date.now() / 1000);
        var lastActivityTime = <?php echo isset($_SESSION['last_activity']) ? $_SESSION['last_activity'] : '0'; ?>;
        var timeDifference = currentTime - lastActivityTime;

        // Check if the session has timed out
        if (timeDifference > sessionTimeout) {
            // Session has timed out, redirect to login page
            window.location.href = '../../index.html';
            return;
        }

        // Update the last activity time in the session
        <?php $_SESSION['last_activity'] = time(); ?>;
    }

    // Call the checkAndUpdateSession function initially and then at intervals
    checkAndUpdateSession();
    setInterval(checkAndUpdateSession, 1000); // Check every second

    // Refresh the page after sessionTimeout seconds
    setTimeout(function () {
        window.location.reload();
    }, sessionTimeout * 1000);
</script>


</html>