<?php
session_start();
// include('././../config/constant.php');
include('../config/constant.php');
include('../config/connection.php');

if (!isset($_SESSION['login_user'])) {
	header("location:" . URL);
	exit();
}
$id = $_SESSION['id'];
// for subject
$sql = "SELECT * FROM `subject` WHERE user_id = '$id'";
$result = $conn->query($sql);
$exist = array();
while ($row = mysqli_fetch_assoc($result)) {
	array_push($exist,$row['subject']);
}

// for hobbies
$sql1 = "SELECT * FROM `hobbies` WHERE user_id = '$id'";
$res = $conn -> query($sql1);

$hobbies = array();
while ($rows = mysqli_fetch_assoc($res)){
	array_push($hobbies, $rows['hobbies']);
	}

// for gender
$sql = "SELECT `gender` FROM `profile` WHERE `user_id` = '$id'";
$resu = $conn -> query($sql);

$roww = mysqli_fetch_assoc($resu);

$gender= $roww["gender"];

// for address
$sql = "SELECT * FROM `address` WHERE `user_id`= '$id'";
$ress = $conn -> query($sql);
$rowww = mysqli_fetch_assoc($ress);
$addreesss = array();  
while ( $rowe = mysqli_fetch_assoc( $ress ) ){
	$addreesss["street"] = $rowe["street_address"];
	$addreesss["pin"] = $rowe["pin_code"];
	$addreesss["country"]= $rowe ["country"];
	$addreesss["state"]= $rowe ["state"];
	$addreesss["city"]= $rowe ["city"];
	};


include("./navbar.php");
?>

