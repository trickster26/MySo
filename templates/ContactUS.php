<?php include("./navbar.php"); 
// include('././../config/constant.php');
include('../config/constant.php');

?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h3 class="heading mb-4">Let's talk about everything!</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas debitis, fugit natus?</p>
          <p><img src="https://preview.colorlib.com/theme/bootstrap/contact-form-16/images/undraw-contact.svg" alt="Image" class="img-fluid"></p>
        </div>
        <div class="col-md-6">
        <form class="mb-5" method="post" id="contactForm" name="contactForm" action="../src/controller/ContactUs.php" novalidate="novalidate">
  <div class="row mb-3">
    <div class="col-md-12 form-group">
      <input type="text" class="form-control" name="name" id="name" placeholder="Your name" required>
      <div class="invalid-feedback">Please enter your name.</div>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-md-12 form-group">
      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
      <div class="invalid-feedback">Please enter a valid email address.</div>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-md-12 form-group">
      <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
      <div class="invalid-feedback">Please enter a subject.</div>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-md-12 form-group">
      <textarea class="form-control" name="message" id="message" cols="30" rows="7" placeholder="Write your message" required></textarea>
      <div class="invalid-feedback">Please enter your message.</div>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-12">
      <input type="submit" value="Send Message" class="btn btn-dark  py-2 px-4">
      <span class="submitting"></span>
    </div>
  </div>
</form>


          <div id="form-message-warning mt-4"></div>
          <!-- <div id="form-message-success">
            Your message was sent, thank you!
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById("contactForm").addEventListener("submit", function (event) {
    // Prevent the form from submitting initially
    event.preventDefault();

    // Reset any previous error messages
    clearErrors();

    // Get form input values
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const subject = document.getElementById("subject").value.trim();
    const message = document.getElementById("message").value.trim();

    // Perform form validation
    let hasErrors = false;

    if (!name) {
      displayError("name", "Please enter your name.");
      hasErrors = true;
    }

    if (!email || !isValidEmail(email)) {
      displayError("email", "Please enter a valid email address.");
      hasErrors = true;
    }

    if (!subject) {
      displayError("subject", "Please enter a subject.");
      hasErrors = true;
    }

    if (!message) {
      displayError("message", "Please enter your message.");
      hasErrors = true;
    }

    // If there are no errors, submit the form
    if (!hasErrors) {
      this.submit(); // Submit the form
    }
  });

  // Function to display an error message for a form field
  function displayError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const invalidFeedback = field.nextElementSibling;
    field.classList.add("is-invalid");
    invalidFeedback.textContent = message;
  }

  // Function to clear all previous error messages
  function clearErrors() {
    const invalidFields = document.querySelectorAll(".is-invalid");
    invalidFields.forEach(function (field) {
      field.classList.remove("is-invalid");
      field.nextElementSibling.textContent = "";
    });
  }

  // Function to validate email format
  function isValidEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(email);
  }
</script>
<?php include("./footer.php") ?>