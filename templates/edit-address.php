<?php
require("../config/connection.php");
include_once("navbar.php");

// Check if the user is authenticated (you should implement user authentication)
if (!isset($_SESSION['id'])) {
    header("Location: http://localhost:8000/templates/login.php");
    exit;
}

// Check if the address ID is provided as a query parameter
if (isset($_GET['id'])) {
    $addressId = $_GET['id'];
} else {
    header("Location:http://localhost:8000/templates/addresses.php"); 
    exit;
}


// Check if the form is submitted for address update
if (isset($_POST['street_address'])) {
    // Retrieve and sanitize form data (you should add more validation)
    $newStreetAddress = mysqli_real_escape_string($conn, $_POST['street_address']);
    $newPinCode = mysqli_real_escape_string($conn, $_POST['pin_code']);
    $newCountry = mysqli_real_escape_string($conn, $_POST['country']);
    $newState = mysqli_real_escape_string($conn, $_POST['state']);
    $newCity = mysqli_real_escape_string($conn, $_POST['city']);
    
    // Update the address in the database
    $updateQuery = "UPDATE address SET 
        street_address = '$newStreetAddress',
        pin_code = '$newPinCode',
        country = '$newCountry',
        state = '$newState',
        city = '$newCity'
        WHERE id = $addressId";

if ($conn->query($updateQuery)) {
    // Address updated successfully
    $_SESSION['edit-address']="Address updated successfully.";
    var_dump("hello");
    header("Location: http://localhost:8000/templates/addresses.php"); 
    exit;
} else {;
        echo "Error updating address: " . $conn->error;
    }
}

// Retrieve the current address details
$query = "SELECT * FROM `address` WHERE id = $addressId AND user_id = ".$_SESSION['id'];
$result = $conn->query($query);

if ($result->num_rows === 1) {
    $address = $result->fetch_assoc();
} else {
    $_SESSION['address-error']="Address not found or unauthorized access.";
    header("Location: http://localhost:8000/templates/addresses.php");
    exit;
}


?>


<div class="container">
    <h2>Edit Address</h2>
    <form method="POST" action="http://localhost:8000/templates/edit-address.php?id=<?php echo $addressId; ?>">
        <div class="form-group">
            <label for="street_address">Street Address</label>
            <input type="text" class="form-control" id="street_address" name="street_address" value="<?php echo $address['street_address']; ?>">
            <div class="text-danger" id="street_address_error"></div>
        </div>

        <div class="form-group">
            <label for="pin_code">PIN Code</label>
            <input type="text" class="form-control" id="pin_code" name="pin_code" value="<?php echo $address['pin_code']; ?>">
            <div class="text-danger" id="pin_code_error"></div>
        </div>

        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country" value="<?php echo $address['country']; ?>">
            <div class="text-danger" id="country_error"></div>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input type="text" class="form-control" id="state" name="state" value="<?php echo $address['state']; ?>">
            <div class="text-danger" id="state_error"></div>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo $address['city']; ?>">
            <div class="text-danger" id="city_error"></div>
        </div>

        <button type="submit" name="updateAddress" class="btn btn-primary" id="submitBtn">Update Address</button>
    </form>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const submitBtn = document.getElementById("submitBtn");

    form.addEventListener("submit", function (event) {
        // Get the input field values
        const streetAddress = document.getElementById("street_address").value;
        const pinCode = document.getElementById("pin_code").value;
        const country = document.getElementById("country").value;
        const state = document.getElementById("state").value;
        const city = document.getElementById("city").value;

        // Get the error message elements
        const streetAddressError = document.getElementById("street_address_error");
        const pinCodeError = document.getElementById("pin_code_error");
        const countryError = document.getElementById("country_error");
        const stateError = document.getElementById("state_error");
        const cityError = document.getElementById("city_error");

        // Reset error messages
        streetAddressError.textContent = "";
        pinCodeError.textContent = "";
        countryError.textContent = "";
        stateError.textContent = "";
        cityError.textContent = "";

        let valid = true;

        // Validate Street Address (Required)
        if (streetAddress.trim() === "") {
            streetAddressError.textContent = "Street Address is required";
            valid = false;
        }

        // Validate PIN Code (Required, Numeric, Length = 6)
        if (pinCode.trim() === "") {
            pinCodeError.textContent = "PIN Code is required";
            valid = false;
        } else if (!/^\d{6}$/.test(pinCode)) {
            pinCodeError.textContent = "Enter a valid 6-digit PIN Code";
            valid = false;
        }

        // Validate Country (Required)
        if (country.trim() === "") {
            countryError.textContent = "Country is required";
            valid = false;
        }

        // Validate State (Required)
        if (state.trim() === "") {
            stateError.textContent = "State is required";
            valid = false;
        }

        // Validate City (Required)
        if (city.trim() === "") {
            cityError.textContent = "City is required";
            valid = false;
        }

        if (valid) {
            // If all fields are valid, submit the form
            submitBtn.disabled = true; // Prevent double submission
            submitBtn.textContent = "Updating...";
            return true; // Allow the form to submit
        }

        event.preventDefault(); // Prevent the form from submitting if there are validation errors
    });
});
</script>





