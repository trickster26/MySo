<?php
session_start();
include("../../config/connection.php");
include("../model/Models.php");
$model = new Models();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $status = $_POST['status'];
    $role = $_POST['role'];
    $dbpass = hash("sha256",$password);

    if (empty($name)) {
        $error = "Name is required.";
    }
    
    if (empty($email)) {
        $error = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    }
    
    if (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    }

    if (strlen($phone)!=10) {
        $error = "Phone number should have 10 digits";
    }
    
    if (isset($error)) {
        echo "<p>Error: {$error}</p>";
    } else {

        $sql = "INSERT INTO user (name, email, phone, password, status) VALUES ('".$name."','". $email ."','".$phone."' ,'".$dbpass."','".$status."')";
        var_dump($sql);
        $result = $conn->query($sql);
        var_dump($result);
            if ($result) {
                $id = $model -> getUserIdByEmail($email);
                if($conn -> query("INSERT INTO user_role (user_id, role_id) VALUES ('".$id."','".$role."')")){
                    $_SESSION["insert-success"] = "User Insertes Successfully";
                    header('Location: http://localhost:8000/templates/create_user.php'); 
                    exit();
                }
            
               
            } else {
                $error_message = "User creation failed. Please try again.";
            }

       
    }
}

?>