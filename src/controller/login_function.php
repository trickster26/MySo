<?php
session_start();
function login_Controller($email,$password){
   $model = new Models();
   $result = $model->Model_Login($email,$password);

    
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $id = $row['id'];
    $count = mysqli_num_rows($result);
    if($count === 1) {
        $_SESSION['login_user'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['id']=$id;
        $_SESSION['status'] = $row['status'];
        return true;
     }else {
        return false;
     }
}

?>