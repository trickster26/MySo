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


            // Coverting normal password String into SHA256 digest
            $sha256HashPassword = hash('sha256', $password);

            $model = new Models();
            $status = $model->Model_SignUp($name, $email, $phone, $sha256HashPassword);

            
            if ($status){
                $report = login_Controller($email, $sha256HashPassword);
                if($report){
                    header("Location: http://localhost:8000/templates/edit-user.php" );
                    exit();
                }
            }
        } 
    }
}
$mySignUp = new SignUp();
$mySignUp->sign_up();