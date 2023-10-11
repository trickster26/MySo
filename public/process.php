<?php include('../config/connection.php'); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
   // echo "$name,$email,$phone,$password";
    // $sql = " SELECT * FROM `user`";
    // $sql_execute = mysqli_query
    $query = "INSERT INTO `user`(`name`, `email`, `phone`, `password`) VALUES ('$name','$email','$phone','$password')";
    echo "<pre><br>";
    print($query);
//    echo "<br>";
    //  $execute = mysqli_query($conn, $query);
    $execute = $conn -> query($query);
    if( $execute == true){
      echo "inserted";
    }
    
  }
?>



