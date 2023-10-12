<?php include('/var/www/html/php/MySo/config/connection.php'); ?>
<?php
if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
&& ($_GET["action"]=="reset") && !isset($_POST["action"])){
  $key = $_GET["key"];
  $email = $_GET["email"];
  $curDate = date("Y-m-d H:i:s");
  $query = mysqli_query($conn,
  "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';"
  );
  $row = mysqli_num_rows($query);
  if ($row==""){
  $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is 
deactivated.</p>
<p><a href="http://localhost:8000/src/controller/forget.php">
Click here</a> to reset password.</p>';
	}else{
  $row = mysqli_fetch_assoc($query);
  $expDate = $row['expDate'];
  if ($expDate >= $curDate){
    session_start();

    ?>

    <?php include('../../templates/navbar.php');?>
  <div class="container my-5" style="height: 60vh;">
 
  <div class="row justify-content-center">
    <div class="col-lg-9">
      <h1 class="mb-3">Reset Password</h1>
      <form method="post" action="" name="update">
        <input type="hidden" name="action" value="update" />
        <div class="row g-3">
          <div class="col-md-6">
            <label for="your-pass" class="form-label">Enter New Password:</label>
            <input type="password" class="form-control" id="your-pass" name="pass1" required>
          </div>
          <div class="col-md-6">
            <label for="your-email" class="form-label">Re-Enter New Password:</label>
            <input type="password" class="form-control" id="your-email" name="pass2" required>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-md-6">
                <button type="submit" class="btn btn-dark w-100 fw-bold" >Reset Password</button>
                <input type="hidden" name="email" value="<?php echo $email;?>"/>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
  
<?php include("../../templates/footer.php"); 
  }else{
$error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which 
as valid only 24 hours (1 days after request).<br /><br /></p>";
            }
      }
if($error!=""){
  echo "<div class='error'>".$error."</div><br />";
  }			
}


if(isset($_POST["email"]) && isset($_POST["action"]) &&
 ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_real_escape_string($conn,$_POST["pass1"]);
$pass2 = mysqli_real_escape_string($conn,$_POST["pass2"]);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
$error.= "<p>Password do not match, both password should be same.<br /><br /></p>";
  }
  if($error!=""){
echo "<div class='error'>".$error."</div><br />";
}else{
$pass1 = hash('sha256', $pass1);
mysqli_query($conn,
"UPDATE `user` SET `password`='".$pass1."' 
WHERE `email`='".$email."';"
);

mysqli_query($conn,"DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");
	header("location:http://localhost:8000/templates/success-template.php");
echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>
<p><a href="http://localhost:8000/templates/login.php">
Click here</a> to Login.</p></div><br />';
	  }		
}
?>