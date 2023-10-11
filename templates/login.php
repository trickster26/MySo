<?php 
// include('././../config/constant.php');
include('../config/constant.php');
include('./navbar.php'); 

?>

<div style="height: 60vh;" class="col-sm-6 col-sm-offset-3 mt-5 mx-auto">
<!-- Display error message if set -->
<?php 
    if (isset($_SESSION["error_message"])) {
        echo '<h1 class="error">' . $_SESSION["error_message"] . '</h1>';
        unset($_SESSION["error_message"]); 
    }
?>
      <form id="signup-form" action="<?php echo URL ?>/src/controller/login.php" method="post">
        <div id="name-group" class="form-group">
          <label for="name">Email</label>
          <input
            type="email"
            class="form-control"
            id="name"
            name="email"
            placeholder="Full Name"
            require
          />
        </div>


        <div class="form-group" id="password-group">
          <label for="password">Password</label>
          <input type="text" placeholder="**********" id="password" name="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-4">
          Login
        </button>
        <a href="http://localhost:8000/src/controller/forget.php" class="btn btn-outline-warning mt-4">Forgot Password</a>
      </form>
    </div>

    <script>

      document.getElementById("signup-form").addEventListener("submit", function (event) {
      // Prevent the form from submitting initially
      event.preventDefault();

      // Reset any previous error messages
      clearErrors();

      // Get form input values
      const name = document.getElementById("name").value.trim();
      const password = document.getElementById("password").value.trim();
      // Perform form validation
      let hasErrors = false;

      if (!name) {
        displayError("name-group", "Name is required");
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

</script>

<?php include("./footer.php"); ?>