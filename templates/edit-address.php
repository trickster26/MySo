<?php
include_once("navbar.php");
require("../config/connection.php");
include('../config/constant.php');
if (!isset($_SESSION['login_user'])) {
	header("location:" . URL);
	exit();
}

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
    $newType = mysqli_real_escape_string($conn,$_POST['type']);
    $newStreetAddress = mysqli_real_escape_string($conn, $_POST['street_address']);
    $newPinCode = mysqli_real_escape_string($conn, $_POST['pin_code']);
    $newCountry = mysqli_real_escape_string($conn, $_POST['country']);
    $newState = mysqli_real_escape_string($conn, $_POST['state']);
    $newCity = mysqli_real_escape_string($conn, $_POST['city']);
    
    // Update the address in the database
    $updateQuery = "UPDATE address SET 
    address_type = '$newType',
    street_address='$newStreetAddress',
        street_address = '$newStreetAddress',
        pin_code = '$newPinCode',
        country = '$newCountry',
        state = '$newState',
        city = '$newCity'
        WHERE id = $addressId";

if ($conn->query($updateQuery)) {
    // Address updated successfully
    $_SESSION['edit-address']="Address updated successfully.";
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
            <label for="address_type">Type:</label>
            <select class="form-select" name="type" id="address_type">
                <option value="<?php echo $address['address_type']; ?>"><?php echo $address['address_type']; ?></option>
                <option value="Home">Home</option>
                <option value="Office">Office</option>
                <option value="Other">Other</option>
            </select>
            
            <div class="text-danger" id="type_error"></div>
        </div>

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
            <select id="country" class="form-select" onchange="fetchStates()" name="country">
                    <option value="">Select Country</option>
                </select>
        
            <div class="text-danger" id="country_error"></div>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <select id="state" class="form-select" onchange="fetchCities()" name="state">
                    <option value="">Select State</option>
                </select>
    
            <div class="text-danger" id="state_error"></div>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <select id="city" class="form-select" name="city">
                    <option value="">Select City</option>
                </select>
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
        const type = document.getElementById("address_type").value;
        const streetAddress = document.getElementById("street_address").value;
        const pinCode = document.getElementById("pin_code").value;
        const country = document.getElementById("country").value;
        const state = document.getElementById("state").value;
        const city = document.getElementById("city").value;

        // Get the error message elements
        const typeEroor = document.getElementById("type_error");
        const streetAddressError = document.getElementById("street_address_error");
        const pinCodeError = document.getElementById("pin_code_error");
        const countryError = document.getElementById("country_error");
        const stateError = document.getElementById("state_error");
        const cityError = document.getElementById("city_error");

        // Reset error messages
        typeEroor.innerHTML = "";
        streetAddressError.textContent = "";
        pinCodeError.textContent = "";
        countryError.textContent = "";
        stateError.textContent = "";
        cityError.textContent = "";

        let valid = true;

        // Vlaidation Type of address
        if (type.trim()==="") {
            typeEroor.textContent = "Type is required";
            valid = false;
        }

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
const apiEndpoint = "https://api.countrystatecity.in/v1/";
const apiKey = "MkRudWJaQnFEblM2ck9hYkRpTVhZbElSUGZUS2NmZ0VwVktnY1o1NQ==";

// Function to fetch countries and populate the country dropdown
async function fetchCountries() {
    const countrySelect = document.getElementById('country');
    const stateSelect = document.getElementById('state');
    const selectedCountry = countrySelect.value;
    countrySelect.innerHTML = '<option value="">Select Country</option>';
    try {
        const response = await fetch(apiEndpoint + 'countries', {
            headers: {
                'X-CSCAPI-KEY': apiKey,
            },
        });
        const data = await response.json();
        data.forEach(country => {
            const option = document.createElement('option');
            option.value = country.iso2;
            option.textContent = country.name;
            countrySelect.appendChild(option);
        });
        countrySelect.value = '<?php echo $address['country']; ?>';
        fetchStates();
    } catch (error) {
        console.error('Error fetching countries:', error);
    }
}

// Function to fetch states based on the selected country
async function fetchStates() {
    const countrySelect = document.getElementById('country');
    const stateSelect = document.getElementById('state');

    stateSelect.innerHTML = '<option value="">Select State</option>';

    const selectedCountry = countrySelect.value;

    if (selectedCountry) {
        try {
            const response = await fetch(apiEndpoint + `countries/${selectedCountry}/states`, {
                headers: {
                    'X-CSCAPI-KEY': apiKey,
                },
            });
            const data = await response.json();

            stateSelect.innerHTML = '<option value="">Select State</option>';
            data.forEach(state => {
                const option = document.createElement('option');
                option.value = state.iso2;
                option.textContent = state.name;
                stateSelect.appendChild(option);
            });

            stateSelect.value = '<?php echo $address['state']; ?>';
            fetchCities();
        } catch (error) {
            console.error('Error fetching states:', error);
        }
    } else {
        stateSelect.innerHTML = '<option value="">Select State</option>';
        citySelect.innerHTML = '<option value="">Select City</option>';
    }
}

// Function to fetch cities based on the selected state
async function fetchCities() {
    const countrySelect = document.getElementById('country');
    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');

    citySelect.innerHTML = '<option value="">Select City</option>';

    const selectedCountry = countrySelect.value;
    const selectedState = stateSelect.value;

    if (selectedCountry && selectedState) {
        try {
            const response = await fetch(apiEndpoint +
                `countries/${selectedCountry}/states/${selectedState}/cities`, {
                    headers: {
                        'X-CSCAPI-KEY': apiKey,
                    },
                });
            const data = await response.json();

            citySelect.innerHTML = '<option value="">Select City</option>';
            data.forEach(city => {
                const option = document.createElement('option');
                option.value = city.name;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });
            citySelect.value = '<?php echo $address['city']; ?>';
        } catch (error) {
            console.error('Error fetching cities:', error);
        }
    } else {
        citySelect.innerHTML = '<option value="">Select City</option>';
    }
}
// country
fetchCountries();

</script>





