<?php session_start();?>

<!DOCTYPE html>
<html>
  <head>
    <title>MySo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../assets/styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <base href="http://localhost:8000">
    <!-- Select2 libraries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> -->
</head>
  <body>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://localhost:8000/">MySo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <?php if($_SESSION['role']==1){ ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost:8000/templates/dashboard.php">Dashboard</a>
        </li>
        <?php }?>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost:8000/templates/about.php">About Us</a>
        </li>
        <?php if (isset($_SESSION["login_user"])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost:8000/templates/add-product.php">Add Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost:8000/templates/my-products.php">My Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost:8000/templates/addresses.php">Address</a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost:8000/templates/items.php">Products</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="http://localhost:8000/templates/ContactUS.php" role="button">
            Contact Us
          </a>
        </li>
        
      </ul>
      <?php if (isset($_SESSION["login_user"])){ ?>
      <div class="d-flex" role="search">
        <a class="nav-link" href="http://localhost:8000/templates/edit-user.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" fill="green" class="bi bi-person-circle mx-3 mt-1" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
          </svg></a>
        <a href="http://localhost:8000/src/controller/logout.php" class="btn btn-success me-2">LogOut</a>
      </div>
      <?php } else { ?>
      <div class="d-flex" role="search">
        <a href="http://localhost:8000/templates/login.php" class="btn btn-success me-2">Login</a>
        <a href="http://localhost:8000/templates/signup.php" class="btn btn-outline-success">Register</a>
      </div>
      <?php } ?>
    </div>
  </div>         
</nav>



