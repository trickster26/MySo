<?php 
session_start();
// include('././../config/constant.php');
include('../config/constant.php');
include('navbar.php'); 
?>

<?php if(isset($_SESSION['forget-error'])){ ?>
    <style>
        .page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;
}

.page_404  img{ width:100%;}

.four_zero_four_bg{
 
 background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
    height: 400px;
    background-position: center;
 }
 
 
 .four_zero_four_bg h1{
 font-size:80px;
 }
 
  .four_zero_four_bg h3{
			 font-size:80px;
			 }
			 
			 .link_404{			 
	color: #fff!important;
    padding: 10px 20px;
    background: #39ac31;
    margin: 20px 0;
    display: inline-block;}
	.contant_box_404{ margin-top:-50px;}
    </style>
 <div class="container my-5" style="height: 60vh;">
  <div class="row justify-content-center">
    <div class="col-lg-9">
    <section class="page_404">
	<div class="container">
		<div class="row">	
		<div class="col-sm-12 ">
		<div class="col-sm-10 col-sm-offset-1  text-center">
		<div class="four_zero_four_bg">
			<h1 class="text-center ">Oops!!!</h1>
		
		
		</div>
		
		<div class="contant_box_404">
		<h3 class="h2">
        <?php echo $_SESSION['forget-error'] ;?>
		
		</h3>
		
		<p>Look like you're lost</p>
		
		<a href="http://localhost:8000/src/controller/forget.php" class="link_404">Re-Enter Email</a>
	</div>
		</div>
		</div>
		</div>
	</div>
    </section>
    </div>
  </div>
 </div>


<?php }else{ ?>


<div class="container my-5" style="height: 60vh;">
  <div class="row justify-content-center">
    <div class="col-lg-9">
      <h1 class="mb-3">Reset Form</h1>
      <form name="reset" action="http://localhost:8000/src/controller/forget.php" method="POST">
        <div class="row g-3">
          <div class="col-md-6">
            <label for="your-email" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="your-email" name="email" required>
          </div>
          
          <div class="col-12">
            <div class="row">
              <div class="col-md-6">
                <button  type="submit" id="reset-button" class="btn btn-dark w-100 fw-bold">
                <span class="spinner-border spinner-border-sm me-2 d-none" id="reset-spinner" role="status" aria-hidden="true"></span>
                <p id="success-message" class="d-none">Reset successful!</p>
                  <span id="reset-text">RESET</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php }?>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const resetForm = document.forms.reset; 
    const resetButton = document.getElementById("reset-button");
    const resetSpinner = document.getElementById("reset-spinner");
    const successMessage = document.getElementById("success-message");
    const reset = document.getElementById("reset-text");

    resetForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Disable the button and show the spinner
        resetButton.disabled = true;
        resetSpinner.classList.remove("d-none");

        // Submit the form
        fetch(resetForm.action, {
            method: "POST",
            body: new FormData(resetForm),
        })
            .then((response) => {
                if (response.status === 200) {
                  successMessage.textContent = "Mail sent successfully!";
                  successMessage.classList.remove("d-none")
                  reset.classList.add("d-none")
                  setTimeout(()=>{
                    successMessage.classList.add("d-none")
                    reset.classList.remove("d-none")
                  },2000);
                  
                } else {
                  successMessage.textContent = "Something Went Wrong!";
                  successMessage.classList.remove("d-none")
                  reset.classList.add("d-none")
                  setTimeout(()=>{
                    successMessage.classList.add("d-none")
                    reset.classList.remove("d-none")
                  },2000);
                }
            })
            .catch((error) => {
                // Error occurred during form submission, handle as needed
            })
            .finally(() => {
                resetButton.disabled = false;
                resetSpinner.classList.add("d-none");
            });
    });
});
</script>

<?php
unset($_SESSION['forget-error']);
 include("footer.php"); ?>