<?php
// DATABASE CONFIGURATION
$servername = "sql209.infinityfree.com";
$username = "if0_34412041";
$password = "aLhF4AUN9DKj";
$dbname = "if0_34412041_employeeregistrationtable";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for the success message
$successMessage = "";

// Process Form Data
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // Retrieve form data
    $employeeName = $_POST["employeeName"];
    $employeeID = $_POST["employeeID"];
    $mailID = $_POST["mailID"];
    $employeePhone = $_POST["employeePhone"];
    $password = $_POST["password"];

    // Process the uploaded profile image
    $targetDirectory = "profile_images/"; // Choose the directory where you want to store the images
    $targetFile = $targetDirectory . basename($_FILES["employeeImage"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Allow certain image file formats (you can customize this list)
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");

    // Check if the uploaded file is an allowed image format
    if (in_array($imageFileType, $allowedExtensions)) {
        if (move_uploaded_file($_FILES["employeeImage"]["tmp_name"], $targetFile)) {
            // Hash the password before storing it in the database
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Save data to database including the image file path
            $sql = "INSERT INTO employeeregistration (employee_name, employee_ID, mail_ID, phone_number, profile_image, password)
                    VALUES ('$employeeName', '$employeeID', '$mailID', '$employeePhone', '$targetFile', '$passwordHash')";

            if ($conn->query($sql) === true) {
                // Build the success message with employee details
                // Build the success message with employee details
$successMessage = "<div class='success-item'>Registered successfully! Welcome, $employeeName</div>
                   <div class='success-item'>EMPLOYEE ID: $employeeID</div>
                   <div class='success-item'>MAIL ID: $mailID</div>
                   <div class='success-item'>Phone Number: $employeePhone</div>
                   <div class='success-item'><img src='$targetDirectory' alt='Profile Image'></div>
                   <div class='success-item'>Kindly <a href='../../index.html'>LOGIN</a> to access the homepage.</div>";

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Invalid file format. Allowed formats: " . implode(", ", $allowedExtensions);
    }
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
    <!-- Add your CSS styles here for the success message -->
    <style>
       body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .success-message {
            text-align: center;
            padding: 20px;
            border: 2px solid #1abc9c;
            border-radius: 10px;
            background-color: #e5f9f6;
            color: #1abc9c;
            font-size: 18px;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .success-item {
            margin: 15px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            row-gap: 10px;
        }
        .success-item img {
            max-width: 200px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        a {
            color: black;
        }
    </style>
</head>
<body>
    <!-- Display the success message with employee details -->
    <div class="success-message">
        <?php echo $successMessage; ?>
    </div>

    <a href=""></a>
    <!-- Additional content on the page, e.g., a login link or other elements -->
</body>
</html>