<?php require("navbar.php");
require("../config/constant.php");
if ($_SESSION['role'] != 1) {
    header("location:".URL."/");
    exit;
} ?>

<?php if(isset($_SESSION['insert-success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><?php echo $_SESSION['insert-success']; ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php unset($_SESSION['insert-success']); } ?>


<section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp"
            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
            alt="Sample photo">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registration Info</h3>

            <form class="px-md-2" action="<?php URL ?>/src/controller/create_user.php" method="POST">

              <div class="form-outline mb-4">
              
                <input id="name" type="text" name="name" class="form-control" required>
                <label class="form-label" for="name">Name:</label>
                <span id="name-error" class="error"></span>
              </div>
            
              <div class="form-outline mb-4">
                <input id="email" type="email" name="email" class="form-control" required>
                <label class="form-label" for="email">Email:</label>
                <span id="email-error" class="error"></span>
              </div>

              <div class="form-outline mb-4">
              <input id="phone" type="text" name="phone" class="form-control">
                <label class="form-label" for="phone">Phone:</label>
                <span id="phone-error" class="error"></span>
              </div>

              <div class="form-ouline mb-4">

    
                <input id="password" type="password" name="password" required class="form-control">
                <label class="form-label" for="password">Password:</label>
                <span id="password-error" class="error"></span>
              </div>

              <div class="form-outline mb-4">
              <label for="status">Status:</label>
                <select class="form-select" id="status" name="status">
                    <option value="0">Active</option>
                    <option value="1">User Deleted</option>
                    <option value="2">Admin Deleted</option>
                    <option value="3">Banned</option>
                </select>
              </div>
              <div class="form-outline mb-4">
              <label for="role">Role:</label>
    <select class="form-select" name="role">
        <!-- <option value="1">Super User</option>` -->
        <option value="2">Admin</option>
        <option value="3">Manager</option>
        <option value="4">Seller</option>
        <option value="5">User</option>
    </select>

                </div>

              

              <button type="submit" class="btn btn-success btn-lg mb-1">Create User</button>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- 

<form method="POST" action="http://localhost:8000/src/controller/create_user.php">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>
    <span id="name-error" class="error"></span><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    <span id="email-error" class="error"></span><br>

    <label for="phone">Phone:</label>
    <input type="text" name="phone"><br>
    <span id="phone-error" class="error"></span><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    <span id="password-error" class="error"></span><br>

    <label for="status">Status:</label>
    <select name="status">
        <option value="0">Active</option>
        <option value="1">User Deleted</option>
        <option value="2">Admin Deleted</option>
        <option value="3">Banned</option>
    </select><br>

    <label for="role">Role:</label>
    <select name="role">
        <option value="1">Super User</option>` -->
        <!-- <option value="2">Admin</option>
        <option value="3">Manager</option>
        <option value="4">Seller</option>
        <option value="5">User</option>
    </select><br>

    <input type="submit" value="Create User">
</form> -->
<script>
        function validateForm() {
            var name = document.forms["registrationForm"]["name"].value;
            var email = document.forms["registrationForm"]["email"].value;
            var password = document.forms["registrationForm"]["password"].value;

            // Clear existing error messages
            document.getElementById("name-error").textContent = "";
            document.getElementById("email-error").textContent = "";
            document.getElementById("password-error").textContent = "";

            var isValid = true;

            if (name === "") {
                document.getElementById("name-error").textContent = "Name is required";
                isValid = false;
            }
            
            if (email === "") {
                document.getElementById("email-error").textContent = "Email is required";
                isValid = false;
            } else if (!isValidEmail(email)) {
                document.getElementById("email-error").textContent = "Invalid email format";
                isValid = false;
            }
            
            if (password.length < 6) {
                document.getElementById("password-error").textContent = "Password must be at least 6 characters long";
                isValid = false;
            }
            
            return isValid;
        }

        function isValidEmail(email) {
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(email);
        }
    </script>

<?php include("footer.php"); ?>