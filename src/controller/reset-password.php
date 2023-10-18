<?php include('/var/www/html/php/MySo/config/connection.php'); ?>
<?php
if (
  isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"])
  && ($_GET["action"] == "reset") && !isset($_POST["action"])
) {
  $key = $_GET["key"];
  $email = $_GET["email"];
  $curDate = date("Y-m-d H:i:s");
  $query = mysqli_query(
    $conn,
    "SELECT * FROM `password_reset_temp` WHERE `key`='" . $key . "' and `email`='" . $email . "';"
  );
  $row = mysqli_num_rows($query);
  if ($row == "") {
    $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is 
deactivated.</p>
<p><a href="http://localhost:8000/src/controller/forget.php">
Click here</a> to reset password.</p>';
  } else {
    $row = mysqli_fetch_assoc($query);
    $expDate = $row['expDate'];
    if ($expDate >= $curDate) {
      session_start();

?>

      <?php include('../../templates/navbar.php'); ?>
      <div class="container my-5" style="height: 60vh;">

        <div class="row justify-content-center">
          <div class="col-lg-9">
            <h1 class="mb-3">Reset Password</h1>
            <form method="post" action="" name="update">
              <input type="hidden" name="action" value="update" />
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="your-pass" class="form-label">Enter New Password:</label>
                  <div class="input-group">
                  <input type="password" class="form-control password" id="your-pass" name="pass1" required>
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="bi bi-eye-slash"></i>
                  </button>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="password" class="form-label">Re-Enter New Password:</label>
                  <div class="input-group">
                  <input type="password" class="form-control password" id="password" name="pass2" required>
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye-slash"></i>
                      </button>
                      </div>
                </div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-3"></div>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-dark w-100 fw-bold">Reset Password</button>
                      <input type="hidden" name="email" value="<?php echo $email; ?>" />
                     
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <script>
    // Eye show password
    const togglePassword = document.querySelectorAll("#togglePassword");
    const password = document.querySelectorAll(".password");

    togglePassword.forEach((btn, index) => {
        btn.addEventListener("click", function () {
            // toggle the type attribute for the corresponding password field
            const type = password[index].getAttribute("type") === "password" ? "text" : "password";
            password[index].setAttribute("type", type);

            // toggle the eye icon for both buttons
            togglePassword.forEach((btn) => {
                btn.querySelector("i").classList.toggle('bi-eye');
                btn.querySelector("i").classList.toggle('bi-eye-slash');
            });
        });
    });

</script>

      <?php include("../../templates/footer.php");
    } else {
      $error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which 
as valid only 24 hours (1 days after request).<br /><br /></p>";
    }
  }
  if ($error != "") {
    echo "<div class='error'>" . $error . "</div><br />";
  }
}


if (
  isset($_POST["email"]) && isset($_POST["action"]) &&
  ($_POST["action"] == "update")
) {
  $error = "";
  $pass1 = mysqli_real_escape_string($conn, $_POST["pass1"]);
  $pass2 = mysqli_real_escape_string($conn, $_POST["pass2"]);
  $email = $_POST["email"];
  $curDate = date("Y-m-d H:i:s");
  if ($pass1 != $pass2) {
      $error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
    }
  if ($error != "") {
    echo "<div class='error'>" . $error . "</div><br />";
    } else {
      $pass1 = hash('sha256', $pass1);
      mysqli_query(
        $conn,
        "UPDATE `user` SET `password`='" . $pass1 . "' 
          WHERE `email`='" . $email . "';"
      );

    mysqli_query($conn, "DELETE FROM `password_reset_temp` WHERE `email`='" . $email . "';");
    $_SESSION['success-change'] = "Congratulations! Your password has been updated successfully.";

    header("Location:http://localhost:8000/templates/success-template.php");
    exit;
  }
}
?>