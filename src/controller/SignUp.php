<?php 
session_start();
include_once './config/constant.php';
include_once '../model/Models.php'; 
include_once '../controller/login_function.php';

?>

<?php


class SignUp extends Models {
    public function __construct() {

    }


    function sign_up(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $name = htmlentities($_POST['name']);
            // $name = $_POST['name'];
            $email = htmlentities($_POST['email']);
            $phone = $_POST['phone'];
            $password = htmlentities($_POST['password']);
            // Validate Name
    if (empty($name)) {
        $errors['name'] = 'Name is required.';
    }

    // Validate Email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email address.';
    }

    // Validate Phone
    if (empty($phone) || !preg_match('/^\d{10}$/', $phone)) {
        $errors['phone'] = 'Invalid phone number (10 digits required).';
    }

    // Validate Password (you can add more rules here)
    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    }

    // If there are no errors, proceed with registration
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location:http://localhost:8000/templates/signup.php");
        exit;
    }


    // $model = new Models();
    // $user = $model->getUserByEModelsmail($email);
    // if ($user && $user['status'] === 0) {
    //     $_SESSION['exist'] = 'User with this email already exists.';
    //     header("Location: http://localhost:8000/templates/signup.php");
    //     exit();
    // }


            // Coverting normal password String into SHA256 digest
            $sha256HashPassword = hash('sha256', $password);

            $model = new Models();
            $valid = $model -> Check_Exists($email);
            if($valid){
                $status = $model->Model_SignUp($name, $email, $phone, $sha256HashPassword);

            
                if ($status){
                    $defaultRoleId = 5; 
                    $user_id = $model->getUserIdByEmail($email);
                    $model->assignUserRole($user_id, $defaultRoleId);
                    $report = login_Controller($email, $sha256HashPassword);
                    if($report){
                        header("Location: http://localhost:8000/templates/edit-user.php" );
                        exit();
                    }
                }
            }else{
                $_SESSION['exist'] = 'User Already exists';
                header("Location: http://localhost:8000/templates/signup.php" );
                exit();
            }
        } 
    }
}
$mySignUp = new SignUp();
$mySignUp->sign_up();