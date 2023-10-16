<?php 
// include('././../config/constant.php');
include('../config/constant.php');
include('./navbar.php'); 
if (isset($_SESSION['id'])) {
  header("Location: http://localhost:8000/index.php");
  exit;
}

?>

<div style="height: 60vh;" class="col-sm-6 col-sm-offset-3 mt-5 mx-auto">
<!-- Display error message if set -->
<?php 
    if (isset($_SESSION["error_message"])) {
        echo '<h1 class="error">' . $_SESSION["error_message"] . '</h1>';
        unset($_SESSION["error_message"]); 
    }
?>
      <form id="signin-form" action="<?php echo URL ?>/src/controller/login.php" method="post">
        <div id="name-group" class="form-group">
          <label for="name">Email</label>
          <input
            type="email"
            class="form-control"
            id="name"
            name="email"
            placeholder="Full Name"
            require
            value="<?php echo isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : ''; ?>"
          />
        </div>


        <div class="form-group" id="password-group">
          <label for="password">Password</label>
          <div class="d-flex ">
          <input type="password" placeholder="**********" id="password" name="password"  class="form-control" value="<?php echo isset($_COOKIE['remember_password']) ? $_COOKIE['remember_password'] : ''; ?>">
          <i style="margin-left: -30px; margin-top: 7px;" class="bi bi-eye-slash " id="togglePassword"></i>
          </div>
          
        </div>
        <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me" <?php echo isset($_COOKIE['remember_me']) ? 'checked' : ''; ?>>
        <label class="form-check-label" for="remember_me">Remember Me</label>
    <div>
        <button type="submit" class="btn btn-success mt-4">
          Login
        </button>
        <a href="http://localhost:8000/src/controller/forget.php" class="btn btn-outline-warning mt-4">Forgot Password</a>
        </div>
      </form>
    </div>

    <script>

      // Start of validations
      document.getElementById("signin-form").addEventListener("submit", function (event) {
      event.preventDefault();

      clearErrors();

      const name = document.getElementById("name").value.trim();
      const password = document.getElementById("password").value.trim();
      let hasErrors = false;

      if (!name) {
        displayError("name-group", "Name is required");
        hasErrors = true;
      }

      if (!password || password.length < 6) {
        displayError("password-group", "Password must be at least 6 characters");
        hasErrors = true;
      }

      // If there are no error submit the form
      if (!hasErrors) {
        this.submit();
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
      // Eye show password
      const togglePassword = document.querySelector("#togglePassword");
      const password = document.querySelector("#password");

      togglePassword.addEventListener("click", function () {
   
      // toggle the type attribute
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      // toggle the eye icon
      this.classList.toggle('bi-eye');
      this.classList.toggle('bi-eye-slash');
});
    
</script>

<?php include("./footer.php"); ?>