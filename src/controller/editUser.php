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
    
    $id = $_SESSION["id"];
    


// Define error variables
$errors = array();

// Validate First Name
if (empty($_POST['first_name'])) {
    $errors['first_name'] = 'First name is required';
}

// Validate Last Name
if (empty($_POST['last_name'])) {
    $errors['last_name'] = 'Last name is required';
}

// Validate Email Address
if (empty($_POST['email'])) {
    $errors['email'] = 'Email address is required';
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email address';
}

// Validate Mobile Number
if (empty($_POST['phone'])) {
    $errors['phone'] = 'Mobile number is required';
} elseif (!preg_match("/^[0-9]{10}$/", $_POST['phone'])) {
    $errors['phone'] = 'Invalid mobile number';
}

// Validate Date of Birth
if (empty($_POST['birthday'])) {
    $errors['birthday'] = 'Date of birth is required';
}

// Validate Hobbies (at least one must be selected)
if (empty($_POST['hobbies'])) {
    $errors['hobbies'] = 'Please select at least one hobby';
}

// Validate Gender
if (empty($_POST['gender'])) {
    $errors['gender'] = 'Gender is required';
}

// Validate Address Fields (Country, State, City, Street, and PIN CODE)
// if (empty($_POST['country']) || empty($_POST['state']) || empty($_POST['city']) || empty($_POST['street']) || empty($_POST['pin'])) {
//     $errors['address'] = 'All address fields are required';
// }

// Validate Nationality
if (empty($_POST['nationality'])) {
    $errors['nationality'] = 'Nationality is required';
}

// Validate Monthly Income
if (empty($_POST['monthly_income'])) {
    $errors['monthly_income'] = 'Monthly income is required';
} elseif (!is_numeric($_POST['monthly_income'])) {
    $errors['monthly_income'] = 'Monthly income must be a number';
}

if (empty($errors)) {
     // *Check if file is uploaded or not*
     // Check if the "Delete Profile Image" checkbox is selected
    if (isset($_POST['delete_image']) && $_POST['delete_image'] == 1) {
        // Delete the existing profile image if it exists
        if (isset($_SESSION['image'])) {
        // Define the path to the profile image and remove it from the file system
            $imagePath = '../../assets/images/uploads/' . $_SESSION['id'] . '/' . $_SESSION['image'] . '.' . $_SESSION['extension'];
                if (file_exists($imagePath)) {
                unlink($imagePath);
            }

        // Remove image-related session variables
            unset($_SESSION['image']);
            unset($_SESSION['extension']);
            $_SESSION['success_message'] = 'Your profile has been updated successfully.';
            header("Location: http://localhost:8000/templates/edit-user.php");
            exit;
        }
    }else if (!empty($_FILES['profile-Image']['tmp_name'])) {

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
            $_SESSION['edit-error'] = ["Invalid image file."];
            header("location:http://localhost:8000/templates/edit-user.php");
            exit();
        }
        // *Move the uploaded file to the desired directory and sending form data to Model*
        if (move_uploaded_file($tempFile, $targetFile)) {
            $model = new Models();
            $subject_status = $model -> Insert($subject,'subject',['subject', 'user_id']);
            
            
            $hobbie_status = $model -> Insert($hobbies,'hobbies',['hobbies','user_id']);
            
            $imageFile = $updated_file_name;
            $status = $model->Model_Edit($first_name, $last_name, $email, $phone, $_POST["birthday"], $gender, $nationality, $imageFile, $income);

            if($status && $subject_status && $hobbie_status && $address_status){
                $_SESSION['success_message'] = 'Your profile has been updated successfully.';
                header("Location:http://localhost:8000/templates/edit-user.php");
                exit;
            }
        } 

    } else {
            // *No file was uploaded, set the default profile image URL*
            $model = new Models();
            $subject_status = $model -> Insert($subject,'subject',['subject', 'user_id']);
            $hobbie_status = $model -> Insert($hobbies,'hobbies',['hobbies','user_id']);
            
            
           
            $status = $model->Model_Edit($first_name, $last_name, $email, $phone, $_POST["birthday"], $gender, $nationality, $imageFile, $income);
            if($status && $subject_status && $hobbie_status){
                $_SESSION['success_message'] = 'Your profile has been updated successfully.';
                header("Location: http://localhost:8000/templates/edit-user.php");
                exit;
            }
    }
}else{
    $_SESSION['edit-error'] = $errors;
    header("location:http://localhost:8000/templates/edit-user.php");
}



   

}
?>
