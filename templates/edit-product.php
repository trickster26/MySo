<?php 
require('../config/connection.php');
require('navbar.php');
// Checking if the data  i.e. id is coming from get request or not
if(($_SERVER["REQUEST_METHOD"] == "GET")){
    $id = $_GET['id'];
    // GET product for Edit
    $sql = "SELECT * FROM product WHERE id = '$id'";
    $res = $conn -> query($sql);
    $row = mysqli_fetch_assoc($res);
    var_dump($row);
}
?>

<?php include("footer.php"); ?>