document.addEventListener("DOMContentLoaded", function () {

    let lastCheckType = null;
    
 
    function fillCurrentDateTime() {
    // Get the current date and time
    const now = new Date();

    // Format the date as "YYYY-MM-DD"
    const formattedDate = `${now.getFullYear()}-${(now.getMonth() + 1).toString().padStart(2, "0")}-${now.getDate().toString().padStart(2, "0")}`;

    // Format the time as "HH:mm:ss"
    const formattedTime = `${now.getHours().toString().padStart(2, "0")}:${now.getMinutes().toString().padStart(2, "0")}:${now.getSeconds().toString().padStart(2, "0")}`;

    // Set the formatted date and time in the timestamp field
    document.getElementById("timestamp").value = formattedDate + "T" + formattedTime;
}

  
    function getLastCheckType() {
        // Get the employee name from the form
        var employeeName = document.getElementById('employeeName').value;
  
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();
  
        // Configure the GET request with the employeeName as a query parameter
        xhr.open('GET', 'getLastCheckType.php?employeeName=' + encodeURIComponent(employeeName), true);
  
        // Set up the event handler to handle the server's response
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        lastCheckType = response.lastCheckType;
                    } else {
                        lastCheckType = null;
                    }
                } else {
                    lastCheckType = null;
                }
            }
        };
  
        // Send the GET request
        xhr.send();
    }
  
    function displayMessage(type, message) {
        const messageElement = document.getElementById(type + "Message");
        messageElement.textContent = message;
  
        if (type === "success") {
            messageElement.style.color = "green"; // Set color for success message
        } else if (type === "error") {
            messageElement.style.color = "red"; // Set color for error message
        }
  
        messageElement.style.display = "block";
    }
  
   function handleFormSubmissionResponse(response) {
    console.log("Handling form submission response:", response); // Add this line
  
    if (response.status === "success") {
        // Handle success response
        displayMessage("success", response.message);
  
        // Refresh the page after a short delay (e.g., 2 seconds)
        setTimeout(function () {
            location.reload();
        }, 2000); // 2000 milliseconds = 2 seconds
    } else if (response.status === "error") {
        // Handle error response
        displayMessage("error", response.message);
    }
  
    // Update the lastCheckType based on the response
    lastCheckType = response.lastCheckType;
  }
  
  
  function submitForm() {
    event.preventDefault();
  
    var employeeName = document.getElementById('employeeName').value;
    var checkType = document.querySelector('input[name="checkType"]:checked').value;
    var timestamp = document.getElementById('timestamp').value;
  
    // Check if the user has already clicked the same option
    if (lastCheckType === checkType) {
      alert("You have already clicked " + checkType + ".");
      return;
    }
  
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
  
    // Configure the POST request to send the data to your PHP script for database insertion
    xhr.open('POST', 'submit.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
    // Set up the event handler to handle the server's response
    xhr.onload = function () {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        handleFormSubmissionResponse(response);
  
        // If the database insertion is successful, send the data to the Google Sheets API
        if (response.status === "success") {
          var formData = {
            NAME: employeeName,
            CHECKTYPE: checkType,
            TIMESTAMP: timestamp
          };
          fetch("https://api.apispreadsheets.com/data/yuQ3oJEoyGcXCfX4/", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
          })
        }
      } else {
        // Handle other error scenarios (if needed)
        displayMessage("error", "Error: " + xhr.status);
      }
    };
  
    // Send the POST request with the form data to your PHP script
    xhr.send("employeeName=" + encodeURIComponent(employeeName) + "&checkType=" + encodeURIComponent(checkType) + "&timestamp=" + encodeURIComponent(timestamp));
  }
  
    // Call getLastCheckType() to initialize the lastCheckType variable
    getLastCheckType();
  
    // Attach the fillCurrentDateTime function to the click event of the radio buttons
    var radioButtons = document.querySelectorAll('input[type="radio"]');
    for (var i = 0; i < radioButtons.length; i++) {
        radioButtons[i].addEventListener('click', fillCurrentDateTime);
    }
  
    // Attach the submitForm function to the click event of the submit button
    document.getElementById("submitForm").addEventListener("click", submitForm);
  
  });


 
  
  