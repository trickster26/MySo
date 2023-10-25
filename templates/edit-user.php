<?php
include("./navbar.php");
include('../config/constant.php');
include('../config/connection.php');
include('../src/model/Models.php');

$model = new Models();
$model -> Check($_SESSION['email']);

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
	array_push($exist, $row['subject']);
}

// for hobbies
$sql1 = "SELECT * FROM `hobbies` WHERE user_id = '$id'";
$res = $conn->query($sql1);

$hobbies = array();
while ($rows = mysqli_fetch_assoc($res)) {
	array_push($hobbies, $rows['hobbies']);
}

// for gender
$sql = "SELECT `gender` FROM `profile` WHERE `user_id` = '$id'";
$resu = $conn->query($sql);

$roww = mysqli_fetch_assoc($resu);

$gender = $roww["gender"];

// for address
$sql = "SELECT * FROM `address` WHERE `user_id`= '$id'";
$ress = $conn->query($sql);
$rowww = mysqli_fetch_assoc($ress);
$addreesss = array();
while ($rowe = mysqli_fetch_assoc($ress)) {
	$addreesss["street"] = $rowe["street_address"];
	$addreesss["pin"] = $rowe["pin_code"];
	$addreesss["country"] = $rowe["country"];
	$addreesss["state"] = $rowe["state"];
	$addreesss["city"] = $rowe["city"];
};




?>
<?php if (isset($_SESSION['edit-error'])){ ?>
<div class="alert alert-danger">
    <strong>Error!</strong> Please fix the following issues:
    <ul>
        <?php foreach ($_SESSION['edit-error'] as $error){ ?>
            <li><?php echo $error; ?></li>
        <?php } ?>
    </ul>
</div>
<?php unset($_SESSION['edit-error']); }
// checking if the profile is updated or not
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
    unset($_SESSION['success_message']);
}

?>

<style>
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: .875em;
    color: red;
}
</style>

