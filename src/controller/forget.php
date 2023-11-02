<?php session_start();
include('/var/www/html/php/MySo/config/connection.php'); ?>
<?php

include_once(__DIR__ . '/../../config/constant.php');
include_once '../model/Models.php';

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST["email"]) && (!empty($_POST["email"]))){
   $email = $_POST["email"];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   $email = filter_var($email, FILTER_VALIDATE_EMAIL);
   if (!$email) {
      $error ="Invalid email address please type a valid email address!";
   }else{
      $sel_query = "SELECT * FROM `user` WHERE email='".$email."'";

      $results = mysqli_query($conn,$sel_query);


      $row = mysqli_num_rows($results);
      if ($results -> num_rows==0){
         $error = "No user is registered with this email address!";
      }
   }
   if($error!=""){
      $_SESSION["forget-error"]= $error;
      header("location:http://localhost:8000/templates/forget-form.php");
   }else{
      $expFormat = mktime(
         date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
      );
      $expDate = date("Y-m-d H:i:s",$expFormat);
      $key = md5(2418*2);
      $addKey = substr(md5(uniqid(rand(),1)),3,10);
      $key = $key . $addKey;
      // Insert Temp Table
      mysqli_query($conn,
         "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
         VALUES ('".$email."', '".$key."', '".$expDate."');");

      $output='<p>Dear user,</p>';
      $output.='<p>Please click on the following link to reset your password.</p>';
      $output.='<p>-------------------------------------------------------------</p>';
      $output.='<p><a href="http://localhost:8000/src/controller/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">
      http://localhost:8000/controller/src/reset-password.php?key='.$key.'&email='.$email.'&action=reset</a></p>';		
      $output.='<p>-------------------------------------------------------------</p>';
      $output.='<p>Please be sure to copy the entire link into your browser.
      The link will expire after 1 day for security reason.</p>';
      $output.='<p>If you did not request this forgotten password email, no action 
      is needed, your password will not be reset. However, you may want to log into 
      your account and change your security password as someone may have guessed it.</p>';   	
      $output.='<p>Thanks,</p>';
      $output.='<p>MySo Team</p>';
      $body = $output; 
      $subject = "Password Recovery - MySo";

      $email_to = $email;
      $fromserver = "anukumar.mind2web@gmail.com"; 

      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->Host = 'smtp.gmail.com'; 
      $mail->SMTPAuth = true;
      $mail->Username = 'anukumar.mind2web@gmail.com';
      $mail->Password = 'vydonmckhupcdach'; 
      $mail->Port = 25;
      $mail->IsHTML(true);
      $mail->From = "anukumar.mind2web@gmail.com";
      $mail->FromName = "MySo";
      $mail->Sender = $fromserver;
      $mail->Subject = $subject;
      $mail->Body = $body;
      $mail->AddAddress($email_to);
      if(!$mail->Send()){
         echo "Mailer Error: " . $mail->ErrorInfo;
      }else{
         $_SESSION["email-success"] = "An email has been sent to you with instructions on how to reset your password.";
         header("Location:http://localhost:8000/templates/success-template.php");
      }
   }
}else{
   include("../../templates/forget-form.php");
}?>         

<!-- hello -->