<div class="container d-flex justify-content-center">
	<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
		<form action="http://localhost:8000/src/controller/editUser.php" enctype="multipart/form-data" id="edit-form" method="POST">
			<h3 class="text-center">Edit Personal Information</h3>
			<div style="text-align: center;" class=" mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<fieldset>
							<?php if (!isset($_SESSION['image'])) { ?>
								<div class="grid-65">
									<div class="image">
										<img style="height: 150px; width: 150px; border-radius: 50%; object-fit: cover; background: #dfdfdf;" src="https://cdn-icons-png.flaticon.com/512/6596/6596121.png" alt="..."><br>
										<input style="text-align:center;" type="file" name="profile-Image" value="https://cdn-icons-png.flaticon.com/512/6596/6596121.png" id="input">
									</div>
								</div>
							<?php } else { ?>
								<div class="grid-65">
									<div class="image">
										<img style="height: 150px; width: 150px; border-radius: 50%; object-fit: cover; background: #dfdfdf;" src="../../assets/images/uploads/<?php echo $_SESSION['id']; ?>/<?php echo $_SESSION['image']; ?>.<?php echo $_SESSION['extension']; ?>" alt="..."><br>
										<input style="text-align:center;" value="<?php echo $_SESSION['id']; ?>/<?php echo $_SESSION['image']; ?>.<?php echo $_SESSION['extension'];?>" type="file" name="profile-Image" id="input">
									</div>
								</div>
							<?php } ?>

						</fieldset>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">First Name:</label>
						<input type="text" name="first_name" class="form-control" value="<?php echo $_SESSION['login_user']; ?>">
						<div class="invalid-feedback"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Last Name: </label>
						<input type="text" name="last_name" class="form-control" value="<?php echo $_SESSION['last_name']; ?>">
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Email Address:</label>
						<input type="email" name="email" class="form-control" readonly value="<?php echo $_SESSION['email']; ?>">
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Mobile Number:</label>
						<input type="tel" name="phone" class="form-control" value="<?php echo $_SESSION['phone']; ?>" pattern=[0-9]{10}>
						<div class="invalid-feedback"></div>

					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Date Of Birth:</label>
						<input type="date" name="birthday" class="form-control" value="<?php echo $_SESSION['dob']; ?>">
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Hobbies:</label>
						<select name="hobbies[]" class="form-control" size="3" multiple="multiple">
							<option value="video-game" <?php if(in_array('video-game',$hobbies)){?> selected <?php } ?>>Video Games</option>
							<option value="football" <?php if(in_array('football',$hobbies)){?> selected <?php } ?>>Football</option>
							<option value="reading" <?php if(in_array('reading',$hobbies)){?> selected <?php } ?>>Reading</option>
						</select>
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Gender:</label><br>
						<input type="radio"  <?php if($gender == "Male"){?> checked <?php } ?> name="gender" value="Male">Male</input>
						<input type="radio" <?php if($gender == "Female"){?> checked <?php } ?> name="gender" value="Female">Female</input>
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label for="Subjects" class="profile_details_text">Fav. Subjects:</label><br>
						<input type="checkbox" name="subject[]" value="math" <?php if(in_array('math',$exist)){?> checked <?php } ?> /> Math<br>
						<input type="checkbox" name="subject[]" value="science" <?php if(in_array('science',$exist)){?> checked <?php } ?> /> Science<br>
						<input type="checkbox" name="subject[]" value="english" <?php if(in_array('english',$exist)){?> checked <?php } ?> /> English<br>
						<input type="checkbox" name="subject[]" value="hindi" <?php if(in_array('hindi',$exist)){?> checked <?php } ?> /> Hindi<br>
						<input type="checkbox" name="subject[]" value="social" <?php if(in_array('social',$exist)){?> checked <?php } ?> /> Social Studies
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
					<label for="">Address: </label><br><br>
						<label for="country">Country:</label><br>
						<select name="country" id="country" onchange="fetchStates()">
							<option value="<?php echo $addreesss["country"] ?>">Select Country</option><br>
						</select><br>

						<label for="state">State:</label><br>
						<select name="state" id="state" onchange="fetchCities()">
							<option value="">Select State</option><br>
						</select><br>

						<label for="city">City:</label><br>
						<select name="city" id="city">
							<option value="">Select City</option><br>
						</select><br>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label for="street">Street Address</label><br>
						<input id="street" value="<?php echo $addreesss["street"] ?>" class="form-control" name="street" type="text">
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label for="postel">PIN CODE:</label><br>
						<input id="postel" value="<?php echo $addreesss["pin"] ?>" class="form-control" name="pin" type="text">
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Nationality:</label>
						<input type="text" name="nationality" class="form-control" value="<?php echo $_SESSION['nationality']; ?>">
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Monthly Income:</label>
						<input type="text" name="monthly_income" class="form-control" value="<?php echo $_SESSION['income']; ?>">
						<div class="invalid-feedback"></div>
					</div>
				</div>
				<div class="invalid-feedback"></div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Submit">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	// Replace with your API endpoint and key
	const apiEndpoint = 'https://api.countrystatecity.in/v1/';
	const apiKey = 'MkRudWJaQnFEblM2ck9hYkRpTVhZbElSUGZUS2NmZ0VwVktnY1o1NQ==';

	// Function to fetch countries and populate the country dropdown
	async function fetchCountries() {
		const countrySelect = document.getElementById('country');
		countrySelect.innerHTML = '<option value="">Loading...</option>';

		try {
			const response = await fetch(apiEndpoint + 'countries', {
				headers: {
					'X-CSCAPI-KEY': apiKey,
				},
			});
			const data = await response.json();

			countrySelect.innerHTML = '<option value=""><?php if(isset($addreesss["country"])){ echo $addreesss["country"];} else{ ?>Select Country<?php }?></option>';
			data.forEach(country => {
				const option = document.createElement('option');
				option.value = country.iso2;
				option.textContent = country.name;
				countrySelect.appendChild(option);
			});
		} catch (error) {
			console.error('Error fetching countries:', error);
		}
	}

	// Function to fetch states based on the selected country
	async function fetchStates() {
		const countrySelect = document.getElementById('country');
		const stateSelect = document.getElementById('state');
		const citySelect = document.getElementById('city');

		const selectedCountry = countrySelect.value;

		if (selectedCountry) {
			stateSelect.innerHTML = '<option value="">Loading...</option>';
			citySelect.innerHTML = '<option value=""><?php if(isset($addreesss["city"])){ echo $addreesss["city"];} else{ ?>Select City<?php }?></option>';

			try {
				const response = await fetch(apiEndpoint + `countries/${selectedCountry}/states`, {
					headers: {
						'X-CSCAPI-KEY': apiKey,
					},
				});
				const data = await response.json();

				stateSelect.innerHTML = '<option value=""><?php if(isset($addreesss["state"])){ echo $addreesss["state"];} else{ ?>Select State<?php }?></option>';
				data.forEach(state => {
					const option = document.createElement('option');
					option.value = state.iso2;
					option.textContent = state.name;
					stateSelect.appendChild(option);
				});
			} catch (error) {
				console.error('Error fetching states:', error);
			}
		} else {
			stateSelect.innerHTML = '<option value=""><?php if(isset($addreesss["state"])){ echo $addreesss["state"];} else{ ?>Select State<?php }?></option>';
			citySelect.innerHTML = '<option value=""><?php if(isset($addreesss["city"])){ echo $addreesss["city"];} else{ ?>Select City<?php }?></option>';
		}
	}

	// Function to fetch cities based on the selected state
	async function fetchCities() {
		const countrySelect = document.getElementById('country');
		const stateSelect = document.getElementById('state');
		const citySelect = document.getElementById('city');

		const selectedCountry = countrySelect.value;
		const selectedState = stateSelect.value;

		if (selectedCountry && selectedState) {
			citySelect.innerHTML = '<option value="">Loading...</option>';

			try {
				const response = await fetch(apiEndpoint + `countries/${selectedCountry}/states/${selectedState}/cities`, {
					headers: {
						'X-CSCAPI-KEY': apiKey,
					},
				});
				const data = await response.json();

				citySelect.innerHTML = '<option value=""><?php if(isset($addreesss["city"])){ echo $addreesss["city"];} else{ ?>Select City<?php }?></option>';
				data.forEach(city => {
					const option = document.createElement('option');
					option.value = city.name;
					option.textContent = city.name;
					citySelect.appendChild(option);
				});
			} catch (error) {
				console.error('Error fetching cities:', error);
			}
		} else {
			citySelect.innerHTML = '<option value=""><?php if(isset($addreesss["city"])){ echo $addreesss["city"];} else{ ?>Select City<?php }?></option>';
		}
	}

	// Initial population of the country dropdown
	fetchCountries();




	const image = document.querySelector("img");
	const input = document.getElementById("input");

	input.addEventListener("change", () => {
		if (input.files.length > 0) {
			image.src = URL.createObjectURL(input.files[0]);
		}
	})
	document.getElementById("edit-Form").addEventListener("submit", function(event) {
		// Prevent the form from submitting initially
		event.preventDefault();

		// Reset any previous error messages
		resetErrors();

		// Get form input values
		const firstName = document.querySelector("input[name='first_name']").value;
		const lastName = document.querySelector("input[name='last_name']").value;
		const email = document.querySelector("input[name='email']").value;
		const phone = document.querySelector("input[name='phone']").value;
		const birthday = document.querySelector("input[name='birthday']").value;
		const gender = document.querySelector("select[name='gender']").value;
		const nationality = document.querySelector("input[name='nationality']").value;
		const monthlyIncome = document.querySelector("input[name='monthly_income']").value;

		// Perform form validation
		let hasErrors = false;

		if (!/^[A-Za-z\s]+$/.test(firstName)) {
			displayError("first_name", "Please enter a valid First Name.");
			hasErrors = true;
		}

		if (!/^[A-Za-z\s]+$/.test(lastName)) {
			displayError("last_name", "Please enter a valid Last Name.");
			hasErrors = true;
		}

		if (!/^\S+@\S+\.\S+$/.test(email)) {
			displayError("email", "Please enter a valid Email Address.");
			hasErrors = true;
		}

		if (!/^\d{10}$/.test(phone)) {
			displayError("phone", "Please enter a valid 10-digit Mobile Number.");
			hasErrors = true;
		}

		const today = new Date();
		const dobDate = new Date(birthday);
		const age = today.getFullYear() - dobDate.getFullYear();
		if (age < 18) {
			displayError("birthday", "You must be 18 or older to use this service.");
			hasErrors = true;
		}

		if (gender === '') {
			displayError("gender", "Please select your Gender.");
			hasErrors = true;
		}

		if (!/^[A-Za-z\s]+$/.test(nationality)) {
			displayError("nationality", "Please enter a valid Nationality.");
			hasErrors = true;
		}

		if (isNaN(parseFloat(monthlyIncome)) || parseFloat(monthlyIncome) <= 0) {
			displayError("monthly_income", "Please enter a valid Monthly Income.");
			hasErrors = true;
		}

		// If there are no errors, submit the form
		if (!hasErrors) {
			this.submit(); // Submit the form
		}
	});

	// Function to display an error message for a form field
	function displayError(fieldId, message) {
		const field = document.getElementById(fieldId);
		const errorElement = field.nextElementSibling;
		field.classList.add("is-invalid");
		errorElement.textContent = message;
	}

	// Function to reset all error messages
	function resetErrors() {
		const errorFields = document.querySelectorAll(".is-invalid");
		errorFields.forEach(function(field) {
			field.classList.remove("is-invalid");
		});

		const errorMessages = document.querySelectorAll(".invalid-feedback");
		errorMessages.forEach(function(errorMessage) {
			errorMessage.textContent = "";
		});
	}

	
</script>

<?php include("./footer.php") ?>