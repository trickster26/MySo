<?php
session_start();
include_once './config/constant.php';
include_once '../model/Models.php'; 

$defaultProfileImage = "https://cdn-icons-png.flaticon.com/512/6596/6596121.png";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // *Getting data from edit form*
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $bithdate = $_POST["birthday"];
    $gender = $_POST["gender"];
    $nationality = $_POST["nationality"];
    $income = $_POST["monthly_income"];
    $hobbies = $_POST["hobbies"];
    $subject = $_POST["subject"];
    $street = $_POST["street"];
    $postel = $_POST["pin"];
    $country = $_POST["country"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $id = $_SESSION["id"];
    $address = [$street, $postel, $country, $state, $city];

    // *Check if file is uploaded or not*
    if (!empty($_FILES['profile-Image']['tmp_name'])) {

        // *File Upload Handling*
        $targetDirectory = '../../assets/images/uploads/'. $id . '/'; 
        $file_name = explode(".",$_FILES["profile-Image"]["name"]);
        $tempFile = $_FILES['profile-Image']['tmp_name'];
        $updated_file_name = $file_name[0].date("Y_m_d_h_i_sa")."_".$id.".".$file_name[1];
        
        $_SESSION['extension'] = $file_name[1];

        // *Checking the user id folder exists or not*
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        $targetFile = $targetDirectory . $updated_file_name . '.' . pathinfo($_FILES['profile-Image']['name'], PATHINFO_EXTENSION);

        // *Image Validation*
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (getimagesize($_FILES["profile-Image"]["tmp_name"]) === false || !in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            echo "Invalid image file.";
            exit();
        }
        // *Move the uploaded file to the desired directory and sending form data to Model*
        if (move_uploaded_file($tempFile, $targetFile)) {
            $model = new Models();
            $subject_status = $model -> Insert($subject,'subject',['subject', 'user_id']);
            $address_status = $model -> Insert($address,'address', ['street_address','pin_code', 'country', 'state', 'city']);
            
            $hobbie_status = $model -> Insert($hobbies,'hobbies',['hobbies','user_id']);
            
            $imageFile = $updated_file_name;
            $status = $model->Model_Edit($first_name, $last_name, $email, $phone, $_POST["birthday"], $gender, $nationality, $imageFile, $income);

            if($status && $subject_status && $hobbie_status && $address_status){
                header("Location:http://localhost:8000/");
                exit;
            }
        } 

    } else {
            // *No file was uploaded, set the default profile image URL*
            $model = new Models();
            $subject_status = $model -> Insert($subject,'subject',['subject', 'user_id']);
            $address_status = $model -> Insert($address,'address', ['street_address','pin_code', 'country', 'state', 'city']);
            
            $hobbie_status = $model -> Insert($hobbies,'hobbies',['hobbies','user_id']);
            
            
           
            $status = $model->Model_Edit($first_name, $last_name, $email, $phone, $_POST["birthday"], $gender, $nationality, $imageFile, $income);
            if($status && $subject_status && $hobbie_status && $address_status){
                header("Location: http://localhost:8000/");
                exit;
            }
    }

}
?>
