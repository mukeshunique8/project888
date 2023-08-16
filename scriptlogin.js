// JavaScript code for client-side validation (optional)

// You can use JavaScript to perform client-side validation on the login form,
// such as checking if the fields are not empty or meet certain criteria.

// For example, you can use an event listener to validate the form before submitting:

document.querySelector(".userLogin").addEventListener("submit", function(event) {
        // Prevent the form from submitting normally
        event.preventDefault();
    
        // Get the form inputs
        const employeeIdInput = document.getElementById("employeeID");
        const employeePasswordInput = document.getElementById("employeePassword");
    
        // Perform validation (e.g., checking if fields are not empty)
        if (employeeIdInput.value.trim() === "" || employeePasswordInput.value.trim() === "") {
            alert("Please fill in all fields.");
            return;
        }
    
        // If the form is valid, submit the form
        event.target.submit();
    });
    