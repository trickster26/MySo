<?php 
include('./navbar.php'); 
include('../config/constant.php');
if (isset($_SESSION['login_user'])) {
	header("location:" . URL);
	exit();
}
?>
<style>
  .error{
    color: red;
  }
</style>

<div style="height: 60vh;" class="col-sm-6 col-sm-offset-3 mt-5 mx-auto">
      <form id="signup-form" action="<?php echo URL ?>/src/controller/SignUp.php" method="post">
        <div id="name-group" class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            placeholder="Full Name"
          />
          <?php if (isset($_SESSION['errors']['name'])) { ?>
            <div class="error"><?php echo $_SESSION['errors']['name']; ?></div>
        <?php } ?>
        </div>

        <div id="email-group" class="form-group">
          <label for="email">Email</label>
          <input
            type="text"
            class="form-control"
            id="email"
            name="email"
            placeholder="email@example.com"
          />
          <?php if (isset($_SESSION['errors']['email'])) { ?>
            <div class="error"><?php echo $_SESSION['errors']['email']; ?></div>
        <?php } ?>
        </div>

        <div id="superhero-group" class="form-group">
          <label for="superheroAlias">Phone</label>
          <input
            type="text"
            class="form-control"
            id="phone"
            name="phone"
            placeholder="9876543210"
          />
          <?php if (isset($_SESSION['errors']['phone'])) { ?>
            <div class="error"><?php echo $_SESSION['errors']['phone']; ?></div>
        <?php } ?>
        </div>

        <div class="form-group" id="password-group">
          <label for="password">Password</label>
          <input type="text" placeholder="**********" id="password" name="password" class="form-control">
          <?php if (isset($_SESSION['errors']['password'])) { ?>
            <div class="error"><?php echo $_SESSION['errors']['password']; ?></div>
        <?php } ?>
        </div>

        <button type="submit" class="btn btn-success mt-4">
          Register
        </button>
      </form>
    </div>
    <?php if(isset($_SESSION['errors'])){unset($_SESSION['errors']);} ?>

    <script>

      document.getElementById("signup-form").addEventListener("submit", function (event) {
      // Prevent the form from submitting initially
      event.preventDefault();

      // Reset any previous error messages
      clearErrors();

      // Get form input values
      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const phone = document.getElementById("phone").value.trim();
      const password = document.getElementById("password").value.trim();
      console.log(name, email);
      // Perform form validation
      let hasErrors = false;

      if (!name) {
        displayError("name-group", "Name is required");
        hasErrors = true;
      }

      if (!email || !isValidEmail(email)) {
        displayError("email-group", "Valid email is required");
        hasErrors = true;
      }

      if (!phone || !isValidPhone(phone)) {
        displayError("superhero-group", "Valid phone number is required");
        hasErrors = true;
      }

      if (!password || password.length < 6) {
        displayError("password-group", "Password must be at least 6 characters");
        hasErrors = true;
      }

      // If there are no errors, submit the form
      if (!hasErrors) {
        this.submit(); // Submit the form
        }
      });

      // Function to display an error message for a form field
      function displayError(groupId, message) {
        const group = document.getElementById(groupId);
        const errorDiv = document.createElement("div");
        errorDiv.className = "text-danger";
        errorDiv.textContent = message;
        group.appendChild(errorDiv);
      }

      // Function to clear all previous error messages
      function clearErrors() {
        const errorMessages = document.querySelectorAll(".text-danger");
        errorMessages.forEach(function (errorMessage) {
        errorMessage.remove();
        });
      }

      // Function to validate email format
      function isValidEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailPattern.test(email);
      }

      // Function to validate phone number format
      function isValidPhone(phone) {
        const phonePattern = /^\d{10}$/;
        return phonePattern.test(phone);
      }
</script>



    <?php include('./footer.php'); ?>