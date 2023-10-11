<?php 
include_once(__DIR__ . '/../../config/constant.php');
include_once '../model/Models.php';
include_once '../controller/login_function.php';
include('/var/www/html/php/form_handling/config/connection.php');



if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password1 = mysqli_real_escape_string($conn,$_POST['password']);
    $password = hash('sha256', $password1);

    $report = login_Controller($email, $password);
    
    if($report){
      $Model = new Models();
      $condi = $Model -> Check($email);
      if($condi>=10){
        header("location: http://localhost:8000/");
        exit();
      }else{
        header("location: http://localhost:8000/templates/edit-user.php");
        exit();
      }
      exit();
    }else{
      $_SESSION["error_message"] = "Invalid username or password.";
        header("Location: http://localhost:8000/templates/login.php");
        exit();
    }
    
}



?>