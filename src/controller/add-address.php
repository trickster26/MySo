<?php
session_start();
include_once '../model/Models.php'; 
if (isset($_SESSION['user-status'])){
    header('location:http://localhost:8000/templates/edit-user.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validate Country
    if (empty($_POST["country"])) {
        $errors["country"] = "Country is required";
    }

    // Validate State
    if (empty($_POST["state"])) {
        $errors["state"] = "State is required";
    }

    // Validate Street Address
    if (empty($_POST["street"])) {
        $errors["street"] = "Street Address is required";
    }

    // Validate PIN Code
    if (empty($_POST["pin"])) {
        $errors["pin"] = "PIN Code is required";
    } elseif (!is_numeric($_POST["pin"])) {
        $errors["pin"] = "PIN Code must be a number";
    }

    // Check for errors
    if (empty($errors)) {
        $street = $_POST["street"];
        $postel = $_POST["pin"];
        $country = $_POST["country"];
        $state = $_POST["state"];
        $city = $_POST["city"];
        $address = [$street, $postel, $country, $state, $city];
        $model = new Models();
        $address_status = $model -> Insert($address,'address', ['street_address','pin_code', 'country', 'state', 'city']);
        if($address_status){
            $_SESSION['address_status'] = 'Address Added Successfully...!!!';
            header('location:http://localhost:8000/templates/add_address.php');
            exit;
        }

    }else{
        $_SESSION['errors']=$errors;
        header('location:');
    }
}
?>