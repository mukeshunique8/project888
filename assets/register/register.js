

function togglePasswordVisibility() {
    const passwordInput = document.getElementById("employeePassword");
    const eyeIcon = document.querySelector(".eye-icon i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
    setTimeout(function () {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
      }, 1500);
}



  document.querySelector(".registerForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission (default behavior)

    // Your form processing logic here
    // For demonstration purposes, we'll use a simple alert message to simulate form submission success.

    alert("Form submitted successfully!");

    // Redirect to the homepage after successful form submission.
    // Replace 'homepage_url' with the actual URL of your homepage.
    window.location.href = "homepage_url";
  });


  // Your existing JavaScript functions go here

// Function to toggle password visibility
function togglePasswordVisibility() {
  // ...
}

// Function to handle form submission
document.querySelector(".registerForm").addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent form submission (default behavior)

  // Your form processing logic here
  // For demonstration purposes, we'll use a simple alert message to simulate form submission success.

  alert("Form submitted successfully!");

  // Redirect to the homepage after successful form submission.
  // Replace 'homepage_url' with the actual URL of your homepage.
  window.location.href = "../../index.html";
});
