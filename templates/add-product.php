<?php include('./navbar.php');
include('../config/constant.php');
if (!isset($_SESSION['login_user'])) {
	header("location:" . URL);
	exit();
} ?>

<div class="container d-flex justify-content-center">
	<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
<form action="../src/controller/add-product.php" enctype="multipart/form-data" method="POST" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>PRODUCTS</legend>


<!-- Text input-->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="product_name">PRODUCT NAME :</label>  
  <div class="col-md-4">
  <input id="product_name" name="product_name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text">
    
  </div>
</div><br>

<!-- Text input-->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="product_name_fr">PRODUCT PRICE:</label>  
  <div class="col-md-4">
  <input id="product_name_fr" name="product_name_fr" placeholder="PRODUCT PRICE(Rs.999/-)" class="form-control input-md" required="" type="number">
    
  </div>
</div><br>

<!-- Select Basic -->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="product_categorie">PRODUCT CATEGORY:</label>
  <div class="col-md-4">
    <select id="product_categorie" name="product_categorie" class="form-control">
      <option value="">Please Select</option>
      <option value="human">Human</option>
      <option value="car">Car</option>
      <option value="cloth">Cloths</option>
      <option value="phone">Mobile</option>
      <option value="food">Food</option>
    </select>
  </div>
</div><br>

<!-- Text input-->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="available_quantity">AVAILABLE QUANTITY:</label>  
  <div class="col-md-4">
  <input id="available_quantity" name="available_quantity" placeholder="AVAILABLE QUANTITY" class="form-control input-md" required="" type="text">
    
  </div>
</div><br>

<!-- Text input-->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="product_weight">PRODUCT WEIGHT:</label>  
  <div class="col-md-4">
  <input id="product_weight" name="product_weight" placeholder="PRODUCT WEIGHT" class="form-control input-md" required="" type="text">
    
  </div>
</div><br>

<!-- Textarea -->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="product_description">PRODUCT DESCRIPTION:</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="product_description" name="product_description"></textarea>
  </div>
</div><br>

<!-- Textarea -->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="product_short_desc">PRODUCT SHORT DESCRIPTION :</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="product_short_desc" name="product_short_desc"></textarea>
  </div>
</div><br>

<!-- Text input-->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="percentage_discount">PERCENTAGE DISCOUNT:</label>  
  <div class="col-md-4">
  <input id="percentage_discount" name="percentage_discount" placeholder="PERCENTAGE DISCOUNT" class="form-control input-md" required="" type="number">
    
  </div>
</div><br>

<!-- Text input-->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="author">Brand:</label>  
  <div class="col-md-4">
  <input id="author" name="author" placeholder="BRAND" class="form-control input-md" required="" type="text">
    
  </div>
</div><br>

<!-- Text input-->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="enable_display">ENABLE DISPLAY:</label>  
  <div class="col-md-4">
  <input id="display" name="enable_display" class="" required="" value="1" type="radio">
  <label class="control-label" for="display">Display</label>

  <input id="ddisplay" name="enable_display"  class="" required="" value="0" type="radio">
  <label class="control-label" for="ddisplay">Don't Display</label>
    
  </div>
</div><br>


<!-- Text input-->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="approuved_by">APPROVED BY:</label>  
  <div class="col-md-4">
  <input id="approuved_by" name="approved_by" placeholder="APPROVED BY" class="form-control input-md" required="" type="text">
  </div>
</div><br>

 <!-- File Button --> 
<div class="form-group ">
  <label class="col-md-4 control-label" for="filebutton">main_image:</label>
  <div class="col-md-4">
    <input id="filebutton" name="filebutton" class="input-file" type="file">
  </div>
</div><br>


<!-- File Button -->
<div class="form-group d-flex">
  <label class="col-md-4 control-label" for="filebutton1">How many alternate Images do you want to give:</label>
  <div class="col-md-4">
    <input id="filebutton1" name="filebutton1" class="input-file" type="number">
    <a class="btn btn-outline-secondary" href="javascript:void(0);" onclick="insertAtCursor()">Insert</a>
    <div id="alt"></div>
  </div>
</div><br>

<!-- Button -->
<div class="form-group ">
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Button</button>
  </div>
  </div><br>
</fieldset>
</form>
    </div>
</div>


<script>
  function insertAtCursor() {
    let num = parseInt(document.getElementById("filebutton1").value, 10);
    if (!isNaN(num) && num > 0) {
      let altContainer = document.getElementById("alt");

      // Remove existing input elements
      while (altContainer.firstChild) {
        altContainer.removeChild(altContainer.firstChild);
      }

      // Create and append new input elements
      for (let i = 1; i <= num; i++) {
        let input = document.createElement("input");
        input.setAttribute("name", `alt${i}`);
        input.setAttribute("type", "file");
        input.setAttribute("class", "input-file");
        altContainer.appendChild(input);
      }
    }
  }
</script>



<?php include('./footer.php'); ?>