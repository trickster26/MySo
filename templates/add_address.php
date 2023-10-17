<?php
include('navbar.php');
include('../config/constant.php');
include('../config/connection.php');
if (!isset($_SESSION['login_user'])) {
	header("location:" . URL);
	exit();
}
?>
<style>
    .invalid-feedback{
        display: block;
    }
</style>

<div class="container d-flex justify-content-center">
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
        <form action="http://localhost:8000/src/controller/add-address.php" enctype="multipart/form-data" id="edit-form" method="POST">
            <h3 class="text-center">Edit Personal Information</h3>
            <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                    <div class="form-group">
            <label for="type">Type of Address:</label>
            <select class="form-select" name="type" id="type">
                <option value="">Select Type</option>
                <option value="Home">Home</option>
                <option value="Office">Office</option>
                <option value="other">Other</option>
            </select>
            
    
            <div class="text-danger" id="type_error">
            <?php if (isset($_SESSION['errors']["type"])) echo $_SESSION['errors']["type"]; ?>
            </div>
        </div>
                    <div class="form-group">
            <label for="country">Country</label>
            <select id="country" class="form-select" onchange="fetchStates()" name="country">
                    <option value="">Select Country</option>
                </select>
        
            <div class="text-danger" id="country_error">
                <?php if (isset($_SESSION['errors']["country"])) echo $_SESSION['errors']["country"]; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <select id="state" class="form-select" onchange="fetchCities()" name="state">
                    <option value="">Select State</option>
                </select>
    
            <div class="text-danger" id="state_error">
            <?php if (isset($_SESSION['errors']["state"])) echo $_SESSION['errors']["state"]; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <select id="city" class="form-select" name="city">
                    <option value="">Select City</option>
                </select>
            <div class="text-danger" id="city_error">
            <?php if (isset($_SESSION['errors']["city"])) echo $_SESSION['errors']["city"]; ?>
            </div>
            
        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="street">Street Address</label><br>
                        <input id="street" value="<?php echo $addreesss["street"] ?>" class="form-control" name="street" type="text">
                        <div class="invalid-feedback" id="street_error">
                        <?php if (isset($_SESSION['errors']["street"])) echo $_SESSION['errors']["street"]; ?>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="postel">PIN CODE:</label><br>
                        <input id="postel" value="<?php echo $addreesss["pin"] ?>" class="form-control" name="pin" type="number">
                        <div class="invalid-feedback" id="pin_error">
                        <?php if (isset($_SESSION['errors']["pin"])) echo $_SESSION['errors']["pin"]; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</div>
			</div>
        </form>
    </div>
</div>
<!-- checking session contain php validation if yes then empty it -->
<?php if(isset($_SESSION['errors'])){unset($_SESSION['errors']);} ?>
<script>
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
        countrySelect.value = '>';
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

            stateSelect.value = '';
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
            citySelect.value = '';
        } catch (error) {
            console.error('Error fetching cities:', error);
        }
    } else {
        citySelect.innerHTML = '<option value="">Select City</option>';
    }
}
// country
fetchCountries();


document.addEventListener("DOMContentLoaded", function () {
        const editForm = document.getElementById("edit-form");

        editForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the default form submission

            let isValid = true;

            const countryError = document.getElementById("country_error");
            const stateError = document.getElementById("state_error");
            const cityError = document.getElementById("city_error");
            const streetError = document.getElementById("street_error");
            const pinError = document.getElementById("pin_error");
            const typeError = document.getElementById("type_error");

            countryError.textContent = "";
            stateError.textContent = "";
            cityError.textContent = "";
            streetError.textContent = "";
            pinError.textContent = "";
            typeError.textContent = "";

            // Validate Country
            const country = document.getElementById("country");
            if (country.value === "") {
                countryError.textContent = "Country is required";
                isValid = false;
            }

            // Validation Type
            const type = document.getElementById("type");
            if (type.value === ""){
                typeError.textContent = "Type is required";
                isValid = false;
            }

            // Validate State
            const state = document.getElementById("state");
            if (state.value === "") {
                stateError.textContent = "State is required";
                isValid = false;
            }

            // Validation City
            const city = document.getElementById("city");
            if (city.value === "") {
                cityError.textContent = "City is required";
                isValid = false;
            }

            // Validate Street Address
            const street = document.getElementById("street");
            if (street.value === "") {
                streetError.textContent = "Street Address is required";
                isValid = false;
            }

          
            const pin = document.getElementById("postel");
            if (pin.value === "") {
                pinError.textContent = "PIN Code is required";
                isValid = false;
            } else if (!/^\d{6}$/.test(pin.value)) {
                pinError.textContent = "PIN Code must be a 6-digit number";
                isValid = false;
            }

            if (isValid) {
                // If all validations pass, submit the form
                editForm.submit();
            }else{
                console.log("hello");
                console.log(countryError);
                console.log(stateError);
                console.log(streetError);
                console.log(pinError);
            }
        });
    });
</script>

<?php include('footer.php'); ?>