<div class="container d-flex justify-content-center">
	<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
		<form action="<?php URL?>/src/controller/editUser.php" enctype="multipart/form-data" id="edit-form" method="POST">
			<h3 class="text-center">Edit Personal Information</h3>
			<div style="text-align: center;" class=" mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<fieldset>
							<?php if (!isset($_SESSION['image']) || $_SESSION['image']=='' || empty($_SESSION['image'])) { ?>
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
										<input style="text-align:center;" value="<?php echo $_SESSION['id']; ?>/<?php echo $_SESSION['image']; ?>.<?php echo $_SESSION['extension']; ?>" type="file" name="profile-Image" id="input">
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
    										<br>
    										<input id="delete" type="checkbox" name="delete_image" value="1"> <label for="delete" class="profile_details_text">Delete Profile Image</label>
										</div>
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
						<div class="invalid-feedback"  ></div>
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
						<input type="tel" name="phone" class="form-control" value="<?php echo $_SESSION['phone']; ?>">
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
						<select name="hobbies[]" id="selectTwo" class="form-control" size="3" multiple="multiple">
							<option value="video-game" <?php if (in_array('video-game', $hobbies)) { ?> selected <?php } ?>>Video Games</option>
							<option value="football" <?php if (in_array('football', $hobbies)) { ?> selected <?php } ?>>Football</option>
							<option value="reading" <?php if (in_array('reading', $hobbies)) { ?> selected <?php } ?>>Reading</option>
						</select>
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Gender:</label><br>

						<input type="radio" <?php if ($gender == "Male") { ?> checked <?php } ?> id="male" name="gender" value="Male"></input><label for="male">Male</label>
						<input type="radio" <?php if ($gender == "Female") { ?> checked <?php } ?> id="female" name="gender" value="Female"></input><label for="female">Female</label>
						<div class="invalid-feedback gender"></div>
					</div>
					
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label for="Subjects" class="profile_details_text">Fav. Subjects:</label><br>
						<input id="math" type="checkbox" name="subject[]" value="math" <?php if (in_array('math', $exist)) { ?> checked <?php } ?> /> <label for="math">Math</label><br>
						<input id="science" type="checkbox" name="subject[]" value="science" <?php if (in_array('science', $exist)) { ?> checked <?php } ?> /> <label for="science">Science</label><br>
						<input type="checkbox" name="subject[]" value="english" <?php if (in_array('english', $exist)) { ?> checked <?php } ?> id="english" /> <label for="english">English</label><br>
						<input type="checkbox" name="subject[]" value="hindi" <?php if (in_array('hindi', $exist)) { ?> checked <?php } ?> id="hindi" /> <label for="hindi">Hindi</label> <br>
						<input type="checkbox" name="subject[]" value="social" <?php if (in_array('social', $exist)) { ?> checked <?php } ?> id="social" /> <label for="social">Social Studies</label><br>
						<div class="invalid-feedback subject"></div>
					</div>
				</div>
			</div>
			
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Nationality:</label>
						<input type="text" id="nationality" name="nationality" class="form-control" value="<?php echo $_SESSION['nationality']; ?>">
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
	document.getElementById("edit-form").addEventListener("submit", function(event) {
		// Prevent the form from submitting initially
		event.preventDefault();

		// Reset any previous error messages
		resetErrors();


		// Get form input values
		const firstName = document.querySelector("input[name='first_name']").value.trim();
		const lastName = document.querySelector("input[name='last_name']").value.trim();
		const email = document.querySelector("input[name='email']").value.trim();
		const phone = document.querySelector("input[name='phone']").value.trim();
		const birthday = document.querySelector("input[name='birthday']").value;
		const nationality = document.getElementById("nationality").value.trim();
		console.log("nationality: ",nationality);
		const hobbies =  document.querySelector("select[name='hobbies[]'").value;
		const gender = document.querySelector("input[name='gender']:checked");

		const subjectCheckboxes = document.querySelectorAll("input[name='subject[]']");
		const selectedSubjects = Array.from(subjectCheckboxes).filter(checkbox => checkbox.checked);
		const monthlyIncome = document.querySelector("input[name='monthly_income']").value.trim();

		// Perform form validation
		let hasErrors = false;

	

		// Validate first name
		if (!firstName) {
			displayError("first_name", "First Name is required.");
			hasErrors = true;
		}

		// Validate nationality
		if(!nationality) {
			displayError("nationality","Enter Nationality.");
			hasErrors = true;
		}

		// validate subject
		if (selectedSubjects.length === 0) {
			displaySubjectError("Please select at least one favorite subject.")
    		hasErrors = true;
		}

		// gender validation
		if (!gender){
			displayGenderError("Gender required");
			hasErrors = true;
		}

		// Validate hobbies
		if(!hobbies) {
			displayError('hobbies[]', 'Hobbies are required');
			hasErrors = true;
		}

		// Validate last name
		if (!lastName) {
			displayError("last_name", "Last Name is required.");
			hasErrors = true;
		}

		// Validate email
		if (!email) {
			displayError("email", "Email is required.");
			hasErrors = true;
		} else if (!isValidEmail(email)) {
			displayError("email", "Please enter a valid Email Address.");
			hasErrors = true;
		}

		// Validate phone number
		if (!phone) {
			displayError("phone", "Phone Number is required.");
			hasErrors = true;
		} else if (!isValidPhoneNumber(phone)) {
			displayError("phone", "Please enter a valid 10-digit Mobile Number.");
			hasErrors = true;
		}

		// Validate date of birth
		if (!isValidDate(birthday)) {
			displayError("birthday", "Please enter a valid Date of Birth.");
			hasErrors = true;
		}

		// validate age
		const today = new Date();
		const dobDate = new Date(birthday);
		const age = today.getFullYear() - dobDate.getFullYear();
		if (age < 18) {
			displayError("birthday", "You must be 18 or older to use this service.");
			hasErrors = true;
		}





		// Validate monthly income
		if (!isValidMonthlyIncome(monthlyIncome)) {
			displayError("monthly_income", "Please enter a valid Monthly Income.");
			hasErrors = true;
		}

		// If there are no errors, submit the form
		if (!hasErrors) {
			this.submit();
		}
	});

	// Function to reset error messages
	function resetErrors() {
		const errorElements = document.querySelectorAll(".invalid-feedback");
		errorElements.forEach(function(element) {
				element.textContent = "";
			})
		}
		// Function to display an error message for the "Subjects" checkboxes
	function displaySubjectError(message) {
    	const errorElement = document.querySelector(".invalid-feedback.subject"); 
    	errorElement.textContent = message;
	}

	function displayGenderError(message) {
		const errorElement = document.querySelector(".invalid-feedback.gender");
		errorElement.textContent = message; 
	}

		// Function to display an error message for a specific field
		function displayError(fieldName, message) {
			const errorElement = document.querySelector(`[name='${fieldName}'] + .invalid-feedback`);
			errorElement.textContent = message;
			console.log(message)
		}

		// Function to validate email format
		function isValidEmail(email) {
			const emailPattern = /^\S+@\S+\.\S+$/;
			return emailPattern.test(email);
		}

		// Function to validate a 10-digit phone number
		function isValidPhoneNumber(phone) {
			const phonePattern = /^\d{10}$/;
			return phonePattern.test(phone);

		}
		//  kj

		// Function to validate a date format
		function isValidDate(date) {
			return !isNaN(new Date(date));
		}

		// Function to validate monthly income (should be a positive number)
		function isValidMonthlyIncome(income) {
			return !isNaN(income) && parseFloat(income) > 0;
		}

		// SELECT2
		$(document).ready(function () {
    		$('#selectTwo').select2({
      			placeholder: 'Select options', 
      			width: '100%',
      			theme: 'classic'
    		});
 	 	});



		//  Image Preview
		const image = document.querySelector("img");
		const input = document.getElementById("input");

		input.addEventListener("change", () => {
			if (input.files.length > 0) {
				image.src = URL.createObjectURL(input.files[0]);
			}
		})
</script>

<?php include("./footer.php") ?>