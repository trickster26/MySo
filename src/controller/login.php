<?php 
include_once(__DIR__ . '/../../config/constant.php');
include_once '../model/Models.php';
include_once '../controller/login_function.php';
include('/var/www/html/php/form_handling/config/connection.php');



if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password1 = mysqli_real_escape_string($conn,$_POST['password']);
    $remember_me = isset($_POST['remember_me']) ? true : false;

    $password = hash('sha256', $password1);

    $report = login_Controller($email, $password);
    
    if($report){
      $Model = new Models();
      $condi = $Model -> Check($email);
      if($condi>=10){
        if ($remember_me) {
          $token = bin2hex(random_bytes(32));;
          setcookie('remember_me', $token, time() + 30 * 24 * 3600, '/');
          setcookie('remember_email', $email, time() + 30 * 24 * 3600, '/');
          setcookie('remember_password', $password1, time() + 30 * 24 * 3600, '/');
          $_SESSION['remember_me_tokens'][$token] = $email;
      }else{
        unset($_COOKIE['remember_me']);
        unset($_COOKIE['remember_email']);
        unset($_COOKIE['remember_password']);
        setcookie("remember_me", "", time()-(60*60*24*7),"/");
        setcookie("remember_email", "", time()-(60*60*24*7),"/");
        setcookie("remember_password", "", time()-(60*60*24*7),"/");
      }
        header("location: http://localhost:8000/");
        exit();
      }else{
        if ($remember_me) {
          $token = bin2hex(random_bytes(32));;
          setcookie('remember_me', $token, time() + 30 * 24 * 3600, '/');
          setcookie('remember_email', $email, time() + 30 * 24 * 3600, '/');
          setcookie('remember_password', $password1, time() + 30 * 24 * 3600, '/');
          $_SESSION['remember_me_tokens'][$token] = $email;
      }else{
        unset($_COOKIE['remember_me']);
        unset($_COOKIE['remember_email']);
        unset($_COOKIE['remember_password']);
        setcookie("remember_me", "", time()-(60*60*24*7),"/");
        setcookie("remember_email", "", time()-(60*60*24*7),"/");
        setcookie("remember_password", "", time()-(60*60*24*7),"/");
      }
        header("location: http://localhost:8000/templates/edit-user.php");
        exit();
      }
      exit();
    }else{
      $_SESSION['previous_email'] = $email;
      $_SESSION['previous_remember_me'] = isset($_POST['remember_me']);
      $_SESSION["error_message"] = "Invalid username or password.";
      header("Location: http://localhost:8000/templates/login.php");
      exit();
    }
    
}



?>