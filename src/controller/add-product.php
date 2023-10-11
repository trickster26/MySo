<?php
session_start();
include_once '../model/Models.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // *Getting the data from FORM*
    $p_name = $_POST["product_name"];
    $price = $_POST['product_name_fr'];
    $catagory = $_POST['product_categorie'];
    $quantitie = $_POST['available_quantity'];
    $weight = $_POST['product_weight'];
    $discription = $_POST['product_description'];
    $short_desc = $_POST['product_short_desc'];
    $discount = $_POST['percentage_discount'];
    $brand = $_POST['author'];
    $visibility = $_POST['enable_display'];
    $approved_by = $_POST['approved_by'];
    $num = $_POST['filebutton1'];
    $id = $_SESSION["id"];
        $model = new Models();

        $file_name = explode(".", $_FILES["filebutton"]["name"]);
        $updated_file_name1 = $file_name[0] . date("Y_m_d_h_i_sa") . "." . $file_name[1];
        $status = $model->insertProduct([$p_name, $price, $catagory, $quantitie, $weight, $discription, $short_desc, $discount, $brand, $visibility, $updated_file_name1, $approved_by, $num, $id]);
       
        if ($status) {
            for ($i = 1; $i <= $num; $i++) {
                $pid = $_SESSION["product-id"];
                if (!empty($_FILES['alt' . $i]['tmp_name'])) {

                    // *File Upload Handling*
                    $targetDirectory = '../../assets/images/product_images/' . $pid . '/';
                    $file_name = explode(".", $_FILES['alt' . $i]["name"]);
                    $tempFile = $_FILES['alt'.$i]['tmp_name'];
                    $updated_file_name = $file_name[0] . date("Y_m_d_h_i_sa") . "_" . $pid . "." . $file_name[1];

                    $_SESSION['product_extension'] = $file_name[1];

                    // *Checking the user id folder exists or not*
                    if (!file_exists($targetDirectory)) {
                        mkdir($targetDirectory, 0777, true);
                    }

                    $targetFile = $targetDirectory . $updated_file_name . '.' . pathinfo($_FILES['alt' . $i]['name'], PATHINFO_EXTENSION);

                    // *Image Validation*
                    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                    if (getimagesize($_FILES['alt' . $i]["tmp_name"]) === false || !in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                        echo "Invalid image file.";
                        exit();
                    }

                    move_uploaded_file($tempFile, $targetFile);
                    $status = $model->insertAltImages($updated_file_name);
                    
                }
            }
            
        }
    
    if (!empty($_FILES['filebutton']['tmp_name'])) {

        // *File Upload Handling*
        $targetDirectory = '../../assets/images/product_images/' . $pid . '/';
        $file_name = explode(".", $_FILES["filebutton"]["name"]);
        $tempFile = $_FILES['filebutton']['tmp_name'];
        $updated_file_name1 = $file_name[0] . date("Y_m_d_h_i_sa") .".". $file_name[1];

        $_SESSION['product_extension'] = $file_name[1];

        // *Checking the user id folder exists or not*
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        $targetFile = $targetDirectory . $updated_file_name1 . '.' . pathinfo($_FILES['filebutton']['name'], PATHINFO_EXTENSION);

        // *Image Validation*
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (getimagesize($_FILES["filebutton"]["tmp_name"]) === false || !in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            echo "Invalid image file.";
            exit();
        }
        $model = new Models();
        $move = move_uploaded_file($tempFile, $targetFile);

        if($move){
        header("Location:http://localhost:8000/templates/single-item.php");
        exit;
        }
        
    }
}
